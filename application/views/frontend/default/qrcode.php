<?php 


include 'assets/phpqrcode/qrlib.php';

$data_enc = $this->session->userdata("encode_data");
QRcode::png($data_enc);


?>