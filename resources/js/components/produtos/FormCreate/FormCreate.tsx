// import Header from '@/components/header';
import Box from '@mui/material/Box';
import Button from '@mui/material/Button';
import FormControl from '@mui/material/FormControl';
import Grid from '@mui/material/Grid';
import Paper from '@mui/material/Paper';
import TextareaAutosize from '@mui/material/TextareaAutosize';
import TextField from '@mui/material/TextField';
import Typography from '@mui/material/Typography';
import React, { ChangeEvent, useRef, useState } from 'react';
import { Controller, SubmitHandler, useForm } from 'react-hook-form';
import { NumericFormat } from 'react-number-format';

type FormValues = {
    nome: string | null;
    preco: string | number | undefined;
    saldo: number | null;
    categoria_id: number | null;
    descricao: string | null;
    imagem: File | null;
};

const initialValues: FormValues = {
    nome: null,
    preco: '',
    saldo: null,
    categoria_id: null,
    descricao: '',
    imagem: null,
};


const FormCreate: React.FC = () => {
    const {
        control,
        handleSubmit,
        formState: { errors },
    } = useForm<FormValues>();
    const [data, setData] = useState<FormValues>(initialValues);
    const [preco, setPreco] = useState<number | undefined>(0.0);
    const [file, setFile] = useState<File | null>(null);
    const fileInputRef = useRef<HTMLInputElement | null>(null);

    const onSubmit: SubmitHandler<FormValues> = (data: FormValues) => {
        setData({...data, preco: preco, imagem: file});
    };

    const handleChangeFile = (e: ChangeEvent<HTMLInputElement>) => {
    const files = e.currentTarget.files
    if (files)
        setFile(files[0]);
        // console.log(files[0]);
    }

    const handleChooseFile = () => {
        fileInputRef.current?.click();
    };

    return (
        <>
            <FormControl fullWidth sx={{ alignItems: 'center'}}>
                <Paper sx={{ width: '80%', padding: 3 }}>
                    <Typography variant="h6" sx={{ mb: 2 }}>Cadastrar Produto</Typography>
                    <form onSubmit={handleSubmit(onSubmit)}>
                        <Grid container rowSpacing={1} columnSpacing={{ xs: 1, sm: 2, md: 3 }}>
                            <Grid size={6}>
                                <Controller
                                    name="nome"
                                    control={control}
                                    defaultValue={null}
                                    rules={{ required: 'O nome é necessário' }}
                                    render={({ field }) => (
                                        <TextField
                                        {...field}
                                        fullWidth
                                        label="Nome"
                                        error={!!errors.nome}
                                        helperText={errors.nome?.message} />
                                    )}
                                />
                            </Grid>
                            <Grid size={3}>
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
                                        helperText={errors.saldo?.message} />
                                    )}
                                />
                            </Grid>
                            <Grid size={3}>
                                <Controller
                                    name="preco"
                                    control={control}
                                    defaultValue={''}
                                    // rules={{ required: 'O preco é necessário' }}
                                    render={({ field }) => (
                                        <NumericFormat
                                        {...field}
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
                                    defaultValue={null}
                                    rules={{ required: 'A categoria é necessária' }}
                                    render={({ field }) => (
                                        <TextField
                                        {...field}
                                        fullWidth
                                        label="Categoria"
                                        error={!!errors.categoria_id}
                                        helperText={errors.categoria_id?.message} />
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
                                    <input
                                        ref={fileInputRef}
                                        type="file"
                                        style={{ display: 'none' }}
                                        onChange={handleChangeFile}
                                    />
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
                        <Box sx={{ width:"100%", display:"flex", justifyContent: 'end', mt: 1 }}>
                            <Button color="primary" variant="contained" type="submit">Cadastrar</Button>
                        </Box>
                        <Typography className="normal-text">Data: {JSON.stringify(data)}</Typography>
                    </form>
                </Paper>
            </FormControl>
        </>
    );
};

export default FormCreate;
