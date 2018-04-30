<?php
class DonorPerfect {
	protected $dpAPIKey;
	protected $log;
	protected $emailList;
	protected $donorEmailList;
	protected $dpSaveFlag = false;
	
	
	public function __construct($dpAPIKey, $log, $emailList, $donorEmailList, $dpConfig) {
		$this->dpAPIKey = $dpAPIKey;
		$this->log = $log;
		$this->emailList = $emailList;
		$this->donorEmailList = $donorEmailList;
		$this->dpConfig = $dpConfig;
	}
	
	
	function saveDonorDetails($transactionDetails, $sessionData) {
		$matchingDonorList = $this->dp_donorsearch ( $transactionDetails );
		$matchingDonorArr = $matchingDonorList->{'record'};
		$donorDetails = $this->saveDonor ( $transactionDetails );
		$donorPledgeDetails [0] = '';
		$headers = "From: info@globallymealliance.org" . "\r\n";
		
		if ( isset($donorDetails->{'record'}->{'field'} [0]) ) {
			$donorDetails = $donorDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
			
			$this->eMailDonor ( $transactionDetails, $sessionData );
			$this->eMailAdmin ( $matchingDonorArr, $donorDetails [0] );
			
			$this->log->info ( "New Donor Id is " . $donorDetails [0] );
			
			$billingMethod = $this->clean ( $transactionDetails->{'merchant-defined-field-12'} ? $transactionDetails->{'merchant-defined-field-12'} : '' );
			if ($billingMethod == 'recurring') {
				$this->log->info ( "This is a recurring gift " );
				$donorPledgeDetails = $this->saveDonorPledge ( $transactionDetails, $donorDetails [0] );
				$this->log->info ( "New Pledge id is " . $donorPledgeDetails [0] );
			}
			
			$donorGiftDetails = $this->saveDonorGifts ( $transactionDetails, $donorDetails [0], $donorPledgeDetails [0] );
			
			$this->log->info ( "New Gift id is " . $donorGiftDetails [0] );
			
			if (($transactionDetails->{'merchant-defined-field-19'} != '') && ($transactionDetails->{'merchant-defined-field-19'} == 'YES')) {
				$notificationDonorDetails [0] = 0;
				
				if (($transactionDetails->{'merchant-defined-field-20'} != '') && ($transactionDetails->{'merchant-defined-field-20'} == 'YES')) {
					$notificationDonorDetails = $this->saveNotificationDonor ( $transactionDetails , $sessionData);
				}
				
				$donorGiftTributeDetails = $this->saveDonorGiftTribute ( $transactionDetails, $notificationDonorDetails [0]);
				
				$this->log->info ( "New Tribute Id is " . $donorGiftTributeDetails [0] );
				
				$assocTribsToGiftDetails = $this->assocTribsToGift( $donorGiftTributeDetails [0], $donorGiftDetails [0]);
				
			}
			
			$donorPaymentDetails = $this->saveDonorPayment ( $transactionDetails, $donorDetails [0], $donorGiftDetails [0], $donorPledgeDetails [0] );
			
			if ($billingMethod == 'recurring') {
				$this->log->info ( "New payment name is " . $donorPaymentDetails->{'name'} [0] );
				$this->log->info ( "New payment id is " . $donorPaymentDetails->{'id'} [0] );
				$this->log->info ( "New payment value is " . $donorPaymentDetails->{'value'} [0] );
			}
		} else {
			$this->log->info ( "Error Adding New Donor to DP" );
			//mail ( $this->emailList, "Error Adding New Donor to DP", "See Log file for More details", $headers );

			$dpSaveFailMail = SimpleMail::make ()->setFrom ( 'info@globallymealliance.org', 'Global Lyme Alliance' )->setSubject ( 'Error Adding New Donor to DP' )
				->setMessage ( "Error Adding New Donor to DP. See Log file for More details" )->setReplyTo ( 'info@globallymealliance.org', 'Global Lyme Alliance' )->setHtml ()->setWrap ( 100 );
			
			foreach ( $this->emailList as $name => $email ) {
				$dpSaveFailMail->setTo ( $email, $name );
			}
		
			$dpSaveFailMailsend = $dpSaveFailMail->send ();
		
			$dpSaveFailMailsend ? $this->log->info ( 'Error Adding New Donor to DP Email sent successfully' ) : $this->log->info ( 'Could not send Error Adding New Donor to DP email' );
		}
	}
	
	
	function eMailDonor($transactionDetails, $sessionData) {
		$billingetails = $transactionDetails->{'billing'};
		
		$title = $transactionDetails->{'merchant-defined-field-3'} ? $transactionDetails->{'merchant-defined-field-3'} : '';
		$firstName = $transactionDetails->{'merchant-defined-field-1'} ? $transactionDetails->{'merchant-defined-field-1'} : '';
		$lastName = $transactionDetails->{'merchant-defined-field-2'} ? $transactionDetails->{'merchant-defined-field-2'} : '';
		$email = $billingetails->{'email'} ? $billingetails->{'email'} : '';
		$isCorp = $transactionDetails->{'merchant-defined-field-4'} ? $transactionDetails->{'merchant-defined-field-4'} : '';
		$companyName = $billingetails->{'company'} ? $billingetails->{'company'} : '';
		$country = $transactionDetails->{'merchant-defined-field-13'} ? $transactionDetails->{'merchant-defined-field-13'} : '';
		$address1 = $transactionDetails->{'merchant-defined-field-14'} ? $transactionDetails->{'merchant-defined-field-14'} : '';
		$address2 = $transactionDetails->{'merchant-defined-field-11'} ? $transactionDetails->{'merchant-defined-field-11'} : '';
		$city = $transactionDetails->{'merchant-defined-field-15'} ? $transactionDetails->{'merchant-defined-field-15'} : '';
		$state = $transactionDetails->{'merchant-defined-field-16'} ? $transactionDetails->{'merchant-defined-field-16'} : '';
		$postal = $transactionDetails->{'merchant-defined-field-17'} ? $transactionDetails->{'merchant-defined-field-17'} : '';
		$phone = $transactionDetails->{'merchant-defined-field-18'} ? $transactionDetails->{'merchant-defined-field-18'} : '';
		
		$billingMethod = $transactionDetails->{'merchant-defined-field-12'} ? $transactionDetails->{'merchant-defined-field-12'} : '';
		$amount = $transactionDetails->{'amount'} ? $transactionDetails->{'amount'} : '';
		
		$billingMethodEmailText = 'One Time Donation';
		if ($billingMethod == 'recurring') {
			$billingMethodEmailText = 'Monthly Recurring Donation';
		}
		
		// Convert specific field's first character of each word to uppercase
		$firstName = gla_ucwords ( $firstName );
		$lastName = gla_ucwords ( $lastName );
		$address1 = gla_ucwords ( $address1 );
		$address2 = gla_ucwords ( $address2 );
		$city = gla_ucwords ( $city );
		
		$message = ' <div>
  				Dear ' . $title . ' ' . $firstName . ' ' . $lastName . ',
  						
  	<p>
  		Thank you very much for your donation.  It is through the generosity of people like you that we are able to continue our work.  Your support truly makes a difference!!
  	</p>
   <p>
		Your contribution is tax-deductible to the extent allowed by law. No goods or services were received for this donation. Global Lyme Alliance, Inc. is a tax exempt charitable organization under Section 501(c)3 of the Internal Revenue Service Code. Our tax ID number is 06-1559393. Please save or print this receipt for your records.
  	</p>
  						
  <h2>Donor Information</h2>
  <table>
  <tr>
	<td>Donor First Name</td>
	<td>' . $firstName . '</td>
  </tr>
  <tr>
	<td>Donor Last Name</td>
	<td>' . $lastName . '</td>
  </tr>
  <tr>
	<td>Company Name</td>
	<td>' . $companyName . '</td>
  </tr>
  <tr>
	<td>Donor Address</td>
	<td>' . $address1 . '</td>
  </tr>
    <tr>
	<td>Address 2</td>
	<td>' . $address2 . '</td>
  </tr>
   </tr>
   <tr>
	<td>Country</td>
	<td>' . $country . '</td>
  </tr>
  <tr>
	<td>City</td>
	<td>' . $city . '</td>
  </tr>';
		
		if ($country == 'US') {
			$message .= '<tr>
	<td>Donor State/Province</td>
	<td>' . $state . '</td>
  </tr>';
		}
		
		$message .= '<tr>
	<td>Donor Zip/Postal Code</td>
	<td>' . $postal . '</td>
  </tr>
  <tr>
	<td>Phone</td>
	<td>' . $phone . '</td>
  </tr>
  <tr>
	<td>Donor Email</td>
	<td>' . $email . '</td>
  </tr>
  </table>
			
  <h2>Items selected for ' . $title . ' ' . $firstName . ' ' . $lastName . '</h2>
  <table>
  <tr>
	<td>' . $billingMethodEmailText . '</td>
	<td>$' . $amount . '</td>
  </tr>
  </table>
			
  <h2>Details for ' . $title . ' ' . $firstName . ' ' . $lastName . '</h2>
  <table>
  <tr>
	<td>Item</td>
	<td>Donation</td>
  </tr>
  <tr>
	<td>Amount</td>
	<td>$' . $amount . '</td>
  </tr>
  <tr>
	<td>Type of Donation</td>
	<td>' . $billingMethodEmailText . '</td>
  </tr>
  </table>';
		
		$typeOfTribute = '';
		if ($sessionData ['merchant-defined-field-9'] == 'M')
			$typeOfTribute = 'In Memory of';
		elseif ($sessionData ['merchant-defined-field-9'] == 'H')
			$typeOfTribute = 'In Honor of';
		
		if ($sessionData ['tributeNotification'] != 'YES')
			$sessionData ['tributeState'] = '';
		
		if ($sessionData ['tributeEnabled'] == 'YES') {
			$message .= '<h2>Tribute Details</h2>
  <table>
  <tr>
	<td>Type of Tribute</td>
	<td>' . $typeOfTribute . '</td>
  </tr>
  <tr>
	<td>Does your company has a matching gift program?</td>
	<td>' . $sessionData ['merchant-defined-field-5'] . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree First Name</td>
	<td>' . gla_ucwords ( $sessionData ['merchant-defined-field-6'] ) . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Last Name</td>
	<td>' . gla_ucwords ( $sessionData ['merchant-defined-field-7'] ) . '</td>
  </tr>
  <tr>
	<td>Do you want a notification sent to the person being honored?</td>
	<td>' . $sessionData ['tributeNotification'] . '</td>
  </tr>
  <tr>
	<td>Name</td>
	<td>' . gla_ucwords ( $sessionData ['tributeNotifyName'] ) . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Address</td>
	<td>' . gla_ucwords ( $sessionData ['tributeAddress'] ) . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree City</td>
	<td>' . gla_ucwords ( $sessionData ['tributeCity'] ) . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree State/Province</td>
	<td>' . $sessionData ['tributeState'] . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Zip/Postal Code</td>
	<td>' . $sessionData ['tributePostal'] . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Email</td>
	<td>' . $sessionData ['tributeEmail'] . '</td>
  </tr>
  </table>';
		}
		$message .= '</div>';
		
		$email = $billingetails->{'email'} ? $billingetails->{'email'} : '';
		
		$donateMail = SimpleMail::make ()->setTo ( $email )->setFrom ( 'info@globallymealliance.org', 'Global Lyme Alliance' )->setSubject ( 'Thank you from Global Lyme Alliance' )->setMessage ( $message )->setReplyTo ( 'info@globallymealliance.org', 'Global Lyme Alliance' )->setBcc ( $this->donorEmailList )->setHtml ()->setWrap ( 100 );
		$send = $donateMail->send ();
		
		$send ? $this->log->info ( 'Email sent successfully' ) : $this->log->info ( 'Could not send email' );
	}
	
	
	function saveDonor($transactionDetails) {
		$billingetails = $transactionDetails->{'billing'};
		
		$this->log->info ( "Title :" . $transactionDetails->{'merchant-defined-field-3'} );
		$this->log->info ( "First Name :" . $transactionDetails->{'merchant-defined-field-1'} );
		$this->log->info ( "Last Name :" . $transactionDetails->{'merchant-defined-field-2'} );
		$this->log->info ( "Email :" . $billingetails->{'email'} );
		$this->log->info ( "ORG_REC :" . $transactionDetails->{'merchant-defined-field-4'} );
		$this->log->info ( "country :" . $transactionDetails->{'merchant-defined-field-13'} );
		$this->log->info ( "address1 :" . $transactionDetails->{'merchant-defined-field-14'} );
		$this->log->info ( "address2 :" . $transactionDetails->{'merchant-defined-field-11'} );
		$this->log->info ( "city :" . $transactionDetails->{'merchant-defined-field-15'} );
		$this->log->info ( "state :" . $transactionDetails->{'merchant-defined-field-16'} );
		$this->log->info ( "postal :" . $transactionDetails->{'merchant-defined-field-17'} );
		$this->log->info ( "phone :" . $transactionDetails->{'merchant-defined-field-18'} );
		
		$title = $this->clean ( $transactionDetails->{'merchant-defined-field-3'} ? $transactionDetails->{'merchant-defined-field-3'} : '' );
		$firstName = $this->clean ( $transactionDetails->{'merchant-defined-field-1'} ? $transactionDetails->{'merchant-defined-field-1'} : '' );
		$lastName = $this->clean ( $transactionDetails->{'merchant-defined-field-2'} ? $transactionDetails->{'merchant-defined-field-2'} : '' );
		$email = $this->clean ( $billingetails->{'email'} ? $billingetails->{'email'} : '' );
		$isCorp = $this->clean ( $transactionDetails->{'merchant-defined-field-4'} ? $transactionDetails->{'merchant-defined-field-4'} : '' );
		$companyName = $this->clean ( $billingetails->{'company'} ? $billingetails->{'company'} : '' );
		$country = $this->clean ( $transactionDetails->{'merchant-defined-field-13'} ? $transactionDetails->{'merchant-defined-field-13'} : '' );
		$address1 = $this->clean ( $transactionDetails->{'merchant-defined-field-14'} ? $transactionDetails->{'merchant-defined-field-14'} : '' );
		$address2 = $this->clean ( $transactionDetails->{'merchant-defined-field-11'} ? $transactionDetails->{'merchant-defined-field-11'} : '' );
		$city = $this->clean ( $transactionDetails->{'merchant-defined-field-15'} ? $transactionDetails->{'merchant-defined-field-15'} : '' );
		$state = $this->clean ( $transactionDetails->{'merchant-defined-field-16'} ? $transactionDetails->{'merchant-defined-field-16'} : '' );
		$postal = $this->clean ( $transactionDetails->{'merchant-defined-field-17'} ? $transactionDetails->{'merchant-defined-field-17'} : '' );
		$phone = $this->clean ( $transactionDetails->{'merchant-defined-field-18'} ? $transactionDetails->{'merchant-defined-field-18'} : '' );
		
		// Convert specific field's first character of each word to uppercase
		$firstName = gla_ucwords ( $firstName );
		$lastName = gla_ucwords ( $lastName );
		$address1 = gla_ucwords ( $address1 );
		$address2 = gla_ucwords ( $address2 );
		$city = gla_ucwords ( $city );
		
		// Handle Corporate donation
		$donor_type = 'IN';
		$opt_line = ''; // Contact name
		
		if ($isCorp == 'Y') {
			$donor_type = 'OR';
			$opt_line = $firstName . ' ' . $lastName;
			$firstName = '';
			$lastName = $companyName;
			$title = '';
		}
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_savedonor&params=";
		$request .= "0,"; // @donor_id
		$request .= "'$firstName',"; // @first_name
		$request .= "'$lastName',"; // @last_name
		$request .= "null,"; // @middle_name
		$request .= "null,"; // @suffix
		$request .= "'$title',"; // @title
		$request .= "null,"; // @salutation
		$request .= "null,"; // @prof_title
		$request .= "'$opt_line',"; // @opt_line
		$request .= "'$address1',"; // @address
		$request .= "'$address2',"; // $address2
		$request .= "'$city',"; // @city
		$request .= "'$state',"; // @state
		$request .= "'$postal',"; // @zip
		$request .= "'$country',"; // @country
		$request .= "null,"; // @address_type
		$request .= "'$phone',"; // @home_phone
		$request .= "null,"; // @business_phone
		$request .= "null,"; // @fax_phone
		$request .= "'',"; // @mobile_phone
		$request .= "'$email',"; // @email
		$request .= "'$isCorp',"; // @org_rec
		$request .= "'$donor_type',"; // @donor_type
		$request .= "'N',"; // @nomail
		$request .= "null,"; // @nomail_reason
		$request .= "null,"; // @narrative
		$request .= "'GLA API User'"; // @user_id

		$this->log->info ( "Donor save Request before encode:" . $request );
		$request = urlencode ( $request );
		
		$this->log->info ( "Donor save Request :" . $request );
		$donorDetails;
		try {
			$donorDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			mail ( $this->emailList, "Error Saving Donor Information", "Donor Information save in DP is Fully or Partially Failed. See log file for more details. Donor First Name:" . $firstName . ", Second Name:" . $lastName );
			$this->log->error ( "Unable to Save Donor", $e );
		}
		
		$this->log->info ( "Donor Save Information is " . print_r ( $donorDetails, true ) );
		
		return $donorDetails;
	}
	
	
	function saveDonorPledge($transactionDetails, $donorId) {
		$firstName = $this->clean ( $transactionDetails->{'merchant-defined-field-1'} ? $transactionDetails->{'merchant-defined-field-1'} : '' );
		$lastName = $this->clean ( $transactionDetails->{'merchant-defined-field-2'} ? $transactionDetails->{'merchant-defined-field-2'} : '' );
		
		$date = date ( "m/d/Y" );
		$amount = $this->clean ( $transactionDetails->{'amount'} ? $transactionDetails->{'amount'} : '' );
		$memoryHonor = $this->clean ( $transactionDetails->{'merchant-defined-field-9'} ? $transactionDetails->{'merchant-defined-field-9'} : '' );
		$gfname = $this->clean ( $transactionDetails->{'merchant-defined-field-6'} ? $transactionDetails->{'merchant-defined-field-6'} : '' );
		$glname = $this->clean ( $transactionDetails->{'merchant-defined-field-7'} ? $transactionDetails->{'merchant-defined-field-7'} : '' );
		$customerVaultId = $transactionDetails->{'customer-vault-id'} ? $transactionDetails->{'customer-vault-id'} : '0';
		
		$this->log->info ( "Pledge Date :" . $date );
		$this->log->info ( "Pledge Amount :" . $amount );
		$this->log->info ( "Pledge Memory :" . $memoryHonor );
		$this->log->info ( "Pledge First name :" . $gfname );
		$this->log->info ( "Pledge Last Name :" . $glname );
		
		// Convert specific field's first character of each word to uppercase
		$firstName = gla_ucwords ( $firstName );
		$lastName = gla_ucwords ( $lastName );
		$gfname = gla_ucwords ( $gfname );
		$glname = gla_ucwords ( $glname );
		
		// Handle Solicitation
		$solicit_code = 'UNSO';
		if ($memoryHonor == 'M')
			$solicit_code = 'MEMR';
		elseif ($memoryHonor == 'H')
			$solicit_code = 'HON';
		
		$sub_solicit_code = $this->dpConfig['sub_solicit_code'];
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_savepledge&params=";
		$request .= "0,"; // @gift_id numeric Enter 0 in this field to create a new pledge or the gift ID of an existing pledge.
		$request .= "'$donorId',"; // @donor_id numeric Enter the donor_id of the person for whom the pledge is being created/updated
		$request .= "'$date',"; // @gift_date datetime
		$request .= "'$date',"; // @start_date datetime
		$request .= "0,"; // @total money Enter either the total amount to be pledged (the sum of all the expected payment amounts) or enter 0 (zero) if the pledge amount is to be collected ad infinitum
		$request .= "'$amount',"; // @bill money Enter the individual monthly/quarterly/annual billing amount
		$request .= "M,"; // @frequency Nvarchar (30) Enter one of: M (monthly), Q (quarterly), S (semi-annually), A (annually)
		$request .= "Y,"; // @reminder Nvarchar (1) Sets the pledge reminder flag
		$request .= "CODO,"; // @gl_code Nvarchar(30) Contributions & Donations
		$request .= "'$solicit_code',"; // @solicit_code Nvarchar(30)
		$request .= "'Y',"; // @initial_payment Nvarchar (1) Set to ‘’Y’ for intial payment, otherwise ‘N’
		$request .= "'$sub_solicit_code',"; // @sub_solicit_code Nvarchar(30)
		$request .= "0,"; // @writeoff_amount, money
		$request .= "'',"; // @writeoff_date datetime
		$request .= "'GLA API User',"; // @user_id NNvarchar(20),
		$request .= "NULL,"; // @campaign Nvarchar(30) Or NULL
		$request .= "NULL,"; // @membership_type Nvarchar(30) Or NULL
		$request .= "NULL,"; // @membership_level Nvarchar(30) Or NULL
		$request .= "NULL,"; // @membership_enr_date datetime Or NULL
		$request .= "NULL,"; // @membership_exp_date datetime Or NULL
		$request .= "NULL,"; // @membership_link_ID numeric Or NULL
		$request .= "NULL,"; // @address_id numeric Or NULL
		$request .= "NULL,"; // @gift_narrative Nvarchar(3000) Or NULL
		$request .= "NULL,"; // @ty_letter_no Nvarchar(30) Or NULL
		$request .= "'$customerVaultId',"; // @vault_id Nvarchar(55) Or NULL
		$request .= "'N',"; // @receipt_delivery_g Nvarchar(30) ‘E’ for email, ‘B’ for both email and letter, ‘L’ for letter, ‘N’ for do not acknowledge or NULL
		$request .= "NULL"; // @contact_id numeric Or NULL
		
		$this->log->info ( "Pledge Gift save Request before encode:" . $request );
		
		$request = urlencode ( $request );
		
		$this->log->info ( "Pledge Gift save Request :" . $request );
		
		try {
			$pledgeDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			mail ( $this->emailList, "Error Saving Donor Information", "Donor Information save in DP is Fully or Partially Failed. See log file for more details. Donor First Name:" . $firstName . ", Second Name:" . $lastName );
			$this->log->error ( "Pledge Unable to save the Gift", $e );
		}
		$this->log->info ( "Pledge Gift Save Information is " . print_r ( $pledgeDetails, true ) );
		
		return $pledgeDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
	}
	
	
	function saveDonorGifts($transactionDetails, $donorId, $pledgeID) {
		$firstName = $this->clean ( $transactionDetails->{'merchant-defined-field-1'} ? $transactionDetails->{'merchant-defined-field-1'} : '' );
		$lastName = $this->clean ( $transactionDetails->{'merchant-defined-field-2'} ? $transactionDetails->{'merchant-defined-field-2'} : '' );
		
		$date = date ( "m/d/Y" );
		$amount = $this->clean ( $transactionDetails->{'amount'} ? $transactionDetails->{'amount'} : '' );
		$transactionID = $this->clean ( $transactionDetails->{'transaction-id'} ? $transactionDetails->{'transaction-id'} : '' );
		$memoryHonor = $this->clean ( $transactionDetails->{'merchant-defined-field-9'} ? $transactionDetails->{'merchant-defined-field-9'} : '' );
		$gfname = $this->clean ( $transactionDetails->{'merchant-defined-field-6'} ? $transactionDetails->{'merchant-defined-field-6'} : '' );
		$glname = $this->clean ( $transactionDetails->{'merchant-defined-field-7'} ? $transactionDetails->{'merchant-defined-field-7'} : '' );
		
		// Convert specific field's first character of each word to uppercase
		$firstName = gla_ucwords ( $firstName );
		$lastName = gla_ucwords ( $lastName );
		$gfname = gla_ucwords ( $gfname );
		$glname = gla_ucwords ( $glname );
		
		$this->log->info ( "Date :" . $date );
		$this->log->info ( "Amount :" . $amount );
		$this->log->info ( "Memory :" . $memoryHonor );
		$this->log->info ( "First name :" . $gfname );
		$this->log->info ( "Last Name :" . $glname );
		
		// Handle Solicitation
		$solicit_code = 'UN';
		if (($memoryHonor == 'M') || ($memoryHonor == 'H'))
			$solicit_code = 'TRB';
		// elseif($memoryHonor == 'H' )$solicit_code = 'HON';
		
		// Handle Pledge
		$pledge_payment = 'N';
		if ($pledgeID != "") {
			$pledge_payment = 'Y';
		}
		
		// Thank-You Letter
		$ty_letter_no = "01";
		$amountNumber = number_format ( $amount, 2 );
		if (bccomp ( $amountNumber, 250 ) == - 1)
			$ty_letter_no = "NOLTR";
		
		$sub_solicit_code = $this->dpConfig['sub_solicit_code'];	
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_savegift&params=";
		$request .= "0,"; // @gift_id
		$request .= "$donorId,"; // @donor_id
		$request .= "'G',"; // @record_type
		$request .= "'$date',"; // @gift_date
		$request .= "$amount,"; // @amount
		$request .= "CODO,"; // @gl_code Contributions & Donations
		$request .= "'$solicit_code',"; // @solicit_code
		$request .= "'$sub_solicit_code',"; // @sub_solicit_code
		$request .= "'CC',"; // @gift_type
		$request .= "'N',"; // @split_gift
		$request .= "'$pledge_payment',"; // @pledge_payment
		$request .= "'$transactionID',"; // @reference
		$request .= "'$memoryHonor',"; // @memory_honor
		$request .= "'$gfname',"; // @gfname
		$request .= "'$glname',"; // @glname
		$request .= "0,"; // @fmv
		$request .= "0,"; // @batch_no
		$request .= "null,"; // @gift_narrative
		$request .= "'$ty_letter_no',"; // @ty_letter_no
		$request .= "null,"; // @glink
		if ($pledgeID != '')
			$request .= "'$pledgeID',"; // @plink
		else
			$request .= "null,"; // @plink
		$request .= "'N',"; // @nocalc
		$request .= "'N',"; // @receipt
		$request .= "null,"; // @old_amount
		$request .= "'GLA API User'"; // @user_id
		
		$this->log->info ( "Gift save Request before encode:" . $request );
		
		$request = urlencode ( $request );
		
		$this->log->info ( "Gift save Request :" . $request );
		
		try {
			$giftDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			mail ( $this->emailList, "Error Saving Donor Gift Information", "Donor Gift Information save in DP is Fully or Partially Failed. See log file for more details. Donor First Name:" . $firstName . ", Second Name:" . $lastName );
			$this->log->error ( "Unable to save the Gift", $e );
		}
		$this->log->info ( "Gift Save Information is " . print_r ( $giftDetails, true ) );
		
		return $giftDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
	}
	
	function saveNotificationDonor ($transactionDetails, $sessionData) {
		$billingetails = $transactionDetails->{'billing'};
		
		$firstName = $this->clean ( $sessionData['tributeNotifyName'] ? $sessionData['tributeNotifyName']: '' );
		$email = $this->clean ( $sessionData['tributeEmail'] ? $sessionData['tributeEmail'] : '' );
		$address1 = $this->clean ( $sessionData['tributeAddress'] ? $sessionData['tributeAddress'] : '' );
		$city = $this->clean ( $sessionData['tributeCity'] ? $sessionData['tributeCity'] : '' );
		$state = $this->clean ( $sessionData['tributeState'] ? $sessionData['tributeState'] : '' );
		$postal = $this->clean ( $sessionData['tributePostal'] ? $sessionData['tributePostal'] : '' );
		
		if( $firstName == '' ){
			return 0;
		}
		
		// Convert specific field's first character of each word to uppercase
		$firstName = gla_ucwords ( $firstName );
		$lastName = '';
		$address1 = gla_ucwords ( $address1 );
		$city = gla_ucwords ( $city );
		
		// Handle Corporate donation
		$donor_type = 'IN';
		$country = 'US';
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_savedonor&params=";
		$request .= "0,"; // @donor_id
		$request .= "'$firstName',"; // @first_name
		$request .= "'$lastName',"; // @last_name
		$request .= "null,"; // @middle_name
		$request .= "null,"; // @suffix
		$request .= "null,"; // @title
		$request .= "null,"; // @salutation
		$request .= "null,"; // @prof_title
		$request .= "null,"; // @opt_line
		$request .= "'$address1',"; // @address
		$request .= "null,"; // $address2
		$request .= "'$city',"; // @city
		$request .= "'$state',"; // @state
		$request .= "'$postal',"; // @zip
		$request .= "'$country',"; // @country
		$request .= "null,"; // @address_type
		$request .= "null,"; // @home_phone
		$request .= "null,"; // @business_phone
		$request .= "null,"; // @fax_phone
		$request .= "'',"; // @mobile_phone
		$request .= "'$email',"; // @email
		$request .= "null,"; // @org_rec
		$request .= "'$donor_type',"; // @donor_type
		$request .= "'N',"; // @nomail
		$request .= "null,"; // @nomail_reason
		$request .= "null,"; // @narrative
		$request .= "'GLA API User'"; // @user_id
		
		$request = urlencode ( $request );
		
		$this->log->info ( "Donor save Request :" . $request );
		$donorDetails;
		try {
			$donorDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			mail ( $this->emailList, "Error Saving Notification Donor Information", "Notification Donor Information save in DP is Fully or Partially Failed. See log file for more details. Donor First Name:" . $firstName . ", Second Name:" . $lastName );
			$this->log->error ( "Unable to Save Notification Donor", $e );
		}
		
		$this->log->info ( "Notification Donor Save Information is " . print_r ( $donorDetails, true ) );
		
		return $donorDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
	}
	
	function saveDonorGiftTribute($transactionDetails, $donorId) {
		$date = date ( "m/d/Y" );
		$memoryHonor = $this->clean ( $transactionDetails->{'merchant-defined-field-9'} ? $transactionDetails->{'merchant-defined-field-9'} : '' );
		$gfname = $this->clean ( $transactionDetails->{'merchant-defined-field-6'} ? $transactionDetails->{'merchant-defined-field-6'} : '' );
		$glname = $this->clean ( $transactionDetails->{'merchant-defined-field-7'} ? $transactionDetails->{'merchant-defined-field-7'} : '' );
		$code_ID = '0';
		
		// Convert specific field's first character of each word to uppercase
		$gfname = gla_ucwords ( $gfname );
		$glname = gla_ucwords ( $glname );
		$tributeName = $gfname . ' ' . $glname;
		
		if ($memoryHonor === 'M')
			$code_ID = $this->dpConfig['code_id_memory'];
		elseif ($memoryHonor === 'H')
			$code_ID = $this->dpConfig['code_id_honor'];
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_tribAnon_Create&params=";
		$request .= "'$tributeName',"; // @Name Varchar(50)
		$request .= "$code_ID,"; // @Code_ID numeric ( The standard values ar M (In Memory Of) and H (In Honor Of) but you will not be specifying the letter value here but rather the numeric value of the code_ID.)
		$request .= "1,"; // @Active_Flag Numeric Enter 1 here to make the tribute active or 0 to make it inactive.
		$request .= "'$date',"; // @UserCreateDt  Date Enter the current date in this format: mm/dd/yyyy and place single quotes around the date.
		if( $donorId != 0)
			$request .= "$donorId"; // @Recipients Varchar Enter either the donor_id of a single recipient OR multiple donor_id values separated by the pipe symbol and wrapped in single quotes.
		else
			$request .= "null"; // @Recipients Varchar Enter either the donor_id of a single recipient OR multiple donor_id values separated by the pipe symbol and wrapped in single quotes.
		
		$this->log->info ( "GiftTribute save Request before encode:" . $request );
		
		$request = urlencode ( $request );
		
		$this->log->info ( "Gift tribute save Request :" . $request );
		
		try {
			$giftTributeDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			mail ( $this->emailList, "Error Saving Gift Tribute Information", "Donor Information save in DP is Fully or Partially Failed. See log file for more details. Donor First Name:" . $firstName . ", Second Name:" . $lastName );
			$this->log->error ( "Unable to save the Gift tribute", $e );
		}
		$this->log->info ( "Gift Tribute Save Information is " . print_r ( $giftTributeDetails, true ) );
		
		return $giftTributeDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
	}
	
	
	function assocTribsToGift($tributeId, $giftId) {
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_tribAnon_AssocTribsToGift&params=";
		$request .= "$giftId,"; // @Gift_ID numeric Specify the GIFT_ID of the gift that will be associated with the specified tribute
		$request .= "$tributeId"; // @TributeID numeric Enter the TributeID of the tribute. Tribute IDs are included in the data retrieved in the dp_tribAnon_MyTribSummary API call.
		
		$this->log->info ( "assocTribsToGift Request before encode:" . $request );
		
		$request = urlencode ( $request );
		
		$this->log->info ( "assocTribsToGift Request :" . $request );
		
		try {
			$assocTribsToGiftDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			mail ( $this->emailList, "Error Associating Tributes To Gift", "Donor Information save in DP is Fully or Partially Failed. See log file for more details. Donor First Name:" . $firstName . ", Second Name:" . $lastName );
			$this->log->error ( "Unable to Associate Tributes To Gift", $e );
		}
		$this->log->info ( " Associating Tributes To Gift Information is " . print_r ( $assocTribsToGiftDetails, true ) );
		
		return $assocTribsToGiftDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
	}
	
	function saveDonorPayment($transactionDetails, $donorDetails, $donorGiftDetails, $pledgeID) {
		$PaymentDetails = array ();
		
		$firstName = $this->clean ( $transactionDetails->{'merchant-defined-field-1'} ? $transactionDetails->{'merchant-defined-field-1'} : '' );
		$lastName = $this->clean ( $transactionDetails->{'merchant-defined-field-2'} ? $transactionDetails->{'merchant-defined-field-2'} : '' );
		
		$matchingGift = $transactionDetails->{'merchant-defined-field-5'} ? $transactionDetails->{'merchant-defined-field-5'} : 'NO';
		$billingetails = $transactionDetails->{'billing'};
		$transactionID = $this->clean ( $transactionDetails->{'transaction-id'} ? $transactionDetails->{'transaction-id'} : '' );
		$responseCode = $this->clean ( $transactionDetails->{'result-code'} ? $transactionDetails->{'result-code'} : '' );
		$authCode = $this->clean ( $transactionDetails->{'authorization-code'} ? $transactionDetails->{'authorization-code'} : '' );
		$amount = $this->clean ( $transactionDetails->{'amount'} ? $transactionDetails->{'amount'} : '' );
		
		$companyName = $this->clean ( $billingetails->{'company'} ? $billingetails->{'company'} : '' );
		$cardHolderName = $billingetails->{'first-name'} ? $billingetails->{'first-name'} : '';
		$cardHolderName .= ' ';
		$cardHolderName .= $billingetails->{'last-name'} ? $billingetails->{'last-name'} : '';
		$cardHolderName = $this->clean ( $cardHolderName );
		$cardNumber = $this->clean ( $billingetails->{'cc-number'} ? $billingetails->{'cc-number'} : '' );
		$cardExp = $this->clean ( $billingetails->{'cc-exp'} ? $billingetails->{'cc-exp'} : '' );
		$cardaddress = $this->clean ( $billingetails->{'address1'} ? $billingetails->{'address1'} : '' );
		$cardCity = $this->clean ( $billingetails->{'city'} ? $billingetails->{'city'} : '' );
		$cardState = $this->clean ( $billingetails->{'state'} ? $billingetails->{'state'} : '' );
		$cardZip = $this->clean ( $billingetails->{'postal'} ? $billingetails->{'postal'} : '' );
		$date = date ( "m/d/Y" );
		
		$customerVaultId = $transactionDetails->{'customer-vault-id'} ? $transactionDetails->{'customer-vault-id'} : '0';
		
		// Convert specific field's first character of each word to uppercase
		$firstName = gla_ucwords ( $firstName );
		$lastName = gla_ucwords ( $lastName );
		$cardHolderName = gla_ucwords ( $cardHolderName );
		$cardaddress = gla_ucwords ( $cardaddress );
		$cardCity = gla_ucwords ( $cardCity );
		
		// DP APIs dp_paymentmethod_insert does not insert all the fields so using the Query insert above
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_paymentmethod_insert&params=";
		$request .= "'$customerVaultId',"; // @CustomerVaultID Nvarchar(55) Enter -0 to create a new Customer Vault ID record
		$request .= "'$donorDetails',"; // @donor_id int
		$request .= "1,"; // @IsDefault bit Bit Enter 1 if this is will be the default EFT payment method
		$request .= "null,"; // @AccountType Nvarchar(256) e.g. ‘Visa’
		$request .= "'creditcard',"; // @dpPaymentMethodTypeID Nvarchar(20) e.g.; ‘creditcard’
		$request .= "'$cardNumber',"; // @CardNumberLastFour Nvarchar(16) e.g.; ‘4xxxxxxxxxxx1111
		$request .= "'$cardExp',"; // @CardExpirationDate Nvarchar(10) e.g.; ‘0810’
		$request .= "null,"; // @BankAccountNumberLastFour Nvarchar(50)
		$request .= "'$cardHolderName',"; // @NameOnAccount Nvarchar(256)
		$request .= "'$date',"; // @CreatedDate datetime
		$request .= "null,"; // @ModifiedDate datetime
		$request .= "null,"; // @import_id int
		$request .= "null,"; // @created_by Nvarchar(20)
		$request .= "null,"; // @modified_by Nvarchar(20)
		$request .= "'USD'"; // @selected_currency Nvarchar(3)
		
		if ($pledgeID != '') {
			$this->log->info ( "Payment save Request before encode:" . $request );
			
			$request = urlencode ( $request );
			
			$this->log->info ( "Payment save Request :" . $request );
			
			try {
				$PaymentDetails = simplexml_load_file ( $request );
			} catch ( Exception $e ) {
				mail ( $this->emailList, "Error Saving Donor Information", "Donor Information save in DP is Fully or Partially Failed. See log file for more details. Donor First Name:" . $firstName . ", Second Name:" . $lastName );
				$this->log->error ( " The Unable to save Payment details " . $e );
			}
			
			$this->log->info ( "Payment Save Information is " );
			$this->log->info ( $PaymentDetails );
		}
		
		/*
		 * $companyNameStatus = $this->dp_save_udf_xml($donorDetails, 'EMPLOYER', 'C', $companyName, 'null', 'null', 'GLA API User' );
		 * $this->log->info ( "Company name is ". print_r( $companyNameStatus, true ) );
		 */
		
		$cardHolderNameStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'CARDHOLDERNAME', 'C', $cardHolderName, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card name is " . print_r ( $cardHolderNameStatus, true ) );
		
		$cardHolderNumStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'CARDACCOUNTNUM', 'C', $cardNumber, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card Num is " . print_r ( $cardHolderNumStatus, true ) );
		
		$cardHolderExpStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'EXPIRATIONDATE', 'C', $cardExp, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card Exp is " . print_r ( $cardHolderExpStatus, true ) );
		
		$cardHolderAddStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'CARDHOLDERADDRESS', 'C', $cardaddress, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card Address is " . print_r ( $cardHolderAddStatus, true ) );
		
		$cardHolderCityStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'CARDHOLDERCITY', 'C', $cardCity, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card City is " . print_r ( $cardHolderCityStatus, true ) );
		
		$cardHolderStateStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'CARDHOLDERSTATE', 'C', $cardState, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card State is " . print_r ( $cardHolderStateStatus, true ) );
		
		$cardHolderZipStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'CARDHOLDERZIP', 'C', $cardZip, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card Zip is " . print_r ( $cardHolderZipStatus, true ) );
		
		$referenceNumber = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'REFERENCE_NUMBER', 'C', $transactionID, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card Reference " . print_r ( $referenceNumber, true ) );
		
		$responseCodeStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'RESPONSE_CODE', 'C', $responseCode, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Response code " . print_r ( $responseCodeStatus, true ) );
		
		$vaultSaveStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'CUSTOMER_VAULT_ID', 'C', $customerVaultId, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Gift Vault status " . print_r ( $vaultSaveStatus, true ) );
		
		$authCodeSaveStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'AUTHCODE', 'C', $authCode, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Auth Code status " . print_r ( $authCodeSaveStatus, true ) );
		
		if ($pledgeID != '') {
			$eftAccountNumber = $this->dp_save_udf_xml ( $transactionDetails, $pledgeID, 'ACCOUNT', 'C', $cardNumber, 'null', 'null', 'GLA API User' );
			$this->log->info ( "EFT account Num is " . print_r ( $eftAccountNumber, true ) );
			
			$eftExpStatus = $this->dp_save_udf_xml ( $transactionDetails, $pledgeID, 'CC_EXP', 'C', $cardExp, 'null', 'null', 'GLA API User' );
			$this->log->info ( "EFT Card Exp is " . print_r ( $eftExpStatus, true ) );
			
			$eftPaymentDate = $this->dp_save_udf_xml ( $transactionDetails, $pledgeID, 'EFT_DT', 'D', $date, 'null', 'null', 'GLA API User' );
			$this->log->info ( "EFT Payment Date is " . print_r ( $eftPaymentDate, true ) );
			
			$eftPaymentStatus = $this->dp_save_udf_xml ( $transactionDetails, $pledgeID, 'EFT', 'C', 'Y', 'null', 'null', 'GLA API User' );
			$this->log->info ( "EFT Payment Status is " . print_r ( $eftPaymentStatus, true ) );
			
			$eftScheduled = $this->dp_save_udf_xml ( $transactionDetails, $pledgeID, 'scheduledEFT', 'C', 'M', 'null', 'null', 'GLA API User' );
			$this->log->info ( "EFT Scheduled Status is " . print_r ( $eftScheduled, true ) );
			
			$tranactionCodeStatus = $this->dp_save_udf_xml ( $transactionDetails, $pledgeID, 'TRANSACTION_CODE', 'C', $transactionID, 'null', 'null', 'GLA API User' );
			$this->log->info ( "Transaction code Status is " . print_r ( $tranactionCodeStatus, true ) );
			
			$tranactionStatus = $this->dp_save_udf_xml ( $transactionDetails, $pledgeID, 'TRANSACTION_STATUS', 'C', 'Ok', 'null', 'null', 'GLA API User' );
			$this->log->info ( "Transaction Status is " . print_r ( $tranactionStatus, true ) );
			
			$tranactionAmountStatus = $this->dp_save_udf_xml ( $transactionDetails, $pledgeID, 'TRANSACTIONAMOUNT', 'C', $amount, 'null', 'null', 'GLA API User' );
			$this->log->info ( "Transaction Amount Status is " . print_r ( $tranactionAmountStatus, true ) );
		}
		
		// $matchingGiftStatus = $this->dp_save_udf_xml($transactionDetails, $donorGiftDetails, 'GMG', 'C', $matchingGift, 'null', 'null', 'GLA API User' );
		$matchingGiftStatus = $this->dp_save_udf_xml ( $transactionDetails, $donorGiftDetails, 'MATCHING_GIFT', 'C', $matchingGift, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Matching gift is " . print_r ( $matchingGiftStatus, true ) );
		// TODO This above field name should be changed to MATCHING_GIFT
		
		if ($pledgeID != '') {
			return $PaymentDetails->{'record'}->{'field'} [0]->attributes ();
		} else {
			return $PaymentDetails;
		}
		
		/*
		 * $request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		 * $request .= "&action=INSERT INTO dpgiftudf ";
		 * $request .= "(gift_id,CARDHOLDERNAME,CARDACCOUNTNUM,CC_EXP,CARDHOLDERADDRESS,CARDHOLDERCITY,CARDHOLDERSTATE,CARDHOLDERZIP)";
		 * $request .= "VALUES";
		 * $request .= "('$donorGiftDetails','$cardHolderName','$cardNumber','$cardExp', '$cardaddress','$cardCity','$cardState','$cardZip')";
		 *
		 * $this->log->info( "Payment save Request before encode:". $request );
		 *
		 * $request = urlencode ( $request );
		 *
		 * $this->log->info( "Payment save Request :". $request );
		 * $PaymentDetails;
		 * try {
		 * $PaymentDetails = simplexml_load_file ( $request );
		 * } catch ( Exception $e ) {
		 * $this->log->error( " The Unable to save Payment details ".$e );
		 * }
		 * $this->log->info( "Payment Save Information is " );
		 * $this->log->info( $PaymentDetails );
		 *
		 * return $PaymentDetails->{'record'}->{'field'} [0]->attributes ();
		 */
	}
	
	
	function dp_save_udf_xml($transactionDetails, $matching_id, $field_name, $data_type, $char_value, $date_value, $number_value, $user_id) {
		$firstName = $this->clean ( $transactionDetails->{'merchant-defined-field-1'} ? $transactionDetails->{'merchant-defined-field-1'} : '' );
		$lastName = $this->clean ( $transactionDetails->{'merchant-defined-field-2'} ? $transactionDetails->{'merchant-defined-field-2'} : '' );
		
		// Convert specific field's first character of each word to uppercase
		$firstName = gla_ucwords ( $firstName );
		$lastName = gla_ucwords ( $lastName );
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_save_udf_xml&params=";
		
		$request .= "'$matching_id',"; // @matching_id numeric Specify either a donor_id value if updating a donor record, a gift_id value if updating a gift record or an other_id value if updating a dpotherinfo table value (see dp_saveotherinfo)
		$request .= "'$field_name',"; // @field_name Nvarchar(20)
		$request .= "'$data_type',"; // @data_type Nvarchar(1) C- Character, D-Date, N- Numeric
		$request .= "'$char_value',"; // @char_value Nvarchar(2000) Null if not a Character field
		$request .= "null,"; // @date_value datetime Null if not a Date field
		$request .= "null,"; // @number_value numeric (18,4) Null if not a Number field
		$request .= "'$user_id'"; // @user_id Nvarchar(20) We recommend that you use a name here, such as the name of your API application, for auditing purposes. The user_id value does not need to match the name of an actual DPO user account.
		
		$this->log->info ( "Gift UDF request is :" . $request );
		
		$request = urlencode ( $request );
		
		$this->log->info ( "Gift UDF request is  :" . $request );
		
		try {
			$giftUDFDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			mail ( $this->emailList, "Error Saving Donor Information", "Donor Information save in DP is Fully or Partially Failed. See log file for more details. Donor First Name:" . $firstName . ", Second Name:" . $lastName );
			$this->log->error ( " Unable to save Gift UDF details " . $e );
		}
		
		return $giftUDFDetails;
	}
	
	
	function clean($string) {
		$replaceArr = array (
				',',
				'#',
				'&',
				'+' 
		);
		
		// Replace single quotes with double single quotes as mentioned n http://api.warrenbti.com/?q=node/10
		$string = str_replace ( "'", "''", $string );
		return str_replace ( $replaceArr, "", $string );
	}
	
	function handleFailedDonorDetails($transactionStatus, $sessionData) {
		$title = $sessionData ['merchant-defined-field-3'];
		$firstName = $sessionData ['merchant-defined-field-1'];
		$lastName = $sessionData ['merchant-defined-field-2'];
		$email = $sessionData ['email'];
		$isCorp = $sessionData ['merchant-defined-field-4'] ? 'YES' : 'NO';
		$matchingGift = $sessionData ['merchant-defined-field-5'] ? $sessionData ['merchant-defined-field-5'] : 'NO';
		$companyName = $sessionData ['company'];
		$country = $sessionData ['country'];
		$address1 = $sessionData ['address1'];
		$address2 = $sessionData ['address2'];
		$city = $sessionData ['city'];
		$state = $sessionData ['state'];
		$postal = $sessionData ['postal'];
		$phone = $sessionData ['phone'];
		
		$billingMethod = $sessionData ['merchant-defined-field-12'];
		$amount = $sessionData ['donate'];
		$cardHolderFirstName = $sessionData ['billing-first-name'];
		$cardHolderLastName = $sessionData ['billing-last-name'];
		$cardaddress = $sessionData ['billing-address1'];
		$cardCity = $sessionData ['billing-city'];
		$cardState = $sessionData ['billing-state'];
		$cardCountry = $sessionData ['billing-country'];
		$cardZip = $sessionData ['billing-postal'];
		
		// Convert specific field's first character of each word to uppercase
		$firstName = gla_ucwords ( $firstName );
		$lastName = gla_ucwords ( $lastName );
		$address1 = gla_ucwords ( $address1 );
		$address2 = gla_ucwords ( $address2 );
		$city = gla_ucwords ( $city );
		$cardHolderFirstName = gla_ucwords ( $cardHolderFirstName );
		$cardHolderLastName = gla_ucwords ( $cardHolderLastName );
		$cardaddress = gla_ucwords ( $cardaddress );
		$cardCity = gla_ucwords ( $cardCity );
		
		$billingMethodEmailText = 'One Time Donation';
		if ($billingMethod == 'recurring') {
			$billingMethodEmailText = 'Monthly Recurring Donation';
		}
		
		$message = ' <div>
				
  	<p>
  		A Donation Submission is not success, The donation details are below,
  	</p>';
		
		$message .= '<p>Transaction Failure Reason : ' . $transactionStatus . '</p>';
		
		$message .= '<h2>Donor Information</h2>
  <table>
  <tr>
	<td>Donation Amount</td>
	<td>$' . $amount . '</td>
  </tr>
  <tr>
	<td>Donor Title</td>
	<td>' . $title . '</td>
  </tr>
  <tr>
	<td>Donor First Name</td>
	<td>' . $firstName . '</td>
  </tr>
  <tr>
	<td>Donor Last Name</td>
	<td>' . $lastName . '</td>
  </tr>
  <tr>
	<td>Email</td>
	<td>' . $email . '</td>
  </tr>
  <tr>
	<td>My company has a matching gift program:</td>
	<td>' . $matchingGift . '</td>
  </tr>
  <tr>
	<td>This is a corporate donation</td>
	<td>' . $isCorp . '</td>
  </tr>
  <tr>
	<td>Company Name</td>
	<td>' . $companyName . '</td>
  </tr>
  <tr>
	<td>Donor Address</td>
	<td>' . $address1 . '</td>
  </tr>
    <tr>
	<td>Address 2</td>
	<td>' . $address2 . '</td>
  </tr>
   </tr>
   <tr>
	<td>Country</td>
	<td>' . $country . '</td>
  </tr>
  <tr>
	<td>City</td>
	<td>' . $city . '</td>
  </tr>';
		
		if ($country == 'US') {
			$message .= '<tr>
	<td>Donor State/Province</td>
	<td>' . $state . '</td>
  </tr>';
		}
		
		$message .= '<tr>
	<td>Donor Zip/Postal Code</td>
	<td>' . $postal . '</td>
  </tr>
  <tr>
	<td>Phone</td>
	<td>' . $phone . '</td>
  </tr>
  </table>';
		
		$typeOfTribute = '';
		if ($sessionData ['merchant-defined-field-9'] == 'M')
			$typeOfTribute = 'In Memory of';
		elseif ($sessionData ['merchant-defined-field-9'] == 'H')
			$typeOfTribute = 'In Honor of';
		
		if ($sessionData ['tributeEnabled'] == 'YES') {
			$message .= '<h2>Tribute Details</h2>
  <table>
  <tr>
	<td>Type of Tribute</td>
	<td>' . $typeOfTribute . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree First Name</td>
	<td>' . gla_ucwords ( $sessionData ['merchant-defined-field-6'] ) . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Last Name</td>
	<td>' . gla_ucwords ( $sessionData ['merchant-defined-field-7'] ) . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Email</td>
	<td>' . $sessionData ['tributeEmail'] . '</td>
  </tr>
  <tr>
	<td>Name</td>
	<td>' . gla_ucwords ( $sessionData ['tributeNotifyName'] ) . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Address</td>
	<td>' .gla_ucwords ( $sessionData ['tributeAddress'] ) . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree City</td>
	<td>' . gla_ucwords ( $sessionData ['tributeCity'] ) . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree State/Province</td>
	<td>' . $sessionData ['tributeState'] . '</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Zip/Postal Code</td>
	<td>' . $sessionData ['tributePostal'] . '</td>
  </tr>
  </table>';
		}
		$message .= '<h2>Payment Details</h2>
  <table>
  <tr>
	<td>Card holder first name </td>
	<td>' . $cardHolderFirstName . '</td>
  </tr>
  <tr>
	<td>Card holder last name </td>
	<td>' . $cardHolderLastName . '</td>
  </tr>
  <tr>
	<td>Address</td>
	<td>' . $cardaddress . '</td>
  </tr>
  <tr>
	<td>Country</td>
	<td>' . $cardCountry . '</td>
  </tr>
  <tr>
	<td>City</td>
	<td>' . $cardCity . '</td>
  </tr>';
		if ($cardCountry == 'US') {
			$message .= '<tr>
	<td>Donor State/Province</td>
	<td>' . $cardState . '</td>
  </tr>';
		}
		$message .= '<tr>
	<td>Zip/Postal code</td>
	<td>' . $cardZip . '</td>
  </tr>
  </table>';
		
		$message .= '</div>';
		
		$donateMail = SimpleMail::make ()->
		// ->setTo($this->emailList)
		setFrom ( 'info@globallymealliance.org', 'Global Lyme Alliance' )->setSubject ( 'Donation Submission Failed' )->setMessage ( $message )->setReplyTo ( 'info@globallymealliance.org', 'Global Lyme Alliance' )->setHtml ()->setWrap ( 100 );
		
		foreach ( $this->emailList as $name => $email ) {
			
			$donateMail->setTo ( $email, $name );
		}
		
		$send = $donateMail->send ();
		
		$send ? $this->log->info ( 'Donation fail Email sent successfully' ) : $this->log->info ( 'Could not send email' );
	}
	
	
	function dp_donorsearch($transactionDetails) {
		$lastName = $this->clean ( $transactionDetails->{'merchant-defined-field-2'} ? $transactionDetails->{'merchant-defined-field-2'} : '' );
		$lastName = '%' . $lastName . '%';
		$address1 = $this->clean ( $transactionDetails->{'merchant-defined-field-14'} ? $transactionDetails->{'merchant-defined-field-14'} : '' );
		$state = $this->clean ( $transactionDetails->{'merchant-defined-field-16'} ? $transactionDetails->{'merchant-defined-field-16'} : '' );
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_donorsearch&params=";
		
		$request .= "null,"; // @donor_id numeric
		$request .= "'$lastName',"; // @last_name Nvarchar(100)
		$request .= "null,"; // @first_name Nvarchar(50)
		$request .= "null,"; // @opt_line Nvarchar(100)
		$request .= "'$address1',"; // @address Nvarchar(100)
		$request .= "null,"; // @city Nvarchar(50)
		$request .= "'$state',"; // @state Nvarchar(20)
		$request .= "null,"; // @zip Nvarchar(50)
		$request .= "null,"; // @country Nvarchar(50)
		$request .= "null,"; // @filter_id numeric
		$request .= "null"; // @user_id Nvarchar(20)
		
		$this->log->info ( "Matching Donor request is :" . $request );
		
		$request = urlencode ( $request );
		
		$this->log->info ( "Matching Donor request is  :" . $request );
		
		try {
			$matchingDonorDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			mail ( $this->emailList, "Error Saving Donor Information", "Donor Information save in DP is Fully or Partially Failed. See log file for more details. Donor First Name:" . $firstName . ", Second Name:" . $lastName );
			$this->log->error ( " Unable to Find a Matching Donor " . $e );
		}
		
		return $matchingDonorDetails;
	}
	
	
	function eMailAdmin($matchingDonorArr, $donorID) {
		$message = ' <div>
  	<p>
  		New Donor Id is: ' . $donorID . '
  	</p>';
		
		if (count ( $matchingDonorArr ) > 0) {
			
			$message .= '<h2>Matching Donor List :</h2>
  <table>
  <tr>
	<td><b>Donor ID</b></td>
	<td><b>First Name</b></td>
	<td><b>Last Name</b></td>
	<td><b>Address</b></td>
	<td><b>State</b></td>
  </tr>';
			foreach ( $matchingDonorArr as $rec ) {
				
				foreach ( $rec->field [0]->attributes () as $a0 => $donor_id ) {
				}
				;
				foreach ( $rec->field [1]->attributes () as $a1 => $first_name ) {
				}
				;
				foreach ( $rec->field [2]->attributes () as $a2 => $last_name ) {
				}
				;
				foreach ( $rec->field [5]->attributes () as $a5 => $address ) {
				}
				;
				foreach ( $rec->field [8]->attributes () as $a8 => $state ) {
				}
				;
				
				$message .= '<tr>
	<td>' . $donor_id . '</td>
	<td>' . $first_name . '</td>
	<td>' . $last_name . '</td>
	<td>' . $address . '</td>
	<td>' . $state . '</td>
  </tr>';
			}
			
			$message .= '</table>';
		}
		
		$message .= '</div>';
		
		$donateMail = SimpleMail::make ()->
		// ->setTo($this->emailList)
		setFrom ( 'info@globallymealliance.org', 'Global Lyme Alliance' )->setSubject ( 'New Donor Added' )->setMessage ( $message )->setReplyTo ( 'info@globallymealliance.org', 'Global Lyme Alliance' )->setHtml ()->setWrap ( 100 );
		foreach ( $this->emailList as $name => $email ) {
			$donateMail->setTo ( $email, $name );
		}
		
		$send = $donateMail->send ();
		
		$send ? $this->log->info ( 'Donation success Email sent successfully' ) : $this->log->info ( 'Could not send email' );
	}
}
