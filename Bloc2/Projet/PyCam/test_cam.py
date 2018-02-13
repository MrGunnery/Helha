#!/usr/bin/env python2
# -*- coding: utf-8 -*-
"""
Created on Tue Feb 13 11:14:51 2018

@author: martin
"""

import numpy as np
import cv2 as cv

cap = cv.VideoCapture(0)

while(True):
    ret, frame  =cap.read()
    frame = cv.flip(frame, 1)
    gray = cv.cvtColor(frame, cv.COLOR_BGR2GRAY)

    cv.imshow('frame', frame)
    cv.imshow('grey', gray)

    if cv.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv.destroyAllWindows()
