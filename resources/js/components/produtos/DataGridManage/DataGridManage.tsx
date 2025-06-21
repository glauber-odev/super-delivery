import { Categoria, ProdutoDataGrid } from '@/types/api';
import { useTheme } from '@emotion/react';
import { AlertColor } from '@mui/material/Alert';
import Box from '@mui/material/Box';
import Button from '@mui/material/Button';
import { createTheme, ThemeProvider } from '@mui/material/styles';
import { DataGrid, GridCellParams, GridColDef } from '@mui/x-data-grid';
import { ptBR } from '@mui/x-data-grid/locales';
import axios from 'axios';
import * as React from 'react';
import Swal from 'sweetalert2';
import ModalEdit from './ModalEdit';
import ImageIcon from '@mui/icons-material/Image';

const formatFloat2Money = (value: number | Intl.StringNumericLiteral) => {
    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
    });

    return formatter.format(value);
};

export default function DataGridManage({
    produtos,
    categorias,
    fetchProdutos,
    handleSnackbar,
}: {
    produtos: ProdutoDataGrid[] | null;
    categorias: Categoria[] | null;
    fetchProdutos: () => void;
    handleSnackbar: (message?: string, severity?: AlertColor, autoHideDuration?: number, openSnackbar?: boolean) => void;
}): React.JSX.Element {
    const [produtoEdit, setProdutoEdit] = React.useState<ProdutoDataGrid>();
    const [open, setOpen] = React.useState<boolean>(false);

    const handleOpen = () => {
        setOpen(true);
    };
    const handleClose = () => {
        setOpen(false);
    };

    const existingTheme = useTheme();
    const theme = React.useMemo(
        () =>
            createTheme({}, ptBR, existingTheme, {
                direction: 'ltr',
            }),
        [existingTheme],
    );

    const deleteProduto = async (id: number | string) => {
        const confirm = await Swal.fire({
            title: 'Excluir Produto',
            text: 'Tem certeza? Esta ação não pode ser desfeita.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            focusCancel: true,
        });

        if (confirm.isConfirmed) {
            try {
                const response = await axios.delete('/api/produtos/' + id);

                if (response.status == 200 || response.status == 201) {
                    fetchProdutos();
                    handleSnackbar(response.data?.message);
                    console.log('Excluído com sucesso');
                    console.log(response);
                } else {
                    fetchProdutos();
                    handleSnackbar(response.data?.message, 'error');
                    console.log(response);
                }
            } catch (error) {
                console.log(error);
                handleSnackbar('Ocorreu algum erro, tente mais tarde.', 'error');
            }
        }
    };

    const handleDelete = (id: string | number) => {
        deleteProduto(id);
    };

    const columns: GridColDef<ProdutoDataGrid>[] = [
        { field: 'id', headerName: 'ID', headerAlign: 'center', align: 'center', width: 90 },
        {
            field: 'imagemProduto',
            headerName: 'Imagem',
            width: 100,
            // editable: true,
            // renderCell: ((row: GridCellParams) as ProdutoDataGrid) => (
            renderCell: (row: GridCellParams) => {
            // renderCell: (row: GridBaseColDef<ProdutoDataGrid>) => (
            const produto = row.row as ProdutoDataGrid;
            const path = () => {
                const prefix = import.meta.env.BASE_URL
                let rest = null;
                if(produto?.produto_imagem?.imagens.caminho_arquivo){
                    rest = "storage/images/produtos/"+produto?.produto_imagem?.imagens.caminho_arquivo;
                }

                return rest ? prefix + rest : '';
            }

            return (
                <Box key={row.id} sx={{ display: 'flex', justifyContent: 'center', alignItems: 'center', p: 2 , width: '100%', height: '100%' }}>
                    {path() ? <img src={path()} width={'100%'} height={'100%'}  /> :  <ImageIcon />}
                </Box>
            )

        },
        },
        {
            field: 'nome',
            headerName: 'Nome',
            width: 460,
            // editable: true,
        },
        {
            field: 'saldo',
            headerName: 'Saldo',
            type: 'number',
            width: 110,
            // editable: true,
        },
        {
            field: 'preco',
            headerName: 'Preço',
            type: 'number',
            width: 110,
            // editable: true,
            valueGetter: (value, row) => `${formatFloat2Money(Number(row.preco) || 0.0)}`,
        },
        {
            field: 'acoes',
            headerName: 'Ações',
            description: 'This column has a value getter and is not sortable.',
            sortable: false,
            width: 200,
            headerAlign: 'center',
            renderCell: (row: GridCellParams) => (
                <Box key={row.id} sx={{ display: 'flex', justifyContent: 'space-between', p: 2 }}>
                    <Button
                        size="small"
                        variant="contained"
                        color="info"
                        onClick={() => {
                            handleEditModal(row.row as ProdutoDataGrid);
                        }}
                    >
                        Editar
                    </Button>
                    <Button
                        size="small"
                        variant="contained"
                        color="error"
                        onClick={() => {
                            handleDelete(row.id);
                        }}
                    >
                        Excluir
                    </Button>
                </Box>
            ),
        },
    ];

    const handleEditModal = (produto: ProdutoDataGrid) => {
        setProdutoEdit(produto);
        handleOpen();
    };

    const rows: ProdutoDataGrid[] = produtos ?? [];

    return (
        <ThemeProvider theme={theme}>
            <Box sx={{ height: 600, width: '80%' }}>
                <DataGrid
                    loading={rows.length < 1}
                    rows={rows}
                    columns={columns}
                    initialState={{
                        pagination: {
                            paginationModel: {
                                pageSize: 10,
                            },
                        },
                    }}
                    rowHeight={60}
                />
            </Box>
            <ModalEdit
                categorias={categorias}
                open={open}
                produto={produtoEdit}
                handleClose={handleClose}
                fetchProdutos={fetchProdutos}
                handleSnackbar={handleSnackbar}
            />
        </ThemeProvider>
    );
}
