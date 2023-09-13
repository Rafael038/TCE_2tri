<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processar dados</title>
</head>

<body>

    <header>
        </h2>DevWeb2023 - Simulador de Investimentos</h2>
    </header>


<?php
    require_once 'classes/autoloader.php';
    require_once 'classes/r.class.php';
    R::setup('mysql:host=127.0.0.1;dbname=webdev', 'root', '');

    if (
        isset($_GET['nome']) && isset($_GET['aporte']) &&
        isset($_GET['periodo']) && isset($_GET['rendimento']) &&
        isset($_GET['aporte']) &&
        is_numeric($_GET['aporte']) && is_numeric($_GET['periodo']) &&
        is_numeric($_GET['rendimento']) && is_numeric($_GET['aporte'])
    ) {
        $nomeCli = $_GET['nome'];
        $aporteIni = $_GET['aporte'];
        $periodo = $_GET['periodo'];
        $rendimentoMen = $_GET['rendimento'];
        $aporteMen = $_GET['aporte'];

        $dadosRendimento = Util::calcularRendimento($aporteIni, $periodo, $rendimentoMen, $aporteMen);
        $dados = $dadosRendimento['dados'];
        $total = $dadosRendimento['total'];

        if (isset($_GET['nome']) && isset($_GET['aporte']) && isset($_GET['periodo']) && isset($_GET['rendimento']) && isset($_GET['aporte'])) {
            $simulation = R::dispense('simulation');

            $simulation->cliente = $nomeCli;
            $simulation->aporteIni = number_format($aporteIni, 2, '.', '');
            $simulation->periodo = $periodo;
            $simulation->rendimentoMen = number_format($rendimentoMen, 2, '.', '');
            $simulation->aporteMen = number_format($aporteMen, 2, '.', '');
            $simulation->total = number_format($total, 2, '.', '');

            $id = R::store($simulation);

            R::close();
        }

    }

    else {
        echo '<h2 class="erro"><i class="uil uil-exclamation-triangle"></i> Erro no envio de dados</h2>';
        echo '<p class="erro">Preencha os campos com valores válidos.</p>';
    }

    ?>
    <div class="dados" id="resultado">
        <?php if (isset($id)) : ?>
            <h1>ID: <?php echo $id ?></h1>
            <h1>Nome: <?php echo $nomeCli ?></h1>
            <h1>Aporte Inicial: <?php echo number_format($aporteIni, 2, ',', '.'); ?> (R$)</h1>
            <h1>Período: <?php echo $periodo ?> meses</h1>
            <h1>Rendimento Mensal: <?php echo number_format($rendimentoMen, 2, ',', '.'); ?> (%)</h1>
            <h1>Aporte Mensal: <?php echo number_format($aporteMen, 2, ',', '.'); ?> (R$)</h1>
            <h1>Total: <?php echo number_format($total, 2, ',', '.'); ?> (R$)</h1>
        <?php endif; ?>
    </div>
    <?php if (isset($dados) && !empty($dados)) : ?> 
    <table>
        <tr>
            <th>Mês</th>
            <th>Valor Inicial (R$)</th>
            <th>Aporte (R$)</th>
            <th>Rendimento (R$)</th>
            <th>Total (R$)</th>
        </tr>
        <?php if (isset($dados)) : ?>
            <?php foreach ($dados as $linha) : ?>
                <tr>
                    <td><?php echo $linha['mes']; ?></td>
                    <td><?php echo number_format($linha['inicial'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($linha['aporte'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($linha['rendimento'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($linha['total'], 2, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <?php endif; ?>
</body>

<a href="./entrada.html">Voltar</a>

    <footer>
        <p> Eduardo Veloso/Rafael Barros - &copy; 2023</p>      
    </footer>

</html>