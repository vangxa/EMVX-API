<?php
/**
Title: View Design/Branding settings for a specific User Group.

Description: Allows you to view Design/Branding settings for a particular User Group, such as site name, logo location, and HTML/CSS templates for the public and admin sections of the software.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => branding_view
	[*api_output] => xml, json, or serialize
}

Example response:
{
	[id] => Row ID of the Group. Example: 2
	[groupid] => Display ID of the Group. Example: 4
	[site_name] => Name of the software. Example: Email Marketing Software
	[site_logo] => Logo URL. Example: http://www.mysite.com/logo.jpg
	[header_text] => Whether or not to enable non-removable header for text messages. Examples: yes = 1, no = 0
	[header_text_value] => The value for the non-removable header for text messages.
	[header_html] => Whether or not to enable non-removable header for HTML messages. Examples: yes = 1, no = 0
	[header_html_value] => The value for the non-removable header for HTML messages.
	[footer_text] => Whether or not to enable non-removable footer for text messages. Examples: yes = 1, no = 0
	[footer_text_value] => The value for the non-removable footer for text messages.
	[footer_html] => Whether or not to enable non-removable footer for HTML messages. Examples: yes = 1, no = 0
	[footer_html_value] => The value for the non-removable footer for HTML messages.
	[copyright] => Whether or not to hide the copyright from public (non-code) view. Examples: yes = 1 (hide), no = 0
	[version] => Whether or not to hide the version number from public (non-code) view. Examples: yes = 1 (hide), no = 0
	[license] => Whether or not to hide license information from public (non-code) view. Examples: yes = 1 (hide), no = 0
	[links] => Whether or not to hide product links from public view. Examples: yes = 1 (hide), no = 0
	[demo] => Whether or not to enable demo mode, which will disable certain aspects of the software. Examples: yes = 1 (enable), no = 0
	[help] => Whether or not to hide external help links. Examples: yes = 1 (hide), no = 0
	[twitter_consumer_key] => The Twitter consumer key (for your application on Twitter). Example: JsjUb8QUaCg0fUDRfxnfcg
	[twitter_consumer_secret] => The Twitter consumer secret (for your application on Twitter). Example: ufR6occzeroEg4QzDYDZbqL8vMC8bji1a7c8oAYVM
	[admin_template_htm] => Custom admin section template HTML.
	[admin_template_css] => Custom admin section CSS.
	[public_template_htm] => Custom public section template HTML.
	[public_template_css] => Custom public section CSS.
	[result_code] => Whether or not the request was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Design Settings updated
	[result_output] => The result output used. Example: serialize
}
**/


// By default, this sample code is designed to get the result from your
// server (where ActiveCampaign Email Marketing is installed) and to print out the result
$url    = 'http://emvx.net';


$params = array(

	// the API Username and Password are the same as your login access to the Admin panel
	// replace these with your info
	'api_user'     => 'YOUR_USERNAME',
	'api_pass'     => 'YOUR_PASSWORD',

	// this is the action that modifies group info based on the ID you provide
	'api_action'   => 'branding_view',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',
);

// here we define the data we are posting in order to perform an update
$post = array(
	'id'         => 4, // group id number
);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// This section takes the input data and converts it to the proper format
$data = "";
foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
$data = rtrim($data, '& ');

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
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
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
