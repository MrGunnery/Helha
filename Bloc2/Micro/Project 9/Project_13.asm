nbre equ 10
dizaine equ 11
unite equ 12
affichage equ 13
tampon equ 14
status equ 03

;____________Declaration________________

			movlw d'60'
			movwf nbre
			movwf tampon
Start		movlw d'0'
			movwf dizaine
			movwf unite

;____________Programation_______________

			movfw tampon
			movwf nbre

Programme	movlw d'10'				;soustraction de 10 pour compter les 
			subwf nbre,w			;dizaine
			btfss status,0
			goto Suite
			movwf nbre
			incf dizaine,f
			goto Programme

Suite		movfw nbre				;transfert de nbre dans unité
			movwf unite
			swapf dizaine,w			;rotation de 4 bits de dizaine
			movwf affichage
			movfw unite
			addwf affichage,f
			decf tampon
			movlw d'255'			;verrification de la condition
			subwf tampon,w			;inferieur a zéro
			btfss status,0
			goto Start
			goto Fin

Fin			goto Fin
			end
			