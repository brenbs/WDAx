<?php
include_once('config.php');

$sql="SELECT*FROM editoras ORDER BY id ASC";

if(!empty($_GET['search']))
{
 $data=$_GET['search'];
 $sql="SELECT*FROM editoras WHERE id LIKE '%$data%' or nomee LIKE '%$data%' or emaile LIKE '%$data%'  or numeroe LIKE '%$data%' or sitee LIKE '%$data%' ORDER BY id ASC";
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
  
  $registros=$conexao->query("SELECT COUNT(nomee) AS $registros FROM editoras");

  $paginas=ceil($registros/$limite);

 

 $sql="SELECT*FROM editoras ORDER BY id LIMIT $inicio,$limite";
}

//ordenar nome  
if (isset($_GET['namee'])) {
  $sql="SELECT * FROM editoras ORDER BY nomee ASC";
  $result = $conexao -> query($sql);

  if($_GET['namee']==1){
    $sql="SELECT * FROM editoras ORDER BY nomee DESC";
    $result = $conexao -> query($sql);
  }
}

//ordenar id crescente 
if (isset($_GET['code'])) {
  $sql="SELECT * FROM editoras ORDER BY id ASC";
  $result = $conexao -> query($sql);

  if($_GET['code']==1){
    $sql="SELECT * FROM editoras ORDER BY id DESC";
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
<h1>Editoras</h1>

<div class="box-search">
  <input type="search" placeholder="pesquisar" id="pesquisar">

  <button onclick="searchData()" id="pesq">
  <img src="imagens/lupa4.png" alt="Pesquisar">
  </button>

 </div>

<!--: Nome da editora, email, telefone facultativo:site-->
<table class="table">
  <thead>
    <tr>
    <th scope="col"># <a href="edito.php?code=true" id="nome_table"><img src="imagens/seta_pra_cima.svg" alt="Ordem crescente"></a> 
      <a href="edito.php?code=1"><img src="imagens/seta_pra_baixo.svg" alt="Ordem decrescente"></a></th>

    <th scope="col">Nome: <a href="edito.php?namee=true" id="nome_table"><img src="imagens/seta_pra_cima.svg" alt="Ordem crescente"></a> 
      <a href="edito.php?namee=1"><img src="imagens/seta_pra_baixo.svg" alt="Ordem decrescente"></a></th>
    <th scope="col">Email:</th>
    <th scope="col">Número:</th>
    <th scope="col">Site:</th>
    <th scope="col"><a  id="novo" href="editocad.php"><b>Novo +</b></a></th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($user_data=mysqli_fetch_assoc($result)){
        echo"<tr>";
        echo"<td>".$user_data['id']."</td>";
        echo"<td>".$user_data['nomee']."</td>";
        echo"<td>".$user_data['emaile']."</td>";
        echo"<td>".$user_data['numeroe']."</td>";
        echo"<td>".$user_data['sitee']."</td>";
        echo"<td>
            <a href='editoraEdit.php?id=$user_data[id]'><img src='imagens/lapismenor.png'>
            </a>
            <a href='editoraDelete.php?id=$user_data[id]'><img src='imagens/lixeiramenor.png'>
            </a>
            </td>";
            echo"</tr>";
        echo"</tr>";
      }
    ?>
  </tbody>
</table>

</table>
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
   window.location='edito.php?search='+search.value;
  }
</script>
</html>