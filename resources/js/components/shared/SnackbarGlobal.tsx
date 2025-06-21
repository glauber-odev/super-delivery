import Alert, { AlertColor } from '@mui/material/Alert';
import Snackbar, { SnackbarCloseReason } from '@mui/material/Snackbar';
import { useState } from 'react';


interface SnackbarPops {
    message: string;
    severity: 'info' | 'success' | 'error' | 'question' |  'warning';
    openProp: boolean;
    autoHideDuration: number;
    variant: "filled" | "standard" | "outlined";
};


export function SnackbarGlobal({ 
    message = 'Ação realizada com sucesso',
    severity = 'success',
    openProp = false,
    autoHideDuration = 6000,
    variant = 'filled',
    }: SnackbarPops) {

    const [open, setOpen] = useState(openProp);

    const handleCloseSnackbar = (event?: React.SyntheticEvent | Event, reason?: SnackbarCloseReason) => {
    if (reason === 'clickaway') {
        return;
    }

    setOpen(false);
    };


    return (
        <Snackbar open={open} autoHideDuration={autoHideDuration} /*onClose={handleClose}*/ >
            <Alert onClose={handleCloseSnackbar} severity={(severity as AlertColor)} variant={variant} sx={{ width: '100%' }}>
                {message}
            </Alert>
        </Snackbar>
    );
}
