
#include <TimerOne.h>
#include <MultiFuncShield.h>
#include <MPU6050.h>
#include <II2C.h>
#include <I2C.h>
unsigned long time;
long previoustime=0;
void setup()
{
  
  Timer1.initialize();
	MFS.initialize(&Timer1); // initialize multi-function shield library
	int sensorValue = analogRead(A0);
  int affichage = map(sensorValue, 0, 1023, 0, 100);
  MFS.write(affichage);	
		
	}

void loop()
{
  time = millis();

  if(time - previoustime >=180000)
  {
	int sensorValue = analogRead(A0);
  int affichage = map(sensorValue, 0, 1023, 0, 100);
	MFS.write(affichage);
  previoustime=time;
  }

}
