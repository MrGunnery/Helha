#include "Arduino.h"

#define BTN_PROG 52
#define BTN_STYLE 53
#define BTN_LED0 50
#define BTN_LED1 51
#define BTN_LED2 48
#define BTN_LED3 49
#define LED0 32
#define LED1 33
#define LED2 30
#define LED3 31

boolean enable[4]={0,0,0,0};
boolean mode;
boolean first;
int nbClick = 0;

void setup() {
	pinMode(BTN_PROG, INPUT);
	pinMode(BTN_STYLE, INPUT);
	pinMode(BTN_LED0, INPUT);
	pinMode(BTN_LED1, INPUT);
	pinMode(BTN_LED2, INPUT);
	pinMode(BTN_LED3, INPUT);
	pinMode(LED0, OUTPUT);
	pinMode(LED1, OUTPUT);
	pinMode(LED2, OUTPUT);
	pinMode(LED3, OUTPUT);
	Serial.begin(9600);
	digitalWrite(LED0,1);
	digitalWrite(LED1,1);
	digitalWrite(LED2,1);
	digitalWrite(LED3,1);
}

void loop() {
	nbClick = 0;
	first = 0;
	while(!digitalRead(BTN_PROG)){
		if (!first) {
			Serial.print("PROGRAMATION \r\n");
			enable[0]=0;
			enable[1]=0;
			enable[2]=0;
			enable[3]=0;
			digitalWrite(LED0,1);
			digitalWrite(LED1,1);
			digitalWrite(LED2,1);
			digitalWrite(LED3,1);
			first=1;
		}
		if (!digitalRead(BTN_STYLE)) {
			nbClick++;
			Serial.print(nbClick);
			Serial.print("\r\n");
			while(!digitalRead(BTN_STYLE)){

			}
		}
		if (nbClick==2) {
			mode=0;
		}else if (nbClick==3) {
			mode=1;
		}
		if (!digitalRead(BTN_LED0)) {
			enable[0]=1;
			Serial.print("LED01\r\n");
		}
		if (!digitalRead(BTN_LED1)) {
			enable[1]=1;
			Serial.print("LED02\r\n");
		}
		if (!digitalRead(BTN_LED2)) {
			enable[2]=1;
		}
		if (!digitalRead(BTN_LED3)) {
			enable[3]=1;
		}
	}
	if (mode) {
		if (enable[0]) {
			digitalWrite(LED0,1);
		}
		if (enable[1]) {
			digitalWrite(LED1,1);
		}
		if (enable[2]) {
			digitalWrite(LED2,1);
		}
		if (enable[3]) {
			digitalWrite(LED3,1);
		}
		delay(500);
		if (enable[0]) {
			digitalWrite(LED0,0);
		}
		if (enable[1]) {
			digitalWrite(LED1,0);
		}
		if (enable[2]) {
			digitalWrite(LED2,0);
		}
		if (enable[3]) {
			digitalWrite(LED3,0);
		}
		delay(500);

	}else {

		if (enable[0]) {
			digitalWrite(LED0,0);
		}
		if (enable[1]) {
			digitalWrite(LED1,0);
		}
		if (enable[2]) {
			digitalWrite(LED2,0);
		}
		if (enable[3]) {
			digitalWrite(LED3,0);
		}

	}

}

