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
  <link rel="stylesheet" href="estilos/dash.css?<?php echo rand(1, 1000); ?>">
  <link rel="stylesheet" href="estilos/resp.css?<?php echo rand(1, 1000); ?>">
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
  <div id="burguer">
    <nav>
    <a href="dash.php">Dashboard</a>
    <a href="alug.php">Alugados</a>
    <a href="edito.php">Editoras</a>
    <a href="livr.php">Livros</a>
    <a href="usu.php">Usuários</a>
    <a href="home.php"><button id="sair"><b>Sair</b></button></a>
    </nav>
  </div>
  </header>

<!--Corpo-->
<div class="corpo">
 <!--Graáfico 01-->
  <div id="toptier">
    <?php   
      $sql_grafico1="SELECT nomela , count(nomela) as quantidade_aluguel FROM alugados WHERE nomela=nomela GROUP BY nomela ORDER BY COUNT(nomela) DESC limit 5";
      $resultado_grafico1= $conexao->query($sql_grafico1);
      //geração dos dados 
      while($pizza=$resultado_grafico1->fetch_assoc()){
        $nomes[]=$pizza['nomela'];
        $desc[]=$pizza['quantidade_aluguel'];
      }
    ?>
    <h1>Livros mais alugados:</h1>
    <canvas id='grafico1'></canvas>
  </div>

  <!--Gráfico 02-->
  <div id="ativalug">
   <?php 
    $sql_graf2="SELECT nomeua , count(nomela) as user_ativos FROM alugados GROUP BY nomeua ORDER BY count(nomela) DESC limit 5";
    $resultado_graf2= $conexao->query($sql_graf2);

    //geração dos dados 
    while($pizza=$resultado_graf2->fetch_assoc()){
      $user[]=$pizza['nomeua'];
      $dados[]=$pizza['user_ativos'];
    }
   ?>
   <h1>Aluguéis Ativos</h1>
   <canvas id='graf2'></canvas>
  </div>
 <!--livros devolvidos -->

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
      // total de livros não devolvidos 

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
    
    <!-- total de livros-->
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
</body>
<!--grafico 01-->
<script>
  const ctx = document.getElementById('grafico1');
  new Chart(ctx, {
    type: 'pie',
    
    data: {
      
      labels: [ "<?php  echo $nomes[0]; ?>","<?php  echo $nomes[1]; ?>","<?php  echo $nomes[2]; ?>","<?php  echo $nomes[3]; ?>","<?php  echo $nomes[4]; ?>"],
      datasets: [{
        label: ' Livros Mais Alugados',
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
<!--grafico 02-->

<script>
  const graf = document.getElementById('graf2');

  new Chart(graf, {
    type: 'pie',
    data: {
      labels: ["<?php  echo $user[0]; ?>","<?php  echo $user[1]; ?>","<?php  echo $user[2]; ?>","<?php  echo $user[3]; ?>","<?php  echo $user[4]; ?>"],
      datasets: [{
        label: 'Alugueis ativos',
        data: ["<?php echo $dados[0]; ?>","<?php echo $dados[1]; ?>","<?php echo $dados[2]; ?>","<?php echo $dados[3]; ?>","<?php echo $dados[4]; ?>"],
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
</html>