<?php
/**
Title: View multiple (a list of) subscribers.

Description: View many subscribers with a single API call.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => subscriber_list
	[*api_output] => xml, json, or serialize
	[*ids] => ID's (comma-separated) of each subscriber you want to view
	[filters] => See below code example for all filters you can pass.
}

Example response:
{
	[0] => Array
	  (
		  [id] => ID of the subscriber. Example: 2
		  [subscriberid] => ID of the subscriber. Example: 2
		  [listid] => ID of the list this subscriber is part of. Example: 1
		  [formid] => Subscription form ID used when subscribing. Example: 0
		  [sdate] => Date subscribed. Example: 2011-03-09 09:59:12
		  [udate] => Date unsubscribed. Example: 2011-03-08 14:24:44
		  [status] => Status for this list. Example: 1
		  [responder] => 1
		  [sync] => 0
		  [unsubreason] => Unsubscribe reason.
		  [unsubcampaignid] => Campaign sent when unsubscribed. Example: 10
		  [unsubmessageid] => Message sent when unsubscribed. Example: 1
		  [first_name] => First name of subscriber. Example: Name
		  [last_name] => Last name of subscriber. Example: One
		  [cdate] => Date subscribed. Example: 2011-03-02 14:47:01
		  [email] => Email address of subscriber. Example: test@testing.com
		  [bounced_hard] => Number of times this subscriber has hard-bounced. Example: 0
		  [bounced_soft] => Number of times this subscriber has soft-bounced. Example: 0
		  [bounced_date] => Date of most recent bounce for this subscriber.
		  [ip] => IP address of the subscriber. Example: 38.104.242.98
		  [ua] =>
		  [hash] => Unique hash for the subscriber. Example: dfdsfdsfefr345345wfdrs3r
		  [socialdata_lastcheck] => Last time social data was fetched for this subscriber.
		  [email_local] =>
		  [email_domain] =>
		  [lid] => 1
		  [name] => Full name of this subscriber. Example: Name One
		  [a_unsub_date] => 2011-03-08
		  [a_unsub_time] => 14:24:44
		  [lists] => Array
		  [listslist] => String of lists for this subscriber. Example: 1
		  [fields] => Array
		  [bounces] => Array
		  [bouncescnt] => Number of total bounces for this subscriber. Example: 0
	  )

	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Something is returned
	[result_output] => The result output used. Example: serialize
}
**/


// By default, this sample code is designed to get the result from your
// server (where ActiveCampaign Email Marketing Software is installed) and to print out the result
$url    = 'http://emvx.net';

// optional custom field search: provide field ID, and search query (this searches all custom field values)
/*
$fields = array(
    1 => 'value', // in this case, 1 is the custom field ID, and 'value' is the value you are searching for
);
*/

$params = array(

    // the API Username and Password are the same as your login access to the Admin panel
    // replace these with your info
    'api_user'     => 'YOUR_USERNAME',
    'api_pass'     => 'YOUR_PASSWORD',

    // this is the action that fetches a subscriber info based on the ID you provide
    'api_action'   => 'subscriber_list',

    // define the type of output you wish to get back
    // possible values:
    // - 'xml'  :      you have to write your own XML parser
    // - 'json' :      data is returned in JSON format and can be decoded with
    //                 json_decode() function (included in PHP since 5.2.0)
    // - 'serialize' : data is returned in a serialized format and can be decoded with
    //                 a native unserialize() function
    'api_output'   => 'serialize',

    // a comma-separated list of IDs of subscribers you wish to fetch
    'ids'          => '1,2,3,4,5',

    // filters: supply filters that will narrow down the results
    //'filters[first_name]'      => 'matt',										// First Name: pattern match - provide any sequence of characters
    //'filters[last_name]'       => 'tho',										// Last Name: pattern match - provide any sequence of characters
    //'filters[email]'           => 'mike',										// Email address: pattern match - provide any sequence of characters
    //'filters[listid]'          => '4',											// List ID's associated with subscriber: exact match - provide single list ID, or comma-separated list ID's
    //'filters[status]'          => '1',											// Status of subscriber: exact match - provide single status, or comma-separated statuses (0: unconfirmed, 1: active, 2: unsubscribed)
    //'filters[datetime]'        => '2009-10-22',							// Subscribers *from* a specific date/time (set status param): pattern match - provide any portion of MySQL-formatted date/time string
    //'filters[since_datetime]'  => '2009-10-22 00:00:00',		// Subscribers *since* a specified date in the past (set status param): exact match - provide MySQL-formatted date/time string
    //'filters[fields]'          => serialize($fields),				// Filter on custom field values - provide as separate array called $fields
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