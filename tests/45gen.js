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
		var zin=1,top=0, mycount=0, waitTime=3600 , qright=0, mycomment,nowtime;
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
		}resp=new Array("<font face=Arial size=2>4:5</font>","<font face=Arial size=2>5:4</font>","<font face=Arial size=2>3:2</font>","<font face=Arial size=2>5:7</font>");comm="";valu="";ques0 = new Question(
						"Question0",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Two isosceles triangles have equal angles and their areasare in the ratio 16:25. The ratio of their corresponding heights is,</b></font>",
						resp,
						"1489",
						"1489",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1</font>","<font face=Arial size=2>2</font>","<font face=Arial size=2>infinitely many</font>","<font face=Arial size=2>0</font>");comm="";valu="";ques1 = new Question(
						"Question1",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>How many tangents can a circle have?</b></font>",
						resp,
						"1486",
						"1486",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>4:5</font>","<font face=Arial size=2>5:7</font>","<font face=Arial size=2>4:7</font>","<font face=Arial size=2>1:6</font>");comm="";valu="";ques2 = new Question(
						"Question2",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Two isosceles triangles have equal vertical angles and theirareas are in the ratio 16:25. Find the ratio of their corresponding heights.</b></font>",
						resp,
						"1552",
						"1552",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2</font>","<font face=Arial size=2>3</font>","<font face=Arial size=2>4</font>","<font face=Arial size=2>5</font>");comm="";valu="";ques3 = new Question(
						"Question3",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>In given figure, <img style=\"vertical-align: middle;\" src=\"admin/papers/CH5%20-%20Section%20B%20-%20Questions_files/image024.gif\" alt=\"\" width=\"58\" height=\"17\" />. If <img style=\"vertical-align: middle;\" src=\"admin/papers/CH5%20-%20Section%20B%20-%20Questions_files/image025.gif\" alt=\"\" width=\"54\" height=\"17\" />, <img style=\"vertical-align: middle;\" src=\"admin/papers/CH5%20-%20Section%20B%20-%20Questions_files/image026.gif\" alt=\"\" width=\"78\" height=\"19\" />, <img style=\"vertical-align: middle;\" src=\"admin/papers/CH5%20-%20Section%20B%20-%20Questions_files/image027.gif\" alt=\"\" width=\"78\" height=\"17\" />&nbsp;&nbsp;and &nbsp;<img style=\"vertical-align: middle;\" src=\"admin/papers/CH5%20-%20Section%20B%20-%20Questions_files/image028.gif\" alt=\"\" width=\"78\" height=\"17\" />, find the value of x<img style=\"vertical-align: middle;\" src=\"admin/papers/CH5%20-%20Section%20B%20-%20Questions_files/image029.jpg\" alt=\"\" width=\"156\" height=\"119\" /></b></font>",
						resp,
						"1498",
						"1498",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>3:4</font>","<font face=Arial size=2>4:3</font>","<font face=Arial size=2>2:3</font>","<font face=Arial size=2>4:5</font>");comm="";valu="";ques4 = new Question(
						"Question4",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The areas of two similar triangles are in respectively 9 cm<sup>2</sup>and 16 cm<sup>2</sup>. The ratio of their corresponding sides is</b></font>",
						resp,
						"1483",
						"1483",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\"admin/papers/CH5%20-%20Section%20C%20-%20options_files/image046.gif\" alt=\"\" width=\"42\" height=\"17\" /> </font>","<font face=Arial size=2>2.5 cm</font>","<font face=Arial size=2>2.6 cm</font>","<font face=Arial size=2><img src=\"admin/papers/CH5%20-%20Section%20C%20-%20options_files/image052.gif\" alt=\"\" width=\"42\" height=\"17\" /></font>");comm="";valu="";ques5 = new Question(
						"Question5",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <img style=\"vertical-align: top;\" src=\"admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image002.gif\" alt=\"\" width=\"87\" height=\"17\" />&nbsp;such that area of<img style=\"vertical-align: top;\" src=\"admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image012.gif\" alt=\"\" width=\"35\" height=\"17\" />&nbsp;is<img style=\"vertical-align: top;\" src=\"admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image022.gif\" alt=\"\" width=\"38\" height=\"18\" />&nbsp;and the area&nbsp;<img style=\"vertical-align: top;\" src=\"admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image024.gif\" alt=\"\" width=\"35\" height=\"17\" />&nbsp;is <img style=\"vertical-align: top;\" src=\"admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image026.gif\" alt=\"\" width=\"46\" height=\"18\" />&nbsp;and <img style=\"vertical-align: top;\" src=\"admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image028.gif\" alt=\"\" width=\"90\" height=\"17\" />.&nbsp; Find the length of EF</b></font>",
						resp,
						"1523",
						"1523",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img width=40 height=17src=\'admin/papers/CH5%20-%20Section%20A%20-%20options_files/image002.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=40 height=17src=\'admin/papers/CH5%20-%20Section%20A%20-%20options_files/image004.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=32 height=17src=\'admin/papers/CH5%20-%20Section%20A%20-%20options_files/image006.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=40 height=17src=\'admin/papers/CH5%20-%20Section%20A%20-%20options_files/image008.gif\' v:shapes=\'_x0000_i1025\'></font>");comm="";valu="";ques6 = new Question(
						"Question6",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>A vertical stick 20 m long casts a shadow 10 m long on theground. At the same time, at a tower casts a shadow 50 m long on the ground.The height of the tower is</b></font>",
						resp,
						"1481",
						"1481",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\'admin/papers/CH5%20-%20Section%20B%20-%20options_files/image016.gif\' alt=\'\' width=\'24\' height=\'17\' /></font>","<font face=Arial size=2><img src=\'admin/papers/CH5%20-%20Section%20B%20-%20options_files/image018.gif\' alt=\'\' width=\'35\' height=\'17\' /></font>","<font face=Arial size=2><img src=\'admin/papers/CH5%20-%20Section%20B%20-%20options_files/image020.gif\' alt=\'\' width=\'24\' height=\'17\' /></font>","<font face=Arial size=2><img src=\'admin/papers/CH5%20-%20Section%20B%20-%20options_files/image022.gif\' alt=\'\' width=\'35\' height=\'17\' /></font>");comm="";valu="";ques7 = new Question(
						"Question7",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>A ladder is placed against a wall such that its foot is at a distance of 2.5&nbsp;m from the wall and its top reaches a window 6 m above the ground. Find the length of the ladder</b></font>",
						resp,
						"1499",
						"1499",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1</font>","<font face=Arial size=2>2</font>","<font face=Arial size=2>3</font>","<font face=Arial size=2>0</font>");comm="";valu="";ques8 = new Question(
						"Question8",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>A tangent to a circle intersects it in ------------point(s).</b></font>",
						resp,
						"1480",
						"1480",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\'admin/papers/CH5%20-%20Section%20C%20-%20options_files/image034.gif\' alt=\'\' width=\'12\' height=\'25\' /></font>","<font face=Arial size=2><img src=\'admin/papers/CH5%20-%20Section%20C%20-%20options_files/image036.gif\' alt=\'\' width=\'12\' height=\'25\' /></font>","<font face=Arial size=2>49</font>","<font face=Arial size=2>36</font>");comm="";valu="";ques9 = new Question(
						"Question9",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image002.gif\' alt=\'\' width=\'87\' height=\'17\' />&nbsp;such that <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image004.gif\' alt=\'\' width=\'87\' height=\'17\' />&nbsp;and <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image006.gif\' alt=\'\' width=\'81\' height=\'17\' />. Find the ratio of areas of <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image008.gif\' alt=\'\' width=\'39\' height=\'17\' />&nbsp;and <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image010.gif\' alt=\'\' width=\'38\' height=\'17\' />.</b></font>",
						resp,
						"1520",
						"1520",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2 cm</font>","<font face=Arial size=2><img src=\"admin/papers/CH5%20-%20Section%20B%20-%20options_files/image004.gif\" alt=\"\" width=\"31\" height=\"17\" /></font>","<font face=Arial size=2><img src=\"admin/papers/CH5%20-%20Section%20B%20-%20options_files/image006.gif\" alt=\"\" width=\"31\" height=\"17\" /></font>","<font face=Arial size=2><img src=\"admin/papers/CH5%20-%20Section%20B%20-%20options_files/image008.gif\" alt=\"\" width=\"39\" height=\"17\" /></font>");comm="";valu="";ques10 = new Question(
						"Question10",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>A point P is<img src=\"admin/papers/CH5%20-%20Section%20B%20-%20Questions_files/image021.gif\" alt=\"\" width=\"42\" height=\"17\" />from the centre of the circle. The length of the tangent drawn from P to the circle is 12cm. find the radius of the circle.</b></font>",
						resp,
						"1496",
						"1496",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2:3</font>","<font face=Arial size=2>4:9</font>","<font face=Arial size=2>81:16</font>","<font face=Arial size=2>16:81</font>");comm="";valu="";ques11 = new Question(
						"Question11",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>Sides of two similar triangles are in the ratio 4:9. Areas ofthese triangles are in the ratio.</b></font>",
						resp,
						"1482",
						"1482",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img src=\'admin/papers/CH5%20-%20Section%20C%20-%20options_files/image038.gif\' alt=\'\' width=\'46\' height=\'18\' /></font>","<font face=Arial size=2><img src=\'admin/papers/CH5%20-%20Section%20C%20-%20options_files/image040.gif\' alt=\'\' width=\'46\' height=\'18\' /></font>","<font face=Arial size=2><img src=\'admin/papers/CH5%20-%20Section%20C%20-%20options_files/image042.gif\' alt=\'\' width=\'46\' height=\'18\' /></font>","<font face=Arial size=2><img src=\'admin/papers/CH5%20-%20Section%20C%20-%20options_files/image044.gif\' alt=\'\' width=\'46\' height=\'18\' /></font>");comm="";valu="";ques12 = new Question(
						"Question12",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>If <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image008.gif\' alt=\'\' width=\'39\' height=\'17\' />&nbsp;is similar to <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image010.gif\' alt=\'\' width=\'38\' height=\'17\' />&nbsp;such that <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image016.gif\' alt=\'\' width=\'63\' height=\'17\' />, <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image018.gif\' alt=\'\' width=\'62\' height=\'17\' />&nbsp;and area of <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image020.gif\' alt=\'\' width=\'109\' height=\'18\' />. Determine the area of &nbsp;<img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image010.gif\' alt=\'\' width=\'38\' height=\'17\' /></b></font>",
						resp,
						"1522",
						"1522",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>1:4</font>","<font face=Arial size=2>1:2</font>","<font face=Arial size=2>1:3</font>","<font face=Arial size=2>2:3</font>");comm="";valu="";ques13 = new Question(
						"Question13",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>D,E,F are the mid - points of the sides BC, AC and AB respectively of a <img style=\'vertical-align: top; border: 0px initial initial;\' src=\'admin/papers/CH5%20-%20Section%20D%20-%20Questions_files/image022.gif\' alt=\'\' width=\'35\' height=\'17\' />. Determine the ratio of the areas of &nbsp;triangles DEF and ABC</b></font>",
						resp,
						"1551",
						"1551",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>2:1</font>","<font face=Arial size=2>1:2</font>","<font face=Arial size=2>4:1</font>","<font face=Arial size=2>1:4</font>");comm="";valu="";ques14 = new Question(
						"Question14",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b><img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20A%20-%20Questions_files/image006.gif\' alt=\'\' width=\'35\' height=\'17\' />&nbsp;and <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20A%20-%20Questions_files/image008.gif\' alt=\'\' width=\'36\' height=\'17\' />&nbsp;are two equilateral triangles such that D is the midpoint of BC. The ratio of the areas of triangles ABC and BDE is</b></font>",
						resp,
						"1488",
						"1488",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>13 cm</font>","<font face=Arial size=2><img src=\"admin/papers/CH5%20-%20Section%20C%20-%20options_files/image028.gif\" alt=\"\" width=\"39\" height=\"17\" /></font>","<font face=Arial size=2><img src=\"admin/papers/CH5%20-%20Section%20C%20-%20options_files/image030.gif\" alt=\"\" width=\"39\" height=\"17\" /></font>","<font face=Arial size=2><img src=\"admin/papers/CH5%20-%20Section%20C%20-%20options_files/image032.gif\" alt=\"\" width=\"39\" height=\"17\" /></font>");comm="";valu="";ques15 = new Question(
						"Question15",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The perimeters of two similar triangles ABC and PQR are respectively 36 cm and 24 cm. If PQ = 10 cm, find AB.</b></font>",
						resp,
						"1519",
						"1519",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2><img width=31 height=17src=\'admin/papers/CH5%20-%20Section%20C%20-%20options_files/image018.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=31 height=17src=\'admin/papers/CH5%20-%20Section%20C%20-%20options_files/image020.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=31 height=17src=\'admin/papers/CH5%20-%20Section%20C%20-%20options_files/image022.gif\' v:shapes=\'_x0000_i1025\'></font>","<font face=Arial size=2><img width=42 height=17src=\'admin/papers/CH5%20-%20Section%20C%20-%20options_files/image024.gif\' v:shapes=\'_x0000_i1025\'></font>");comm="";valu="";ques16 = new Question(
						"Question16",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>The perimeters of two similar triangles are 30 cm and 20 cmrespectively. If one side of the first triangle is 12cm, determine thecorresponding side of the second triangle.</b></font>",
						resp,
						"1518",
						"1518",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>18:81</font>","<font face=Arial size=2>16:81</font>","<font face=Arial size=2>6:8</font>","<font face=Arial size=2>10:15</font>");comm="";valu="";ques17 = new Question(
						"Question17",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>In two similar triangles ABC and PQR, if their corresponding altitudes AD and PS&nbsp; are in the ratio 4:9, find the ratio of the areas of <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image012.gif\' alt=\'\' width=\'35\' height=\'17\' />&nbsp;and <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20C%20-%20Questions_files/image014.gif\' alt=\'\' width=\'36\' height=\'17\' />.</b></font>",
						resp,
						"1521",
						"1521",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>A12 </font>","<font face=Arial size=2>A11</font>","<font face=Arial size=2>A10</font>","<font face=Arial size=2>A9</font>");comm="";valu="";ques18 = new Question(
						"Question18",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>To divide a line segment AB in the ratio 4:7, a ray AX is drawn first such that <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20A%20-%20Questions_files/image004.gif\' alt=\'\' width=\'41\' height=\'17\' />&nbsp;is an acute angle and then points A1, A2, A3, .... are located at equal distances on the ray AX and the point B is joined to</b></font>",
						resp,
						"1485",
						"1485",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);resp=new Array("<font face=Arial size=2>8</font>","<font face=Arial size=2>10</font>","<font face=Arial size=2>11</font>","<font face=Arial size=2>12</font>");comm="";valu="";ques19 = new Question(
						"Question19",
						0,
						"<font face=Arial size=2><b><u>Directions:</u></b> </font><p><font face=Arial size=2><b>To divide a line segment AB in the ratio 5:7, first a ray AX is drawn so that <img style=\'vertical-align: top;\' src=\'admin/papers/CH5%20-%20Section%20A%20-%20Questions_files/image002.gif\' alt=\'\' width=\'38\' height=\'17\' />&nbsp;is an acute angle and then at equal distances points are marked on the ray AX such that the minimum number of these points is</b></font>",
						resp,
						"1479",
						"1479",
						"",
						0,
						0,
						"45gen",
						"1",
						0
						);questions = new Array (ques0,ques1,ques2,ques3,ques4,ques5,ques6,ques7,ques8,ques9,ques10,ques11,ques12,ques13,ques14,ques15,ques16,ques17,ques18,ques19);sectionArr0 = new Section(
			"Section 1",
			"1",
			"20",
			"3600",
			"3",
			"0",
			0,
			0);
		sectionArr = new Array (sectionArr0);