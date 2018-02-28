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

# initialisation de sift
sift = cv2.xfeatures2d.SIFT_create()

# initialisation de brute force matching
bf = cv2.BFMatcher()

# initialisation de l'image a trouvé
img1 = cv2.imread('img.jpg')
img1_gris = cv2.cvtColor(img1, cv2.COLOR_BGR2GRAY)
kp1,img1_detect = sift.detect(img1_gris, None)

# pause le temps de l'initialisation de la camera
time.sleep(0.1)

# capture les images de la camera
for frame in camera.capture_continuous(rawCapture, format="bgr", use_video_port=True):
         # grab the raw NumPy array representing the image, then initialize the timestamp
         # and occupied/unoccupied text
         image = frame.array

         # convertir l'image en gris
         gris = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

         # recherche de point sur l'images
         kp2,queryDesc=sift.detectAndCompute(gris,None)

         # Comparaison avec l'image rechercher
         matches = bf.knnMatch(img1_detect, queryDesc, k=2)
         # test matches
         for m,n in matches:
            if m.distance < 0.75*n.distance:
                good.append([m])

         img_matche = cv2.drawMatchesKnn(img1_detect,kp1,queryDesc,kp2,good,flags=2)
         # affiche les differentes frames
         cv2.imshow("Fraeme", image)
         cv2.imshow("color", hsv)
         cv2.imshow("matches", img_matche)
         key = cv2.waitKey(1) & 0xFF

         # Ferme les frame
         rawCapture.truncate(0)

         # permet de finir la boucle
         if key == ord("q"):
                 break
