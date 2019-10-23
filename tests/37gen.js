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
		}resp=new Array("<font face=Arial size=2>R<sup>-1</sup> = - R</font>","<font face=Arial size=2>R<sup>-1</sup> = R</font>","<font face=Arial size=2>R<sup>-1</sup>&nbsp;&ne; R</font>","<font face=Arial size=2>None of these</font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If R is a relation on a set A (A&nbsp;&ne; &Phi;), R is symmetric if</b></font>",
						resp,
						"24583",
						"24583",
						"",
						0,
						0,
						"37gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><sub><img src=\'admin/papers/U1SCOption_files/image0101.gif\' alt=\'\' /></sub></font>","<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U1SCOption_files/image0121.gif\' alt=\'\' width=\'165\' height=\'54\' /></sub></font>","<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U1SCOption_files/image0141.gif\' alt=\'\' width=\'158\' height=\'54\' /></sub></font>","<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U1SCOption_files/image0161.gif\' alt=\'\' width=\'117\' height=\'56\' /></sub>&nbsp;</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Let f : [0, 1]&nbsp;&rarr; [0, 1] defined by f(x) =<sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U1SCQuestion_files/image006.gif\' alt=\'\' width=\'40\' height=\'40\' /></sub> , 0&nbsp;&le; x&nbsp;&le; 1 and let g :&nbsp; [0, 1]&nbsp;&rarr; [0, 1]&nbsp; be defined g(x) = 4x (1 - x), 0&nbsp;&le; x&nbsp;&le; 1 then fog and gof is</b></font>",
						resp,
						"24576",
						"24576",
						"",
						0,
						0,
						"37gen",
						"1",
						0
						);questions = new Array (ques0,ques1);sectionArr0 = new Section(
			"Section 1",
			"1",
			"2",
			"720",
			"1",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);