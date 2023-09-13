<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>|Entrada de Dados</title>
</head>

<body>
    <header>
        </h2>DevWeb2023 - Simulador de Investimentos</h2>
    </header>

    <main>

    <form action="processar.php" method="get">
            <fieldset>
                <legend>Dados</legend>
                <label for="nome=">Cliente:</label>
                <input type="text" name="nome=" id="nome="><br>

                <label for="aporte">Aporte inicial (R$):</label>
                <input type="number" name="aporte" id="aporte" min="1" max="999999" step="0.01">

                <label for="periodo">Período (meses):</label>
                <input type="number" name="periodo" min="1" max="120">

                <label for="rendimento">Rendimento mensal (%):</label>
                <input type="number" name="rendimento" id="rendimento" min="0.1" max="20" step="0.01">

                <label for="aporte">Aporte mensal:</label>
                <input type="number" name="aporte" id="aporte" min="1" max="999999">
                
                <input type="submit" class="input-botao" value="Processar">
            </fieldset>
        </form>

        
        <a href="./index.html">Voltar</a>

    </main>

    <footer>
        <p> Eduardo Veloso/Rafael Barros - &copy; 2023</p>  
    </footer>
</body>
</html>