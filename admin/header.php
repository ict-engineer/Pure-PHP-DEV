<style type="text/css">
<!--
.style3 {
	font-family: Algerian;
	color: #100b4d;
	font-size: 36px;
	font-weight: bold;
}

.style3 a{
	color: #100b4d;
	text-decoration:none;
}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="headerbg">
  <tr>
    <td width="50%" height="90" align="left" valign="middle" class="style3" style="padding-left:23px; padding-top:5px;"><a href="index.php"><!--<img src="images/e3-logo.png" width="269" height="90" border="0" />-->Transmith Group  </a></td>
    <td width="50%" align="right" valign="top" style="padding-right:5px;">
	<?php
	if ($dbf->get_session())
	{
	$client_name=$dbf->getDataFromTable('admin', 'admin_name',  "id='$_SESSION[admin_id]'");
	?>
	<table width="350" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="8" colspan="3" align="center" valign="middle" class="logouttext"></td>
        </tr>
      <tr>
        <td width="260" align="center" valign="middle" class="logouttext">Welcome : <?php echo $client_name; ?> </td>
        <td width="25" align="center" valign="middle"><a href="logout.php"><img src="images/logout-icon.png" alt="logout_icon" width="15" height="15" border="0"/></a></td>
        <td width="65" align="left" valign="middle"><a href="logout.php" class="logouttext">Logout</a></td>
      </tr>
      <tr>
        <td height="10" colspan="3"></td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="top">&nbsp;</td>
      </tr>
    </table>
	<?php
	}
	?>	</td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="middle" class="greenborder" >&nbsp;</td>
  </tr>
</table>
