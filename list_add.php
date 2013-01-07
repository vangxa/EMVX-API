<?php
/**
Title: Add new mailing list.

Description: Add a new mailing list, just like you would on the Manage Lists page of the admin section.

Supported formats: xml, json, serialize

Supported request methods: POST

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => list_add
	[*api_output] => xml, json, or serialize
}

POST variables (* denotes requirement):
{
	[*name] => Internal list name. Example: 'List Name'
	[*subscription_notify] => Comma-separated list of email addresses to notify on new subscriptions to this list
	[*unsubscription_notify] => Comma-separated list of email addresses to notify on any unsubscriptions from this list
	[*to_name] => If subscriber doesn't enter a name, use this. Example: 'Subscriber'
	[*carboncopy] => Comma-separated list of email addresses to send a copy of all mailings to upon send
	[*stringid] => URL-safe list name. Example: 'api-test'
	[p_use_analytics_read] => Whether or not to use Google Analytics for external read tracking. Examples: 1 = yes, 0 = no
	[analytics_ua] => Google Analytics User Account ID this list should use for (read) tracking
	[p_use_analytics_link] => Whether or not to use Google Analytics for external link tracking
	[analytics_source] => How do you want this list's links in campaigns to appear in Google Analytics; leave blank to use the list name
	[ analytics_domains[] ] => Domain(s) that should be tracked with Google Analytics (link tracking in campaigns). Example: 'yourdomain1.com'
	[p_use_twitter] => Whether or not to send this campaign to Twitter. Examples: 1 = yes, 0 = no
	[twitter_user] => Twitter Account Username
	[twitter_pass] => Twitter Account Password
	[*optid] => ID of a Email Confirmation Set to use. Example: 1
	[ *bounceid[]] => Bounce management accounts
	[p_duplicate_send] => Whether or not to allow sending to duplicates. Examples: 1 = yes, 0 = no
	[p_duplicate_subscribe] => Whether or not to allow subscribing duplicates. Examples: 1 = yes, 0 = no
	[p_use_captcha] => Whether or not to require CAPTCHA ("enter text on image" field) for this list. Examples: 1 = yes, 0 = no
	[get_unsubscribe_reason] => Whether or not to ask for reason when unsubscribing. Examples: 1 = yes, 0 = no
	[send_last_broadcast] => Whether or not to send the last broadcast campaign when subscribing. Examples: 1 = yes, 0 = no
	[require_name] => Whether or not to require name with email when subscribing. Examples: 1 = yes, 0 = no
	[private] => Whether or not to hide it on public side (direct links to it will still work though). Examples: 1 = yes, 0 = no
	[sender_name]	=> HOSTED users only: Company (or Organization)
	[sender_addr1] => HOSTED users only: Address
	[sender_zip] => HOSTED users only: Zip or Postal Code
	[sender_city]	=> HOSTED users only: City
	[sender_country] => HOSTED users only: Country
}

Example response:
{
	[id] => ID of the list just added. Example: 6
	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: List added
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

	// this is the action that adds a list
	'api_action'   => 'list_add',

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
	'name'                     => 'List Name', // list name
	'subscription_notify'      => '', // comma-separated list of email addresses to notify on new subscriptions to this list
	'unsubscription_notify'    => '', // comma-separated list of email addresses to notify on any unsubscriptions from this list
	'to_name'                  => "Subscriber", // if subscriber doesn't enter a name, use this
	'carboncopy'               => '', // comma-separated list of email addresses to send a copy of all mailings to upon send
	'stringid'                 => 'api-test', // URL-safe list name
	//'p_use_analytics_read'   => 1, // uncomment to use Google Analytics for external read tracking
	//'analytics_ua'             => '', // Google Analytics User Account ID this list should use for (read) tracking
	//'p_use_analytics_link'   => 1, // uncomment to use Google Analytics for external link tracking
	//'analytics_source'       => '', // How do you want this list's links in campaigns to appear in Google Analytics; leave blank to use the list name
	//'analytics_domains[0]'   => 'yourdomain1.com', // domain that should be tracked with Google Analytics (link tracking in campaigns)
	//'analytics_domains[1]'   => 'yourdomain2.com', // some additional domains
	//'p_use_twitter'          => 1, // uncomment to send this campaign to Twitter
	//'twitter_user'           => '', // Twitter Account Username
	//'twitter_pass'           => '', // Twitter Account Password
	'optid'                    => '1', // ID of a Email Confirmation Set to use
	'bounceid[1]'              => 1, // use default bounce management account
	//'bounceid[123]'          => 123, // use some additional bounce management accounts
	//'p_duplicate_send'       => 1, // uncomment to allow sending to duplicates
	//'p_duplicate_subscribe'  => 1, // uncomment to allow subscribing duplicates
	//'p_use_captcha'          => 1, // uncomment to require CAPTCHA ("enter text on image" field) for this list
	//'get_unsubscribe_reason' => 1, // uncomment to ask for reason when unsubscribing
	//'send_last_broadcast'    => 1, // uncomment to send the last broadcast campaign when subscribing
	//'require_name'           => 1, // uncomment to require name with email when subscribing
	//'private'                => 1, // uncomment to hide it on public side (direct links to it will still work though)

	// HOSTED users only: sender information (all fields below) required
	//'sender_name'						 => '', // Company (or Organization)
	//'sender_addr1'					 => '', // Address
	//'sender_zip'						 => '', // Zip or Postal Code
	//'sender_city'						 => '', // City
	//'sender_country'				 => '', // Country
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