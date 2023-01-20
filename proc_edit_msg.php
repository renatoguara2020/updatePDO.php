<?php
session_start();
include_once 'conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendEditCont = filter_input(INPUT_POST, 'SendEditCont', FILTER_SANITIZE_STRING);
if($SendEditCont){
    //Receber os dados do formulário
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
    
    //Inserir no BD
    $result_msg_cont = "UPDATE mensagens_contatos SET nome=:nome, email=:email, assunto=:assunto, mensagem=:mensagem WHERE id=$id";
    
    $update_msg_cont = $conn->prepare($result_msg_cont);
    $update_msg_cont->bindParam(':nome', $nome);
    $update_msg_cont->bindParam(':email', $email);
    $update_msg_cont->bindParam(':assunto', $assunto);
    $update_msg_cont->bindParam(':mensagem', $mensagem);
    
    if($update_msg_cont->execute()){
        $_SESSION['msg'] = "<p style='color:green;'>Mensagem editada com sucesso</p>";
        header("Location: index.php");
    }else{
        $_SESSION['msg'] = "<p style='color:red;'>Mensagem não foi editada com sucesso</p>";
        header("Location: index.php");
    }    
}else{
    $_SESSION['msg'] = "<p style='color:red;'>Mensagem não foi editada com sucesso</p>";
    header("Location: index.php");
}