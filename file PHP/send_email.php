<?php

/*
    gestisce l'invio del repura password
*/



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



$host = "127.0.0.1";
$user = "root";
$psw = "";
$database = "progetto_android";


$connessione = new mysqli($host, $user, $psw, $database);

if($connessione === false){
    die("Errore di connessione: " . $connessione -> connect_error);
}



$email = $connessione -> real_escape_string($_POST['email']);
$pswreset = $connessione -> real_escape_string($_POST['psw_reset']);


$query = "SELECT * FROM login_user WHERE email='$email'";

$messaggio = "Ciao,";
$messaggio.= "<br />";
$messaggio.= "abbiamo resettato la tua password.";
$messaggio.= "<br />";
$messaggio.= "Trovi di seguito le tue nuove credenziali:" . "<br />";
$messaggio.=  "<br />";
$messaggio.= "PASSWORD: " . $pswreset . "<br />";
$messaggio.= "<br />";
$messaggio.= "Ti consigliamo di modificare la password al tuo primo accesso.";




if($result = $connessione -> query($query)){

        if($result -> num_rows>0){

            $item = $result -> fetch_array();
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'petsfood.email.service@gmail.com';
                $mail->Password = 'sqcbmthwxmbnq';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
            
                $mail->setFrom('from@example.com', 'Food Pets');
                $mail->addCC($email);
            
                $mail->isHTML(true); 
                $mail->Subject = 'Richiesta recupero password Food Pets';
                $mail->Body = $messaggio;
            
                $mail->send();
                $id = $item['id'];
                $query2 = "UPDATE login_user SET password='$pswreset' WHERE id=$id";
                if( $connessione -> query($query2) === true){

                    echo 'Abbiamo inviato un email alla tua posta ti preghiamo di controllare.';
                }else{
                    echo 'Abbiamo riscontrato un errore. Riprova.';
                }
               
            } catch (Exception $e) {
                echo 'Messaggio non inviato. Food Pets Error: ', $mail->ErrorInfo;
            }
        }else{
            echo 'Email non presente nei nostri sistemi.';
        }


}else{
    echo 'Errore! Riprovare tra un pò.'; //Errore nell'esecuzione della query

}




$connessione -> close();








?>