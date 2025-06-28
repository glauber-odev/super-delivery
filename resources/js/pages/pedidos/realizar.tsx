import Footer from '@/components/footer';
import Header from '@/components/header';
import StepperPedido from '@/components/pedidos/StepperPedido/StepperPedido';
import { CarrinhoSession, Categoria as CategoriaType, FreteMelhorEnvio, PedidoProgramado, Periodicidade, Residencia, TempoUnidade } from '@/types/api';
import { usePage } from '@inertiajs/react';
import Alert, { AlertColor } from '@mui/material/Alert';
import Box from '@mui/material/Box';
import Snackbar, { SnackbarCloseReason } from '@mui/material/Snackbar';
import axios from 'axios';
import { useCallback, useEffect, useState } from 'react';

export default function Realizar({ userId } : { userId : number } ) {
    const { props } = usePage<{ categoriaParam : string}>();
    const categoriaParam = props.categoriaParam;
    // const [carrinho, setCarrinho] = useState<CarrinhoSession | null>(null);
    const [categorias, setCategorias] = useState<CategoriaType[] | null>(null);
    const [message, setMessage] = useState<string>('Ação realizada com sucesso');
    const [severity, setSeverity] = useState<AlertColor>('success');
    const [autoHideDuration, setAutoHideDuration] = useState<number>(6000);
    const [openSnackbar, setOpenSnackbar] = useState(false);
    const [carrinhoSession, setCarrinhoSession] = useState<CarrinhoSession>();
    const [openDrawer, setOpenDrawer] = useState(false);

    const [residencias, setResidencias] = useState<Residencia[] | null>(null);
    const [residenciaId, setResidenciaId] = useState<number | null>(null);
    const [frete, setFrete] = useState<FreteMelhorEnvio | null>(null);
    const [periodicidades, setPeriodicidades] = useState<Periodicidade[]>()
    const [tempoUnidades, setTempoUnidades] = useState<TempoUnidade[]>()
    const [pedidoProgramado, setPedidoProgramado] = useState<PedidoProgramado>({
        flg_habilitado: false,
        flg_debito_automatico: false,
        periodicidade_id: null,
        tempo_unidade_id: null,
    });
    

    const fetchResidencias = useCallback(async () => {
        try {
            const response = await axios.get(`/api/residencias/users/${userId}`);
            setResidencias(response?.data?.data);
        } catch (error) {
            console.error(error);
            console.error(error);
        }
    }, [userId]);

    useEffect(() => {
        fetchResidencias();
    },[]);

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

    const handlePedidoProgramado = (property: string, value: number | boolean | null) => {
        setPedidoProgramado({ ...pedidoProgramado, [property]: value });
    }

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

    const fetchFreteByResidenciaId = useCallback((id: number | null) => {

        axios
            .get(`/api/residencias/buscar-dados-frete-by-residencia-id/${id}`)
            .then((response) => {
                setFrete(response?.data?.data);
            })
            .catch((error) => {
                console.error(error);
                console.error(error?.response?.data?.message);
            });

        return true;
    }, [residenciaId]);

    const handleResidencia = useCallback((id: number | null) => {
        setResidenciaId(id);
        fetchFreteByResidenciaId(id);
    }, [residenciaId, fetchFreteByResidenciaId])

    
    const fetchTempoUnidades = useCallback(() => {
        axios
            .get('/api/tempo-unidades')
            .then((response) => {
                setTempoUnidades(response?.data?.data);
            })
            .catch((error) => {
                console.error(error);
                console.error(error?.response?.data?.message);
            });
    }, []);

    useEffect(() => {
        fetchCarrinho();
        fetchCategorias();
        fetchTempoUnidades();
    }, []);

    return (
        <>
            <Header carrinho={carrinhoSession} toggleDrawer={toggleDrawer} />

            <Box sx={{ mt: 8 , mb: 8, display: 'flex', justifyContent: 'center', alignItems: 'center', width: '100%' }} >
                <Box sx={{ alignItems: 'center', width: '80%' , display: 'flex', justifyContent: 'center'  }} >
                    <StepperPedido 
                        residencias={residencias}
                        residenciaId={residenciaId} 
                        handleResidencia={handleResidencia}
                        carrinhoSession={carrinhoSession || null}
                        frete={frete}
                        pedidoProgramadoData={pedidoProgramado}
                        handlePedidoProgramado={handlePedidoProgramado}
                        tempoUnidades={tempoUnidades}
                    />
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
