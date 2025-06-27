import { Residencia } from '@/types/api';
import { Box } from '@mui/material';
import FormControl from '@mui/material/FormControl';
import Grid from '@mui/material/Grid';
import MenuItem from '@mui/material/MenuItem';
import TextField from '@mui/material/TextField';
import Typography from '@mui/material/Typography';
import React from 'react';

type FormCreateProps = {
    residencias: Residencia[] | null;
    residenciaId: string | number | null;
    setResidenciaId: (id: number | null) => void;
};


const FormResidencia: React.FC<FormCreateProps> = ({ residencias, residenciaId, setResidenciaId }) => {

    return (
        <Box sx={{ display: 'flex', justifyContent: 'center', alignItems: 'center' }} >
                <Box sx={{ height: '500px', width: '100%', padding: 3 }}>                
                    <Typography variant="body1" sx={{ mb: 2 , mt: '100px' }}>
                        Esolha a residência de destino
                    </Typography>
                        <TextField
                            fullWidth
                            id="Esolha o a Residência"
                            select
                            value={residenciaId}
                            defaultValue={null}
                            onChange={(e) => {
                                if(e.target.value){
                                    console.log(e.target.value)
                                    setResidenciaId(+e.target.value);
                                }
                            }}
                            label="Residência"
                            required
                        >
                            {residencias?.map((residencia) => (
                                <MenuItem key={residencia.id} value={residencia?.id || undefined}>
                                    <Box sx={{ display: 'flex', justifyContent: 'space-between' }}>
                                        <Typography>
                                            {residencia.cep}
                                        </Typography>
                                        <Typography>
                                                {String(residencia.estado)} - {residencia.cidade}
                                        </Typography>
                                    </Box>
                                        <Typography>
                                                {residencia.bairro} - {residencia.numero}
                                        </Typography>
                                        <Typography>
                                                {residencia.complemento}
                                        </Typography>
                                </MenuItem>
                            ))}
                        </TextField>
                </Box>
        </Box>
    );
};

export default FormResidencia;
