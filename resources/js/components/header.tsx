import { CarrinhoSession } from '@/types/api';
import AccountCircleIcon from '@mui/icons-material/AccountCircle';
import SearchIcon from '@mui/icons-material/Search';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import { Badge } from '@mui/material';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Button from '@mui/material/Button';
import IconButton from '@mui/material/IconButton';
import InputBase from '@mui/material/InputBase';
import Stack from '@mui/material/Stack';
import { alpha, styled } from '@mui/material/styles';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import useMediaQuery from '@mui/material/useMediaQuery';

const categorias = [
    { nome: 'Ofertas', url: '/ofertas' },
    { nome: 'Hortifruti', url: '/hortifruti' },
    { nome: 'Padaria', url: '/padaria' },
    { nome: 'Bebidas', url: '/bebidas' },
    { nome: 'Carnes', url: '/carnes' },
    { nome: 'Limpeza', url: '/limpeza' },
];

interface HeaderProps {
    carrinho?: CarrinhoSession;
    toggleDrawer: (open: boolean) => (event: React.KeyboardEvent | React.MouseEvent) => void;
}

// Estilo para o campo de busca
const Search = styled('div')(({ theme }) => ({
    position: 'relative',
    borderRadius: 8,
    backgroundColor: alpha(theme.palette.common.black, 0.05),
    '&:hover': {
        backgroundColor: alpha(theme.palette.common.black, 0.1),
    },
    marginLeft: 0,
    width: '100%',
    [theme.breakpoints.up('sm')]: {
        width: '400px',
    },
}));

const SearchIconWrapper = styled('div')(({ theme }) => ({
    padding: theme.spacing(0, 2),
    height: '100%',
    position: 'absolute',
    pointerEvents: 'none',
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
}));

const StyledInputBase = styled(InputBase)(({ theme }) => ({
    color: 'inherit',
    width: '100%',
    paddingLeft: `calc(1em + ${theme.spacing(4)})`,
}));

function CustomAppTitle() {
    return (
        <a href="/" style={{ textDecoration: 'none', color: 'inherit' }}>
            <Stack direction="row" alignItems="center" spacing={1}>
                <img
                    src="/logos/logo.svg"
                    alt="Logo Super Delivery"
                    width="40"
                    height="40"
                    style={{ transition: 'transform 0.2s', cursor: 'pointer' }}
                    onMouseOver={(e) => (e.currentTarget.style.transform = 'scale(1.1)')}
                    onMouseOut={(e) => (e.currentTarget.style.transform = 'scale(1.0)')}
                />
                <Typography variant="h6" fontWeight="bold">
                    Super Delivery
                </Typography>
            </Stack>
        </a>
    );
}

function Header({ carrinho, toggleDrawer }: HeaderProps) {
    const isMobile = useMediaQuery('(max-width:600px)');

    return (
        <AppBar position="static" color="default" elevation={2} sx={{ backgroundColor: '#fff' }}>
            {/* Top bar */}
            <Toolbar sx={{ flexWrap: 'wrap', justifyContent: 'space-between', gap: 2 }}>
                {/* Left: Logo */}
                <Box sx={{ flex: 1, display: 'flex', justifyContent: 'flex-start' }}>
                    <CustomAppTitle />
                </Box>

                {/* Center: Search (oculto em mobile) */}
                {!isMobile && (
                    <Box sx={{ flex: 2, display: 'flex', justifyContent: 'center' }}>
                        <Search>
                            <SearchIconWrapper>
                                <SearchIcon />
                            </SearchIconWrapper>
                            <StyledInputBase placeholder="Buscar produtos…" inputProps={{ 'aria-label': 'search' }} />
                        </Search>
                    </Box>
                )}

                {/* Right: Ícones */}
                <Box sx={{ flex: 1, display: 'flex', justifyContent: 'flex-end' }}>
                    <IconButton href='/settings/profile' size="large" color="inherit" aria-label="Conta do usuário">
                        <AccountCircleIcon />
                    </IconButton>
                    <IconButton onClick={toggleDrawer(true)} size="large" color="inherit" aria-label="Carrinho de compras">
                        <Badge badgeContent={carrinho?.produtos?.length || 0} color="error">
                            <ShoppingCartIcon />
                        </Badge>
                    </IconButton>
                </Box>
            </Toolbar>

            {/* Categorias */}
            <Box
                sx={{
                    display: 'flex',
                    justifyContent: 'center',
                    px: 2,
                    py: 1,
                    borderTop: '1px solid #eee',
                    borderBottom: '1px solid #eee',
                    backgroundColor: '#fafafa',
                    flexWrap: 'wrap',
                }}
            >
                <Stack direction="row" spacing={2} flexWrap="wrap">
                    {categorias.map((categoria) => (
                        <Button
                            key={categoria.url}
                            href={categoria.url}
                            color="inherit"
                            sx={{
                                textTransform: 'none',
                                fontWeight: 500,
                                fontSize: '0.95rem',
                                '&:hover': {
                                    color: '#1976d2',
                                    backgroundColor: 'transparent',
                                },
                            }}
                        >
                            {categoria.nome}
                        </Button>
                    ))}
                </Stack>
            </Box>
        </AppBar>
    );
}

export default Header;
