document.getElementById("btn-sair").addEventListener("click", function(e) {
  e.preventDefault();

  Swal.fire({
    title: 'Tem certeza que deseja sair?',
    text: "Você será desconectado da sua conta.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#97CD8D',
    cancelButtonColor: '#F15F5F',
    confirmButtonText: 'Sair',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "sair";
    }
  });
});

const tipos = document.querySelectorAll('.tipos');

tipos.forEach(td => {
  const tipo = td.textContent.trim();
  
  if(tipo === 'Despesa') {
    td.classList.add('redColor');
  } else if(tipo === 'Receita') {
    td.classList.add('greenColor');
  }
});

