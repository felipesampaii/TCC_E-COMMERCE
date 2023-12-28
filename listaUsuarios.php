
<?php
   
    include'conexao.php';

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM  loginn WHERE id_login LIKE '%$data%' or email LIKE '%$data%' ORDER BY id_login DESC";
    }
    else
    {
    $sql = "SELECT * FROM  loginn ORDER BY id_login DESC";
    }
    $result = $mysqli->query($sql);

  
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Protect King</title>
    <style>
        .table-bg{
            background: rgba(0,0,0,0.3);
            border-radius: 15px 15px 0 0;
        }
        .custom-btn{
            background-color: #daa520;
            border: none;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
        
        }
        .btn-edit
        {
            background-color: #daa520;  
        }
        /* Estilo para remover o ponto da frente de um link com a classe .no-bullet */
         li.no-bullet
        {
            list-style-type: none;
        }

        
        .box-search
        {
            display: flex;
            justify-content: right;
            gap: .1%;
            margin-top: -45px; /* Mover 10 pixels para cima */
            margin-left: 80px;
        }
        
       
    </style>
</head>
<body>
   
        <div class="m-5" height: 20px >    
            <h1>Lista de Usuários</h1>
            <li class="no-bullet"><a href="index.php" class="custom-btn"><span class="glyphicon glyphicon-log-out"></span> Início</a></li>

            <div class="box-search">
                <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
                <button onclick="searchData()" class="btn btn-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </div>
        </div>
 
    <?php include'conexao.php'; ?>
    <div class="m-5" table-bg >
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Email </th>
                <th scope="col">Senha</th>
                <th> </th>
                <!-- <th scope="col">Excluir</th> -->
                </tr>
            </thead>
            <tbody>
             <?php
                while($consulta_usuario = mysqli_fetch_assoc($result))
                {
                        echo "<tr>";
                        echo "<td>" .$consulta_usuario["id_login"]."</td>";
                        echo "<td>" .$consulta_usuario["email"]."</td>";
                        echo "<td>" .$consulta_usuario["senha"]."</td>";
                        echo "<td>";
                        echo '<a class="btn-edit btn btn-sm btn-warning" href="editaUsu.php?id_login=' . $consulta_usuario["id_login"] . '">Editar</a>';
                        echo "</td>";
                        echo "</tr>";
                   
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event){
        if(event.key === "Enter")
        {
            searchData();
        }
    });
    function searchData()
    {
        window.location = 'listaUsuarios.php?search='+search.value;
    }
</script>
</html>