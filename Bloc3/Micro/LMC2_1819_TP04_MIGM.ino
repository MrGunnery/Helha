#define LED_ON digitalWrite(13, 1)
#define LED_OFF digitalWrite(13, 0)
#define BTN digitalRead(2)

#include "Arduino.h"

void setup(){
	pinMode(13, OUTPUT);
	pinMode(2, INPUT);
	attachInterrupt(digitalPinToInterrupt(2), calTemps, FALLING);
	LED_OFF;
}

int temps=200;
int tempsPre;
int tempsCout;
boolean ok = true;

void loop(){
	while(ok){
		LED_ON;
		delay(temps);
		LED_OFF;
		delay(temps);
	}
	tempsPre=millis();
	while(!BTN){
	}
	tempsCout=millis();
	temps=tempsCout-tempsPre;
	ok=true;
}

void calTemps(){
	ok = false;
}
