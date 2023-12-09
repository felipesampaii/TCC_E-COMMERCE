<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados comuns para ambas as pessoas
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $tipo_pessoa = $_POST["tipo_pessoa"];

    // Inserir dados na tabela pessoa
    $sql = "INSERT INTO pessoa (email, senha, tipo_pessoa) 
            VALUES ('$email', '$senha', $tipo_pessoa)";
    $mysqli->query($sql);

    // Obter o ID da pessoa recém-inserida
    $id_pessoa = $mysqli->insert_id;

    //------------------------------------------------------------------------------------------------------

    if ($tipo_pessoa == 1 || $tipo_pessoa == 2) {
        $tipo_usuario = "Cliente";
    }
    elseif ($tipo_adm == 3) {
        $tipo_usuario = "Administrador";
    }
    elseif ($tipo_vendedor == 4) {
        $tipo_usuario = "Vendedor";
    }
    else {
        $tipo_usuario = "Tipo de usuário desconhecido"; // Pode ser uma mensagem de erro ou tratamento padrão.
    }
    
    $sql = "INSERT INTO usuario(tipo_usuario, id_pessoa)
            VALUES ('$tipo_usuario', $id_pessoa)";
            
    $mysqli->query($sql);

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