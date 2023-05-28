<?php
include_once('config.php');

$sql="SELECT*FROM livros ORDER BY id ASC";
//pesquisa->se tiver algo na barra, faz a pesquisa
if(!empty($_GET['search']))
{
 $data=$_GET['search'];
 $sql="SELECT*FROM livros WHERE id LIKE '%$data%' or nomel LIKE '%$data%' or autor LIKE '%$data%'  or editoral LIKE '%$data%' or lanc LIKE '%$data%' or estoque LIKE '%$data%' ORDER BY id ASC";
  
}
else{
  //se estiver vazia,então mostra todos os registros  
  //paginação
  $pagina=1;

  if(isset($_GET['pagina']))
  $pagina=filter_input(INPUT_GET,"pagina",FILTER_VALIDATE_INT);

  if(!$pagina)
  $pagina=1;

  $limite=5;

  $inicio=($pagina*$limite)-$limite;

  $registros=0;
  
  $registros=$conexao->query("SELECT COUNT(nomel) AS $registros FROM livros");

  $paginas=ceil($registros/$limite);

  $sql="SELECT*FROM livros ORDER BY id LIMIT $inicio,$limite";

}

//ordenar nome  
if (isset($_GET['namel'])) {
  $sql="SELECT * FROM livros ORDER BY nomel ASC";
  $result = $conexao -> query($sql);

  if($_GET['namel']==1){
    $sql="SELECT * FROM livros ORDER BY nomel DESC";
    $result = $conexao -> query($sql);
  }
}

//ordenar id crescente 
if (isset($_GET['codl'])) {
  $sql="SELECT * FROM livros ORDER BY id ASC";
  $result = $conexao -> query($sql);

  if($_GET['codl']==1){
    $sql="SELECT * FROM livros ORDER BY id DESC";
    $result = $conexao -> query($sql);
  }

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
<link rel="stylesheet" href="estilos/livr.css?<?php echo rand(1, 1000); ?>">
<link rel="stylesheet" href="estilos/resp.css?<?php echo rand(1, 1000); ?>">
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
 <a href="home.php"><button id="sair"><b>Sair</b></button></a>
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
    <th scope="col">#
       <a href="livr.php?codl=true" id="nome_table"><img src="imagens/seta_pra_cima.svg" alt="Ordem crescente"></a> 
      <a href="livr.php?codl=1"><img src="imagens/seta_pra_baixo.svg" alt="Ordem decrescente"></a>
    </th>

    <th scope="col">Nome 
      <a href="livr.php?namel=true" id="nome_table"><img src="imagens/seta_pra_cima.svg" alt="Ordem crescente"></a> 
      <a href="livr.php?namel=1"><img src="imagens/seta_pra_baixo.svg" alt="Ordem decrescente"></a>
    </th>
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

<!--pagination-->
  <div id=#pagin>
    <a href="?pagina=1">Primeira</a>
    <a href="?pagina=<?=$pagina-1?>"><<</a>

    <?=$pagina?>

    <a href="?pagina=<?=$pagina+1?>">>></a>
    <a href="?pagina=<?=$paginas?>">Última</a>
  </div>
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