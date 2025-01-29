<?php
// Inclui a classe DB
require "./db.php";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Manipula os parâmetros
    $params = [
        ":id" => $_POST['id'],
        ":nome" => $_POST['nome'],
        ":cpf" => $_POST['cpf'],
        ":nascimento" => $_POST['data_nascimento'],
        ":cel" => $_POST['celular'],
        ":email" => $_POST['email'],
        ":sFinanceira" => $_POST['situacao_financeira']
    ];

    // Classe DB
    $db = new DB();

    // Atualiza os dados
    $sql = "UPDATE academia.clientes 
            SET 
                nome = :nome,
                cpf = :cpf,
                data_nascimento = :nascimento,
                celular = :cel,
                email = :email,
                situacao_financeira = :sFinanceira
            WHERE id = :id";

    // Executa o comando
    if ($db->executeSQL($sql, $params)) {
        echo "Dados atualizados com sucesso!";
        header('Location: gerenciamento.php');
        exit;
    } else {
        echo "Erro ao atualizar os dados.";
    }
} else {
    header('Location: gerenciamento.php');
    exit;
}
