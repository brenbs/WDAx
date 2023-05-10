<?php

include_once('config.php');

if(isset($_POST['update']))
{
 $id=$_POST['id'];
 $nomel=$_POST['nomel'];
 $autor=$_POST['autor'];
 $editoral=$_POST['editoral'];
 $lanc=$_POST['lanc'];
 $estoque=$_POST['estoque'];

 $sqlUpdate="UPDATE livros SET nomel='$nomel',autor='$autor',editoral='$editoral',lanc='$lanc',estoque='$estoque'
 WHERE id='$id'";

 $result=$conexao->query($sqlUpdate);
}

header('Location:livr.php');

?>