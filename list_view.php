<?php
/**
Title: View a specific mailing list.

Description: View just a single mailing list details and settings.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => list_view
	[*api_output] => xml, json, or serialize
	[*id] => ID of the mailing list you want to view
}

Example response:
{
	[id] => 2
	[stringid] => list-1
	[userid] => 1
	[name] => List 1
	[cdate] => 2011-03-08 16:22:07
	[p_use_tracking] => 1
	[p_use_analytics_read] => 0
	[p_use_analytics_link] => 0
	[p_use_twitter] => 0
	[p_use_facebook] => 0
	[p_embed_image] => 1
	[p_use_captcha] => 0
	[p_duplicate_send] => 0
	[p_duplicate_subscribe] => 0
	[send_last_broadcast] => 0
	[private] => 0
	[analytics_domains] =>
	[analytics_source] => List 1
	[analytics_ua] =>
	[twitter_token] =>
	[twitter_token_secret] =>
	[facebook_session] =>
	[carboncopy] =>
	[subscription_notify] =>
	[unsubscription_notify] =>
	[require_name] => 0
	[get_unsubscribe_reason] => 0
	[to_name] => Subscriber
	[optinoptout] => 1
	[sender_name] =>
	[sender_addr1] =>
	[sender_addr2] =>
	[sender_city] =>
	[sender_state] =>
	[sender_zip] =>
	[sender_country] =>
	[sender_phone] =>
	[listid] => 2
	[p_admin] => 1
	[p_list_add] => 1
	[p_list_edit] => 1
	[p_list_delete] => 1
	[p_list_sync] => 1
	[p_list_filter] => 1
	[p_message_add] => 1
	[p_message_edit] => 1
	[p_message_delete] => 1
	[p_message_send] => 1
	[p_subscriber_add] => 1
	[p_subscriber_edit] => 1
	[p_subscriber_delete] => 1
	[p_subscriber_import] => 1
	[p_subscriber_approve] => 1
	[subscribers] => 1
	[campaigns] => 0
	[emails] => 0
	[fields] => Array

	[groups] => Array

	[groupsCnt] => 2
	[require_optin] => 0
	[optid] => 1
	[optname] => Default Email Confirmation Set
	[optin_confirm] => 1
	[optin_format] => mime
	[optin_from_name] => ActiveCampaign Email Marketing Software
	[optin_from_email] => me@test.com
	[optin_subject] => Please confirm your subscription
	[optin_text] => Thank you for subscribing.

	Click here to confirm your subscription:
	%CONFIRMLINK%
	[optin_html] => <body><div style="font-size: 12px; font-family: Arial, Helvetica;"><strong>Thank you for subscribing to %LISTNAME%!</strong></div> <div style="padding: 15px; font-size: 12px; background: #F2FFD8; border: 3px solid #E4F4C3; margin-bottom: 0px; margin-top: 15px; font-family: Arial, Helvetica;">To confirm that you wish to be subscribed, please click the link below:<br /><br /><a href="%CONFIRMLINK%"><strong>Confirm My Subscription</strong></a></div><p> </p></body>
	[optout_confirm] => 0
	[optout_format] => mime
	[optout_from_name] => ActiveCampaign Email Marketing Software
	[optout_from_email] => me@test.com
	[optout_subject] => Please confirm your unsubscription
	[optout_text] => Please click this link to confirm your unsubscription: %CONFIRMLINK%
	[optout_html] => Please click this link to confirm your unsubscription:<br /><a href="%CONFIRMLINK%">%CONFIRMLINK%</a>
	[bounces] => Array

	[analytics_domains_list] => Array

	[facebook_oauth_me] =>
	[facebook_oauth_logout_url] =>
	[facebook_oauth_login_url] =>
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

	// this is the action that fetches a list info based on the ID you provide
	'api_action'   => 'list_view',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// ID of the list you wish to fetch
	'id'           => 1,
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