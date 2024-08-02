<?php
include 'classes/database.php';
include 'classes/contas.php';
$db = new Database();
$con = $db ->getCon();
$contas = new Contas($con);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de contas</title>
</head>
<body>
    <h1>Sistema de contas</h1>
    <h2>Bem vindo(a), <?=$_SESSION['usuario']?></h2>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
    <h2>Contas</h2>
    <ul>
        <li>
            <details>
                <summary>Usuário 1 | Entrada: 00/00/0000 | Vencimento: 00/00/0000 | Valor: R$ 0000,00</summary>
                <ul>
                    <li>Produto 1 | R$ 0000,00</li>
                    <li>Produto 2 | R$ 0000,00</li>
                    <li>Produto 3 | R$ 0000,00</li>
                    <li>Produto 4 | R$ 0000,00</li>
                    <li>Produto 5 | R$ 0000,00</li>
                </ul>
            </details>
        </li>
    </ul>
    <button id="novaConta">Nova conta</button>
    <?php include "componentes/modal.php"?>
    <script>
        function setCurrentDateTime() {
            // Obter a data e hora atuais
            var now = new Date();
            
            // Formatar a data e hora para o formato "YYYY-MM-DDTHH:MM"
            var year = now.getFullYear();
            var month = ('0' + (now.getMonth() + 1)).slice(-2);
            var day = ('0' + now.getDate()).slice(-2);
            var hours = ('0' + now.getHours()).slice(-2);
            var minutes = ('0' + now.getMinutes()).slice(-2);

            var formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
            
            // Definir o valor do input
            document.getElementById('entrada').value = formattedDateTime;
        }

        novaConta = document.querySelector('#novaConta')
        novaConta.addEventListener('click', e => {
            gerarModal(`
            <form action="rotas/contas/inserir_conta.php" method="POST">
            <h2>Nova conta</h2>
            <div id="dadosConta">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome">
                <label for="entrada">Entrada</label>
                <input type="datetime-local" id="entrada" name="entrada">
                <label for="vencimento">Vencimento</label>
                <input type="date" id="vencimento" name="vencimento">
            </div>
            <table id="dadosProdutos" border="1">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Apagar</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <input type='submit'>
        </form>
        <button onclick="adicionarProduto()">Adicionar produto</button>
            `)
            setCurrentDateTime()
            mostrarModal()
        })

        function adicionarProduto(){
            listaProdutos = document.querySelector('#dadosProdutos tbody')
            linha = document.createElement('tr')

            celulaNome = document.createElement('td')
            nome = document.createElement('input')
            nome.type = 'text'
            nome.name = 'nome_produto[]'
            celulaNome.appendChild(nome)

            celulaValor = document.createElement('td')
            celulaValor.appendChild(document.createTextNode('R$'))
            valor = document.createElement('input')
            valor.type = 'text'
            valor.name = 'valor_produto[]'
            celulaValor.appendChild(valor)

            celulaApagar = document.createElement('td')
            apagar = document.createElement('button')
            apagar.innerHTML = '&times;'
            apagar.classList.add('apagarItem')
            celulaApagar.appendChild(apagar)

            linha.appendChild(celulaNome)
            linha.appendChild(celulaValor)
            linha.appendChild(celulaApagar)

            listaProdutos.appendChild(linha)

            apagarItem = document.querySelectorAll('.apagarItem')
            apagarItem.forEach(botao => {
                botao.addEventListener('click', e => {
                    e.target.parentNode.parentNode.remove()
                })
            });
        }
    </script>
</body>
</html>