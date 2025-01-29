<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Matrícula</title>
    <link rel="stylesheet" href="novaMatricula-style.css">
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
        </form>
    </main>

    <div id="php" name="php">
        <?php
        // Inclui a classe DB
        require "./db.php";

        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Classe DB
            $db = new DB();

            // Manipula os parâmetros
            $params = [
                ":nome" => $_POST['nome'],
                ":cpf" => $_POST['cpf'],
                ":nascimento" => $_POST['nascimento'],
                ":cel" => $_POST['cel'],
                ":email" => $_POST['email'],
                ":sFinanceira" => $_POST['sFinanceira']
            ];

            // Insere os dados
            $sql = "INSERT INTO academia.clientes (nome, cpf, data_nascimento, celular, email, situacao_financeira) 
                    VALUES (:nome, :cpf, :nascimento, :cel, :email, :sFinanceira)";

            // Executa o comando
            if ($db->executeSQL($sql, $params)) {
                echo "<br>";
                echo "Matrícula realizada com sucesso!";
            } else {
                echo "<br>";
                echo "Erro ao inserir os dados.";
            }
        
            // Impede o reenvio do formulário
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        
        }
        ?>
    </div>
</body>
</html>
