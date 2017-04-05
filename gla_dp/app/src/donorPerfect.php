<?php
class DonorPerfect {
	protected $dpAPIKey;
	protected $log;
	protected $emailList;
	protected $dpSaveFlag = false;
	
	public function __construct($dpAPIKey, $log, $emailList) {
		$this->dpAPIKey = $dpAPIKey;
		$this->log = $log;
		$this->emailList = $emailList;
	}
	
	function saveDonorDetails($transactionDetails) {
		$donorDetails = $this->saveDonor ( $transactionDetails );
		
		$this->log->info ( "New Donor Id is " . $donorDetails [0] );
		$headers = "From: glastaging@wpengine.com" . "\r\n";
		mail($this->emailList,"New Donor Added","New Donor Id is " . $donorDetails [0], $headers);
		
		$donorGiftDetails = $this->saveDonorGifts ( $transactionDetails, $donorDetails [0] );
		
		$this->log->info ( "New Gift id is " . $donorGiftDetails [0] );
		
		$donorPaymentDetails = $this->saveDonorPayment ( $transactionDetails, $donorDetails [0], $donorGiftDetails [0] );
		
		$this->log->info ( "New payment name is " . $donorPaymentDetails->{'name'} [0] );
		$this->log->info ( "New payment id is " . $donorPaymentDetails->{'id'} [0] );
		$this->log->info ( "New payment value is " . $donorPaymentDetails->{'value'} [0] );
	}
	
	function saveDonor($transactionDetails) {
		$billingetails = $transactionDetails->{'billing'};
		
		$this->log->info ( "Title :" . $transactionDetails->{'merchant-defined-field-3'} );
		$this->log->info ( "First Name :" . $transactionDetails->{'merchant-defined-field-1'} );
		$this->log->info ( "Last Name :" . $transactionDetails->{'merchant-defined-field-2'} );
		$this->log->info ( "Email :" . $billingetails->{'email'} );
		$this->log->info ( "ORG_REC :" . $transactionDetails->{'merchant-defined-field-4'} );
		$this->log->info ( "country :" . $transactionDetails->{'descriptor-country'} );
		$this->log->info ( "address1 :" . $transactionDetails->{'descriptor-address'} );
		$this->log->info ( "address2 :" . $transactionDetails->{'merchant-defined-field-11'} );
		$this->log->info ( "city :" . $transactionDetails->{'descriptor-city'} );
		$this->log->info ( "state :" . $transactionDetails->{'descriptor-state'} );
		$this->log->info ( "postal :" . $transactionDetails->{'descriptor-postal'} );
		$this->log->info ( "phone :" . $transactionDetails->{'descriptor-phone'} );
		
		$title = $this->clean($transactionDetails->{'merchant-defined-field-3'} ? $transactionDetails->{'merchant-defined-field-3'} : '');
		$firstName = $this->clean($transactionDetails->{'merchant-defined-field-1'} ? $transactionDetails->{'merchant-defined-field-1'} : '');
		$lastName = $this->clean($transactionDetails->{'merchant-defined-field-2'} ? $transactionDetails->{'merchant-defined-field-2'} : '');
		$email = $this->clean($billingetails->{'email'} ? $billingetails->{'email'} : '');
		$isCorp = $this->clean($transactionDetails->{'merchant-defined-field-4'} ? $transactionDetails->{'merchant-defined-field-4'} : '');
		$country = $this->clean($transactionDetails->{'descriptor-country'} ? $transactionDetails->{'descriptor-country'} : '');
		$address1 = $this->clean($transactionDetails->{'descriptor-address'} ? $transactionDetails->{'descriptor-address'} : '');
		$address2 = $this->clean($transactionDetails->{'merchant-defined-field-11'} ? $transactionDetails->{'merchant-defined-field-11'} : '');
		$city = $this->clean($transactionDetails->{'descriptor-city'} ? $transactionDetails->{'descriptor-city'} : '');
		$state = $this->clean($transactionDetails->{'descriptor-state'} ? $transactionDetails->{'descriptor-state'} : '');
		$postal = $this->clean($transactionDetails->{'descriptor-postal'} ? $transactionDetails->{'descriptor-postal'} : '');
		$phone = $this->clean($transactionDetails->{'descriptor-phone'} ? $transactionDetails->{'descriptor-phone'} : '');
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_savedonor&params=";
		$request .= "0,"; // @donor_id
		$request .= "'$firstName',"; // @first_name
		$request .= "'$lastName',"; // @last_name
		$request .= "null,"; // @middle_name
		$request .= "null,"; // @suffix
		$request .= "null,"; // @title
		$request .= "'$title',"; // @salutation
		$request .= "null,"; // @prof_title
		$request .= "null,"; // @opt_line
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
		$request .= "'null',"; // @mobile_phone
		$request .= "'$email',"; // @email
		$request .= "'$isCorp',"; // @org_rec
		$request .= "null,"; // @donor_type
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
			$this->log->error ( "Unable to Save Donor", $e );
		}
		
		$this->log->info ( "Donor Save Information is ". print_r( $donorDetails , true) );
		
		return $donorDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
	}
	
	function saveDonorGifts($transactionDetails, $donorId) {
		$date = date ( "m/d/Y" );
		$amount = $this->clean($transactionDetails->{'amount'} ? $transactionDetails->{'amount'} : '');
		$memoryHonor = $this->clean($transactionDetails->{'merchant-defined-field-9'} ? $transactionDetails->{'merchant-defined-field-9'} : '');
		$gfname = $this->clean($transactionDetails->{'merchant-defined-field-6'} ? $transactionDetails->{'merchant-defined-field-6'} : '');
		$glname = $this->clean($transactionDetails->{'merchant-defined-field-7'} ? $transactionDetails->{'merchant-defined-field-7'} : '');
		
		$this->log->info ( "Date :" . $date );
		$this->log->info ( "Amount :" . $amount );
		$this->log->info ( "Memory :" . $memoryHonor );
		$this->log->info ( "First name :" . $gfname );
		$this->log->info ( "Last Name :" . $glname );
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_savegift&params=";
		$request .= "0,"; // @gift_id
		$request .= "$donorId,"; // @donor_id
		$request .= "'G',"; // @record_type
		$request .= "'$date',"; // @gift_date
		$request .= "$amount,"; // @amount
		$request .= "null,"; // @gl_code
		$request .= "null,"; // @solicit_code
		$request .= "null,"; // @sub_solicit_code
		$request .= "null,"; // @gift_type
		$request .= "'N',"; // @split_gift
		$request .= "'N',"; // @pledge_payment
		$request .= "null,"; // @reference
		$request .= "'$memoryHonor',"; // @memory_honor
		$request .= "'$gfname',"; // @gfname
		$request .= "'$glname',"; // @glname
		$request .= "0,"; // @fmv
		$request .= "0,"; // @batch_no
		$request .= "null,"; // @gift_narrative
		$request .= "null,"; // @ty_letter_no
		$request .= "null,"; // @glink
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
			$this->log->error ( "Unable to save the Gift", $e );
		}
		$this->log->info ( "Gift Save Information is ". print_r( $giftDetails, true ) );
		
		return $giftDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
	}
	
	function saveDonorPayment($transactionDetails, $donorDetails, $donorGiftDetails) {
		
		$matchingGift = $transactionDetails->{'merchant-defined-field-5'} ? $transactionDetails->{'merchant-defined-field-5'} : 'NO';
		$billingetails = $transactionDetails->{'billing'};
		
		$companyName = $this->clean($billingetails->{'company'} ? $billingetails->{'company'} : '');
		$cardHolderName = $billingetails->{'first-name'} ? $billingetails->{'first-name'} : '';
		$cardHolderName .= ' ' . $billingetails->{'last-name'} ? $billingetails->{'last-name'} : '';
		$cardHolderName = $this->clean($cardHolderName);
		$cardNumber = $this->clean($billingetails->{'cc-number'} ? $billingetails->{'cc-number'} : '');
		$cardExp = $this->clean($billingetails->{'cc-exp'} ? $billingetails->{'cc-exp'} : '');
		$cardaddress = $this->clean($billingetails->{'address1'} ? $billingetails->{'address1'} : '');
		$cardCity = $this->clean($billingetails->{'city'} ? $billingetails->{'city'} : '');
		$cardState = $this->clean($billingetails->{'state'} ? $billingetails->{'state'} : '');
		$cardZip = $this->clean($billingetails->{'postal'} ? $billingetails->{'postal'} : '');
		$date = date ( "m/d/Y" );
		
		// DP APIs dp_paymentmethod_insert does not insert all the fields so using the Query insert above
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_paymentmethod_insert&params=";
		$request .= "0,"; // @CustomerVaultID Nvarchar(55) Enter -0 to create a new Customer Vault ID record
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
		
		$this->log->info ( "Payment save Request before encode:". $request );
		
		$request = urlencode ( $request );
		
		$this->log->info ( "Payment save Request :". $request );
		
		try {
			$PaymentDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			$this->log->error ( " The Unable to save Payment details " . $e );
		}
		
		$this->log->info ( "Payment Save Information is " );
		$this->log->info ( $PaymentDetails );
		
		$companyNameStatus = $this->dp_save_udf_xml($donorDetails, 'EMPLOYER', 'C', $companyName, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Company name is ". print_r( $companyNameStatus, true ) );
		
		$cardHolderNameStatus = $this->dp_save_udf_xml($donorGiftDetails, 'CARDHOLDERNAME', 'C', $cardHolderName, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card name is ". print_r( $cardHolderNameStatus, true ) );
		
		$cardHolderNumStatus = $this->dp_save_udf_xml($donorGiftDetails, 'CARDACCOUNTNUM', 'C', $cardNumber, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card Num is ". print_r( $cardHolderNumStatus, true ) );
		
		$cardHolderExpStatus = $this->dp_save_udf_xml($donorGiftDetails, 'EXPIRATIONDATE', 'C', $cardExp, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card Exp is ". print_r( $cardHolderExpStatus, true ) );
		
		$cardHolderAddStatus = $this->dp_save_udf_xml($donorGiftDetails, 'CARDHOLDERADDRESS', 'C', $cardaddress, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card Address is ". print_r( $cardHolderAddStatus, true ) );
		
		$cardHolderCityStatus = $this->dp_save_udf_xml($donorGiftDetails, 'CARDHOLDERCITY', 'C', $cardCity, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card City is ". print_r( $cardHolderCityStatus, true ) );
		
		$cardHolderStateStatus = $this->dp_save_udf_xml($donorGiftDetails, 'CARDHOLDERSTATE', 'C', $cardState, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card State is ". print_r( $cardHolderStateStatus, true ) );
		
		$cardHolderZipStatus = $this->dp_save_udf_xml($donorGiftDetails, 'CARDHOLDERZIP', 'C', $cardZip, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Card Zip is ". print_r( $cardHolderZipStatus, true ) );
		
		$matchingGiftStatus = $this->dp_save_udf_xml($donorGiftDetails, 'GMG', 'C', $matchingGift, 'null', 'null', 'GLA API User' );
		$this->log->info ( "Matching gift is ". print_r( $matchingGiftStatus, true ) );
		//TODO This above field name should be changed to MATCHING_GIFT
		
		return $PaymentDetails->{'record'}->{'field'} [0]->attributes ();
		
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
	
	function dp_save_udf_xml($matching_id, $field_name, $data_type, $char_value, $date_value, $number_value, $user_id ){
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=dp_save_udf_xml&params=";
		
		$request .= "'$matching_id',"; //@matching_id numeric Specify either a donor_id value if updating a donor record, a gift_id value if updating a gift record or an other_id value if updating a dpotherinfo table value (see dp_saveotherinfo)
		$request .= "'$field_name',"; //@field_name Nvarchar(20)
		$request .= "'$data_type',"; //@data_type Nvarchar(1) C- Character, D-Date, N- Numeric
		$request .= "'$char_value',"; //@char_value Nvarchar(2000) Null if not a Character field
		$request .= "null,"; //@date_value	datetime Null if not a Date field
		$request .= "null,"; //@number_value numeric (18,4) Null if not a Number field
		$request .= "'$user_id'"; //@user_id Nvarchar(20) We recommend that you use a name here, such as the name of your API application, for auditing purposes. The user_id value does not need to match the name of an actual DPO user account.

		$this->log->info ( "Gift UDF request is :". $request );
		
		$request = urlencode ( $request );
		
		$this->log->info ( "Gift UDF request is  :". $request );
		
		try {
			$giftUDFDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			$this->log->error ( " Unable to save Gift UDF details " . $e );
		}
		
		return $giftUDFDetails;
	}
	
	function clean($string) {
		$replaceArr = array('#','&','+');
	
		return str_replace($replaceArr, "",$string);
	}
}