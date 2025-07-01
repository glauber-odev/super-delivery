import { Carrinho, CarrinhoProduto } from '@/types/api';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import FavoriteIcon from '@mui/icons-material/Favorite';
import FavoriteBorderIcon from '@mui/icons-material/FavoriteBorder';
import {
    Accordion,
    AccordionDetails,
    AccordionSummary,
    Box,
    Card,
    CardContent,
    Divider,
    Grid,
    Typography,
} from '@mui/material';
import axios from 'axios';
import { useCallback, useEffect, useState } from 'react';
import DataGridProdutos from '../shared/DataGridProdutos';


const formatFloat2Money = (value: number | Intl.StringNumericLiteral) => {
    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
    });

    return formatter.format(value);
};

const ProdutosNormailzer = ({ carrinho_produtos } : { carrinho_produtos : CarrinhoProduto[] }) => {
    const produtos = carrinho_produtos.map((carrinho_produto) => {
        if(carrinho_produto.produto) return carrinho_produto.produto
    })

    return <DataGridProdutos produtos={produtos} />

}


// const carrinhos = [
//   {
//     id: 1,
//     titulo: 'Compra Automática - Banho',
//     total: 320.75,
//     flg_favorito: true,
//     user_id: 101,
//     residencia_id: 201,
//     programado: true,
//     produtos: [
//       { id: 1, nome: 'Sabonete', quantidade: 4, preco: 3.50 },
//       { id: 2, nome: 'Shampoo', quantidade: 2, preco: 12.90 },
//     ]
//   },
//   {
//     id: 2,
//     titulo: 'Itens Aleatórios',
//     total: 780.00,
//     flg_favorito: false,
//     user_id: 102,
//     residencia_id: 202,
//     programado: false,
//     produtos: [
//       { id: 3, nome: 'Biscoito', quantidade: 6, preco: 4.20 },
//       { id: 4, nome: 'Suco', quantidade: 3, preco: 5.90 },
//     ]
//   }
// ];

const ListaCarrinho = () => {
    const [carrinhos, setCarrinhos] = useState<Carrinho[]>();

    const fetchCarrinhos = useCallback(() => {

        axios
            .get(`/api/carrinhos`)
            .then((response) => {
                setCarrinhos(response?.data?.data);
            })
            .catch((error) => {
                console.error(error);
                console.error(error?.response?.data?.message);
            });

        return true;
    }, []);

    useEffect(() => {
        fetchCarrinhos();
    },[]);

    console.log(carrinhos);

  return (
    <Box sx={{ padding: 4, backgroundColor: '#f5f5f5', minHeight: '100vh' }}>
      <Typography variant="h4" gutterBottom>
        Carrinhos
      </Typography>

      <Box display="flex" flexDirection="column" gap={3}>
        {carrinhos?.map((item) => (
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
            {item?.pedido_programado && item.pedido_programado?.flg_habilitado && (
            <a href={"/pedidos-programados/"+item?.pedido_programado?.id}>
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
                <Typography variant="body1" color="gray">
                  Código: #{item.id}
                </Typography>
                <Typography variant="h6" color="primary">
                  {item.titulo || ''}
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
                  <Typography><strong>Total: </strong>{formatFloat2Money(Number(item.total))}</Typography>
                  {/* <Typography><strong>ID Usuário:</strong> {item.user_id}</Typography> */}
                </Grid>

                <Grid item xs={12} sm={6}>
                  <Typography><strong>CEP padrão de envio</strong> {item?.residencia?.cep}</Typography>
                </Grid>
              </Grid>
            </CardContent>

            {/* Accordion com Produtos */}
            <Accordion sx={{ backgroundColor: '#fafafa' }}>
              <AccordionSummary expandIcon={<ExpandMoreIcon />}>
                <Typography fontWeight="bold">Produtos</Typography>
              </AccordionSummary>
              <AccordionDetails>
                {item.carrinho_produtos && item.carrinho_produtos.length > 0 ? (
                    <ProdutosNormailzer carrinho_produtos={item.carrinho_produtos} />
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
