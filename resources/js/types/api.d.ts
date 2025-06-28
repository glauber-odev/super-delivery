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
    quantidade?: number | null;
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

export interface ProdutoGrid extends Produto {
    produto_imagem: ProdutoImagem;
    // produto_imagem: ProdutoImagem[];
};

export interface SnackbarGlobalProps {
    message : string;
    severity: AlertColor;
    autoHideDuration: number;
    openSnackbar: boolean;
}

export interface Carrinho {
    id?: number | string;
    titulo: string | null;
    total:  number | null;
    flg_favorito: boolean | null;
    user_id: number | null;
}

export interface CarrinhoProduto {
    id?: string | number;
    carrinho_id?: string | number;
    produto_id?: string | number;
    quantidade?: number | string;
}

export interface CarrinhoProdutoGrid extends CarrinhoProduto {
    id?: string | number;
    carrinho_id?: string | number;
    produto_id?: string | number;
}

export interface CarrinhoGridProps extends Carrinho {
    produtos?: CarrinhoProdutoGrid[];
}

export interface CarrinhoSession extends Carrinho {
    produtos?: ProdutoWithImg[];
}

export type ProdutoWithImg = {
    id?: number;
    nome: string | null;
    preco: string | number | undefined;
    cod_barras: string | null;
    saldo: number | null;
    categoria_id: number | undefined;
    descricao: string | null;
    produto_imagem: ProdutoImagem | null;
    quantidade?: number | null;
};

export interface Residencia {
    id?: number | null;
    rua: string | null;
    numero: number | string | null;
    complemento: string | null;
    bairro: string | null;
    cidade: string | null;
    cep: string | null;
    user_id: number | string | null;
    estado: Estado;
};

export interface Estado {
    id?: number | null;
    sigla: string | null;
    descricao: string | null;
}


export interface FreteMelhorEnvio {
    id?: number | null;
    price?: string | null;
    delivery_time?: string | null;
}

export interface PedidoProgramado {
    flg_habilitado: boolean | null;
    flg_debito_automatico: booelan | null;
    periodicidade_id?: number | null;
    tempo_unidade_id?: nubmer | null;
    periodicidade?: Periodicidade;
    tempo_unidade?: TempoUnidade;
}            

export interface Periodicidade {
    id?: number | null;
    descricao: string | null;
    tempoUnidades?: TempoUnidade[];
}

export interface TempoUnidade {
    id?: number | null;
    descricao: string | null;
    unidade: number | null;
    posicao_ordem: number | null;
    periodicidade_id: number | null;
    pedidoProgramados?: PedidoProgramado[];
}
