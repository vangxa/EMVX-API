<?php
/**
Title: View a list of existing subscribers using pagination, much like it appears in the standard user interface.

Description: View a list of subscribers based on sorting, offset, limits, filters, and public/private. This allows you to view subscribers much like you would through the admin interface - Manage Subscribers screen.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => subscriber_paginator
	[*api_output] => xml, json, or serialize
	[*sort] => Leave empty for default sorting. Example: 01, 01D, 02, 02D, etc.
	[*offset] => The amount of records you want to skip over. This works in tandem with "limit." Example: 20, 50
	[*limit] => The amount of subscribers you wish to retrieve. Example: 10, 20, 50, 100
	[*filter] => The section filter that should be applied. This corresponds to a unique ID in the sectionfilter database table. Example: 11
	[*public] => 0: no, 1: yes
}

Example response:
{
  [paginator] =>
  [offset] => 0
  [limit] => 20
  [total] => 2
  [cnt] => 2
  [rows] => Array
	  (
	    [0] => Array
	      (
	        [id] => 2
	        [cdate] => 2011-03-02 14:47:01
	        [email] => test@testing.com
	        [bounced_hard] => 0
	        [bounced_soft] => 0
	        [bounced_date] =>
	        [ip] => 38.104.242.98
	        [ua] =>
	        [hash] => 82b87b15fb8ffea2863ca36544211ff3
	        [socialdata_lastcheck] =>
	        [email_local] =>
	        [email_domain] =>
	        [first_name] => Name
	        [last_name] => One
	        [name] => Subx One
	      )

	    [1] => Array
	      (
	        [id] => 8
	        [cdate] => 2011-03-10 13:15:27
	        [email] => test@testing2.com
	        [bounced_hard] => 0
	        [bounced_soft] => 0
	        [bounced_date] =>
	        [ip] => 127.0.0.1
	        [ua] =>
	        [hash] => a874667036b7f10004e3e216f765627b
	        [socialdata_lastcheck] =>
	        [email_local] =>
	        [email_domain] =>
	        [first_name] => Matt
	        [last_name] => Jones
	        [name] => Matt Jones
	      )
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
    'api_action'   => 'subscriber_paginator',

    // define the type of output you wish to get back
    // possible values:
    // - 'xml'  :      you have to write your own XML parser
    // - 'json' :      data is returned in JSON format and can be decoded with
    //                 json_decode() function (included in PHP since 5.2.0)
    // - 'serialize' : data is returned in a serialized format and can be decoded with
    //                 a native unserialize() function
    'api_output'   => 'serialize',

	'somethingthatwillneverbeused' => '', // this variable is pushed right back in the response
	'sort' => '', // leave empty to use a default one; other values are 01, 01D, 02, 02D, etc (number is a column index, and D means 'order descending')
	'offset' => 0, // start with this item (first page would be loaded using offset=0,limit=20, second page using offset=20,limit=20)
	'limit' => 20, // items per page
	'filter' => 0, // which sectionfilter to use (0=no filter)

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