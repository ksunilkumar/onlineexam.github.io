<? define('pageRange', 10);  ?>
     <div class="pagination" style="margin-right:30px;"> 
     
     <?
        if($page<=0) {
            $next    =    2;
        }
        else {
            $next    =    $page+1;
        }
        $prev    =    $page-1;
        $last    =    $maxPages;
		
		
		if($maxPages>=pageRange) {
		 $dis_min = intval($page - 5); 
		 $dis_max = intval($page + 5);	
		 }
		if($dis_max >= $maxPages)
		 { 
		 	$dis_max = $maxPages;
		 	$dis_min = ($maxPages - pageRange);
		 }
		 
		if($dis_min < 1)
		 { 
		 	$dis_min = 1;
			if($maxPages >pageRange)
		  	$dis_max = pageRange;
			else
			$dis_max = $maxPages;
			
		 }
		
		if($page > 1)
		 {
             if($dis_min > 1)
			{
				echo"<a href=$self?option=".$option."&page=1 class = 'more_news'>First</a>&nbsp&nbsp;";
				echo "<a>...</a>&nbsp&nbsp;";
			}
        }
     ?>
     
    <?php
	
/*	echo $dis_min;
	echo $dis_max;
*/	
	
	 if(!empty($maxPages)){
	for($i=$dis_min;$i<=$dis_max;$i++) {
	if($page==$i){
	?>
   
	
	<a style="cursor:pointer"  class="active" title="<? echo $i; ?>" onClick="showPage(<?php echo $i;?>);"/>
	<?php echo $i;?></a> 
   <?php } else { ?>
   <a style="cursor:pointer"  title="<? echo $i; ?>" onClick="showPage(<?php echo $i;?>);"/>
						<?php echo $i;?></a> 
    <?php } } } ?>
<?

 if($page <$maxPages)
  {
            //echo "<a href=$self?option=".$_GET['option']."&page=$next class = 'more_news'>Next</a>&nbsp&nbsp;";
           if($dis_max < $maxPages) 
			{
				
				  ?>
                  <a> ....</a><a style="cursor:pointer"  title="Last" onClick="showPage(<?php echo $last;?>);"/>Last</a>

				<?
			}
  }
  ?>
    
    
    						
						
						<!--<a href="#">»</a> -->
					</div> 
  
	<!--<td width="100%">
	<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
	<tr>
	
									                	<td width="20%" align="center">
															Total Results:<?php echo $totalEntries;?>
									                	</td>
									                	<td width="15%" align="center">
                                                            Page: <?php echo $page;?> <?php if($maxPages>0) echo ' of '.$maxPages.' page(s)'; ?>
									                	</td>
                                                        <?php
														if($totalEntries!=0)
														{
														?>
									                	<td width="8%">
									                		<?php
									                			if($page!=1)
									                			{
									                				?>
									                				<input type="button" name="s1" value=" &lt;&lt; " title="First" onclick="showPage(1)"/>
									                				<?php
									                			}
									                		?>
									                	</td>
									                	<td width="8%">
									                		<?php
									                			if($page!=1)
									                			{
									                				?>
									                				<input type="button" name="s2" value=" &lt; " title="Previous" onclick="showPage(<?php echo $page-1; ?>);"/>
									                				<?php
									                			}
									                		?>
									                	</td>
									                	<td width="7%">
									                		<?php 
									                			if($page!=$maxPages)
									                			{
									                				?>
									                				<input type="button" name="s3" value=" &gt; " title="Next" onclick="showPage(<?php echo $page+1;?>);"/>
									                				<?php
									                			} 
									                		?>
									                	</td>
									                	<td width="2%">
									                		<?php 
									                			if($page!=$maxPages)
									                			{
									                				?>
									                				<input type="button" name="s4" value=" &gt;&gt " title="Last" onclick="showPage(<?php echo $maxPages;?>);"/>
									                				<?php
									                			}
									                		?>
									                	</td>
                                                       <?php } ?>
									                </tr>
									                </table>
												</td>-->
										
