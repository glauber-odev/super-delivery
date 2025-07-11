// import Header from '@/components/header';
import { Categoria } from '@/types/api';
import { AlertColor } from '@mui/material/Alert';
import Box from '@mui/material/Box';
import Button from '@mui/material/Button';
import FormControl from '@mui/material/FormControl';
import Grid from '@mui/material/Grid';
import MenuItem from '@mui/material/MenuItem';
import Paper from '@mui/material/Paper';
import TextareaAutosize from '@mui/material/TextareaAutosize';
import TextField from '@mui/material/TextField';
import Typography from '@mui/material/Typography';
import axios from 'axios';
import React, { ChangeEvent, useCallback, useRef, useState } from 'react';
import { Controller, SubmitHandler, useForm } from 'react-hook-form';
import { NumericFormat } from 'react-number-format';

type FormCreateProps = {
    categorias: Categoria[] | null;
    fetchProdutos: () => void;
    handleSnackbar: (message?: string, severity?: AlertColor, autoHideDuration?: number, openSnackbar?: boolean) => void;
};

type FormValues = {
    nome: string | null;
    preco: string | number | undefined;
    cod_barras: string | null;
    saldo: number | null;
    categoria_id: number | undefined;
    descricao: string | null;
    imagem: File | null;
};

const initialValues: FormValues = {
    nome: null,
    preco: '',
    saldo: null,
    cod_barras: null,
    categoria_id: 1,
    descricao: '',
    imagem: null,
};

const FormCreate: React.FC<FormCreateProps> = ({ categorias, fetchProdutos, handleSnackbar }) => {
    const {
        // reset,
        control,
        handleSubmit,
        formState: { errors },
    } = useForm<FormValues>();
    const [data, setData] = useState<FormValues>(initialValues);
    const [preco, setPreco] = useState<number | undefined>(0.0);
    const [file, setFile] = useState<File | null>(null);
    const fileInputRef = useRef<HTMLInputElement | null>(null);

    const onSubmit: SubmitHandler<FormValues> = useCallback(
        async (data: FormValues) => {
            setData({ ...data, preco: preco, imagem: file });

            const formData = new FormData();
            formData.set('nome', data.nome || '');
            formData.set('preco', preco?.toString() || '');
            formData.set('saldo', data.saldo?.toString() || '');
            formData.set('cod_barras', data.cod_barras?.toString() || '');
            formData.set('categoria_id', data.categoria_id?.toString() || '');
            formData.set('descricao', data.descricao || '');
            formData.set('imagem', file || '');

            try {
                const response = await axios.post('/api/produtos', formData);

                if (response.status == 200 || response.status == 201) {
                    fetchProdutos();
                    handleSnackbar(response.data?.message);
                    console.log('Cadastrado com sucesso');
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
        },
        [data, preco, file],
    );

    const handleChangeFile = (e: ChangeEvent<HTMLInputElement>) => {
        const files = e.currentTarget.files;
        console.log(files);
        if (files) setFile(files[0]);
    };

    const handleChooseFile = () => {
        fileInputRef.current?.click();
    };

    // const handleClearForm = () => {
    //     reset();
    // }

    return (
        <>
            <FormControl fullWidth sx={{ alignItems: 'center' }}>
                <Paper sx={{ width: '80%', padding: 3 }}>
                    <Typography variant="h6" sx={{ mb: 2 }}>
                        Cadastrar Produto
                    </Typography>
                    <form onSubmit={handleSubmit(onSubmit)}>
                        <Grid container rowSpacing={1} columnSpacing={{ xs: 1, sm: 2, md: 3 }}>
                            <Grid size={6}>
                                <Controller
                                    name="nome"
                                    control={control}
                                    defaultValue={null}
                                    rules={{ required: 'O nome é necessário' }}
                                    render={({ field }) => (
                                        <TextField {...field} fullWidth label="Nome" error={!!errors.nome} helperText={errors.nome?.message} />
                                    )}
                                />
                            </Grid>
                            <Grid size={2}>
                                <Controller
                                    name="saldo"
                                    control={control}
                                    defaultValue={null}
                                    rules={{ required: 'O saldo é necessário' }}
                                    render={({ field }) => (
                                        <TextField
                                            {...field}
                                            fullWidth
                                            label="Saldo"
                                            onChange={(e) => field.onChange(Number(e.target.value))}
                                            type="number"
                                            error={!!errors.saldo}
                                            helperText={errors.saldo?.message}
                                        />
                                    )}
                                />
                            </Grid>
                            <Grid size={2}>
                                <Controller
                                    name="cod_barras"
                                    control={control}
                                    defaultValue={null}
                                    render={({ field }) => (
                                        <TextField
                                            {...field}
                                            fullWidth
                                            label="Código de Barras"
                                            error={!!errors.cod_barras}
                                            helperText={errors.cod_barras?.message}
                                        />
                                    )}
                                />
                            </Grid>
                            <Grid size={2}>
                                <Controller
                                    name="preco"
                                    control={control}
                                    defaultValue={''}
                                    // rules={{ required: 'O preco é necessário' }}
                                    render={({ field }) => (
                                        <NumericFormat
                                            {...field}
                                            fullWidth
                                            customInput={TextField}
                                            onValueChange={(values) => {
                                                field.onChange(values.floatValue);
                                                setPreco(values.floatValue);
                                            }}
                                            value={field.value ?? ''} // garante que null/undefined vira string vazia
                                            thousandSeparator="."
                                            decimalSeparator=","
                                            prefix="R$"
                                            decimalScale={2}
                                            fixedDecimalScale
                                            allowNegative={false}
                                            label="Preço"
                                        />
                                    )}
                                />
                            </Grid>
                            <Grid size={6}>
                                <Controller
                                    name="categoria_id"
                                    control={control}
                                    defaultValue={undefined}
                                    rules={{ required: 'A categoria é necessária' }}
                                    render={({ field }) => (
                                        <TextField
                                            {...field}
                                            fullWidth
                                            id="Selecione a categoria"
                                            select
                                            label="Categoria"
                                            error={!!errors.categoria_id}
                                            helperText={errors.categoria_id?.message}
                                        >
                                            {categorias?.map((categoria) => (
                                                <MenuItem key={categoria.id} value={categoria?.id || undefined}>
                                                    {categoria.descricao}
                                                </MenuItem>
                                            ))}
                                        </TextField>
                                    )}
                                />
                            </Grid>
                            <Grid size={6}>
                                <>
                                    <TextField
                                        name="imagem"
                                        value={file?.name}
                                        label="Imagem do produto"
                                        fullWidth
                                        onClick={handleChooseFile}
                                        sx={{ flex: 1 }}
                                        error={!!errors.imagem}
                                        helperText={errors.imagem?.message}
                                        InputProps={{
                                            readOnly: true,
                                            sx: {
                                                cursor: 'pointer',
                                                caretColor: 'transparent', // remove o cursor de texto
                                            },
                                        }}
                                    />
                                    <input ref={fileInputRef} type="file" style={{ display: 'none' }} onChange={handleChangeFile} />
                                </>
                            </Grid>
                            <Grid size={12}>
                                <Controller
                                    name="descricao"
                                    control={control}
                                    defaultValue={''}
                                    // rules={{ required: 'O nome é necessário' }}
                                    render={({ field }) => (
                                        <TextareaAutosize
                                            {...field}
                                            value={field.value || ''}
                                            aria-label="Descrição"
                                            placeholder="Descrição"
                                            style={{ width: '100%', height: '150px', border: '1px solid gray' }}
                                        />
                                    )}
                                />
                            </Grid>
                        </Grid>
                        <Box sx={{ width: '100%', display: 'flex', justifyContent: 'end', mt: 1 }}>
                            <Button color="primary" variant="contained" type="submit">
                                Cadastrar
                            </Button>
                        </Box>
                    </form>
                </Paper>
            </FormControl>
        </>
    );
};

export default FormCreate;
