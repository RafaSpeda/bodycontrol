<?php
// Inclui a classe DB
require "./db.php";

// Verifica se o ID foi passado pela URL
$id = $_GET['id'] ?? null;

// Redireciona para a página inicial se o ID não for válido
if (!$id) {
    header('Location: gerenciamento.php');
    exit;
}

// Classe DB
$db = new DB();

// Consulta para buscar os dados do aluno pelo ID
$sql = "SELECT * FROM academia.clientes WHERE id = :id";
$params = [':id' => $id];
$result = $db->executeSQL($sql, $params);

// Verifica se o aluno foi encontrado
if (!$result) {
    echo "Aluno não encontrado.";
    exit;
}

// Obtém os dados do aluno
$aluno = $db->listData()[0];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="db-style.css">
</head>
<body>
    <header>
        <h1>Editar Aluno</h1>
    </header>

    <form action="salvarEdicao.php" method="post">
        <!-- Campo oculto para enviar o ID -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($aluno['id']); ?>">
        <br>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($aluno['nome']); ?>" required>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" value="<?php echo htmlspecialchars($aluno['cpf']); ?>" required>
        <br>
        <label for="celular">Celular:</label>
        <input type="text" name="celular" id="celular" value="<?php echo htmlspecialchars($aluno['celular']); ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($aluno['email']); ?>" required>
        <br>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo htmlspecialchars($aluno['data_nascimento']); ?>" required>
        <br>
        <label for="situacao_financeira">Situação Financeira:</label>
        <select name="situacao_financeira" id="situacao_financeira" required>
            <option value="Pago" <?php echo $aluno['situacao_financeira'] === 'Adimplente' ? 'selected' : ''; ?>>Adimplente</option>
            <option value="Não Pago" <?php echo $aluno['situacao_financeira'] === 'Inadimplente' ? 'selected' : ''; ?>>Inadimplente</option>
        </select>
        <br>
        <button type="submit">Salvar</button><br>
        <a href="gerenciamento.php">Cancelar</a>
    </form>
</body>
</html>
