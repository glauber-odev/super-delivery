import React, { useCallback, useEffect, useState } from 'react';
import {
  Box,
  Card,
  CardContent,
  Typography,
  Grid,
  Divider,
  Accordion,
  AccordionSummary,
  AccordionDetails
} from '@mui/material';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import { Pedido, PedidoProduto } from '@/types/api';
import axios from 'axios';
import DataGridProdutos from '@/components/shared/DataGridProdutos';



// const pedidos = [
//   {
//     id: 1,
//     flg_pago: true,
//     subtotal: 150.5,
//     total: 170.0,
//     flg_retirar_na_loja: false,
//     dias_estimados_entrega: 3,
//     custo_frete: 19.5,
//     user_id: 101,
//     residencia_id: 202,
//     created_at: '2025-06-28',
//     produtos: [
//       { id: 1, nome: 'Camisa Polo', quantidade: 2, preco: 45.25 },
//       { id: 2, nome: 'Tênis Esportivo', quantidade: 1, preco: 79.50 },
//     ],
//   },
//   {
//     id: 2,
//     flg_pago: false,
//     subtotal: 200.0,
//     total: 200.0,
//     flg_retirar_na_loja: true,
//     dias_estimados_entrega: null,
//     custo_frete: 0,
//     user_id: 102,
//     residencia_id: null,
//     created_at: '2025-06-27',
//     produtos: [
//       { id: 3, nome: 'Jaqueta', quantidade: 1, preco: 200.00 },
//     ],
//   },
// ];

const formatBoolean = (value: boolean) => (value ? 'Sim' : 'Não');

const formatFloat2Money = (value: number | Intl.StringNumericLiteral) => {
    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
    });

    return formatter.format(value);
};

const ProdutosNormailzer = ({ pedido_produtos } : { pedido_produtos : PedidoProduto[]}) => {
    const produtos = pedido_produtos.map((pedido_produto) => {
        if(pedido_produto.produto) return pedido_produto.produto
    })

    return <DataGridProdutos produtos={produtos} />

}

const ListaPedidos = () => {

    const [pedidos, setPedidos] = useState<Pedido[]>();

    const fetchPedidos = useCallback(() => {


        axios
            .get(`/api/pedidos`)
            .then((response) => {
                setPedidos(response?.data?.data);
            })
            .catch((error) => {
                console.error(error);
                console.error(error?.response?.data?.message);
            });

        return true;
    }, []);

    useEffect(() => {
        fetchPedidos();
    },[]);


  return (
    <Box sx={{ padding: 4, backgroundColor: '#f5f5f5', minHeight: '100vh' }}>
      <Typography variant="h4" gutterBottom>
        Pedidos
      </Typography>

      <Box display="flex" flexDirection="column" gap={3}>
        {pedidos && pedidos.map((pedido) => (
          <Card
            key={pedido.id}
            sx={{
              width: '100%',
              boxShadow: 3,
              borderRadius: 2,
              backgroundColor: '#ffffff',
            }}
          >
            <CardContent>
              <Typography variant="h6" gutterBottom color="primary">
                <Typography variant='body2' color="gray">
                  código: #{pedido.id}
                </Typography>
              </Typography>

              <Box
                sx={{
                  display: 'flex',
                  flexDirection: { xs: 'column', sm: 'row' },
                  justifyContent: 'space-between',
                  gap: 2
                }}
              >
                <Grid sx={{ xs:12, sm:6, md:3 }}>
                  <Grid>
                    <Typography><strong>Total:</strong> {formatFloat2Money(Number(pedido.total) || 0)}</Typography>
                    <Typography><strong>Dias Est. Entrega:</strong> {pedido.dias_estimados_entrega ?? '-'}</Typography>
                    <Typography><strong>Pago:</strong> {formatBoolean(Boolean(pedido.flg_pago))}</Typography>
                  </Grid>
                </Grid>

                <Grid sx={{ xs:12, sm:6, md:3 }}>
                  <Grid>
                    <Typography><strong>Custo Frete:</strong>{formatFloat2Money(Number(pedido.custo_frete) || 0)}</Typography>
                    <Typography><strong>CEP de entrega:</strong> {pedido?.residencia?.cep ?? '*******'}</Typography>
                    <Typography><strong>Data de pagamento:</strong> {new Date(pedido.created_at || '10/02/2025').toLocaleDateString()}</Typography>
                  </Grid>
                </Grid>
              </Box>
            </CardContent>

            <Divider />

            {/* Accordion para exibir produtos */}
            <Accordion sx={{ backgroundColor: '#fafafa' }}>
              <AccordionSummary expandIcon={<ExpandMoreIcon />}>
                <Typography variant="subtitle1" fontWeight="bold">Produtos do Pedido</Typography>
              </AccordionSummary>
              <AccordionDetails>
                {pedido.pedido_produtos && pedido.pedido_produtos.length > 0 ? (
                  <ProdutosNormailzer pedido_produtos={pedido.pedido_produtos} />
                ) : (
                  <Typography color="text.secondary">Nenhum produto encontrado.</Typography>
                )}
              </AccordionDetails>
            </Accordion>
          </Card>
        ))}
      </Box>
    </Box>
  );
};

export default ListaPedidos;
