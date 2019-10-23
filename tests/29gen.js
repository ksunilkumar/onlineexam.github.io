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
		}resp=new Array("<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U11SCOption_files/image054.gif\' alt=\'\' width=\'80\' height=\'39\' /></sub></font>","<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U11SCOption_files/image056.gif\' alt=\'\' width=\'81\' height=\'39\' /></sub></font>","<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U11SCOption_files/image058.gif\' alt=\'\' width=\'80\' height=\'39\' /></sub></font>","<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U11SCOption_files/image060.gif\' alt=\'\' width=\'80\' height=\'39\' /></sub></font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>tan<sup>-1</sup> <sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U11SCQuestion_files/image028.gif\' alt=\'\' width=\'131\' height=\'49\' /></sub></b></font>",
						resp,
						"119",
						"119",
						"",
						0,
						0,
						"29gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1</font>","<font face=Arial size=2>-1</font>","<font face=Arial size=2>0</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If x = 0, the value of &nbsp;<img style=\"vertical-align: middle;\" src=\"admin/papers/U11SAQuestion_files/image018.gif\" alt=\"\" width=\"139\" height=\"25\" />&nbsp;is,</b></font>",
						resp,
						"71",
						"71",
						"",
						0,
						0,
						"29gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1+x </font>","<font face=Arial size=2>1</font>","<font face=Arial size=2>x</font>","<font face=Arial size=2>1-x</font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <sub><img width=219 height=39src=\'admin/papers/U11SCQuestion_files/image012.gif\' v:shapes=\'_x0000_i1030\'></sub></b></font>",
						resp,
						"113",
						"113",
						"",
						0,
						0,
						"29gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1</font>","<font face=Arial size=2>0</font>","<font face=Arial size=2>2</font>","<font face=Arial size=2>-1</font>");comm="";valu="";ques3 = new Question(
						"Question3",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The value of <img style=\"vertical-align: top;\" src=\"admin/papers/U11SAQuestion_files/image036.gif\" alt=\"\" width=\"180\" height=\"17\" /><sub>&nbsp;</sub>is</b></font>",
						resp,
						"80",
						"80",
						"",
						0,
						0,
						"29gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>x</font>","<font face=Arial size=2><sub><img src=\'admin/papers/U11SBOption_files/image010.gif\' alt=\'\' width=\'19\' height=\'21\' /></sub></font>","<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U11SBOption_files/image012.gif\' alt=\'\' width=\'16\' height=\'39\' /></sub></font>","<font face=Arial size=2><sub><img style=\'vertical-align: middle;\' src=\'admin/papers/U11SBOption_files/image014.gif\' alt=\'\' width=\'16\' height=\'39\' /></sub></font>");comm="";valu="";ques4 = new Question(
						"Question4",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <sub><img src=\'admin/papers/U11SBQuestion_files/image008.gif\' alt=\'\' width=\'223\' height=\'25\' /></sub> </b></font>",
						resp,
						"89",
						"89",
						"",
						0,
						0,
						"29gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2,ques3,ques4);sectionArr0 = new Section(
			"Section 1",
			"1",
			"5",
			"180",
			"1",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);