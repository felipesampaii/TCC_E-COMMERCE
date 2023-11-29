<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.main.js"></script>

<?php
include 'conexao.php'; // Inclua o arquivo de conexão

// Verifique se a requisição foi feita com o método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Coletar os dados do formulário
    $nome_produto = $_POST['nome_produto'];
    $descricao_produto = $_POST['descricao_produto'];
    $preco_produto = $_POST['preco_produto'];
    $categoria_produto = $_POST['categoria_produto'];
    $pasta_imagem = $_POST['pasta_imagem'];
    $imagem_produto = $_POST['imagem_produto'];
    $quantidade_produto = $_POST['quantidade_produto'];

    // Preparar a consulta SQL e inserir os dados no banco de dados
    $sql = "INSERT INTO produto(nome_produto, descricao_produto, preco_produto, categoria_produto, 
                        pasta_imagem, imagem_produto, quantidade_produto) 
                VALUES ('$nome_produto', '$descricao_produto', '$preco_produto', '$categoria_produto', 
                        '$pasta_imagem', '$imagem_produto', '$quantidade_produto')";

    if ($mysqli->query($sql) == TRUE) {
        include 'menu.php';
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o produto: " . $mysqli->error;
    }
}

// Fechar a conexão com o banco de dados
$mysqli->close();
?>