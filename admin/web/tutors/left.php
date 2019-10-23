
	<table width="236" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td width="8"><img src="../images/mainnavleft.gif" alt="g" width="8" height="28" /></td>
				<td background= "../images/mainnavbg.gif"><span class="pages">Welcome to &nbsp;<a href="../home.php" style="text-decoration: none;"><span class="ongoing">Control Panel</span></a></span></td>
				<td width="8"><img src="../images/mainnavright.gif" alt="g" width="8" height="28" /></td>
			</tr>
			<tr>
				<td background= "../images/left.gif"><img src="../images/left.gif" alt="g" width="8" height="1" /></td>
				<td class="td">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tbody>
							<?php
								require_once '../leftPanelData.php';
								$object=new LeftPanelData();
								$list=$object->getData($path."/");
								foreach($list as $key=>$value)
								{
									?>
									<tr>
										<td><img src="../images/bullet.gif" alt="g" /></td>
										<td colspan="2" height="25"><div class="navr"><a href=<?php echo $value?>><?php echo $key;?></a></div></td>
									</tr>
									<?php
								}
							?>
						</table>
					</td>
				    <td background="../images/right.gif"><img src="../images/right.gif" alt="g" width="8" height="1" /></td>
				</tr>
			</tbody>
		</table>