<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"> </script>
<script language="Javascript" src="http://gd.geobytes.com/gd?after=-1&variables=GeobytesCountry,GeobytesCity,GeobytesRegion,GeobytesLatitude,GeobytesLongitude">
    </script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAADDvGtzZwO2TvQk9pV-hidhTrNSo_Iuj7qZ0KBAeob5ra2kjK8xS_h5mvh9BLVe8I103wNb-2qMacJg" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[

   function load()
   {
      if (GBrowserIsCompatible())
      {
         var map = new GMap2(document.getElementById("map"),{ size: new GSize(300,300) });
         map.removeMapType(G_HYBRID_MAP);
		 map.addControl(new GSmallMapControl());
         map.addControl(new GMapTypeControl());
         map.addControl(new GScaleControl());
         map.enableContinuousZoom();
      
            map.setCenter(new GLatLng(<?php echo $_REQUEST['lat']; ?>, <?php echo $_REQUEST['lng']; ?>), 11);
         
      }
   }

   function GUnload()
   {
      if (window.GUnloadApi) 
      {
         GUnloadApi();
      }
   }

//]]>
</script>
</head>

<body onload="load()" onunload="GUnload()">
<div id="map" style="width: 700px; height: 400px"></div>
</body>
</html>
