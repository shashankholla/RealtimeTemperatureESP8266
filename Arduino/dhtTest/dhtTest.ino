#include <dht.h>
#define dataPin 7
dht DHT;

void setup() {
  Serial.begin(9600);
  //pinMode(7,INPUT);

}

void loop() {
  int readData = DHT.read11(dataPin);

  float t = DHT.temperature;
  float h = DHT.humidity;

  Serial.print("T ");
  Serial.println(t);
  Serial.print("H ");
  Serial.println(h);

  delay(2000);

}
