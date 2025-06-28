import { PedidoProgramado, TempoUnidade } from '@/types/api';
import { Accordion, AccordionDetails, AccordionSummary, Box, FormControl, FormControlLabel, InputLabel, MenuItem, Radio, RadioGroup, Select, Tooltip } from '@mui/material';
import Typography from '@mui/material/Typography';
import React from 'react';
import ArrowDownwardIcon from '@mui/icons-material/ArrowDownward';

type FormPagamentoProps = {
    pedidoProgramadoData: PedidoProgramado;    
    handlePedidoProgramado: (property: string, value: number | boolean | null) => void;
    tempoUnidades?: TempoUnidade[];
    // periodicidades?: Periodicidade[];
};

const prefix = import.meta.env.BASE_URL


const FormPagamento: React.FC<FormPagamentoProps> = ({ 
    pedidoProgramadoData, 
    handlePedidoProgramado,
    // periodicidades,
    tempoUnidades,
 }) => {

    return (
            <Box sx={{ display: 'flex', justifyContent: 'center', alignItems: 'center', mt: 2 }}>
                <Box sx={{ height: '100%', width: '100%', padding: 3 }}>

                    {/* Seção de Pagamento */}
                    <Typography variant="h6" sx={{ mb: 1 }}>
                        Escolha a forma de pagamento
                    </Typography>

                    <Typography variant="body2" sx={{ mb: 2 }}>
                        Aceitamos diversas formas de pagamento. Parcele em até <strong>12x no cartão de crédito</strong> ou pague à vista via <strong>Pix</strong>.
                    </Typography>

                    {/* Logos das formas de pagamento */}
                    <Box sx={{ display: 'flex', gap: 2, alignItems: 'center', flexWrap: 'wrap', mb: 4 }}>
                        <img src={prefix + "storage/images/icon-pagamentos/pix.svg"} alt="Pix" height="40" style={{ height: '40px', width: 'auto' }} />
                        <img src={prefix + "storage/images/icon-pagamentos/boleto.svg"} alt="American Express" height="40" style={{ height: '40px', width: 'auto' }} />
                        <img src={prefix + "storage/images/icon-pagamentos/visa.svg"} alt="Visa" height="40" style={{ height: '40px', width: 'auto' }} />
                        <img src={prefix + "storage/images/icon-pagamentos/mastercard.svg"} alt="Mastercard" height="40" style={{ height: '40px', width: 'auto' }} />
                        <img src={prefix + "storage/images/icon-pagamentos/elo.svg"} alt="Elo" height="40" style={{ height: '40px', width: 'auto' }} />
                    </Box>

                    {/* (Opcional) Campo de escolha */}
                    <FormControl fullWidth sx={{ mb: 4 }}>
                        <InputLabel id="forma-pagamento-label">Forma de Pagamento</InputLabel>
                        <Select
                            labelId="forma-pagamento-label"
                            id="forma-pagamento"
                            // value={formaPagamento}
                            value={null}
                            label="Forma de Pagamento"
                            // onChange={(e) => setFormaPagamento(e.target.value)}
                        >
                            <MenuItem value="credito">Cartão de Crédito (12x)</MenuItem>
                            <MenuItem value="debito">Cartão de Débito</MenuItem>
                            <MenuItem value="pix">Pix (à vista)</MenuItem>
                            <MenuItem value="boleto">Boleto Bancário</MenuItem>
                        </Select>
                    </FormControl>

                    <FormControl>
                        <Tooltip title="Tornar pedido programdo" arrow>
                            <Accordion>
                                <AccordionSummary
                                expandIcon={<ArrowDownwardIcon />}
                                aria-controls="panel1-content"
                                id="panel1-header"
                                >
                                <Typography component="span">Deseja transformar este pedido em Pedido Programado?</Typography>
                                </AccordionSummary>
                                <AccordionDetails>
                                <Typography>
                                    Ao transformar este pedido em programdo, sempre que chegar na data informada será feito o pedido 
                                    automaticamente, bastando apenas confirmar o pagamento.
                                </Typography>
                                </AccordionDetails>
                            </Accordion>
                        </Tooltip>
                        <RadioGroup
                            aria-labelledby="demo-controlled-radio-buttons-group"
                            name="controlled-radio-buttons-group"
                            value={pedidoProgramadoData.flg_habilitado}
                            onChange={(e) => {
                                const value = e.target.value == "true" ? true : false;
                                handlePedidoProgramado( "flg_habilitado", value);
                            }}
                            sx={{ ml: 1 }}
                        >
                            <FormControlLabel value={true} control={<Radio />} label="Sim" />
                            <FormControlLabel value={false} control={<Radio />} label="Não" />
                        </RadioGroup>
                    </FormControl>

                    {pedidoProgramadoData.flg_habilitado == true && (
                    <>
                        <FormControl>
                                <Typography component="span">Esolha a periocidade</Typography>
                            <RadioGroup
                                aria-labelledby="demo-controlled-radio-buttons-group"
                                name="controlled-radio-buttons-group"
                                value={pedidoProgramadoData.periodicidade_id}
                                onChange={(e) => {
                                    const value = Number(e.target.value);
                                    handlePedidoProgramado( "periodicidade_id", value);
                                }}
                                sx={{ ml: 1 }}
                            >
                                <FormControlLabel value={1} control={<Radio />} label="Semanalmente" />
                                <FormControlLabel value={2} control={<Radio />} label="Mensalmente" />
                            </RadioGroup>
                        </FormControl>

                        <br />
                        <Typography sx={{ mb: 2, mt: 2, }} >Esolha quando será feito o pedido</Typography>
                        {pedidoProgramadoData.periodicidade_id == 1 && 
                        (
                        <FormControl fullWidth sx={{ mb: 4 }}>
                            <InputLabel id="dia-semana-label">Escolha o dia da Semana</InputLabel>
                            <Select
                            labelId="dia-semana-label"
                            id="dia-semana"
                            value={pedidoProgramadoData.tempo_unidade_id}
                            label="Dia da Semana"
                            onChange={(e) => {
                                const value = Number(e.target.value);
                                handlePedidoProgramado( "tempo_unidade_id", value);
                            }}
                            >
                                {tempoUnidades?.filter((tempoUnidade) => tempoUnidade.periodicidade_id == 1)
                                                .map((tempoUnidade) => {
                                    return <MenuItem value={tempoUnidade.id || -1}>{tempoUnidade.unidade}</MenuItem>
                                })}
                            </Select>
                        </FormControl>
                        )}

                        {pedidoProgramadoData.periodicidade_id == 2 &&
                        (
                        <FormControl fullWidth sx={{ mb: 4 }}>
                            <InputLabel id="dia-mes-label">Escolha o dia do Mês</InputLabel>
                            <Select
                            labelId="dia-mes-label"
                            id="dia-mes"
                            value={pedidoProgramadoData.tempo_unidade_id}
                            label="Dia da Semana"
                            onChange={(e) => {
                                const value = Number(e.target.value);
                                handlePedidoProgramado( "tempo_unidade_id", value);
                            }}
                            >
                                {tempoUnidades?.filter((tempoUnidade) => tempoUnidade.periodicidade_id == 2)
                                                .map((tempoUnidade) => {
                                    return <MenuItem value={tempoUnidade.id || -1}>{`Ao ${tempoUnidade.posicao_ordem}º dia do mês`}</MenuItem>
                                })}
                            </Select>
                        </FormControl>
                        )}
                    </>
                    )}

                </Box>
            </Box>

    );
};

export default FormPagamento;
