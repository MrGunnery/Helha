#include "Arduino.h"
#include "Keypad.h"
int led[4]={13,12,11,10}, nb=0;
String choix="";
const byte numRows= 3; //nombre de lignes sur le clavier
const byte numCols= 3; //nombre de colonnes sur le clavier

//keymap définit la touche enfoncée en fonction de la ligne et des colonnes, comme indiqué sur le clavier.
char keymap[numRows][numCols]={
		{'1', '2', '3'},
		{'4', '5', '6'},
		{'7', '8', '9'},
};

//Code indiquant les connexions du clavier aux terminaux Arduino
byte rowPins[numRows] = {46,48,47}; //Rangées 0 à 3
byte colPins[numCols]= {50,52,51}; //Colonnes 0 à 3

//initialise une instance de la classe Keypad
Keypad myKeypad= Keypad(makeKeymap(keymap), rowPins, colPins, numRows, numCols);

void setup(){
	Serial.begin(9600);
	Serial.println("Connection reussie");

	attachInterrupt(digitalPinToInterrupt(2), reset, RISING);
	for(int var = 0; var <4; var++) {
		pinMode(led[var], OUTPUT);
		digitalWrite(led[var], 1);
	}
}

//Si la touche est enfoncée, cette clé est enregistrée dans la variable 'Keypressed'
//Si clé n'est pas égale à 'NO_KEY', cette clé est imprimée
//si compte = 17, le compte est remis à 0 (cela signifie qu'aucune touche n'est enfoncée pendant tout le processus de numérisation du clavier
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
//Clignoletment des leds
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
//Chenillard de led
void boucle1(){
	for (int var = 0; var <= 3; var++) {
		digitalWrite(led[var], 0);
		delay(500);
		digitalWrite(led[var], 1);
		delay(500);
	}
}
//Chenillard avec maitien
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
//reset
void reset(){
	nb=0;
	choix="";
	Serial.print("\n");
}
