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

$queryselect= "SELECT * FROM login_user WHERE id=$id";

if($result = $connessione->query($query_select)){

    if($result -> num_rows > 0){
        $item = $result -> fetch_array();

        $risposta = $item['lista'];

    }else{
        $risposta = "no" ;
    }
    

}else {
    $risposta= "no";
}

echo $risposta;

$connessione -> close();

?>
