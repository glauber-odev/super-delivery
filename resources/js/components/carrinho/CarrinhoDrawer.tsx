import { CarrinhoSession } from '@/types/api';
import { Typography } from '@mui/material';
import Box from '@mui/material/Box';
import Button from '@mui/material/Button';
import Divider from '@mui/material/Divider';
import Drawer from '@mui/material/Drawer';
import List from '@mui/material/List';
import * as React from 'react';
import CarrinhoDrawerItem from './CarrinhoDrawerItem';


interface CarrinhoDrawer {
    toggleDrawer: (open: boolean) => (event: React.KeyboardEvent | React.MouseEvent) => void;
    open: boolean;
    carrinhoSession: CarrinhoSession | undefined;
    handlePushOrModifyProduto: (quantidade: number | null, produto_id: number | null, carrinho_id?: number) => void;
}

export default function CarrinhoDrawer({ open, toggleDrawer, carrinhoSession, handlePushOrModifyProduto }: CarrinhoDrawer) {

    const formatFloat2Money = (value: number | Intl.StringNumericLiteral) => {
    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
    });

    return formatter.format(value);
    };

    const handleCarrinhoUpdate = (quantidade: number | null, produto_id: number | null) => {

        if(carrinhoSession?.id) {
            handlePushOrModifyProduto(quantidade, produto_id, Number(carrinhoSession?.id) );
        }

        handlePushOrModifyProduto(quantidade, produto_id);
    }

    const anchor = 'left';

    return (
        <Drawer 
        anchor={anchor} 
        open={open} 
        onClose={toggleDrawer(false)} >
            <Box sx={{ height: '100%', width: 500 , }} >
                <Box sx={{ height: '15%', background: '#f3864f', p:2, boxShadow: '7', }}>
                    <Typography variant='h5' color='white' >
                        Carrinho
                    </Typography>

                    {carrinhoSession?.titulo && (
                        <Typography variant='body1'>
                            {carrinhoSession?.titulo}
                        </Typography>
                    )}


                </Box>
                <Divider />
                <Box sx={{ height: "65%", }} role="presentation" >
                    <List sx={{ height: "100%", maxHeight: "100%", overflow: 'auto', bgcolor: 'background.paper', width: '100%' }} >
                        {carrinhoSession?.produtos?.map((produto, index) => (
                            <>
                                <CarrinhoDrawerItem key={index} produto={produto} handleCarrinhoUpdate={handleCarrinhoUpdate}  />
                                <Divider variant="inset" />
                            </>
                        ))}
                    </List>
                </Box>
                <Divider />
                <Box sx={{ pl:3, pr: 3, height: '18.8%',
                    //  background: 'blue' 
                        }} >
                    <Box sx={{ display: 'flex', justifyContent: 'space-between', pt: 2, pb: 2, }} >
                        <Typography variant='h6'>Valor :</Typography>
                        <Typography variant='h6'>{formatFloat2Money(carrinhoSession?.total || 0)}</Typography>
                    </Box>
                    <Box sx={{ display: 'flex', flexDirection: 'column', justifyContent: 'end' }}>
                        <Button variant='contained' color='success' href='/pedidos/realizar' >
                            Realizar Pedido
                        </Button>
                    </Box>   
                </Box>
            </Box>
        </Drawer>
    );
}
