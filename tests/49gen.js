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
		var zin=1,top=0, mycount=0, waitTime=120 , qright=0, mycomment,nowtime;
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
		}resp=new Array("<font face=Arial size=2>f(x)=x+<sub><img src=\'admin/papers/sb2U1(Options)_files/image030.gif\' alt=\'\' width=\'15\' height=\'39\' /></sub></font>","<font face=Arial size=2>f(x)=<sub><img src=\'admin/papers/sb2U1(Options)_files/image030.gif\' alt=\'\' width=\'15\' height=\'39\' /></sub>x+1</font>","<font face=Arial size=2>f(x)=<sub><img src=\'admin/papers/sb2U1(Options)_files/image030.gif\' alt=\'\' width=\'15\' height=\'39\' /></sub>x-1</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>A function f : R &rarr; R satisfies the equation f(x) f(y) - f(xy) = x + y for all x, y &epsilon; R and f(1) &gt; 0, then</b></font>",
						resp,
						"4809",
						"4809",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>f:A&rarr;B</font>","<font face=Arial size=2>f:x&rarr;f(x)</font>","<font face=Arial size=2>f is a mapping from A to B</font>","<font face=Arial size=2>f is a function from A to B</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Which of the four statements given below is different from the other?</b></font>",
						resp,
						"4763",
						"4763",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>a function</font>","<font face=Arial size=2>transitive</font>","<font face=Arial size=2>not symmetric</font>","<font face=Arial size=2>reflexive</font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let R = {(1, 3), (4, 2), (2, 4) (2, 3) (3, 1)} be a relation on the set A = {1, 2, 3, 4}. The relation R is</b></font>",
						resp,
						"4824",
						"4824",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>[0,3]</font>","<font face=Arial size=2>[&ndash;1,1]</font>","<font face=Arial size=2>[0,1]</font>","<font face=Arial size=2>[&ndash;1,3]</font>");comm="";valu="";ques3 = new Question(
						"Question3",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If f : R&nbsp;&rarr; S, defined by f(x) = sin x &ndash;<sub><img src=\'admin/papers/sa1U1(Questions)_files/image101.gif\' alt=\'\' width=\'23\' height=\'23\' /></sub>cos x + 1, is onto, then the interval of S is</b></font>",
						resp,
						"4725",
						"4725",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{i,&ndash;i}</font>","<font face=Arial size=2>{&ndash;i,i}</font>","<font face=Arial size=2>{&ndash;1,1,i,&ndash;i}</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques4 = new Question(
						"Question4",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If A = {x : x<sup>2 </sup>&nbsp;= 1} and B = {x : x<sup>4 </sup>&nbsp;= 1}, then A &Delta; B is equal to</b></font>",
						resp,
						"4805",
						"4805",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{x : | x | &lt; 1, x &epsilon; N}</font>","<font face=Arial size=2>{x : | x | = 5, x &epsilon; N}</font>","<font face=Arial size=2>{x : x<sup>2</sup> = 1, x &epsilon; Z}</font>","<font face=Arial size=2>{x : x<sup>2</sup> + 2x + 1 = 0, x &epsilon; R}</font>");comm="";valu="";ques5 = new Question(
						"Question5",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Which of the following is a null set?</b></font>",
						resp,
						"4713",
						"4713",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{0, 1, 2}</font>","<font face=Arial size=2>{0, &ndash;1, &ndash;2}</font>","<font face=Arial size=2>{&ndash;2, &ndash;1, 0, 1, 2}</font>","<font face=Arial size=2> none of these</font>");comm="";valu="";ques6 = new Question(
						"Question6",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If R = {(x, y) | x, y&nbsp;&epsilon; Z, x<sup>2</sup> + y<sup>2</sup> &le; 4} is a relation in Z, then domain of R is</b></font>",
						resp,
						"4688",
						"4688",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image042.gif\' alt=\'\' width=\'119\' height=\'43\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image044.gif\' alt=\'\' width=\'119\' height=\'43\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image046.gif\' alt=\'\' width=\'56\' height=\'43\' /></sub></font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques7 = new Question(
						"Question7",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Part of the domain of the function <sub><img src=\'admin/papers/sa1U1(Questions)_files/image027.gif\' alt=\'\' width=\'137\' height=\'60\' /></sub>&nbsp;lying in the interval [&ndash;1, 6] is</b></font>",
						resp,
						"4793",
						"4793",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>f(x)</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image140.gif\' alt=\'\' width=\'33\' height=\'43\' /></sub></font>","<font face=Arial size=2>&ndash;f(x)</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image142.gif\' alt=\'\' width=\'33\' height=\'43\' /></sub></font>");comm="";valu="";ques8 = new Question(
						"Question8",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If f(x) = <sub><img src=\'admin/papers/sa1U1(Questions)_files/image109.gif\' alt=\'\' width=\'87\' height=\'39\' /></sub>then f <sup>-1</sup>(x) =</b></font>",
						resp,
						"4721",
						"4721",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{(11,10),(13,12)}</font>","<font face=Arial size=2>{(10,11),(12,13)</font>","<font face=Arial size=2>{(10,11),(12,13),(13,12)}</font>","<font face=Arial size=2>noneofthese</font>");comm="";valu="";ques9 = new Question(
						"Question9",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The relation R from A = {11,12, 13} to B = {8, 10, 12} defined by y = x – 1, is</b></font>",
						resp,
						"4740",
						"4740",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>A</font>","<font face=Arial size=2>B</font>","<font face=Arial size=2>&Phi;</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques10 = new Question(
						"Question10",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If A and B are two sets, then A&nbsp;&cap; (A&nbsp;U B)&prime; is equal to</b></font>",
						resp,
						"4816",
						"4816",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>Rv{2n&pi;;n&epsilon;Z}</font>","<font face=Arial size=2>R&ndash;{n&pi;;n&epsilon;Z}</font>","<font face=Arial size=2>R&ndash;{&ndash;&pi;,&pi;}</font>","<font face=Arial size=2>R&ndash;<sub><img src=\'admin/papers/sb2U1(Options)_files/image144.gif\' alt=\'\' width=\'53\' height=\'43\' /></sub></font>");comm="";valu="";ques11 = new Question(
						"Question11",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The domain of the function <sub><img src=\'admin/papers/sa1U1(Questions)_files/image120.gif\' alt=\'\' width=\'124\' height=\'45\' /></sub>&nbsp;is:</b></font>",
						resp,
						"4676",
						"4676",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>x<sup>3</sup>&ndash;4</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image034.gif\' alt=\'\' width=\'43\' height=\'39\' /></sub></font>","<font face=Arial size=2>x&ndash;2</font>","<font face=Arial size=2>x<sup>2</sup>&ndash;2</font>");comm="";valu="";ques12 = new Question(
						"Question12",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <sub><img src=\'admin/papers/sa1U1(Questions)_files/image017.gif\' alt=\'\' width=\'120\' height=\'43\' /></sub>, x &epsilon; R &ndash; {0}, then find the value of f(x)</b></font>",
						resp,
						"4798",
						"4798",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>64</font>","<font face=Arial size=2>32</font>","<font face=Arial size=2>40</font>","<font face=Arial size=2>20</font>");comm="";valu="";ques13 = new Question(
						"Question13",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let S = {0, 1, 5, 4, 7}. Then, the total number of subsets of S is</b></font>",
						resp,
						"4781",
						"4781",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>f(x)=x&ndash;|x|</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image104.gif\' alt=\'\' width=\'220\' height=\'45\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image106.gif\' alt=\'\' width=\'169\' height=\'43\' /></sub></font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques14 = new Question(
						"Question14",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Which of the following functions is non periodic</b></font>",
						resp,
						"4729",
						"4729",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>8</font>","<font face=Arial size=2>2</font>","<font face=Arial size=2>4</font>","<font face=Arial size=2>6</font>");comm="";valu="";ques15 = new Question(
						"Question15",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If n(A) = 8, n(A &cap; B) = 2, then n(A &ndash; B) is equal to</b></font>",
						resp,
						"4744",
						"4744",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><sub><img width=16 height=39src=\'admin/papers/sb2U1(Options)_files/image094.gif\' v:shapes=\'_x0000_i1076\'></sub></font>","<font face=Arial size=2><sub><img width=16 height=39src=\'admin/papers/sb2U1(Options)_files/image096.gif\' v:shapes=\'_x0000_i1077\'></sub></font>","<font face=Arial size=2><sub><img width=16 height=39src=\'admin/papers/sb2U1(Options)_files/image098.gif\' v:shapes=\'_x0000_i1078\'></sub></font>","<font face=Arial size=2><sub><img width=13 height=13src=\'admin/papers/sb2U1(Options)_files/image100.gif\' v:shapes=\'_x0000_i1079\'></sub></font>");comm="";valu="";ques16 = new Question(
						"Question16",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The period of the function f(x) = cos<sup>2 </sup>3x+ tan 4x is</b></font>",
						resp,
						"4734",
						"4734",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>[f(x)]<sup>2</sup> + [g(x)]<sup>2</sup> = 0</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image178.gif\' alt=\'\' width=\'33\' height=\'43\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image180.gif\' alt=\'\' width=\'33\' height=\'43\' /></sub></font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques17 = new Question(
						"Question17",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If A = {x : f(x) = 0} and B = {x : g(x) = 0}, then A&nbsp;&cap; B will be</b></font>",
						resp,
						"4689",
						"4689",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>3</font>","<font face=Arial size=2>1</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image086.gif\' alt=\'\' width=\'15\' height=\'39\' /></sub></font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques18 = new Question(
						"Question18",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let f : N&nbsp;&rarr; R : f(x) = <sub><img src=\'admin/papers/sa1U1(Questions)_files/image069.gif\' alt=\'\' width=\'41\' height=\'39\' /></sub>&nbsp;and g : Q&nbsp;&rarr; R : g(x) = x + 2 be two functions. Then (g<sub><img src=\'admin/papers/sa1U1(Questions)_files/image071.gif\' alt=\'\' width=\'11\' height=\'12\' /></sub>f)<sub><img src=\'admin/papers/sa1U1(Questions)_files/image073.gif\' alt=\'\' width=\'29\' height=\'43\' /></sub> is</b></font>",
						resp,
						"4752",
						"4752",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>4</font>","<font face=Arial size=2>6</font>","<font face=Arial size=2>8</font>","<font face=Arial size=2>7</font>");comm="";valu="";ques19 = new Question(
						"Question19",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Given the relation R = {(1, 2), (2, 3)} on the set A ={1, 2, 3}. What is the minimum number of ordered   pairs required to change R as an equivalencerelation?</b></font>",
						resp,
						"4771",
						"4771",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>f is one-one</font>","<font face=Arial size=2>f is onto</font>","<font face=Arial size=2>f is one-one but not onto</font>","<font face=Arial size=2>f is one-one and onto</font>");comm="";valu="";ques20 = new Question(
						"Question20",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let f : X &rarr; Y be a given function, then f <sup>&minus;1 </sup>exists (or f is invertible) if;</b></font>",
						resp,
						"4813",
						"4813",
						"",
						0,
						0,
						"49gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2,ques3,ques4,ques5,ques6,ques7,ques8,ques9,ques10,ques11,ques12,ques13,ques14,ques15,ques16,ques17,ques18,ques19,ques20);sectionArr0 = new Section(
			"Section 1",
			"1",
			"21",
			"120",
			"1",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);