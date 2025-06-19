import Header from '@/components/header';
import DataGridManage from '@/components/produtos/DataGridManage/DataGridManage';
import FormCreate from '@/components/produtos/FormCreate/FormCreate';
import Box from '@mui/material/Box';

export default function Manage() {
    return (
        <>
            <Header />

            <Box sx={{ mt: 8 }}>
                <FormCreate />
            </Box>
            <Box sx={{ mt: 8, width: '100%', display: 'flex', justifyContent: 'center', textAlign: 'center' }}>
                <DataGridManage />
            </Box>
        </>
    );
}
