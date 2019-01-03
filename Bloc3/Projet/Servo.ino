#include <Arduino.h>
#include <Wire.h>
#include <Adafruit_PWMServoDriver.h>
#include <SoftwareSerial.h>

#define MIN_PULSE_WIDTH       650
#define MAX_PULSE_WIDTH       2350
#define DEFAULT_PULSE_WIDTH   1500
#define FREQUENCY             60

// appeler de cette facon, il utiliser l'addresse par default 0x40
Adafruit_PWMServoDriver pwm = Adafruit_PWMServoDriver();

SoftwareSerial Bluetooth(3, 4); // Arduino(RX, TX) - HC-05 Bluetooth (TX, RX)
int servoPos[4]; // position courrante
int servoPPos[4]; // position precedente
int ServoSP[4][50]; // pour enregistrement de position positions/steps
int speedDelay = 20;
int index = 0;
String dataIn = ""; // initialisation de datain

void setup() {
	Serial.begin(9600);
	//Serial.println("16 channel Servo test!");
	Serial.println("RESET");
	pinMode(7, INPUT);
	pwm.begin();
	pwm.setPWMFreq(FREQUENCY);  // set de la frequence du controleur
	Bluetooth.begin(9600); // parametrage de la comunication bleuthoot
	Bluetooth.setTimeout(1);
	delay(20);

	// mise en position initial des servos
	servoPPos[0] = 90;
	pwm.setPWM(0, 0, pulseWidth(servoPPos[0], 0));
	servoPPos[1] = 150;
	pwm.setPWM(1, 0, pulseWidth(servoPPos[1], 1));
	servoPPos[2] = 120;
	pwm.setPWM(2, 0, pulseWidth(servoPPos[2], 2));
	servoPPos[3] = 25;
	pwm.setPWM(3, 0, pulseWidth(servoPPos[3], 3));
}

void loop() {
	// si le capteur detecte quelque chose
	if (digitalRead(7)) {
		Bluetooth.print("ON");
	} else {
		Bluetooth.print("OFF");
	}
	delay(20);
	// si il y a des donnée a lire
	if (Bluetooth.available() > 0) {
		dataIn = Bluetooth.readString();
		Serial.println(dataIn);
	}
	// verification de la validiter des donnée et interpretarion
	if (dataIn.startsWith("s")) {
		String dataSer = dataIn.substring(1, 2);
		int numSer = dataSer.toInt();
		actionServo(numSer, dataIn);
	}
	// Si le bouton save est preser
	if (dataIn.startsWith("SAVE")) {
		for (int var = 0; var < 4; var++) {
			ServoSP[var][index] = servoPPos[var];
			Serial.println(servoPPos[var]);
		}
		index++;
	}
	// Si bouton run est pressé
	if (dataIn.startsWith("RUN")) {
		runServo();  // Mode auto
	}
	// Si bouton reset est pressé
	if (dataIn == "RESET") {
		memset(ServoSP, 0, sizeof(ServoSP));
	}
	dataIn = "";
}

void runServo() {
	while (dataIn != "RESET") {   // boucle jusqu'a reset
		for (int i = 0; i <= index - 1; i++) { // pour toutes les potitions sauver
			if (Bluetooth.available() > 0) {      // Datain disponibble ?
				dataIn = Bluetooth.readString();
				if (dataIn == "PAUSE") {          // Si bouton pause est presser
					while (dataIn != "RUN") {         // on attent Run
						if (Bluetooth.available() > 0) {
							dataIn = Bluetooth.readString();
							if (dataIn == "RESET") {
								break;
							}
						}
					}
				}
				// Si la vitesse est changer
				if (dataIn.startsWith("ss")) {
					String dataInS = dataIn.substring(2, dataIn.length());
					speedDelay = dataInS.toInt(); // changer la vitesse des servos (delay time)
				}
			}
			// actione les servos.
			for (int var = 0; var < 4; var++) {
				autoServo(var, i);
			}
		}
	}
}

// run auto des servo
void autoServo(int i1, int i2) {
	if (ServoSP[i1][i2] > ServoSP[i1][i2 + 1]) {
		for (int var = ServoSP[i1][i2]; var >= ServoSP[i1][i2 + 1]; var--) {
			pwm.setPWM(i1, 0, pulseWidth(var, i1));
			delay(speedDelay);
		}
	}
	if (ServoSP[i1][i2] < ServoSP[i1][i2 + 1]) {
		for (int var = ServoSP[i1][i2]; var <= ServoSP[i1][i2 + 1]; var++) {
			pwm.setPWM(i1, 0, pulseWidth(var, i1));
			delay(speedDelay);
		}
	}
}

// Actione les servos
void actionServo(int i, String dataIn) {
	String dataInS = dataIn.substring(2, dataIn.length()); // recuprer seulment les nombre.
	servoPos[i] = dataInS.toInt();  // conversion en Integer

	if (servoPPos[i] > servoPos[i]) {
		for (int j = servoPPos[i]; j >= servoPos[i]; j--) {
			pwm.setPWM(i, 0, pulseWidth(j, i));
			delay(20);    // Limite la vitesse
		}
	}

	if (servoPPos[i] < servoPos[i]) {
		for (int j = servoPPos[i]; j <= servoPos[i]; j++) {
			pwm.setPWM(i, 0, pulseWidth(j, i));
			delay(20);
		}
	}
	servoPPos[i] = servoPos[i];
	servoPPos[i + 1] = servoPos[i];
}

// converti un angle en largeur d'impultion
int pulseWidth(int angle, int i) {
	int pulse_wide, analog_value;
	pulse_wide = map(angle, 0, 180, MIN_PULSE_WIDTH, MAX_PULSE_WIDTH);
	analog_value = int(float(pulse_wide) / 1000000 * FREQUENCY * 4096);
	Serial.print("Servo n°");
	Serial.print(i);
	Serial.print(" position ");
	Serial.println(analog_value);
	return analog_value;
}

