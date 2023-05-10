<?php

include_once('config.php');

if(isset($_POST['update']))
{
 $id=$_POST['id'];
 $nomee=$_POST['nomee'];
 $emaile=$_POST['emaile'];
 $numeroe=$_POST['numeroe'];
 $sitee=$_POST['sitee'];

 $sqlUpdate="UPDATE editoras SET nomee='$nomee',emaile='$emaile',numeroe='$numeroe',sitee='$sitee'
 WHERE id='$id'";

 $result=$conexao->query($sqlUpdate);
}

header('Location:edito.php');

?>