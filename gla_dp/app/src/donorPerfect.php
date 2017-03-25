<?php
class DonorPerfect {
	protected $dpAPIKey;
	public function __construct($dpAPIKey) {
		$this->dpAPIKey = $dpAPIKey;
	}
	function saveDonorDetails($transactionDetails) {
		$donorDetails = $this->saveDonor ( $transactionDetails );
		
		log_dp ( "New Donor Id is " . $donorDetails [0] );
		
		$donorGiftDetails = $this->saveDonorGifts ( $transactionDetails, $donorDetails [0] );
		
		log_dp ( "New Gift id is " . $donorGiftDetails [0] );
		
		$donorPaymentDetails = $this->saveDonorPayment ( $transactionDetails, $donorDetails [0], $donorGiftDetails [0] );
		
		log_dp ( "New payment name is " . $donorPaymentDetails->{'name'} [0] );
		log_dp ( "New payment id is " . $donorPaymentDetails->{'id'} [0] );
		log_dp ( "New payment value is " . $donorPaymentDetails->{'value'} [0] );
	}
	function saveDonor($transactionDetails) {
		$billingetails = $transactionDetails->{'billing'};
		
		log_dp ( "Title :" . $transactionDetails->{'merchant-defined-field-3'} );
		log_dp ( "First Name :" . $transactionDetails->{'merchant-defined-field-1'} );
		log_dp ( "Last Name :" . $transactionDetails->{'merchant-defined-field-2'} );
		log_dp ( "Email :" . $billingetails->{'email'} );
		log_dp ( "ORG_REC :" . $transactionDetails->{'merchant-defined-field-4'} );
		log_dp ( "country :" . $transactionDetails->{'descriptor-country'} );
		log_dp ( "address1 :" . $transactionDetails->{'descriptor-address'} );
		log_dp ( "address2 :" . $transactionDetails->{'merchant-defined-field-11'} );
		log_dp ( "city :" . $transactionDetails->{'descriptor-city'} );
		log_dp ( "state :" . $transactionDetails->{'descriptor-state'} );
		log_dp ( "postal :" . $transactionDetails->{'descriptor-postal'} );
		log_dp ( "phone :" . $transactionDetails->{'descriptor-phone'} );
		
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
		
		log_dp ( "Donor save Request :" . $request );
		$donorDetails;
		try {
			$donorDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			log_dp ( $e );
		}
		
		log_dp ( "Donor Save Information is " );
		log_dp ( $donorDetails );
		
		return $donorDetails->{'record'}->{'field'} [0]->attributes ()->{'value'};
	}
	
	function saveDonorGifts($transactionDetails, $donorId) {
		$date = date ( "m/d/Y" );
		$amount = $transactionDetails->{'amount'} ? $transactionDetails->{'amount'} : '';
		$memoryHonor = $transactionDetails->{'merchant-defined-field-9'} ? $transactionDetails->{'merchant-defined-field-9'} : '';
		$gfname = $transactionDetails->{'merchant-defined-field-6'} ? $transactionDetails->{'merchant-defined-field-6'} : '';
		$glname = $transactionDetails->{'merchant-defined-field-7'} ? $transactionDetails->{'merchant-defined-field-7'} : '';
		
		log_dp ( "Date :" . $date );
		log_dp ( "Amount :" . $amount );
		log_dp ( "Memory :" . $memoryHonor );
		log_dp ( "First name :" . $gfname );
		log_dp ( "Last Name :" . $glname );
		
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
		
		log_dp ( "Gift save Request before encode:" . $request );
		
		$request = urlencode ( $request );
		
		log_dp ( "Gift save Request :" . $request );
		
		try {
			$giftDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			log_dp ( $e );
		}
		log_dp ( "Gift Save Information is " );
		log_dp ( $giftDetails );
		
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
		
		log_dp ( "Payment save Request before encode:" . $request );
		
		$request = urlencode ( $request );
		
		log_dp ( "Payment save Request :" . $request );
		$PaymentDetails;
		try {
			$PaymentDetails = simplexml_load_file ( $request );
		} catch ( Exception $e ) {
			log_dp ( $e );
		}
		log_dp ( "Payment Save Information is " );
		log_dp ( $PaymentDetails );
		
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
		 * log_dp("Payment save Request before encode:".$request);
		 *
		 * $request = urlencode($request);
		 *
		 * log_dp("Payment save Request :".$request);
		 *
		 * $PaymentDetails = simplexml_load_file($request);
		 *
		 * log_dp("Payment Save Information is ");
		 * log_dp($PaymentDetails);
		 *
		 * return $PaymentDetails->{'record'}->{'field'}[0]-> attributes();
		 */
	}
}