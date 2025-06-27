import { Residencia } from '@/types/api';
import { Box, Paper } from '@mui/material';
import Typography from '@mui/material/Typography';
import RoomOutlinedIcon from '@mui/icons-material/RoomOutlined';

const ResidenciaItem = ({ residencia }: { residencia: Residencia | null }) => {
    return (
        <Paper sx={{ width: '100%', border: '1px solid black', p: 2 }}>
            <Box sx={{ display: 'flex', justifyContent: 'space-between', mb: 1 }}>
                <Typography>{residencia?.cep}</Typography>
                <Typography>
                    {String(residencia?.estado?.descricao)} - {residencia?.cidade}
                </Typography>
                <RoomOutlinedIcon />
            </Box>
            <Typography sx={{ mb: 1 }}>
                {residencia?.bairro} - {residencia?.numero}
            </Typography>
            <Typography>{residencia?.complemento}</Typography>
        </Paper>
    );
};

export default ResidenciaItem;
