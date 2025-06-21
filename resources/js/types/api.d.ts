import { AlertColor } from "@mui/material/Alert";


export type Categoria = {
    id: number | null,
    descricao: string | null,
    sigla: string | null,
};

export type Produto = {
    id?: number;
    nome: string | null;
    preco: string | number | undefined;
    cod_barras: string | null;
    saldo: number | null;
    categoria_id: number | undefined;
    descricao: string | null;
    imagem: File | null;
};

export interface Produto {
    id?: number;
    nome: string | null;
    preco: string | number | undefined;
    cod_barras: string | null;
    saldo: number | null;
    categoria_id: number | undefined;
    descricao: string | null;
    imagem: File | null;
};

export type Imagem = {
    id?: number;
    nome_original: string | null;
    caminho_arquivo: string | null;
    created_at: string | null;
    updated_at: string | null;
};

export interface ProdutoImagem {
    id?: number;
    posicao_lista: number | null;
    imagem_id: number | null;
    imagens: Imagem;
    // imagens: Imagem[];
};

export interface ProdutoDataGrid extends Produto {
    produto_imagem: ProdutoImagem;
    // produto_imagem: ProdutoImagem[];
};

export interface SnackbarGlobalProps {
    message : string;
    severity: AlertColor;
    autoHideDuration: number;
    openSnackbar: boolean;
}