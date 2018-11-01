<?php

include 'vendors\phpqrcode\qrlib.php';
$qr=  filter_input(INPUT_GET,'text1');	
//echo $qr;
QRcode::png($qr);
?>