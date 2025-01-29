<?php
include('../includes/protect.php');
require "../includes/db.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: gerenciamento.php');
    exit;
}

// Consulta SQL
$db = new DB();
$sql = "SELECT * FROM academia.clientes WHERE id = :id";
$params = [':id' => $id];
$result = $db->executeSQL($sql, $params);

if (!$result) {
    echo "Aluno não encontrado.";
    exit;
}

$aluno = $db->listData()[0];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="../assets/css/editar-style.css">
</head>
<body>
    <form action="salvarEdicao.php" method="post">
        <header>
            <h1>Editar Aluno</h1>
        </header>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($aluno['id'], ENT_QUOTES, 'UTF-8'); ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($aluno['nome'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" value="<?php echo htmlspecialchars($aluno['cpf'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <br>
        <label for="celular">Celular:</label>
        <input type="text" name="celular" id="celular" value="<?php echo htmlspecialchars($aluno['celular'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($aluno['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <br>
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo htmlspecialchars($aluno['data_nascimento'], ENT_QUOTES, 'UTF-8'); ?>" required>
        <br>
        <label for="situacao_financeira">Situação Financeira:</label>
        <select name="situacao_financeira" id="situacao_financeira" required>
            <option value="Pago" <?php echo $aluno['situacao_financeira'] === 'Pago' ? 'selected' : ''; ?>>Pago</option>
            <option value="Não Pago" <?php echo $aluno['situacao_financeira'] === 'Não Pago' ? 'selected' : ''; ?>>Não Pago</option>
        </select>
        <br>
        <button type="submit">Salvar</button>
        <a href="gerenciamento.php">Cancelar</a>
    </form>
</body>
</html>
