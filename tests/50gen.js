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
		}resp=new Array("<font face=Arial size=2>reflexive</font>","<font face=Arial size=2>symmetric</font>","<font face=Arial size=2>transitive</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let A = {2, 3, 4, 5} and R = {(2, 2), (3, 3), (4, 4), (5, 5)} be a relation in A. Then R is</b></font>",
						resp,
						"4741",
						"4741",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>80%</font>","<font face=Arial size=2>40%</font>","<font face=Arial size=2>60%</font>","<font face=Arial size=2>70%</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>In a city 20percent of the population travels by car, 50 percent by bus and 10 percenttravels by both car and bus. Then the persons traveling by car or bus is</b></font>",
						resp,
						"4714",
						"4714",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>[0,&pi;]</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image150.gif\' alt=\'\' width=\'65\' height=\'43\' /></sub></font>","<font face=Arial size=2>[0,1]<sub></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image154.gif\' alt=\'\' width=\'47\' height=\'43\' /></sub></font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The largest interval lying in <sub><img src=\'admin/papers/sa1U1(Questions)_files/image124.gif\' alt=\'\' width=\'60\' height=\'43\' /></sub>&nbsp;for which the function <sub><img src=\'admin/papers/sa1U1(Questions)_files/image126.gif\' alt=\'\' width=\'237\' height=\'43\' /></sub>is defined, is</b></font>",
						resp,
						"4678",
						"4678",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{(a,c),(a,d),(a,e),(b,e),(b,f)}</font>","<font face=Arial size=2>{(a,e),(a,f),(b,e),(b,f),(c,e),(c,f)}</font>","<font face=Arial size=2>{(a,e),(a,f),(b,e),(b,f)}</font>","<font face=Arial size=2>{(a,e),(a,f),(c,e),(c,f)}</font>");comm="";valu="";ques3 = new Question(
						"Question3",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If&nbsp; A = {a, b, c}, B = {c, d, e, f} and C = {e, f, g, h}, then A x&nbsp;(B &cap; C) equals</b></font>",
						resp,
						"4807",
						"4807",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>x<sup>3</sup>&ndash;4</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image034.gif\' alt=\'\' width=\'43\' height=\'39\' /></sub></font>","<font face=Arial size=2>x&ndash;2</font>","<font face=Arial size=2>x<sup>2</sup>&ndash;2</font>");comm="";valu="";ques4 = new Question(
						"Question4",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <sub><img src=\'admin/papers/sa1U1(Questions)_files/image017.gif\' alt=\'\' width=\'120\' height=\'43\' /></sub>, x &epsilon; R &ndash; {0}, then find the value of f(x)</b></font>",
						resp,
						"4798",
						"4798",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1</font>","<font face=Arial size=2>0</font>","<font face=Arial size=2>–1</font>","<font face=Arial size=2>none</font>");comm="";valu="";ques5 = new Question(
						"Question5",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Sin n&#960; = ?</b></font>",
						resp,
						"4827",
						"4827",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><sub><img width=39 height=39src=\'admin/papers/sb2U1(Options)_files/image002.gif\' v:shapes=\'_x0000_i1025\'></sub></font>","<font face=Arial size=2>f(x)</font>","<font face=Arial size=2>x</font>","<font face=Arial size=2>noneofthese</font>");comm="";valu="";ques6 = new Question(
						"Question6",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If f(x) = <sub><img width=48 height=43src=\'admin/papers/sa1U1(Questions)_files/image002.gif\' v:shapes=\'_x0000_i1025\'></sub> then f [f{f(x)}] = ?</b></font>",
						resp,
						"4825",
						"4825",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{x:x is a real number x<sup>2</sup>&ndash;1=0}</font>","<font face=Arial size=2>{x:x is a real number x<sup>2</sup>+1=0}</font>","<font face=Arial size=2>{x:x is a real number x<sup>2</sup>&ndash;9=0}</font>","<font face=Arial size=2>{x:x is a real number x<sup>2</sup>=x+2}</font>");comm="";valu="";ques7 = new Question(
						"Question7",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Which of the following is the empty set ?</b></font>",
						resp,
						"4778",
						"4778",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2x–5</font>","<font face=Arial size=2>|x|</font>","<font face=Arial size=2>x<sup>2</sup></font>","<font face=Arial size=2>x<sup>2</sup>+1</font>");comm="";valu="";ques8 = new Question(
						"Question8",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Which of the following is a bijective function on the set of real numbers?</b></font>",
						resp,
						"4739",
						"4739",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image190.gif\' alt=\'\' width=\'20\' height=\'20\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image190.gif\' alt=\'\' width=\'20\' height=\'20\' />-1</sub></font>","<font face=Arial size=2>2<sup>n</sup></font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques9 = new Question(
						"Question9",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If a set A has n elements then the number of all relations on A is</b></font>",
						resp,
						"4701",
						"4701",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>equal to one</font>","<font face=Arial size=2>greater thanone</font>","<font face=Arial size=2>zero </font>","<font face=Arial size=2>less than one </font>");comm="";valu="";ques10 = new Question(
						"Question10",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If &nbsp;<img width=100 height=17src=\'admin/papers/U2SAEDIT12007_files/image288.gif\' v:shapes=\'_x0000_i1025\'> for k = 1,2,…n and <img width=144 height=17src=\'admin/papers/U2SAEDIT12007_files/image290.gif\' v:shapes=\'_x0000_i1025\'> then the value of&nbsp; <img width=167 height=17src=\'admin/papers/U2SAEDIT12007_files/image292.gif\' v:shapes=\'_x0000_i1025\'> is:</b></font>",
						resp,
						"5290",
						"5290",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image316.gif\' alt=\'\' width=\'57\' height=\'17\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image318.gif\' alt=\'\' width=\'57\' height=\'17\' />&nbsp; </font>","<font face=Arial size=2>&nbsp; <img src=\'admin/papers/U2SAOptions_final_files/image320.gif\' alt=\'\' width=\'57\' height=\'17\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image322.gif\' alt=\'\' width=\'57\' height=\'17\' /></font>");comm="";valu="";ques11 = new Question(
						"Question11",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let f(x) be a quadratic expression which is positive for all real x. If &nbsp;<img src=\'admin/papers/U2SAEDIT12007_files/image272.gif\' alt=\'\' width=\'187\' height=\'17\' />&nbsp;then for any real x:</b></font>",
						resp,
						"5315",
						"5315",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image324.gif\' alt=\'\' width=\'26\' height=\'19\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image326.gif\' alt=\'\' width=\'26\' height=\'19\' />&nbsp;</font>","<font face=Arial size=2> 5 </font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image166.gif\' alt=\'\' width=\'6\' height=\'25\' /></font>");comm="";valu="";ques12 = new Question(
						"Question12",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The equation <img src=\'admin/papers/U2SAEDIT12007_files/image274.gif\' alt=\'\' width=\'225\' height=\'21\' />represents a circle whose radius is</b></font>",
						resp,
						"5310",
						"5310",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image184.gif\' alt=\'\' width=\'12\' height=\'25\' /></font>","<font face=Arial size=2>4</font>","<font face=Arial size=2>3</font>","<font face=Arial size=2>12</font>");comm="";valu="";ques13 = new Question(
						"Question13",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If one root of the equation <img src=\'admin/papers/U2SAEDIT12007_files/image158.gif\' alt=\'\' width=\'113\' height=\'18\' />is 4, while the equation <img src=\'admin/papers/U2SAEDIT12007_files/image160.gif\' alt=\'\' width=\'106\' height=\'18\' />has equal roots, then the value of &lsquo;q&rsquo; is</b></font>",
						resp,
						"13543",
						"13543",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img width=118 height=18src=\'admin/papers/U2SAOptions_final_files/image070.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=118 height=18src=\'admin/papers/U2SAOptions_final_files/image072.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=126 height=18src=\'admin/papers/U2SAOptions_final_files/image074.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2>None of these</font>");comm="";valu="";ques14 = new Question(
						"Question14",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <img width=61 height=17src=\'admin/papers/U2SAEDIT12007_files/image032.gif\' v:shapes=\'_x0000_i1025\'> and <img width=86 height=18src=\'admin/papers/U2SAEDIT12007_files/image034.gif\' v:shapes=\'_x0000_i1025\'> then a, b are the roots of :</b></font>",
						resp,
						"13578",
						"13578",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image164.gif\' alt=\'\' width=\'6\' height=\'25\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image166.gif\' alt=\'\' width=\'6\' height=\'25\' />&nbsp;</font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image168.gif\' alt=\'\' width=\'6\' height=\'25\' />&nbsp;</font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image170.gif\' alt=\'\' width=\'6\' height=\'25\' /></font>");comm="";valu="";ques15 = new Question(
						"Question15",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If the difference of the roots of the equation &nbsp;<img src=\'admin/papers/U2SAEDIT12007_files/image136.gif\' alt=\'\' width=\'111\' height=\'18\' />&nbsp;is 1, then the value of k is</b></font>",
						resp,
						"13551",
						"13551",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image106.gif\' alt=\'\' width=\'21\' height=\'25\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image108.gif\' alt=\'\' width=\'32\' height=\'25\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image110.gif\' alt=\'\' width=\'31\' height=\'25\' /></font>","<font face=Arial size=2>None</font>");comm="";valu="";ques16 = new Question(
						"Question16",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <img src=\'admin/papers/U2SAEDIT12007_files/image050.gif\' alt=\'\' width=\'39\' height=\'17\' />&nbsp;the roots of <sub>&nbsp;</sub><img src=\'admin/papers/U2SAEDIT12007_files/image052.gif\' alt=\'\' width=\'142\' height=\'18\' /><sub>&nbsp;</sub>are</b></font>",
						resp,
						"13573",
						"13573",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2> <img width=61 height=17src=\'admin/papers/U2SAOptions_final_files/image084.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2> <img width=61 height=17src=\'admin/papers/U2SAOptions_final_files/image086.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2> <img width=61 height=17src=\'admin/papers/U2SAOptions_final_files/image088.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=65 height=17src=\'admin/papers/U2SAOptions_final_files/image090.gif\' v:shapes=\'_x0000_i1025\'></font>");comm="";valu="";ques17 = new Question(
						"Question17",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If the roots of the equation <img width=154 height=19src=\'admin/papers/U2SAEDIT12007_files/image038.gif\' v:shapes=\'_x0000_i1025\'>are equal in magnitude andopposite in sign then</b></font>",
						resp,
						"13577",
						"13577",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>a circle in the complexplane</font>","<font face=Arial size=2>a parabola in the complex plane</font>","<font face=Arial size=2>a straight line in the complexplane</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques18 = new Question(
						"Question18",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If three numbers form an A.P, then they lieon:</b></font>",
						resp,
						"5345",
						"5345",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>x &ndash; iy </font>","<font face=Arial size=2>2x&nbsp; </font>","<font face=Arial size=2> &ndash; 2iy </font>","<font face=Arial size=2> x + iy</font>");comm="";valu="";ques19 = new Question(
						"Question19",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <img src=\'admin/papers/U2SAEDIT12007_files/image144.gif\' alt=\'\' width=\'82\' height=\'18\' />then the value of&nbsp; &nbsp;<img src=\'admin/papers/U2SAEDIT12007_files/image146.gif\' alt=\'\' width=\'39\' height=\'28\' />&nbsp;is</b></font>",
						resp,
						"13547",
						"13547",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>the maximum value</font>","<font face=Arial size=2>the positive minimum value</font>","<font face=Arial size=2>the minimum value</font>","<font face=Arial size=2>none of the above</font>");comm="";valu="";ques20 = new Question(
						"Question20",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let <img src=\'admin/papers/U2SAEDIT12007_files/image330.gif\' alt=\'\' width=\'223\' height=\'18\' />&nbsp;and let the roots &nbsp;<img src=\'admin/papers/U2SAEDIT12007_files/image332.gif\' alt=\'\' width=\'59\' height=\'17\' />&nbsp;be imaginary, then f(x) cannot have:</b></font>",
						resp,
						"13597",
						"13597",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image076.gif\' alt=\'\' width=\'79\' height=\'18\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image078.gif\' alt=\'\' width=\'74\' height=\'18\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image080.gif\' alt=\'\' width=\'59\' height=\'28\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image082.gif\' alt=\'\' width=\'27\' height=\'17\' /></font>");comm="";valu="";ques21 = new Question(
						"Question21",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If the roots of the equation <img src=\'admin/papers/U2SAEDIT12007_files/image036.gif\' alt=\'\' width=\'85\' height=\'27\' />&nbsp;are equal in magnitude but opposite in sign, then the product of the roots is</b></font>",
						resp,
						"13579",
						"13579",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>18</font>","<font face=Arial size=2>54</font>","<font face=Arial size=2>6</font>","<font face=Arial size=2>12</font>");comm="";valu="";ques22 = new Question(
						"Question22",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <img width=98 height=18src=\'admin/papers/U2SAEDIT12007_files/image094.gif\' v:shapes=\'_x0000_i1025\'>where z is a complex number, then the valueof  <img width=352 height=30src=\'admin/papers/U2SAEDIT12007_files/image096.gif\' v:shapes=\'_x0000_i1025\'>is</b></font>",
						resp,
						"13562",
						"13562",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img width=97 height=18src=\'admin/papers/U2SAOptions_final_files/image348.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2> <img width=97 height=18src=\'admin/papers/U2SAOptions_final_files/image350.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2> <img width=96 height=18src=\'admin/papers/U2SAOptions_final_files/image352.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=96 height=18src=\'admin/papers/U2SAOptions_final_files/image354.gif\' v:shapes=\'_x0000_i1025\'></font>");comm="";valu="";ques23 = new Question(
						"Question23",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Given that the equation  <img width=178 height=18src=\'admin/papers/U2SAEDIT12007_files/image282.gif\' v:shapes=\'_x0000_i1025\'>where p, q, r, s are real and non – zero roots, then</b></font>",
						resp,
						"5294",
						"5294",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image092.gif\' alt=\'\' width=\'76\' height=\'17\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image094.gif\' alt=\'\' width=\'33\' height=\'25\' /></font>","<font face=Arial size=2><img src=\'admin/papers/U2SAOptions_final_files/image096.gif\' alt=\'\' width=\'55\' height=\'17\' /></font>","<font face=Arial size=2>None</font>");comm="";valu="";ques24 = new Question(
						"Question24",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The roots of&nbsp; <img src=\'admin/papers/U2SAEDIT12007_files/image046.gif\' alt=\'\' width=\'124\' height=\'18\' />and <img src=\'admin/papers/U2SAEDIT12007_files/image048.gif\' alt=\'\' width=\'137\' height=\'21\' />&nbsp;are simultaneously real then</b></font>",
						resp,
						"13576",
						"13576",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>0 </font>","<font face=Arial size=2>1 </font>","<font face=Arial size=2> 2 </font>","<font face=Arial size=2> &gt; 2</font>");comm="";valu="";ques25 = new Question(
						"Question25",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Thenumber of solution of the equation <img width=175 height=19src=\'admin/papers/U2SAEDIT12007_files/image210.gif\' v:shapes=\'_x0000_i1025\'> is </b></font>",
						resp,
						"13527",
						"13527",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>0</font>","<font face=Arial size=2>2</font>","<font face=Arial size=2>1</font>","<font face=Arial size=2>4</font>");comm="";valu="";ques26 = new Question(
						"Question26",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The number of real roots of <img width=91 height=20src=\'admin/papers/U2SAEDIT12007_files/image354.gif\' v:shapes=\'_x0000_i1025\'>&nbsp;is&nbsp;</b></font>",
						resp,
						"13604",
						"13604",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>–11 </font>","<font face=Arial size=2>11</font>","<font face=Arial size=2>3</font>","<font face=Arial size=2> –3</font>");comm="";valu="";ques27 = new Question(
						"Question27",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If the equation   <img width=110 height=18src=\'admin/papers/U2SAEDIT12007_files/image040.gif\' v:shapes=\'_x0000_i1025\'> and <img width=118 height=18src=\'admin/papers/U2SAEDIT12007_files/image042.gif\' v:shapes=\'_x0000_i1025\'> have a common non-zero root, then thevalue  is</b></font>",
						resp,
						"13574",
						"13574",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1</font>","<font face=Arial size=2>–1</font>","<font face=Arial size=2>i</font>","<font face=Arial size=2>–i</font>");comm="";valu="";ques28 = new Question(
						"Question28",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If z and <img width=14 height=17src=\'admin/papers/U2SAEDIT12007_files/image114.gif\' v:shapes=\'_x0000_i1025\'>are two non-zerocomplex numbers such that <img width=61 height=17src=\'admin/papers/U2SAEDIT12007_files/image306.gif\' v:shapes=\'_x0000_i1025\'>and  <img width=141 height=23src=\'admin/papers/U2SAEDIT12007_files/image308.gif\' v:shapes=\'_x0000_i1025\'>&nbsp;then &nbsp;<img width=22 height=17src=\'admin/papers/U2SAEDIT12007_files/image310.gif\' v:shapes=\'_x0000_i1025\'>is equal to</b></font>",
						resp,
						"5271",
						"5271",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>a straight line parallel tox-axis</font>","<font face=Arial size=2>a parabola</font>","<font face=Arial size=2>a circle of radius 1 and center (1,0)</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques29 = new Question(
						"Question29",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If the imaginary part of the expression  <img width=57 height=28src=\'admin/papers/U2SAEDIT12007_files/image388.gif\' v:shapes=\'_x0000_i1025\'>&nbsp; be zero, then the locus of z is:</b></font>",
						resp,
						"13615",
						"13615",
						"",
						0,
						0,
						"50gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2,ques3,ques4,ques5,ques6,ques7,ques8,ques9,ques10,ques11,ques12,ques13,ques14,ques15,ques16,ques17,ques18,ques19,ques20,ques21,ques22,ques23,ques24,ques25,ques26,ques27,ques28,ques29);sectionArr0 = new Section(
			"Section 1",
			"1",
			"30",
			"1800",
			"1",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);