import CarrinhoDrawer from '@/components/carrinho/CarrinhoDrawer';
import Footer from '@/components/footer';
import Header from '@/components/header';
import GridProdutos from '@/components/produtos/GridProdutos/GridProdutos';
import { CarrinhoSession, Categoria as CategoriaType, ProdutoDataGrid } from '@/types/api';
import { usePage } from '@inertiajs/react';
import Alert, { AlertColor } from '@mui/material/Alert';
import Box from '@mui/material/Box';
import Snackbar, { SnackbarCloseReason } from '@mui/material/Snackbar';
import axios from 'axios';
import { useCallback, useEffect, useState } from 'react';

export default function Categoria() {
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
        const categoriaId = matchCategoriaId(categoriaParam);

        if(categoriaId > 0) {
            axios
                .get(`/api/produtos/categoria/${categoriaId}`)
                .then((response) => {
                    setProdutos(response?.data?.data);
                })
                .catch((error) => {
                    console.error(error);
                    console.error(error?.response?.data?.message);
                });
        } else {
            console.log('Categoria não encontrada')
            window.location.href = '/';
        }

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

    const handlePushOrModifyProduto = useCallback(
        async (quantidade: number | null, produto_id: number | null, carrinho_id = -1 ) => {

            let response;
            if(carrinho_id > 0 ) {
                // quando já existe no banco
                response = await handleAttachOrUpdate(quantidade, produto_id, carrinho_id);
            } else {
                // quando só existe na seção
                response = await handleAddOrEdit(quantidade, produto_id);
            }

            if(response.status == 200 || response.status == 201) {
                setCarrinhoSession(response?.data?.carrinho);
            }

    },[]);

    const handleAddOrEdit = (quantidade: number | null, produto_id: number | null) => {

        console.log(produto_id)
            const uri = `/api/carrinhos/produtos/${produto_id}`;

            console.log(uri);

            const response = axios.post(uri, {
                quantidade: quantidade,
                produto_id: produto_id,
            })

            console.log(response);

            return response;
    }

    // quando já existe no banco de dados
    const handleAttachOrUpdate = (quantidade: number | null, produto_id: number | null, carrinho_id: number) => {

            const uri = `/api/carrinhos/${carrinho_id}/produtos/${produto_id}`;

            const response = axios.post(uri, {
                quantidade: quantidade,
                produto_id: produto_id,
                carrinho_id: carrinho_id,
            })

            return response;
    }

    // TODO: adaptar ao fetch categorias
    function matchCategoriaId (categoria : string) {
        console.log(categorias);
        switch (categoria) {
            case 'mercearia': return 1;
            case 'bebidas': return 2;
            case 'carnes': return 3;
            case 'limpeza': return 4;
            case 'laticinios': return 5;
            case 'congelados': return 6;
            case 'hortifruti': return 7;
            case 'bomboniere': return 8;
            case 'outros': return 9;                    
            default:
                return -1;
                break;
        }
    }

    return (
        <>
            <Header carrinho={carrinhoSession} toggleDrawer={toggleDrawer} />

            <CarrinhoDrawer 
            open={openDrawer} 
            toggleDrawer={toggleDrawer}
            carrinhoSession={carrinhoSession}
            handlePushOrModifyProduto={handlePushOrModifyProduto}
            />

            <Box sx={{ mt: 8 , mb: 8, display: 'flex', justifyContent: 'center', alignItems: 'center', width: '100%' }} >
                <Box sx={{ alignItems: 'center', width: '80%' , display: 'flex', justifyContent: 'center'  }} >
                    <GridProdutos produtos={produtos} handleSnackbar={handleSnackbar} handlePushOrModifyProduto={handlePushOrModifyProduto} />
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
