#include <Arduino.h>
#include <Wire.h>
#include <Adafruit_PWMServoDriver.h>
#include <SoftwareSerial.h>

// called this way, it uses the default address 0x40
Adafruit_PWMServoDriver pwm = Adafruit_PWMServoDriver();

#define MIN_PULSE_WIDTH       650
#define MAX_PULSE_WIDTH       2350
#define DEFAULT_PULSE_WIDTH   1500
#define FREQUENCY             50
// our servo # counter
uint8_t servonum = 0;

SoftwareSerial Bluetooth(3, 4); // Arduino(RX, TX) - HC-05 Bluetooth (TX, RX)
int servo1Pos, servo2Pos, servo3Pos, servo4Pos, servo5Pos, servo6Pos;
int servoPos[4];// current position
int servo1PPos, servo2PPos, servo3PPos, servo4PPos, servo5PPos, servo6PPos;
int servoPPos[4];// previous position
int servo01SP[50], servo02SP[50], servo03SP[50], servo04SP[50], servo05SP[50], servo06SP[50];
int ServoSP[4][50];// for storing positions/steps
int speedDelay = 20;
int index = 0;
String dataIn = "";

void setup() {
  Serial.begin(9600);
  //Serial.println("16 channel Servo test!");
  Serial.println("RESET");
  pinMode(7, INPUT);
  pwm.begin();
  pwm.setPWMFreq(FREQUENCY);  // Analog servos run at ~60 Hz updates
  Bluetooth.begin(9600); // Default baud rate of the Bluetooth module
  Bluetooth.setTimeout(1);
  delay(20);
  servoPPos[0] = 90;
  //pwm.setPWM(0, 0, pulseWidth(servoPPos[0],0));
  servoPPos[1] = 150;
  //pwm.setPWM(1, 0, pulseWidth(servoPPos[1],1));
  servoPPos[2] = 120;
  //pwm.setPWM(2, 0, pulseWidth(servoPPos[2],2));
  servoPPos[3] = 25;
  //pwm.setPWM(3, 0, pulseWidth(servoPPos[3],3));
}

void loop() {
	if (digitalRead(7)) {
		Bluetooth.print("ON");

	}else {
		Bluetooth.print("OFF");
	}
	delay(20);
	if (Bluetooth.available()>0) {
		dataIn= Bluetooth.readString();
		Serial.println(dataIn);
	}
	if (dataIn.startsWith("s")) {
		String dataSer = dataIn.substring(1,2);
		int numSer = dataSer.toInt();
		actionServo(numSer, dataIn);
	}
	// If button "SAVE" is pressed
	if (dataIn.startsWith("SAVE")) {
		for (int var = 0; var < 4; var++) {
			ServoSP[var][index]=servoPPos[var];
		}
		index++;
	}
	// If button "RUN" is pressed
	if (dataIn.startsWith("RUN")) {
		runServo();  // Automatic mode - run the saved steps
	}
	// If button "RESET" is pressed
	if ( dataIn == "RESET") {
		memset(ServoSP, 0, sizeof(ServoSP));
	}
	dataIn="";
}

void runServo(){
	 while (dataIn != "RESET") {   // Run the steps over and over again until "RESET" button is pressed
	    for (int i = 0; i <= index - 2; i++) {  // Run through all steps(index)
	      if (Bluetooth.available() > 0) {      // Check for incomding data
	        dataIn = Bluetooth.readString();
	        if ( dataIn == "PAUSE") {           // If button "PAUSE" is pressed
	          while (dataIn != "RUN") {         // Wait until "RUN" is pressed again
	            if (Bluetooth.available() > 0) {
	              dataIn = Bluetooth.readString();
	              if ( dataIn == "RESET") {
	                break;
	              }
	            }
	          }
	        }
	        // If speed slider is changed
	        if (dataIn.startsWith("ss")) {
	          String dataInS = dataIn.substring(2, dataIn.length());
	          speedDelay = dataInS.toInt(); // Change servo speed (delay time)
	        }
	        for (int var = 0; var < 4; var++) {
				autoServo(var, i);
			}
	      }
	    }
	 }
}

void autoServo(int i1, int i2){
	if (ServoSP[i1][i2] > ServoSP[i1][i2+1]) {
		for (int var = ServoSP[i1][i2]; var >= ServoSP[i1][i2+1]; var--) {
			pwm.setPWM(i1, 0, pulseWidth(var,i1));
			delay(speedDelay);
		}
	}
	if (ServoSP[i1][i2] < ServoSP[i1][i2+1]) {
		for (int var = ServoSP[i1][i2]; var <= ServoSP[i1][i2+1]; var++) {
			pwm.setPWM(i1, 0, pulseWidth(var,i1));
			delay(speedDelay);
		}
	}
}

void actionServo(int i, String dataIn){
	 String dataInS = dataIn.substring(2, dataIn.length()); // Extract only the number. E.g. from "s1120" to "120"
	 servoPos[i] = dataInS.toInt();  // Convert the string into integer
	 // We use for loops so we can control the speed of the servo
	 // If previous position is bigger then current position
	 if (servoPPos[i] > servoPos[i]) {
		 for ( int j = servoPPos[i]; j >= servoPos[i]; j--) {   // Run servo down
	      	pwm.setPWM(i, 0, pulseWidth(j,i));
	        delay(20);    // defines the speed at which the servo rotates
	     }
	 }
	 // If previous position is smaller then current position
	 if (servoPPos[i] < servoPos[i]) {
		 for ( int j = servoPPos[i]; j <= servoPos[i]; j++) {   // Run servo up
	       	pwm.setPWM(i, 0, pulseWidth(j,i));
	        delay(20);
	     }
	 }
	servoPPos[i] = servoPos[i];
}

int pulseWidth(int angle, int i)
{
  int pulse_wide, analog_value;
  pulse_wide   = map(angle, 0, 180, MIN_PULSE_WIDTH, MAX_PULSE_WIDTH);
  analog_value = int(float(pulse_wide) / 1000000 * FREQUENCY * 4096);
  Serial.print("Servo n°");
  Serial.print(i);
  Serial.print(" position ");
  Serial.println(analog_value);
  return analog_value;
}
