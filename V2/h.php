<?php
$forward = $_GET['forward'];
$type = $_GET['type'];
$tgid = $_GET['tgid'];
$lista = $_GET['lista'];
$amount = $_GET['amount'];
$tye = 1;
if ((!empty($tye)) AND ($type == 'refund') OR (!empty($tye)) AND ($type == 'ccnrefund')){
echo "Forward = $forward<br>Charge Type = $type<br>Telegram Id = $tgid<br>Amount = $amount<br>CC = $lista";
}
?>