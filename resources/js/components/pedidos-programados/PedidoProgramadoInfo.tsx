import React from 'react';
import {
  Box,
  Card,
  CardContent,
  Typography,
  Grid,
  Divider,
  Stack,
} from '@mui/material';
import {
  Timeline,
  TimelineItem,
  TimelineSeparator,
  TimelineConnector,
  TimelineContent,
  TimelineDot,
} from '@mui/lab';
import { PedidoProgramado as PedidoProgramadoType } from '@/types/api';
import { CheckIcon, XIcon } from 'lucide-react';

// Dados simulados
const pedidoProgramado = {
  id: 1,
  flg_habilitado: true,
  flg_debito_automatico: true,
  periodicidade: 1, // a cada X meses
  tempo_unidade: 2, // dia do mês
  user_id: 101,
  carrinho: {
    titulo: 'Compra Mensal',
    produtos: [
      { id: 1, nome: 'Sabonete', quantidade: 3, preco: 2.5 },
      { id: 2, nome: 'Shampoo', quantidade: 1, preco: 12.9 },
    ]
  }
};

// Utilitário para calcular próximas datas
const calcularProximasDatas = (dia: number, periodicidade: number, quantidade: number = 4): string[] => {
  const hoje = new Date();
  const datas: string[] = [];
    // console.log(dia, periodicidade);
    // dia = 2;

    if(periodicidade == 1 /* Semanal */ ){
        for (let i = 1; i <= quantidade; i++) {
            const data = new Date();
            data.setDate(data.getDate() + (i * 7 + 1));
            datas.push(data.toLocaleDateString());
        };
    } else { /* Mensal */
        for (let i = 1; i <= quantidade; i++) {
            const data = new Date(hoje.getFullYear(), hoje.getMonth() + i, 1);
            const ultimoDia = new Date(data.getFullYear(), data.getMonth() + 1, 0).getDate();
            const diaCorrigido = Math.min(dia, ultimoDia);
            data.setDate(diaCorrigido);
            datas.push(data.toLocaleDateString());
        }
    }


  return datas;
};


const formatFloat2Money = (value: number | Intl.StringNumericLiteral) => {
    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
    });

    return formatter.format(value);
};

const PedidoProgramadoInfo = ({ pedidoProgramado } : { pedidoProgramado : PedidoProgramadoType | undefined } ) => {
  const datasRecorrencias = calcularProximasDatas(
                            Number(pedidoProgramado?.tempo_unidade?.posicao_ordem),
                            Number(pedidoProgramado?.periodicidade?.id)
                        );

  return (
    <Box sx={{ padding: 4, backgroundColor: '#f5f5f5', minHeight: '100vh' }}>
      <Typography variant="h4" gutterBottom>
        Pedido Programado
      </Typography>

      <Card sx={{ mb: 4, boxShadow: 3 }}>
        <CardContent>
          <Grid container spacing={2}>
            <Grid item xs={12} sm={6}>
              <Typography><strong>Status:</strong> {pedidoProgramado?.flg_habilitado ? 'Habilitado' : 'Desabilitado'}</Typography>
              <Typography><strong>Periodicidade:</strong> {pedidoProgramado?.periodicidade?.id == 1 ? 'Semanal' : 'Mensal'}</Typography>
              {pedidoProgramado?.periodicidade?.id == 1 ? (
                  <Typography><strong>Dia da Semana:</strong> A cada dia {pedidoProgramado?.tempo_unidade?.unidade} da semana</Typography>
                )
                :
                (
                  <Typography><strong>Dia do Mês:</strong> Ao {pedidoProgramado?.tempo_unidade?.posicao_ordem}º dia do mês(es)</Typography>
                )}
              <Stack direction={'row'}> <Typography sx={{ mr: 1 }} ><strong>Débito Automático:</strong></Typography>{pedidoProgramado?.flg_debito_automatico ? <CheckIcon/> : <XIcon/>}</Stack>
            </Grid>

            <Grid item xs={12} sm={6}>
              <Typography variant="subtitle1" gutterBottom><strong>Carrinho Vinculado:</strong> #{pedidoProgramado?.carrinho?.id}</Typography>
              <Divider sx={{ my: 1 }} />
              {pedidoProgramado?.carrinho?.carrinho_produtos?.map((car_prod) => (
                <Box key={car_prod?.produto?.id} sx={{ mb: 1 }}>
                  <Typography>- {car_prod?.produto?.nome} {formatFloat2Money(Number(car_prod?.produto?.preco))}</Typography>
                </Box>
              ))}
            </Grid>
          </Grid>
        </CardContent>
      </Card>

      <Typography variant="h6" gutterBottom>Próximas Recorrências</Typography>
      <Timeline position="alternate">
        {datasRecorrencias.map((data, index) => (
          <TimelineItem key={index}>
            <TimelineSeparator>
              <TimelineDot color="primary" />
              {index < datasRecorrencias.length - 1 && <TimelineConnector />}
            </TimelineSeparator>
            <TimelineContent>
              <Typography>{data}</Typography>
            </TimelineContent>
          </TimelineItem>
        ))}
      </Timeline>
    </Box>
  );
};

export default PedidoProgramadoInfo;
