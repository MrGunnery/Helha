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

// Arduino(RX, TX) - HC-05 Bluetooth (TX, RX)
SoftwareSerial Bluetooth(3, 4);

// position courrante
int servoPos[4];
// position precedente
int servoPPos[4];
// pour enregistrement de position positions/steps
int ServoSP[4][50];
int speedDelay = 20;
int index = 0;
// initialisation de datain
String dataIn = "";

void setup() {
	Serial.begin(9600);
	//Serial.println("16 channel Servo test!");
	Serial.println("RESET");
	pinMode(7, INPUT);
	pwm.begin();
	// set de la frequence du controleur
	pwm.setPWMFreq(FREQUENCY);
	// parametrage de la comunication bleuthoot
	Bluetooth.begin(9600);
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
		index=0;
	}
	dataIn = "";
}

void runServo() {
	// boucle jusqu'a reset
	while (dataIn != "RESET") {
		// si le capteur detecte quelque chose
		if (digitalRead(7)) {
			Bluetooth.print("ON");
		} else {
			Bluetooth.print("OFF");
		}
		// pour toutes les potitions sauver
		for (int i = 0; i <= index - 1; i++) {
			// Datain disponibble ?
			if (Bluetooth.available() > 0) {
				dataIn = Bluetooth.readString();
				// Si bouton pause est presser
				if (dataIn == "PAUSE") {
					// on attent Run
					while (dataIn != "RUN") {
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
					// changer la vitesse des servos (delay time)
					speedDelay = dataInS.toInt();
				}
			}
			// actione les servos.
			for (int var = 0; var < 4; var++) {
				String ser = "sx";
				ser+=ServoSP[var][i];
				Serial.println(ser);
				actionServo(var, ser);
			}
		}
	}
}

// Actione les servos
void actionServo(int i, String dataIn) {
	Serial.println(dataIn);
	// recuprer seulment les nombre.
	String dataInS = dataIn.substring(2, dataIn.length());
	// conversion en Integer
	servoPos[i] = dataInS.toInt();

	if (servoPPos[i] > servoPos[i]) {
		for (int j = servoPPos[i]; j >= servoPos[i]; j--) {
			pwm.setPWM(i, 0, pulseWidth(j, i));
			// Limite la vitesse
			delay(20);
		}
	}

	if (servoPPos[i] < servoPos[i]) {
		for (int j = servoPPos[i]; j <= servoPos[i]; j++) {
			pwm.setPWM(i, 0, pulseWidth(j, i));
			delay(20);
		}
	}
	servoPPos[i] = servoPos[i];
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
