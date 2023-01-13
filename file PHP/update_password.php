<?php

$host = "127.0.0.1";
$user = "root";
$psw = "";
$database = "progetto_android";

$connessione = new mysqli($host, $user, $psw, $database);

if($connessione === false){
    die("Errore di connessione: " . $connessione -> connect_error);
}


$id = $connessione -> real_escape_string($_POST['id']);
$pswNew = $connessione -> real_escape_string($_POST['nuovaPsw']);

$query= "UPDATE login_user SET password='$pswNew' WHERE id=$id";

if( $connessione -> query($query) === true){
    echo "ok";
}else{
    echo "no";
}

$connessione -> close();


?>