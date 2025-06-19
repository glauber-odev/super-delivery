import Header from '@/components/header';
import DataGridManage from '@/components/produtos/DataGridManage/DataGridManage';
import FormCreate from '@/components/produtos/FormCreate/FormCreate';
import { Categoria } from '@/types/api';
import Box from '@mui/material/Box';
import axios from 'axios';
import { useEffect, useState } from 'react';

export default function Manage() {
    const [categorias, setCategorias] = useState<Categoria[] | null>(null);

    useEffect(() => {
        axios
        .get('/api/categorias')
        .then((response) => {
            setCategorias(response?.data?.data);
            console.log(categorias);
        })
        .catch((error) => {
            console.error(error);
            console.error(error?.response?.data?.message); // Corrigido para acessar corretamente a mensagem de erro
        });
    }, []);


    return (
        <>
            <Header />

            <Box sx={{ mt: 8 }}>
                <FormCreate categorias={categorias} />
            </Box>
            <Box sx={{ mt: 8, width: '100%', display: 'flex', justifyContent: 'center' }}>
                <DataGridManage />
            </Box>
        </>
    );
}
