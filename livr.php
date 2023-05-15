<?php
include_once('config.php');

$sql="SELECT*FROM livros ORDER BY id ASC";

if(!empty($_GET['search']))
{
 $data=$_GET['search'];
 $sql="SELECT*FROM livros WHERE id LIKE '%$data%' or nomel LIKE '%$data%' or autor LIKE '%$data%'  or editoral LIKE '%$data%' or lanc LIKE '%$data%' or estoque LIKE '%$data%' ORDER BY id ASC";
  
}
else{
 $sql="SELECT*FROM livros ORDER BY id ASC";
}

$result=$conexao->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Locadora de Livros</title>
<link rel="stylesheet" href="estilos/livr.css">
<style>
    body{
    overflow-x:hidden;
  }
  #novo{
    text-decoration:none;
    color:white;
  }
  .box-search{
    position:absolute;
    display:flex;
    top:150px;
    left:850px;
    gap:0.1%;
  }
  #pesquisar{
    width:300px;
    height:30px;
  }
  #pesq{
    position:absolute;
    top:0px;
    left:300px;
    background-color:none;
    width:50px;
    height:30px;

  }

</style>
</head>
<body>

<!--cabeçalho-->
<header>
<!--Logo-->
<a id="dash" href="dash.php">
<div id="logo">
<img src="imagens/logo4.png">WDA Livraria
</div>
</a>
<!--Barra de navegação-->
<nav>
<a href="dash.php">Dashboard</a>
 <a href="alug.php">Alugados</a>
 <a href="edito.php">Editoras</a>
 <a href="livr.php">Livros</a>
 <a href="usu.php">Usuários</a>


 <a href="home.php">
 <button id="sair"><b>Sair</b></button>
</a>
</nav>
</header>

<!--Corpo-->
<div class="corpo">
<h1>Livros</h1>

<div class="box-search">
  <input type="search" placeholder="pesquisar" id="pesquisar">

  <button onclick="searchData()" id="pesq">
  <img src="imagens/lupa4.png" alt="Pesquisar">
  </button>

 </div>

<table class="table">
  <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Nome:</th>
    <th scope="col">Autor:</th>
    <th scope="col">Editora:</th>
    <th scope="col">Data de Lançamento:</th>
    <th scope="col">Estoque:</th>
    <th scope="col"><a id="novo" href="livrcad.php"><b>Novo +</b></a></th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($user_data=mysqli_fetch_assoc($result)){
        echo"<tr>";
        echo"<td>".$user_data['id']."</td>";
        echo"<td>".$user_data['nomel']."</td>";
        echo"<td>".$user_data['autor']."</td>";
        echo"<td>".$user_data['editoral']."</td>";
        echo"<td>".$user_data['lanc']."</td>";
        echo"<td>".$user_data['estoque']."</td>";
        echo"<td>
          <a href='livroEdit.php?id=$user_data[id]'><img src='imagens/lapismenor.png'>
          </a>
          <a href='livroDelete.php?id=$user_data[id]'><img src='imagens/lixeiramenor.png'>
          </a>
          </td>";
        echo"</tr>";
        echo"</tr>";
      }
    ?>
  </tbody>
</table>
</div>
</body>
<script>
  var search=document.getElementById('pesquisar');

   search.addEventListener("keydown", function(event){
    if(event.key==="Enter")
    {
     searchData();
    }
   })
  function searchData()
  {
   window.location='livr.php?search='+search.value;
  }


</script>
</html>