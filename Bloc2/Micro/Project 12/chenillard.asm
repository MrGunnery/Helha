;====================================================================
; "Circuit de test : "jeux de lumiere 1"           
; (C) Martin Mignolet, avril 2018 
; Helha Charleroi
; version 1.00
; microcontrôleur PIC 16F84A
; développé avec Microchip MPLAB IDE
;====================================================================
;__config _CP_OFF & _WDT_OFF & _PWRTE_ON & _RC_OSC
	;bits de configuration :
	;code protect OFF
	;watchdog timer OFF
	;power up timer ON
	;oscillateur RC
;====================================================================
; VARIABLES
;====================================================================
STATUS 	equ 03
portb	equ 06
cpt1	equ 0C
cpt2	equ	0D
;====================================================================
; INITIALISATION 
;====================================================================
		movlw 00010000
		tris portb
		clrf portb
;====================================================================
; CODE
;====================================================================
debut	
		call tempo
		rrf portb,f
		btfss STATUS,0
		goto debut
		rrf portb,f
		goto debut
		
tempo	
		movlw 	d'255'
		movwf 	cpt2
t1	
		movwf	cpt1
t2
		decfsz 	cpt1
		goto	t2
		decfsz 	cpt2
		goto	t1
		return
;====================================================================
END
