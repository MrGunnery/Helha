nbre equ 10
dizaine equ 11
centaine equ 12
unite equ 13
status equ 03

;________________Declaration_____________

Start			movlw d'219'
				movwf nbre
				movlw d'0'
				movwf dizaine
				movwf centaine
				movwf unite

;_______________Programation______________

Programme		movlw d'100'		;nbr inf a 100?
				subwf nbre,w
				btfsc status,0
				goto subCent
				goto diz

subCent			movwf nbre			
				incf centaine,1		;centaine + 1
				goto Programme		
				
				
diz				movlw d'10'			;dizaine inf a 10?
				subwf nbre,w
				btfsc status,0
				goto subDiz
				goto unit

subDiz			movwf nbre			;dizaine + 1
				incf dizaine,1
				goto diz

unit			movfw nbre			
				movwf unite
				goto Start
end