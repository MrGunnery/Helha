#include "Arduino.h"
#include "Keypad.h"
int led[4]={13,12,11,10}, nb=0;
String choix="";
const byte numRows= 3; //number of rows on the keypad
const byte numCols= 3; //number of columns on the keypad

//keymap defines the key pressed according to the row and columns just as appears on the keypad
char keymap[numRows][numCols]={
		{'1', '2', '3'},
		{'4', '5', '6'},
		{'7', '8', '9'},
};

//Code that shows the the keypad connections to the arduino terminals
byte rowPins[numRows] = {46,48,47}; //Rows 0 to 3
byte colPins[numCols]= {50,52,51}; //Columns 0 to 3

//initializes an instance of the Keypad class
Keypad myKeypad= Keypad(makeKeymap(keymap), rowPins, colPins, numRows, numCols);

void setup(){
	Serial.begin(9600);
	Serial.println("Connection reussie");

	attachInterrupt(digitalPinToInterrupt(2), reset, RISING);
	for(int var = 0; var <4; var++) {
		pinMode(led[var], OUTPUT);
	}
}

//If key is pressed, this key is stored in 'keypressed' variable
//If key is not equal to 'NO_KEY', then this key is printed out
//if count=17, then count is reset back to 0 (this means no key is pressed during the whole keypad scan process
void loop(){
	if(nb<4) {
		char keypressed = myKeypad.getKey();
			if (keypressed != NO_KEY){
				Serial.print(keypressed);
				choix = choix+keypressed;
				nb++;
			}
	}else {
		if (choix=="1111") {
			cligno();
		}else if (choix=="2222") {
			boucle1();
		}else if (choix=="3333") {
			boucle2();
		}else {
			Serial.print("\nErreur!!!!\n");
			Serial.println("Le code n'est pas correcte");
			reset();
		}
	}

}

void cligno(){
	for (int var = 0; var < 4; var++) {
		digitalWrite(led[var],0);
	}
	delay(500);
	for (int var = 0; var < 4; var++) {
		digitalWrite(led[var],1);
	}
	delay(500);
}
void boucle1(){
	for (int var = 0; var <= 3; var++) {
		digitalWrite(led[var], 0);
		delay(500);
		digitalWrite(led[var], 1);
		delay(500);
	}
}
void boucle2(){
	for (int var = 0; var <= 3; var++) {
		digitalWrite(led[var], 0);
		delay(500);
	}
	for (int var = 0; var <= 3; var++) {
		digitalWrite(led[var], 1);
	}
	delay(500);
}
void reset(){
	nb=0;
	choix="";
	Serial.print("Reset\n");
}
