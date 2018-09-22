#include <SoftwareSerial.h>
#include<dht.h>
SoftwareSerial esp8266(2,3); //Pin 2 & 3 of Arduino as RX and TX. Connect TX and RX of ESP8266 respectively.
#define DEBUG true
#define led_pin 13 //LED is connected to Pin 11 of Arduino
int a = 1;
dht DHT;
float t,h;
void setup()
  {
    
    pinMode(led_pin, OUTPUT);
    digitalWrite(led_pin, LOW);
    Serial.begin(9600);
    esp8266.begin(115200); //Baud rate for communicating with ESP8266. Your's might be different.
    esp8266Serial("AT+RST\r\n", 5000, DEBUG); // Reset the ESP8266
    esp8266Serial("AT+CWMODE_CUR=1\r\n", 5000, DEBUG); //Set station mode Operation
    esp8266Serial("AT+CWJAP=\"Shashank\",\"mathura2\"\r\n", 5000, DEBUG);//Enter your WiFi network's SSID and Password.
    esp8266Serial("AT+PING=\"192.168.1.5\"\r\n",5000,DEBUG);
                     
   /* while(!esp8266.find("OK")) 
    {
      }*/ 
   // esp8266Serial("AT+CIFSR\r\n", 5000, DEBUG);//You will get the IP Address of the ESP8266 from this command. 
    //esp8266Serial("AT+CIPMUX=1\r\n", 5000, DEBUG);
    //esp8266Serial("AT+CIPSERVER=1,80\r\n", 5000, DEBUG);
  }

void loop()
  {
    //Reading data from TempSensor

    int readData = DHT.read11(7);
    t = DHT.temperature;
    h = DHT.humidity;
    
    Serial.print(t);

    
    sendData(1,1);
    delay(3000);
 /*   if (esp8266.available())
      {
        if (esp8266.find("+IPD,"))
          {
            String msg;
            esp8266.find("?");
            msg = esp8266.readStringUntil(' ');
            String command1 = msg.substring(0, 3);
            String command2 = msg.substring(4);
                        
            if (DEBUG) 
              {
                Serial.println(command1);//Must print "led"
                Serial.println(command2);//Must print "ON" or "OFF"
              }
            delay(100);

              if (command2 == "ON") 
                    {
                      digitalWrite(led_pin, HIGH);
                    }
                   else 
                     {
                       digitalWrite(led_pin, LOW);
                     }
          }
      }

   */   
      
      delay(5000);

      
  }

void sendData(int a,int b)
{
  Serial.println("Sending");
   esp8266Serial("AT+CIPSTART=\"TCP\",\"192.168.1.5\",80\r\n",5000,DEBUG);    
   delay(1000);
 
  int ti = (int) t;
  int hi = (int) h;
  
  String s = "GET /esp8266/receiver.php?apples="+(String) ti+ "&oranges="+ (String)hi +" HTTP/1.1\r\nHost: 192.168.1.5\r\n\r\n" ;
  Serial.print(s);
      String lengt = "AT+CIPSEND=" + (String) s.length() + "\r\n";
      Serial.print(lengt);
      Serial.println(s.length());

      
     esp8266Serial(lengt,1000,DEBUG);
     
      
  
      esp8266Serial(s, 5000, DEBUG);
    
    Serial.print(t);
    delay(1000);
   // Serial.println("Sent data");


  
}


String esp8266Serial(String command, const int timeout, boolean debug)
  {
    String response = "";
    esp8266.print(command);
    long int time = millis();
    while ( (time + timeout) > millis())
      {
        while (esp8266.available())
          {
            char c = esp8266.read();
            response += c;
          }
      }
    if (debug)
      {
        Serial.print(response);
      }
    return response;
}
