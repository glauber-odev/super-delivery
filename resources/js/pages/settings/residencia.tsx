import HeadingSmall from '@/components/heading-small';
import InputError from '@/components/input-error';
import ResidenciaItem from '@/components/shared/ResidenciaItem';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import SettingsLayout from '@/layouts/settings/layout';
import { type BreadcrumbItem } from '@/types';
import { Residencia as ResidenciaType } from '@/types/api';
import { Transition } from '@headlessui/react';
import { Head, useForm } from '@inertiajs/react';
import { Box, ListItem } from '@mui/material';
import axios from 'axios';
import { FormEventHandler, useCallback, useEffect, useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Suas Residencias',
        href: '/settings/residencia',
    },
];

export default function Residencia({ userId } : { userId : number }) {
    const [residencias, setResidencias] = useState<ResidenciaType[] | null >();

    const { data, setData, errors, reset,  processing, recentlySuccessful } = useForm({
        numero: '',
        complemento: '',
        bairro: '',
        cidade: '',
        cep: '',
        uf: '',
    });

const fetchResidencias = useCallback(async () => {
    try {
        const response = await axios.get(`/api/residencias/users/${userId}`);
        setResidencias(response?.data?.data);
    } catch (error) {
        console.error(error);
        console.error(error);
    }
}, [userId]);


    // Detecta mudança no campo de CEP e chama a API ViaCEP
    useEffect(() => {
        const fetchEndereco = async () => {
            const cep = data.cep?.replace(/\D/g, ''); // Remove não dígitos
            if (cep?.length === 8) {
                try {
                    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                    const endereco = await response.json();
                    console.log(endereco);

                    if (!endereco.erro) {
                        setData((prev) => ({
                            ...prev,
                            bairro: endereco.bairro,
                            cidade: endereco.localidade,
                            uf: endereco.uf,
                            complemento: endereco.complemento ?? '',
                        }));
                    }
                } catch (error) {
                    console.error('Erro ao buscar CEP:', error);
                }
            }
        };

        fetchEndereco();
        fetchResidencias();
    }, [data.cep]);


    const createResidencia: FormEventHandler = async (e) => {
        e.preventDefault();

        console.log('Dados a enviar:', data);

                try {
                const response = await axios.post(`/api/residencias/users/${userId}`, data);
                setResidencias(response?.data?.data);
                console.log(response?.data?.data);
                fetchResidencias();
                } catch (error) {
                console.error('Erro na requisição:', error);
                }

                reset();
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Atualize sua residência" />

            <SettingsLayout>
                <div className="space-y-6">
                    <HeadingSmall
                        title="Atualize os dados da residência"
                        description="Mantenha suas informações residenciais atualizadas."
                    />

                    <form onSubmit={createResidencia} className="space-y-6">

                        <div className="grid gap-2">
                            <Label htmlFor="cep">CEP</Label>
                            <Input
                                id="cep"
                                value={data.cep ?? ''}
                                onChange={(e) => setData('cep', e.target.value)}
                                type="text"
                                placeholder="CEP"
                            />
                            <InputError message={errors.cep} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="numero">Número</Label>
                            <Input
                                id="numero"
                                value={data.numero ?? ''}
                                onChange={(e) => setData('numero', e.target.value)}
                                type="text"
                                placeholder="Número"
                            />
                            <InputError message={errors.numero} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="complemento">Complemento</Label>
                            <Input
                                id="complemento"
                                value={data.complemento ?? ''}
                                onChange={(e) => setData('complemento', e.target.value)}
                                type="text"
                                placeholder="Complemento"
                            />
                            <InputError message={errors.complemento} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="bairro">Bairro</Label>
                            <Input
                                id="bairro"
                                value={data.bairro ?? ''}
                                onChange={(e) => setData('bairro', e.target.value)}
                                type="text"
                                placeholder="Bairro"
                            />
                            <InputError message={errors.bairro} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="cidade">Cidade</Label>
                            <Input
                                id="cidade"
                                value={data.cidade ?? ''}
                                onChange={(e) => setData('cidade', e.target.value)}
                                type="text"
                                placeholder="Cidade"
                            />
                            <InputError message={errors.cidade} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="uf">Estado (UF)</Label>
                            <Input
                                id="uf"
                                value={data.uf ?? ''}
                                onChange={(e) => setData('uf', e.target.value)}
                                type="text"
                                placeholder="Estado (ex: SP)"
                                maxLength={2}
                            />
                            <InputError message={errors.uf} />
                        </div>

                        <div className="flex items-center gap-4">
                            <Button type='submit' disabled={processing}>Salvar</Button>
                            <Transition
                                show={recentlySuccessful}
                                enter="transition ease-in-out"
                                enterFrom="opacity-0"
                                leave="transition ease-in-out"
                                leaveTo="opacity-0"
                            >
                                <p className="text-sm text-neutral-600">Salvo com sucesso</p>
                            </Transition>
                        </div>
                    </form>
                </div>
                <Box sx={{ mt: 3 }}>
                    {residencias?.length && (
                        <ListItem>
                            {residencias.map((residencia, index) => {
                                return ( <ResidenciaItem key={index} residencia={residencia} /> )
                            })}
                        </ListItem>
                    )}
                </Box>
            </SettingsLayout>
        </AppLayout>
    );
}
