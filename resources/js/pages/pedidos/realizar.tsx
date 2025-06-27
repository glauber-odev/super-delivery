import Footer from '@/components/footer';
import Header from '@/components/header';
import StepperPedido from '@/components/pedidos/StepperPedido/StepperPedido';
import { CarrinhoSession, Categoria as CategoriaType, ProdutoDataGrid } from '@/types/api';
import { usePage } from '@inertiajs/react';
import Alert, { AlertColor } from '@mui/material/Alert';
import Box from '@mui/material/Box';
import Snackbar, { SnackbarCloseReason } from '@mui/material/Snackbar';
import axios from 'axios';
import { useCallback, useEffect, useState } from 'react';

export default function Realizar() {
    const { props } = usePage<{ categoriaParam : string}>();
    const categoriaParam = props.categoriaParam;
    const [produtos, setProdutos] = useState<ProdutoDataGrid[] | null>(null);
    const [categorias, setCategorias] = useState<CategoriaType[] | null>(null);
    const [message, setMessage] = useState<string>('Ação realizada com sucesso');
    const [severity, setSeverity] = useState<AlertColor>('success');
    const [autoHideDuration, setAutoHideDuration] = useState<number>(6000);
    const [openSnackbar, setOpenSnackbar] = useState(false);
    const [carrinhoSession, setCarrinhoSession] = useState<CarrinhoSession>();
    const [openDrawer, setOpenDrawer] = useState(false);

    const toggleDrawer =
    (open: boolean) =>
    (event: React.KeyboardEvent | React.MouseEvent) => {
        if (
        event.type === 'keydown' &&
        ((event as React.KeyboardEvent).key === 'Tab' ||
            (event as React.KeyboardEvent).key === 'Shift')
        ) {
        return;
        }

        setOpenDrawer(open);
    };

    const handleCloseSnackbar = (event?: React.SyntheticEvent | Event, reason?: SnackbarCloseReason) => {
        if (reason === 'clickaway') {
            return;
        }

        setOpenSnackbar(false);
    };

    const handleClose = () => {
        setOpenSnackbar(false);
    };

    const fetchProdutos = useCallback(() => {

        // if(categoriaId > 0) {
            axios
                // .get(`/api/produtos/categoria/${categoriaId}`)
                .get(`/api/carrinho/produtos`)
                .then((response) => {
                    setProdutos(response?.data?.data);
                })
                .catch((error) => {
                    console.error(error);
                    console.error(error?.response?.data?.message);
                });
        // } else {
        //     console.log('Categoria não encontrada')
        //     window.location.href = '/';
        // }

        return true;
    }, []);

    console.log(produtos);

    const fetchCategorias = useCallback(() => {
        axios
            .get('/api/categorias')
            .then((response) => {
                setCategorias(response?.data?.data);
            })
            .catch((error) => {
                console.error(error);
                console.error(error?.response?.data?.message);
            });
    }, []);

    useEffect(() => {
        fetchProdutos();
        fetchCategorias();
    }, []);


    // const handleAddOrEdit = (quantidade: number | null, produto_id: number | null) => {

    //     console.log(produto_id)
    //         const uri = `/api/carrinhos/produtos/${produto_id}`;

    //         console.log(uri);

    //         const response = axios.post(uri, {
    //             quantidade: quantidade,
    //             produto_id: produto_id,
    //         })

    //         console.log(response);

    //         return response;
    // }


    return (
        <>
            <Header carrinho={carrinhoSession} toggleDrawer={toggleDrawer} />

            <Box sx={{ mt: 8 , mb: 8, display: 'flex', justifyContent: 'center', alignItems: 'center', width: '100%' }} >
                <Box sx={{ alignItems: 'center', width: '80%' , display: 'flex', justifyContent: 'center'  }} >
                    <StepperPedido />
                </Box>
            </Box>

            <Snackbar open={openSnackbar} autoHideDuration={autoHideDuration} onClose={handleClose}>
                <Alert onClose={handleCloseSnackbar} severity={severity} variant="filled" sx={{ width: '100%' }}>
                    {message}
                </Alert>
            </Snackbar>

            <Footer />
        </>
    );
}
