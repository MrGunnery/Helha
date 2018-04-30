;********************************
;			Exe 5
;		  MIGNOLET
;********************************

nb1 equ 0C
nb2 equ 0E

;*********************************

Start	movlw d'10'
		movwf nb1
Start1	movfw nb1
		movwf nb2

;**********************************

DCPT	decfsz nb2
		goto DCPT
		decfsz nb1
		goto Start1
		goto Start
		end
