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
  <form action="usucad.php" method="POST" id="form">

  <fieldset>
  <legend><b>Cadastro de Usuários</b></legend>
  <br>

  <div class="inputBox">
    <label for="usuario" class="labelInput">Nome Completo:</label>
    <input type="text" name="usuario" id="usuario" class="inputUser required" oninput="nameValidate()" >
     <span class="span-required">*Preencha esse campo corretamente !</span>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="emailu" class="labelInput">Email:</label>
    <input type="email" name="emailu" id="emailu" class="inputUser required" oninput="emailValidate()" >
     <span class="span-required">*Preencha esse campo corretamente !</span>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="numerou" class="labelInput">Número celular:</label>
    <input type="tel" name="numerou" id="numerou" class="inputUser required" oninput="telValidate()" >
     <span class="span-required">*Preencha esse campo corretamente !</span>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="enderecou" class="labelInput">Seu Endereço (Logradouro, número,bairro):</label>
    <input type="text" name="enderecou" id="enderecou" class="inputUser required" oninput="streetValidate()" >
     <span class="span-required">*Preencha esse campo corretamente !</span>
  </div>
  <br><br>
  <div class="inputBox">
    <label for="cidadeu" class="labelInput">Sua cidade(cidade e uf):</label>
    <input type="text" name="cidadeu" id="cidadeu" class="inputUser required"oninput="cityValidate()" >
     <span class="span-required">*Preencha esse campo corretamente !</span>
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

<script>
      //pegando todos os dados do formulário 
      var form = document.getElementById('form');
      var campos = document.querySelectorAll('.required');
      var spans = document.querySelectorAll('.span-required');
      var emailRegex = /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i;
      
      
      //criando a validação do formulário
      form.addEventListener('submit',(event)=>{
        if(campos[0].value.length!=0 && campos[1].value.length!=0 && campos[2].value.length!=0 && campos[3].value.length!=0 && campos[4].value.length!=0){
         
        }else{
        nameValidate()
        emailValidate()
        telValidate()
        cityValidate()
        streetValidate()
        event.preventDefault();
        }
      })
        
      //criando uma função para alertar que ta errado
      function setError(index){
        campos[index].style.color = '#e63636'
        spans[index].style.display ='block'
      }
      //criando uma função para remover o alerta 
      function removeError(index){
        campos[index].style.color = ''
        spans[index].style.display ='none'
      }
      //criando a função para validar o campo do nome
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
       //cidade
      function cityValidate(){
        if(campos[4].value.length < 3){
           setError(4);
        }else{
         removeError(4)
        }
      }
  
       //endereço
      function streetValidate(){
        if(campos[3].value.length < 3){
           setError(3);
        }else{
         removeError(3)
        }
      }

    </script>
</body>
</html>