Lrep equ 16
Hrep equ 15
R2 equ 10
R1 equ 11
R0 equ 12
cpt equ 13
status equ 03
;___________Declaration________________

Start			movlw d'0'
				movwf R2
				movwf R1
				movwf R0
				movlw d'16'
				movwf cpt
				movlw b'01101001'
				movwf Lrep
				movlw b'1011010'
				movwf Hrep

;___________Programation_______________

deca			rlf Lrep,1   	;Rotaion des 5 registres
				rlf Hrep,1
				rlf R0,1
				rlf R1,1
				rlf R2,1
				
				decfsz cpt,1	;Cpt =0 ?
				call ajust		;appele de ajust
				goto fin	
						
fin				goto fin

ajust			movlw b'00001111'		;R0 		
				andwf R0,0				;recuperation du lsb
				movwf lsb
				sublw d'4'
				btfsc status,0
				goto suite1
				movlw d'3'
				addwf R0,1
				btfsc status,0
				incf R1	
suite1			movlw b'11110000'		;R0		
				andwf R0,0				;recupertaion du msb	
				sublw d'64'
				btfsc status,0
				goto suite2
				movlw d'48'
				addwf R0,1
				btfsc status,0
				incf R1
suite2			movlw b'00001111'		;R1 
				andwf R1,0				;recuperation du lsb
				movwf lsb
				sublw d'4'
				btfsc status,0
				goto suite3
				movlw d'3'
				addwf R1,1
				btfsc status,0
				incf R2
suite3			movlw b'11110000'		;R1
				andwf R1,0				;recuperation du msb
				movwf msb
				sublw d'64'
				btfsc status,0
				goto suite4
				movlw d'48'
				addwf R1,1
				btfsc status,0	
				incf R2	
suite4			goto deca
				return
end
