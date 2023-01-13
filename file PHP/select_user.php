<?php

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

$query = "SELECT * FROM login_user WHERE email='$email'";

if($result = $connessione -> query($query)){

        if($result -> num_rows>0){

            $element = $result ->fetch_array();
            if($element['password'] == $password){

                $risposta = (string) $element['id'];    //restituisco l'id in maniera da poter recuperare poi l'oggetto

            }else{
                $risposta = "noP";  //password non corretta
            }

        }else{
            
            $risposta = "noU"; //utente non presente in DB -> utente non registrato 

        }


}else{
    $risposta = "noE"; //Errore nell'esecuzione della query

}

echo $risposta;

$connessione -> close();

?>