#include "Arduino.h"
//The setup function is called once at startup of the sketch
int etat = 0;
int led[4]={13,12,11,10};
void setup(){
// Add your initialization code here
	pinMode(led[0], OUTPUT);
	pinMode(led[1], OUTPUT);
	pinMode(led[2], OUTPUT);
	pinMode(led[3], OUTPUT);
	attachInterrupt(digitalPinToInterrupt(2), inverse, RISING);
}

// The loop function is called in an endless loop
void loop(){
//Add your repeated code here
	if (etat == 0) {
		boucle();
	}else {
		cligno();
	}
}
void inverse(){
	etat++;
}

void boucle(){
	for (int var = 0; var <= 3; var++) {
		digitalWrite(led[var], 0);
		delay(500);
		digitalWrite(led[var], 1);
		delay(500);
	}
}
void cligno(){
	for (int var = 255; var >= 0; --var) {
		analogWrite(led[0],var);
		analogWrite(led[1],var);
		analogWrite(led[2],var);
		analogWrite(led[3],var);
		delay(10);
	}
	for (int var = 0; var <= 255; ++var) {
		analogWrite(led[0],var);
		analogWrite(led[1],var);
		analogWrite(led[2],var);
		analogWrite(led[3],var);
		delay(10);
	}
}
