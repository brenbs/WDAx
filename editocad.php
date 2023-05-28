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
  <form action="editocad.php" method="POST" id="form">
    <fieldset>
     <legend><b>Cadastro de Editoras</b></legend>
     <br>
      <div class="inputBox">
      <label for="nomee" class="labelInput">Nome da Editora:</label>
      <input type="text" name="nomee" id="nomee" class="inputUser required"  placeholder=" "  oninput="nameValidate()">
      <span class="span-required">*Preencha esse campo corretamente !</span>
      </div>
      <br><br>
      <div class="inputBox">
        <label for="emaile" class="labelInput">Email da Editora:</label>
       <input type="email" name="emaile" id="emaile"class="inputUser required"  placeholder=" "  oninput="emailValidate()">
       <span class="span-required">*Preencha esse campo corretamente !</span>
      </div>
      <br><br>
      <div class="inputBox">
       <label for="numeroe" class="labelInput">Número celular:</label>
       <input type="tel" name="numeroe" id="numeroe" class="inputUser required"  placeholder=" "  oninput="telValidate()">
       <span class="span-required">*Preencha esse campo corretamente !</span>
      </div>
      <br><br>
      <div class="inputBox">
      <label for="sitee" class="labelInput">Site da Editora (opcional):</label>
       <input type="text" name="sitee" id="sitee">
       <span class="span-required">*Preencha esse campo corretamente !</span>
      </div>
      
      <br><br>
     
     <input type="submit" name="submit" id="submit">
    
    </fieldset>
  </form>
</div>

<script>
      //pegando todos os dados do formulário 
      var form = document.getElementById('form');
      var campos = document.querySelectorAll('.required');
      var spans = document.querySelectorAll('.span-required');
      var emailRegex = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i;
      
      //criando a validação do formulário
      form.addEventListener('submit',(event)=>{
        if(campos[0].value.length!=0 && campos[1].value.length!=0 && campos[2].value.length!=0){
          
        }else{
        nameValidate();
        emailValidate();
        telValidate();
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
      //validando nome
      function nameValidate(){
        if(campos[0].value.length < 3){
           setError(0);
        }else{
         removeError(0)
        }
      }
      //email
      function emailValidate(){
        if(emailRegex.test(campos[1].value)){
          removeError(1);
        }else{
          setError(1)
        }
      }
      //telefone
      function telValidate(){
        if(campos[2].value.length < 3){
           setError(2);
        }else{
         removeError(2)
        }
      }
   </script>
</body>
</html>