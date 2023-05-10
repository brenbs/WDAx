<?php

include_once('config.php');
$sql="SELECT*FROM alugados ORDER BY id DESC";

if(!empty($_GET['search']))
{
 $data=$_GET['search'];
 $sql="SELECT*FROM alugados WHERE id LIKE '%$data%' or nomela LIKE '%$data%'  or nomeua LIKE '%$data%' or dataalug LIKE '%$data%' or dataprev LIKE '%$data%' or datadev LIKE '%$data%' ORDER BY id DESC";
}
else{
 $sql="SELECT*FROM alugados ORDER BY id DESC";
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
<h1>Alugados</h1>
<!--: Nome do livro,Nome do usuário, data alug, data de Devolução-->

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
    <th scope="col">Nome do Livro:</th>
    <th scope="col">Nome do Usuário:</th>
    <th scope="col">Data de Aluguel:</th>
    <th scope="col">Previsão de Devolução:</th>
    <th scope="col">Data de Devolução:</th>
    <th scope="col">...</th>
    <th scope="col"><a  id="novo" href="alugcad.php"><b>Novo +</b></a></th>

    </tr>
  </thead>
  <tbody>
    <?php
      while($user_data=mysqli_fetch_assoc($result)){
        $alug_dat = date("d/m/Y", strtotime($user_data['dataalug']));
        $dev_dat = date("d/m/Y", strtotime($user_data['dataprev']));

        echo"<tr>";
        echo"<td>".$user_data['id']."</td>";
        echo"<td>".$user_data['nomela']."</td>";
        echo"<td>".$user_data['nomeua']."</td>";
        echo"<td>".$user_data['dataalug']."</td>";
        echo"<td>".$user_data['dataprev']."</td>";

        if($user_data['datadev'] == 0){   
          echo "<td>Não Devolvido</td>";
          echo "<td>
          <a href='aluguelEdit.php?id=$user_data[id]'><img src='imagens/check.png' alt='Devolver' title='Devolver'></a>
          </td>";
      }
      else{
          $hoje = date("Y/m/d");
          $previsao = $user_data['dataprev'];

          if(strtotime($previsao) >= strtotime($hoje)){
              echo "<td>".$user_data['datadev']."(No prazo)</td>";
              echo "<td><a href='aluguelDelete.php?id=$user_data[id]'><img src='imagens/lixeiramenor.png' alt='Bin' title='Deletar'></a></td>";
          }
          else{
              echo "<td class='itens'>".$user_data['datadev']."(Atrasado)</td>";
              echo "<td class='itens'><a href='aluguelDelete.php?id=$user_data[id]'><img src='imagens/lixeiramenor.png' alt='Bin' title='Deletar'></a></td>";
          }
      }
        echo"<td>
            <a href='aluguelEdit.php?id=$user_data[id]'><img src='imagens/lapismenor.png'>
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
   window.location='alug.php?search='+search.value;
  }
</script>
</html>