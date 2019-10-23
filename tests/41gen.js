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
		}resp=new Array("<font face=Arial size=2>is from A to C</font>","<font face=Arial size=2>is from C to A</font>","<font face=Arial size=2>does not exist</font>","<font face=Arial size=2>None of these</font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If R is a relation from aset  A to a set B and S is a relationfrom set B to set C, then the relation <sub><img width=37 height=17src=\'admin/papers/sa1U1(Questions)_files/image134.gif\' v:shapes=\'_x0000_i1094\'></sub></b></font>",
						resp,
						"4684",
						"4684",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{(1,3),(2,2),(3,2),(2,1),(2,3)}</font>","<font face=Arial size=2>{(3,2),(1,3)}</font>","<font face=Arial size=2>{(2,3),(3,2),(2,2)}</font>","<font face=Arial size=2>{(2,3),(3,2)}</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let R = {(1, 3), (2, 2), (3, 2)} and S = {(2, 1), (3, 2), (2, 3)} be two relations on set A = {1, 2, 3}. Then <sub><img src=\'admin/papers/sa1U1(Questions)_files/image077.gif\' alt=\'\' width=\'33\' height=\'17\' />&nbsp;</sub>is equal to</b></font>",
						resp,
						"4742",
						"4742",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>dom&nbsp;R&cap;R\'[4,4]</font>","<font face=Arial size=2>range&nbsp;R&cap;R\'=[0,4]</font>","<font face=Arial size=2>range&nbsp;R&cap;R\'=[0,5]</font>","<font face=Arial size=2>R&cap;R\'does not define a function</font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let R = {(x, y) : x, y&nbsp;&epsilon; R, x<sup>2 </sup>+ y<sup>2 </sup><sub><img src=\'admin/papers/sa1U1(Questions)_files/image095.gif\' alt=\'\' width=\'13\' height=\'15\' /></sub>25}, R\' = {(x, y) : x, y&nbsp;&epsilon; R, <sub><img src=\'admin/papers/sa1U1(Questions)_files/image097.gif\' alt=\'\' width=\'52\' height=\'39\' /></sub>} then</b></font>",
						resp,
						"4727",
						"4727",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>240</font>","<font face=Arial size=2>20</font>","<font face=Arial size=2>100</font>","<font face=Arial size=2>120</font>");comm="";valu="";ques3 = new Question(
						"Question3",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let A and B be two sets such that n(A) = 70, n(B) = 60, and n(A U B) = 110. Then n(A&nbsp;&cap; B) is equal to</b></font>",
						resp,
						"4782",
						"4782",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2&pi;</font>","<font face=Arial size=2>&pi;</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image102.gif\' alt=\'\' width=\'15\' height=\'36\' /></sub></font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques4 = new Question(
						"Question4",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The period of the function&nbsp; <sub><img src=\'admin/papers/sa1U1(Questions)_files/image087.gif\' alt=\'\' width=\'92\' height=\'23\' /></sub>&nbsp;is</b></font>",
						resp,
						"4732",
						"4732",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>[f(x)]<sup>2</sup> + [g(x)]<sup>2</sup> = 0</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image178.gif\' alt=\'\' width=\'33\' height=\'43\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image180.gif\' alt=\'\' width=\'33\' height=\'43\' /></sub></font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques5 = new Question(
						"Question5",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If A = {x : f(x) = 0} and B = {x : g(x) = 0}, then A&nbsp;&cap; B will be</b></font>",
						resp,
						"4689",
						"4689",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>AUB=&Phi;</font>","<font face=Arial size=2>A&cap;B=&Phi;</font>","<font face=Arial size=2>A&cap;B&ne;&Phi;</font>","<font face=Arial size=2>A&ndash;B=A</font>");comm="";valu="";ques6 = new Question(
						"Question6",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Two sets A, B are disjoint if</b></font>",
						resp,
						"4815",
						"4815",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>one-one but not onto</font>","<font face=Arial size=2>onto but not one-one</font>","<font face=Arial size=2>both one-one and onto</font>","<font face=Arial size=2>neitherone-one nor onto</font>");comm="";valu="";ques7 = new Question(
						"Question7",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>A function f from theset of natural numbers to integers defined by <sub><img width=180 height=80src=\'admin/papers/sa1U1(Questions)_files/image142.gif\' v:shapes=\'_x0000_i1098\'></sub> is,</b></font>",
						resp,
						"4693",
						"4693",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>4</font>","<font face=Arial size=2>6</font>","<font face=Arial size=2>8</font>","<font face=Arial size=2>7</font>");comm="";valu="";ques8 = new Question(
						"Question8",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Given the relation R = {(1, 2), (2, 3)} on the set A ={1, 2, 3}. What is the minimum number of ordered   pairs required to change R as an equivalencerelation?</b></font>",
						resp,
						"4771",
						"4771",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>3</font>","<font face=Arial size=2>8</font>","<font face=Arial size=2>7</font>","<font face=Arial size=2>noneof these</font>");comm="";valu="";ques9 = new Question(
						"Question9",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If A = {x :x = n<sup>2</sup>, n = 1, 2, 3}, then number of proper subsets of A is</b></font>",
						resp,
						"4703",
						"4703",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{i,&ndash;i}</font>","<font face=Arial size=2>{&ndash;i,i}</font>","<font face=Arial size=2>{&ndash;1,1,i,&ndash;i}</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques10 = new Question(
						"Question10",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If A = {x : x<sup>2 </sup>&nbsp;= 1} and B = {x : x<sup>4 </sup>&nbsp;= 1}, then A &Delta; B is equal to</b></font>",
						resp,
						"4805",
						"4805",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>&ndash;3,3</font>","<font face=Arial size=2>3,3</font>","<font face=Arial size=2>2,3</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques11 = new Question(
						"Question11",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If x<sup>2</sup> = 9, then x = ? </b></font>",
						resp,
						"4784",
						"4784",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>&nbsp;n<sup>3</sup></font>","<font face=Arial size=2>n(n &ndash; 1)<sup>2</sup></font>","<font face=Arial size=2>n<sup>2 </sup>(n &ndash; 2)</font>","<font face=Arial size=2>n<sup>3</sup> &ndash; 3n<sup>2 </sup>+ 2n</font>");comm="";valu="";ques12 = new Question(
						"Question12",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If n(A) = n then n{(x, y, z); x, y, z&nbsp;&epsilon; A,&nbsp; x &ne; y, y &ne; z, z &ne; x} is</b></font>",
						resp,
						"4696",
						"4696",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{2,3,5,7}</font>","<font face=Arial size=2>{2,3,5,11}</font>","<font face=Arial size=2>{2,3,5,7,11,13}</font>","<font face=Arial size=2>{4,9,25,49,121,169}</font>");comm="";valu="";ques13 = new Question(
						"Question13",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The range of the relation R = {(x, x<sup>2</sup>):x is a prime number less than 15} is</b></font>",
						resp,
						"4806",
						"4806",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>naturalnumbers</font>","<font face=Arial size=2>integers</font>","<font face=Arial size=2>rational numbers</font>","<font face=Arial size=2>irrational numbers</font>");comm="";valu="";ques14 = new Question(
						"Question14",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>&#960; and e are</b></font>",
						resp,
						"4772",
						"4772",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>63</font>","<font face=Arial size=2>65</font>","<font face=Arial size=2>67</font>","<font face=Arial size=2>68</font>");comm="";valu="";ques15 = new Question(
						"Question15",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If  f(x) isa polynomial satisfying <sub><img width=153 height=43src=\'admin/papers/sa1U1(Questions)_files/image025.gif\' v:shapes=\'_x0000_i1037\'></sub> and f(3)= 28, then f(4) is given by</b></font>",
						resp,
						"4795",
						"4795",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image036.gif\' alt=\'\' width=\'51\' height=\'40\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image038.gif\' alt=\'\' width=\'51\' height=\'40\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image040.gif\' alt=\'\' width=\'51\' height=\'44\' /></sub></font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques16 = new Question(
						"Question16",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <sub><img src=\'admin/papers/sa1U1(Questions)_files/image023.gif\' alt=\'\' width=\'159\' height=\'43\' /></sub>&nbsp;then f(x<sup>2</sup>)is</b></font>",
						resp,
						"4796",
						"4796",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>f(x)</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image140.gif\' alt=\'\' width=\'33\' height=\'43\' /></sub></font>","<font face=Arial size=2>&ndash;f(x)</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image142.gif\' alt=\'\' width=\'33\' height=\'43\' /></sub></font>");comm="";valu="";ques17 = new Question(
						"Question17",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If f(x) = <sub><img src=\'admin/papers/sa1U1(Questions)_files/image109.gif\' alt=\'\' width=\'87\' height=\'39\' /></sub>then f <sup>-1</sup>(x) =</b></font>",
						resp,
						"4721",
						"4721",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>0 &lt; x&nbsp;&le; 1</font>","<font face=Arial size=2> 0 &le; x &le; 1</font>","<font face=Arial size=2> &ndash;&infin; &lt; x &lt; 1</font>","<font face=Arial size=2>&ndash;&infin; &lt; x &le; 0</font>");comm="";valu="";ques18 = new Question(
						"Question18",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The domain of definition of the function y(x) given by the equation a<sup>x</sup> + a<sup>y</sup> = a (a &gt; 1) is</b></font>",
						resp,
						"4695",
						"4695",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>x<sup>3</sup>&ndash;4</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image034.gif\' alt=\'\' width=\'43\' height=\'39\' /></sub></font>","<font face=Arial size=2>x&ndash;2</font>","<font face=Arial size=2>x<sup>2</sup>&ndash;2</font>");comm="";valu="";ques19 = new Question(
						"Question19",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <sub><img src=\'admin/papers/sa1U1(Questions)_files/image017.gif\' alt=\'\' width=\'120\' height=\'43\' /></sub>, x &epsilon; R &ndash; {0}, then find the value of f(x)</b></font>",
						resp,
						"4798",
						"4798",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image042.gif\' alt=\'\' width=\'119\' height=\'43\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image044.gif\' alt=\'\' width=\'119\' height=\'43\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image046.gif\' alt=\'\' width=\'56\' height=\'43\' /></sub></font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques20 = new Question(
						"Question20",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Part of the domain of the function <sub><img src=\'admin/papers/sa1U1(Questions)_files/image027.gif\' alt=\'\' width=\'137\' height=\'60\' /></sub>&nbsp;lying in the interval [&ndash;1, 6] is</b></font>",
						resp,
						"4793",
						"4793",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>(3,6)</font>","<font face=Arial size=2>(6,3)</font>","<font face=Arial size=2>(2,3)</font>","<font face=Arial size=2>(4,3)</font>");comm="";valu="";ques21 = new Question(
						"Question21",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let A and B be two sets with m and n elements respectively. If the number of subsets of first set is 56 more than the number of subsets of the second one, then (m, n) is</b></font>",
						resp,
						"4810",
						"4810",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>8</font>","<font face=Arial size=2>2</font>","<font face=Arial size=2>4</font>","<font face=Arial size=2>6</font>");comm="";valu="";ques22 = new Question(
						"Question22",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If n(A) = 8, n(A &cap; B) = 2, then n(A &ndash; B) is equal to</b></font>",
						resp,
						"4744",
						"4744",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>cos2x</font>","<font face=Arial size=2>cosx</font>","<font face=Arial size=2>tan2x</font>","<font face=Arial size=2>tanx</font>");comm="";valu="";ques23 = new Question(
						"Question23",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let f(x) = <sub><img src=\'admin/papers/sa1U1(Questions)_files/image011.gif\' alt=\'\' width=\'48\' height=\'43\' /></sub>&nbsp;Then, <sub><img style=\'vertical-align: baseline;\' src=\'admin/papers/sa1U1(Questions)_files/image013.gif\' alt=\'\' width=\'67\' height=\'20\' /></sub>is equal to </b></font>",
						resp,
						"4811",
						"4811",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>17</font>","<font face=Arial size=2>9</font>","<font face=Arial size=2>11</font>","<font face=Arial size=2>3</font>");comm="";valu="";ques24 = new Question(
						"Question24",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Given n(U) = 20, n(A) = 12, n(B) = 9, n(A<sub><img src=\'admin/papers/sa1U1(Questions)_files/image067.gif\' alt=\'\' width=\'15\' height=\'12\' /></sub>B) = 4, where U is the universal set, A and B are subsets of U, then n<sub><img src=\'admin/papers/sa1U1(Questions)_files/image118.gif\' alt=\'\' width=\'72\' height=\'32\' /></sub> = </b></font>",
						resp,
						"4675",
						"4675",
						"",
						0,
						0,
						"41gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2,ques3,ques4,ques5,ques6,ques7,ques8,ques9,ques10,ques11,ques12,ques13,ques14,ques15,ques16,ques17,ques18,ques19,ques20,ques21,ques22,ques23,ques24);sectionArr0 = new Section(
			"Section 1",
			"1",
			"25",
			"1800",
			"1",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);