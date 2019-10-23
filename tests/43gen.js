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
		}resp=new Array("<font face=Arial size=2>{3, 3}</font>","<font face=Arial size=2>{(1, 3), (2, 3), (3, 3), (1, 4), (2, 4), (3, 4)</font>","<font face=Arial size=2>{(1, 3), (2, 3), (3, 3)} </font>","<font face=Arial size=2>{(1, 3), (2, 3), (3, 3), 4, 3)}</font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If A = {1, 2, 3} and B = {3, 4}, then (A U B) <sub><img src=\'admin/papers/sa1U1(Questions)_files/image015.gif\' alt=\'\' width=\'12\' height=\'13\' /></sub>(A&nbsp;&cap; B) is,</b></font>",
						resp,
						"4705",
						"4705",
						"",
						0,
						0,
						"43gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>&ndash;3,3</font>","<font face=Arial size=2>3,3</font>","<font face=Arial size=2>2,3</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If x<sup>2</sup> = 9, then x = ? </b></font>",
						resp,
						"4784",
						"4784",
						"",
						0,
						0,
						"43gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>one-one</font>","<font face=Arial size=2>onto</font>","<font face=Arial size=2>bijective</font>","<font face=Arial size=2>none of these</font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The function f : R&nbsp;&rarr; R given by f(x) = 3 &ndash; 2 sinx is</b></font>",
						resp,
						"4702",
						"4702",
						"",
						0,
						0,
						"43gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>[0,&pi;]</font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image150.gif\' alt=\'\' width=\'65\' height=\'43\' /></sub></font>","<font face=Arial size=2>[0,1]<sub></sub></font>","<font face=Arial size=2><sub><img src=\'admin/papers/sb2U1(Options)_files/image154.gif\' alt=\'\' width=\'47\' height=\'43\' /></sub></font>");comm="";valu="";ques3 = new Question(
						"Question3",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The largest interval lying in <sub><img src=\'admin/papers/sa1U1(Questions)_files/image124.gif\' alt=\'\' width=\'60\' height=\'43\' /></sub>&nbsp;for which the function <sub><img src=\'admin/papers/sa1U1(Questions)_files/image126.gif\' alt=\'\' width=\'237\' height=\'43\' /></sub>is defined, is</b></font>",
						resp,
						"4678",
						"4678",
						"",
						0,
						0,
						"43gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><sub><img width=16 height=39src=\'admin/papers/sb2U1(Options)_files/image094.gif\' v:shapes=\'_x0000_i1076\'></sub></font>","<font face=Arial size=2><sub><img width=16 height=39src=\'admin/papers/sb2U1(Options)_files/image096.gif\' v:shapes=\'_x0000_i1077\'></sub></font>","<font face=Arial size=2><sub><img width=16 height=39src=\'admin/papers/sb2U1(Options)_files/image098.gif\' v:shapes=\'_x0000_i1078\'></sub></font>","<font face=Arial size=2><sub><img width=13 height=13src=\'admin/papers/sb2U1(Options)_files/image100.gif\' v:shapes=\'_x0000_i1079\'></sub></font>");comm="";valu="";ques4 = new Question(
						"Question4",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The period of the function f(x) = cos<sup>2 </sup>3x+ tan 4x is</b></font>",
						resp,
						"4734",
						"4734",
						"",
						0,
						0,
						"43gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2,ques3,ques4);sectionArr0 = new Section(
			"Section 1",
			"1",
			"5",
			"1800",
			"1",
			"1",
			0,
			0);
		sectionArr = new Array (sectionArr0);