import Footer from '@/components/footer';
import Header from '@/components/header';
import DataGridManage from '@/components/produtos/DataGridManage/DataGridManage';
import FormCreate from '@/components/produtos/FormCreate/FormCreate';
import { CarrinhoSession, Categoria, ProdutoDataGrid } from '@/types/api';
import Alert, { AlertColor } from '@mui/material/Alert';
import Box from '@mui/material/Box';
import Snackbar, { SnackbarCloseReason } from '@mui/material/Snackbar';
import axios from 'axios';
import { useCallback, useEffect, useState } from 'react';

export default function Manage() {
    const [produtos, setProdutos] = useState<ProdutoDataGrid[] | null>(null);
    const [categorias, setCategorias] = useState<Categoria[] | null>(null);
    const [message, setMessage] = useState<string>('Ação realizada com sucesso');
    const [severity, setSeverity] = useState<AlertColor>('success');
    const [autoHideDuration, setAutoHideDuration] = useState<number>(6000);
    const [openSnackbar, setOpenSnackbar] = useState(false);
    const [carrinhoSession, setCarrinhoSession] = useState<CarrinhoSession>();

    const handleCloseSnackbar = (event?: React.SyntheticEvent | Event, reason?: SnackbarCloseReason) => {
        if (reason === 'clickaway') {
            return;
        }

        setOpenSnackbar(false);
    };

    
    const fetchCarrinho = useCallback(() => {

        axios
            .get(`/api/carrinhos/produtos`)
            .then((response) => {
                setCarrinhoSession(response?.data?.carrinho);
            })
            .catch((error) => {
                console.error(error);
                console.error(error?.response?.data?.message);
            });

        return true;
    }, []);

    const handleSnackbar = useCallback(
        (message = 'Ação realizada com sucesso', severity = 'success' as AlertColor, autoHideDuration = 6000) => {
            setOpenSnackbar(true);
            setMessage(message);
            setSeverity(severity);
            setAutoHideDuration(autoHideDuration);

            setTimeout(() => {
                handleCloseSnackbar();
            }, autoHideDuration);
        },
        [openSnackbar, message, severity, autoHideDuration],
    );

    const handleClose = () => {
        setOpenSnackbar(false);
    };

    const fetchProdutos = useCallback(() => {
        axios
            .get('/api/produtos')
            .then((response) => {
                setProdutos(response?.data?.data);
            })
            .catch((error) => {
                console.error(error);
                console.error(error?.response?.data?.message);
            });
        return true;
    }, []);

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
        fetchCarrinho();
    }, []);

    return (
        <>
            <Header carrinho={carrinhoSession} />

            <Box sx={{ mt: 8 }}>
                <FormCreate categorias={categorias} fetchProdutos={fetchProdutos} handleSnackbar={handleSnackbar} />
            </Box>
            <Box sx={{ mt: 8, width: '100%', display: 'flex', justifyContent: 'center' }}>
                <DataGridManage produtos={produtos} categorias={categorias} fetchProdutos={fetchProdutos} handleSnackbar={handleSnackbar} />
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
