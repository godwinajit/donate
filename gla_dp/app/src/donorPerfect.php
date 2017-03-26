<?php
class DonorPerfect {
	
	protected $dpAPIKey;
	protected $log;
	
	public function __construct($dpAPIKey, $log) {
		$this->dpAPIKey = $dpAPIKey;
		$this->log = $log;
	}
	function saveDonorDetails($transactionDetails) {
		$donorDetails = $this->saveDonor ( $transactionDetails );
		
		$this->log->info( "New Donor Id is ". $donorDetails [0] );
		
		$donorGiftDetails = $this->saveDonorGifts ( $transactionDetails, $donorDetails [0] );
		
		$this->log->info( "New Gift id is ". $donorGiftDetails [0] );
		
		$donorPaymentDetails = $this->saveDonorPayment ( $transactionDetails, $donorDetails [0], $donorGiftDetails [0] );
		
		$this->log->info( "New payment name is ". $donorPaymentDetails->{'name'} [0] );
		$this->log->info( "New payment id is ". $donorPaymentDetails->{'id'} [0] );
		$this->log->info( "New payment value is ". $donorPaymentDetails->{'value'} [0] );
	}
	function saveDonor($transactionDetails) {
		$billingetails = $transactionDetails->{'billing'};
		
		$this->log->info( "Title :" . $transactionDetails->{'merchant-defined-field-3'} );
		$this->log->info( "First Name :" . $transactionDetails->{'merchant-defined-field-1'} );
		$this->log->info( "Last Name :" . $transactionDetails->{'merchant-defined-field-2'} );
		$this->log->info( "Email :" . $billingetails->{'email'} );
		$this->log->info( "ORG_REC :" . $transactionDetails->{'merchant-defined-field-4'} );
		$this->log->info( "country :" . $transactionDetails->{'descriptor-country'} );
		$this->log->info( "address1 :" . $transactionDetails->{'descriptor-address'} );
		$this->log->info( "address2 :" . $transactionDetails->{'merchant-defined-field-11'} );
		$this->log->info( "city :" . $transactionDetails->{'descriptor-city'} );
		$this->log->info( "state :" . $transactionDetails->{'descriptor-state'} );
		$this->log->info( "postal :" . $transactionDetails->{'descriptor-postal'} );
		$this->log->info( "phone :" . $transactionDetails->{'descriptor-phone'} );
		
		$title = $transactionDetails->{'merchant-defined-field-3'} ? $transactionDetails->{'merchant-defined-field-3'} : '';
		$firstName = $transactionDetails->{'merchant-defined-field-1'} ? $transactionDetails->{'merchant-defined-field-1'} : '';
		$lastName = $transactionDetails->{'merchant-defined-field-2'} ? $transactionDetails->{'merchant-defined-field-2'} : '';
		$email = $billingetails->{'email'} ? $billingetails->{'email'} : '';
		$isCorp = $transactionDetails->{'merchant-defined-field-4'} ? $transactionDetails->{'merchant-defined-field-4'} : '';
		$country = $transactionDetails->{'descriptor-country'} ? $transactionDetails->{'descriptor-country'} : '';
		$address1 = $transactionDetails->{'descriptor-address'} ? $transactionDetails->{'descriptor-address'} : '';
		$address2 = $transactionDetails->{'merchant-defined-field-11'} ? $transactionDetails->{'merchant-defined-field-11'} : '';
		$city = $transactionDetails->{'descriptor-city'} ? $transactionDetails->{'descriptor-city'} : '';
		$state = $transactionDetails->{'descriptor-state'} ? $transactionDetails->{'descriptor-state'} : '';
		$postal = $transactionDetails->{'descriptor-postal'} ? $transactionDetails->{'descriptor-postal'} : '';
		$phone = $transactionDetails->{'descriptor-phone'} ? $transactionDetails->{'descriptor-phone'} : '';
		
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
		
		$this->log->info( "Donor save Request :". $request );
		$donorDetails;
		try {
			$donorDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			$this->log->error( "Unable to Save Donor",$e );
		}
		
		$this->log->info( "Donor Save Information is ", get_object_vars($donorDetails) );
		
		return $donorDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
	}
	
	function saveDonorGifts($transactionDetails, $donorId) {
		$date = date ( "m/d/Y" );
		$amount = $transactionDetails->{'amount'} ? $transactionDetails->{'amount'} : '';
		$memoryHonor = $transactionDetails->{'merchant-defined-field-9'} ? $transactionDetails->{'merchant-defined-field-9'} : '';
		$gfname = $transactionDetails->{'merchant-defined-field-6'} ? $transactionDetails->{'merchant-defined-field-6'} : '';
		$glname = $transactionDetails->{'merchant-defined-field-7'} ? $transactionDetails->{'merchant-defined-field-7'} : '';
		
		$this->log->info( "Date :" . $date );
		$this->log->info( "Amount :" . $amount );
		$this->log->info( "Memory :" . $memoryHonor );
		$this->log->info( "First name :" . $gfname );
		$this->log->info( "Last Name :" . $glname );
		
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
		
		$this->log->info( "Gift save Request before encode:". $request );
		
		$request = urlencode ( $request );
		
		$this->log->info( "Gift save Request :". $request );
		
		try {
			$giftDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			$this->log->error( "Unable to save the Gift" ,$e );
		}
		$this->log->info( "Gift Save Information is ", get_object_vars($giftDetails) );
		
		return $giftDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
	}
	function saveDonorPayment($transactionDetails, $donorDetails, $donorGiftDetails) {
		$billingetails = $transactionDetails->{'billing'};
		
		$cardHolderName = $billingetails->{'first-name'} ? $billingetails->{'first-name'} : '';
		$cardHolderName .= ' ' . $billingetails->{'last-name'} ? $billingetails->{'last-name'} : '';
		$cardNumber = $billingetails->{'cc-number'} ? $billingetails->{'cc-number'} : '';
		$cardExp = $billingetails->{'cc-exp'} ? $billingetails->{'cc-exp'} : '';
		$cardaddress = $billingetails->{'address1'} ? $billingetails->{'address1'} : '';
		$cardCity = $billingetails->{'city'} ? $billingetails->{'city'} : '';
		$cardState = $billingetails->{'state'} ? $billingetails->{'state'} : '';
		$cardZip = $billingetails->{'postal'} ? $billingetails->{'postal'} : '';
		$date = date ( "m/d/Y" );
		
		$request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=" . $this->dpAPIKey;
		$request .= "&action=INSERT INTO dpgiftudf ";
		$request .= "(gift_id,CARDHOLDERNAME,CARDACCOUNTNUM,CC_EXP,CARDHOLDERADDRESS,CARDHOLDERCITY,CARDHOLDERSTATE,CARDHOLDERZIP)";
		$request .= "VALUES";
		$request .= "('$donorGiftDetails','$cardHolderName','$cardNumber','$cardExp', '$cardaddress','$cardCity','$cardState','$cardZip')";
		
		$this->log->info( "Payment save Request before encode:". $request );
		
		$request = urlencode ( $request );
		
		$this->log->info( "Payment save Request :". $request );
		$PaymentDetails;
		try {
			$PaymentDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			$this->log->error( " The Unable to save Payment details ".$e );
		}
		$this->log->info( "Payment Save Information is " );
		$this->log->info( $PaymentDetails );
		
		return $PaymentDetails->{'record'}->{'field'} [0]->attributes ();
		
		// DP APIs dp_paymentmethod_insert does not insert all the fields so using the Query insert above
		
		/*
		 * $request = "https://www.donorperfect.net/prod/xmlrequest.asp?apikey=".$this->dpAPIKey;
		 * $request .= "&action=dp_paymentmethod_insert&params=";
		 * $request .= "0,"; //@CustomerVaultID Nvarchar(55) Enter -0 to create a new Customer Vault ID record
		 * $request .= "'$donorDetails',"; //@donor_id int
		 * $request .= "1,"; //@IsDefault bit Bit Enter 1 if this is will be the default EFT payment method
		 * $request .= "null,"; //@AccountType Nvarchar(256) e.g. ‘Visa’
		 * $request .= "'creditcard',"; //@dpPaymentMethodTypeID Nvarchar(20) e.g.; ‘creditcard’
		 * $request .= "'$cardNumber',"; //@CardNumberLastFour Nvarchar(16) e.g.; ‘4xxxxxxxxxxx1111
		 * $request .= "'$cardExp',"; //@CardExpirationDate Nvarchar(10) e.g.; ‘0810’
		 * $request .= "null,"; //@BankAccountNumberLastFour Nvarchar(50)
		 * $request .= "'$cardHolderName',"; //@NameOnAccount Nvarchar(256)
		 * $request .= "'$date',"; //@CreatedDate datetime
		 * $request .= "null,"; //@ModifiedDate datetime
		 * $request .= "null,"; //@import_id int
		 * $request .= "null,"; //@created_by Nvarchar(20)
		 * $request .= "null,"; //@modified_by Nvarchar(20)
		 * $request .= "'USD'"; //@selected_currency Nvarchar(3)
		 *
		 * $this->log->info("Payment save Request before encode:",$request);
		 *
		 * $request = urlencode($request);
		 *
		 * $this->log->info("Payment save Request :",$request);
		 *
		 * $PaymentDetails = simplexml_load_file($request);
		 *
		 * $this->log->info("Payment Save Information is ");
		 * $this->log->info($PaymentDetails);
		 *
		 * return $PaymentDetails->{'record'}->{'field'}[0]-> attributes();
		 */
	}
}