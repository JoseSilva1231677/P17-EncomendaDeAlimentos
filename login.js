document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loginForm');
  const email = document.getElementById('username');
  const password = document.getElementById('password');
  form.addEventListener('submit', function (event) {
    let mensagens = [];

    if (!email.value.includes('@')) {
      mensagens.push("Email inválido.");
    }

    if (password.value.length < 6) {
      mensagens.push("A password deve ter pelo menos 6 caracteres.");
    }

    if (mensagens.length > 0) {
      event.preventDefault();
      alert(mensagens.join('\n'));
    }
  });
});
