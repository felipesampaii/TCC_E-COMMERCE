<?php 
include 'conexao.php';

session_start(); //inicia a sessão

$Lusuario = $_POST['txtemail'];
$Lsenha = $_POST['txtsenha'];

$validacao = $mysqli->query("select id_pessoa, email, senha from pessoa where email = '$Lusuario' and senha ='$Lsenha' ");

if (mysqli_num_rows($validacao) == 1) { // faz a verificação se o usuario já é cadastrado
   $exibeUsuario = $validacao->fetch_assoc();
   $_SESSION['ID'] = $exibeUsuario['id_pessoa'];
   header('location:index.php');
} 
else {
    header('location:erro_login.php');
}   
?>