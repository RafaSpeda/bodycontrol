<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Alunos</title>
    <link rel="stylesheet" href="db-style.css">
</head>
<body>
    <header>
        <h1>Gerenciamento de Alunos</h1>
    </header>

    <!-- Contêiner que envolve o botão de nova matrícula e o formulário -->
    <div id="container">
        <div id="matricula">
            <a href="novaMatricula.php">+ Nova Matrícula</a>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" id="consultar" name="consultar">
            <label for="consulta">Alunos Matriculados</label>
            <input type="text" placeholder="Nome, CPF ou Cel." name="consulta" id="consulta">
            <input type="submit" value="Pesquisar">
        </form>
    </div>
    <br><br>
    
    <section>

       <?php
// Inclui a classe DB
require "./db.php";

// Captura o conteúdo da input
$conteudo = $_GET['consulta'] ?? '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Classe DB
    $db = new DB();

    // Parâmetro para a consulta
    $params = [];

    // Ajusta a consulta SQL dependendo se o campo de busca está vazio
    if (!empty($conteudo)) {
        $params = [":valor" => $conteudo . '%'];
        $sql = "SELECT * FROM academia.clientes WHERE nome LIKE :valor OR cpf LIKE :valor OR celular LIKE :valor";
    } else {
        $sql = "SELECT * FROM academia.clientes"; // Exibe todos os dados se não houver consulta
    }

    // Faz a consulta SQL
    $result = $db->executeSQL($sql, $params);

    // Verifica se há resultados
    if ($result) {
        // Lista os dados
        $dados = $db->listData();

        // Exibe os resultados
        if (!empty($dados)) {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Nome</th>";
            echo "<th>CPF</th>";
            echo "<th>Celular</th>";
            echo "<th>Email</th>";
            echo "<th>Data de Nascimento</th>";
            echo "<th>Situação Financeira</th>";
            echo "<th>Ações</th>";
            echo "</tr>";

            foreach ($dados as $linha) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($linha['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['cpf']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['celular']) . "</td>";
                echo "<td>" . htmlspecialchars($linha['email']) . "</td>";
                // Data formatada
                echo "<td>" . (DateTime::createFromFormat('Y-m-d', $linha['data_nascimento']) 
                    ? (DateTime::createFromFormat('Y-m-d', $linha['data_nascimento']))->format('d/m/Y') 
                    : '') . "</td>";
                echo "<td>" . htmlspecialchars($linha['situacao_financeira']) . "</td>";
                
                // Adicionando as colunas de editar e excluir com links dinâmicos
                $id = $linha['id']; // O ID já existe no banco de dados
                echo "<td><a href='editar.php?id=$id'><img src='https://storage.needpix.com/rsynced_images/pencil-148062_1280.png' alt='Editar' style='width:20px; height:20px;'></a></td>";
                echo "<td><a href='#' onclick='confirmarExclusao($id)'><img src='https://cdn.iconscout.com/icon/free/png-256/free-lixo-3114483-2598175.png' alt='Excluir' style='width:20px; height:20px;'></a></td>";

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nenhum registro encontrado.</p>";
        }
    } else {
        echo "<p>Erro ao executar a consulta.</p>";
    }
}

// Verifica se a variável excluir foi passada na URL
if (isset($_GET['excluir'])) {
    $idExcluir = $_GET['excluir'];

    // Classe DB
    $db = new DB();

    // Comando SQL para excluir o usuário, usando o ID já presente no banco de dados
    $sqlExcluir = "DELETE FROM academia.clientes WHERE id = :id";
    $paramsExcluir = [':id' => $idExcluir];
    $db->executeSQL($sqlExcluir, $paramsExcluir);

    // Redireciona para não reenviar o formulário e atualizar a lista de alunos
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<script>
// Função para confirmar a exclusão
function confirmarExclusao(id) {
    if (confirm("Você tem certeza que deseja excluir este aluno?")) {
        window.location.href = "?excluir=" + id; // Redireciona para excluir o registro
    }
}
</script>

        
    </section>

</body>
</html>