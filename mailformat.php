<table width="666" height="715" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#1C1A1B" style="border:solid 1px #07341d; border-radius:5px; -moz-border-radius:5px;">
				  <tr>
					<td height="115" colspan="3" align="left" valign="middle" scope="col" style="padding-left:15px;"><img src='.$imgPath.'></td>
				  </tr>
				  <tr>
					<td height="15" colspan="3" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding-left:15px; color: #e2efe7; font-weight: bold;">THIS E-MAIL IS PURELY FOR INFORMATION, YOU SHOULD VISIT THE TRANSACTION PAGE ON THE WEB SITE '.$res_admin[site_url].' TO CHECK THE PROGRESS OF YOUR TRANSACTION</td>
	  </tr>
				  <tr>
					<td align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
					<td height="15" colspan="2" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
	  </tr>
				  <tr>
					<td width="9%" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
					<td width="91%" height="15" colspan="2" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
				  </tr>
				  <tr>
					<td height="35" colspan="3" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#e2efe7; font-weight: bold; padding-left:15px;" >Dear Buyer,</td>
		  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#e2efe7; font-weight: bold;"> We have informed the Seller '.$to.' that you have opened a transaction with Transmith Group!
	The transaction identification number is '.$member_transaction[transaction_no].', as follows:</span></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td colspan="2" align="left" valign="top" >&nbsp;</td>
	  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" >
						<table width="500" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #E1D600;">
						  <tr>
							<td width="16" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#e2efe7; font-weight: bold;">&nbsp;</td>
							<td width="482" height="25" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#e2efe7; font-weight: bold;">Transaction ID : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#ffff00; font-weight: bold;">'.$member_transaction[transaction_no].'</span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#e2efe7; font-weight: bold;">Description : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#ffff00; font-weight: bold;">'.$member_transaction[brief_descr].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#e2efe7; font-weight: bold;">Currency : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#ffff00; font-weight: bold;">'.$member_transaction[currency].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#e2efe7; font-weight: bold;">Purchasing price : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#ffff00; font-weight: bold;">'.$member_transaction[total].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#e2efe7; font-weight: bold;">Who pays the SafeDeal service : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#ffff00; font-weight: bold;">'.$member_transaction[safedeal_pay].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#e2efe7; font-weight: bold;">Postage and package costs : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#ffff00; font-weight: bold;">'.$member_transaction[postage_packing_cost].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#e2efe7; font-weight: bold;">Who pays the Postage and package costs : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#ffff00; font-weight: bold;">'.$member_transaction[postage_packing_pay].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#e2efe7; font-weight: bold;">Inspection Period : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#ffff00; font-weight: bold;">'.$member_transaction[inspection_period].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#e2efe7; font-weight: bold;">Way of paying : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#ffff00; font-weight: bold;">Bank Transfer</span></span></td>
						  </tr>
						</table>
					</td>
				  </tr>
				  <tr>
					<td height="10" align="left" valign="top" >&nbsp;</td>
					<td height="10" colspan="2" align="left" valign="top" >&nbsp;</td>
	  			</tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#e2efe7; font-weight: normal;">We are waiting for the Seller to accept or modify the transaction, as soon as we have been notified of the Sellers decisions we will give you further instructions in an e-mail informing you how to proceed.</td>
				  </tr>
				  <tr>
					<td height="5" align="left" valign="top" >&nbsp;</td>
					<td height="5" colspan="2" align="left" valign="top" >&nbsp;</td>
	  			</tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#e2efe7; font-weight: normal;">
					 More information can be found in our web pages:<br />
					 1) The FAQ  <a href="'.$res_admin[site_url].'/faq" target="_blank">'.$res_admin[site_url].'/faq</a><br />
					 2) The quick guide  <a href="'.$res_admin[site_url].'/guide" target="_blank">'.$res_admin[site_url].'/guide</a><br />
					 3) Our service terms  <a href="'.$res_admin[site_url].'/terms" target="_blank">'.$res_admin[site_url].'/terms</a>
					</td>
				  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #e2efe7; font-weight: bold;">&nbsp;</td>
				  </tr>
				  <tr>
					<td align="left" valign="top" ></td>
					<td height="10" colspan="2" align="left" valign="top" ></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="25" colspan="2" align="left" valign="top" style="padding-right:10px;" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #ffff00; font-weight: bold;">Thank you for choosing Transmith Group!<br />
						<br />
					Transmith Group Team<br />
					Email '.$res_contact[email].'<br />
					Home '.$res_admin[site_url].'<br />
					Fax  '.$res_contact[fax_no].' </span></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" ></td>
					<td height="20" colspan="2" align="left" valign="top" ></td>
				  </tr>
				</table>