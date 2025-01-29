<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Alunos</title>
    <link rel="stylesheet" href="../assets/css/gerenciamento-style.css">
</head>
<body>
    <header>
        <h1>Gerenciamento de Alunos</h1>
    </header>

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

    <section>
        <?php
        include('../includes/protect.php');
        require "../includes/db.php";

        $conteudo = $_GET['consulta'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $db = new DB();
            $params = [];

            if (!empty($conteudo)) {
                $params = [":valor" => $conteudo . '%'];
                $sql = "SELECT * FROM academia.clientes WHERE nome LIKE :valor OR cpf LIKE :valor OR celular LIKE :valor";
            } else {
                $sql = "SELECT * FROM academia.clientes";
            }

            $result = $db->executeSQL($sql, $params);

            if ($result) {
                $dados = $db->listData();

                if (!empty($dados)) {
                    echo "<table>";
                    echo "<tr><th>Nome</th><th>CPF</th><th>Celular</th><th>Email</th><th>Data de Nascimento</th><th>Situação Financeira</th><th>Ações</th></tr>";

                    foreach ($dados as $linha) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($linha['nome'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($linha['cpf'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($linha['celular'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($linha['email'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . (DateTime::createFromFormat('Y-m-d', $linha['data_nascimento'])
                            ? (DateTime::createFromFormat('Y-m-d', $linha['data_nascimento']))->format('d/m/Y') 
                            : '') . "</td>";
                        echo "<td>" . htmlspecialchars($linha['situacao_financeira'], ENT_QUOTES, 'UTF-8') . "</td>";
                        $id = $linha['id'];
                        echo "<td><a href='editar.php?id=$id'><img src='../assets/imagens/lapis.png' alt='Editar' style='width:20px; height:20px;'></a></td>";
                        echo "<td><a href='#' onclick='confirmarExclusao($id)'><img src='../assets/imagens/lixo.webp' alt='Excluir' style='width:20px; height:20px;'></a></td>";
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

        if (isset($_GET['excluir'])) {
            $idExcluir = $_GET['excluir'];
            $db = new DB();
            $sqlExcluir = "DELETE FROM academia.clientes WHERE id = :id";
            $paramsExcluir = [':id' => $idExcluir];
            $db->executeSQL($sqlExcluir, $paramsExcluir);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
        ?>

        <script>
        function confirmarExclusao(id) {
            if (confirm("ESSA AÇÃO IRÁ APAGAR OS DADOS PERMANENTEMENTE!")) {
                window.location.href = "?excluir=" + id;
            }
        }
        </script>
    </section>
    <footer>
        <a href="../includes/logout.php">Encerrar Sessão</a>
    </footer>
</body>
</html>
