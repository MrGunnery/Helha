mx equ 10
lrep equ 12
hrep equ 11
md equ 13
status equ 03


;***************Programmation*******************

Start			movlw d'4'
				movwf mx
				movlw d'0'
				movwf hrep
				movwf lrep
				movlw d'240'
				movwf md

mul				movf mx,1
				btfsc status,2
				goto Start
				movfw md
				addwf lrep,1
				btfsc status,0
				incf hrep
				decfsz mx 
				goto mul
				goto Start

				end