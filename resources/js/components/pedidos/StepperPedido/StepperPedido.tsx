import { CarrinhoSession, FreteMelhorEnvio, PedidoProgramado, Periodicidade, Residencia, TempoUnidade } from '@/types/api';
import Box from '@mui/material/Box';
import Button from '@mui/material/Button';
import Step from '@mui/material/Step';
import StepLabel from '@mui/material/StepLabel';
import Stepper from '@mui/material/Stepper';
import Typography from '@mui/material/Typography';
import * as React from 'react';
import FormCarrinho from './Forms/FormCarrinho';
import FormResidencia from './Forms/FormResidencia';
import FormPagamento from './Forms/FormPagamento';

const steps = ['Residência', 'Produtos', 'Realizar Pagamento'];

type StepperPedidoProps =  { 
    residencias : Residencia[] | null;
    residenciaId: number | null;
    handleResidencia: (id :number | null) => void;
    carrinhoSession: CarrinhoSession | null ;
    frete: FreteMelhorEnvio | null ;
    pedidoProgramadoData: PedidoProgramado;
    tempoUnidades?: TempoUnidade[];
    handlePedidoProgramado: (property: string, value: number | boolean | null) => void;
}

export default function StepperPedido({ 
    residencias, 
    residenciaId, 
    handleResidencia, 
    carrinhoSession, 
    handlePedidoProgramado, 
    pedidoProgramadoData,
    frete,
    tempoUnidades,
 } : StepperPedidoProps) {
  const [activeStep, setActiveStep] = React.useState(0);
  const [skipped, setSkipped] = React.useState(new Set<number>());

  function formChooser(id: number) {

      switch (id) {
        case 0:
            return <FormResidencia residencias={residencias} residenciaId={residenciaId} handleResidencia={handleResidencia} />;
        case 1:
            return <FormCarrinho carrinhoSession={carrinhoSession} frete={frete} />;
        case 2:
            return <FormPagamento 
                    pedidoProgramadoData={pedidoProgramadoData}
                    handlePedidoProgramado={handlePedidoProgramado}
                    tempoUnidades={tempoUnidades}
                     />;
        default:
            return 'Ops, nada aconteceu!';
        break;
      }
    }

  const isStepSkipped = (step: number) => {
    return skipped.has(step);
  };

  const handleNext = () => {
    let newSkipped = skipped;
    if (isStepSkipped(activeStep)) {
      newSkipped = new Set(newSkipped.values());
      newSkipped.delete(activeStep);
    }

    setActiveStep((prevActiveStep) => prevActiveStep + 1);
    setSkipped(newSkipped);
  };

  const handleBack = () => {
    setActiveStep((prevActiveStep) => prevActiveStep - 1);
  };

  const handleReset = () => {
    setActiveStep(0);
  };

  return (
    <Box sx={{ width: '100%' }}>
      <Stepper activeStep={activeStep}>
        {steps.map((label, index) => {
          const stepProps: { completed?: boolean } = {};
          const labelProps: {
            optional?: React.ReactNode;
          } = {};
          if (isStepSkipped(index)) {
            stepProps.completed = false;
          }
          return (
            <Step key={label} {...stepProps}>
              <StepLabel {...labelProps}>{label}</StepLabel>
            </Step>
          );
        })}
      </Stepper>
      {activeStep === steps.length ? (
        <React.Fragment>
          <Typography sx={{ mt: 2, mb: 1 }}>
            All steps completed - you&apos;re finished
          </Typography>
          <Box sx={{ display: 'flex', flexDirection: 'row', pt: 2 }}>
            <Box sx={{ flex: '1 1 auto' }} />
            <Button onClick={handleReset}>Reset</Button>
          </Box>
        </React.Fragment>
      ) : (
        <React.Fragment>

          {formChooser(activeStep)}

          <Box sx={{ display: 'flex', flexDirection: 'row', pt: 2 }}>
            <Button
              color="inherit"
              disabled={activeStep === 0}
              onClick={handleBack}
              sx={{ mr: 1 }}
            >
              Voltar
            </Button>
            <Box sx={{ flex: '1 1 auto' }} />
            <Button onClick={handleNext}>
              {activeStep === steps.length - 1 ? 'Finalizar' : 'Próximo'}
            </Button>
          </Box>
        </React.Fragment>
      )}
    </Box>
  );
}