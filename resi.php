<?php

/****************************************************
* Project Name: Resi API                            *
* Version: v 1.0.0                                  *
* URL Github: https://github.com/lestravo/Resi-API  *
* Email Developer m.septian96@gmail.com             *
* Website Developer http://mseptian.id              *
*****************************************************/

class Resi
{
	public function ResiJNE($resi)
	{
		$hasil = self::CURL("https://myjne.jne.co.id:10443/jneone/service/animation/popupView", "okhttp/3.8.0", null, null, "userType=0&view=gkeyo4sr52hjicd5f4dkgblpnmico5&height=".self::strReplaceJNE($resi));
		return $hasil;
	}

	private function CURL($url, $ua, $ref = null, $header = array(), $post = null)
	{
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($c, CURLOPT_USERAGENT, $ua);
        curl_setopt($c, CURLOPT_REFERER, $ref);
        if ($header){
          curl_setopt($c, CURLOPT_HTTPHEADER, $header);
        }
        if ($post){
        	curl_setopt($c, CURLOPT_POSTFIELDS, $post);
        	curl_setopt($c, CURLOPT_POST, true);
        } 
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($c, CURLOPT_HEADER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($c);
        $httpcode = curl_getinfo($c);
        if(!$httpcode){
        	return false;
        } 
        else
        {
            $header = substr($response, 0, curl_getinfo($c, CURLINFO_HEADER_SIZE));
            $body = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE));
        }
        return array($header, $body);
	}

	private function strReplaceJNE($str)
	{
		$str = strtolower($str);
		$str1 = array("0" => "48","1" => "49","2" => "50","3" => "51","4" => "52","5" => "53","6" => "54","7" => "55","8" => "56","9" => "57","a" => "65","b" => "66","c" => "67","d" => "68","e" => "69","f" => "70","g" => "71","h" => "72","i" => "73","j" => "74","k" => "75","l" => "76","m" => "77","n" => "78","o" => "79","p" => "80","q" => "81","r" => "82","s" => "83","t" => "84","u" => "85","v" => "86","w" => "87","x" => "88","y" => "89","z" => "90");
		$str = strtr($str, $str1);
		return $str;
	}
}

$check = new Resi();
$result = $check->ResiJNE("YOUR-AWB");
header("Content-type:application/json");
print_r($result[1]);