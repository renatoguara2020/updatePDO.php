<?php
session_start();
include_once './conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Celke</title>
    </head>
    <body>
        <h1>Editar Mensagem</h1>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        //SQL para selecionar o registro
        $result_msg_cont = "SELECT * FROM mensagens_contatos WHERE id=$id";
        
        //Seleciona os registros
        $resultado_msg_cont = $conn->prepare($result_msg_cont);
        $resultado_msg_cont->execute();
        $row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC); 
        
        ?>
        <form method="POST" action="proc_edit_msg.php">
            <input type="hidden" name="id" value="<?php if(isset($row_msg_cont['id'])){ echo $row_msg_cont['id']; } ?>">
            
            <label>Nome: </label>
            <input type="text" name="nome" placeholder="Inserir o nome completo" value="<?php if(isset($row_msg_cont['nome'])){ echo $row_msg_cont['nome']; } ?>"><br><br>
            
            <label>E-mail: </label>
            <input type="email" name="email" placeholder="Seu melhor e-mail" value="<?php if(isset($row_msg_cont['email'])){ echo $row_msg_cont['email']; } ?>"><br><br>            
            
            <label>Assunto: </label>
            <input type="text" name="assunto" placeholder="Assunto da mensagem" value="<?php if(isset($row_msg_cont['assunto'])){ echo $row_msg_cont['assunto']; } ?>"><br><br>            
            
            <label>Mensagem: </label>
            <textarea name="mensagem" rows="3" cols="50"><?php if(isset($row_msg_cont['mensagem'])){ echo $row_msg_cont['mensagem']; } ?></textarea><br><br>
            
            <input name="SendEditCont" type="submit" value="Editar">
        </form>
    </body>
</html>
