<?php

if(!empty($_GET['id'])){

 include_once('config.php');

 $id=$_GET['id'];

 $sqlSelect="SELECT*FROM usuarios WHERE id=$id";

 $result=$conexao->query($sqlSelect);

 if($result->num_rows>0)
 {
  while($user_data=mysqli_fetch_assoc($result))
  {
  $usuario=$user_data['usuario'];
  $emailu=$user_data['emailu'];
  $numerou=$user_data['numerou'];
  $enderecou=$user_data['enderecou'];
  $cidadeu=$user_data['cidadeu'];
  $cpfu=$user_data['cpfu'];
  }
  
 }
 else{
   header('Location:usu.php');
 }
  
}else{
  header('Location:usu.php');
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

<a href='usu.php'><button>Voltar</button></a>
<!--formulario-->

<div class="box">
  <form action="usuarioSaveEdit.php" method="POST">

  <fieldset>
  <legend><b>Editar Usuário</b></legend>
  <br>

  <div class="inputBox">
    <label for="usuario" class="labelInput">Nome Completo:</label>
    <input type="text" name="usuario" id="usuario" class="inputUser" value="<?php echo $usuario ?>" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="emailu" class="labelInput">Email:</label>
    <input type="email" name="emailu" id="emailu" class="inputUser" value="<?php echo $emailu ?>" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="numerou" class="labelInput">Número celular:</label>
    <input type="tel" name="numerou" id="numerou" class="inputUser" value="<?php echo $numerou ?>" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="enderecou" class="labelInput">Seu Endereço (Logradouro, número,bairro):</label>
    <input type="text" name="enderecou" id="enderecou" class="inputUser" value="<?php echo $enderecou ?>" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="cidadeu" class="labelInput">Sua cidade(cidade e uf):</label>
    <input type="text" name="cidadeu" id="cidadeu" class="inputUser" value="<?php echo $cidadeu ?>" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="cpfu" class="labelInput">Seu CPF (Opcional):</label>
    <input type="number" name="cpfu" id="cpfu" class="inputUser" value="<?php echo $cpfu ?>">
  </div>
  <br><br>
  <input type="hidden" name="id" value="<?php echo $id ?>">
  <input type="submit" name="update" id="update">

  </fieldset>
  </form>
</div>
</body>
</html>