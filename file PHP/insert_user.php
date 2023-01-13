<?php

/*
    insert_user.php gestisce la registrazione di nuovi utenti 
*/




$host = "127.0.0.1";
$user = "root";
$psw = "";
$database = "progetto_android";


$connessione = new mysqli($host, $user, $psw, $database);

if($connessione === false){
    die("Errore di connessione: " . $connessione -> connect_error);
}

$email = $connessione -> real_escape_string($_POST['email']);
$password = $connessione -> real_escape_string($_POST['password']);
$nome = $connessione -> real_escape_string($_POST['nome']);
$lista = $connessione -> real_escape_string($_POST['lista']);


$query = "INSERT INTO login_user (nome, email, password, lista) VALUES ('$nome', '$email', '$password', '$lista')";

if($connessione -> query($query) === true){
    $risposta = "ok";
}else {
    $risposta = "no"; //Errore: Utente già registrato 
}

echo $risposta;

$connessione -> close();



?>