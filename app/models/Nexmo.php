<?php

class Nexmo {
	// Use mysql2 for database connection
	public static function sendTxt($mobile,$txt){

		//PRODUCTION LINK
		$link = 'https://rest.nexmo.com/sms/json?api_key=APIKEYHERE&api_secret=APISECRETHERE&status-report-req=1&type=unicode&from=DC%20Message&to='.$mobile.'&text='.$txt;

		// SANDBOX LINK DONT USE IN PRODUCTION
		//$link = 'https://rest-sandbox.nexmo.com/sms/json?api_key=SD_65528556&api_secret=PS_652555&status-report-req=1&type=unicode&from=DC%20Message&to='.$mobile.'&text='.$txt;

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_URL, $link);
        $response = curl_exec($ch);
		$response = json_decode($response,true);
		curl_close($ch);
		
		return $response;
	}

	// Get Nexmo account balance
	public static function getBalance(){

		$link = 'https://rest.nexmo.com/account/get-balance/APIKEYHERE/APISECRETHERE';

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_URL, $link);
        $response = curl_exec($ch);
		$response = json_decode($response,true);
		curl_close($ch);
		
		return $response['value'];
	}
}
