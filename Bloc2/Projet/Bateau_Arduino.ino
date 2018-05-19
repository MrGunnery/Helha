#define captFin 7
#define captDebut 9
#define pinAimant 11
#define captHauteur 12

#include <Wire.h>
#include <Adafruit_MotorShield.h>
#include <NewPing.h>

int cptPas;
bool onOff = false;
// Creation de l'objet motorSheild
Adafruit_MotorShield AFMS = Adafruit_MotorShield();

// Connexion des moteur pas a pas.
Adafruit_StepperMotor *moteurCoureoi = AFMS.getStepper(200, 2);	// Moteur courroie
Adafruit_StepperMotor *moteurTreil = AFMS.getStepper(200, 1);	// Moteur treil

// Connexion du capteur de distance
NewPing sonarFin(3,5,200);

void setup() {
	AFMS.begin();	// debut de comunication avec le sheild
	moteurCoureoi->setSpeed(1200);  // 1200 rpm
	moteurTreil->setSpeed(1200);
	pinMode(captDebut, INPUT);
	pinMode(captFin, INPUT);
	pinMode(captHauteur, INPUT);
	pinMode(pinAimant, OUTPUT);
	monter();			// initialisation 
	avance();

}

void loop() {
	if (distance(sonarFin)<25) {		// si il y a detection d'un bateau

		delay(2500);		
		aimant();
		moteurTreil->step(700, BACKWARD, DOUBLE);  // decendre aimant de 700 pas
		delay(1000);
		monter();
		delay(500);
		recule();
		delay(200);
		moteurTreil->step(500, BACKWARD, DOUBLE);  // decendre aimant de 700 pas
		cptPas +=500;
		aimant();
		delay(500);
		monter();
		delay(500);
		aimant();
		moteurTreil->step(cptPas, BACKWARD, DOUBLE);
		delay(500);
		monter();
		delay(500);
		avance();
		delay(2000);
		decendre(20, sonarFin);
		moteurTreil->step(400, BACKWARD, DOUBLE);
		delay(500);
		aimant();
		delay(500);
		monter();
	}

	do {
	} while (distance(sonarFin)<25);		// attendre que le bateau soit parti

}

void avance(){
	do {
		moteurCoureoi->step(1, FORWARD, DOUBLE);
	} while (!digitalRead(captFin));		// avance d'un pas jusqu'au capteur fin de course 
}
void recule(){
	do {
		moteurCoureoi->step(1, BACKWARD, DOUBLE);
	} while (!digitalRead(captDebut));		// recule d'un pas jusqu'au capteur fin de course 
}

void decendre(int cm, NewPing sonar){
	cptPas = 0;
	do {
		moteurTreil->step(50, BACKWARD, DOUBLE);
		cptPas+=50;
	} while (distance(sonar)>cm);			// descendre jusqu'à ce que le sonar détecte le bateau
}
void monter(){
	cptPas= 0;
	do {
		moteurTreil->step(1, FORWARD, DOUBLE);
		cptPas+=1;
	} while (digitalRead(captHauteur));		// monte d'un pas jusqu'au capteur fin de course 
}

int distance(NewPing sonar){
	int distance = 0;
		do {
			delay(70);
			distance = sonar.ping_cm();
		} while (distance==0);
		return distance;					// renvoie la distance mesuré par le sonar
}

void aimant(){
	if (!onOff) {
		digitalWrite(pinAimant, 1);			// active l'aimant si il est desactivé
		onOff = true;
	} else if (onOff) {
		digitalWrite(pinAimant, 0);			// desactive l'aimant si il est activé
		onOff = false;
	}
}
