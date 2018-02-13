#!/usr/bin/env python2
# -*- coding: utf-8 -*-
"""
Created on Tue Feb 13 11:25:48 2018

@author: martin
"""

import sys
import numpy as np
import cv2 as cv

blue = sys.argv[1]
green = sys.argv[2]
red = sys.argv[3]

color = np.uint8([[[blue, green, red]]])
hsv_color = cv.cvtColor(color, cv.COLOR_BGR2HSV)

hue = hsv_color[0][0][0]

print ("Lower bound is")
print ("[" + str(hue-10) + ", 100, 100]\n")

print("Upper bound is")
print ("[" + str(hue+10) + ", 255, 255]\n")
