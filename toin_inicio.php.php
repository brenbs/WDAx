<?php
  session_start();
  //print_r($_SESSION);
  //sessão para guardar os  dados do usuario
  if((!isset($_SESSION['nome']) == true) and (!isset($_SESSION['senha']) == true )){
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('Location: home.php');
  }
  $logado = $_SESSION['nome'];

  include_once('../php/config.php');

/*dashboard*/

  //Total de livro alugados
  $sqlAluguel="SELECT livro FROM aluguel";
  $resultadolivro= $conexao->query($sqlAluguel);
  $sql_total_alugueis = "SELECT COUNT(*) AS total_alugueis FROM aluguel";
  $resultado_total_alugueis = $conexao->query($sql_total_alugueis);
  $linha_total_alugueis = $resultado_total_alugueis->fetch_assoc();
  if (isset($linha_total_alugueis['total_alugueis'])) {
    $quantidade_alugueis = $linha_total_alugueis['total_alugueis'];
  }

  //Livro mais alugado
  $sql_mais_alugado = "SELECT livro FROM aluguel WHERE livro=livro GROUP BY livro ORDER BY COUNT(livro) DESC LIMIT 1";
  $resultado_mais_alugado = $conexao->query($sql_mais_alugado);
  $mais_alugado = $resultado_mais_alugado->fetch_assoc();
  if(isset( $mais_alugado['livro'])){
  $mais_alug=  $mais_alugado['livro'];
  }

  //Total do estoque
  $sql_total_livros="SELECT sum(estoque) AS total_livros FROM livro";
  $resultado_total_livros = $conexao->query($sql_total_livros);
  $total_livros=$resultado_total_livros->fetch_assoc();
  if(isset($total_livros['total_livros'])){
  $totais_livros= $total_livros['total_livros'];
  }

  //Livros não devolvidos
  $sql_n_devo="SELECT count(datadevo) as n_devolvidos FROM aluguel where datadevo=0";
  $resultado_n_devo = $conexao->query($sql_n_devo);
  $total_n_devo=$resultado_n_devo->fetch_assoc();
  if(isset($total_n_devo['n_devolvidos'])){
  $total_nao_devo= $total_n_devo['n_devolvidos'];
  }
  
  //Livros devolvidos
  $sql_devo="SELECT count(datadevo) as devolvidos FROM aluguel where datadevo!=0";
  $resultado_devo = $conexao->query($sql_devo);
  $total_devo=$resultado_devo->fetch_assoc();
  if(isset($total_devo['devolvidos'])){
  $total_devol= $total_devo['devolvidos'];
  }

  //Gráfico
  $sql_grafico="SELECT livro , count(livro) as quantidade_aluguel FROM aluguel WHERE livro=livro GROUP BY livro ORDER BY COUNT(livro) DESC limit 5";
  $resultado_grafico= $conexao->query($sql_grafico);
  //geração dos dados 
  while($barra=$resultado_grafico->fetch_assoc()){
    $nomes[]=$barra['livro'];
    $info[]=$barra['quantidade_aluguel'];
   
  }
 //Grafico 02
  $sql_grafico01="SELECT nome , count(livro) as user_ativos FROM aluguel GROUP BY nome ORDER BY count(livro) DESC limit 5";
  $resultado_grafico01= $conexao->query($sql_grafico01);
  //geração dos dados 
  while($pizza=$resultado_grafico01->fetch_assoc()){
    $user[]=$pizza['nome'];
    $dados[]=$pizza['user_ativos'];
   
  }

 //var_dump($nomes);
 //print_r("<br>");
 //var_dump($info);
  
?>
<!--- HTML  ---->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wda Livraria</title>
    <!--links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/estilo.css?<?php echo rand(1, 1000); ?>">
    <link rel="stylesheet" href="../css/mediaquerry.css?<?php echo rand(1, 1000); ?>">
    
</head>

<body>
      <!--Cabeçalho-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary">
        <div class="container-fluid">
          <a class="" href="#"><img src="../img/WDA LIVRARIA4.png" alt=" wda né " height="70px" width="267px" id="inicio"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="lista">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"> <img src="../img/home.png" alt="Início" width="20px" height="20px">   Início</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="user.php"> <img src="../img/user.png" alt="user.png" width="20px" height="20px">    Usuários</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="livro.php"><img src="../img/livro.png" alt="Livro" width="20px" height="20px">    Livro</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="aluguel.php"> <img src="../img/aluguel.png" alt="Aluguel" width="20px" height="20px">    Aluguel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="editora.php"> <img src="../img/editora.png" alt="Editora" width="20px" height="20px">   Editora</a>
              </li>
              
            </ul>
            <a class="btn btn-outline-danger" href="../php/sair.php" role="button">Sair</a>
          </div>
        </div>
         
      </nav>
    <!--Fim do Cabeçalho-->

    <!--Corpo--->
<main>
<br>
          <!--Containers--->
            <div id="grafico" class="container bg-light">

              <div style="text-align: center;">
              <h1>Dashboard: </h1>
              </div>

              <div class="grafico01">
              <canvas id="grafico01" style="margin-top:5px;"></canvas>
              <p style="font-size:1.2em; text-align: center; margin-left: 80px; text-weight:bold;">Livros Mais alugados</p>
              </div>

              
              <div class="grafico02">
              
                <canvas id="grafico02"></canvas>

                <p style="font-size:1.2em; text-align: center;">Quantidade de alugueis por Usuário</p>
              </div>
              

            
            </div>

            <div id="maisalugado" class="container bg-light">
              <h1>O livro mais alugado: </h1>
              <div id="top"> <?php if(isset($mais_alug)){
                echo "<h3>".$mais_alug."</h3>";
              }else{
                echo "<h5>O livro mais alugado vai aparecer aqui!</h5>";
              }
              
              ?> </div>
              <img src="../img/livromaisvendido.png" alt="Livro" id="livroalugado">
           </div>

          <div id="container3" class="container bg-light">
            <h1>Quantidade de livros:</h1>
            <strong>Alugados:</strong>
            <div id="Emprestados">
            <?php echo $quantidade_alugueis; ?>
          </div>
            <strong>Ao Total:</strong>
            <div id="Atrasados">
            <?php echo $totais_livros; ?> 
            </div>
            <img src="../img/livros.png" alt="Livros" width="120px" height="120px" id="livros">
          </div>
          
          <div id="container4" class="container bg-light">
            <h1>Alugueis:</h1>
            <p><strong>Entregues:</strong></p>
            <div id="dentroprazo"> <?php echo  $total_devol; ?> </div>
            <p><strong>Não Devolvidos:</strong></p>
            <div id="foraprazo"> <?php echo $total_nao_devo; ?> </div>
            <img src="../img/lendo-um-livro.png" alt="Lendo livros" id="lendolivro">
          </div>
          <!---Containers---->
</main>
    <!--Fim do Corpo-->


  <!--Script-->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script> 

<!----Grafico 01----->
<script>
  const ctx = document.getElementById('grafico01');
  

  new Chart(ctx, {
    type: 'bar',
    
    data: {
      
      labels: [ "<?php  echo $nomes[0]; ?>","<?php  echo $nomes[1]; ?>","<?php  echo $nomes[2]; ?>","<?php  echo $nomes[3]; ?>","<?php  echo $nomes[4]; ?>"],
      datasets: [{
        label: 'Mais Alugados',
        data: ["<?php echo $info[0]; ?>","<?php echo $info[1]; ?>","<?php echo $info[2]; ?>","<?php echo $info[3]; ?>","<?php echo $info[4]; ?>"],
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
<!----Grafico 02----->
<script>
  const graf = document.getElementById('grafico02');

  new Chart(graf, {
    type: 'pie',
    data: {
      labels: ["<?php  echo $user[0]; ?>","<?php  echo $user[1]; ?>","<?php  echo $user[2]; ?>","<?php  echo $user[3]; ?>","<?php  echo $user[4]; ?>"],
      datasets: [{
        label: 'Alugueis ativos',
        data: ["<?php echo $dados[0]; ?>","<?php echo $dados[1]; ?>","<?php echo $dados[2]; ?>","<?php echo $dados[3]; ?>","<?php echo $dados[4]; ?>"],
        borderWidth: 1
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>  
<!----Fim do Script---->  
</body>
</html>