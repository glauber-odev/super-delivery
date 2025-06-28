import { ProdutoDataGrid, ProdutoWithImg } from '@/types/api';
import { useTheme } from '@emotion/react';
import ImageIcon from '@mui/icons-material/Image';
import Box from '@mui/material/Box';
import { createTheme, ThemeProvider } from '@mui/material/styles';
import { DataGrid, GridCellParams, GridColDef } from '@mui/x-data-grid';
import { ptBR } from '@mui/x-data-grid/locales';
import * as React from 'react';

const formatFloat2Money = (value: number | Intl.StringNumericLiteral) => {
    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
    });

    return formatter.format(value);
};

export default function DataGridRealizar({
    produtos,
}: {
    produtos: ProdutoWithImg[] | null;
}): React.JSX.Element {

    const existingTheme = useTheme();
    const theme = React.useMemo(
        () =>
            createTheme({}, ptBR, existingTheme, {
                direction: 'ltr',
            }),
        [existingTheme],
    );

    const columns: GridColDef<ProdutoWithImg>[] = [
        { field: 'id', headerName: 'ID', headerAlign: 'center', align: 'center', width: 90 },
        {
            field: 'imagemProduto',
            headerName: 'Imagem',
            width: 130,
            renderCell: (row: GridCellParams) => {
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
            width: 580,
            // editable: true,
        },
        {
            field: 'quantidade',
            headerName: 'Quantidade',
            headerAlign: 'center',
            align: 'center',
            type: 'number',
            width: 110,
            // editable: true,
        },
        {
            field: 'total',
            headerName: 'Total',
            headerAlign: 'center',
            align: 'center',
            type: 'number',
            width: 110,
            // editable: true,
            valueGetter: (value, row) => `${formatFloat2Money(Number(row.quantidade) * Number(row.preco) || 0.0)}`,
        },
    ];

    const rows: ProdutoWithImg[] = produtos ?? [];

    return (
        <ThemeProvider theme={theme}>
            <Box sx={{ height: '100%' }}>
                <DataGrid
                    loading={rows.length < 1}
                    rows={rows}
                    columns={columns}
                    hideFooter
                    hideFooterPagination={true}
                    rowHeight={130}
                    
                />
            </Box>
        </ThemeProvider>
    );
}
