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
const mesSelecionado = document.getElementById('mes');
const anoSelecionado = document.getElementById('ano');


tipos.forEach(td => {
  const tipo = td.textContent.trim();
  
  if(tipo === 'Despesa') {
    td.classList.add('redColor');
  } else if(tipo === 'Receita') {
    td.classList.add('greenColor');
  }
});

function mudouSelectFiltro() {
    const mes = mesSelecionado.value;
    const ano = anoSelecionado.value;

    const params = new URLSearchParams(window.location.search);

    if (mes !== "0") {
        params.set('mes', mes);
    } else {
        params.delete('mes');
    }

    if (ano !== "0") {
        params.set('ano', ano);
    } else {
        params.delete('ano');
    }

    window.location.search = params.toString();
}

mesSelecionado.addEventListener('change', mudouSelectFiltro);
anoSelecionado.addEventListener('change', mudouSelectFiltro);

document.addEventListener('DOMContentLoaded', function() {
    const chartElement = document.getElementById('chart');
    const receita = parseFloat(chartElement.getAttribute('data-receita'));
    const despesa = parseFloat(chartElement.getAttribute('data-despesa'));

    if (receita === 0 && despesa === 0)
          chartElement.style.display = 'none';
    else
          chartElement.style.display = 'block';

    var options = {
        chart: {
            type: 'pie',
        },
        labels: ['Receita', 'Despesa'],
        series: [receita, despesa],
        colors: ['#8CC484', '#F15F5F'],
        title: {
            text: 'Receita e Despesa',
            align: 'center'
        },
        legend: {
          show: false
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: '100%'
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
});

document.getElementById('gerar-pdf').addEventListener('click', function() {
    var divButtons = document.querySelector('.buttons');
    divButtons.style.display = 'none';

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'gerar-pdf';

    var conteudoPagina = document.body.innerHTML;

    var input = document.createElement('textarea');
    input.name = 'conteudo';
    input.value = conteudoPagina;
    form.appendChild(input);

    document.body.appendChild(form);
    form.submit();
});
