<?php 
include 'conexao.php';


$Lusuario = $_POST['txtemail'];
$Lsenha = $_POST['txtsenha'];

$validacao = $mysqli->query("select id_pessoa, email, senha from pessoa where email = '$Lusuario' and senha ='$Lsenha' ");

if (mysqli_num_rows($validacao) == 1) {
    echo 'usuario cadastrado';
} else {
    echo 'usuario nao cadastrado';
}

?>