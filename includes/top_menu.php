<?php
$pg_name=basename($_SERVER['PHP_SELF'],".php");
?>
<tr>
    <td width="31"><img src="images/sprite_00.png" width="31" height="38" /></td>
    <td width="885" align="center" background="images/sprite_01.jpg"  class="top_menu">
    <a href="index.php" <?php if($pg_name=='index') { ?>class="top_menu_acitve" <?php } ?>>Home</a>        |        
     <a href="test_gen.php" <?php if($pg_name=='test_gen') { ?>class="top_menu_acitve" <?php } ?>>Test Generator</a>        |        
     <a href="forums.php" <?php if($pg_name=='forums') { ?>class="top_menu_acitve" <?php } ?>>Forums</a>        |         
    <a href="groups.php" <?php if($pg_name=='groups') { ?>class="top_menu_acitve" <?php } ?>>Groups </a>|        
    <a href="blogs.php" <?php if($pg_name=='blogs' || $pg_name=='blog_inner') { ?>class="top_menu_acitve" <?php } ?>>Blogs</a>        |        
    <a href="news.php" <?php if($pg_name=='news') { ?>class="top_menu_acitve" <?php } ?>>News</a>        |        
    <a href="contactus.php" <?php if($pg_name=='contatctus') { ?>class="top_menu_acitve" <?php } ?>>Contact Us</a></td>
    <td width="31"><img src="images/sprite_01.png" width="31" height="38" /></td>
</tr>