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
		var zin=1,top=0, mycount=0, waitTime=1200 , qright=0, mycomment,nowtime;
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
		}resp=new Array("<font face=Arial size=2>{x : x &lt; 0, x&nbsp;&ne; -6}</font>","<font face=Arial size=2>{x : x &gt; 0, x &ne; 1 , x &ne; 6}</font>","<font face=Arial size=2>{x : x &gt; 1, x &ne; 6}</font>","<font face=Arial size=2>{x : x &ge; 1, x &ne; 6}</font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The domain of definition of <sub><img src=\'admin/papers/sa1U1(Questions)_files/image144.gif\' alt=\'\' width=\'203\' height=\'47\' /></sub>is</b></font>",
						resp,
						"4698",
						"4698",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2xy</font>","<font face=Arial size=2>2(x<sup>2</sup>&ndash;y<sup>2</sup>)</font>","<font face=Arial size=2>x<sup>2</sup>&ndash;y<sup>2</sup></font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If f(x + 3y, x &ndash; 3y) = 12xy, then f(x, y)is</b></font>",
						resp,
						"4794",
						"4794",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2<sup>5</sup></font>","<font face=Arial size=2>2<sup>10</sup>&ndash;1</font>","<font face=Arial size=2>2<sup>12</sup>&ndash;1</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>A and B are two sets having 3 and 4 elements respectively and having 2 elements in common.The number of relation which can be defined from A to B is</b></font>",
						resp,
						"4817",
						"4817",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>f(x<sup>2</sup>) = (f(x))<sup>2 </sup></font>","<font face=Arial size=2><sub><img width=91 height=24src=\'admin/papers/sb2U1(Options)_files/image176.gif\' v:shapes=\'_x0000_i1119\'></sub></font>","<font face=Arial size=2>f(x + y) = f(x) + f(y) </font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques3 = new Question(
						"Question3",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let f(x) = | x – a |, <sub><img width=33 height=17src=\'admin/papers/sa1U1(Questions)_files/image132.gif\' v:shapes=\'_x0000_i1093\'></sub> then </b></font>",
						resp,
						"4683",
						"4683",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{0, 1, 2}</font>","<font face=Arial size=2>{0, &ndash;1, &ndash;2}</font>","<font face=Arial size=2>{&ndash;2, &ndash;1, 0, 1, 2}</font>","<font face=Arial size=2> none of these</font>");comm="";valu="";ques4 = new Question(
						"Question4",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If R = {(x, y) | x, y&nbsp;&epsilon; Z, x<sup>2</sup> + y<sup>2</sup> &le; 4} is a relation in Z, then domain of R is</b></font>",
						resp,
						"4688",
						"4688",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2 and 4</font>","<font face=Arial size=2>2 and 3</font>","<font face=Arial size=2>2 and 1</font>","<font face=Arial size=2>64 and 1</font>");comm="";valu="";ques5 = new Question(
						"Question5",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Two finite sets A and B have elements m and n respectively. The total number of relations from A to B is 64, then the possible values of m and n are:</b></font>",
						resp,
						"4801",
						"4801",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>Rv{2n&pi;;n&epsilon;Z}</font>","<font face=Arial size=2>R&ndash;{n&pi;;n&epsilon;Z}</font>","<font face=Arial size=2>R&ndash;{&ndash;&pi;,&pi;}</font>","<font face=Arial size=2>R&ndash;<sub><img src=\'admin/papers/sb2U1(Options)_files/image144.gif\' alt=\'\' width=\'53\' height=\'43\' /></sub></font>");comm="";valu="";ques6 = new Question(
						"Question6",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The domain of the function <sub><img src=\'admin/papers/sa1U1(Questions)_files/image120.gif\' alt=\'\' width=\'124\' height=\'45\' /></sub>&nbsp;is:</b></font>",
						resp,
						"4676",
						"4676",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1</font>","<font face=Arial size=2>5</font>","<font face=Arial size=2>6</font>","<font face=Arial size=2>10</font>");comm="";valu="";ques7 = new Question(
						"Question7",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If &lsquo;+&rsquo; and &lsquo;*&rsquo; are two binary operations defined on A = {1, 2, 3, 5, 6, 10, 15, 30} given by a + b = LCM (a, b),&nbsp; a * b = HCF (a, b) and a\' =<sub><img src=\'admin/papers/sa1U1(Questions)_files/image063.gif\' alt=\'\' width=\'21\' height=\'39\' /></sub>, then (6\' + 30\') * 5 is equal to</b></font>",
						resp,
						"4759",
						"4759",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>[0,&pi;]</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image150.gif\' alt=\'\' width=\'65\' height=\'43\' /></sub></font>","<font face=Arial size=2>[0,1]<sub></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image154.gif\' alt=\'\' width=\'47\' height=\'43\' /></sub></font>");comm="";valu="";ques8 = new Question(
						"Question8",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The largest interval lying in <sub><img src=\'admin/papers/sa1U1(Questions)_files/image124.gif\' alt=\'\' width=\'60\' height=\'43\' /></sub>&nbsp;for which the function <sub><img src=\'admin/papers/sa1U1(Questions)_files/image126.gif\' alt=\'\' width=\'237\' height=\'43\' /></sub>is defined, is</b></font>",
						resp,
						"4678",
						"4678",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{2, &ndash;2}</font>","<font face=Arial size=2>{&ndash;2}</font>","<font face=Arial size=2>&Phi;</font>","<font face=Arial size=2>{2}</font>");comm="";valu="";ques9 = new Question(
						"Question9",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If f : R&nbsp;&rarr; R is defined by f(x) = x<sup>3</sup> + 1, then f <sup>-1</sup>(9) is equal to</b></font>",
						resp,
						"4710",
						"4710",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>R U S is an equivalence relation in A</font>","<font face=Arial size=2>R &cap; S is an equivalence relation in A</font>","<font face=Arial size=2>R&ndash;S is an equivalence relation in A</font>","<font face=Arial size=2>none of the above</font>");comm="";valu="";ques10 = new Question(
						"Question10",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let R and S be two equivalence relations in a set A, then</b></font>",
						resp,
						"4766",
						"4766",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>dom&nbsp;R&cap;R\'[4,4]</font>","<font face=Arial size=2>range&nbsp;R&cap;R\'=[0,4]</font>","<font face=Arial size=2>range&nbsp;R&cap;R\'=[0,5]</font>","<font face=Arial size=2>R&cap;R\'does not define a function</font>");comm="";valu="";ques11 = new Question(
						"Question11",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let R = {(x, y) : x, y&nbsp;&epsilon; R, x<sup>2 </sup>+ y<sup>2 </sup><sub><img src=\'admin/papers/sa1U1(Questions)_files/image095.gif\' alt=\'\' width=\'13\' height=\'15\' /></sub>25}, R\' = {(x, y) : x, y&nbsp;&epsilon; R, <sub><img src=\'admin/papers/sa1U1(Questions)_files/image097.gif\' alt=\'\' width=\'52\' height=\'39\' /></sub>} then</b></font>",
						resp,
						"4727",
						"4727",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2x+3</font>","<font face=Arial size=2>2x+2</font>","<font face=Arial size=2>2x+1</font>","<font face=Arial size=2>2x+4</font>");comm="";valu="";ques12 = new Question(
						"Question12",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If f(x) = 2x, then f(x + 1) = ?</b></font>",
						resp,
						"4783",
						"4783",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>4</font>","<font face=Arial size=2>6</font>","<font face=Arial size=2>8</font>","<font face=Arial size=2>7</font>");comm="";valu="";ques13 = new Question(
						"Question13",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Given the relation R = {(1, 2), (2, 3)} on the set A ={1, 2, 3}. What is the minimum number of ordered   pairs required to change R as an equivalencerelation?</b></font>",
						resp,
						"4771",
						"4771",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>{i,&ndash;i}</font>","<font face=Arial size=2>{&ndash;i,i}</font>","<font face=Arial size=2>{&ndash;1,1,i,&ndash;i}</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques14 = new Question(
						"Question14",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If A = {x : x<sup>2 </sup>&nbsp;= 1} and B = {x : x<sup>4 </sup>&nbsp;= 1}, then A &Delta; B is equal to</b></font>",
						resp,
						"4805",
						"4805",
						"",
						0,
						0,
						"42gen",
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
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>dom f &ne;&nbsp;&phi; and dom g &ne; &phi;</font>","<font face=Arial size=2>dom f &ne; &phi;&nbsp;and dom g = &phi;</font>","<font face=Arial size=2>f and g have the same domain</font>","<font face=Arial size=2>dom f = &phi; and dom g = &phi;</font>");comm="";valu="";ques16 = new Question(
						"Question16",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Given <sub><img src=\'admin/papers/sa1U1(Questions)_files/image089.gif\' alt=\'\' width=\'96\' height=\'44\' /></sub>&nbsp;and <sub><img src=\'admin/papers/sa1U1(Questions)_files/image091.gif\' alt=\'\' width=\'96\' height=\'44\' /></sub>then</b></font>",
						resp,
						"4733",
						"4733",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>cos2x</font>","<font face=Arial size=2>cosx</font>","<font face=Arial size=2>tan2x</font>","<font face=Arial size=2>tanx</font>");comm="";valu="";ques17 = new Question(
						"Question17",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let f(x) = <sub><img src=\'admin/papers/sa1U1(Questions)_files/image011.gif\' alt=\'\' width=\'48\' height=\'43\' /></sub>&nbsp;Then, <sub><img style=\'vertical-align: baseline;\' src=\'admin/papers/sa1U1(Questions)_files/image013.gif\' alt=\'\' width=\'67\' height=\'20\' /></sub>is equal to </b></font>",
						resp,
						"4811",
						"4811",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2x+10</font>","<font face=Arial size=2>x&ndash;10</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image082.gif\' alt=\'\' width=\'43\' height=\'39\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image084.gif\' alt=\'\' width=\'41\' height=\'39\' /></sub></font>");comm="";valu="";ques18 = new Question(
						"Question18",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If f : R &rarr; R is a function defined by f(x) = 2x + 10, then the inverse of f is</b></font>",
						resp,
						"4760",
						"4760",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>n(AU(BUC)) = 5</font>","<font face=Arial size=2>n(D) = 6</font>","<font face=Arial size=2>n(B U C) = 5</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques19 = new Question(
						"Question19",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If A = {x : x &epsilon; I, &ndash;2 &le; x&nbsp;&le; 2}, B = {x : x &epsilon; I, 0 &le; x &le; 3}, C = {x : x&nbsp;&epsilon; N, 1 &le; x &le; 2} and D = {(x, y) &epsilon; N x N; x + y = 8}. Then</b></font>",
						resp,
						"4697",
						"4697",
						"",
						0,
						0,
						"42gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2,ques3,ques4,ques5,ques6,ques7,ques8,ques9,ques10,ques11,ques12,ques13,ques14,ques15,ques16,ques17,ques18,ques19);sectionArr0 = new Section(
			"Section 1",
			"1",
			"20",
			"1200",
			"1",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);