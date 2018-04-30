DD equ 10
DV equ 11
RESTE equ 12
QUOTIENT equ 13
status equ 03

;*************Programation**************

Start		movlw d'22'
			movwf DD
			movlw d'5'
			movwf DV
			movlw d'0'
			movwf QUOTIENT

zero		movf DV,f				; 
			btfsc status,2
			goto Start
			goto division

division	movf DV,w
			subwf DD,w
			btfsc status,0
			goto suivant
			goto fin

suivant 	movfw DV
			subwf DD,1
			incf QUOTIENT
			goto division

fin			movfw DD
			movwf RESTE

end



