NB1		equ	0C
NB2	equ 0D
FSR		equ	04
INDF	equ	00

;------------- Programme -------------

restart		movlw d'10'
			movwf NB1			; on met 10 dans NB1
			movlw H'11'		
			movwf FSR			; on dit l'adresse de debut de FSR
			movlw d'5'
			movwf NB2
			movlw d'0'

debut 		addlw d'5'		
			movwf INDF			; on ajoute le w dans le fsr
			incf FSR,1			; on augmente l'adresse de FSR de 1
			decfsz NB1			; on decrement nb1
			goto debut			; retour au debut
			movlw H'11'			; retour au debut du FSR
			movwf FSR			
affiche		movf INDF,W			; lecture du FSR
			movwf NB1
			incf FSR,1			; augmentation de l'adresse du FSR 2x
			incf FSR,1
			decfsz NB2
			goto affiche
			goto restart
			
			end