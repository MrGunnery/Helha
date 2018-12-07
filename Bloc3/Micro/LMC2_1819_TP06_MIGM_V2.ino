#include "Arduino.h"

#define BTN_PROG 52
#define BTN_STYLE 53
const int LED[4] = { 32, 33, 30, 31 };
const int BTN_LED[4] = { 50, 51, 48, 49 };

boolean enable[4] = { 0, 0, 0, 0 };
boolean mode;
boolean first;
int nbClick = 0;

void setup() {
	pinMode(BTN_PROG, INPUT);
	pinMode(BTN_STYLE, INPUT);
	for (int var = 0; var < 4; var++) {
		pinMode(BTN_LED[var], INPUT);
		pinMode(LED[var], OUTPUT);
		digitalWrite(LED[var], 1);
	}
	Serial.begin(9600);
}

void loop() {
	nbClick = 0;
	first = 0;
	while (!digitalRead(BTN_PROG)) {
		if (!first) {
			Serial.print("PROGRAMATION \r\n");
			for (int var = 0; var < 4; var++) {
				digitalWrite(LED[var], 1);
				enable[var] = 0;
			}
			first = 1;
		}
		if (!digitalRead(BTN_STYLE)) {
			nbClick++;
			Serial.print(nbClick);
			Serial.print("\r\n");
			while (!digitalRead(BTN_STYLE)) {

			}
		}
		if (nbClick == 2) {
			mode = 0;
		} else if (nbClick == 3) {
			mode = 1;
		}
		for (int var = 0; var < 4; var++) {
			if (!digitalRead(BTN_LED[var])) {
				enable[var] = 1;
			}
		}
	}
	if (mode) {
		for (int var = 0; var < 4; var++) {
			if (enable[var]) {
				digitalWrite(LED[var], 1);
			}
		}
		delay(500);
		for (int var = 0; var < 4; var++) {
			if (enable[var]) {
				digitalWrite(LED[var], 0);
			}
		}
		delay(500);

	} else {
		for (int var = 0; var < 4; var++) {
			if (enable[var]) {
				digitalWrite(LED[var], 0);
			}
		}
	}

}

