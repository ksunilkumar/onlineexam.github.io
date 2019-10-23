<?php
	
	$version = phpversion();
	$version = (float) $version;
	if($version < 5) {
		echo '<br />' . "\n" . '<b>Fatal error</b>: PHP ' . phpversion() . ' is installed on your system. <b>SVGraph</b> requires PHP 5 or higher.';
		exit();
	}
	
	
	
			# ------- The graph values in the form of associative array
		function display_image($val)
		{
			$d=time();
			$imgname=1;
			$values=array();
			$i=1;
			$total=$val;
			foreach($total as $val)
			{
				$values[$i]=$val;
				$i++;
			}
			#--- Display image size --
			$img_width=380;
			$img_height=200; 
			$margins=25;
			# ---- Find the size of graph by substracting the size of borders
			$graph_width=$img_width - $margins * 2;
			$graph_height=$img_height - $margins * 2; 
			$img=imagecreate($img_width,$img_height);
			$bar_width=10;
			$total_bars=count($values);
			$gap=($graph_width- $total_bars * $bar_width ) / ($total_bars +1);
			# -------  Define Colors ----------------
			$bar_color=imagecolorallocate($img,0,64,128);
			$background_color=imagecolorallocate($img,240,240,255);
			$border_color=imagecolorallocate($img,200,200,200);
			$line_color=imagecolorallocate($img,220,220,220);
			# ------ Create the border around the graph ------
			imagefilledrectangle($img,1,1,$img_width-2,$img_height-2,$border_color);
			imagefilledrectangle($img,$margins,$margins,$img_width-1-$margins,$img_height-1-$margins,$background_color);
			# ------- Max value is required to adjust the scale	-------
			$max_value=max($values);
			$max_value++;
			//echo $max_value;
			$ratio= $graph_height/$max_value;
		//	echo $ratio;
			# -------- Create scale and draw horizontal lines  --------
			$max_z=max($values);
			$horizontal_lines=$max_value;
			$horizontal_gap=$graph_height/$horizontal_lines;
			$i=0;
			$y=$img_height - $margins - $horizontal_gap * $i ;
			imageline($img,$margins,$y,$img_width-$margins,$y,$line_color);
			$v=ceil($horizontal_gap * $i /$ratio);
			//echo $v;
			imagestring($img,0,5,$y-5,$v,$bar_color);
			for($i=1;$i<=$horizontal_lines;$i++){
				$y=$img_height - $margins - $horizontal_gap * $i ;
				imageline($img,$margins,$y,$img_width-$margins,$y,$line_color);
				$v=ceil($horizontal_gap * $i /$ratio);
				//echo $v;
				imagestring($img,0,5,$y-5,$v,$bar_color);
			}
			# ----------- Draw the bars here ------
			for($i=0;$i< $total_bars; $i++){ 
				# ------ Extract key and value pair from the current pointer position
				list($key,$value)=each($values);
				$value1 = $value;
				$x1= $margins + $gap + $i * ($gap+$bar_width) ;
				$x2= $x1 + $bar_width; 
				$y1=$margins +$graph_height- intval($value * $ratio) ;
				$y2=$img_height-$margins;
				imagestring($img,50,$x1+6,$y1-15,$value1,$bar_color);
				imagestring($img,3,$x1+3,$img_height-20,$key,$bar_color);		
				imagefilledrectangle($img,$x1,$y1,$x2,$y2,$bar_color);
				imagestring($img,50,350,$img_height-248,'Time vs marks Graph',$bar_color);
				imagestring($img,50,5,$img_height-250,'T',$bar_color);
				imagestring($img,50,5,$img_height-20,'Q',$bar_color);
			}
			imagepng($img,$imgname.'.png');
			return ($imgname);
		}
		function getGraduation($min, $max, $nrOfSteps) {
	
			$min = (float) $min;
			$max = (float) $max;
			$nrOfSteps = (int) $nrOfSteps;
				if($nrOfSteps <= 0) return false;
			
			$return = array();
			
			/* get min */		
			if($min < 0) {
				$tmpMin = floor(floatval($min)/10) * 10;
			}
			else
				$tmpMin = 0;
			if(!isset($tmpMin)) $tmpMin = 0;
			$return['min'] = $tmpMin;
			
			/* get max */
			if($max >= 50)
				$tmpMax = ceil(floatval($max)/10) * 10;
			else if($max >= 10)
				$tmpMax = ceil(floatval($max)/1) * 1;
			else {
				for($i=1; $i>0; $i/=10) {
					if($max >= $i) {
						$tmpMax = ceil(floatval($max)/$i) * $i;
						break;
					}
				}
			}
			if(!isset($tmpMax)) $tmpMax = 0;
			$return['max'] = $tmpMax;
				
			// get step
			$return['step'] = ($return['max'] - $return['min']) / $nrOfSteps;
			
				return $return;
		}
		
		function throwError($errMsg, $methodName) {
			echo "<br /><b>Warning</b>: $methodName(): $errMsg<br />";
		}
		function getSVGRaphRoot() {
			$return = dirname(__FILE__) . '/';
			$return = str_replace('\\', '/', $return);
			$return = str_replace($_SERVER['DOCUMENT_ROOT'], '', $return);
			if(substr($return, 0, 1) != '/') $return = '/' . $return;
			return $return;
		}
		function xmlEscape($text) {
			$text = str_replace('&', '&amp;', $text);
			$text = str_replace('<', '&lt;', $text);
			$text = str_replace('>', '&gt;', $text);
			return $text;
		}
		
		function outputSVGHeader() {
			header('Content-Type: image/svg+xml');
		}
		function outputXMLVersion() {
			echo '<?xml version="1.0" encoding="ISO-8859-1" standalone="no" ?>' . "\n";
		}
		/*function outputCopyright() {
			echo
				'<!--' . "\n\n\n" .
					"\t" . 'This graph was created using SVGraph' . "\n" .
					"\t" . 'for more information on SVGraph please visit http://slauth.de/projekte/SVGraph' . "\n\n" .
				'-->' . "\n\n"
			;
		}*/
		function outputDTD() {
			
		}
			
	
	
	class chart
	{
			var $elements; //the input values
			var $elemetnames; //the name of the input values
			var $fractions; //the fractions of the elements
			var $colors; //the input color names
		var $colornames = array(
			'1'        => array(179,213,233),
			'2'        => array(128,15,219),
			'3'        => array(0,114,183),
			'4'        => array(213,233,253),
			'5'        => array(110, 25,  255),
			'6'        => array(245, 245, 220),
			'7'        => array(255, 228, 196),
			'8'        => array(179,213,233),
			'9'        => array(128,185,219),
			'10'       => array(0,114,183),
			'11'       => array(138, 43, 226),
			'12'       => array(165, 42, 42),
			'13'       => array(222, 184, 135),
			'14'       => array(95, 158, 160),
			'15'       => array(127, 255, 0),
			'16'       => array(210, 105, 30),
			'17'       => array(255, 127, 80),
			'18'       => array(100, 149,  237),
			'19'       => array(255, 248, 220),
			'20'       => array(179,213,233),
			'21'       => array(0, 255, 255),
			'22'       => array(0, 0, 13),
			'23'       => array(0, 139, 139),
			'24'       => array(184, 134, 11),
			'25'       => array(169, 169, 169),
			'26'       => array(0, 100, 0),
			'27'       => array(189, 183, 107),
			'28'       => array(139, 0, 139),
			'29'       => array(85, 107, 47),
			'30'       => array(255, 140, 0),
			'31'       => array(153, 50, 204),
			'32'       => array(139, 0, 0),
			'33'       => array(233, 150, 122),
			'34'       => array(143, 188, 143),
			'35'       => array(72, 61, 139),
			'36'       => array(47, 79, 79),
			'37'       => array(0, 206, 209),
			'38'       => array(148, 0, 211),
			'39'       => array(255, 20, 147),
			'40'       => array(0, 191, 255),
			'41'       => array(105, 105, 105),
			'42'       => array(30, 144, 255),
			'43'       => array(178, 34, 34),
			'44'       => array(255, 250, 240),
			'45'       => array(34, 139, 34),
			'46'       => array(255, 0, 255),
			'47'       => array(220, 220, 220),
			'48'       => array(248, 248, 255),
			'49'       => array(255, 215, 0),
			'50'       => array(218, 165, 32),
			'51'       => array(128, 128, 128),
			'52'       => array(0, 128, 0),
			'53'       => array(173, 255, 47),
			'54'       => array(240, 255, 240),
			'55'       => array(255, 105, 180),
			'56'       => array(205, 92, 92),
			'57'       => array(75, 0, 130),
			'58'       => array(255, 255, 240),
			'59'       => array(240, 230, 140),
			'60'       => array(230, 230, 250),
			'61'       => array(255, 240, 245),
			'62'       => array(124, 252,  0),
			'63'       => array(255, 250, 205),
			'64'       => array(173, 216, 230),
			'65'       => array(240, 128, 128),
			'66'       => array(224, 255, 255),
			'67'       => array(250, 250, 210),
			'68'       => array(144, 238, 144),
			'69'       => array(211, 211, 211),
			'70'       => array(255, 182, 193),
			'71'       => array(255, 160, 122),
			'72'       => array(32, 178, 170),
			'73'       => array(135, 206, 250),
			'74'       => array(119, 136, 153),
			'75'       => array(176, 196, 222),
			'76'       => array(255, 255, 224),
			'77'       => array(0, 255, 0),
			'78'       => array(50, 205, 50),
			'79'       => array(250, 240, 230),
			'80'       => array(255, 0, 255),
			'81'       => array(128, 0, 0),
			'82'       => array(102, 205, 170),
			'83'       => array(0, 0, 205),
			'84'       => array(186, 85, 211),
			'85'       => array(147, 112, 219),
			'86'       => array(60, 179, 113),
			'87'       => array(123, 104, 238),
			'88'       => array(0, 250, 154),
			'89'       => array(72, 209, 204),
			'90'       => array(199, 21, 133),
			'91'       => array(25, 25, 112),
			'92'       => array(245, 255, 250),
			'93'       => array(255, 228, 225),
			'94'       => array(255, 228, 181),
			'95'       => array(255, 222, 173),
			'96'       => array(0, 0, 128),
			'97'       => array(253, 245, 230),
			'98'       => array(128, 128, 0),
			'99'       => array(107, 142, 35),
			'100'      => array(255, 165, 0),
			'101'      => array(255,69,0),
			'102'      => array(218,112,214),
			'103'      => array(238,232,170),
			'104'      => array(152,251,152),
			'105'      => array(175,238,238),
			'106'      => array(219,112,147),
			'107'      => array(255,239,213),
			'108'      => array(255,218,185),
			'109'      => array(205,133,63),
			'110'      => array(255,192,203),
			'111'      => array(221,160,221),
			'112'      => array(176,224,230),
			'113'      => array(128,0,128),
			'114'      => array(255,0,0),
			'115'      => array(188,143,143),
			'116'      => array(65,105,225),
			'117'      => array(139,69,19),
			'118'      => array(250,128,114),
			'119'      => array(244,164,96),
			'120'      => array(46,139,87),
			'121'      => array(255,245,238),
			'122'      => array(160,82,45),
			'123'      => array(192,192,192),
			'124'      => array(135,206,235),
			'125'      => array(106,90,205),
			'126'      => array(112,128,144),
			'127'      => array(255,250,250),
			'128'      => array(0,255,127),
			'129'      => array(70,130,180),
			'130'      => array(210,180,140),
			'131'      => array(0,128,128),
			'132'      => array(216,191,216),
			'133'      => array(255,99,71),
			'134'      => array(64,224,208),
			'135'      => array(238,130,238),
			'136'      => array(245,222,179),
			'137'      => array(255,255,255),
			'138'      => array(245,245,245),
			'139'      => array(255,255,0),
			'140'      => array(154,205,50)
		);
	
			function calculate()
			{
					$sum=array_sum($this->elements);
					$i = 1;
					foreach ($this->elements as $value)
					{
							$this->fractions[$i]=$value/$sum;
							$i++;
					}
			}
	}	
	
	
	class piechart extends chart
	{
			var $radius;
			var $final;
			var $Coords = array();
			var $links;
			function piechart($r,$na,$el,$co)
			{
					$this->radius=$r;
					$this->elementnames=$na;
					$this->elements=$el;
					$this->colors=$co;
					$this->createimage();
			}
			function createimage()
			{
				$degree = 0;
				$this->calculate();
				$r=$this->radius;
				$image=imagecreate($r*3,$r*2);
				$white=imagecolorallocate($image,255,255,255);
				$black=imagecolorallocate($image,0,0,0);
				$ggg = imagecolorallocate($image,140,140,140);
				for ($k=0;$k<count($this->colors);$k++)
				{
						$fillcolor[$k]=imagecolorallocate($image,$this->colornames[$this->colors[$k]][0],$this->colornames[$this->colors[$k]][1],$this->colornames[$this->colors[$k]][2]);
				}
				imagearc($image,$r,$r,$r*2-1,$r*2-1,0,360,$black);
				for ($j=0;$j<count($this->elements);$j++)
				{
						$part = 360*$this->fractions[$j];
						if (isset($x2)) $x3 = $x2; else $x3 = $r*2;
						if (isset($y2)) $y3 = $y2; else $y3 = $r;
						$degree+=360*$this->fractions[$j];
						$x1 = $r;
						$y1 = $r;
						$x2 = $x1 + $x1*cos($degree*pi()/180);
						$y2 = $y1 + $y1*sin($degree*pi()/180);
						imageline($image,$x1,$y1,$x2,$y2,$black);
						imagefill($image,$r+$r/9*cos(($degree+5)*pi()/180),$r+$r/9*sin(($degree+5)*pi()/180),$fillcolor[$j]);
						if ($j>0) $LegendIndex =  $j-1; else $LegendIndex = count($this->elements) - 1;
						imagefilledrectangle($image,2.1*$r,.7*$r+($r/12)*$j,2.12*$r+($r/25),.7*$r+5+($r/8)*$j,$fillcolor[$LegendIndex]);
						imagestring($image,3,2.13*$r+$r/20,.71*$r+($r/9)*$j-2,$this->elements[$j],$black);
						$x22 = round($x2,0);
						$y22 = round($y2,0);
						$x33 = round($x3,0);
						$y33 = round($y3,0);
						$Coo[$j]['coords'] = "$x1,$y1,$x22,$y22,$x33,$y33";
						if ($part > 90)
						{
							for ($k=30;$k<$part;$k+=30)
							{
								 $tmpx = $r + round($r * cos(($degree+$k-$part)*pi()/180),0);
								 $tmpy = $r + round($r * sin(($degree+$k-$part)*pi()/180),0);
								 $Coo[$j]['coords'] .= ",$tmpx,$tmpy,";
							}
						}
				}
				$this->final=$image;
				$this->Coords = $Coo;
			}
			function draw()
			{
			   imagejpeg($this->final);
			}
			function setLink()
			{
				print "<map name=\"Map\">\n";
				for ($j=0;$j<count($this->elements);$j++)
				{
					print "<area shape=\"poly\" coords=\"".$this->Coords[$j]['coords']."\" href=\"".$this->links[$j]."\">\n";
				}
				print "</map>\n";
			}
			function out($filename,$quality)
			{
				 imagejpeg($this->final,$filename,$quality);
			}
			function GenerateHtmlCode()
			{
					$filename = "piechart.png";
					$this->out($filename,100);
					if ($this->links != "") print "<img src=\"$filename\" border=\"0\" usemap=\"#Map\">\n";
					else print "<img src=\"$filename\" border=\"0\">\n";
					if ($this->links != "") $this->setLink();
			}
	}



	
	
?>