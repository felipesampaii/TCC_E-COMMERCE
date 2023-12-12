<?php 
include 'conexao.php';
include 'cadastro_if.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Clientes</title>

    <?php include 'links.php'; ?>
        
    <link rel="stylesheet" href="cadastro.css">

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
            <?php  include 'session_start.php';?>
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
            <option value="AC">(AC)</option>
                <option value="AL">(AL)</option>
                <option value="AP">(AP)</option>
                <option value="AM">(AM)</option>
                <option value="BA">(BA)</option>
                <option value="CE">(CE)</option>
                <option value="DF">(DF)</option>
                <option value="ES">(ES)</option>
                <option value="GO">(GO)</option>
                <option value="MA">(MA)</option>
                <option value="MT">(MT)</option>
                <option value="MS">(MS)</option>
                <option value="MG">(MG)</option>
                <option value="PA">(PA)</option>
                <option value="PB">(PB)</option>
                <option value="PR">(PR)</option>
                <option value="PE">(PE)</option>
                <option value="PI">(PI)</option>
                <option value="RJ">(RJ)</option>
                <option value="RN">(RN)</option>
                <option value="RS">(RS)</option>
                <option value="RO">(RO)</option>
                <option value="RR">(RR)</option>
                <option value="SC">(SC)</option>
                <option value="SP">(SP)</option>
                <option value="SE">(SE)</option>
                <option value="TO">(TO)</option>
            </select><br>

            <label for="cidade_pf">Cidade:</label>
            <input type="text" name="cidade_pf"><br>

            <label for="bairro_pf">Bairro:</label>
            <input type="text" name="bairro_pf"><br>

            <label for="cep_pf">CEP:</label>
            <input type="text" name="cep_pf"><br>

            <label for="logradouro_pj">Logradouro:</label>
            <input type="text" name="logradouro_pf"><br>

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
                <option value="AC">(AC)</option>
                <option value="AL">(AL)</option>
                <option value="AP">(AP)</option>
                <option value="AM">(AM)</option>
                <option value="BA">(BA)</option>
                <option value="CE">(CE)</option>
                <option value="DF">(DF)</option>
                <option value="ES">(ES)</option>
                <option value="GO">(GO)</option>
                <option value="MA">(MA)</option>
                <option value="MT">(MT)</option>
                <option value="MS">(MS)</option>
                <option value="MG">(MG)</option>
                <option value="PA">(PA)</option>
                <option value="PB">(PB)</option>
                <option value="PR">(PR)</option>
                <option value="PE">(PE)</option>
                <option value="PI">(PI)</option>
                <option value="RJ">(RJ)</option>
                <option value="RN">(RN)</option>
                <option value="RS">(RS)</option>
                <option value="RO">(RO)</option>
                <option value="RR">(RR)</option>
                <option value="SC">(SC)</option>
                <option value="SP">(SP)</option>
                <option value="SE">(SE)</option>
                <option value="TO">(TO)</option>
            </select><br>

            <label for="cidade_pj">Cidade:</label>
            <input type="text" name="cidade_pj"><br>

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