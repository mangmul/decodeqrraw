<?php
	
    error_reporting(E_ALL);
	ini_set("display_errors", "On");

	function readSubtags($data) {
        $subtags = array();

        while (!empty($data)) {
            $subtag = substr($data, 0, 2);
            $subtagLength = substr($data, 2, 2);
            $subtagValue = substr($data, 4, $subtagLength);

            $subtags[$subtag] = array(
                'subtag' => $subtag,
                'length' => strlen($subtagValue),
                'value' => $subtagValue
            );

            $data = substr($data, 4 + $subtagLength);
        }

        return $subtags;
    }


    function readISOQRCodeTags($qrCodeData) {
        $tags = array();

        while (!empty($qrCodeData)) {
            $tag = substr($qrCodeData, 0, 2);
            $length = substr($qrCodeData, 2, 2);
            $value = substr($qrCodeData, 4, $length);

            if ($tag >= '26' && $tag <= '45') {
                $subtags = readSubtags($value);
                $tags[$tag] = array(
                    'tag' => $tag,
                    'length' => strlen($value),
                    'value' => $value,
                    'subtags' => $subtags
                );
            } else if ($tag === '51') {
                $subtags = readSubtags($value);
                $tags[$tag] = array(
                    'tag' => $tag,
                    'length' => strlen($value),
                    'value' => $value,
                    'subtags' => $subtags
                );
            } else if ($tag === '62') {
                $subtags = readSubtags($value);
                $tags[$tag] = array(
                    'tag' => $tag,
                    'length' => strlen($value),
                    'value' => $value,
                    'subtags' => $subtags
                );
            } else if ($tag === '64') {
                $subtags = readSubtags($value);
                $tags[$tag] = array(
                    'tag' => $tag,
                    'length' => strlen($value),
                    'value' => $value,
                    'subtags' => $subtags
                );
            } else {
                $tags[$tag] = array(
                    'tag' => $tag,
                    'length' => strlen($value),
                    'value' => $value
                );
            }

            $qrCodeData = substr($qrCodeData, 4 + $length);
        }

        return $tags;
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
	 
	$QRSubstringData = readISOQRCodeTags($dataQR);

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

    $CRC = $QRSubstringData[63]['value'];
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
