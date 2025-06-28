import { CarrinhoSession, FreteMelhorEnvio } from '@/types/api';
import { Typography } from '@mui/material';
import Box from '@mui/material/Box';
import Divider from '@mui/material/Divider';
import DataGridRealizar from './DataGridRealizar';
import LocalShippingIcon from '@mui/icons-material/LocalShipping';
import { green } from '@mui/material/colors';


interface CarrinhoDrawer {
    carrinhoSession: CarrinhoSession | undefined;
    frete: FreteMelhorEnvio | null ;
}

export default function CarrinhoRealizar({ carrinhoSession, frete }: CarrinhoDrawer) {

    const formatFloat2Money = (value: number | Intl.StringNumericLiteral) => {
    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
    });

    return formatter.format(value);
    };

    return (
        <Box sx={{ height: '100%', boxShadow: '7', }} >
            <Box sx={{ height: '11%',  p:2, boxShadow: '7', }}>
                <Typography variant='h5' >
                    Carrinho
                </Typography>

                {carrinhoSession?.titulo && (
                    <Typography variant='body1'>
                        {carrinhoSession?.titulo}
                    </Typography>
                )}


            </Box>
            <Divider />
            <Box sx={{ height: "68%", }} role="presentation" >
                <DataGridRealizar produtos={carrinhoSession?.produtos || null} />
            </Box>
            <Divider />
            <Box sx={{ pl:3, pr: 3, mt: 4,  height: '10%' }} >
                <Box sx={{ display: 'flex', flexDirection: 'row' }} >
                    <span color='green' >
                        <LocalShippingIcon fontSize='small' sx={{ color: green[500], mr: 1, mb: 2 }}/>
                    </span>
                    <Typography variant='body2' color={green[500]}>Chegará em aproximadamente {frete?.delivery_time} dias</Typography>
                </Box>
                <Box sx={{ display: 'flex', justifyContent: 'space-between' }} >
                    <Typography variant='body1' color='gray' >Subtotal :</Typography>
                    <Typography variant='body1' color='gray'>{formatFloat2Money(carrinhoSession?.total || 0)}</Typography>
                </Box>
                <Box sx={{ display: 'flex', justifyContent: 'space-between' }} >
                    <Typography variant='body1' color='gray' >Frete :</Typography>
                    <Typography variant='body1' color='gray'>{formatFloat2Money(Number(frete?.price) || 0)}</Typography>
                </Box>
                <Box sx={{ display: 'flex', justifyContent: 'space-between', pt: 2, pb: 2, }} >
                    <Typography variant='h6'>Total :</Typography>
                    <Typography variant='h6'>{formatFloat2Money(Number(carrinhoSession?.total) + Number(frete?.price) || 0)}</Typography>
                </Box>
            </Box>
        </Box>
    );
}
