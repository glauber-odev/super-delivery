import { Categoria, ProdutoDataGrid } from '@/types/api';
import Modal from '@mui/material/Modal';
import FormEdit from './FormEdit';
import Box from '@mui/material/Box';
import { AlertColor } from '@mui/material/Alert';

const style = {
  position: 'absolute',
  top: '50%',
  left: '50%',
  transform: 'translate(-50%, -50%)',

  boxShadow: 24,
};


export default function ModalEdit({
    open,
    categorias,
    produto,
    handleClose,
    fetchProdutos,
    handleSnackbar,
}: {
    categorias: Categoria[] | null
    produto: ProdutoDataGrid | undefined,
    open: boolean,
    handleClose: () => void
    fetchProdutos: () => void
    handleSnackbar: (message?: string, severity?: AlertColor, autoHideDuration?: number, openSnackbar?: boolean) => void;
    }) {


  return (
      <Modal
        open={open}
        onClose={handleClose}
      >
        <Box sx={{ ...style, /* width: 400 */ }}>
            <FormEdit
            categorias={categorias}
            produto={produto}
            handleClose={handleClose}
            fetchProdutos={fetchProdutos}
            handleSnackbar={handleSnackbar}
            />
        </Box>
      </Modal>
  );
}
