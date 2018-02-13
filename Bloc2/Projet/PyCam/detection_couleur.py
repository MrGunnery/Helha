#!/usr/bin/env python2
# -*- coding: utf-8 -*-
"""
Created on Tue Feb 13 11:33:56 2018

@author: martin
"""

import cv2 as cv
import numpy as np

# lecture de l'image en BGR
img = cv.imread('img2.jpg', 1)

# redimensioner l'image
img = cv.resize(img, (0,0), fx=0.5, fy=0.5)

# convertion de l'image en HSB
hsv = cv.cvtColor(img, cv.COLOR_BGR2HSV)

# creation de tableau pour les differentes ranges

lower_range = np.array([0, 100, 100], dtype = np.uint8)
upper_range = np.array([3, 255, 255], dtype = np.uint8)

# creation d'un masque pour l'inmage
mask = cv.inRange(hsv, lower_range, upper_range)

# affiche le masque et l'image
cv.imshow('mask', mask)
cv.imshow('image', img)

# si on presse sur ESC tous s'arrete
while(True):
    if(cv.waitKey(0) == 27):
        break

cv.destroyAllWindows()
