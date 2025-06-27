import ResidenciaItem from '@/components/shared/ResidenciaItem';
import { Residencia } from '@/types/api';
import { Box } from '@mui/material';
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
                        Escolha sua residência de destino
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
                                    <ResidenciaItem residencia={residencia}/>
                                </MenuItem>
                            ))}
                        </TextField>
                </Box>
        </Box>
    );
};

export default FormResidencia;
