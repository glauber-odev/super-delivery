import { Box, IconButton, TextField } from '@mui/material';
import { useTheme } from '@mui/material/styles';
import AddIcon from '@mui/icons-material/Add';
import RemoveIcon from '@mui/icons-material/Remove';

interface NumberInputProps {
  label?: string;
  min?: number;
  max?: number;
  value: number;
  onChange: (value: number) => void;
}

const NumberInput = ({ min = 0, max = 99, value, onChange }: NumberInputProps) => {
  const theme = useTheme();

  const handleDecrease = () => {
    if (value > min) onChange(value - 1);
  };

  const handleIncrease = () => {
    if (value < max) onChange(value + 1);
  };

  return (
    <Box display="flex" alignItems="center" gap={1}>
      <IconButton
        onClick={handleDecrease}
        size="small"
        sx={{
          color: 'white',
          backgroundColor: theme.palette.warning.light,
          transition: 'all 0.2s',
          '&:hover': {
            backgroundColor: theme.palette.warning.main,
          },
        }}
      >
        <RemoveIcon fontSize="small" />
      </IconButton>

      <TextField
        type="text"
        value={value}
        onChange={(e) => onChange(Number(e.target.value))}
        inputProps={{ min, max }}
        variant="outlined"
        sx={{
          width: 60,
          '& .MuiInputBase-root': {
            height: 35,
            backgroundColor: '#f0f0f0',
            borderRadius: 1,
            fontSize: '0.9rem',
            px: 1,
          },
          '& input': {
            textAlign: 'center',
            padding: 0,
          },
        }}
      />

      <IconButton
        onClick={handleIncrease}
        size="small"
        sx={{
          color: 'white',
          backgroundColor: theme.palette.warning.light,
          transition: 'all 0.2s',
          '&:hover': {
            backgroundColor: theme.palette.warning.main,
          },
        }}
      >
        <AddIcon fontSize="small" />
      </IconButton>
    </Box>
  );
};

export default NumberInput;
