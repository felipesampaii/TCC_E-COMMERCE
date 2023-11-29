<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="login.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>

<body>
<?php  
include 'conexao.php';

// Verifique se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_conta = $_POST['tipo_conta'];
    
    // Inserir dados na tabela "pessoa"
    $email_pessoa = $_POST['email'];
    $senha_pessoa = $_POST['senha'];

    // Use the correct table name and column names
    $query_pessoa = "INSERT INTO pessoa (email_pessoa, senha_pessoa) VALUES ('$email_pessoa', '$senha_pessoa')";
    
    if ($mysqli->query($query_pessoa)) {
        // Recuperar o ID inserido na tabela "pessoa"
        $pessoa_id = $mysqli->insert_id;
        
        if ($tipo_conta === 'pessoa_fisica') {
            // Inserir dados na tabela "pessoa_fisica"
            $nome_pf = $_POST['nome'];
            $sobrenome_pf = $_POST['sobrenome_pf'];
            $nascimento_pf = $_POST['nascimento_pf'];
            $cpf_pf = $_POST['cpf_pf'];
            
            // Use the correct table name and column names
            $query_pf = "INSERT INTO pessoa_fisica (nome_pf, sobrenome_pf, nascimento_pf, cpf_pf) 
                         VALUES ('$nome_pf', '$sobrenome_pf', '$nascimento_pf', '$cpf_pf')";
            
            $mysqli->query($query_pf);
        } 
        elseif ($tipo_conta === 'pessoa_juridica') {
            // Inserir dados na tabela "pessoa_juridica"
            $nome_fantasia_pf = $_POST['nome_fantasia'];
            $razao_social_pj = $_POST['razao_social_pj'];
            $cnpj_pj = $_POST['cnpj_pj'];
            $abertura_pj = $_POST['abertura_pj'];
            $funcionario_comprador_pj = $_POST['funcionario_comprador_pj'];
            
            // Use the correct table name and column names
            $query_pj = "INSERT INTO pessoa_juridica (nome_fantasia, razao_social, cnpj_pj, abertura_pj, funcionario_comprador_pj) 
                         VALUES ('$nome_fantasia_pf', '$razao_social_pj', '$cnpj_pj', '$abertura_pj', '$funcionario_comprador_pj')";
            
            $mysqli->query($query_pj);
        }
        
        // Redirecione para uma página de sucesso ou faça qualquer outra ação necessária
        header('Location: index.php');
        exit;
    } 
    else {
        echo "Erro ao cadastrar os dados. Por favor, tente novamente.";
    }
}
?>

<div class="nav">
    <nav class="navbar navbar-inverse"><!--Apague o inverse para estar alterando a cor do menu de navegação-->
    <div class="container-fluid"><!--Essa linha cria uma borda entre o menu e o texto-->
        
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>              <!--Esse é o botão hamburguer que aparece quando o site-->
            <span class="icon-bar"></span>                              <!-- nao está em tela cheia-->
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Protector Kings</a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="login.php"><span> Login</a></li>
            <li><a href="contato.php">Contato</a></li>
        </ul>
        </div>
    </div>
    </nav>
</div>
<h1>Cadastro</h1>
    <form action="cadastro_cliente.php" method="POST">
        <label for="tipo_conta">Tipo de conta:</label>
        <select name="tipo_conta" id="tipo_conta" required>
            <option value="pessoa_fisica">Pessoa Física</option>
            <option value="pessoa_juridica">Pessoa Jurídica</option>
        </select><br><br>

        <!--tabela pessoa fisica junto com a tabela pessoa-->
        <div id="pessoa_fisica" style="display: none;" selected>
            <label for="nome">Nome:</label>
            <input type="text" name="nome_pf" required><br><br>

            <label for="sobrenome">Sobrenome:</label>
            <input type="text" name="sobrenome_pf" required><br><br>

            <label for="nascimento">Data de Nascimento:</label>
            <input type="date" name="nascimento_pf" required><br><br>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf_pf" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br><br>
            
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required><br><br>
        </div>

        <!--tabela pessoa juridica junto com a tabela pessoa-->
        <div id="pessoa_juridica" style="display: none;">
            <label for="nome">Nome fantasia</label>
            <input type="text" name="nome_fantasia" required><br><br>

            <label for="nome">Razão social</label>
            <input type="text" name="razao_social_pj" required><br><br>

            <label for="nome">CNPJ</label>
            <input type="text" name="cnpj_pj" required><br><br>

            <label for="nome">Abertura</label>
            <input type="text" name="abertura_pj" required><br><br>

            <label for="nome">Funcionario comprador</label>
            <input type="text" name="funcionario_comprador_pj" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br><br>
            
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required><br><br>
        </div>
        
        <input type="submit" value="Cadastrar" id="cadastro_button">
    </form>

    <script>
        document.getElementById('tipo_conta').addEventListener('change', function() {
            // Obtém o valor selecionado no select
            var selectedOption = this.value;

            // Mostra ou oculta os campos com base na seleção
            if (selectedOption === 'pessoa_fisica') {
                document.getElementById('pessoa_fisica').style.display = 'block';
                document.getElementById('pessoa_juridica').style.display = 'none';
            } else if (selectedOption === 'pessoa_juridica') {
                document.getElementById('pessoa_fisica').style.display = 'none';
                document.getElementById('pessoa_juridica').style.display = 'block';
            } else {
                document.getElementById('pessoa_fisica').style.display = 'none';
                document.getElementById('pessoa_juridica').style.display = 'none';
            }
        });
    </script>
</body>

<?php include 'rodape.html' ?>
</body>
</html>
