<?php

session_start();

include 'lib/db.php';
user_login_check();
include_once ("lib/test_gen_class.php");

$generator = new TestGenerator();

$testids=$_REQUEST['testids'];
$qno=$_REQUEST['qno'];

$test_id=(int)substr($_REQUEST['testids'],0,strripos($_REQUEST['testids'],"gen"));

if(!file_exists('tests/'.$_REQUEST['testids'].'.js'))
{
	$objsql = new SqlClass();
	$qry="select * from test_tests where user_id=".$_SESSION['user_id']." and test_id=".$test_id;
	$res=$objsql->executeSql($qry);
	$row=$objsql->fetchRow($res);
	
	echo '<pre>';
//	print_r($row);
	echo '</pre>';
	
	$test_name=$row['test_name'];
	$sections=$row['sections'];
	$categories=$row['categories'];
	$numques=$row['numques'];
	$catwqs=unserialize($row['catwqs']);
	$mrkpq=$row['mrkpq'];
	$negmrk=$row['negmrk']*$row['mrkpq'];
	$testtime=$row['testtime']*60;
	
	
	$data='function Section (sectionName,sectionID,secQues,secTime,secMarks,secNegMark,consumedsecTime,consumedsecq)
		{
			this.sectionName=sectionName;
			this.sectionID=sectionID;
			this.secQues=secQues;
			this.secTime=secTime;
			this.secMarks=secMarks;
			this.secNegMark=secNegMark;
			this.consumedsecTime=consumedsecTime;
			this.consumedsecq=consumedsecq;
		}
		
		function Question(qname,type,qstring,response,img,fid,fname,b_time,diff,testids,sectionid,flag)
		{
			this.qname=qname;
			this.type=type;
			this.qstring=qstring;
			this.response=response;
			this.img=img;
			this.fid=fname;
			this.fname=fid;
			this.b_time=b_time;
			this.diff=diff;
			this.testids=testids;
			this.sectionid=sectionid
			this.flag=flag;
		}
		//document.write(a);
		var zin=1,top=0, mycount=0, waitTime='.$testtime.' , qright=0, mycomment,nowtime;
		var global=new Array(3);
		var abc,xyz,tm;
		var tname = "Reading Comprehension";
		var tid = "src366";
		var cname = "RC: 1" ;
		var gg = "d";
		var recent, recent2, recdone=false, opera7, opera=CheckOpera56();
		P7_OpResizeFix();
		function P7_OpResizeFix(a) { //v1.1 by PVII
		if(!window.opera){return;}if(!document.p7oprX){
		 document.p7oprY=window.innerWidth;document.p7oprX=window.innerHeight;
		 document.onmousemove=P7_OpResizeFix;
		 }else{if(document.p7oprX){
		  var k=document.p7oprX-window.innerHeight;
		  var j=document.p7oprY - window.innerWidth;
		  if(k>1 || j>1 || k<-1 || j<-1){
		  document.p7oprY=window.innerWidth;document.p7oprX=window.innerHeight;
		  do_reposition();}}}
		}
		function cachewrite(s,idx){global[idx]+=s;}
		function CheckOpera56()
		{
		var version;
		if (navigator.userAgent.toLowerCase().indexOf(\'opera\') == -1) return false;
		version=parseInt(navigator.appVersion.toLowerCase());
		if (version>6) {opera7=true; return false;}
		if (version<5) return false;
		return true;
		}';
	
	$ques='';
	$j=0; // question increment
	
	// creating Category wise questions
	while(list($key,$val) = each($catwqs))
	{
		$cat=$key;
		$catqus=$val;
		
		$qsobjsql = new SqlClass();
		$qs_qry="select * from test_questions where chapter_id=".$cat." ORDER BY RAND() limit ".$catqus;
		$rs=$qsobjsql->executeSql($qs_qry);
		
	echo '<pre>';
//	print_r($rs);
	echo '</pre>';

	// creating the question by question
		while($rec=$qsobjsql->fetchRow($rs))
		{
				
		 $ques_details=$generator->get_ques_full_details($rec['que_id']);

	echo '<pre>';
	// print_r($ques_details);
	echo '</pre>';
		
				
				
				$ques.='resp=new Array(';
			//	$options=explode(',',$rec['options']);
				$options=$ques_details['options'];
				
				for($i=0;$i<count($options);$i++)
				{
					if($i!=0)
						$ques.=',';
					
					$ques.='"<font face=Arial size=2>'.addslashes(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $options[$i])).'</font>"';
				}
				
				$ques.=');';
				$ques.='comm="";';
				$ques.='valu="";';
	
	
				$ques.='ques'.$j.' = new Question(
						"Question'.$j.'",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>'.addslashes(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $ques_details['question'])).'</b></font>",
						resp,
						"'.$ques_details['qus_id'].'",
						"'.$ques_details['qus_id'].'",
						"",
						0,
						0,
						"'.$testids.'",
						"'.$sections.'",
						0
						);';
	
			$j++;
		}
	}
		
		$ques.='questions = new Array (';
		for($k=0;$k<$numques;$k++)
		{
			if($k!=0)
				$ques.=',';
			$ques.='ques'.$k;
		}
		$ques.=');';
		$ques.='sectionArr0 = new Section(
			"Section 1",
			"1",
			"'.$numques.'",
			"'.$testtime.'",
			"'.$mrkpq.'",
			"'.$negmrk.'",
			0,
			0);
		sectionArr = new Array (sectionArr0);';
		
		$tot_data=$data.$ques;
	

	echo '<pre>';
//	print_r($tot_data);
	echo '</pre>';
	
	
	 $fp = fopen('tests/'.$_REQUEST['testids'].'.js', 'w');
	 fwrite($fp, $tot_data);
	 fclose($fp);
	
	
	echo '<script>';
	echo 'window.location.href="Exam.php?qno='.$numques.'&tst='.$testids.'";';
	echo '</script>';
}
else if($_REQUEST['type']=='new')
{
	echo '<script>';
	echo 'window.location.href="Exam.php?qno='.$qno.'&tst='.$testids.'";';
	echo '</script>';
}
else if($_REQUEST['type']=='view')
{
	$objsql = new SqlClass();
	$qry='select result_id from test_test_results where test_id='.$test_id;
	$res=$objsql->executeSql($qry);
	$row=$objsql->fetchRow($res);
	
	echo '<script>';
	echo 'window.location.href="view_result.php?test_id='.$test_id.'&ttaken='.$row['result_id'].'";';
	echo '</script>';
}

?>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1"><link href="Generate.php_files/test_opt.css" type="text/css" rel="stylesheet">
</head><body></body></html>