<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculando Idade</title>
</head>
<body>
    <header>
        <h1>Calculando sua Idade</h1>
    </header>
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
            <label for="nascimento">Digite o ano em que você nasceu: </label>
            <input type="number" name="nascimento">
            <input type="submit" value="Calcular">
        </form>
    </main>
    <section>
        <?php 
            $ano_atual = date('Y');
            $ano_nascimento = $_GET['nascimento'] ?? 0;

                echo "Você tem " . ($ano_atual - $ano_nascimento) . " anos.";
        ?>
    </section>
</body>
</html>
