<?php
//ligar ao bd
include_once('config.php');
$sql="SELECT*FROM alugados ORDER BY id ASC";

//pesquisar se tiver algo na barra de pesquisa
if(!empty($_GET['search']))
{
 $data=$_GET['search'];
 $sql="SELECT*FROM alugados WHERE id LIKE '%$data%' or nomela LIKE '%$data%'  or nomeua LIKE '%$data%' or dataalug LIKE '%$data%' or dataprev LIKE '%$data%' or datadev LIKE '%$data%' ORDER BY id ASC";
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
  
  $registros=$conexao->query("SELECT COUNT(nomela) AS $registros FROM alugados");

  $paginas=ceil($registros/$limite);


 $sql="SELECT*FROM alugados ORDER BY id LIMIT $inicio,$limite";
}

//ordenar nome  do livro
if (isset($_GET['namela'])) {
  $sql="SELECT * FROM alugados ORDER BY nomela ASC";
  $result = $conexao -> query($sql);

  if($_GET['namela']==1){
    $sql="SELECT * FROM alugados ORDER BY nomela DESC";
    $result = $conexao -> query($sql);
  }
}

//ordenar nome  do usuário
if (isset($_GET['nameua'])) {
  $sql="SELECT * FROM alugados ORDER BY nomeua ASC";
  $result = $conexao -> query($sql);

  if($_GET['nameua']==1){
    $sql="SELECT * FROM alugados ORDER BY nomeua DESC";
    $result = $conexao -> query($sql);
  }
}


//ordenar id crescente 
if (isset($_GET['coda'])) {
  $sql="SELECT * FROM alugados ORDER BY id ASC";
  $result = $conexao -> query($sql);

  if($_GET['coda']==1){
    $sql="SELECT * FROM alugados ORDER BY id DESC";
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
    <th scope="col"># <a href="alug.php?coda=true" id="nome_table"><img src="imagens/seta_pra_cima.svg" alt="Ordem crescente"></a> 
      <a href="alug.php?coda=1"><img src="imagens/seta_pra_baixo.svg" alt="Ordem decrescente"></a></th>

    <th scope="col">Nome do Livro:<a href="alug.php?namela=true" id="nome_table"><img src="imagens/seta_pra_cima.svg" alt="Ordem crescente"></a> 
      <a href="alug.php?namela=1"><img src="imagens/seta_pra_baixo.svg" alt="Ordem decrescente"></a></th>

    <th scope="col">Nome do Usuário:<a href="alug.php?nameua=true" id="nome_table"><img src="imagens/seta_pra_cima.svg" alt="Ordem crescente"></a> 
      <a href="alug.php?nameua=1"><img src="imagens/seta_pra_baixo.svg" alt="Ordem decrescente"></a></th>
      
    <th scope="col">Data de Aluguel:</th>
    <th scope="col">Previsão de Devolução:</th>
    <th scope="col">Status</th>
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
       
            echo"</tr>";
        echo"</tr>";
      }
    ?>
  </tbody>
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
   window.location='alug.php?search='+search.value;
  }
</script>
</html>