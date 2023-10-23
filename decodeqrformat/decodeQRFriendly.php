<?php
	
    error_reporting(E_ALL);
	ini_set("display_errors", "On");

	function decodeFriendlyQRCode($dataQR) {
    	$ObjectNo = '';
    	$DataLength = 0;
    	$Data = '';
    	while(!empty($dataQR)) {
    		$ObjectNo = substr($dataQR, 0, 2);
    		$s1r = substr($dataQR, 2, strlen($dataQR) - 2);
    		$DataLength = (int)substr($s1r, 0, 2);
    		
    		$Data = substr($s1r, 2, $DataLength);
    		if($ObjectNo >= 26 && $ObjectNo <= 45) {
    			
    			$ObjectInfo = 'Merchant PAN 26-45';
    			
    			$nextlength = 0;		
    			if(substr($Data, $nextlength, 2) == '00') {
    				$nextlength = $nextlength+2;
    				$GlobalUniqueIdentifier_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$GlobalUniqueIdentifier = substr($Data, $nextlength, $GlobalUniqueIdentifier_length);
    				$nextlength = $nextlength+$GlobalUniqueIdentifier_length;
    			} else {
    				$GlobalUniqueIdentifier = '';
    			}
    
    			if(substr($Data, $nextlength, 2) == '01') {
    				$nextlength = $nextlength+2;
    				$TrxPAN_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$TrxPAN = substr($Data, $nextlength, $TrxPAN_length);
    				$AcquirerID = substr($TrxPAN, 0, 8);
    				$nextlength = $nextlength+$TrxPAN_length;
    			} else {
    				$TrxPAN = '';
    				$AcquirerID = '';
    			}
    
    			if(substr($Data, $nextlength, 2) == '02') {
    				$nextlength = $nextlength+2;
    				$MerchantID_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$MerchantID = substr($Data, $nextlength, $MerchantID_length);
    				$nextlength = $nextlength+$MerchantID_length;
    			} else {
    				$MerchantID = '';
    			}
    
    			if(substr($Data, $nextlength, 2) == '03') {
    				$nextlength = $nextlength+2;
    				$MerchantCriteria_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$MerchantCriteria = substr($Data, $nextlength, $MerchantCriteria_length);
    				$nextlength = $nextlength+$MerchantCriteria_length;
    			} else {
    				$MerchantCriteria = '';
    			}
    			
    			$Data = array(
    						'MerchantAccountInformation' => $Data,
    						'GlobalUniqueIdentifier' => $GlobalUniqueIdentifier,
    						'TrxPAN' => $TrxPAN,
    						'AcquirerID' => $AcquirerID,
    						'MerchantID' => $MerchantID,
    						'MerchantCriteria' => $MerchantCriteria,
    					);
    		}
    		
    		
    		if($ObjectNo == '51') { // From PTEN/NMR
    			
    			$ObjectInfo = 'National Data Merchant';
    			
    			$nextlength = 0;		
    			if(substr($Data, $nextlength, 2) == '00') {
    				$nextlength = $nextlength+2;
    				$GlobalUniqueIdentifier_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$GlobalUniqueIdentifier = substr($Data, $nextlength, $GlobalUniqueIdentifier_length);
    				$nextlength = $nextlength+$GlobalUniqueIdentifier_length;
    			} else {
    				$GlobalUniqueIdentifier = '';
    			}
    
    			if(substr($Data, $nextlength, 2) == '01') {
    				$nextlength = $nextlength+2;
    				$TrxPAN_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$TrxPAN = substr($Data, $nextlength, $TrxPAN_length);
    				$AcquirerID = substr($TrxPAN, 0, 8);
    				$nextlength = $nextlength+$TrxPAN_length;
    			} else {
    				$TrxPAN = '';
    				$AcquirerID = '';
    			}
    
    			if(substr($Data, $nextlength, 2) == '02') {
    				$nextlength = $nextlength+2;
    				$MerchantID_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$MerchantID = substr($Data, $nextlength, $MerchantID_length);
    				$nextlength = $nextlength+$MerchantID_length;
    			} else {
    				$MerchantID = '';
    			}
    
    			if(substr($Data, $nextlength, 2) == '03') {
    				$nextlength = $nextlength+2;
    				$MerchantCriteria_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$MerchantCriteria = substr($Data, $nextlength, $MerchantCriteria_length);
    				$nextlength = $nextlength+$MerchantCriteria_length;
    			} else {
    				$MerchantCriteria = '';
    			}
    			
    			$Data = array(
    						'MerchantAccountInformation' => $Data,
    						'GlobalUniqueIdentifier' => $GlobalUniqueIdentifier,
    						'MerchantID' => $MerchantID,
    						'MerchantCriteria' => $MerchantCriteria,
    					);
    		}
    		
    		if($ObjectNo == '62') { // For Additional Data Field
    			
    			$ObjectInfo = 'Additional Information';
    			
    			$nextlength = 0;		
    			if(substr($Data, $nextlength, 2) == '01') {
    				$nextlength = $nextlength+2;
    				$billNumberdentifier_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$billNumber = substr($Data, $nextlength, $billNumberdentifier_length);
    				$nextlength = $nextlength+$billNumberdentifier_length;
    			} else {
    				$billNumber = '';
    			}
    
    			if(substr($Data, $nextlength, 2) == '02') {
    				$nextlength = $nextlength+2;
    				$mobilePhone_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$mobilePhone = substr($Data, $nextlength, $mobilePhone_length);
    				$nextlength = $nextlength+$mobilePhone_length;
    			} else {
    				$mobilePhone = '';
    			}
    
    			if(substr($Data, $nextlength, 2) == '03') {
    				$nextlength = $nextlength+2;
    				$storeLabel_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$storeLabel = substr($Data, $nextlength, $storeLabel_length);
    				$nextlength = $nextlength+$storeLabel_length;
    			} else {
    				$storeLabel = '';
    			}
    
    			if(substr($Data, $nextlength, 2) == '04') {
    				$nextlength = $nextlength+2;
    				$loyaltyNumber_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$loyaltyNumber = substr($Data, $nextlength, $loyaltyNumber_length);
    				$nextlength = $nextlength+$loyaltyNumber_length;
    			} else {
    				$loyaltyNumber = '';
    			}
    			
    			if(substr($Data, $nextlength, 2) == '05') {
    				$nextlength = $nextlength+2;
    				$referenceLabel_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$referenceLabel = substr($Data, $nextlength, $referenceLabel_length);
    				$nextlength = $nextlength+$referenceLabel_length;
    			} else {
    				$referenceLabel = '';
    			}
    			
    			if(substr($Data, $nextlength, 2) == '06') {
    				$nextlength = $nextlength+2;
    				$customerLabel_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$customerLabel = substr($Data, $nextlength, $customerLabel_length);
    				$nextlength = $nextlength+$customerLabel_length;
    			} else {
    				$customerLabel = '';
    			}
    			
    			if(substr($Data, $nextlength, 2) == '07') {
    				$nextlength = $nextlength+2;
    				$terminalLabel_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$terminalLabel = substr($Data, $nextlength, $terminalLabel_length);
    				$nextlength = $nextlength+$terminalLabel_length;
    			} else {
    				$terminalLabel = '';
    			}
    			
    			if(substr($Data, $nextlength, 2) == '08') {
    				$nextlength = $nextlength+2;
    				$purposeOfTransaction_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$purposeOfTransaction = substr($Data, $nextlength, $purposeOfTransaction_length);
    				$nextlength = $nextlength+$purposeOfTransaction_length;
    			} else {
    				$purposeOfTransaction = '';
    			}
    			
    			if(substr($Data, $nextlength, 2) == '09') {
    				$nextlength = $nextlength+2;
    				$additionalCustomerDataRequest_length = substr($Data, $nextlength, 2);
    				$nextlength = $nextlength+2;
    				$additionalCustomerDataRequest = substr($Data, $nextlength, $additionalCustomerDataRequest_length);
    				$nextlength = $nextlength+$additionalCustomerDataRequest_length;
    			} else {
    				$additionalCustomerDataRequest = '';
    			}
    			
    			$Data = array(
    						'AdditionalInformation' => $Data,
    						'billNumber' => $billNumber,
    						'mobilePhone' => $mobilePhone,
    						'storeLabel' => $storeLabel,
    						'loyaltyNumber' => $loyaltyNumber,
    						'referenceLabel' => $referenceLabel,
    						'customerLabel' => $customerLabel,
    						'terminalLabel' => $terminalLabel,
    						'purposeOfTransaction' => $purposeOfTransaction,
    						'additionalCustomerDataRequest' => $additionalCustomerDataRequest,
    					);
    		}
    		
    		$dataQR = substr($s1r, $DataLength + 2);
            if(strlen($DataLength) == 1) {
    			$DataLengthResp = '0'.$DataLength;
            } else {
    			$DataLengthResp = $DataLength;
            }
    		
    		
    		if($ObjectNo == '00') {
    			$ObjectInfo = 'Version QR';
    		}
    		
    		if($ObjectNo == '01') {
    			$ObjectInfo = 'Tipe QR (11=Static / 12=Dynamic)';
    		}
    		
    		if($ObjectNo == '52') {
    			$ObjectInfo = 'Merchant Category Code (MCC)';
    		}
    		
    		if($ObjectNo == '53') {
    			$ObjectInfo = 'Currency';
    		}
    		
    		if($ObjectNo == '54') {
    			$ObjectInfo = 'Amount';
    		}
    		
    		if($ObjectNo == '55') {
    			$ObjectInfo = 'Tip Indicator (01=Tip Free, 02=Tip Fixed, 03=Tip Percentage)';
    		}
    		
    		if($ObjectNo == '56') {
    			$ObjectInfo = 'Value of Tip Fixed';
    		}
    		
    		if($ObjectNo == '57') {
    			$ObjectInfo = 'Value of Tip Percentage';
    		}
    		
    		if($ObjectNo == '58') {
    			$ObjectInfo = 'Country Code';
    		}
    		
    		if($ObjectNo == '59') {
    			$ObjectInfo = 'Merchant Name';
    		}
    		
    		if($ObjectNo == '60') {
    			$ObjectInfo = 'Merchant City';
    		}
            
            if($ObjectNo == '61') {
    			$ObjectInfo = 'Postal Code';
    		}
    		
    		if($ObjectNo == '63') {
    			$ObjectInfo = 'CRC';
    		}
    			
    		$resultDec[$ObjectNo] = array(
    						 'ObjectInfo' => $ObjectInfo,
    						 'ObjectNo' => $ObjectNo,
    						 'DataLength' => $DataLengthResp,
    						 'Data' => $Data,
    					   );
    	}
    	return $resultDec;
    }

    function removeQRChecksum($data) {
        $crc_offset = strpos($data, '6304') + 4;
        $crc_length = 4;
        $data_length = strlen($data);
        $qr_data = substr($data, 0, $crc_offset) . substr($data, $crc_offset + $crc_length, $data_length);
      
        return $qr_data;
    }


	


	if(!empty($_GET['QR_DATA'])) {
		$dataQR = base64_decode($_GET['QR_DATA']);
	} else {
		$dataQR = "00020101021126730021COM.GUDANGVOUCHER.WWW011893600916300246497902150200000024649790303UMI51450015ID.OR.GPNQR.WWW02150200000024649790303UMI5204581453033605802ID5918Merc'hant Test & 36011ACEH TENGAH61051884862070703A0163045CCD";
	}
	 
	$QRSubstringData = decodeFriendlyQRCode($dataQR);
			
	echo '<pre>';
	print_r($QRSubstringData);
	echo '</pre>';
			
			
	include_once('CRC/CRCInterface.php');
	include_once('CRC/AbstractCRC.php');
	include_once('CRC/CRC16.php');
	include_once('CRC/CRC16CCITT.php');
		
	$crc16ccitt = new mermshaus\CRC\CRC16CCITT();

    $qr_data_without_checksum = removeQRChecksum($dataQR);

    echo $dataQR .'<br><br>'. $qr_data_without_checksum .'<br><hr><br>';

	$CRC = $QRSubstringData[63]['Data'];
	echo '<br>';
	echo 'CRC, should be: '.$CRC.'<br>';

	$crc16ccitt->update($qr_data_without_checksum);
	$checksum = $crc16ccitt->finish();
	$checksum = bin2hex($checksum);
	$checksum = strtoupper($checksum);
			
	echo 'Result CRC/Checksum: ';
	if($checksum == $CRC) {
		echo 'Same';
	} else {
		echo 'Diffrenet, should be: '. $checksum;
	}

?>
