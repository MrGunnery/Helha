# import des pakets utiles
from picamera.array import PiRGBArray
from picamera import PiCamera
import time
import cv2

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
         # affiche les differentes frames
         cv2.imshow("Fraeme", image)
         cv2.imshow("color", hsv)
         key = cv2.waitKey(1) & 0xFF

         # Ferme les frame
         rawCapture.truncate(0)

         # permet de finir la boucle
         if key == ord("q"):
                 break
