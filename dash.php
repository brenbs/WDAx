<?php

session_start();
include_once('config.php');

if((!isset($_SESSION['adm'])==true) and (!isset($_SESSION['adme'])==true) and (!isset($_SESSION['senha'])==true)){
 unset($_SESSION['adm']);
 unset($_SESSION['adme']);
 unset($_SESSION['senha']);
 header('Location:home.php');
}
$logado=$_SESSION['adm'];

$sql="SELECT*FROM usuarios ORDER BY id DESC";

$result=$conexao->query($sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Locadora de Livros</title>
<link rel="stylesheet" href="estilos/dash.css ?<?php echo rand(1, 1000); ?>" >
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
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

<div id="toptier"><h1>Livros mais alugados</h1>

<?php
$sql_mais_alugado = "SELECT nomela FROM alugados  WHERE nomela=nomela GROUP BY nomela ORDER BY COUNT(nomela) DESC LIMIT 1";
  $resultado_mais_alugado = $conexao->query($sql_mais_alugado);
  $mais_alugado = $resultado_mais_alugado->fetch_assoc();
  if(isset( $mais_alugado['nomela'])){
  $mais_alug=  $mais_alugado['nomela'];
  }

?>

<!--Gráfico-->
<?php
$sql_graf="SELECT nomela , count(nomela) as quantidade_aluguel FROM alugados WHERE nomela=nomela GROUP BY nomela ORDER BY COUNT(nomela) DESC limit 5";
$result_graf= $conexao->query($sql_graf);

while($barra=$result_graf->fetch_assoc()){
  $nomel[]=$barra['nomela'];
  $desc[]=$barra['quantidade_aluguel'];
}
?>

<div id="grafico">
  <canvas id="graf" width="400px;" height="400px;"></canvas>
</div>

</div>

<!--livros devolvidos 
-->

<div class="lem">
  <div id="alugA">

  <img src="imagens/livro02.png" alt="imagem1">

    <?php
    
    $sql_total_alugueis = "SELECT COUNT(*) AS total_alugueis FROM alugados";
    
    $resultado_total_alugueis = $conexao->query($sql_total_alugueis);
    
    $linha_total_alugueis = $resultado_total_alugueis->fetch_assoc();
    
    if (isset($linha_total_alugueis['total_alugueis'])) {
    
      $quantidade_alugueis = $linha_total_alugueis['total_alugueis'];
    
    }
    ?>
    
    <span class="text"><h3>Total de alugueis Ativos:</h3></span>
    <span class="value"><?php echo $quantidade_alugueis."<br>"; ?></span>
    
  </div>
  <div id="livrAtras">
  <img src="imagens/livr.png" alt="imagem2">
  <h3>Quantidade de livros atrasados</h3>
  <?php
    // Função para total de livros não devolvidos 

  $sql_dev="SELECT count(datadev) as fora_prazo FROM alugados where datadev=0";
  $result_dev = $conexao->query($sql_dev);
  $total_dev=$result_dev->fetch_assoc();
  if(isset($total_dev['fora_prazo'])){
  $total_dev= $total_dev['fora_prazo'];
  }

  echo $total_dev;

  ?>
  </div>

  <div id="livrousu">
    <img src="imagens/usuario01.png" alt="imagem3">
    <h3>Estoque total de Livros</h3>
    
    <!--Função total de livros-->
    <?php
    $sql_total="SELECT sum(estoque) AS total_livro FROM livros";
    $result_livro = $conexao->query($sql_total);
    $total_livro=$result_livro->fetch_assoc();
    if(isset($total_livro['total_livro'])){
    $total_livro= $total_livro['total_livro'];
    }

    echo $total_livro;

    ?>
  </div>

  <div id="devolv_prazo">

<img src="imagens/livr.png" alt="">
<h3>Quantos livros foram devolvidos</h3>
  
<?php

$sql_livrod="SELECT count(datadev) as dentro_prazo FROM alugados where datadev!=0";
$result_livrod = $conexao->query($sql_livrod);
$total_livrod=$result_livrod->fetch_assoc();
if(isset($total_livrod['dentro_prazo'])){
$total_livrod= $total_livrod['dentro_prazo'];
  }
  echo "Livros devolvidos dentro do prazo: ".$total_livrod."<br>";
  
  ?>
</div>

</div>



</div>
<script>
  const ctx = document.getElementById('graf');
 
  new Chart(ctx, {
    type: 'pie',

    data: {

      labels: [ "<?php  echo $nomel[0]; ?>","<?php  echo $nomel[1]; ?>","<?php  echo $nomel[2]; ?>","<?php  echo $nomel[3]; ?>","<?php  echo $nomel[4]; ?>"],
      datasets: [{
        label: 'Mais Alugados',
        data: ["<?php echo $desc[0]; ?>","<?php echo $desc[1]; ?>","<?php echo $desc[2]; ?>","<?php echo $desc[3]; ?>","<?php echo $desc[4]; ?>"],
        backgroundColor: ['rgba(255,99,132)','rgb(240, 212, 0)','rgb(24, 183, 201)','rgb(62, 201, 100)','rgb(1, 9, 15)'],

        borderWidth: 0
      }]
    },
    options: {
      scales: { 
        y: {
          beginAtZero: true
        }
      }
    }
  });

</script>
</body>
</html>