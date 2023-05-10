<?php

include_once('config.php');

if(isset($_POST['submit'])){

  include_once('config.php');

  $nomel=$_POST['nomel'];
  $autor=$_POST['autor'];
  $editoral=$_POST['editoral'];
  $lanc=$_POST['lanc'];
  $estoque=$_POST['estoque'];

  $result=mysqli_query($conexao,"INSERT INTO livros(nomel,autor,editoral,lanc,estoque) VALUES ('$nomel','$autor','$editoral','$lanc','$estoque')");
  header('Location:livr.php');
}

// Conexão tabela editoras
$sqleditora_conect = "SELECT * FROM editoras ORDER BY id ASC";
$resulteditora_conect = $conexao -> query($sqleditora_conect);
 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="estilos/usucad.css">
 <title>Cadastro de Livros</title>
 <style>
  #editoral{
    width:200px;
  }
 </style>
</head>
<body>

<!--formulario-->

<div class="box">
  <form action="livrcad.php" method="POST">
    <fieldset>
     <legend><b>Cadastro de Livros</b></legend>
     <br>
      <div class="inputBox">
      <label for="nomel" class="labelInput">Nome :</label>
      <input type="text" name="nomel" id="nomel" class="inputUser" required>
      </div>

      <br><br>

      <div class="inputBox">
        <label for="autor" class="autor">Autor:</label>
       <input type="autor" name="autor" id="autor" class="inputUser" required>
      </div>

      <br>

      <div class="inputBox"> 
      <label for="editoral" class="labelInput">Editora:</label><br>
        <select name="editoral" id="" value="Editora:">
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
       <input type="date" name="lanc" id="lanc" class="inputUser" required>
      </div>
      
      <br><br>

      <div class="inputBox">
      <label for="estoque" class="labelInput">Quantidade:</label>
       <input type="number" name="estoque" id="estoque" class="inputUser" required>
      </div>

      <br><br>

     <input type="submit" name="submit" id="submit">
    
    </fieldset>
  </form>
</div>
</body>
</html>

 
