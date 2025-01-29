<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Matrícula</title>
    <link rel="stylesheet" href="../assets/css/novaMatricula-style.css">
</head>
<body>
    <header>
        <h1>Nova Matrícula</h1>
    </header>
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="dados">
            <label for="Nome">Nome Completo: </label>
            <input type="text" id="nome" name="nome" required>
            <br>
            <label for="cpf">CPF <i>(Somente números)</i>: </label>
            <input type="number" id="cpf" name="cpf" required>
            <br>
            <label for="nascimento">Data de Nascimento: </label>
            <input type="date" id="nascimento" name="nascimento">
            <br>
            <label for="cel">Celular: </label>
            <input type="tel" id="cel" name="cel" required value="+55 ">
            <br>
            <label for="email">E-mail: </label>
            <input type="text" id="email" name="email" required>
            <br>
            <label for="situacaoFinancera">Situação Financeira: </label>
            <select id="sFincanceira" name="sFinanceira">
                <option value="Pago">Pago</option>
                <option value="Não Pago">Não Pago</option>
            </select>
            <input type="submit" value="Cadastrar">
            <button type="button" onclick="window.location.href='index.html'">Sair</button>
        </form>
        
    </main>

    <div id="php" name="php">
    <?php
include('../includes/protect.php');
require "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new DB();

    $params = [
        ":nome" => htmlspecialchars($_POST['nome']),
        ":cpf" => preg_replace('/\D/', '', $_POST['cpf']), // Remove caracteres não numéricos do CPF
        ":nascimento" => $_POST['nascimento'],
        ":cel" => htmlspecialchars($_POST['cel']),
        ":email" => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : '',
        ":sFinanceira" => $_POST['sFinanceira']
    ];

    if (!$params[':email']) {
        echo "E-mail inválido!";
        exit();
    }

    $sql = "INSERT INTO academia.clientes (nome, cpf, data_nascimento, celular, email, situacao_financeira) 
            VALUES (:nome, :cpf, :nascimento, :cel, :email, :sFinanceira)";

    if ($db->executeSQL($sql, $params)) {
        echo "<br>Matrícula realizada com sucesso!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<br>Erro ao inserir os dados.";
    }
}
?>

    </div>
</body>
</html>
