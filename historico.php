<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Simulações</title>
</head>

<body>

    <header>
        </h2>DevWeb2023 - Simulador de Investimentos</h2>
    </header>

    <h2>Simulação a recuperar</h2>
    <form method="post" action="">
        <label for="id">ID da Simulação:</label>
        <input type="text" name="id" id="id">
        <input type="submit" class="input-botao" value="Recuperar">
    </form>

    <?php
    require_once 'classes/autoloader.php';
    R::setup('mysql:host=127.0.0.1;dbname=webdev', 'root', '');

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $simulation = R::load('simulation', $id);
        if ($simulation->id) {
    ?>

    <div class="dados" id="resultado">
        <h1>ID: <?php echo $id ?></h1>
        <h1>Nome: <?php echo $simulation->cliente ?></h1>
        <h1>Aporte Inicial: <?php echo number_format($simulation->aporteIni, 2, ',', '.'); ?> (R$)</h1>
        <h1>Período: <?php echo $simulation->periodo ?> meses</h1>
        <h1>Rendimento Mensal: <?php echo number_format($simulation->rendimentoMen, 2, ',', '.'); ?> (%)</h1>
        <h1>Aporte Mensal: <?php echo number_format($simulation->aporteMen, 2, ',', '.'); ?> (R$)</h1>
        <h1>Total: <?php echo number_format($simulation->total, 2, ',', '.'); ?> (R$)</h1>
    </div>
    <table>
        <tr>
        <th>Mês</th>
        <th>Valor Inicial (R$)</th>
        <th>Aporte (R$)</th>
        <th>Rendimento (R$)</th>
        <th>Total (R$)</th>
        </tr>

    <?php
        $dados = Util::calcularRendimento($simulation->aporteIni, $simulation->periodo, $simulation->rendimentoMen, $simulation->aporteMen)['dados'];
        foreach ($dados as $linha) :

    ?>
        <tr>
        <td><?php echo $linha['mes']; ?></td>
        <td><?php echo number_format($linha['inicial'], 2, ',', '.'); ?></td>
        <td><?php echo number_format($linha['aporte'], 2, ',', '.'); ?></td>
        <td><?php echo number_format($linha['rendimento'], 2, ',', '.'); ?></td>
        <td><?php echo number_format($linha['total'], 2, ',', '.'); ?></td>
        </tr>

    <?php endforeach; ?>
    </table>
    <?php } else {
            echo '<p class="id-invalida">ID de simulação inexistente.</p>';
        }
    }
    ?>

    <a href="./index.html">Voltar</a>

    <footer>
        <p> Eduardo Veloso/Rafael Barros - &copy; 2023</p>      
    </footer>

</body>
</html>