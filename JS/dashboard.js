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
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'gerar-pdf';
    form.target = '_blank';

    const mesesSelect = document.getElementById('mes');
    const mesSelecionado = mesesSelect.options[mesesSelect.selectedIndex].text;

    const anoSelect = document.getElementById('ano');
    const anoSelecionado = anoSelect.options[anoSelect.selectedIndex].text;

    var receita = document.getElementById("receita").innerText;
    var despesa = document.getElementById("despesa").innerText;
    var saldoAtual = document.getElementById("saldoAtual").innerText;
    var listaTransacao = montarListaTransacaoSemAcoes();

    var conteudoPagina = montarPdf(mesSelecionado, anoSelecionado, receita, despesa, saldoAtual, listaTransacao);

    var input = document.createElement('textarea');
    input.name = 'conteudo';
    input.value = conteudoPagina;
    form.appendChild(input);

    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
});

function montarListaTransacaoSemAcoes() {
  return Array.from(document.querySelectorAll("table tbody tr"))
    .map(tr => {
      const tds = tr.querySelectorAll("td");
      if (tds.length === 0) return "";

      const cols = Array.from(tds).slice(0, 4)
        .map(td => `<td>${td.textContent.trim()}</td>`)
        .join("");

      return `<tr>${cols}</tr>`;
    })
    .filter(linha => linha !== "")
    .join("") || `<tr><td colspan="4">Sem transações inseridas.</td></tr>`;
}

function montarPdf(mes, ano, receita, despesa, saldoAtual, listaTransacao) {
  return `
  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>PDF - My Wallet</title>
      <link rel="icon" href="img/icon.png" type="image/png">
      <link href="https://fonts.googleapis.com/css2?family=Poltawski+Nowy:wght@700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
      <style>
          body {
              font-family: 'Poppins', sans-serif;
          }
          h1 {color: #8CC484;}
          h2 { color: #626161;}
          p { color: #626161; font-size: 1.2em;}
          table {
              width: 100%;
              border-collapse: collapse;
              background-color: white;
              border-radius: 20px;
              overflow: hidden;
              margin-bottom: 30px;
          }
          th, td {
              padding: 15px;
              text-align: left;
              font-size: 14px;
              border-bottom: 1px solid #ddd;
              font-weight: 600;
          }
          th {
              background-color: #f9f9f9;
              font-weight: 600;
          }

          tr:last-child td {
              border-bottom: none;
          }

          #atual { color: #4B9ED6;}
          #receita { color: #8CC484;} 
          #despesa { color: #F15F5F;} 
      </style>
  </head>
  <body>
      <main>
          <h1>Resumo Financeiro</h1>
          <h2>Mês: ${mes}</h2>
          <h2>Ano: ${ano}</h2>
          <hr></hr>
          <div>
              <h3 id="receita">Receita mensal:</h3>
              <p>${receita}</p>
          </div>
          <br>
          <div>
              <h3 id="despesa">Despesa mensal:</h3>
              <p>${despesa}</p>
          </div>
          <br>
          <div>
              <h3 id="atual">Saldo atual:</h3>
              <p>${saldoAtual}</p>
          </div>
          <br>
          <section>
              <table>
                  <thead>
                      <tr>
                          <td>Tipo</td>
                          <td>Data</td>
                          <td>Descrição</td>
                          <td>Valor</td>
                      </tr>
                  </thead>
                  ${listaTransacao}
              </table>
          </section>
      </main>
  </body>
  </html>
  `;
}