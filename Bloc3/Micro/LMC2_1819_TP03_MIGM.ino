#include "Arduino.h"
#include "MultiFuncShield.h"
#include "TimerOne.h"
#include "Wire.h"

/**
 * @author Martin
 */

/**
 * Fonction Setup
 */
void setup(){
	Timer1.initialize();
	MFS.initialize(&Timer1);
	Serial.begin(9600);
	MFS.write(8888);
}

unsigned long previousMillis = 0;
const long interval = 1000*60*3;

/**
 * Fonction loop
 */
void loop() {
  unsigned long currentMillis = millis();

  if (currentMillis - previousMillis >= interval) {
    previousMillis = currentMillis;
    int nbr = map(analogRead(0), 0, 1023, 0, 100);
    MFS.write(nbr);
  }
}
