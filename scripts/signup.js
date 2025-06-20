document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('signupForm');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');

  form.addEventListener('submit', function (event) {
    let valid = true;
    let messages = [];

    // Validação de email
    const emailValue = emailInput.value.trim();
    if (!emailValue.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
      valid = false;
      messages.push("Por favor, introduza um email válido.");
    }

    // Validação de password
    const passwordValue = passwordInput.value;
    if (passwordValue.length < 6) {
      valid = false;
      messages.push("A password deve ter pelo menos 6 caracteres.");
    }

    if (!valid) {
      event.preventDefault(); // Impede envio do formulário
      alert(messages.join('\n')); // Mostra erros num alerta
    }
  });
});
