#include <SoftwareSerial.h>
#include <dht.h>
SoftwareSerial esp8266(10, 11);

#define DEBUG true

dht DHT;
int t, h;
String ipad = "my-smart-farm.herokuapp.com";
// String ipad = "192.168.1.6";

void setup()

{
  pinMode(13, OUTPUT);
  pinMode(A0, INPUT);
  pinMode(12, OUTPUT);
  Serial.begin(9600);
  esp8266.begin(9600);

  esp8266Serial("AT+RST\r\n", 1200, DEBUG);
  esp8266Serial("AT+CWMODE=1\r\n", 1200, DEBUG);

  // esp8266Serial("AT+UART_DEF=9600,8,1,0,0\r\n",5000,DEBUG);

  // esp8266Serial("AT+CWJAP=\"Shashank\",\"mathura2\"\r\n", 2500, DEBUG);
  esp8266Serial("AT+CWJAP=\"Desktop\",\"11111111\"\r\n", 2500, DEBUG);
  delay(500);

  String x = "AT+PING=\"" + ipad + "\"\r\n";

  esp8266Serial(x, 2000, DEBUG);
  delay(250);
}

void loop()
{

  int readData = DHT.read11(7);
  t = DHT.temperature;
  h = DHT.humidity;
  Serial.print("AnalogVolt" + (String)analogRead(A0));
  int x = map(analogRead(A0), 300, 1024, 100, 0);
  sendData(t, h, x);
}

void sendData(int t, int h, int moisture)
{

  String TCP = "AT+CIPSTART=\"TCP\",\"" + ipad + "\",80\r\n";
  esp8266Serial(TCP, 2000, DEBUG);
  delay(250);

  int wL = 0;
  int sl = 0;

  String s = "GET /receiver.php?temp=" + (String)t +
             "&humidity=" + (String)h +
             "&waterLevel=" + (String)wL +
             "&sunlight=" + (String)sl +
             "&moisture=" + (String)moisture +
             " HTTP/1.1\r\nHost: " + ipad + "\r\n\r\n";

  String length = "AT+CIPSEND=" + (String)s.length() + "\r\n";
  esp8266Serial(length, 500, DEBUG);
  Serial.print("Sending:");
  Serial.println(s);
  String resp = esp8266Serial(s, 1500, DEBUG);
  char mStatus = resp[resp.indexOf("motor") + 6];
  if (mStatus == '0')
  {
    digitalWrite(12, LOW);
    digitalWrite(13, LOW);
  }
  else
  {
    digitalWrite(12, HIGH);
    digitalWrite(13, HIGH);
  }
}

String esp8266Serial(String command, const int timeout, boolean debug)
{
  String response = "";
  esp8266.print(command);

  long int time = millis();
  while ((time + timeout) > millis())
  {
    while (esp8266.available())
    {
      char c = esp8266.read();
      response += c;
    }
  }
  if (DEBUG)
  {
    Serial.print(response);
  }

  return response;
}
