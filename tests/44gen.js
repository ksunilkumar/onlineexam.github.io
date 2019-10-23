function Section (sectionName,sectionID,secQues,secTime,secMarks,secNegMark,consumedsecTime,consumedsecq)
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
		var zin=1,top=0, mycount=0, waitTime=1800 , qright=0, mycomment,nowtime;
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
		if (navigator.userAgent.toLowerCase().indexOf('opera') == -1) return false;
		version=parseInt(navigator.appVersion.toLowerCase());
		if (version>6) {opera7=true; return false;}
		if (version<5) return false;
		return true;
		}resp=new Array("<font face=Arial size=2>always irrational</font>","<font face=Arial size=2>always rational</font>","<font face=Arial size=2>rationalor irrational</font>","<font face=Arial size=2>none</font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The product of a non-zero rational andan irrational number is</b></font>",
						resp,
						"488",
						"488",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>5</font>","<font face=Arial size=2>8</font>","<font face=Arial size=2>16</font>","<font face=Arial size=2>18</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Find the largest number whichdivides 245 and 1029 leaving remainder 5 in each case</b></font>",
						resp,
						"614",
						"614",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>50 litres</font>","<font face=Arial size=2>150 litres</font>","<font face=Arial size=2>170litres</font>","<font face=Arial size=2>100 litres</font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Two tankers contain 850litres and 680 litres of petrol respectively. Find the maximum capacity of a containerwhich can measure the petrol of either tanker in exact number of times</b></font>",
						resp,
						"1060",
						"1060",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img width=9 height=19src=\'admin/papers/CH1%20-%20Section%20B%20-%20Options_files/image002.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=30 height=19src=\'admin/papers/CH1%20-%20Section%20B%20-%20Options_files/image004.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=18 height=19src=\'admin/papers/CH1%20-%20Section%20B%20-%20Options_files/image006.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=18 height=19src=\'admin/papers/CH1%20-%20Section%20B%20-%20Options_files/image008.gif\' v:shapes=\'_x0000_i1025\'></font>");comm="";valu="";ques3 = new Question(
						"Question3",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If the HCF of 210 and 55 isexpressible in the form <img width=100 height=19src=\'admin/papers/CH1%20-%20Section%20B%20-%20Questions_files/image002.gif\' v:shapes=\'_x0000_i1025\'>, find y</b></font>",
						resp,
						"49",
						"49",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>5</font>","<font face=Arial size=2>10</font>","<font face=Arial size=2>0</font>","<font face=Arial size=2>20</font>");comm="";valu="";ques4 = new Question(
						"Question4",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>A sweet seller has 420 Kajuburfis and 130 Badam furfis she wants to stack them in such a way that eachstack has the same number, and they take up the least area of the tray. What isthe number of burfis that can be placed in each stack for this purpose?</b></font>",
						resp,
						"804",
						"804",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>17</font>","<font face=Arial size=2>15</font>","<font face=Arial size=2>10</font>","<font face=Arial size=2>19</font>");comm="";valu="";ques5 = new Question(
						"Question5",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Find the largest possible positive integer that willdivide 398,436 and 542 leaving remainder 7,11,15 respectively.</b></font>",
						resp,
						"39",
						"39",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img width=9 height=19src=\'admin/papers/CH1%20-%20Sec%20A%20-%20options_files/image031.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=37 height=19src=\'admin/papers/CH1%20-%20Sec%20A%20-%20options_files/image033.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=18 height=19src=\'admin/papers/CH1%20-%20Sec%20A%20-%20options_files/image034.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=46 height=19src=\'admin/papers/CH1%20-%20Sec%20A%20-%20options_files/image036.gif\' v:shapes=\'_x0000_i1025\'></font>");comm="";valu="";ques6 = new Question(
						"Question6",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>For some integer q, every odd integer is of the form</b></font>",
						resp,
						"919",
						"919",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>ab</font>","<font face=Arial size=2><img src=\"admin/papers/CH1%20-%20Sec%20A%20-%20options_files/image041.gif\" alt=\"\" width=\"36\" height=\"19\" /></font>","<font face=Arial size=2><img src=\"admin/papers/CH1%20-%20Sec%20A%20-%20options_files/image042.gif\" alt=\"\" width=\"36\" height=\"19\" /></font>","<font face=Arial size=2><img src=\"admin/papers/CH1%20-%20Sec%20A%20-%20options_files/image043.gif\" alt=\"\" width=\"36\" height=\"19\" /><sup></sup></font>");comm="";valu="";ques7 = new Question(
						"Question7",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If two positive integers p and q can be expressed as<img src=\"admin/papers/CH1%20-%20Sec%20A%20-%20Questions_files/image010.gif\" alt=\"\" width=\"56\" height=\"19\" /> and<img src=\"admin/papers/CH1%20-%20Sec%20A%20-%20Questions_files/image012.gif\" alt=\"\" width=\"59\" height=\"19\" />; a, b being prime numbers, then LCM (p, q) is</b></font>",
						resp,
						"679",
						"679",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>m</font>","<font face=Arial size=2><img width=42 height=19src=\'admin/papers/CH1%20-%20Sec%20A%20-%20options_files/image028.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2>2m</font>","<font face=Arial size=2><img width=50 height=19src=\'admin/papers/CH1%20-%20Sec%20A%20-%20options_files/image030.gif\' v:shapes=\'_x0000_i1025\'></font>");comm="";valu="";ques8 = new Question(
						"Question8",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>For some integer m, every even integer is of the form</b></font>",
						resp,
						"1073",
						"1073",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img width=96 height=19src=\'admin/papers/CH1%20-%20Section%20B%20-%20Options_files/image010.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=107 height=19src=\'admin/papers/CH1%20-%20Section%20B%20-%20Options_files/image012.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=96 height=19src=\'admin/papers/CH1%20-%20Section%20B%20-%20Options_files/image014.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=84 height=19src=\'admin/papers/CH1%20-%20Section%20B%20-%20Options_files/image016.gif\' v:shapes=\'_x0000_i1025\'></font>");comm="";valu="";ques9 = new Question(
						"Question9",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If d is the HCF of 56 and 72,find x, y satisfying <img width=103 height=19src=\'admin/papers/CH1%20-%20Section%20B%20-%20Questions_files/image004.gif\' v:shapes=\'_x0000_i1025\'></b></font>",
						resp,
						"1067",
						"1067",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>30 mins</font>","<font face=Arial size=2>33mins</font>","<font face=Arial size=2>36 mins</font>","<font face=Arial size=2>40 mins</font>");comm="";valu="";ques10 = new Question(
						"Question10",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>There is a circular patharound a sports field. Priya takes 18 minutes to drive one round of the field,while Ravish takes 12 minutes for the same. Suppose they both start at the samepoint and at the same time, and go in the same direction. After how manyminutes will they meet again at the starting point?</b></font>",
						resp,
						"950",
						"950",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>10</font>","<font face=Arial size=2>11</font>","<font face=Arial size=2>12</font>","<font face=Arial size=2>13</font>");comm="";valu="";ques11 = new Question(
						"Question11",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Find the HCF of 65 and 117</b></font>",
						resp,
						"801",
						"801",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>12</font>","<font face=Arial size=2>21</font>","<font face=Arial size=2>10</font>","<font face=Arial size=2>15</font>");comm="";valu="";ques12 = new Question(
						"Question12",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>In a seminar, the number ofparticipants in Hindi, English, and Mathematics are 60, 84 and 108respectively. Find the minimum number of rooms required if in each room thesame number of participants are to be seated and all of them being in the samesubject</b></font>",
						resp,
						"601",
						"601",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>46</font>","<font face=Arial size=2>64</font>","<font face=Arial size=2>16</font>","<font face=Arial size=2>14</font>");comm="";valu="";ques13 = new Question(
						"Question13",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Find the largest number thatdivides 2053 and 967 and leaves a remainder of 5 and 7 respectively</b></font>",
						resp,
						"607",
						"607",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img width=38 height=19src=\'admin/papers/CH1%20-%20Section%20D%20-%20Options_files/image002.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=33 height=19src=\'admin/papers/CH1%20-%20Section%20D%20-%20Options_files/image004.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=33 height=19src=\'admin/papers/CH1%20-%20Section%20D%20-%20Options_files/image006.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=33 height=19src=\'admin/papers/CH1%20-%20Section%20D%20-%20Options_files/image008.gif\' v:shapes=\'_x0000_i1025\'></font>");comm="";valu="";ques14 = new Question(
						"Question14",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Three sets of English, Hindi,and Mathematics books have to be stacked in such a way that all the books arestored topic-wise and the height of each stack is the same. The number ofEnglish books is 96, the number of Hindi books is 240 and the number ofMathematics books is 336. Assuming that the books are of the same thickness,determine the number of stacks of English, Hindi and Mathematics booksrespectively</b></font>",
						resp,
						"225",
						"225",
						"",
						0,
						0,
						"44gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2,ques3,ques4,ques5,ques6,ques7,ques8,ques9,ques10,ques11,ques12,ques13,ques14);sectionArr0 = new Section(
			"Section 1",
			"1",
			"15",
			"1800",
			"3",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);