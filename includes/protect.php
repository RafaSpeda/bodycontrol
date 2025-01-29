<?php
// Configurações da sessão
ini_set('session.cookie_lifetime', 0); 
ini_set('session.gc_maxlifetime', 21600); 

// Inicia a sessão se não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>
