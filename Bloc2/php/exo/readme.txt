Classe calendrier-----------------
Url     : http://codes-sources.commentcamarche.net/source/49347-classe-calendrierAuteur  : Mister JinglesDate    : 02/08/2013
Licence :
=========

Ce document intitulé « Classe calendrier » issu de CommentCaMarche
(codes-sources.commentcamarche.net) est mis à disposition sous les termes de
la licence Creative Commons. Vous pouvez copier, modifier des copies de cette
source, dans les conditions fixées par la licence, tant que cette note
apparaît clairement.

Description :
=============

classe pour afficher un petit calendrier tout simple en PHP5. J'ai pas trouv&eac
ute; de classe pour afficher un calendrier en PHP5 sur ce site donc je me permet
s de proposer la mienne (qui est tr&egrave;s light parce que je d&eacute;bute).

<br />
<br />-&gt;Je compl&egrave;te et mets &agrave; jour cette source suivan
t les commentaires que l'on me laisse. Si vous avez des id&eacute;es, des observ
ations ou des suggestions n'h&eacute;sitez pas. merci
<br /><a name='source-exe
mple'></a><h2> Source / Exemple : </h2>
<br /><pre class='code' data-mode='bas
ic'>
&lt;?php
/*
Fichier : class_calendar.php
Auteur : kik's
Date de créati
on : 25/02/09
Dernière modification : 01/06/11

-&gt; Classe des calendriers


<ul><li>/</li></ul>
abstract class Abstractcalendar
{
	/**

<ul>	<li> Mo
is du calendrier</li></ul>
	*

<ul>	<li> @var int
</li>	<li>/</li></ul>
	pr
otected $month = 0;

	/**

<ul>	<li> Année du calendrier</li></ul>
	*

<u
l>	<li> @var int
</li>	<li>/</li></ul>
	protected $year = 0;

	/**

<ul>	<
li> Tableau des mois</li></ul>
	*

<ul>	<li> @var array(string)
</li>	<li>/<
/li></ul>
	protected $ar_months = array(1=&gt;'Janvier', 'Février', 'Mars', 'Av
ril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Déc
embre');

	/**

<ul>	<li> Tableau des jours</li></ul>
	*

<ul>	<li> @var 
array(string)
</li>	<li>/</li></ul>
	protected $ar_days = array(1=&gt;'Lu', 'M
a', 'Me', 'Je', 'Ve', 'Sa', 'Di');

	/**

<ul>	<li> Tableau des jours fériés
</li></ul>
	*

<ul>	<li> @var array(string)
</li>	<li>/</li></ul>
	protecte
d $ar_holidays = array('01/01', '01/05', '08/05', '14/07', '15/08', '11/11', '25
/12');

	/**

<ul>	<li> Tableau des jours de vacances</li></ul>
	*

<ul>	
<li> @var array(string)
</li>	<li>/</li></ul>
	protected $ar_vacations = array
();
	
	/**

<ul>	<li> Tableau des jours fériés</li></ul>
	*

<ul>	<li> @v
ar array(string)
</li>	<li>/</li></ul>
	protected $ar_edays = array();

	/**


<ul>	<li> Chaine de sortie du calendrier contruite avec les méthodes build_<
/li></ul>
	*

<ul>	<li> @var array(string)
</li>	<li>/</li></ul>
	protected
 $cout = array();

	/**

<ul>	<li> @desc Constructeur</li></ul>
	*

<ul>	
<li> @return void
</li>	<li>/</li></ul>
	public function __construct($month, $
year) {
		$this-&gt;set_month($month);
		$this-&gt;set_year($year);
	}

	/*
*

<ul>	<li> @desc Vérifie et établie la valeur de $this-&gt;month</li></ul>

	*

<ul>	<li> @param int $month -&gt; Mois du calendrier
</li>	<li> @return v
oid
</li>	<li>/</li></ul>
	public function set_month($month) {
		if($month&lt
;=12 &amp;&amp; $month&gt;=1)
			$this-&gt;month = $month;
		/*else
			echo '
Le format du mois est incorrect&lt;br /&gt;';*/
	}

	/**

<ul>	<li> @desc V
érifie et établie la valeur de $this-&gt;year</li></ul>
	*

<ul>	<li> @param 
int $year -&gt; Année du calendrier
</li>	<li> @return void
</li>	<li>/</li></
ul>
	public function set_year($year) {
		if($year&lt;=2050 &amp;&amp; $year&gt
;=1900)
			$this-&gt;year = $year;
		/*else
			echo 'Le format de l\'année es
t incorrect&lt;br /&gt;';*/
	}

	/**

<ul>	<li> @desc Retourne le mois en l
ettres</li></ul>
	*

<ul>	<li> @return string
</li>	<li>/</li></ul>
	public
 function get_month() {
		return $this-&gt;ar_months[$this-&gt;month];
	}

	
/**

<ul>	<li> @desc Retourne le mois en lettres</li></ul>
	*

<ul>	<li> @r
eturn string
</li>	<li>/</li></ul>
	protected function get_eday_url($day) {
	
	foreach($this-&gt;ar_edays as $date =&gt; $url) {
			if($date==$day)
				retu
rn $url;
		}
	}
	
	/**

<ul>	<li> @desc Détermine si le jour peut être aff
iché dans la cellule</li></ul>
	*

<ul>	<li> @param int $day -&gt; jour coura
nt
</li>	<li> @param int $cel -&gt; numéro de la cellule
</li>	<li> @return bo
ol
</li>	<li>/</li></ul>
	protected function is_day($day, $cel) {
		$n_days =
 cal_days_in_month(CAL_GREGORIAN, $this-&gt;month, $this-&gt;year);
		$first_da
y = jddayofweek(cal_to_jd(CAL_GREGORIAN, $this-&gt;month, 1, $this-&gt;year), 0)
;
		$first_day = ($first_day==0) ? 7 : ($first_day);
		if($cel&gt;=$first_day 
&amp;&amp; $cel&lt;$n_days+$first_day)
			return 1;
		else
			return 0;
	}

	
	/**

<ul>	<li> @desc Détermine si le jour est aujourd'hui</li></ul>
	*


<ul>	<li> @param int $day -&gt; jour courant
</li>	<li> @return bool
</li>	<l
i>/</li></ul>
	protected function is_today($day) {
		if($day==date('j') &amp;&
amp; $this-&gt;month== date('n') &amp;&amp; $this-&gt;year==date('Y'))
			retur
n 1;
		else
			return 0;
	}

	/**

<ul>	<li> @desc Détermine si le jour e
st férié</li></ul>
	*

<ul>	<li> @param int $day -&gt; jour courant
</li>	<l
i> @return bool
</li>	<li>/</li></ul>
	protected function is_holiday($day) {

		foreach($this-&gt;ar_holidays as $date) {
			$date = explode(&quot;/&quot;, $
date);
			if($day==$date[0] &amp;&amp; $this-&gt;month==$date[1])
				return 1
;
		}
		return 0;
	}
	
	/**

<ul>	<li> @desc Détermine si le jour est un 
jour de vacances</li></ul>
	*

<ul>	<li> @param int $day -&gt; jour courant

</li>	<li> @return bool
</li>	<li>/</li></ul>
	protected function is_vacation(
$day) {
		foreach($this-&gt;ar_vacations as $date) {
			$date = explode(&quot;
/&quot;, $date);
			if($day==$date[0] &amp;&amp; $this-&gt;month==$date[1])
		
		return 1;
		}
		return 0;
	}
	
	/**

<ul>	<li> @desc Détermine si le jo
ur est lié</li></ul>
	*

<ul>	<li> @param int $day -&gt; jour courant
</li>	
<li> @return bool
</li>	<li>/</li></ul>
	protected function is_eday($day) {
	
	foreach($this-&gt;ar_edays as $date =&gt; $url) {
			$date = explode(&quot;/&q
uot;, $date);
			if($day==$date[0] &amp;&amp; $this-&gt;month==$date[1])
				r
eturn 1;
		}
		return 0;
	}
	
	/**

<ul>	<li> @desc Ajoute des jours au t
ableau des jours fériés</li></ul>
	*

<ul>	<li> @param string $holiday -&gt; 
jour férié à ajouter (format : 'dd/mm' ou 'dd/mm-&gt;dd/mm')
</li>	<li> @return
 void
</li>	<li>/</li></ul>
	public function add_holiday($holiday) {
		if(pre
g_match('#^([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])-&gt;([0-2][0-9]|3[0-1])/(0[1-9]|1
[0-2])$#', $holiday)) {
			$tmp_ar = explode('-&gt;', $holiday);
			$tmp_date[
0] = explode('/', $tmp_ar[0]);
			$tmp_date[1] = explode('/', $tmp_ar[1]);
			
for($a=$tmp_date[0][1];$a&lt;=$tmp_date[1][1];$a++) {
				if($tmp_date[0][1]==$
tmp_date[1][1]) {
					for($b=$tmp_date[0][0];$b&lt;=$tmp_date[1][0];$b++) {
	
					$tmp_push = $b . '/' . $a;
						array_push($this-&gt;ar_holidays, $tmp_pu
sh);
					}
				}
				elseif($a&lt;$tmp_date[1][1]) {
					for($b=$tmp_date[
0][0];$b&lt;=cal_days_in_month(CAL_GREGORIAN, $a, $this-&gt;year);$b++) {
					
	$tmp_push = $b . '/' . $a;
						array_push($this-&gt;ar_holidays, $tmp_push);

					}
					$tmp_date[0][0]=1;
				}
				else {
					for($b=$tmp_date[0][0
];$b&lt;=$tmp_date[1][0];$b++) {
						$tmp_push = $b . '/' . $a;
						array_
push($this-&gt;ar_holidays, $tmp_push);
					}
				}
			}
		}
		elseif(preg
_match('#^([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])$#', $holiday)) {
			array_push($t
his-&gt;ar_holidays, $holiday);
		}	
		/*else
			echo 'Format de date incorre
ct&lt;br /&gt;';*/
	}
	
	/**

<ul>	<li> @desc Ajoute des jours au tableau d
es jours de vacances</li></ul>
	*

<ul>	<li> @param string $vacation -&gt; jo
ur férié à ajouter (format : 'dd/mm' ou 'dd/mm-&gt;dd/mm')
</li>	<li> @return v
oid
</li>	<li>/</li></ul>
	public function add_vacation($vacation) {
		if(pre
g_match('#^([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])-&gt;([0-2][0-9]|3[0-1])/(0[1-9]|1
[0-2])$#', $vacation)) {
			$tmp_ar = explode('-&gt;', $vacation);
			$tmp_dat
e[0] = explode('/', $tmp_ar[0]);
			$tmp_date[1] = explode('/', $tmp_ar[1]);
	
		for($a=$tmp_date[0][1];$a&lt;=$tmp_date[1][1];$a++) {
				if($tmp_date[0][1]=
=$tmp_date[1][1]) {
					for($b=$tmp_date[0][0];$b&lt;=$tmp_date[1][0];$b++) {

						$tmp_push = $b . '/' . $a;
						array_push($this-&gt;ar_vacations, $tmp
_push);
					}
				}
				elseif($a&lt;$tmp_date[1][1]) {
					for($b=$tmp_da
te[0][0];$b&lt;=cal_days_in_month(CAL_GREGORIAN, $a, $this-&gt;year);$b++) {
		
				$tmp_push = $b . '/' . $a;
						array_push($this-&gt;ar_vacations, $tmp_pu
sh);
					}
					$tmp_date[0][0]=1;
				}
				else {
					for($b=$tmp_date[
0][0];$b&lt;=$tmp_date[1][0];$b++) {
						$tmp_push = $b . '/' . $a;
						ar
ray_push($this-&gt;ar_vacations, $tmp_push);
					}
				}
			}
		}
		elseif
(preg_match('#^([0-2][0-9]|3[0-1])/(0[1-9]|1[0-2])$#', $vacation)) {
			array_p
ush($this-&gt;ar_vacations, $vacation);
		}	
		/*else
			echo 'Format de date
 incorrect&lt;br /&gt;';*/
	}
	
	/**

<ul>	<li> @desc Ajoute des jours au t
ableau des jours liés</li></ul>
	*

<ul>	<li> @param string $eday -&gt; jour 
lié à ajouter (format : 'dd/mm')
</li>	<li> @return void
</li>	<li>/</li></ul>

	public function add_eday($eday, $url) {
		if(preg_match('#^([0-2][0-9]|3[0-1
])/(0[1-9]|1[0-2])$#', $eday) &amp;&amp; preg_match('#((https?|ftp|gopher|telnet
|file|notes|ms-help):((//)|(\\\\))+[\w\d:%/;$()~_?\+-=\\\.&amp;]*)#', $url)) {

			$this-&gt;ar_edays[$eday] = $url;
		}
		/*else
			echo 'Format de date ou 
d\'url incorrect&lt;br /&gt;';*/
	}
}

class calendar extends Abstractcalend
ar
{
	/**

<ul>	<li> @desc Affiche la légande du calendrier</li></ul>
	*


<ul>	<li> @return void
</li>	<li>/</li></ul>
	public function show_header_cal
endar() {
		echo $this-&gt;get_month() . ' ' . $this-&gt;year . '&lt;br /&gt;';

	}

	/**

<ul>	<li> @desc Construit le bloc des têtes de jours du calendri
er</li></ul>
	*

<ul>	<li> @return void
</li>	<li>/</li></ul>
	public funct
ion build_header_days() {
		if(empty($this-&gt;cout['calendar'])) {
			$this-&
gt;cout['calendar'] = &quot;\n\t&quot; . '&lt;table&gt;' . &quot;\n&quot;;
		}

		$this-&gt;cout['calendar'] .= &quot;\t\t&quot; . '&lt;tr&gt;' . &quot;\n&quot
;;
		for($k=1;$k&lt;=7;$k++) {
			$this-&gt;cout['calendar'] .= &quot;\t\t\t&q
uot; . '&lt;th&gt;' . $this-&gt;ar_days[$k] . '&lt;/th&gt;' . &quot;\n&quot;;
	
	}
		$this-&gt;cout['calendar'] .= &quot;\t\t&quot; . '&lt;/tr&gt;' . &quot;\n&
quot;;
	}

	/**

<ul>	<li> @desc Construit le bloc des jours du calendrier<
/li></ul>
	*

<ul>	<li> @return void
</li>	<li>/</li></ul>
	public function
 build_days() {
		if(empty($this-&gt;cout['calendar'])) {
			$this-&gt;cout['c
alendar'] = &quot;\n\t&quot; . '&lt;table&gt;' . &quot;\n&quot;;
		}
		$n_days
 = cal_days_in_month(CAL_GREGORIAN, $this-&gt;month, $this-&gt;year);
		$first_
day = jddayofweek(cal_to_jd(CAL_GREGORIAN, $this-&gt;month, 1, $this-&gt;year), 
0);
		$first_day = ($first_day==0) ? 7 : ($first_day);
		$n_col = ceil(($n_day
s+$first_day-1)/7);
		$num_day = 1;
		for($l=1;$l&lt;=$n_col;$l++) {
			$this
-&gt;cout['calendar'] .= &quot;\t\t&quot; . '&lt;tr&gt;' . &quot;\n&quot;;
			f
or($m=1;$m&lt;=7;$m++) {
				$cel = $m+7*($l-1);
				if($this-&gt;is_day($num_
day, $cel)) {
					switch (1) {
						case ($this-&gt;is_today($num_day)) :
	
						$this-&gt;cout['calendar'] .= &quot;\t\t\t&quot; . '&lt;td class=&quot;tod
ay&quot;&gt;' . $num_day++ . '&lt;/td&gt;' . &quot;\n&quot;;
							break;
			
			case ($this-&gt;is_eday($num_day)) :
							$url = $this-&gt;get_eday_url($n
um_day);
							$this-&gt;cout['calendar'] .= &quot;\t\t\t&quot; . '&lt;td clas
s=&quot;eday&quot;&gt;&lt;a href=&quot;' . $url . '&quot;&gt;' . $num_day++ . '&
lt;/a&gt;&lt;/td&gt;' . &quot;\n&quot;;
							break;
						case ($this-&gt;is
_vacation($num_day)) :
							$this-&gt;cout['calendar'] .= &quot;\t\t\t&quot; 
. '&lt;td class=&quot;vacation&quot;&gt;' . $num_day++ . '&lt;/td&gt;' . &quot;\
n&quot;;
							break;
						case ($this-&gt;is_holiday($num_day)) :
							$
this-&gt;cout['calendar'] .= &quot;\t\t\t&quot; . '&lt;td class=&quot;holiday&qu
ot;&gt;' . $num_day++ . '&lt;/td&gt;' . &quot;\n&quot;;
							break;
						de
fault :
							$this-&gt;cout['calendar'] .= &quot;\t\t\t&quot; . '&lt;td class
=&quot;otherday&quot;&gt;' . $num_day++ . '&lt;/td&gt;' . &quot;\n&quot;;
					
		break;
					}
				}
				else
					$this-&gt;cout['calendar'] .= &quot;\t\t
\t&quot; . '&lt;td class=&quot;noday&quot;&gt;&amp;nbsp;&lt;/td&gt;' . &quot;\n&
quot;;
			}
			$this-&gt;cout['calendar'] .= &quot;\t\t&quot; . '&lt;/tr&gt;' 
. &quot;\n&quot;;
		}
	}
	
	/**

<ul>	<li> @desc Construit un calendrier s
tandard</li></ul>
	*

<ul>	<li> @return void
</li>	<li>/</li></ul>
	public 
function build_std_calendar() {
		$this-&gt;build_header_days();
		$this-&gt;b
uild_days();
	}

	/**

<ul>	<li> @desc Affiche le calendrier</li></ul>
	*


<ul>	<li> @return void
</li>	<li>/</li></ul>
	public function show_calendar
() {
		if(empty($this-&gt;cout['calendar'])) {
			$this-&gt;build_std_calendar
();
		}
		$this-&gt;cout['calendar'] .= &quot;\t&quot; . '&lt;/table&gt;' . &q
uot;\n&quot;;
		echo $this-&gt;cout['calendar'];
		$this-&gt;cout['calendar'] 
= '';
	}
}
/*
Utilisation :
	Calendrier standard :
		$month = date('n');

		$year = date('Y');
		$calendar = new calendar($month, $year);
		$calendar-&g
t;show_header_calendar();
		$calendar-&gt;show_calendar();

	Méthodes :
		$m
onth = date('n');
		$year = date('Y');
		$calendar = new calendar($month, $yea
r);
		$calendar-&gt;add_holiday('09/03');
		$calendar-&gt;add_holiday('12/03-&
gt;24/03');
		$calendar-&gt;add_vacation('09/03');
		$calendar-&gt;add_vacatio
n('12/03-&gt;24/03');
		$calendar-&gt;add_eday('10/03', 'http://kik.s.free.fr/t
est/test.php');
		echo $calendar-&gt;get_month();
		$calendar-&gt;show_header_
calendar();
		$calendar-&gt;build_header_days();
		$calendar-&gt;build_days();

		$calendar-&gt;show_calendar();
	
Requis :
	Fichier CSS contenant :
		.to
day -&gt; class pour l'affichage de la case du jour
		.otherday -&gt; class pou
r l'affichage des cases des autres jours
		.holiday -&gt; class pour l'affichag
e des jours fériés
		.vacation -&gt; class pour l'affichage des jours de vacanc
es
		.eday -&gt; class pour l'affichage des jours liés
		.noday -&gt; class po
ur l'affichage des cases sans jour

<ul><li>/</li></ul>
?&gt;
</pre>
<br />
<a name='conclusion'></a><h2> Conclusion : </h2>
<br />Merci de laisser vos id
&eacute;es, observations ou suggestions pour faire &eacute;voluer cette source.
