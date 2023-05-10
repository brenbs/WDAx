<?php

include_once('config.php');

if(!empty($_GET['id'])){

 include_once('config.php');

 $id=$_GET['id'];

 $sqlSelect="SELECT*FROM livros WHERE id=$id";

 $result=$conexao->query($sqlSelect);

 if($result->num_rows>0)
 {
  while($user_data=mysqli_fetch_assoc($result))
  {
  $nomel=$user_data['nomel'];
  $autor=$user_data['autor'];
  $editoral=$user_data['editoral'];
  $lanc=$user_data['lanc'];
  $estoque=$user_data['estoque'];
  }
  
 }
 else{
   header('Location:livr.php');
 }
  
}else{
  header('Location:livr.php');
}

// Conexão tabela editoras
$sqleditora_conect = "SELECT * FROM editoras ORDER BY id ASC";
$resulteditora_conect = $conexao -> query($sqleditora_conect);

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="estilos/usucad.css">
 <title>Editar Livro</title>
</head>
<body>

<a href='livr.php'><button>Voltar</button></a>
<!--formulario-->

<div class="box">
  <form action="livroSaveEdit.php" method="POST">

  <fieldset>
  <legend><b>Editar Livro</b></legend>
  <br>

  <div class="inputBox">
    <label for="nomel" class="labelInput">Nome:</label>
    <input type="text" name="nomel" id="nomel" class="inputUser" value="<?php echo $nomel ?>" required>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="autor" class="labelInput">Autor:</label>
    <input type="text" name="autor" id="autor" class="inputUser" value="<?php echo $autor ?>" required>
  </div>
  <br><br>
  <div class="inputBox"> 
      <label for="editoral" class="labelInput">Editora:</label><br>
        <select name="editoral" id="" value="Editora:" value="<?php echo $editoral ?>">
          <option value="Selecionar">Selecionar</option>
            <?php
            
              while($editora_data = mysqli_fetch_assoc($resulteditora_conect)){
              
                echo "<option>".$editora_data['nomee']."</option>";
              
              }
            ?>
        </select>
      </div>
  <br><br>
  <div class="inputBox">
       <label for="lanc" class="labelInput">Data de Lançamento:</label>
       <input type="date" name="lanc" id="lanc" class="inputUser" value="<?php echo $lanc ?>" required>
      </div>
  <br><br>
  <div class="inputBox">
    <label for="estoque" class="labelInput">Estoque:</label>
    <input type="text" name="estoque" id="estoque" class="inputUser" value="<?php echo $estoque ?>" required>
  </div>
  <br><br>
  <input type="hidden" name="id" value="<?php echo $id ?>">
  <input type="submit" name="update" id="update">

  </fieldset>
  </form>
</div>
</body>
</html>