;====================================================================
; "Circuit de test : "Jeux de lumiere 2"           
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
STATUS 		equ 03
portb		equ 06
led 		equ 10
cptClign 	equ 11
cpt			equ 12
cptled		equ 13
cpt1		equ 0C
cpt2		equ	0D
;====================================================================
; INITIALISATION 
;====================================================================
			movlw 00010000
			tris portb
			clrf portb	
restart	
			movlw d'0'
			movwf cptClign
			movlw d'1'
			movwf led
			movlw d'8'
			movwf cptled
			bcf STATUS,0
;====================================================================
; CODE
;====================================================================
debut
			call cligno
			rlf led,f
			decfsz cptled
			goto debut
			movlw d'0'			;Remise a zero des compteurs
			movwf cptClign
			movlw d'8'
			movwf cptled
			bcf STATUS,0
			movlw d'128'
			movwf led
			call tempo
retour	
			call cligno
			rrf led,f
			decfsz cptled
			goto retour
			goto restart

cligno							;Fonction de clignotement
			incf cptClign
			movfw cptClign
			movwf cpt
cli		
			movfw led
			movwf portb
			call tempo
			clrf portb
			call tempo
			decfsz cpt
			goto cli
			return

tempo							;Fonction de temporisation
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