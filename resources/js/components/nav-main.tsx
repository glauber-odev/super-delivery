import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Categoria } from '@/types/api';
import { Link, usePage } from '@inertiajs/react';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import {
    Accordion,
    AccordionDetails,
    AccordionSummary,
    List,
    ListItem,
    ListItemText,
    Tooltip
} from '@mui/material';
import axios from 'axios';
import { useCallback, useEffect, useState } from 'react';

export function NavMain({ items = [] }: { items: NavItem[] }) {
    const page = usePage();
    const [categorias, setCategorias] = useState<Categoria[]>();

    const fetchCategorias = useCallback(() => {
        axios
            .get('/api/categorias')
            .then((response) => {
                setCategorias(response?.data?.data);
            })
            .catch((error) => {
                console.error(error);
                console.error(error?.response?.data?.message);
            });
    }, []);

    useEffect(() => {
        fetchCategorias();
    },[fetchCategorias])

    return (
        <SidebarGroup className="px-2 py-0">
            <SidebarGroupLabel>Plataforma</SidebarGroupLabel>
            <SidebarMenu>
                {items.map((item) => (
                    <SidebarMenuItem key={item.title}>
                        <SidebarMenuButton asChild isActive={page.url.startsWith(item.href)} tooltip={{ children: item.title }}>
                            <Link href={item.href} prefetch>
                                {item.icon && <item.icon />}
                                <span>{item.title}</span>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                ))}
            <SidebarMenuItem key={456}>
                <Accordion disableGutters elevation={0}>
                    <AccordionSummary
                    expandIcon={<ExpandMoreIcon />}
                    aria-controls="categorias-content"
                    id="categorias-header"
                    >
                    <Tooltip title="Categorias" placement="right">
                        <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                        <span>{'Categorias'}</span>
                        </div>
                    </Tooltip>
                    </AccordionSummary>

                    <AccordionDetails>
                    <List dense disablePadding>
                        {categorias?.map((categoria) => (
                        <ListItem key={categoria.id} disablePadding>
                            <Link href={`/produtos/categoria/${categoria.descricao?.toLowerCase()}`} prefetch>
                                <ListItemText primary={categoria.descricao} inset />
                            </Link>
                        </ListItem>
                        ))}
                    </List>
                    </AccordionDetails>
                </Accordion>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarGroup>
    );
}
