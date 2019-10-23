<table width="197" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" width="6"><img src="images/sprite_05.jpg" height="27" /></td>
    <td width="100%" background="images/sprite_07.jpg" class="content_head"><strong>Announcements</strong></td>
    <td align="right" width="6"><img src="images/sprite_06.jpg" height="27" /></td>
  </tr>
  <tr>
    <td height="182" colspan="3" valign="top" class="sprite_padding_1 block_border"><table width="100%" class="left_panel" border="0" cellspacing="0" cellpadding="0">
    <?php
	include_once("lib/db.php");
    $sql = "SELECT * FROM news where status='active' ORDER BY create_date DESC LIMIT 0,5";
	$objsql1 = new SqlClass;
	$result1=$objsql1->executeSql($sql);
	while($row = $objsql1->fetchRow($result1)){
	?>
      <tr>
        <td width="9%" align="left" valign="top"><img src="images/sprite_09.jpg" width="6" height="10" /></td>
        <td width="91%" height="30" valign="top"><a href="news_inner.php?news_id=<?php echo $row['news_id'];?>"><?php echo substr($row['news_title'],0,50);?></a></td>
      </tr>
      <?php
	  }
	  ?>
      
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
