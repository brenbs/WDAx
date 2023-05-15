<?php

include_once('config.php');

$sql="SELECT*FROM usuarios ORDER BY id ASC";

if(!empty($_GET['search']))
{
 $data=$_GET['search'];
 $sql="SELECT*FROM usuarios WHERE id LIKE '%$data%' or usuario LIKE '%$data%' or emailu LIKE '%$data%' or numerou LIKE '%$data%' or enderecou LIKE '%$data%' or cidadeu LIKE '%$data%' or cpfu LIKE '%$data%'ORDER BY id ASC";

}
else{
 $sql="SELECT*FROM usuarios ORDER BY id ASC";
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

<h1>Usuários</h1>

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
    <th scope="col">Email:</th>
    <th scope="col">Número:</th>
    <th scope="col">Endereço:</th>
    <th scope="col">Cidade e UF:</th>
    <th scope="col">CPF:</th>
    <th scope="col"><a  id="novo" href="usucad.php" id="novo"><b>Novo +</b></a></th>
   </tr>
  </thead>
  <tbody>
   <?php
    while($user_data=mysqli_fetch_assoc($result)){
     echo"<tr>";
     echo"<td>".$user_data['id']."</td>";
     echo"<td>".$user_data['usuario']."</td>";
     echo"<td>".$user_data['emailu']."</td>";
     echo"<td>".$user_data['numerou']."</td>";
     echo"<td>".$user_data['enderecou']."</td>";
     echo"<td>".$user_data['cidadeu']."</td>";
     echo"<td>".$user_data['cpfu']."</td>";
     echo"<td>
     <a href='usuarioEdit.php?id=$user_data[id]'><img src='imagens/lapismenor.png'>
     </a>
     <a href='usuarioDelete.php?id=$user_data[id]'><img src='imagens/lixeiramenor.png'>
     </a>
     </td>";
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
   window.location='usu.php?search='+search.value;
  }
</script>
</html>

