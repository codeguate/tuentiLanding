<?php
	include "core/phpqrcode-master/qrlib.php";
	
	function writeInvitation($dpi,$nombre) {
	    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR."qr-codes".DIRECTORY_SEPARATOR;

		$INVITATION_PATH = $PNG_TEMP_DIR.DIRECTORY_SEPARATOR.'invitacionMailing.png';

		$FONT_PATH = $PNG_TEMP_DIR.DIRECTORY_SEPARATOR.'FuturaStd-CondensedBold.ttf';

		$id = md5($dpi);

		$filename = $PNG_TEMP_DIR."invitation-".$id.".png";

		$responsePath = "http://finalheineken.com/verify/verify.html?d=";
		 
		// Generate QR Code and capture PNG data with ob
		ob_start();
		 QRcode::png($responsePath.$id,null, QR_ECLEVEL_L, 4, 3);
		 $pngData = ob_get_contents();
		ob_end_clean();
		 

		$qrImage = imagecreatefromstring($pngData);
		$imgBase = imagecreatefrompng($INVITATION_PATH);
		
		$blanco = imagecolorallocate($imgBase, 255, 255, 255);
		
		$font_size = 30;		 


		$qrW = imagesx($qrImage);
		$qrH = imagesy($qrImage);

		imagecopy($imgBase, $qrImage ,160,660, 0, 0, $qrW, $qrH);
		
		$bbox = imagettfbbox($font_size, 0, $FONT_PATH, $nombre);
 
		$dest_x = $bbox[0] + (imagesx($imgBase) / 2) - ($bbox[4] / 2) - 10;
		
		imagettftext ($imgBase , $font_size, 0 , 20 , 320 , $blanco , $FONT_PATH , $nombre);
	
		$bbox2 = imagettfbbox($font_size, 0, $FONT_PATH, $dpi);
 
		$dest_x2 = $bbox2[0] + (imagesx($imgBase) / 2) - ($bbox2[4] / 2) - 25;
	
		imagettftext ($imgBase , $font_size, 0 , 20  , 365 , $blanco , $FONT_PATH , 'DPI: '.$dpi);

		imagepng($imgBase,$filename);
		
		imagedestroy($imgBase);
	}

	 writeInvitation('3006980890101','Maria Pacheco');

?>