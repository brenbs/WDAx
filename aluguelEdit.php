<?php 
    if(!empty($_GET['id'])){
        include_once('config.php');
        
        date_default_timezone_set('America/Sao_Paulo');

        $id= $_GET['id'];

        $sqlSelect = "SELECT * FROM alugados WHERE id = $id";
        $resultSelect = $conexao -> query($sqlSelect);

        $user_data = mysqli_fetch_assoc($resultSelect);
        $livro = $user_data['nomela'];

        $hoje = new DateTime();
        $hoje2 = $hoje -> format('d/m/Y');


        // Conexão tabela Livros
        $sqllivro_conect = "SELECT * FROM livros WHERE nomel = '$livro'";
        $resultlivro_conect = $conexao -> query($sqllivro_conect);

        $livro_data = mysqli_fetch_assoc($resultlivro_conect);
        $nomeLivro_BD = $livro_data['nomel'];   
        $quantidade_BD = $livro_data['estoque'];
        $quantidade_nova = $quantidade_BD + 1;
        
        $sqlAlterar = "UPDATE livros SET estoque = '$quantidade_nova' WHERE nomel = '$nomeLivro_BD'";
        $sqlResultAlterar = $conexao -> query($sqlAlterar);

        if($resultSelect -> num_rows > 0){
            $sqlUpdate = "UPDATE alugados SET datadev = '$hoje2' WHERE id= $id";
            $resultUpdate = $conexao -> query($sqlUpdate);
        }
        else{
            header('Location:alug.php');
        }
        header('Location:alug.php');
    }

?>