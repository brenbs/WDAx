<?php

if(isset($_POST['submit'])){

  include_once('config.php');

  $nomee=$_POST['nomee'];
  $emaile=$_POST['emaile'];
  $numeroe=$_POST['numeroe'];
  $sitee=$_POST['sitee'];

  $result=mysqli_query($conexao,"INSERT INTO editoras(nomee,emaile,numeroe,sitee) VALUES ('$nomee','$emaile','$numeroe','$sitee')");
  header('Location:edito.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="estilos/usucad.css">
 <title>Cadastro de Editoras</title>
</head>
<body>

<!--formulario-->

<div class="box">
  <form action="editocad.php" method="POST">
    <fieldset>
     <legend><b>Cadastro de Editoras</b></legend>
     <br>
      <div class="inputBox">
      <label for="nomee" class="labelInput">Nome da Editora:</label>
      <input type="text" name="nomee" id="nomee" class="inputUser" required>
      </div>
      <br><br>
      <div class="inputBox">
        <label for="emaile" class="labelInput">Email da Editora:</label>
       <input type="email" name="emaile" id="emaile" class="inputUser" required>
      </div>
      <br><br>
      <div class="inputBox">
       <label for="numeroe" class="labelInput">Número celular:</label>
       <input type="tel" name="numeroe" id="numeroe" class="inputUser" required>
      </div>
      <br><br>
      <div class="inputBox">
      <label for="sitee" class="labelInput">Site da Editora (opcional):</label>
       <input type="text" name="sitee" id="sitee" class="inputUser">
      </div>
      
      <br><br>
     
     <input type="submit" name="submit" id="submit">
    
    </fieldset>
  </form>
</div>
</body>
</html>