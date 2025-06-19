import DashboardIcon from '@mui/icons-material/Dashboard';
import SearchIcon from '@mui/icons-material/Search';
import ShoppingCartIcon from '@mui/icons-material/ShoppingCart';
import Box from '@mui/material/Box';
import IconButton from '@mui/material/IconButton';
import Stack from '@mui/material/Stack';
import TextField from '@mui/material/TextField';
import Tooltip from '@mui/material/Tooltip';
import Typography from '@mui/material/Typography';
import { createTheme } from '@mui/material/styles';
import { Account } from '@toolpad/core/Account';
import { AppProvider, type Navigation } from '@toolpad/core/AppProvider';
import { DashboardLayout, ThemeSwitcher } from '@toolpad/core/DashboardLayout';
import { DemoProvider, useDemoRouter } from '@toolpad/core/internal';

const NAVIGATION: Navigation = [
    {
        kind: 'header',
        title: 'Main items',
    },
    {
        segment: 'dashboard',
        title: 'Dashboard',
        icon: <DashboardIcon />,
    },
    {
        segment: 'orders',
        title: 'Orders',
        icon: <ShoppingCartIcon />,
    },
];

const demoTheme = createTheme({
    cssVariables: {
        colorSchemeSelector: 'data-toolpad-color-scheme',
    },
    colorSchemes: { light: true, dark: true },
    breakpoints: {
        values: {
            xs: 0,
            sm: 600,
            md: 600,
            lg: 1200,
            xl: 1536,
        },
    },
});

function DemoPageContent({ pathname }: { pathname: string }) {
    return (
        <Box
            sx={{
                py: 4,
                display: 'flex',
                flexDirection: 'column',
                alignItems: 'center',
                textAlign: 'center',
            }}
        >
            <Typography>Dashboard content for {pathname}</Typography>
        </Box>
    );
}

function ToolbarActionsSearch() {
    return (
        <Stack direction="row">
            <Tooltip title="Search" enterDelay={1000}>
                <div>
                    <IconButton
                        type="button"
                        aria-label="search"
                        sx={{
                            display: { xs: 'inline', md: 'none' },
                        }}
                    >
                        <SearchIcon />
                    </IconButton>
                </div>
            </Tooltip>
            <TextField
                label="Search"
                variant="outlined"
                size="small"
                slotProps={{
                    input: {
                        endAdornment: (
                            <IconButton type="button" aria-label="search" size="small">
                                <SearchIcon />
                            </IconButton>
                        ),
                        sx: { pr: 0.5 },
                    },
                }}
                sx={{ display: { xs: 'none', md: 'inline-block' }, mr: 1 }}
            />
            <ThemeSwitcher />
            <Account />
        </Stack>
    );
}

function SidebarFooter() {
    return <Typography variant="caption" sx={{ m: 1, whiteSpace: 'nowrap', overflow: 'hidden' }}></Typography>;
}

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

interface DemoProps {
    /**
     * Injected by the documentation to work in an iframe.
     * Remove this when copying and pasting into your project.
     */
    window?: () => Window;
}

// export default function DashboardLayoutSlots(props: DemoProps) {
export default function Produtos(props: DemoProps) {
    const { window } = props;

    const router = useDemoRouter('/dashboard');

    // Remove this const when copying and pasting into your project.
    const demoWindow = window !== undefined ? window() : undefined;

    return (
        // Remove this provider when copying and pasting into your project.
        <DemoProvider window={demoWindow}>
            <AppProvider navigation={NAVIGATION} router={router} theme={demoTheme} window={demoWindow}>
                {/* preview-start */}
                <DashboardLayout
                    slots={{
                        appTitle: CustomAppTitle,
                        toolbarActions: ToolbarActionsSearch,
                        sidebarFooter: SidebarFooter,
                    }}
                >
                    <DemoPageContent pathname={router.pathname} />
                </DashboardLayout>
                {/* preview-end */}
            </AppProvider>
        </DemoProvider>
    );
}
