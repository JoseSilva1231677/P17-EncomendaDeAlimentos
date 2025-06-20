document.getElementById('checkoutForm').addEventListener('submit', function(event) {
  event.preventDefault();

  const mesa = document.getElementById('mesa').value.trim();
  const contacto = document.getElementById('contacto').value.trim();
  const nome = document.getElementById('nome').value.trim();
  const mensagemErro = document.getElementById('mensagemErro');

  mensagemErro.textContent = '';

  if (!mesa || parseInt(mesa) <= 0) {
    mensagemErro.textContent = 'Insira um número de mesa válido.';
    return;
  }

  if (!/^\d{9}$/.test(contacto)) {
    mensagemErro.textContent = 'Contacto deve ter 9 dígitos.';
    return;
  }

  if (nome.length < 2) {
    mensagemErro.textContent = 'Nome é obrigatório e deve ter pelo menos 2 caracteres.';
    return;
  }

  alert('Checkout efetuado com sucesso!');
});
