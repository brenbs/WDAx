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
  <form action="livrcad.php" method="POST" id="form">
    <fieldset>
     <legend><b>Cadastro de Livros</b></legend>
     <br>
      <div class="inputBox">
      <label for="nomel" class="labelInput">Nome :</label>
      <input type="text" name="nomel" id="nomel" class="inputUser required"oninput="nameValidate()" >
      <span class="span-required">*Preencha esse campo corretamente !</span>
      </div>

      <br><br>

      <div class="inputBox">
        <label for="autor" class="autor">Autor:</label>
       <input type="autor" name="autor" id="autor" class="inputUser required" oninput="autorValidate()" >
      <span class="span-required">*Preencha esse campo corretamente !</span>
      </div>

      <br>

      <div class="inputBox"> 
      <label for="editoral" class="labelInput">Editora:</label><br>
        <select name="editoral" id="selecionar_editora"  class="inputUser required" oninput="editoraValidate()">
          <option value="0">Selecionar</option>
            <?php
            
              while($editora_data = mysqli_fetch_assoc($resulteditora_conect)){
              
                echo "<option>".$editora_data['nomee']."</option>";
              
              }
            ?>
        </select>
      <span class="span-required">*Preencha esse campo corretamente !</span>
      </div>

      <br><br>

      <div class="inputBox">
       <label for="lanc" class="labelInput">Data de Lançamento:</label>
       <input type="date" name="lanc" id="lanc" class="inputUser required" oninput="dataValidate()" >
      <span class="span-required">*Preencha esse campo corretamente !</span>
      </div>
      
      <br><br>

      <div class="inputBox">
      <label for="estoque" class="labelInput">Quantidade:</label>
       <input type="number" name="estoque" id="estoque" class="inputUser required "oninput="estoqueValidate()" >
      <span class="span-required">*Preencha esse campo corretamente !</span>
      </div>

      <br><br>

     <input type="submit" name="submit" id="submit">
    
    </fieldset>
  </form>
</div>
<script>
      //pegando dados
      var form = document.getElementById('form');
      var campos = document.querySelectorAll('.required');
      var spans = document.querySelectorAll('.span-required');
      var data = document.getElementById('lanc');
      var select = document.getElementById('selecionar_editora');
      
      //validação
      form.addEventListener('submit',(event)=>{
        if(campos[0].value.length!=0 && campos[1].value.length!=0 && campos[2].value.length!=0 && campos[3].value.length!=0 && campos[4].value.length!=0){
      
        }else{
        nameValidate();
        autorValidate();
        editoraValidate();
        dataValidate();
        estoqueValidate();
        event.preventDefault();
        }
        
      })
        
      //função alert
      function setError(index){
        campos[index].style.color = '#e63636'
        spans[index].style.display ='block'
      }
      function removeError(index){
        campos[index].style.color = ''
        spans[index].style.display ='none'
      }
      //validar nome
      function nameValidate(){
        if(campos[0].value.length < 3){
           setError(0);
        }else{
         removeError(0)
        }
      }
     
      //autor
      function autorValidate(){
        if(campos[1].value.length < 3){
           setError(1);
        }else{
         removeError(1)
        }
      }
       //editora
      function editoraValidate(){
        if(select.value==0){
           setError(2);
           return;
        }else{
         removeError(2);
        }
      }
       //data de lançamento
       function dataValidate(){
        if(data.value == ''){
    		setError(3);
    		return;
    	}else{
        removeError(3);
      }
       
      }
       //estoque
      function estoqueValidate(){
        if(campos[4].value.length< 1){
           setError(4);
        }else{
         removeError(4)
        }
      }

    </script>
</body>
</html>

 
