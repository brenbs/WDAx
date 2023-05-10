<?php

session_start();

if(isset($_POST['submit']) && !empty($_POST['adm']) && !empty($_POST['adme']) && !empty($_POST['senha'])){
 //acessa
 include_once('config.php');

 $adm=$_POST['adm'];
 $adme=$_POST['adme'];
 $senha=$_POST['senha'];

 $sql="SELECT*FROM admi WHERE adm='$adm' and adme='$adme' and senha='$senha'";

 $result= $conexao->query($sql);

 if(mysqli_num_rows($result)<1){
   unset($_SESSION['adm']);
   unset($_SESSION['adme']);
   unset($_SESSION['senha']);
   
  header('Location:home.php');
 
 }
 else{
  $_SESSION['adm']=$adm;
  $_SESSION['adme']=$adme;
  $_SESSION['senha']=$senha;
  
  header('Location:dash.php');
 }

}else{
 //nao acessa
 header('Location:home.php');
}

?>