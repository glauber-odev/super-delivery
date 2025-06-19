import AppBar from '@mui/material/AppBar';
import Stack from '@mui/material/Stack';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';

 function CustomAppTitle() {
    return (
        <a href="/">
            <Stack direction="row" alignItems="center" spacing={2}>
                <img src="/logos/logo.svg" width="40px" />
                <Typography variant="h6">Super Delivery</Typography>
            </Stack>
        </a>
    );
}

function Header() {

    return (
    <AppBar position="static" color="transparent" elevation={1} sx={{boxShadow: 3}}>
      <Toolbar>
        <CustomAppTitle />
      </Toolbar>
    </AppBar>
    );
}

export default Header;
