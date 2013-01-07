<?php
/**
Title: Send a campaign.

Description: Re-send an existing campaign using optional actions like 'copy', 'preview', 'test'.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => campaign_send
	[*api_output] => xml, json, or serialize
	[*email] => Email address (of the subscriber) that will be receiving the email
	[*campaignid] => ID of the campaign you wish to send
	[*messageid] => ID of the campaign's message you wish to send (used in Split campaigns if you have more than one message assigned to a campaign).
	[*type] => Type of the message you wish to send (can be used to send TEXT-only email even if campaign is set to use MIME).
	[*action] => Examples: 'send' = send a campaign to this subscriber and to append him to the recipients list, 'copy' = send a copy of a campaign to subscriber (campaign is not updated), 'test' = send a test email to subscriber (campaign is not updated), 'source' = simulate a campaign test to subscriber (campaign is not updated), return message source, 'messagesize' = simulate a campaign test to subscriber (campaign is not updated), return message size, 'spamcheck' = simulate a campaign test to subscriber (campaign is not updated), return spam rate, 'preview' = same as preview
}

Example response:
{
	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Message sent
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

	// this is the action that sends a camapign to a subscriber on the campaign ID and subscriber email you provide
	'api_action'   => 'campaign_send',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// email address (of the subscriber) that will be receiving the email
	'email'        => 'test@example.com',

	// ID of the campaign you wish to send
	'campaignid'   => 1,

	// ID of the campaign's message you wish to send
	// (used in Split campaigns if you have more than one message assigned to a campaign)
	'messageid'   => 0,

	// type of the message you wish to send
	// (can be used to send TEXT-only email even if campaign is set to use MIME)
	'type'        => 'mime', // possible values: mime, text, html

	// action
	// send, spamcheck, preview, test, copy
	'action'      => 'send', // send: send a campaign to this subscriber and to append him to the recipients list
	                        // copy: send a copy of a campaign to subscriber (campaign is not updated)
	                       // test: send a test email to subscriber (campaign is not updated)
	                      // source: simulate a campaign test to subscriber (campaign is not updated), return message source
	                     // messagesize: simulate a campaign test to subscriber (campaign is not updated), return message size
	                    // spamcheck: simulate a campaign test to subscriber (campaign is not updated), return spam rate
	                   // preview: same as preview

//$email, $campaignid = 0, $messageid = 0, $type = 'html', $action = 'spamcheck'
);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

// clean up the url
$url = rtrim($url, '/ ');

// This sample code uses the CURL library for php to establish a connection,
// submit your data, and show (print out) the response.
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
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

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