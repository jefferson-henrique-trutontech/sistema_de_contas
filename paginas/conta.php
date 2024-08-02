<?php
include "../verifica_sessao.php";
include "../classes/contas.php";
include "../classes/database.php";
include "../classes/produtos.php";
include "../classes/haver.php";
$database = new Database();
$con = $database->getCon();
$conta = new Contas($con);
$produtos = new Produtos($con);
$haver = new Haver($con);

if (isset($_GET['id'])) :
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../componentes/jquery.js"></script>
        <title>Conta</title>
    </head>

    <body>
        <a href="../index.php">
            << Voltar</a>
                <h1>Conta</h1>
                <?php
                $dados_conta = $conta->get_conta($_GET['id']);
                $entrada = date('d/m/Y', strtotime($dados_conta['entrada']));
                $vencimento = date('d/m/Y', strtotime($dados_conta['vencimento']));
                $soma = (float) $produtos->somar_conta($dados_conta['id_conta']);
                $soma = number_format($soma, 2, ',', '.');
                $pago = (float) $conta->somar_haver($dados_conta['id_conta']);
                $pago = number_format($pago, 2, ',', '.');
                ?>
                <h2><?= $dados_conta['cliente'] ?> | Entrada: <?= $entrada ?> | Vencimento: <?= $vencimento ?> | Valor: R$ <?= $soma ?> | Pago: R$ <?= $pago ?></h2>
                <h3>Produtos</h3>
                <ul>
                    <?php foreach ($produtos->get_produtos_conta($_GET['id']) as $produto) : ?>
                        <?php
                        $valor = (float) $produto['valor'];
                        $valor = number_format($valor, 2, ',', '.');
                        $entrada = date('d/m/Y', strtotime($produto['entrada']));
                        ?>
                        <li><?= $produto['nome_produto'] ?> - R$ <?= $valor ?> - Entrada: <?= $entrada ?> <button class="apagarProduto">Apagar Produto</button></li>
                    <?php endforeach ?>
                </ul>
                <h3>Haver</h3>
                <ul id="haver">
                    <?php foreach($haver->get_haver($_GET['id']) as $haver) :?>
                        <?php
                            date_default_timezone_set('America/Sao_Paulo');
                            $data = date('d/m/Y H:i:s', strtotime($haver['data']));
                            $valor = (float) $haver['valor'];
                            $valor = number_format($valor, 2, ',', '.')
                        ?>
                        <li>R$ <?=$valor?> - Entrada: <?=$data?></li>
                    <?php endforeach?>
                </ul>
                <button id="adicionarHaver">Adicionar haver</button>
                <script>
                    adicionarHaver = document.getElementById('adicionarHaver')
                    adicionarHaver.addEventListener('click', e => {
                        valor = prompt('Insira o valor do haver!')
                        if (valor) {
                            data = {
                                valor: valor,
                                id_conta: <?= $_GET['id'] ?>
                            }
                            $.ajax({
                                url: '../rotas/haver/inserir_haver.php',
                                method: 'POST',
                                data: data
                            }).done((r) => {
                                location.reload()
                                // console.log(r)
                            })
                        }
                    })
                </script>
    </body>

    </html>

<?php endif ?>