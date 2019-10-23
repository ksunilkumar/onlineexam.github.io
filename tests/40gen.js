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
		var zin=1,top=0, mycount=0, waitTime=720 , qright=0, mycomment,nowtime;
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
		}resp=new Array("<font face=Arial size=2>&fnof; is one-one</font>","<font face=Arial size=2>&fnof; is onto</font>","<font face=Arial size=2>&fnof; is one-one but not onto</font>","<font face=Arial size=2>&fnof; is one-one and onto</font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let f : X &rarr; Y be a given function, then f<sup> &minus;1 </sup>exists (or f is invertible) if</b></font>",
						resp,
						"24545",
						"24545",
						"",
						0,
						0,
						"40gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>cos 2x </font>","<font face=Arial size=2>cos x </font>","<font face=Arial size=2>tan2x</font>","<font face=Arial size=2>tan x</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let f(x) = <sub><img style=\"vertical-align: middle;\" src=\"admin/papers/U1SBQuestion_files/image002.gif\" alt=\"\" /></sub>. Then f o f (cos x) is equal to</b></font>",
						resp,
						"24559",
						"24559",
						"",
						0,
						0,
						"40gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>f<sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U1SBOption_files/image020.gif\' alt=\'\' width=\'53\' height=\'43\' /></sub></font>","<font face=Arial size=2>f(ab) </font>","<font face=Arial size=2>f<sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U1SBOption_files/image022.gif\' alt=\'\' width=\'53\' height=\'43\' /></sub></font>","<font face=Arial size=2>0</font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If f(x) = log<sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U1SBQuestion_files/image008.gif\' alt=\'\' width=\'48\' height=\'43\' /></sub>, then f(a) + f(b) =</b></font>",
						resp,
						"24564",
						"24564",
						"",
						0,
						0,
						"40gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2);sectionArr0 = new Section(
			"Section 1",
			"1",
			"3",
			"720",
			"1",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);