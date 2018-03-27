/**
 *
 */
package testDecodePiCam;

import java.util.HashMap;
import java.util.Map;

import com.google.zxing.EncodeHintType;
import com.google.zxing.qrcode.decoder.ErrorCorrectionLevel;

/**
 * @author pi
 *
 */
public final class Main {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO Auto-generated method stub

		String filePath = "/home/pi/Hello.png";
		String charset = "UTF-8";
		Map<EncodeHintType, ErrorCorrectionLevel> hintMap = new HashMap<EncodeHintType, ErrorCorrectionLevel>();
		hintMap.put(EncodeHintType.ERROR_CORRECTION, ErrorCorrectionLevel.L);
		do {
			try {
				CamPi.takeAPictures();
				System.out.println("Data read from QR Code: "+ QrDecode.readQrCode(filePath, charset, hintMap));
			} catch (Exception e) {
				// TODO: handle exception
				System.err.println("No Qr Code !!");
			}
		} while (true);

	}

}
