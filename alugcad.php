<?php
//ligação ao bd
include_once('config.php');

//Armazenar os dados no bd
if(isset($_POST['submit'])){

  include_once('config.php');

  $nomela=$_POST['nomela'];
  $nomeua=$_POST['nomeua'];
  $dataalug=$_POST['dataalug'];
  $dataprev=$_POST['dataprev'];
  $datadev=$_POST['datadev'];

  $sqlaluguel="SELECT * FROM  alugados WHERE nomela ='$nomela' and nomeua='$nomeua'";

  $resultado = $conexao->query($sqlaluguel);

  $entrada = new DateTime(date("Y/m/d", strtotime($_POST['dataalug'])));
  $saida = new DateTime(date("Y/m/d", strtotime($_POST['dataprev'])));

  $intervalo=$entrada->diff($saida);
  $dias=$intervalo->days;

  
  $hoje = date("Y/m/d");
  $aluguel = $_POST['dataalug'];

 //condições
  if(strtotime($aluguel)<=strtotime($hoje)){
    if($dias>30){
      echo "<script> alert('O limite do aluguel é de 30 dias.') </script>";

    }else if(mysqli_num_rows($resultado)>0){

      echo "<script>window.alert('Usúario não pode Alugar o mesmo livro')</script>";

  }else{
    $result=mysqli_query($conexao,"INSERT INTO alugados(nomela,nomeua,dataalug,dataprev,datadev) VALUES ('$nomela','$nomeua','$dataalug','$dataprev','$datadev')");
    header('Location:alug.php');
  }
  
  }else{
    echo "<script> window.alert('A data de aluguel não pode ser posterior ao dia de hoje!') </script>";
  }
}

// Conexão tabela Livros
$sqllivro_conect = "SELECT * FROM livros ORDER BY id ASC";
$resultlivro_conect = $conexao -> query($sqllivro_conect);

// Conexão tabela Usuários
$sqluser_conect = "SELECT * FROM usuarios ORDER BY id ASC";
$resultuser_conect = $conexao -> query($sqluser_conect);

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="estilos/usucad.css">
 <title>Cadastro de Usuários</title>
</head>
<body>

<!--formulario-->

<div class="box">
  <form action="alugcad.php" method="POST">
    <fieldset>
     <legend><b>Cadastro de Usuários</b></legend>
     <br><br>

      <div class="inputBox"> 
      <label for="nomela" class="labelInput">Nome do Livro:</label><br>
        <select name="nomela" id="" value="Livro alugado:" required>
          <option value="Selecionar">Selecionar</option>
            <?php
            
              while($livro_data = mysqli_fetch_assoc($resultlivro_conect)){
              
                echo "<option>".$livro_data['nomel']."</option>";
              
              }
            ?>
        </select>
      </div>

    <br>

      <div class="inputBox">
      <label for="nomeua" class="labelInput">Nome do Usuário:</label><br>
        <select name="nomeua" value="Uusário:" required>
        <option value="Selecionar">Selecionar</option>
          <?php 
            while($user_data = mysqli_fetch_assoc($resultuser_conect)){

              echo "<option>".$user_data['usuario']."</option>";

            }
          ?>
        </select>
      </div>
      <br><br>

      <div class="inputBox">
      <label for="dataalug" class="labelInput">Data de Aluguel:</label>
      <input type="date" name="dataalug" id="dataalug" class="inputUser" required>
      </div>

      <br><br>

      <div class="inputBox">
      <label for="dataprev" class="labelInput">Previsão de Devolução(<b>Máx. 30 dias</b>):</label>
      <input type="date" name="dataprev" id="dataprev" class="inputUser" required>
      </div>

     <br><br>

     <div class="inputBox">
      <input type="hidden" name="datadev" id="datadev" class="inputUser" value="0">
     </div>

     <br><br>
     
     <input type="submit" name="submit" id="submit">
    
    </fieldset>
  </form>
</div>
</body>
</html>