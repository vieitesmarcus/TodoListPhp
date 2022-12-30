<?php
session_start();
require __DIR__.'/../Model/Todo.php';

if(isset($_POST['todo'])){
    $text = filter_input(INPUT_POST, 'todo', FILTER_SANITIZE_STRIPPED);
    $obTodo = new Todo();
    $obTodo->setText(trim($text));
    if($obTodo->getText()==""){
        header('Location:/todo', true, 302);
        exit();
    }

    $obTodo->insert();
    $_SESSION['success'] = "criado com sucesso";
    header('Location:/todo', true, 302);
}

if(isset($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $obTodo = new Todo();
    $obTodo = $obTodo->find($id);

    $obTodo->delete();
    $_SESSION['danger'] = "deletado com sucesso";
//    var_dump($obTodo);
    header('Location:/todo', true, 302);
}
$todo = "";
if(isset($_GET['edit'])){
    $id = filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT);
    $text = filter_input(INPUT_GET, 'todo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $obTodo = new Todo();
    /* @var Todo $todo */
    $todo = $obTodo->find($id);
    $todo->setText($text);
    $todo->update();
    $_SESSION['info'] = "Alterado com sucesso";

    header('Location:/todo', true, 302);
}

function findAll(){
    $obTodo = new Todo();
    return $obTodo->findAll();
}







