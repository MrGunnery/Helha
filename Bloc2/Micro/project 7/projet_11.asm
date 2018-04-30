dd equ 14
Reste equ 15
dv equ 10
cpt equ 11
status equ 03
q equ 18

;____________Declaration__________________e

Start			movlw d'219'
				movwf dd
				movlw d'8'
				movwf cpt
				movlw d'5'
				movwf dv
				movlw d'0'
				movwf Reste
				movlw d'0'
				movwf q

;____________Programme___________________


Programme		movf dv,1
				btfsc status,2	; verrification div sup 0
				goto Start
 
Decalage		rlf dd,1
				rlf Reste,1
				movf dv,0
				subwf Reste,0
				btfss status,0	; verrif si dv et inferieur a resete
				goto suite
				
				movfw dv		;soustraction du reste
				subwf Reste,1
				goto suite

suite			rlf q,1
				decfsz cpt,1	; decremente le compteur
				goto Decalage
				goto Start				
				
end