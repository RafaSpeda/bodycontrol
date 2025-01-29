<?php
$usuario = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';

// Ativar relatórios de erro apenas em desenvolvimento
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $mysqli = new mysqli($host, $usuario, $senha, $database);
    $mysqli->set_charset("utf8mb4"); // Define charset
} catch (Exception $e) {
    error_log($e->getMessage()); // Registra erro no log
    die("Erro ao conectar ao banco de dados. Tente novamente mais tarde.");
}
?>
