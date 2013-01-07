<?php
/**
Title: Add new subscriber.

Description: Add a new subscriber to the system.

Supported formats: xml, json, serialize

Supported request methods: POST

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => subscriber_add
	[*api_output] => xml, json, or serialize
}

POST variables (* denotes requirement):
{
	[*email] => Email of the new subscriber. Example: 'test@example.com'
	[*first_name] => First name of the subscriber. Example: 'FirstName'
	[*last_name] => Last name of the subscriber. Example: 'LastName'
	[ field[345,0] ] => Custom field values. Example: field[345,0] = 'value'. In this example, "345" is the field ID. Leave 0 as is.
	[*p[123]] => Assign to lists. List ID goes in brackets, as well as the value.
	[*status[123]] => The status for each list the subscriber is added to. Examples: 0 = unconfirmed (Downloaded users only), 1 = active, 2 = unsubscribed
	[form] => Optional subscription Form ID, to inherit those redirection settings. Example: 1001. This will allow you to mimic adding the subscriber through a subscription form, where you can take advantage of the redirection settings.
	[ noresponders[123] ] => Whether or not to set "do not send any future responders." Examples: 1 = yes, 0 = no.
	[ sdate[123] ] => Subscribe date for particular list - leave out to use current date/time. Example: '2009-12-07 06:00:00'
	[ sendoptin[123] ] => Use only if status = 0. Whether or not to set "send instant responders." Examples: 1 = yes, 0 = no.
	[ instantresponders[123] ] => Use only if status = 1. Whether or not to set "send instant responders." Examples: 1 = yes, 0 = no.
	[ lastmessage[123] ] => Whether or not to set "send the last broadcast campaign." Examples: 1 = yes, 0 = no.
}

Example response:
{
	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Subscriber added
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

	// this is the action that adds a subscriber
	'api_action'   => 'subscriber_add',

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
	//'id'                     => 0, // adds a new one
	//'username'               => $params['api_user'], // username cannot be changed!
	'email'                    => 'test@example.com',
	'first_name'               => 'FirstName',
	'last_name'                => 'LastName',

	// any custom fields
	//'field[345,0]'           => 'field value', // where 345 is the field ID

	// assign to lists:
	'p[123]'                   => 123, // example list ID
	'status[123]'              => 1, // 0: unconfirmed (Downloaded users only), 1: active, 2: unsubscribed
	//'form'									 => 1001, // Subscription Form ID, to inherit those redirection settings
	//'noresponders[123]'      => 1, // uncomment to set "do not send any future responders"
	//'sdate[123]'             => '2009-12-07 06:00:00', // Subscribe date for particular list - leave out to use current date/time
	// use the folowing only if status=0
	//'sendoptin[123]'         => 1, // uncomment to send an opt-in confirmation email
	// use the folowing only if status=1
	'instantresponders[123]' => 1, // set to 0 to if you don't want to sent instant autoresponders 
	//'lastmessage[123]'       => 1, // uncomment to set "send the last broadcast campaign"

	//'p[]'                    => 345, // some additional lists?
	//'status[345]'            => 1, // some additional lists?
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

echo '<br /><br />POST params:<br />';
echo '<pre>';
print_r($post);
echo '</pre>';

?>