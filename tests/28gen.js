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
		var zin=1,top=0, mycount=0, waitTime=180 , qright=0, mycomment,nowtime;
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
		}resp=new Array("<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image124.gif\' alt=\'\' width=\'57\' height=\'43\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image126.gif\' alt=\'\' width=\'59\' height=\'43\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image128.gif\' alt=\'\' width=\'44\' height=\'43\' /></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image130.gif\' alt=\'\' width=\'44\' height=\'43\' /></sub></font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let f : (&ndash;1, 1)&nbsp;&rarr; B be a function defined by f(x) = <sub><img src=\'admin/papers/sa1U1(Questions)_files/image099.gif\' alt=\'\' width=\'85\' height=\'43\' /></sub>, then f is both one-one and onto when B is the interval</b></font>",
						resp,
						"4724",
						"4724",
						"",
						0,
						0,
						"28gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1+2i</font>","<font face=Arial size=2>–1–2i</font>","<font face=Arial size=2>2+i</font>","<font face=Arial size=2>–1+2i</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The pointrepresented by the complex number  <img width=31 height=17src=\'admin/papers/U2SAEDIT12007_files/image342.gif\' v:shapes=\'_x0000_i1025\'> is rotated about the origin through an angle  <img width=11 height=23src=\'admin/papers/U2SAEDIT12007_files/image344.gif\' v:shapes=\'_x0000_i1025\'>in the clockwisedirection. The new position of the point is</b></font>",
						resp,
						"13600",
						"13600",
						"",
						0,
						0,
						"28gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>There is only one root</font>","<font face=Arial size=2>Sum of the roots is + 1</font>","<font face=Arial size=2>sum of theroots is zero </font>","<font face=Arial size=2>the product of the roots is +4</font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>For the equation <sub> </sub><img width=106 height=18src=\'admin/papers/U2SAEDIT12007_files/image054.gif\' v:shapes=\'_x0000_i1025\'>analyze the four statements below forcorrectness</b></font>",
						resp,
						"13571",
						"13571",
						"",
						0,
						0,
						"28gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2);sectionArr0 = new Section(
			"Section 1",
			"1",
			"3",
			"180",
			"1",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);