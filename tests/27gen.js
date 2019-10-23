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
		}resp=new Array("<font face=Arial size=2>2x + 3</font>","<font face=Arial size=2>2x + 2</font>","<font face=Arial size=2>2x + 1</font>","<font face=Arial size=2>2x + 4 </font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If f(x) = 2x then f(x + 1) =?</b></font>",
						resp,
						"24537",
						"24537",
						"",
						0,
						0,
						"27gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U1SCOption_files/image036.gif\' alt=\'\' width=\'16\' height=\'39\' /></sub></font>","<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U1SCOption_files/image038.gif\' alt=\'\' width=\'16\' height=\'39\' /></sub></font>","<font face=Arial size=2>3x</font>","<font face=Arial size=2>None of these</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Find the inverse of the function f : R &ndash; {0}&nbsp;&rarr; R &ndash; {0} given by f(x) = <sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U1SCQuestion_files/image022.gif\' alt=\'\' width=\'16\' height=\'39\' /></sub></b></font>",
						resp,
						"24585",
						"24585",
						"",
						0,
						0,
						"27gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1</font>","<font face=Arial size=2>0</font>","<font face=Arial size=2>2</font>","<font face=Arial size=2>-1</font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The value of <img style=\"vertical-align: top;\" src=\"admin/papers/U11SAQuestion_files/image036.gif\" alt=\"\" width=\"180\" height=\"17\" /><sub>&nbsp;</sub>is</b></font>",
						resp,
						"80",
						"80",
						"",
						0,
						0,
						"27gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>sec A</font>","<font face=Arial size=2>sin A</font>","<font face=Arial size=2>cosec A</font>","<font face=Arial size=2>cos A</font>");comm="";valu="";ques3 = new Question(
						"Question3",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>(sec A + tan A) (1 &ndash; sin A) =</b></font>",
						resp,
						"101",
						"101",
						"",
						0,
						0,
						"27gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2,ques3);sectionArr0 = new Section(
			"Section 1",
			"1",
			"4",
			"120",
			"1",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);