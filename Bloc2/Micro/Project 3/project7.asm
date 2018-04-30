cpt equ 14
FSR equ 04
INDF equ 00
compare equ 13


;____________Programme________________

restart 		movlw d'5'
				movwf cpt
				movlw H'15'
				movwf FSR
				movlw d'0'

Tab1			addlw d'5'
				movwf INDF
				incf FSR,1	
				decfsz cpt
				goto Tab1
				
				movlw H'15'
				movwf FSR
				
				movlw d'5'
				movwf cpt
Tab2			movfw INDF
				movwf compare
				btfsc compare,0
				incf compare
				movlw d'5'
				addwf FSR,1
				movfw compare
				movwf INDF
				movlw d'4'
				subwf FSR,1
				decfsz cpt
				goto Tab2
				goto restart				
				
				end