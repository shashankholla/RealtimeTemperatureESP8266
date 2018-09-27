#include <SoftwareSerial.h>
#include<dht.h>
SoftwareSerial esp8266(2,3); 




#define DEBUG true

int a = 1;
dht DHT;


float t,h;
String ipad = "192.168.43.23";
void setup()

  
  
  {
    Serial.println("Here goes");
    
    
    Serial.begin(9600);
    esp8266.begin(9600); 
    esp8266Serial("AT+RST\r\n", 5000, DEBUG); 
    esp8266Serial("AT+CWMODE_CUR=1\r\n", 5000, DEBUG); 
   
   
   
   // esp8266Serial("AT+UART_DEF=9600,8,1,0,0\r\n",5000,DEBUG);
   
    
    esp8266Serial("AT+CWJAP=\"ASUS_X00TD\",\"testtest123\"\r\n", 5000, DEBUG);
    delay(1000);
    
    
    String x = "AT+PING=\""+ipad+"\"\r\n";
    
    
    esp8266Serial(x,5000,DEBUG);
    delay(1000);                     
  
   // esp8266Serial("AT+CIFSR\r\n", 5000, DEBUG)
    //esp8266Serial("AT+CIPMUX=1\r\n", 5000, DEBUG);
    //esp8266Serial("AT+CIPSERVER=1,80\r\n", 5000, DEBUG);
  }

void loop()
  {
    

    int readData = DHT.read11(7);
    t = DHT.temperature;
    h = DHT.humidity;
    
    if(DEBUG)
    {Serial.print("TEMPERATURE");
    Serial.println(t);
    }
    
    sendData(1,1);
   


      
  }

void sendData(int a,int b)
{
  Serial.println("Sending");
  String TCP = "AT+CIPSTART=\"TCP\",\"" + ipad + "\",80\r\n";
   esp8266Serial(TCP,5000,DEBUG);    
   delay(1000);
 
  int ti = (int) t;
  int hi = (int) h;

 
  String s = "GET /esp8266/receiver.php?temp="+(String) ti+ "&humidity="+ (String)hi +" HTTP/1.1\r\nHost: "+ipad+ "\r\n\r\n" ;
  
      String lengt = "AT+CIPSEND=" + (String) s.length() + "\r\n";
     // Serial.print(lengt);
    //  Serial.println(s.length());

      
     esp8266Serial(lengt,1000,DEBUG);
     
      
  
      esp8266Serial(s, 5000, DEBUG);
    
    //Serial.print(t);
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

    if(response.indexOf("SUCCESS") > 0)
    {
      Serial.println("\n Yolo sent NOW!!!!!!!!!!! ");
    }
    return response; 
}
