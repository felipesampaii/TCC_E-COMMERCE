<!--Esse arquivo faz como que o usuario possa fazer login, ao fazer o login com sucesso o botao de login irá sumir e dar espaço ao botão de sair-->

<?php
session_start();

if (empty($_SESSION['ID'])) { ?>
<!--tudo que esta aqui dentro irá desaparecer quando o login for efetuado com sucesso-->
    <li><a href="cadastro.php"><span> Cadastro</span></a></li>
    <li><a href="login.php"><span> Login</span></a></li>
<?php   
} else {
    if (isset($_SESSION['ID']) && !is_null($_SESSION['ID'])) {
        $consulta_usuario = $mysqli->query("SELECT pessoa.id_pessoa, pessoa_fisica.nome_pf
            FROM pessoa
            INNER JOIN pessoa_fisica ON pessoa.id_pessoa = pessoa_fisica.id_pessoa
            WHERE pessoa.id_pessoa = '$_SESSION[ID]'");
        $exibe_usuario =  $consulta_usuario->fetch_assoc();

        if ($exibe_usuario !== null && isset($exibe_usuario['nome_pf'])) {
            ?>
            <li><a href="#"><span class="glyphicon glyphicon-user"> <?php echo $exibe_usuario['nome_pf']; ?></span></a></li>
            <li><a href="sair.php"><span class="glyphicon glyphicon-log-out"> Sair</span></a></li>
            <?php
        } else {
            //redirecionar o usuário ou exibir uma mensagem de erro.
        }
    } else {
        // Lidar com o caso em que $_SESSION['ID'] não está definido ou é nulo
    }
}
?>