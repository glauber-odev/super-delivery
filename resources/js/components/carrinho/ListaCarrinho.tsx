import React from 'react';
import {
  Box,
  Card,
  CardContent,
  Typography,
  Grid,
  Divider,
  Accordion,
  AccordionSummary,
  AccordionDetails,
  Chip
} from '@mui/material';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import FavoriteIcon from '@mui/icons-material/Favorite';
import FavoriteBorderIcon from '@mui/icons-material/FavoriteBorder';

const carrinhos = [
  {
    id: 1,
    titulo: 'Compra Automática - Banho',
    total: 320.75,
    flg_favorito: true,
    user_id: 101,
    residencia_id: 201,
    programado: true,
    produtos: [
      { id: 1, nome: 'Sabonete', quantidade: 4, preco: 3.50 },
      { id: 2, nome: 'Shampoo', quantidade: 2, preco: 12.90 },
    ]
  },
  {
    id: 2,
    titulo: 'Itens Aleatórios',
    total: 780.00,
    flg_favorito: false,
    user_id: 102,
    residencia_id: 202,
    programado: false,
    produtos: [
      { id: 3, nome: 'Biscoito', quantidade: 6, preco: 4.20 },
      { id: 4, nome: 'Suco', quantidade: 3, preco: 5.90 },
    ]
  }
];

const ListaCarrinho = () => {
  return (
    <Box sx={{ padding: 4, backgroundColor: '#f5f5f5', minHeight: '100vh' }}>
      <Typography variant="h4" gutterBottom>
        Carrinhos
      </Typography>

      <Box display="flex" flexDirection="column" gap={3}>
        {carrinhos.map((item) => (
          <Card
            key={item.id}
            sx={{
              width: '100%',
              boxShadow: 3,
              borderRadius: 2,
              backgroundColor: '#ffffff',
              position: 'relative',
            }}
          >
            {/* Flag Programado */}
            {item.programado && (
            //   <Chip
            //     label="Programado"
            //     color="success"
            //     size="small"
            //     sx={{ position: 'absolute', top: 16, right: 16 }}
            //   />
            
            <a href="/pedidos-programados">
                <Box
                sx={{
                    position: 'absolute',
                    top: 16,
                    right: 16,
                    backgroundColor: '#4caf50',
                    color: 'white',
                    fontSize: '0.75rem',
                    fontWeight: 'bold',
                    padding: '4px 8px',
                    borderRadius: '4px',
                    textTransform: 'uppercase',
                    letterSpacing: 0.5
                }}
                >
                Programado
                </Box>
            </a>
            )}

            <CardContent>
              <Box display="flex" justifyContent="space-between" alignItems="center">
                <Typography variant="h6" color="primary">
                  {item.titulo || 'Sem título'}
                </Typography>

                {item.flg_favorito ? (
                  <FavoriteIcon color="error" />
                ) : (
                  <FavoriteBorderIcon color="disabled" />
                )}
              </Box>

              <Divider sx={{ my: 2 }} />

              <Grid container spacing={2}>
                <Grid item xs={12} sm={6}>
                  <Typography><strong>Total:</strong> R$ {item.total?.toFixed(2) ?? '-'}</Typography>
                  <Typography><strong>ID Usuário:</strong> {item.user_id}</Typography>
                </Grid>

                <Grid item xs={12} sm={6}>
                  <Typography><strong>ID Residência:</strong> {item.residencia_id}</Typography>
                </Grid>
              </Grid>
            </CardContent>

            {/* Accordion com Produtos */}
            <Accordion sx={{ backgroundColor: '#fafafa' }}>
              <AccordionSummary expandIcon={<ExpandMoreIcon />}>
                <Typography fontWeight="bold">Produtos</Typography>
              </AccordionSummary>
              <AccordionDetails>
                {item.produtos && item.produtos.length > 0 ? (
                  item.produtos.map((produto) => (
                    <Box key={produto.id} sx={{ marginBottom: 1 }}>
                      <Typography><strong>Produto:</strong> {produto.nome}</Typography>
                      <Typography><strong>Quantidade:</strong> {produto.quantidade}</Typography>
                      <Typography><strong>Preço Unitário:</strong> R$ {produto.preco.toFixed(2)}</Typography>
                      <Divider sx={{ marginY: 1 }} />
                    </Box>
                  ))
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

export default ListaCarrinho;
