<?php

include_once('config.php');

if(isset($_POST['update']))
{
 $id=$_POST['id'];
 $usuario=$_POST['usuario'];
 $emailu=$_POST['emailu'];
 $numerou=$_POST['numerou'];
 $enderecou=$_POST['enderecou'];
 $cidadeu=$_POST['cidadeu'];
 $cpfu=$_POST['cpfu'];

 $sqlUpdate="UPDATE usuarios SET usuario='$usuario',emailu='$emailu',numerou='$numerou',enderecou='$enderecou',cidadeu='$cidadeu',cpfu='$cpfu'
 WHERE id='$id'";

 $result=$conexao->query($sqlUpdate);
}

header('Location:usu.php');

?>