<?php
/**
Title: Utilize Single Sign-On.

Description: Use Single Sign-On to allow users to authenticate from another application and automatically be logged-in to this software.

Supported formats: xml, json, serialize

Supported request methods: POST

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => singlesignon
	[*api_output] => xml, json, or serialize
	[*sso_addr] => This is the IP address user uses to access the server. Example: '127.0.0.1'. This can also be $_SERVER['REMOTE_ADDR'] if this script is ran by user
	[*sso_user] => this is the user you are logging in as. Example: 'admin'
	[*sso_pass] => Optionally, you can provide his password as well (for authentication). Example: 'adminspassword'
	[*sso_duration] => Optionally, you can provide the duration of his token (in minutes; default is 15). Example: 30
}

Example response:
{
	[token] => Token used to automatically log-in the user. Example: 7ed5jb6d44d6sc7ea413d2a599358m1b
	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: User found
	[result_output] => The result output used. Example: serialize
}
**/


// By default, this sample code is designed to get the result from your
// server (where ActiveCampaign Email Marketing is installed) and log in the person who opened this page
$url    = 'http://yourdomain.com/path/to/em';


$params = array(

	// the API Username and Password are the same as your login access to the Email Marketing
	// replace these with your info
	'api_user'     => 'YOUR_USERNAME',
	'api_pass'     => 'YOUR_PASSWORD',

	// this is the action that signs in a user
	'api_action'   => 'singlesignon',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// this is the IP address user uses to access the server
	'sso_addr'     => '127.0.0.1', // this can also be $_SERVER['REMOTE_ADDR'] if this script is ran by user
	// this is the user you are logging in as
	'sso_user'     => 'admin',
	// optionally, you can provide his password as well (for authentication)
	'sso_pass'     => md5('adminspassword'),
	// optionally, you can provide the duration of his token (in minutes; default is 15)
	'sso_duration' => 30,
);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your request, and show (print out) the response.
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

// If JSON is used, check if json_decode is present (PHP 5.2.0+)
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
	die('JSON not supported. (introduced in PHP 5.2.0)');
}

// define a final API request - GET
$api = $url . '/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS

$response = (string)curl_exec($request); // execute curl post and store results in $response

// additional options may be required depending upon your server configuration
// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close($request); // close curl object

if ( !$response ) {
	die('Nothing was returned. Do you have a connection to Email Marketing server?');
}

// This line takes the response and breaks it into an array using:
// JSON decoder
//$result = json_decode($response);
// unserializer
$result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
echo 'Message: ' . $result['result_message'] . '<br />';

if ( $result['result_code'] ) {
	// a sample url printed out
	$sampleurl = $url . '/admin/main.php?_ssot=' . $result['token'];
	echo 'A sample link your visitor can use to auto-login:<br />';
	echo '<a href="' . $sampleurl . '">' . $sampleurl . '</a>';
}

// The entire result printed out
echo 'The entire result printed out:<br />';
echo '<pre>';
print_r($result);
echo '</pre>';

// Raw response printed out
echo 'Raw response printed out:<br />';
echo '<pre>';
print_r($response);
echo '</pre>';

// API URL that returned the result
echo 'API URL that returned the result:<br />';
echo $api;

?>