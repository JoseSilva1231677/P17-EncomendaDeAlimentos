document.addEventListener('DOMContentLoaded', () => {
  const tabela = document.getElementById('tabelaCarrinho');
  const linhas = tabela.querySelectorAll('tbody tr');
  const totalSpan = document.getElementById('valorTotal');
  let total = 0;

  linhas.forEach(linha => {
    const qtd = parseInt(linha.children[1].textContent);
    const preco = parseFloat(linha.dataset.preco);
    total += qtd * preco;
  });

  totalSpan.textContent = total.toFixed(2);
});
