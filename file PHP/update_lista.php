<?php

/*

    Aggiorniamo la lista delle ultime erogazioni

*/

$host = "127.0.0.1";
$user = "root";
$psw = "";
$database = "progetto_android";


$connessione = new mysqli($host, $user, $psw, $database);

if($connessione === false){
    die("Errore di connessione: " . $connessione -> connect_error);
}

$id = $connessione -> real_escape_string($_POST['id']);
$lista= $connessione -> real_escape_string($_POST['list']); //stringa data e ora ultima erogazione 

$queryupdate = "UPDATE login_user SET lista='$lista' WHERE id=$id";


if($connessione -> query($queryupdate) === true){
        $risposta = "ok";
}else {
        $risposta= "no";
}


echo $risposta;

$connessione -> close();




?>