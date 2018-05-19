/**
 * 
 */
package test_decode_piCam;


import java.io.IOException;

import com.hopding.jrpicam.RPiCamera;
import com.hopding.jrpicam.exceptions.FailedToRunRaspistillException;

/**
 * @author pi
 *
 */
public class CamPy {

	public CamPy() {
		// TODO Auto-generated constructor stub
	}
	
	public static void takeAPictures() 
			throws FailedToRunRaspistillException, IOException, InterruptedException {
		try {
			RPiCamera cam = new RPiCamera("/home/pi");
			cam.setWidth(700).setHeight(550);
			cam.setTimeout(1);
			cam.takeStill("hello.png");
		} catch (Exception e) {
			// TODO: handle exception
			System.out.println("Erreur!!");
		}
	}
}
