/**
 *
 */
package testDecodePiCam;

import java.io.IOException;

import com.hopding.jrpicam.RPiCamera;
import com.hopding.jrpicam.exceptions.FailedToRunRaspistillException;

/**
 * @author Martin
 *
 */
public class CamPi {

	public CamPi() {
		// TODO Auto-generated constructor stub
	}

	public static void takeAPictures()
			throws FailedToRunRaspistillException, IOException, InterruptedException{
		try {
			RPiCamera cam = new RPiCamera("/home/pi");
			cam.setWidth(1080).setHeight(720);
			cam.setTimeout(1);
			cam.takeStill("Hello.png");
		} catch (Exception e) {
			// TODO: handle exception
			System.err.println("Erreur !!!");
		}
	}
}
