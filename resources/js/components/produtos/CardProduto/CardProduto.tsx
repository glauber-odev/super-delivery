import NumberInput from '@/components/shared/NumberInput';
import { ProdutoGrid } from '@/types/api';
import FavoriteIconBorder from '@mui/icons-material/FavoriteBorder';
import { Box, Button, Chip, Stack } from '@mui/material';
import Card from '@mui/material/Card';
import CardContent from '@mui/material/CardContent';
import IconButton from '@mui/material/IconButton';
import Typography from '@mui/material/Typography';

const formatFloat2Money = (value: number | Intl.StringNumericLiteral) => {
    const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
    });

    return formatter.format(value);
};

export default function CardProduto({ produto, qtSelected, handleCarrinhoUpdate } : { produto: ProdutoGrid, qtSelected: number | null, handleCarrinhoUpdate: (quantidade: number | null, produto_id: number | null) => void }) {

    const style = {

    backgroundImage : `url(/storage/images/produtos/${produto?.produto_imagem?.imagens?.caminho_arquivo})`,
    backgroundRepeat: "no-repeat",
    backgroundSize: "contain",
    backgroundPosition: "center",
    height: "140px",

    display: 'flex',
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'start'

    }

    const onChangeNumberInput = (amount : number) => {
        handleCarrinhoUpdate(amount, Number(produto?.id));
    }

  return (
    <Card sx={{ maxWidth: 250, height: 300 }}>

      <Box sx={{ ...style }} >        
        <Chip label="promoção" color="warning" size='small' sx={{ ml: 1, mt: 1, opacity: '0.7' }} />
        <IconButton aria-label="add to favorites">
          {/* <FavoriteIcon /> */}
          <FavoriteIconBorder />
        </IconButton>
      </Box>
      <CardContent>
        <Box sx={{ height: 70 }}>
            <Typography variant="body2" sx={{ color: 'text.primary' }}>
                {produto?.nome}
            </Typography>
            <Stack direction={'row'} spacing={1} >
                <Typography variant="body1" sx={{ color: 'text.primary', fontWeight: 'bold' }}>
                    {formatFloat2Money(Number(produto?.preco))}
                </Typography>
                <Typography variant="body2" sx={{ color: 'text.secondary' }}>
                    <s>{formatFloat2Money(Number(produto?.preco) + 10)}</s>
                </Typography>
            </Stack>
        </Box>
        <Stack direction={'row'} sx={{ justifyContent: 'center', alignItems: 'center' , mt: 2 }}>
                {
                    qtSelected ? (
                        <NumberInput min={1} max={Number(produto.saldo)} value={Number(qtSelected)} onChange={onChangeNumberInput} />
                    ) : (
                        <Button variant="contained" color="warning" type="submit" onClick={() => onChangeNumberInput(1)}>
                            Adicionar
                        </Button>
                    )
                }
        </Stack>

      </CardContent>
    </Card>
  );
}