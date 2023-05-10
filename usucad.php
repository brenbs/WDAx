<?php

if(isset($_POST['submit'])){

 include_once('config.php');

  $usuario=$_POST['usuario'];
  $emailu=$_POST['emailu'];
  $numerou=$_POST['numerou'];
  $enderecou=$_POST['enderecou'];
  $cidadeu=$_POST['cidadeu'];
  $cpfu=$_POST['cpfu'];
  
  $sqluser="SELECT * FROM  usuarios WHERE usuario ='$usuario'";

  $resultado = $conexao->query($sqluser);

  if(mysqli_num_rows($resultado)==1){

    echo "<script>window.alert('Usúario já existe')</script>";

}else{
  $result=mysqli_query($conexao,"INSERT INTO usuarios(usuario,emailu,numerou,enderecou,cidadeu,cpfu) VALUES ('$usuario','$emailu','$numerou','$enderecou','$cidadeu','$cpfu')");
  header('Location:usu.php');
}

}
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
  <form action="usucad.php" method="POST">

  <fieldset>
  <legend><b>Cadastro de Usuários</b></legend>
  <br>

  <div class="inputBox">
    <label for="usuario" class="labelInput">Nome Completo:</label>
    <input type="text" name="usuario" id="usuario" class="inputUser" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="emailu" class="labelInput">Email:</label>
    <input type="email" name="emailu" id="emailu" class="inputUser" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="numerou" class="labelInput">Número celular:</label>
    <input type="tel" name="numerou" id="numerou" class="inputUser" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="enderecou" class="labelInput">Seu Endereço (Logradouro, número,bairro):</label>
    <input type="text" name="enderecou" id="enderecou" class="inputUser" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="cidadeu" class="labelInput">Sua cidade(cidade e uf):</label>
    <input type="text" name="cidadeu" id="cidadeu" class="inputUser" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="cpfu" class="labelInput">Seu CPF (Opcional):</label>
    <input type="number" name="cpfu" id="cpfu" class="inputUser">
  </div>
  <br><br>

  <input type="submit" name="submit" id="submit">

  </fieldset>
  </form>
</div>
</body>
</html>