import React from 'react';
import {
  Box,
  Card,
  CardContent,
  Typography,
  Grid,
  Divider,
} from '@mui/material';
import {
  Timeline,
  TimelineItem,
  TimelineSeparator,
  TimelineConnector,
  TimelineContent,
  TimelineDot,
} from '@mui/lab';

// Dados simulados
const pedidoProgramado = {
  id: 1,
  flg_habilitado: true,
  flg_debito_automatico: true,
  periodicidade: 1, // a cada X meses
  unidade: 2, // dia do mês
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
const calcularProximasDatas = (dia: number, periodicidade: number, quantidade: number = 3): string[] => {
  const hoje = new Date();
  const datas: string[] = [];

  for (let i = 1; i <= quantidade; i++) {
    const data = new Date(hoje.getFullYear(), hoje.getMonth() + (i * periodicidade), 1);
    const ultimoDia = new Date(data.getFullYear(), data.getMonth() + 1, 0).getDate();
    const diaCorrigido = Math.min(dia, ultimoDia);
    data.setDate(diaCorrigido);
    datas.push(data.toLocaleDateString());
  }

  return datas;
};

const PedidoProgramadoInfo = () => {
  const datasRecorrencias = calcularProximasDatas(pedidoProgramado.unidade, pedidoProgramado.periodicidade);

  return (
    <Box sx={{ padding: 4, backgroundColor: '#f5f5f5', minHeight: '100vh' }}>
      <Typography variant="h4" gutterBottom>
        Pedido Programado
      </Typography>

      <Card sx={{ mb: 4, boxShadow: 3 }}>
        <CardContent>
          <Grid container spacing={2}>
            <Grid item xs={12} sm={6}>
              <Typography><strong>Status:</strong> {pedidoProgramado.flg_habilitado ? 'Habilitado' : 'Desabilitado'}</Typography>
              <Typography><strong>Débito Automático:</strong> {pedidoProgramado.flg_debito_automatico ? 'Sim' : 'Não'}</Typography>
              {/* <Typography><strong>Periodicidade:</strong> A cada {pedidoProgramado.periodicidade} mês(es)</Typography> */}
              <Typography><strong>Periodicidade:</strong> Mensalmente</Typography>
              <Typography><strong>Dia do Mês:</strong> A cada dia {pedidoProgramado.unidade} do mês(es)</Typography>
            </Grid>

            <Grid item xs={12} sm={6}>
              <Typography variant="subtitle1" gutterBottom><strong>Carrinho Vinculado:</strong></Typography>
              <Typography><strong>Título:</strong> {pedidoProgramado.carrinho.titulo}</Typography>
              <Divider sx={{ my: 1 }} />
              {pedidoProgramado.carrinho.produtos.map((prod) => (
                <Box key={prod.id} sx={{ mb: 1 }}>
                  <Typography>- {prod.nome} ({prod.quantidade}x) R$ {prod.preco.toFixed(2)}</Typography>
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
