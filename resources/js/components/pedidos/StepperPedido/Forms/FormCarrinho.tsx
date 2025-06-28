import CarrinhoRealizar from '@/components/carrinho/CarrinhoRealizar';
import { CarrinhoSession, FreteMelhorEnvio } from '@/types/api';
import { Box } from '@mui/material';

type FormCarrinhoProps = {
    carrinhoSession: CarrinhoSession | null;
    frete: FreteMelhorEnvio | null ;
};



const FormCarrinho = ({ carrinhoSession, frete } : FormCarrinhoProps ) => {

    return (
        <Box sx={{ display: 'flex', justifyContent: 'center', alignItems: 'center', mt: 2 }} >
            <Box sx={{ height: '900px', width: '100%', padding: 3 }}>
                <CarrinhoRealizar carrinhoSession={carrinhoSession || undefined} frete={frete} />
            </Box>
        </Box>
    );
};

export default FormCarrinho;
