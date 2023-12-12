<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Protector Kings</title>

<link rel="stylesheet" href="index.css">

<?php include 'links.php'; ?>
</head>

<body>
<?php  

include 'conexao.php';
include 'menu.php';
include 'carrossel.html';

$consulta = $mysqli->query('select imagem_produto, nome_produto, preco_produto, quantidade_produto, pasta_imagem from produto');
?>

<div class = "container-fluid">
  <div class = "row">
  <?php   while($exibe = $consulta->fetch_assoc()){  ?>
    <div class = "col-sm-3">
    <div class = "bvvvxW">
    </br>
      <img src="foto_produto/<?php echo $exibe['pasta_imagem']; ?>/<?php echo trim($exibe['imagem_produto']); ?>.jpg" class="img-responsive" style="width: 15rem"> <!--TRIM remove todos os possiveis espaços que podem atrapalhar o código-->

       <div><h4 style="text-align: center;"><b><?php echo mb_strimwidth($exibe['nome_produto'], 0, 25, '...'); ?></b></h4></div> <!--mb_strimwidth limita o tanto de caracteres que é visivel-->

      <div><h5 style="text-align: center;">R$ <?php echo number_format($exibe['preco_produto'], 2, ',','.'); ?></h5></div> <!--number_format faz com que o preço fique no formato padrão BR-->
      
      <div class="text-center">
        <button class="btn btn-three">
          <span class="glyphicon glyphicon-info-sign" style="Color: cadetblue"> Detalhes</span>
        </button>
      </div>
      <?php include 'botao_esgotado.php'; ?></br>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<?php include 'rodaPE.html'; ?>
</body> 
</html> 