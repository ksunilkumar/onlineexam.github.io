<?php

function display_pag($url)
{

$val='<a href="'.$url.'?al=#">#</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="A")
$val.='A&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=A">A</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="B")
$val.='B&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=B">B</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="C")
$val.='C&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=C">C</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="D")
$val.='D&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=D">D</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="E")
$val.='E&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=E">E</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="F")
$val.='F&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=F">F</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="G")
$val.='G&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=G">G</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="H")
$val.='H&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=H">H</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="I")
$val.='I&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=I">I</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="J")
$val.='J&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=J">J</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="K")
$val.='K&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=K">K</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="L")
$val.='L&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=L">L</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="M")
$val.='M&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=M">M</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="N")
$val.='N&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=N">N</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="O")
$val.='O&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=O">O</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="P")
$val.='P&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=P">P</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="Q")
$val.='Q&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=Q">Q</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="R")
$val.='R&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=R">R</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="S")
$val.='S&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=S">S</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="T")
$val.='T&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=T">T</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="U")
$val.='U&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=U">U</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="V")
$val.='V&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=V">V</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="W")
$val.='W&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=W">W</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="X")
$val.='X&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=X">X</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="Y")
$val.='Y&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=Y">Y</a>&nbsp;&nbsp;&nbsp;';
if($_REQUEST['al']=="Z")
$val.='Z&nbsp;&nbsp;&nbsp';
else
$val.='<a href="'.$url.'?al=Z">Z</a>';
echo $val;
}
?>