import { CarrinhoSession, FreteMelhorEnvio, PedidoProgramado, Residencia, TempoUnidade } from '@/types/api';
import CheckCircleIcon from '@mui/icons-material/CheckCircle';
import { Zoom } from '@mui/material';
import Box from '@mui/material/Box';
import Button from '@mui/material/Button';
import { blue, green } from '@mui/material/colors';
import Step from '@mui/material/Step';
import StepLabel from '@mui/material/StepLabel';
import Stepper from '@mui/material/Stepper';
import Typography from '@mui/material/Typography';
import * as React from 'react';
import FormCarrinho from './Forms/FormCarrinho';
import FormPagamento from './Forms/FormPagamento';
import FormResidencia from './Forms/FormResidencia';

const steps = ['Residência', 'Produtos', 'Realizar Pagamento'];

type StepperPedidoProps =  { 
    handleSubmit: () => Promise<boolean> | void;
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
    handleSubmit, 
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
            <Box sx={{ display: 'flex', justifyContent: 'center', alignItems: 'center', mt: 2 }}>
                <Box sx={{ height: '500px', width: '100%', padding: 3 , display: 'flex', flexDirection:'column', justifyContent: 'center', alignItems: 'center'}}>
                            <Zoom in={true}>
                                <CheckCircleIcon fontSize='large' sx={{ color: green[500] }} />
                            </Zoom>
                            <Typography sx={{ mt: 2, mb: 1, color: green[500] }}>
                                Pedido finalizado, confira sua lista de pedidos.
                            </Typography>
                            <a href='/pedidos' >
                                <Typography sx={{ mt: 2, mb: 1, color: blue[500] }}>
                                    Meus pedidos.
                                </Typography>
                            </a>
                </Box>
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
            <Button 
                // onClick={handleNext}
                onClick={async () => {
                    if(activeStep === steps.length -1){
                        const confirmed = await handleSubmit();
                        if(confirmed) return handleNext()
                    } else {
                        return handleNext();
                    }
                    // return activeStep === steps.length - 1 ? handleSubmit() : handleNext();
                }}
                >
              {activeStep === steps.length - 1 ? 'Finalizar' : 'Próximo'}
            </Button>
          </Box>
        </React.Fragment>
      )}
    </Box>
  );
}