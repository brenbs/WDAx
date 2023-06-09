<?php

include_once('config.php');

$sql="SELECT*FROM usuarios ORDER BY id ASC";

if(!empty($_GET['search']))
{
 $data=$_GET['search'];
 $sql="SELECT*FROM usuarios WHERE id LIKE '%$data%' or usuario LIKE '%$data%' or emailu LIKE '%$data%' or numerou LIKE '%$data%' or enderecou LIKE '%$data%' or cidadeu LIKE '%$data%' or cpfu LIKE '%$data%'ORDER BY id ASC";

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
  
  $registros=$conexao->query("SELECT COUNT(usuario) AS $registros FROM usuarios");

  $paginas=ceil($registros/$limite);

  $sql="SELECT*FROM usuarios ORDER BY id LIMIT $inicio,$limite";
}

//ordenar nome  
if (isset($_GET['usuario'])) {
  $sql="SELECT * FROM usuarios ORDER BY usuario ASC";
  $result = $conexao -> query($sql);

  if($_GET['usuario']==1){
    $sql="SELECT * FROM usuarios ORDER BY usuario DESC";
    $result = $conexao -> query($sql);
  }
}

//ordenar id crescente 
if (isset($_GET['codu'])) {
  $sql="SELECT * FROM usuarios ORDER BY id ASC";
  $result = $conexao -> query($sql);

  if($_GET['codu']==1){
    $sql="SELECT * FROM usuarios ORDER BY id DESC";
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
    <th scope="col">#
      <a href="usu.php?codu=true" id="nome_table"><img src="imagens/seta_pra_cima.svg" alt="Ordem crescente"></a> 
      <a href="usu.php?codu=1"><img src="imagens/seta_pra_baixo.svg" alt="Ordem decrescente"></a>
    </th>
    <th scope="col">Nome:
      <a href="usu.php?usuario=true" id="nome_table"><img src="imagens/seta_pra_cima.svg" alt="Ordem crescente"></a> 
      <a href="usu.php?usuario=1"><img src="imagens/seta_pra_baixo.svg" alt="Ordem decrescente"></a>
    </th>
    </th>
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
    // Define o número de registros por página
    $item_por_pag = 5;
    $pag_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $offset = ($pag_atual - 1) * $item_por_pag;
    $search = isset($_GET['pesquisar']) ? $_GET['pesquisar'] : '';

    // Construa a consulta SQL com base nos parâmetros
    $result = $conexao->query($sql);
    $total_reg = $result->num_rows;
    $totalPaginas = ceil($total_reg / $item_por_pag);
    if (!empty($search)) {
        $sqlseach = "SELECT * FROM  editora WHERE nome LIKE '%$data%'  OR email LIKE '%$data%' OR telefone LIKE '%$data%'  ORDER BY id DESC";
        $result = $conexao->query($sqlseach);
    } else {
        $sql = "SELECT * FROM editora
        ORDER BY id ASC 
        LIMIT $item_por_pag OFFSET $offset";
        $result = $conexao->query($sql);
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
   window.location='usu.php?search='+search.value;
  }
</script>
</html>

