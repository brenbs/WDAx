<?php

if(!empty($_GET['id'])){

 include_once('config.php');

 $id=$_GET['id'];

 $sqlSelect="SELECT*FROM editoras WHERE id=$id";

 $result=$conexao->query($sqlSelect);

 if($result->num_rows>0)
 {
  while($user_data=mysqli_fetch_assoc($result))
  {
  $nomee=$user_data['nomee'];
  $emaile=$user_data['emaile'];
  $numeroe=$user_data['numeroe'];
  $sitee=$user_data['sitee'];
  }
  
 }
 else{
   header('Location:edito.php');
 }
  
}else{
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
 <title>Editar Editora</title>
</head>
<body>

<a href='edito.php'><button>Voltar</button></a>

<div class="box">
  <form action="editoraSaveEdit.php" method="POST">

  <fieldset>
  <legend><b>Editar Editora</b></legend>
  <br>

  <div class="inputBox">
    <label for="nomee" class="labelInput">Nome:</label>
    <input type="text" name="nomee" id="nomee" class="inputUser" value="<?php echo $nomee ?>" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="emaile" class="labelInput">Email:</label>
    <input type="email" name="emaile"id="emaile" class="inputUser" value="<?php echo $emaile ?>" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="numeroe" class="labelInput">Telefone:</label>
    <input type="tel" name="numeroe" id="numeroe" class="inputUser" value="<?php echo $numeroe ?>" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="sitee" class="labelInput">Site:</label>
    <input type="text" name="sitee" id="sitee" class="inputUser" value="<?php echo $sitee ?>">
  </div>
  <br><br>
  <input type="hidden" name="id" value="<?php echo $id ?>">
  <input type="submit" name="update" id="update">

  </fieldset>
  </form>
</div>
</body>
</html>