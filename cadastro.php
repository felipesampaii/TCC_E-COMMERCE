<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados comuns para ambas as pessoas
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $tipo_pessoa = $_POST["tipo_pessoa"];

    // Inserir dados na tabela pessoa
    $sql = "INSERT INTO pessoa (email, senha, tipo_pessoa) VALUES ('$email', '$senha', $tipo_pessoa)";
    $mysqli->query($sql);

    // Obter o ID da pessoa recém-inserida
    $id_pessoa = $mysqli->insert_id;

    //------------------------------------------------------------------------------------------------------
    // Verifique o tipo de pessoa selecionado para o campo estado
    if ($tipo_pessoa == 1) {
        $estado_pf = $_POST["estado_pf"];
    } 
    elseif ($tipo_pessoa == 2) {
        $estado_pj = $_POST["estado_pj"];
    }
    

    //------------------------------------------------------------------------------------------------------
    // Inserir dados de telefone
    if ($tipo_pessoa == 1) {
        $telefone_pf_ddd = $_POST["telefone_pf_ddd"];
        $telefone_pf_numero = $_POST["telefone_pf_numero"];

        // Inserir dados na tabela telefone para Pessoa Física
        $sql_telefone_pf = "INSERT INTO telefone (ddd, numero, id_pessoa)
                            VALUES ('$telefone_pf_ddd', '$telefone_pf_numero', $id_pessoa)";
        $mysqli->query($sql_telefone_pf);
    } 
    elseif ($tipo_pessoa == 2) { // Pessoa Jurídica
        $telefone_pj_ddd = $_POST["telefone_pj_ddd"];
        $telefone_pj_numero = $_POST["telefone_pj_numero"];

        // Inserir dados na tabela telefone para Pessoa Jurídica
        $sql_telefone_pj = "INSERT INTO telefone (ddd, numero, id_pessoa)
                            VALUES ('$telefone_pj_ddd', '$telefone_pj_numero', $id_pessoa)";
        $mysqli->query($sql_telefone_pj);
    }

    //-----------------------------------------------------------------------------------------------------------------
    // tabela endereço 
    if ($tipo_pessoa == 1) { // Pessoa Física
        $logradouro_pf = $_POST["logradouro_pf"];
        $estado_pf = $_POST["estado_pf"];
        $cidade_pf = $_POST["cidade_pf"];
        $bairro_pf = $_POST["bairro_pf"];
        $cep_pf = $_POST["cep_pf"];
        $numero_pf = $_POST["numero_pf"];
        $complemento_pf = $_POST["complemento_pf"];
    
        // Inserir dados na tabela endereco para Pessoa Física
        $sql_endereco_pf = "INSERT INTO endereco (logradouro, estado, cidade, bairro, cep, numero, complemento, id_pessoa)
                            VALUES ('$logradouro_pf', '$estado_pf', '$cidade_pf', '$bairro_pf', '$cep_pf', '$numero_pf', '$complemento_pf', $id_pessoa)";
        $mysqli->query($sql_endereco_pf);
    } 
    elseif ($tipo_pessoa == 2) { // Pessoa Jurídica
        $logradouro_pj = $_POST["logradouro_pj"];
        $estado_pj = $_POST["estado_pj"];
        $cidade_pj = $_POST["cidade_pj"];
        $bairro_pj = $_POST["bairro_pj"];
        $cep_pj = $_POST["cep_pj"];
        $numero_pj = $_POST["numero_pj"];
        $complemento_pj = $_POST["complemento_pj"];
    
        // Inserir dados na tabela endereco para Pessoa Jurídica
        $sql_endereco_pj = "INSERT INTO endereco (logradouro, estado, cidade, bairro, cep, numero, complemento, id_pessoa)
                            VALUES ('$logradouro_pj', '$estado_pj', '$cidade_pj', '$bairro_pj', '$cep_pj', '$numero_pj', '$complemento_pj', $id_pessoa)";
        $mysqli->query($sql_endereco_pj);
    }

//--------------------------------------------------------------------------------------------------------------------
// tabelas pessoa fisica e pessoa juridica
    if ($tipo_pessoa == 1) { // Pessoa Física
        $nome_pf = $_POST["nome_pf"];
        $sobrenome_pf = $_POST["sobrenome_pf"];
        $nascimento_pf = $_POST["nascimento_pf"];
        $cpf_pf = $_POST["cpf_pf"];

        // Inserir dados na tabela pessoa_fisica
        $sql_pf = "INSERT INTO pessoa_fisica (nome_pf, sobrenome_pf, nascimento_pf, cpf_pf, id_pessoa)
                    VALUES ('$nome_pf', '$sobrenome_pf', '$nascimento_pf', '$cpf_pf', $id_pessoa)";

        $mysqli->query($sql_pf);
    }
    elseif ($tipo_pessoa == 2) { // Pessoa Jurídica
        $nome_fantasia_pj = $_POST["nome_fantasia_pj"];
        $razao_social_pj = $_POST["razao_social_pj"];
        $cnpj_pj = $_POST["cnpj_pj"];
        $abertura_pj = $_POST["abertura_pj"];
        $funcionario_comprador_pj = $_POST["funcionario_comprador_pj"];

        // Inserir dados na tabela pessoa_juridica
        $sql_pj = "INSERT INTO pessoa_juridica (nome_fantasia_pj, razao_social_pj, cnpj_pj, abertura_pj, funcionario_comprador_pj, id_pessoa)
                    VALUES ('$nome_fantasia_pj', '$razao_social_pj', '$cnpj_pj', '$abertura_pj', '$funcionario_comprador_pj', $id_pessoa)";

        if(!$mysqli->query($sql_pj)){
            $erroCadastro = true;
        }
    }

    if ($erroCadastro) {
        echo "Erro ao cadastrar os dados. Por favor, tente novamente.";
    } 
    else {
        // Redirecionar para a página de login
        header('Location: login.php');
        exit;
    }
}
else {
    $erroCadastro = true;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Clientes</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


     <script src="jquery.mask.js"></script>
</head>

<body>
<!------------------------------------------------------------------------------------------------->
<!--Menu-->
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
<!-------------------------------------------------------------------------------------------------->

    <h1>Criar conta</h1>
    <form method="POST" action="" onsubmit="return validarSenha();">
        <label>Tipo de Pessoa:</label></br>
        <input type="radio" name="tipo_pessoa" value="1" required onclick="showFields('pessoa_fisica_fields')"> Pessoa Física
        <input type="radio" name="tipo_pessoa" value="2" required onclick="showFields('pessoa_juridica_fields')"> Pessoa Jurídica<br>

        <!-- Campos específicos para Pessoa Física -->
        <div id="pessoa_fisica_fields" style="display: none;">
            <label for="nome_pf">Nome:</label>
            <input type="text" name="nome_pf"><br>

            <label for="sobrenome_pf">Sobrenome:</label>
            <input type="text" name="sobrenome_pf"><br>

            <label for="nascimento_pf">Data de Nascimento:</label>
            <input type="date" name="nascimento_pf"><br>

            <label for="cpf_pf">CPF:</label>
            <input type="text" name="cpf_pf" maxlength="11"><br>

            <label for="telefone_pf">Telefone:</label>
            <input type="text" name="telefone_pf_ddd" placeholder="DDD" maxlength="3">
            <input type="text" name="telefone_pf_numero" placeholder="Número" maxlength="11"><br>

            <label for="estado_pf">Estado:</label>
            <select name="estado_pf">
                <option value="AC">Acre (AC)</option>
                <option value="AL">Alagoas (AL)</option>
                <option value="AP">Amapá (AP)</option>
                <option value="AM">Amazonas (AM)</option>
                <option value="BA">Bahia (BA)</option>
                <option value="CE">Ceará (CE)</option>
                <option value="DF">Distrito Federal (DF)</option>
                <option value="ES">Espírito Santo (ES)</option>
                <option value="GO">Goiás (GO)</option>
                <option value="MA">Maranhão (MA)</option>
                <option value="MT">Mato Grosso (MT)</option>
                <option value="MS">Mato Grosso do Sul (MS)</option>
                <option value="MG">Minas Gerais (MG)</option>
                <option value="PA">Pará (PA)</option>
                <option value="PB">Paraíba (PB)</option>
                <option value="PR">Paraná (PR)</option>
                <option value="PE">Pernambuco (PE)</option>
                <option value="PI">Piauí (PI)</option>
                <option value="RJ">Rio de Janeiro (RJ)</option>
                <option value="RN">Rio Grande do Norte (RN)</option>
                <option value="RS">Rio Grande do Sul (RS)</option>
                <option value="RO">Rondônia (RO)</option>
                <option value="RR">Roraima (RR)</option>
                <option value="SC">Santa Catarina (SC)</option>
                <option value="SP">São Paulo (SP)</option>
                <option value="SE">Sergipe (SE)</option>
                <option value="TO">Tocantins (TO)</option>
            </select><br>

            <label for="bairro_pf">Bairro:</label>
            <input type="text" name="bairro_pf"><br>

            <label for="cep_pf">CEP:</label>
            <input type="text" name="cep_pf"><br>

            <label for="logradouro_pj">Logradouro:</label>
            <input type="text" name="logradouro_pj"><br>

            <label for="numero_pf">Número:</label>
            <input type="text" name="numero_pf"><br>

            <label for="complemento_pf">Complemento:</label>
            <input type="text" name="complemento_pf" placeholder="Opcional"><br>
        </div>

        <!-- Campos específicos para Pessoa Jurídica -->
        <div id="pessoa_juridica_fields" style="display: none;">
            <label for="nome_fantasia_pj">Nome Fantasia:</label>
            <input type="text" name="nome_fantasia_pj"><br>

            <label for="razao_social_pj">Razão Social:</label>
            <input type="text" name="razao_social_pj"><br>

            <label for="cnpj_pj">CNPJ:</label>
            <input type="text" name="cnpj_pj" maxlength="14"><br>

            <label for="abertura_pj">Data de Abertura:</label>
            <input type="text" name="abertura_pj"><br>

            <label for="funcionario_comprador_pj">Funcionário Comprador:</label>
            <input type="text" name="funcionario_comprador_pj"><br>

            <label for="telefone_pj">Telefone:</label>
            <input type="text" name="telefone_pj_ddd" placeholder="DDD" maxlength="3">
            <input type="text" name="telefone_pj_numero" placeholder="Número" maxlength="11"><br>

            <label for="estado_pj">Estado:</label>
            <select name="estado_pj">
                <option value="AC">Acre (AC)</option>
                <option value="AL">Alagoas (AL)</option>
                <option value="AP">Amapá (AP)</option>
                <option value="AM">Amazonas (AM)</option>
                <option value="BA">Bahia (BA)</option>
                <option value="CE">Ceará (CE)</option>
                <option value="DF">Distrito Federal (DF)</option>
                <option value="ES">Espírito Santo (ES)</option>
                <option value="GO">Goiás (GO)</option>
                <option value="MA">Maranhão (MA)</option>
                <option value="MT">Mato Grosso (MT)</option>
                <option value="MS">Mato Grosso do Sul (MS)</option>
                <option value="MG">Minas Gerais (MG)</option>
                <option value="PA">Pará (PA)</option>
                <option value="PB">Paraíba (PB)</option>
                <option value="PR">Paraná (PR)</option>
                <option value="PE">Pernambuco (PE)</option>
                <option value="PI">Piauí (PI)</option>
                <option value="RJ">Rio de Janeiro (RJ)</option>
                <option value="RN">Rio Grande do Norte (RN)</option>
                <option value="RS">Rio Grande do Sul (RS)</option>
                <option value="RO">Rondônia (RO)</option>
                <option value="RR">Roraima (RR)</option>
                <option value="SC">Santa Catarina (SC)</option>
                <option value="SP">São Paulo (SP)</option>
                <option value="SE">Sergipe (SE)</option>
                <option value="TO">Tocantins (TO)</option>
            </select><br>

            <label for="bairro_pj">Bairro:</label>
            <input type="text" name="bairro_pj"><br>

            <label for="cep_pj">CEP:</label>
            <input type="text" name="cep_pj"><br>

            <label for="logradouro_pj">Logradouro:</label>
            <input type="text" name="logradouro_pj"><br>

            <label for="numero_pj">Número:</label>
            <input type="text" name="numero_pj"><br>

            <label for="complemento_pj">Complemento:</label>
            <input type="text" name="complemento_pj" placeholder="Opcional"><br>
        </div>

        <!-- Campos de email e senha (inicialmente ocultos) -->
        <div id="email_senha_fields" style="display: none;">
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" required><br>

            <!--<label for="confirmar_senha">Confirmar Senha:</label>
            <input type="password" name="confirmar_senha" id="confirmar_senha" required><br>-->
        </div>

        <input type="submit" value="Cadastrar" id="cadastrar" style="display: none;">
    </form>

    <script>
        // a masca nao está funcionando.
        //$(document).ready(function(){
                //$("#cep_pf").mask("00 000-000");
            //});


        // Função para mostrar/ocultar campos com base no tipo de pessoa selecionado
        function showFields(id) {
            // Oculta todos os campos
            document.getElementById('email_senha_fields').style.display = 'none';
            document.getElementById('pessoa_fisica_fields').style.display = 'none';
            document.getElementById('pessoa_juridica_fields').style.display = 'none';

            // Mostrar os campos do tipo selecionado
            document.getElementById(id).style.display = 'block';

            // Mostrar o botão de cadastro somente quando uma das opções for selecionada
            document.getElementById('cadastrar').style.display = 'block';

            // Mostra os campos de email e senha somente quando uma das opções for selecionada
            if (id === 'pessoa_fisica_fields' || id === 'pessoa_juridica_fields') {
                document.getElementById('email_senha_fields').style.display = 'block';
            }
        }

        //function validarSenha() {
            //var senha = document.getElementById("senha").value;
            //var confirmarSenha = document.getElementById("confirmar_senha").value;

            //if (senha !== confirmarSenha) {
                //alert("As senhas não coincidem. Por favor, verifique.");
                //return false;
            //}

            //return true;
        //}
    </script>
<?php include 'rodape.html' ?>
</body>
</html>

