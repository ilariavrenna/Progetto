#include <SoftwareSerial.h>
#include <Servo.h>
#define PIN_SERVO 9


SoftwareSerial BTSerial(2, 3);

String inputString="";
Servo servo;
const int echoPin= 11;
const int triggerPin= 10;

void setup() {
  //  Serial.begin(38400);
    BTSerial.begin(9600);
    servo.attach(PIN_SERVO);//colleghiamo il servo al pin 
   
    pinMode(echoPin, INPUT); //configuro come porta di input
    pinMode(triggerPin, OUTPUT); //configuro come porta di output

}

void loop() {
   //controlliamo se ci sono dei caratteri disponibili da leggere sul bluetooth
   if (BTSerial.available()) {
    //Leggiamo i caratteri ricevuti
      while (BTSerial.available()) {
          char inChar = (char) BTSerial.read();
           inputString += inChar; 
      }
  
      if (inputString == "a") { 
          //Aziono il servoMotore
          for (int i = 90; i < 180; i++) {
              servo.write(i);
              delay(20); 
          }
          servo.write(90);
          delay(1000);
          for (int i = -90; i >= 0; i--) {
               servo.write(i);
                delay(20); 
          }
          servo.write(90); //fermo il servomotore
          delay(1000); 
          
         InviaDati();
  
      }else if( inputString == "b"){

        InviaDati();
      }
      inputString ="";
     
      }
}


void InviaDati(){
  
  digitalWrite(triggerPin, LOW);
  //Azioniamo il pin di trigger per avviare la misura della distanza
  digitalWrite(triggerPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(triggerPin, LOW);

  //Recuperiamo la durata temporale
  long durata= pulseIn(echoPin, HIGH);

  //calcoliamo la distanza
  long distanza= 0.034 * durata /2 ;

  //Serial.println(distanza);

  BTSerial.print(distanza); //inviamo la distanza calcolata 
  BTSerial.print("-");
  delay(100);
  
}
