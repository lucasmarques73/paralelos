<?php
/**
* @version $Id: payment.class.php 4820 2009-01-05 11:46:25Z Radek Suski $
* @package: Sigsiu Online Business Index 2
* ===================================================
* @author
* Name: Sigrid & Radek Suski, Sigsiu.NET
* Email: sobi@sigsiu.net
* Url: http://www.sigsiu.net
* ===================================================
* @copyright Copyright (C) 2006 - 2009 Sigsiu.NET (http://www.sigsiu.net). All rights reserved.
* @license see http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL.
* You can use, redistribute this file and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation.
*/

 // no direct access
defined( '_SOBI2_' ) || ( trigger_error("Restricted access", E_USER_ERROR) && exit() );

class payment {

	var $feesOptions = array();
	var $fees = null;
	var $total = null;
	var $sobi2Id = null;
	var $msg = null;
	var $action = null;
	var $discount = 0;
	/**
	 * @var sobi2
	 */
	var $sobi = null;
	/**
	 * default constructor
	 * @param sobi2 $Sobi
	 */
    function payment( $Sobi, $action = "new" )
    {
    	$config =& sobi2Config::getInstance();
    	$config->getPayment();
    	if( isset( $Sobi ) && is_a( $Sobi, "sobi2") ) {
    		$this->action = $action;
    		$this->feesOptions = $Sobi->fees;
    		$this->sobi2Id = $Sobi->id;
    		$this->sobi = $Sobi;
			if( $this->action != "renew") {
	    		$db =& $config->getDb();
				$values = array();
				$now = $config->getTimeAndDate();
				if( $this->action != "saverenew") {
					$ren = "New: ";
				}
				else {
					$ren = "Renew: ";
				}
				if( count( $this->feesOptions ) ) {
					foreach($this->feesOptions as $option => $payment ) {
						$payment = str_replace(",", ".", $payment);
						$values[] = " ( NULL , {$Sobi->id}, '{$ren}{$option}', {$payment}, '{$now}', '1', '{$now}', '{$now}' )";
					}
					$query = "INSERT INTO `#__sobi2_payments` ( `pid` , `sid` , `reference` , `amount`, `date` , `payed` , `payed_date` , `email_send` ) VALUES ";
					$query .= implode(" , ", $values);
					$query .= " ; ";
					$db->setQuery($query);
					$db->query();
					if ($db->getErrorNum()) {
						trigger_error("payment::payment(): DB reports: ".$db->stderr(), E_USER_WARNING);
					}
				}
			}
    	}
 		else {
 			sobi2Config::redirect( $config->key( "redirects", "payment_no_sobi", "index.php" ), _SOBI2_NOT_AUTH );
 		}
    }
    /*
     * displaying all selected  not free options
     */
    function showFees()
    {
    	$config	=& sobi2Config::getInstance();
    	if( $this->discount ) {
    		if( !is_numeric( $this->discount ) || $this->discount < 0 || $this->discount > 100 ) {
    			$this->discount = 0;
    			trigger_error( "payment::showFees(): Discount value is not valid |{$this->discount}| " );
    		}
    	}
    	$this->msg = $this->msg."\n\t <div class=\"sobi2PaymentContainer\"><h3>"._SOBI2_PAY_CHOSEN_OPTIONS."</h3>";
    	$this->msg = $this->msg. "\n\t  <table id=\"sobi2Payment\">";
		foreach($this->feesOptions as $option => $payment ) {
	    	$this->fees = $this->fees + $payment;
	    	$payment = $config->getCurrencyFormat( $payment );
	    	$this->msg = $this->msg. "\n\t\t <tr> ";
	    	$this->msg = $this->msg. "\n\t\t\t <td class=\"sobi2PayOption\">";
	    	$this->msg = $this->msg. "\n\t\t\t {$option}";
	    	$this->msg = $this->msg. "\n\t\t\t </td>";
	    	$this->msg = $this->msg. "\n\t\t\t <td class=\"sobi2PayFees\">";
	    	$this->msg = $this->msg. "\n\t\t\t {$payment}";
	    	$this->msg = $this->msg. "\n\t\t\t </td>";
	    	$this->msg = $this->msg. "\n\t\t </tr> ";
		}
		$this->total = $this->fees;
		$total = $config->getCurrencyFormat($this->fees);
		if( !$this->discount ) {
			$class = "id=\"sobi2PayTotal\"";
		}
		else {
			$class = null;
		}
    	$this->msg = $this->msg. "\n\t\t <tr> ";
    	$this->msg = $this->msg. "\n\t\t\t <td>";
    	$this->msg = $this->msg. "\n\t\t\t\t "._SOBI2_PAY_TOTAL_AMOUNT;
    	$this->msg = $this->msg. "\n\t\t\t </td>";
    	$this->msg = $this->msg. "\n\t\t\t <td {$class}>";
    	$this->msg = $this->msg. "\n\t\t\t\t {$total}";
    	$this->msg = $this->msg. "\n\t\t\t </td>";
    	$this->msg = $this->msg. "\n\t\t </tr> ";

    	if( $this->discount ) {
			$this->fees = $this->fees - ( ( $this->discount *  $this->fees ) / 100) ;
			$total = $config->getCurrencyFormat( $this->fees );
			$class = "id=\"sobi2PayTotal\"";
    		$this->msg = $this->msg. "\n\t\t <tr> ";
	    	$this->msg = $this->msg. "\n\t\t\t <td><br/>";
	    	$this->msg = $this->msg. "\n\t\t\t\t "._SOBI2_PAY_DISCOUNT;
	    	$this->msg = $this->msg. "\n\t\t\t </td>";
	    	$this->msg = $this->msg. "\n\t\t\t <td><br/>";
	    	$this->msg = $this->msg. "\n\t\t\t\t {$this->discount} %";
	    	$this->msg = $this->msg. "\n\t\t\t </td>";
	    	$this->msg = $this->msg. "\n\t\t </tr> ";
			$this->msg = $this->msg. "\n\t\t <tr> ";
			$this->msg = $this->msg. "\n\t\t\t <td>";
			$this->msg = $this->msg. "\n\t\t\t\t "._SOBI2_PAY_TOTAL_AMOUNT;
			$this->msg = $this->msg. "\n\t\t\t </td>";
			$this->msg = $this->msg. "\n\t\t\t <td {$class}>";
			$this->msg = $this->msg. "\n\t\t\t\t {$total}";
			$this->msg = $this->msg. "\n\t\t\t </td>";
			$this->msg = $this->msg. "\n\t\t </tr> ";
			$this->total = $this->fees;
    	}
		$this->msg = $this->msg. "\n\t</table>";

		echo $this->msg;

		if( $this->action == "renew" ) {
			return null;
		}

		if($config->mailFees) {
			$this->mailFees();
		}

		if($config->useBankTransfer) {
			echo "\n\t  <table id=\"sobi2PaymentMethodBank\">";
			echo "\n\t\t <tr> ";
			echo "\n\t\t\t <td id=\"sobi2PaymentMethodBank\"> ";
			if($config->useBankTransfer == 1) {
				echo "\n\t\t\t\t "._SOBI2_PAY_BANK_DATA_SEND_EMAIL;
			}
			else {
				echo "\n\t\t\t\t<b class=\"sobi2PaymentMethodHeader\" >";
				echo _SOBI2_PAY_WITH_BANK;
				echo "</b><br/>";
				echo _SOBI2_PAY_BANK_DATA_JS_HEADER;
				echo " <br/><br/> {$config->bankData} <br/>";
				echo _SOBI2_PAY_BANK_DATA_JS_TITLE." ".$config->payTitle." "._SOBI2_NUMBER_H." ".$this->sobi2Id;
				echo "<br/>";
				echo _SOBI2_PAY_TOTAL_AMOUNT." ".$config->getCurrencyFormat( $this->fees );
			}
			echo "\n\t\t\t\t <br/>";
			echo "\n\t\t\t </td>";
			echo "\n\t\t </tr> ";
			echo "\n\t </table>\n\t";

		}
		if($config->usePayPal) {
			/*
			 * paypal accept only point
			 */
			$this->fees = str_replace(",",".",$this->fees);
			$this->total = str_replace(",",".",$this->total);
			$title = $config->payTitle." "._SOBI2_NUMBER_H." ".$this->sobi2Id;
			$iso = explode( '=', _ISO );
			$charset = $iso[1];
		?>
			<b class="sobi2PaymentMethodHeader"><?php echo _SOBI2_PAY_WITH_PAYPAL; ?></b>
			<table id="sobi2PaymentMethodPayPal">
			<tr>
				<td>
				<form action="<?php echo $config->payPalUrl;?>" method="post">
				<input name="cmd" value="_xclick" type="hidden">
				<input name="business" value="<?php echo $config->payPalMail;?>" type="hidden">
				<input name="item_name" value="<?php echo $title;?>" type="hidden">
				<input name="item_number" value="<?php echo $this->sobi2Id;?>" type="hidden">
				<input name="no_shipping" value="1" type="hidden">
				<input name="return" value="<?php echo $config->payPalReturnUrl ;?>" type="hidden">
				<input name="no_note" value="1" type="hidden">
				<input name="currency_code" value="<?php echo $config->payPalCurrency;?>" type="hidden">
				<input name="tax" value="0" type="hidden">
				<input name="bn" value="<?php echo $title;?>" type="hidden">
				<input name="charset" value="<?php echo $charset;?>" type="hidden">
				<input name="amount" value="<?php echo $this->total;?>" type="hidden">
				<input src="<?php echo $config->liveSite;?>/components/com_sobi2/images/paypal.jpg" name="submit" alt="<?php echo _SOBI2_PAY_WITH_PAYPAL;?>" border="0" type="image">
				</form>
				</td>
			</tr>
			</table>
			<?php
		}
		if(!empty($config->S2_plugins)) {
			foreach ($config->S2_plugins as $plugin) {
				if(method_exists($plugin,"onPaymentScreen")) {
					$plugin->onPaymentScreen();
				}
			}
		}
		echo "</div>";
    }
    /*
     * sending emails
     */
    function mailFees()
    {
    	$config =& sobi2Config::getInstance();
		$database = &$config->getDb();
		$mailMsg = null;
		if ($config->mailfrom != '' && $config->fromname != '') {
			$adminName2 	= $config->fromname;
			$adminEmail2 	= $config->mailfrom;
		} else {
		// use email address and name of first superadmin for use in email sent to user
			$query = "SELECT name, email"
			. "\n FROM #__users"
			. "\n WHERE LOWER( usertype ) = 'superadministrator'"
			. "\n OR LOWER( usertype ) = 'super administrator'"
			;
			$database->setQuery( $query );
			$rows = $database->loadObjectList();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$row2 			= $rows[0];
			$adminName2 	= $row2->name;
			$adminEmail2 	= $row2->email;
		}
		/*
		 * getting client email
		 */
		if( $config->mailSoJ == 0 ) {
			$query = "SELECT `data_txt` FROM `#__sobi2_fields_data` WHERE `fieldid` = {$config->mailFieldId} AND `itemid` = {$this->sobi2Id}";
			$database->setQuery( $query );
			$email = $database->loadResult();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
		}
		else {
			$u =& sobi2bridge::jUser( $database );
			$u->load( $this->sobi->owner );
			$email = $u->email;
		}
		$config->getEmails();
		$e = array("<br>","<br/>","<br />");
		$mailMsg  = str_ireplace( $e, null, $this->replaceMarkers( $config->UserEmailPaymentsText ) );
		$mailTitle = $this->replaceMarkers( $config->UserEmailPaymentsTitle );
		$AdmMailMsg = null;
		$AdmMailTitle = null;

		if( $config->mailFeesAdm ){
			$AdmMailMsg = $this->replaceMarkers($config->AdmEmailPaymentsText);
			$AdmMailTitle = $this->replaceMarkers($config->AdmEmailPaymentsTitle);
		}

		if( !$email ) {
			$email = $adminEmail2;
			$u =& sobi2bridge::jUser( $database );
			$u->load($this->sobi->owner);
			$mailMsg = "EMAIL ERROR: \n\n payment::mailFees(): Having no valid email address for user {$u->name} (Id:{$this->sobi->owner}). Entry {$this->sobi->title} (id:{$this->sobi->id}) \n\n =================================== \n\n".$mailMsg;
			trigger_error("payment::mailFees(): Having no valid email address for user {$u->name} (Id:{$this->sobi->owner}). Entry {$this->sobi->title} (id:{$this->sobi->id}). Sending email to {$adminEmail2}", E_USER_WARNING);
		}

		/*
		 * replacing selectet option marker
		 */
		$selected_options = null;
		foreach( $this->feesOptions as $option => $payment ) {
	    	$payment = $config->getCurrencyFormat( $payment );
	    	$selected_options = $selected_options. "\n {$option}";
	    	$selected_options = $selected_options. "\t\t {$payment}";
		}
		if( $this->discount ) {
			$selected_options .= "\n "._SOBI2_PAY_DISCOUNT. "\t\t {$this->discount} %";
		}
		$mailMsg = str_replace( "{selected_options}", $selected_options, $mailMsg );
		$AdmMailMsg = str_replace( "{selected_options}", $selected_options, $AdmMailMsg );

		/*
		 * replacing PayPal url
		 */
		$iso = explode( '=', _ISO );
		$charset = $iso[1];
		if( $config->usePayPal ) {
			$this->fees = str_replace( ",",".",$this->fees );
			$this->total = str_replace( ",",".",$this->total );
			$title = $config->payTitle." "._SOBI2_NUMBER_H." ".$this->sobi2Id;
			$href = "{$config->payPalUrl}?cmd=_xclick&" .
					"business={$config->payPalMail}" .
					"&item_name={$title}" .
					"&item_number= {$this->sobi2Id}" .
					"&amount={$this->total}" .
					"&no_shipping=2&no_note=1" .
					"&currency_code={$config->payPalCurrency}" .
					"&bn=PP%2dBuyNowBF&charset={$charset}";

			$href = str_replace(" ", "%20", $href);
			$mailMsg = str_replace("{paypal_url}",$config->stringEncode($href), $mailMsg);
			$AdmMailMsg = str_replace("{paypal_url}",$config->stringEncode($href), $AdmMailMsg);
		}
		if(!empty($config->S2_plugins)) {
			foreach ($config->S2_plugins as $plugin) {
				if(method_exists($plugin,"onPaymentMailUser")) {
					$plugin->onPaymentMailUser($mailTitle,$mailMsg,$email);
				}
			}
		}
		/*
		 * Send email to user
		 */
		sobi2bridge::mail( $adminEmail2, $adminName2, $email, $config->makeSubject( $mailTitle ), "{$mailMsg} \n\n {$config->mailFooter}" );
		/*
		 * Send email to admin
		 */
		if($config->mailFeesAdm){
			$query = "SELECT email, name"
				. "\n FROM #__users"
				. "\n WHERE gid IN ({$config->mailAdmGid})"
				. "\n AND ( sendemail = 1 OR gid IN (18, 19, 20, 21, 23) )"
				;
			$database->setQuery($query);
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$adminRows = $database->loadObjectList();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
    		$AdmMailMsg .= $config->mailFooter;
    		foreach( $adminRows as $adminRow) {
				if(!empty($config->S2_plugins)) {
					foreach ($config->S2_plugins as $plugin) {
						if(method_exists($plugin,"onPaymentMailAdmin")) {
							$plugin->onPaymentMailAdmin($AdmMailTitle,$AdmMailMsg,$adminRow->email);
						}
					}
				}
    			sobi2bridge::mail( $adminRow->email, $adminRow->name, $adminRow->email, $config->makeSubject( $AdmMailTitle ), $AdmMailMsg );
			}
		}
    }
    /**
     * @param int $sid
     * @param bool $save
     */
    function renew( $sid, $save = false )
    {
    	$config =& sobi2Config::getInstance();
    	if( !$config->allowRenew ) {
			trigger_error( "payment::renew(): Renewing is not allowed", E_USER_WARNING );
			sobi2Config::redirect( $config->key( "redirects", "renew_not_allowed", "index.php" ), _SOBI2_NOT_AUTH );
    	}
		if( !$sid ) {
			trigger_error( "payment::renew(): Missing SOBI2 id", E_USER_WARNING );
			sobi2Config::redirect( $config->key( "redirects", "renew_no_sid", "index.php" ), _SOBI2_NOT_AUTH );
		}
    	sobi2Config::import( "sobi2.class" );
		$sobi = new sobi2( $sid );
		$my =& $config->getUser();
    	if( $sobi->owner != $my->id && !$config->checkPerm() ) {
			trigger_error( "payment::renew(): User is not an owner or admin", E_USER_WARNING );
			sobi2Config::redirect( $config->key( "redirects", "renew_no_perms", "index.php" ), _SOBI2_NOT_AUTH );
    	}
		if( strtotime( $sobi->publish_down ) < strtotime( $config->getTimeAndDate() ) ) {
			$sobi->publish_down = $config->getTimeAndDate();
		}
		$date = strtotime( $sobi->publish_down );
		$now = strtotime( $config->getTimeAndDate() );
		$days = round( ( $date - $now ) / 60 / 60 / 24 );
		if( $days > $config->allowRenewDaysForExp ) {
			trigger_error( "payment::renew(): Entry expires first in {$days} days. Limit is {$config->allowRenewDaysForExp} days", E_USER_WARNING );
			sobi2Config::redirect( $config->key( "redirects", "renew_no_exp_limit", "index.php" ), _SOBI2_NOT_AUTH );
		}
    	$database =& $config->getDb();
		$query = "SELECT fieldid FROM `#__sobi2_fields` WHERE `is_free` = 0 AND `payment` > 0 ";
		$database->setQuery( $query );
		$f = $database->loadObjectList();
		if ($database->getErrorNum()) {
			trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
		}
		$fields = array();
		$fees = array();
		sobi2Config::import("field.class");
    	if( count( $f ) ) {
			foreach( $f as $field ) {
	    		$fields[$field->fieldid] = new sobiField($field->fieldid);
	    	}
    	}
    	/* basic price */
 		if( $config->basicPrice ) {
 			$fees += array($config->basicPriceLabel => $config->basicPrice);
 		}
		/* custom fields */
		if( count( $fields ) ) {
			foreach ( $fields as $field ) {
				if( key_exists( $field->fieldname, $sobi->customFieldsData ) && strlen( $sobi->customFieldsData[$field->fieldname] ) ) {
					if( $field->fieldType == 3 && $sobi->customFieldsData[$field->fieldname] == 0 ) {
						continue;
					}
					$fees += array( $field->label => $field->payment );
				}
			}
		}
		/* image */
		if( $config->allowUsingImg == 2 && strlen( $sobi->image ) ) {
			$fees += array( _SOBI2_SAVE_IMAGE_FEES => $config->priceForImg );
		}
		/* icon */
		if( $config->allowUsingIco == 2 && strlen( $sobi->icon ) ) {
			$fees += array( _SOBI2_SAVE_ICON_FEES => $config->priceForIco );
		}
		/* categories */
		if( array_sum( $config->catPrices ) > 0 ) {
			for( $i = 0; $i < count( $sobi->myCategories ); $i++ ) {
				$cat = $i + 1;
				if( isset( $config->catPrices[$cat] ) && $config->catPrices[$cat] ) {
					$fees += array(_SOBI2_CATEGORY_H." {$cat}" => $config->catPrices[$cat]);
				}
			}
		}
		/* plugins */
		if( count($config->S2_plugins) ) {
			foreach( $config->S2_plugins as $plugin ) {
				if(method_exists($plugin, "renew")) {
					$plugin->renew( $fees, $sobi->id );
				}
			}
		}
		$sobi->fees =& $fees;
		$action = $save ? "saverenew" : "renew";
		$payment = new payment( $sobi, $action );
		$payment->discount = $config->renewDiscount;
		$date = strtotime( $sobi->publish_down ) + ( $config->renewExpirationTime * 24 * 60 * 60 );
		$date = date( $config->key( "string", "date_format", "Y-n-j H:i:s"), $date );
		echo "<div class=\"sobi2RenewHaeder\"><h3>"._SOBI2_RENEW_HEADER."</h3><div>";
		if( !$save ) {
			$expl = str_replace( array( "%days%", "%date%", "%title%" ), array( $config->renewExpirationTime, $date, $sobi->title ), _SOBI2_RENEW_EXPL );
			echo "<div class=\"sobi2RenewExpl\">{$expl}</div>";
			if( count( $fees ) ) {
				$payment->showFees();
			}
			else {
				echo "<br/>";
			}
			?>
			<form action="index.php?option=com_sobi2" method="POST" >
			<input type="hidden" name="sobi2Task" value="saveRenew"/>
			<input type="hidden" name="sobi2Id" value="<?php echo $sobi->id;?>"/>
			<input type="hidden" name="Itemid" value="<?php echo $config->sobi2Itemid;?>"/>
			<input type="submit" class="button" id="sobi2RenewEntryButton" name="renewEntry" value="<?php echo _SOBI2_RENEW_BT_NOW;?>"/>
			</form>
			<?php
		}
		else {
			$expl = str_replace( array( "%days%", "%date%", "%title%" ), array( $config->renewExpirationTime, $date, $sobi->title ), _SOBI2_RENEWED_EXPL );
			echo "<div class=\"sobi2RenewExpl\">{$expl}</div>";
			if( count( $fees ) ) {
				$payment->showFees();
			}
			else {
				echo "<br/>";
			}
			$query = "DELETE FROM `#__sobi2_fields_data` WHERE `itemid` = {$sobi->id} AND `data_bool` = 1 AND `expiration` != 'NULL'";
			$database->setQuery( $query );
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			if( strtotime( $sobi->publish_down ) < strtotime( $config->getTimeAndDate() ) ) {
				$sobi->publish_down = $config->getTimeAndDate();
			}
			$date = date( "Y-m-d H:i:s", ( strtotime( $sobi->publish_down  ) + ( ( $config->renewExpirationTime + 1 ) * 60 * 60 * 24 ) ) );
			$app = $config->key( "edit_form", "autoapprove_changes", true );
			$pub = $config->key( "edit_form", "autopublish_changes", true );
			$query = "UPDATE `#__sobi2_item` SET `publish_down` = '{$date}', `approved` = '{$app}', `published` = '{$pub}'  WHERE `itemid` = '{$sobi->id}' LIMIT 1 ;";
			$database->setQuery( $query );
			$database->query();
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			if( $config->renewDeleteFees ) {
				$query = "DELETE FROM `#__sobi2_payments` WHERE `sid` = '{$sobi->id}'";
				$database->setQuery( $query );
				$database->query();
			}
			if ($database->getErrorNum()) {
				trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
			}
			$config->sobiCache->clearAll();
			$config->sobiCache->removeObj( $sobi->id );
	    	if( $config->notifyAdminRenew || $config->notifyAuthorRenew ) {
	    		$config->getEmails();
	    	}
	    	if( $config->notifyAdminRenew ) {
				$query = "SELECT email, name"
					. "\n FROM #__users"
					. "\n WHERE gid IN ({$config->mailAdmGid})"
					. "\n AND ( sendemail = 1 OR gid IN (18, 19, 20, 21, 23) )"
					;
				$database->setQuery( $query );
				$database->query();
				$adminRows = $database->loadObjectList();
				if ($database->getErrorNum()) {
					trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
				}
				$emailTitle = $sobi->replaceMarkers( $config->AdmEmailOnRenewTitle );
				$mailMsg = $sobi->replaceMarkers( $config->AdmEmailOnRenewText );
				$mailMsg .= $config->mailFooter;
				foreach( $adminRows as $adminRow) {
					sobi2bridge::mail( $adminRow->email, $adminRow->name, $adminRow->email, $config->makeSubject( $emailTitle ), $mailMsg );
				}
	    	}
	    	if( $config->notifyAuthorRenew ) {
				if ($config->mailfrom != '' && $config->fromname != '') {
					$adminName2 	= $config->fromname;
					$adminEmail2 	= $config->mailfrom;
				}
				else {
				// use email address and name of first superadmin for use in email sent to user
					$query = "SELECT name, email"
					. "\n FROM #__users"
					. "\n WHERE LOWER( usertype ) = 'superadministrator'"
					. "\n OR LOWER( usertype ) = 'super administrator'"
					;
					$database->setQuery( $query );
					$rows = $database->loadObjectList();
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
					$row2 			= $rows[0];
					$adminName2 	= $row2->name;
					$adminEmail2 	= $row2->email;
				}
				if($config->mailSoJ == 0) {
					$query = "SELECT `data_txt` FROM `#__sobi2_fields_data` WHERE `fieldid` = {$config->mailFieldId} AND `itemid` = {$sobi->id}";
					$database->setQuery( $query );
					$email = $database->loadResult();
					if ($database->getErrorNum()) {
						trigger_error("DB reports: ".$database->stderr(), E_USER_WARNING);
					}
				}
				else {
					$u =& sobi2bridge::jUser( $database ) ;
					$u->load( $sobi->owner );
					$email = $u->email;
				}
				$emailTitle = $sobi->replaceMarkers( $config->UserEmailOnRenewTitle );
				$mailMsg = $sobi->replaceMarkers( $config->UserEmailOnRenewText );
	    		$mailMsg .= $config->mailFooter;
				if( !$email ) {
					if( !isset( $u ) ) {
						$u =& sobi2bridge::jUser( $database );
						$u->load( $sobi->owner );
					}
					trigger_error("Having no valid email address for user {$u->name} (Id:{$sobi->owner}). Entry '{$sobi->title}' (id:{$sobi->id}). Sending email to {$adminEmail2}", E_USER_WARNING);
					$email = $adminEmail2;
					$mailMsg = "EMAIL ERROR: \n\npayment::renew(); Having no valid email address for user {$u->name} (Id:{$sobi->owner}). Entry '{$sobi->title}' (id:{$sobi->id}) \n\n =================================== \n\n".$mailMsg;
				}
	    		sobi2bridge::mail( $adminEmail2, $adminName2, $email, $config->makeSubject( $emailTitle ), $mailMsg);
	    	}

		}
    }
    /*
     * replacing markers
     */
    function replaceMarkers( $string )
    {
    	$config =& sobi2Config::getInstance();
		$string = $this->sobi->replaceMarkers( $string );
		$string = str_replace( "{total}", $this->fees, $string );
		$string = str_replace( "{bank_data}",$config->stringEncode( $config->bankData ), $string );
    	return $string;
    }
}
?>