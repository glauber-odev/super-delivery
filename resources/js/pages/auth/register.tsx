import { Head, useForm } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler, useState } from 'react';

import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';

type RegisterForm = {
    name: string;
    email: string;
    password: string;
    cpf: string;
    telefone_1: string;
    telefone_2: string;
    password_confirmation: string;
};

export default function Register() {
    const [step, setStep] = useState(1);
    const { data, setData, post, processing, errors, reset } = useForm<Required<RegisterForm>>({
        name: '',
        email: '',
        password: '',
        cpf: '',
        telefone_1: '',
        telefone_2: '',
        password_confirmation: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    const handleNext = () => {
        setStep(2);
    };

    const handlePrev = () => {
        setStep(1);
    };

    return (
        <AuthLayout title="Criar uma conta" description="Insira seus detalhes abaixo">
            <Head title="Registro" />
            <form className="flex flex-col gap-6" onSubmit={submit}>
                <div className="grid gap-6">
                    {step === 1 && (
                        <>
                            <div className="grid gap-2">
                                <Label htmlFor="name">Nome</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    required
                                    autoFocus
                                    value={data.name}
                                    onChange={(e) => setData((prev) => ({ ...prev, name: e.target.value }))}
                                    disabled={processing}
                                    placeholder="Nome Completo"
                                />
                                <InputError message={errors.name} className="mt-2" />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="email">Email</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    required
                                    value={data.email}
                                    onChange={(e) => setData((prev) => ({ ...prev, email: e.target.value }))}
                                    disabled={processing}
                                    placeholder="email@exemplo.com"
                                />
                                <InputError message={errors.email} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="password">Senha</Label>
                                <Input
                                    id="password"
                                    type="password"
                                    required
                                    value={data.password}
                                    onChange={(e) => setData((prev) => ({ ...prev, password: e.target.value }))}
                                    disabled={processing}
                                    placeholder="Senha"
                                />
                                <InputError message={errors.password} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="password_confirmation">Confirme a senha</Label>
                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    required
                                    value={data.password_confirmation}
                                    onChange={(e) => setData((prev) => ({ ...prev, password_confirmation: e.target.value }))}
                                    disabled={processing}
                                    placeholder="Repita a senha"
                                />
                                <InputError message={errors.password_confirmation} />
                            </div>

                            <Button type="button" onClick={handleNext} className="mt-2 w-full" disabled={processing}>
                                Próximo
                            </Button>
                        </>
                    )}

                    {step === 2 && (
                        <>
                            <div className="grid gap-2">
                                <Label htmlFor="cpf">CPF</Label>
                                <Input
                                    id="cpf"
                                    type="text"
                                    required
                                    value={data.cpf}
                                    onChange={(e) => setData((prev) => ({ ...prev, cpf: e.target.value }))}
                                    disabled={processing}
                                    placeholder="000.000.000-00"
                                />
                                <InputError message={errors.cpf} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="telefone_1">Telefone</Label>
                                <Input
                                    id="telefone_1"
                                    type="tel"
                                    required
                                    value={data.telefone_1}
                                    onChange={(e) => setData((prev) => ({ ...prev, telefone_1: e.target.value }))}
                                    disabled={processing}
                                    placeholder="(00) 00000-0000"
                                />
                                <InputError message={errors.telefone_1} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="telefone_2">Telefone secundário (opcional)</Label>
                                <Input
                                    id="telefone_2"
                                    type="tel"
                                    value={data.telefone_2}
                                    onChange={(e) => setData((prev) => ({ ...prev, telefone_2: e.target.value }))}
                                    disabled={processing}
                                    placeholder="(00) 00000-0000"
                                />
                                <InputError message={errors.telefone_2} />
                            </div>

                            <div className="flex gap-4">
                                <Button type="button" onClick={handlePrev} disabled={processing}>
                                    Voltar
                                </Button>
                                <Button type="submit" disabled={processing} className="w-full">
                                    {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                                    Criar conta
                                </Button>
                            </div>
                        </>
                    )}
                </div>

                <div className="text-center text-sm text-muted-foreground">
                    Já possui uma conta?{' '}
                    <TextLink href={route('login')} tabIndex={6}>
                        Log in
                    </TextLink>
                </div>
            </form>
        </AuthLayout>
    );
}
