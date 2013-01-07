<?php
/**
Title: View bounced email addresses for a specific campaign.

Description: View all bounces for a specific campaign. You will be able to see the email address of each bounce, much like on the Campaign Reports page.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => campaign_report_bounce_list
	[*api_output] => xml, json, or serialize
	[*campaignid] => ID of the campaign you wish to see bounces for
	[messageid] => Optional message ID
}

Example response:
{
	[0] => Array
		(
		  [id] => ID of the row. Example: 3
		  [email] => Email address that bounced. Example: test@gmail.com
		  [subscriberid] => ID of this subscriber. Example: 4
		  [listid] => ID of the list this subscriber bounced from. Example: 1
		  [campaignid] => ID of the campaign this subscriber bounced from. Example: 7
		  [messageid] => ID of the message this subscriber bounced from. Example: 1
		  [tstamp] => Date the bounce occurred. Example: 2011-03-07
		  [type] => Type of bounce. Example: hard
		  [code] => Bounce code. Example: 5.1.1
		  [counted] => Whether or not we count this bounce against this subscriber. Example: 1
		  [descript] => A description of the bounce. Example: Bad destination mailbox address
		)

	[1] => Array
    (
      [id] => 1
      [email] => jsdiaj24fe@asu8dy7uah3u.com
      [subscriberid] => 3
      [listid] => 1
      [campaignid] => 7
      [messageid] => 1
      [tstamp] => 2011-03-07
      [type] => hard
      [code] => 5.1.2
      [counted] => 1
      [descript] => Bad destination system address
    )

	[2] => Array
    (
      [id] => 2
      [email] => jdifhj83asdkk_si9jnnn@yahoo.com
      [subscriberid] => 5
      [listid] => 1
      [campaignid] => 7
      [messageid] => 1
      [tstamp] => 2011-03-07
      [type] => hard
      [code] => 5.2.4
      [counted] => 1
      [descript] => Mailing list expansion problem
    )

	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Something is returned
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

	// this is the action that fetches info based on the parameters you provide
	'api_action'   => 'campaign_report_bounce_list',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// ID you wish to fetch
	'campaignid'          => '122',

	// optional message ID
	//'messageid'           => '3',
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