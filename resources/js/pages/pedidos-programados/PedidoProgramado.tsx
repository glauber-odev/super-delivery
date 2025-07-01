import PedidoProgramadoInfo from '@/components/pedidos-programados/PedidoProgramadoInfo';
import Footer from '@/components/footer';
import Header from '@/components/header';
import { CarrinhoSession, PedidoProgramado as PedidoProgramadoType } from '@/types/api';
import Alert, { AlertColor } from '@mui/material/Alert';
import Snackbar, { SnackbarCloseReason } from '@mui/material/Snackbar';
import axios from 'axios';
import { useCallback, useEffect, useState } from 'react';

export default function PedidoProgramado({ userId, pedidoProgramadoId } : { userId : number, pedidoProgramadoId : number } ) {
    // const { props } = usePage<{ categoriaParam : string}>();
    // const categoriaParam = props.categoriaParam;
    // const [categorias, setCategorias] = useState<CategoriaType[] | null>(null);
    const [message, setMessage] = useState<string>('Ação realizada com sucesso');
    const [severity, setSeverity] = useState<AlertColor>('success');
    const [autoHideDuration, setAutoHideDuration] = useState<number>(6000);
    const [openSnackbar, setOpenSnackbar] = useState(false);
    const [carrinhoSession, setCarrinhoSession] = useState<CarrinhoSession>();
    const [openDrawer, setOpenDrawer] = useState(false);
    const [pedidoProgramado, setPedidoProgramado] = useState<PedidoProgramadoType>();

    // const [residencias, setResidencias] = useState<Residencia[] | null>(null);
    // const [residenciaId, setResidenciaId] = useState<number | null>(null);
    // const [frete, setFrete] = useState<FreteMelhorEnvio | null>(null);
    // const [tempoUnidades, setTempoUnidades] = useState<TempoUnidade[]>()
    // const [pedidoProgramado, setPedidoProgramado] = useState<PedidoProgramado>({
    //     flg_habilitado: false,
    //     periodicidade_id: null,
    //     tempo_unidade_id: null,
    //     flg_debito_automatico: false,
    // });
    

    // const handleSubmit = async () => {

    //     const confirm = await Swal.fire({
    //         title: 'Confirmar Pedido',
    //         text: 'Tem certeza que deseja completar este pedido.',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Confirmar',
    //         cancelButtonText: 'Cancelar',
    //         confirmButtonColor: '#d33',
    //         cancelButtonColor: '#3085d6',
    //         focusCancel: true,
    //     });

    //     if (confirm.isConfirmed) {
    //         const data = {
    //             ...pedidoProgramado,
    //             residencia_id: residenciaId,
    //             user_id: userId,
    //         }

    //         await axios.post('/api/pedidos/create-by-carrinho-session', data );
            
    //         return true;
    //     }

    //     return false;
    // }

    // const fetchResidencias = useCallback(async () => {
    //     try {
    //         const response = await axios.get(`/api/residencias/users/${userId}`);
    //         setResidencias(response?.data?.data);
    //     } catch (error) {
    //         console.error(error);
    //         console.error(error);
    //     }
    // }, [userId]);

    // useEffect(() => {
    //     fetchResidencias();
    // },[]);

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
        console.log(userId)
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

    const fetchPedidoProgramado = useCallback(() => {

        axios
            .get(`/api/pedidos-programados/${pedidoProgramadoId}`)
            .then((response) => {
                setPedidoProgramado(response?.data?.data);
            })
            .catch((error) => {
                console.error(error);
                console.error(error?.response?.data?.message);
            });

        return true;
    }, []);

    // const fetchCategorias = useCallback(() => {
    //     axios
    //         .get('/api/categorias')
    //         .then((response) => {
    //             setCategorias(response?.data?.data);
    //         })
    //         .catch((error) => {
    //             console.error(error);
    //             console.error(error?.response?.data?.message);
    //         });
    // }, []);

    // const fetchFreteByResidenciaId = useCallback((id: number | null) => {

    //     axios
    //         .get(`/api/residencias/buscar-dados-frete-by-residencia-id/${id}`)
    //         .then((response) => {
    //             setFrete(response?.data?.data);
    //         })
    //         .catch((error) => {
    //             console.error(error);
    //             console.error(error?.response?.data?.message);
    //         });

    //     return true;
    // }, [residenciaId]);

    // const handleResidencia = useCallback((id: number | null) => {
    //     setResidenciaId(id);
    //     fetchFreteByResidenciaId(id);
    // }, [residenciaId, fetchFreteByResidenciaId])

    
    // const fetchTempoUnidades = useCallback(() => {
    //     axios
    //         .get('/api/tempo-unidades')
    //         .then((response) => {
    //             setTempoUnidades(response?.data?.data);
    //         })
    //         .catch((error) => {
    //             console.error(error);
    //             console.error(error?.response?.data?.message);
    //         });
    // }, []);

    useEffect(() => {
        fetchCarrinho();
        fetchPedidoProgramado();
    }, []);

    return (
        <>
            <Header carrinho={carrinhoSession} toggleDrawer={toggleDrawer} />

            {pedidoProgramado && (
                <PedidoProgramadoInfo pedidoProgramado={pedidoProgramado} />
            )}

            <Snackbar open={openSnackbar} autoHideDuration={autoHideDuration} onClose={handleClose}>
                <Alert onClose={handleCloseSnackbar} severity={severity} variant="filled" sx={{ width: '100%' }}>
                    {message}
                </Alert>
            </Snackbar>

            <Footer />
        </>
    );
}
