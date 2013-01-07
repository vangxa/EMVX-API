<?php
/**
Title: Add new subscription form.

Description: Add a new subscription form, just like you would on the Integration page of the admin section.

Supported formats: xml, json, serialize

Supported request methods: POST

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => form_add
	[*api_output] => xml, json, or serialize
}

POST variables (* denotes requirement):
{
	[*name] => The internal name of the subscription form. Example: 'Form Name'
	[*type] => Examples: 'both', 'subscribe', 'unsubscribe'
	[*sub1] => Successful Subscription action - what happens when someone successfully subscribes using this form? Examples: 'custom', 'redirect', 'default'
	[sub1_redirect] => URL (for redirect). Example: 'http://mysite.com'
	[sub1Editor] => HTML message (for custom message). Example: '<p>HTML text here</p>'
	[*sub2] => Awaiting Confirmation (Subscribe) - what happens if they are awaiting confirmation? Examples: default, custom, redirect
	[sub2_redirect] => URL (for redirect). Example: 'http://mysite.com'
	[sub2Editor] => HTML message (for custom message). Example: '<p>HTML text here</p>'
	[*sub3] => Confirmed Subscription - what happens if they are confirmed? Examples: default, custom, redirect
	[sub3_redirect] => URL (for redirect). Example: 'http://mysite.com'
	[sub3Editor] => HTML message (for custom message). Example: '<p>HTML text here</p>'
	[*sub4] => Subscription Error - what happens if there is an error? Examples: default, custom, redirect
	[sub4_redirect] => URL (for redirect). Example: 'http://mysite.com'
	[sub4Editor] => HTML message (for custom message). Example: '<p>HTML text here</p>'
	[*unsub1] => Successful UnSubscription - what happens when someone successfully UNsubscribes using this form? Examples: default, custom, redirect
	[unsub1_redirect] => URL (for redirect). Example: 'http://mysite.com'
	[unsub1Editor] => HTML message (for custom message). Example: '<p>HTML text here</p>'
	[*unsub2] => Awaiting Confirmation (Unsubscribe) - what happens if they are awaiting confirmation? Examples: default, custom, redirect
	[unsub2_redirect] => URL (for redirect). Example: 'http://mysite.com'
	[unsub2Editor] => HTML message (for custom message). Example: '<p>HTML text here</p>'
	[*unsub3] => Confirmed UnSubscription - what happens if they confirmed their unsubscription? Examples: default, custom, redirect
	[unsub3_redirect] => URL (for redirect). Example: 'http://mysite.com'
	[unsub3Editor] => HTML message (for custom message). Example: '<p>HTML text here</p>'
	[*unsub4] => UnSubscription Error - what happens if there is an error? Examples: default, custom, redirect
	[unsub4_redirect] => URL (for redirect). Example: 'http://mysite.com'
	[unsub4Editor] => HTML message (for custom message). Example: '<p>HTML text here</p>'
	[*up1] => Request to update subscription details. Examples: default, custom, redirect
	[up1_redirect] => URL (for redirect). Example: 'http://mysite.com'
	[up1Editor] => HTML message (for custom message). Example: '<p>HTML text here</p>'
	[*up2] => Updated subscription details. Examples: default, custom, redirect
	[up2_redirect] => URL (for redirect). Example: 'http://mysite.com'
	[up2Editor] => HTML message (for custom message). Example: '<p>HTML text here</p>'
	[*allowselection] => List Options. Examples: 1 or 0. "Allow user to select lists they wish to subscribe or unsubscribe from" (1) or "Force user to subscribe to or unsubscribe from all lists selected above" (0)
	[*emailconfirmations] => Opt-In/Out Confirmation. Examples: 1 or 0. "Send individual email confirmations for each list" (1) or "Send a single email confirmation for all lists" (0).
	[*ask4fname] => First Name. Examples: required (1) or not required (0)
	[*ask4lname] => Last Name. Examples: required (1) or not required (0)
	[ fields[] ] => Subscriber Fields. Example: fields[0] => 1
	[*optinoptout] => ID of Opt-In/Out set. Example: 1. Opt-In/Out confirmation set (if "Send a single email confirmation for all lists" is chosen for 'emailconfirmations' field above). This field is ignored if "Send individual email confirmations for each list" is chosen for 'emailconfirmations' field above.
	[*captcha] => Require Captcha image? Examples: yes (1) or no (0)
	[ *p[] ] => Assign to lists. Example: p[1] => 1
}

Example response:
{
	[id] => ID of the form just added. Example: 1001
	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Subscription form added
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

	// this is the action that adds a message
	'api_action'   => 'form_add',

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
	'name'                     => 'Form Name', // the internal name of the subscription form
	'type'                     => 'both', // options: both, subscribe, unsubscribe

	// Form Completion Options

	// Successful Subscription
	'sub1'                     => 'default', // options: default, custom, redirect
	//'sub1_redirect'          => 'http://', // URL (for redirect)
	//'sub1Editor'             => '', // HTML message (for custom message)

	// Awaiting Confirmation (Subscribe)
	'sub2'                     => 'default', // options: default, custom, redirect
	//'sub2_redirect'          => 'http://', // URL (for redirect)
	//'sub2Editor'             => '', // HTML message (for custom message)

	// Confirmed Subscription
	'sub3'                     => 'default', // options: default, custom, redirect
	//'sub3_redirect'          => 'http://', // URL (for redirect)
	//'sub3Editor'             => '', // HTML message (for custom message)

	// Subscription Error
	'sub4'                     => 'default', // options: default, custom, redirect
	//'sub4_redirect'          => 'http://', // URL (for redirect)
	//'sub4Editor'             => '', // HTML message (for custom message)

	// Successful UnSubscription
	'unsub1'                   => 'default', // options: default, custom, redirect
	//'unsub1_redirect'        => 'http://', // URL (for redirect)
	//'unsub1Editor'           => '', // HTML message (for custom message)

	// Awaiting Confirmation (Unsubscribe)
	'unsub2'                   => 'default', // options: default, custom, redirect
	//'unsub2_redirect'        => 'http://', // URL (for redirect)
	//'unsub2Editor'           => '', // HTML message (for custom message)

	// Confirmed UnSubscription
	'unsub3'                   => 'default', // options: default, custom, redirect
	//'unsub3_redirect'        => 'http://', // URL (for redirect)
	//'unsub3Editor'           => '', // HTML message (for custom message)

	// UnSubscription Error
	'unsub4'                   => 'default', // options: default, custom, redirect
	//'unsub4_redirect'        => 'http://', // URL (for redirect)
	//'unsub4Editor'           => '', // HTML message (for custom message)

	// Request to update subscription details
	'up1'                      => 'default', // options: default, custom, redirect
	//'up1_redirect'           => 'http://', // URL (for redirect)
	//'up1Editor'              => '', // HTML message (for custom message)

	// Updated subscription details
	'up2'                      => 'default', // options: default, custom, redirect
	//'up2_redirect'           => 'http://', // URL (for redirect)
	//'up2Editor'              => '', // HTML message (for custom message)

	// List Options
	// "Allow user to select lists they wish to subscribe or unsubscribe from" (1) or
	// "Force user to subscribe to or unsubscribe from all lists selected above" (0)
	'allowselection'           => 0, // options: 1 or 0

	// Opt-In/Out Confirmation
	// "Send individual email confirmations for each list" (1) or
	// "Send a single email confirmation for all lists" (0)
	'emailconfirmations'       => 0, // options: 1 or 0

	// First and Last Name
	// required (1) or not required (0)
	'ask4fname'                => 1, // First Name - options: 1 or 0
	'ask4lname'                => 1, // Last Name - options: 1 or 0

	// Subscriber Fields
	'fields[1]'                 => 1, // example subscriber field ID
	//'fields[2]'               => 2, // some additional fields?

	// Opt-In/Out confirmation set (if "Send a single email confirmation for all lists" is chosen for 'emailconfirmations' field above)
	// This field is ignored if "Send individual email confirmations for each list" is chosen for 'emailconfirmations' field above
	'optinoptout'              => 1, // ID of Opt-In/Out set

	// Require Captcha image? yes (1) or no (0)
	'captcha'                  => 0, // options: 1 or 0

	// assign to lists:
	'p[0]'                      => 123, // example list ID
	//'p[1]'                    => 345, // some additional lists?
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