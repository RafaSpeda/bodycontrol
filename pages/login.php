<?php
include('../includes/conexao-login.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email']) || empty($_POST['senha'])) {
        echo "Preencha todos os campos.";
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $_POST['senha'];

        // Consulta usando prepared statement para evitar SQL Injection
        $stmt = $mysqli->prepare("SELECT id, nome, senha FROM academia.proprietarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();
            
            // Verifica a senha
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                header("Location: index.html");
                exit();
            }
        }

        echo "Credenciais inválidas.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style-login.css">
</head>
<body>
    <div class="login-container">
        <h1>Acesse sua Conta</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <button type="submit">Entrar</button>
            </div>
        </form>
    </div>
</body>
</html>
