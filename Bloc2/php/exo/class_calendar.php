<?php
/*
Fichier : class_calendar.php
Auteur : kik's
Date de création : 25/02/09
Dernière modification : 01/06/11

-> Classe des calendriers
*/
abstract class Abstractcalendar
{
	/**
	* Mois du calendrier
	*
	* @var int
	*/
	protected $month = 0;

	/**
	* Année du calendrier
	*
	* @var int
	*/
	protected $year = 0;

	/**
	* Tableau des mois
	*
	* @var array(string)
	*/
	protected $ar_months = array(1=>'Janvier', 'F&eacute;vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao&ucirc;t', 'Septembre', 'Octobre', 'Novembre', 'D&eacute;cembre');

	/**
	* Tableau des jours
	*
	* @var array(string)
	*/
	protected $ar_days = array(1=>'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di');

	/**
	* Tableau des jours fériés
	*
	* @var array(string)
	*/
	protected $ar_holidays = array('01/01', '01/05', '08/05', '14/07', '15/08', '11/11', '25/12');

	/**
	* Tableau des jours de vacances
	*
	* @var array(string)
	*/
	protected $ar_vacations = array();
	
	/**
	* Tableau des jours fériés
	*
	* @var array(string)
	*/
	protected $ar_edays = array();

	/**
	* Chaine de sortie du calendrier contruite avec les méthodes build_
	*
	* @var array(string)
	*/
	protected $cout = array();

	/**
	* @desc Constructeur
	*
	* @return void
	*/
	public function __construct($month, $year) {
		$this->set_month($month);
		$this->set_year($year);
	}

	/**
	* @desc Vérifie et établie la valeur de $this->month
	*
	* @param int $month -> Mois du calendrier
	* @return void
	*/
	public function set_month($month) {
		if($month<=12 && $month>=1)
			$this->month = $month;
		/*else
			echo 'Le format du mois est incorrect<br />';*/
	}

	/**
	* @desc Vérifie et établie la valeur de $this->year
	*
	* @param int $year -> Année du calendrier
	* @return void
	*/
	public function set_year($year) {
		if($year<=2050 && $year>=1900)
			$this->year = $year;
		/*else
			echo 'Le format de l\'ann&eacute;e est incorrect<br />';*/
	}

	/**
	* @desc Retourne le mois en lettres
	*
	* @return string
	*/
	public function get_month() {
		return $this->ar_months[$this->month];
	}

	/**
	* @desc Retourne le mois en lettres
	*
	* @return string
	*/
	protected function get_eday_url($day) {
		foreach($this->ar_edays as $date => $url) {
			if($date==$day)
				return $url;
		}
	}
	
	/**
	* @desc Détermine si le jour peut être affiché dans la cellule
	*
	* @param int $day -> jour courant
	* @param int $cel -> numéro de la cellule
	* @return bool
	*/
	protected function is_day($day, $cel) {
		$n_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
		$first_day = jddayofweek(cal_to_jd(CAL_GREGORIAN, $this->month, 1, $this->year), 0);
		$first_day = ($first_day==0) ? 7 : ($first_day);
		if($cel>=$first_day && $cel<$n_days+$first_day)
			return 1;
		else
			return 0;
	}
	
	/**
	* @desc Détermine si le jour est aujourd'hui
	*
	* @param int $day -> jour courant
	* @return bool
	*/
	protected function is_today($day) {
		if($day==date('j') && $this->month== date('n') && $this->year==date('Y'))
			return 1;
		else
			return 0;
	}

	/**
	* @desc Détermine si le jour est férié
	*
	* @param int $day -> jour courant
	* @return bool
	*/
	protected function is_holiday($day) {
		foreach($this->ar_holidays as $date) {
			$date = explode("/", $date);
			if($day==$date[0] && $this->month==$date[1])
				return 1;
		}
		return 0;
	}
	
	/**
	* @desc Détermine si le jour est un jour de vacances
	*
	* @param int $day -> jour courant
	* @return bool
	*/
	protected function is_vacation($day) {
		foreach($this->ar_vacations as $date) {
			$date = explode("/", $date);
			if($day==$date[0] && $this->month==$date[1])
				return 1;
		}
		return 0;
	}
	
	/**
	* @desc Détermine si le jour est lié
	*
	* @param int $day -> jour courant
	* @return bool
	*/
	protected function is_eday($day) {
		foreach($this->ar_edays as $date => $url) {
			$date = explode("/", $date);
			if($day==$date[0] && $this->month==$date[1])
				return 1;
		}
		return 0;
	}
	
	/**
	* @desc Ajoute des jours au tableau des jours fériés
	*
	* @param string $holiday -> jour férié à ajouter (format : 'dd/mm' ou 'dd/mm->dd/mm')
	* @return void
	*/
	public function add_holiday($holiday) {
		if(preg_match('#^([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])->([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])$#', $holiday)) {
			$tmp_ar = explode('->', $holiday);
			$tmp_date[0] = explode('/', $tmp_ar[0]);
			$tmp_date[1] = explode('/', $tmp_ar[1]);
			for($a=$tmp_date[0][1];$a<=$tmp_date[1][1];$a++) {
				if($tmp_date[0][1]==$tmp_date[1][1]) {
					for($b=$tmp_date[0][0];$b<=$tmp_date[1][0];$b++) {
						$tmp_push = $b . '/' . $a;
						array_push($this->ar_holidays, $tmp_push);
					}
				}
				elseif($a<$tmp_date[1][1]) {
					for($b=$tmp_date[0][0];$b<=cal_days_in_month(CAL_GREGORIAN, $a, $this->year);$b++) {
						$tmp_push = $b . '/' . $a;
						array_push($this->ar_holidays, $tmp_push);
					}
					$tmp_date[0][0]=1;
				}
				else {
					for($b=$tmp_date[0][0];$b<=$tmp_date[1][0];$b++) {
						$tmp_push = $b . '/' . $a;
						array_push($this->ar_holidays, $tmp_push);
					}
				}
			}
		}
		elseif(preg_match('#^([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])$#', $holiday)) {
			array_push($this->ar_holidays, $holiday);
		}	
		/*else
			echo 'Format de date incorrect<br />';*/
	}
	
	/**
	* @desc Ajoute des jours au tableau des jours de vacances
	*
	* @param string $vacation -> jour férié à ajouter (format : 'dd/mm' ou 'dd/mm->dd/mm')
	* @return void
	*/
	public function add_vacation($vacation) {
		if(preg_match('#^([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])->([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])$#', $vacation)) {
			$tmp_ar = explode('->', $vacation);
			$tmp_date[0] = explode('/', $tmp_ar[0]);
			$tmp_date[1] = explode('/', $tmp_ar[1]);
			for($a=$tmp_date[0][1];$a<=$tmp_date[1][1];$a++) {
				if($tmp_date[0][1]==$tmp_date[1][1]) {
					for($b=$tmp_date[0][0];$b<=$tmp_date[1][0];$b++) {
						$tmp_push = $b . '/' . $a;
						array_push($this->ar_vacations, $tmp_push);
					}
				}
				elseif($a<$tmp_date[1][1]) {
					for($b=$tmp_date[0][0];$b<=cal_days_in_month(CAL_GREGORIAN, $a, $this->year);$b++) {
						$tmp_push = $b . '/' . $a;
						array_push($this->ar_vacations, $tmp_push);
					}
					$tmp_date[0][0]=1;
				}
				else {
					for($b=$tmp_date[0][0];$b<=$tmp_date[1][0];$b++) {
						$tmp_push = $b . '/' . $a;
						array_push($this->ar_vacations, $tmp_push);
					}
				}
			}
		}
		elseif(preg_match('#^([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])$#', $vacation)) {
			array_push($this->ar_vacations, $vacation);
		}	
		/*else
			echo 'Format de date incorrect<br />';*/
	}
	
	/**
	* @desc Ajoute des jours au tableau des jours liés
	*
	* @param string $eday -> jour lié à ajouter (format : 'dd/mm')
	* @return void
	*/
	public function add_eday($eday, $url) {
		if(preg_match('#^([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])$#', $eday) && preg_match('#((https?|ftp|gopher|telnet|file|notes|ms-help):((//)|(\\\\))+[\w\d:%/;$()~_?\+-=\\\.&]*)#', $url)) {
			$this->ar_edays[$eday] = $url;
		}
		/*else
			echo 'Format de date ou d\'url incorrect<br />';*/
	}
}

class calendar extends Abstractcalendar
{
	/**
	* @desc Affiche la légande du calendrier
	*
	* @return void
	*/
	public function show_header_calendar() {
		echo $this->get_month() . ' ' . $this->year . '<br />';
	}

	/**
	* @desc Construit le bloc des têtes de jours du calendrier
	*
	* @return void
	*/
	public function build_header_days() {
		if(empty($this->cout['calendar'])) {
			$this->cout['calendar'] = "\n\t" . '<table>' . "\n";
		}
		$this->cout['calendar'] .= "\t\t" . '<tr>' . "\n";
		for($k=1;$k<=7;$k++) {
			$this->cout['calendar'] .= "\t\t\t" . '<th>' . $this->ar_days[$k] . '</th>' . "\n";
		}
		$this->cout['calendar'] .= "\t\t" . '</tr>' . "\n";
	}

	/**
	* @desc Construit le bloc des jours du calendrier
	*
	* @return void
	*/
	public function build_days() {
		if(empty($this->cout['calendar'])) {
			$this->cout['calendar'] = "\n\t" . '<table>' . "\n";
		}
		$n_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
		$first_day = jddayofweek(cal_to_jd(CAL_GREGORIAN, $this->month, 1, $this->year), 0);
		$first_day = ($first_day==0) ? 7 : ($first_day);
		$n_col = ceil(($n_days+$first_day-1)/7);
		$num_day = 1;
		for($l=1;$l<=$n_col;$l++) {
			$this->cout['calendar'] .= "\t\t" . '<tr>' . "\n";
			for($m=1;$m<=7;$m++) {
				$cel = $m+7*($l-1);
				if($this->is_day($num_day, $cel)) {
					switch (1) {
						case ($this->is_today($num_day)) :
							$this->cout['calendar'] .= "\t\t\t" . '<td class="today">' . $num_day++ . '</td>' . "\n";
							break;
						case ($this->is_eday($num_day)) :
							$url = $this->get_eday_url($num_day);
							$this->cout['calendar'] .= "\t\t\t" . '<td class="eday"><a href="' . $url . '">' . $num_day++ . '</a></td>' . "\n";
							break;
						case ($this->is_vacation($num_day)) :
							$this->cout['calendar'] .= "\t\t\t" . '<td class="vacation">' . $num_day++ . '</td>' . "\n";
							break;
						case ($this->is_holiday($num_day)) :
							$this->cout['calendar'] .= "\t\t\t" . '<td class="holiday">' . $num_day++ . '</td>' . "\n";
							break;
						default :
							$this->cout['calendar'] .= "\t\t\t" . '<td class="otherday">' . $num_day++ . '</td>' . "\n";
							break;
					}
				}
				else
					$this->cout['calendar'] .= "\t\t\t" . '<td class="noday">&nbsp;</td>' . "\n";
			}
			$this->cout['calendar'] .= "\t\t" . '</tr>' . "\n";
		}
	}
	
	/**
	* @desc Construit un calendrier standard
	*
	* @return void
	*/
	public function build_std_calendar() {
		$this->build_header_days();
		$this->build_days();
	}

	/**
	* @desc Affiche le calendrier
	*
	* @return void
	*/
	public function show_calendar() {
		if(empty($this->cout['calendar'])) {
			$this->build_std_calendar();
		}
		$this->cout['calendar'] .= "\t" . '</table>' . "\n";
		echo $this->cout['calendar'];
		$this->cout['calendar'] = '';
	}
}
/*
Utilisation :
	Calendrier standard :
		$month = date('n');
		$year = date('Y');
		$calendar = new calendar($month, $year);
		$calendar->show_header_calendar();
		$calendar->show_calendar();

	Méthodes :
		$month = date('n');
		$year = date('Y');
		$calendar = new calendar($month, $year);
		$calendar->add_holiday('09/03');
		$calendar->add_holiday('12/03->24/03');
		$calendar->add_vacation('09/03');
		$calendar->add_vacation('12/03->24/03');
		$calendar->add_eday('10/03', 'http://kik.s.free.fr/test/test.php');
		echo $calendar->get_month();
		$calendar->show_header_calendar();
		$calendar->build_header_days();
		$calendar->build_days();
		$calendar->show_calendar();
	
Requis :
	Fichier CSS contenant :
		.today -> class pour l'affichage de la case du jour
		.otherday -> class pour l'affichage des cases des autres jours
		.holiday -> class pour l'affichage des jours fériés
		.vacation -> class pour l'affichage des jours de vacances
		.eday -> class pour l'affichage des jours liés
		.noday -> class pour l'affichage des cases sans jour
*/
?>