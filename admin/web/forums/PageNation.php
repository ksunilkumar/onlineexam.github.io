
     <div class="pagination" style="margin-right:30px;"> 
						<!--<a href="#">«</a>-->
    <?php if(!empty($maxPages)){
	//echo $page;exit;
	if($page!=1 )
	{
    if($maxPages>10){
	?>
    
    <a href="<?php echo $_SERVER['REQUEST_URI']?>&page=1&al=<?php echo $al; ?>">|<</a><?php }?> 
    <a href="<?php echo $_SERVER['REQUEST_URI']?>&page=<?php echo $page-1; ?>&al=<?php echo $al; ?>"><<</a> 
    <?php
	}
	if($page>10)
	{
		$start=$page-9;
		$end=$page;
	}
	else
	{
		$start=1;
		if($maxPages<10)
		$end=$maxPages;
		else
		$end=$start+9;
		//echo $end;exit;
	}
	for($i=$start;$i<=$end;$i++){
	
	if($page==$i){
	?>
    <a href="<?php echo $_SERVER['REQUEST_URI']?>&page=<?php echo $i; ?>&al=<?php echo $al; ?>" class="active"><?php echo $i;?></a> 
   <?php } else { ?>
						<a href="<?php echo $_SERVER['REQUEST_URI']?>&page=<?php echo $i; ?>&al=<?php echo $al; ?>" ><?php echo $i;?></a> 
    <?php } } 
	if($page!=$maxPages)
	{
	?>
	<a href="<?php echo $_SERVER['REQUEST_URI']?>&page=<?php echo $page+1; ?>&al=<?php echo $al; ?>">>></a>
      <?php if ($maxPages>10){?><a href="<?php echo $_SERVER['REQUEST_URI']?>&page=<?php echo $maxPages; ?>&al=<?php echo $al; ?>">>|</a> <? }?>
    <?php
	}
	
	} ?>
    
						
						
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
										
