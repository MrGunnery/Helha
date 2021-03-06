# import des pakets utiles
from picamera.array import PiRGBArray
from picamera import PiCamera
import time
import cv2

# define the lower and upper boundaries of the "yellow object"
# (or "ball") in the HSV color space, then initialize the
# list of tracked points
colorLower = (17, 100, 100)
colorUpper = (20, 255, 255)

# initialisation de la camera
camera = PiCamera()
camera.resolution = (640, 480)
camera.framerate = 32
rawCapture = PiRGBArray(camera, size=(640, 480))

# pause le temps de l'initialisation de la camera
time.sleep(0.1)

# capture les images de la camera
for frame in camera.capture_continuous(rawCapture, format="bgr", use_video_port=True):
         # grab the raw NumPy array representing the image, then initialize the timestamp
         # and occupied/unoccupied text
         image = frame.array
         # convertir l'image en gris
         hsv = cv2.cvtColor(image, cv2.COLOR_BGR2HSV)

         mask = cv2.inRange(hsv, colorLower, colorUpper)
         mask = cv2.erode(mask, None, iterations=2)
         mask = cv2.dilate(mask, None, iterations=2)

         # find contours in the mask and initialize the current
         # (x, y) center of the ball
         cnts = cv2.findContours(mask.copy(), cv2.RETR_EXTERNAL,
                                 cv2.CHAIN_APPROX_SIMPLE)[-2]
         center = None
         # only proceed if at least one contour was found
         if len(cnts) > 0:
             c = max(cnts, key=cv2.contourArea)
             ((x, y), radius) = cv2.minEnclosingCircle(c)
             M=cv2.moments(c)
             center= (int(M["m10"] / M["m00"]), int(M["m01"] / M["m00"]))
             if radius > 10:
                 cv2.circle(image, (int(x), int(y)), int(radius),
                            (0, 255, 255), 2)
                 cv2.circle(image, center, 5, (0, 0, 255), -1)

         # affiche les differentes frames
         cv2.imshow("Fraeme", image)
         cv2.imshow("hsv", hsv)
         key = cv2.waitKey(1) & 0xFF

         # Ferme les frame
         rawCapture.truncate(0)

         # permet de finir la boucle
         if key == ord("q"):
                 break
