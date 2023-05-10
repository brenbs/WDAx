<?php

include_once('config.php');

if(isset($_POST['update']))
{
 $id=$_POST['id'];
 $nomela=$_POST['nomela'];
 $nomeua=$_POST['nomeua'];
 $dataalug=$_POST['dataalug'];
 $dataprev=$_POST['dataprev'];
 $datadev=$_POST['datadev'];

 $sqlUpdate="UPDATE alugados SET nomela='$nomela',nomeua='$nomeua',dataalug='$dataalug',dataprev='$dataprev',datadev='$datadev'
 WHERE id='$id'";

 $result=$conexao->query($sqlUpdate);
}

header('Location:alug.php');

?>