md equ 10
mx equ 12
cpt equ 14
Hrep equ 15
Lrep equ 16
status equ 03

;**********Programation*************

Start		movlw d'25'
			movwf md
			movlw d'12'
			movwf mx
			movlw d'8'
			movwf cpt
			movlw d'0'
			movwf Hrep
			movlw d'0'
			movwf Lrep

multi		rrf mx,1
			btfsc status,0
			goto add
suite		rrf Hrep,1
			rrf Lrep,1
			decfsz cpt
			goto multi
			goto Start

add 		movfw md
			addwf Hrep,1
			goto suite
end
			
			
			