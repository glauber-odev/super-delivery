import { CarrinhoGridProps, ProdutoGrid } from '@/types/api';
import { AlertColor } from '@mui/material';
import Box from '@mui/material/Box';
import Grid from '@mui/material/Grid';
import CardProduto from '../CardProduto/CardProduto';

type GridProdutosProps = {
        produtos: ProdutoGrid[] | null;
        handleSnackbar: (message?: string, severity?: AlertColor, autoHideDuration?: number, openSnackbar?: boolean) => void;
        handlePushOrModifyProduto: (quantidade: number | null, produto_id: number | null, carrinho_id?: number) => void;
        carrinho?: CarrinhoGridProps;
    };

export default function GridProdutos({ produtos, handleSnackbar, handlePushOrModifyProduto, carrinho} : GridProdutosProps) {

    console.log(handleSnackbar);

    const handleCarrinhoUpdate = (quantidade: number | null, produto_id: number | null) => {

        if(carrinho?.id) {
            handlePushOrModifyProduto(quantidade, produto_id, Number(carrinho?.id) );
        }

        handlePushOrModifyProduto(quantidade, produto_id);
    }


    return (
        <Box sx={{ flexGrow: 1 }}>
            <Grid container spacing={{ xs: 2, md: 3 }} columns={{ xs: 4, sm: 8, md: 12 }}>
                {produtos && produtos.map((produto, index) => (
                    <Grid key={index} size={{ xs: 2, sm: 4, md: 4 }}>
                        <CardProduto 
                        produto={produto} 
                        qtSelected={Number(() => {
                            const carIndex = carrinho?.produtos?.findIndex((carProduto) => carProduto.id === produto.id);
                            const quantidade = carrinho?.produtos ? carrinho?.produtos[Number(carIndex)] : 0;
                            return quantidade;
                        })}
                        handleCarrinhoUpdate={handleCarrinhoUpdate} />
                    </Grid>
                ))}
            </Grid>
        </Box>
    );
}
