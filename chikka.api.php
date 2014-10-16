<?php
/*
 * Chikka SMS API by Jim-Bert Amante a.k.a. tagabantay
 */

// The MIT License (MIT)
// Copyright (c) 2014
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
// The above copyright notice and this permission notice shall be included in all
// copies or substantial portions of the Software.
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.

ini_set('display_errors', 1);

error_reporting(E_ALL);

/*
 * List of cellphone number separated by ';'
 * example : 639991234567;639481234567;
 * If you are using free trial, you can only send 
 * your message to your test number you've set at the chikka api
 * website
 */
$post_cp = "639481234567;";

/*
 * Message to be sent to your cellphone
 */
$message = "your message here";

/*
 * Defauly url for chikka api. No need to change this part
 */
$url = "https://post.chikka.com/smsapi/request";

/*
 * 10 digit Short code you've configured in the server
 */
$shortcode = "0123456789";

/*
 * Client id provided by chikka api
 * provided below is a sample client id
 */
$client_id = "4eaec087a4e834c88354fd9a9ee2e7253ba1f18880e3a939ac6e13a3e5bb37c5";

/*
 * Secret key provided by chikka api
 * provided below is a sample secret key
 */
$secret_key = "1ae877646f6cb09df2878a6b165e3cf80e264ac2b9156c5b374f8038e31454cc";

/*
 * Message id : unique identification of your every message.
 */
$count = time();

$arr_cp = explode(";", $post_cp);

for($i=0; $i < sizeof($arr_cp);$i++){
	/* loop through */
	if(trim($arr_cp[$i]) != ""){
		echo $arr_cp[$i];
		$post_data = array(
			"mobile_number" => $arr_cp[$i], 

			"shortcode"=>$shortcode,

			"message_id"=>md5($count++), 

			"client_id"=>$client_id,

			"secret_key"=>$secret_key, 

			"message_type"=>"SEND", 

			"message"=>$message 
		);

		$postvars = http_build_query($post_data);

		// open connection
		$ch = curl_init();

		// set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_POST, count($post_data));

		curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);

		// execute post
		$result = curl_exec($ch);

		// close connection
		curl_close($ch);
	}
}
