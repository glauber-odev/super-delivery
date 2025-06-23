import { Box, Container, Grid, Typography, Link, Stack } from '@mui/material';
import FacebookIcon from '@mui/icons-material/Facebook';
import InstagramIcon from '@mui/icons-material/Instagram';
import EmailIcon from '@mui/icons-material/Email';

function Footer() {
  return (
    <Box sx={{ backgroundColor: '#f5f5f5', py: 4, mt: 6 }}>
      <Container maxWidth="lg">
        <Grid container spacing={4}>
          {/* Sobre a loja */}
          <Grid sx={{ xs:12, sm:6, md:3 }} >
            <Typography variant="h6" fontWeight="bold" gutterBottom>
              Super Delivery
            </Typography>
            <Typography variant="body2" color="text.secondary">
              Sua compra de supermercado mais rápida e prática, com entrega em casa.
            </Typography>
          </Grid>

          {/* Links úteis */}
          <Grid sx={{ xs:12, sm:6, md:3 }} >
            <Typography variant="h6" fontWeight="bold" gutterBottom>
              Navegação
            </Typography>
            <Stack spacing={1}>
              <Link href="/ofertas" underline="hover" color="inherit">Ofertas</Link>
              <Link href="/hortifruti" underline="hover" color="inherit">Hortifruti</Link>
              <Link href="/padaria" underline="hover" color="inherit">Padaria</Link>
              <Link href="/bebidas" underline="hover" color="inherit">Bebidas</Link>
            </Stack>
          </Grid>

          {/* Contato */}
          <Grid sx={{ xs:12, sm:6, md:3 }} >
            <Typography variant="h6" fontWeight="bold" gutterBottom>
              Contato
            </Typography>
            <Typography variant="body2">Atendimento: (11) 4002-8922</Typography>
            <Typography variant="body2">Email: suporte@superdelivery.com</Typography>
            <Typography variant="body2">Horário: 08h às 22h, todos os dias</Typography>
          </Grid>

          {/* Redes sociais */}
          <Grid sx={{ xs:12, sm:6, md:3 }} >
            <Typography variant="h6" fontWeight="bold" gutterBottom>
              Siga-nos
            </Typography>
            <Stack direction="row" spacing={2}>
              <Link href="#" color="inherit"><FacebookIcon /></Link>
              <Link href="#" color="inherit"><InstagramIcon /></Link>
              <Link href="mailto:suporte@superdelivery.com" color="inherit"><EmailIcon /></Link>
            </Stack>
          </Grid>
        </Grid>

        {/* Linha final */}
        <Box mt={4} textAlign="center">
          <Typography variant="body2" color="text.secondary">
            © {new Date().getFullYear()} Super Delivery. Todos os direitos reservados.
          </Typography>
        </Box>
      </Container>
    </Box>
  );
}

export default Footer;
