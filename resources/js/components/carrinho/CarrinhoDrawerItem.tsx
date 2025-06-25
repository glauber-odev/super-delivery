import { ProdutoWithImg } from '@/types/api';
import { Stack } from '@mui/material';
import Avatar from '@mui/material/Avatar';
import ListItem from '@mui/material/ListItem';
import ListItemAvatar from '@mui/material/ListItemAvatar';
import Typography from '@mui/material/Typography';
import NumberInput from '../shared/NumberInput';


type ProdutoDrawerProps = {
    produto: ProdutoWithImg;
    handleCarrinhoUpdate: (quantidade: number | null, produto_id: number | null) => void ;
}


export default function CarrinhoDrawerItem({ produto, handleCarrinhoUpdate} : ProdutoDrawerProps) {

    const onChangeNumberInput = (amount : number) => {
        handleCarrinhoUpdate(amount, Number(produto?.id));
    }
  return (
      <ListItem alignItems="flex-start" sx={{ height: 90, width: '100%', display: 'flex', alignItems: 'center', }} >
        <ListItemAvatar>
          <Avatar alt="Remy Sharp"
            src={"/storage/images/produtos/"+produto?.produto_imagem?.imagens.caminho_arquivo}
           />
        </ListItemAvatar>
        <Stack direction={'row'} sx={{ width: '100%', justifyContent: "space-between", }} >
            <Typography> 
                {produto.nome}
            </Typography>
            <NumberInput value={produto.quantidade || 0} onChange={onChangeNumberInput} />
        </Stack>
      </ListItem>
  );
}