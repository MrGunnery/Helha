#include "Arduino.h"
#include "avr/sleep.h"
#include "MultiFuncShield.h"
#include "Wire.h"
#include "TimerOne.h"

#define WAKEIN 18
#define BTN1 17

String val = "";
int nbr = 0;
unsigned long previousMillis = 0;
const long interval = 1000 * 10;

void setup() {
	Timer1.initialize();
	MFS.initialize(&Timer1);
	MFS.write("OOOO");
	pinMode(WAKEIN, INPUT);
	pinMode(BTN1, INPUT);
	Serial.begin(9600);
}

// The loop function is called in an endless loop
void loop() {

	unsigned long currentMillis = millis();
	// compute the serial input
	if (val.equals("")) {
		if (Serial.available()) {
			val = Serial.readString();
			val = val.substring(0, 4);
			nbr = val.toInt();
			Serial.println(val);
			MFS.write(nbr);
			previousMillis = currentMillis;
			delay(5000);
			MFS.write("");

		}
	} else {
		if (!digitalRead(BTN1)) {
			MFS.write(nbr);
			previousMillis = currentMillis;
			delay(5000);
			MFS.write("");
		}
		// check if it should go to sleep because of time
		if (currentMillis - previousMillis >= interval && !val.equals("")) {
			previousMillis = currentMillis;

			enterSleepMode();     // sleep function called here
		}
	}

}

void enterSleepMode() {
	Serial.print("Timer: SleepMode on\r\n");
	delay(100);
	// définition du mode de mise en veille
	set_sleep_mode(SLEEP_MODE_PWR_DOWN);
	sleep_enable()
	;
	// attachement d’une interruption sur la broche 2 (INT0)
	attachInterrupt(digitalPinToInterrupt(WAKEIN), wakeUpInterrupt, LOW);
	// mise à veille
	sleep_mode()
	;
	sleep_disable()
	;
	// réveil ici
	// évite de constamment déclencher des interruptions inutiles!
	detachInterrupt(digitalPinToInterrupt(WAKEIN));
	Serial.println("Timer: SleepMode off\r\n");

}

void wakeUpInterrupt() {

}

