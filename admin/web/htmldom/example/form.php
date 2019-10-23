<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body><form name='send' action='info.php' method="post">
<table width="50%"><?php if($_REQUEST['opt']==1){echo "<tr><td colspan='2'><h2>Uploaded</h2></td></tr>";}?>
<tr><td>Enter Quiz name</td><td><input type='text' name='quiz' /> </td></tr>
<tr><td>Upload File</td><td><input type="file" name='fname' /></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name='sub' value='Submit' /></td></tr>
</table>
</form>
</body>
</html>
