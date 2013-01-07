<?php
/**
Title: View subscriber custom fields (no data).

Description: View subscriber custom fields based on the authenticated user group's lists.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => list_field_view
	[*api_output] => xml, json, or serialize
	[*ids] => ID's of the subscriber custom field you want to view (comma-separated for many; use 'all' to view all)
}

Example response:
{
	[0] => Array
	  (
	    [id] => ID of the custom field. Example: 3
	    [title] => Name of the custom field. Example: Field 1
	    [type] => Type of the custom field. Example: 1
	    [expl] => Brief explanation of the custom field
	    [req] => Required? Examples: 1 = yes, 0 = no
	    [onfocus] => Default value
	    [bubble_content] => Tooltip - displayed when user hovers over this field with the mouse
	    [label] => Label positioning. Example: 1 = Top, 0 = Left
	    [show_in_list] => Show on subscriber list page (as another column)? Examples: 1 = yes, 0 = no
	    [perstag] => Unique tag used as a placeholder for dynamic content
	    [relid] => Subscriber ID. Example: 21
	    [val] => Value for this subscriber/field. Example: my value
	    [dataid] => Row ID for the value.
	    [element] => Type of HTML element. Example: text
	    [tag] => Personalization tag. Example: %PERS_3%
	  )

	[1] => Array
	  (
	    [id] => 4
	    [title] => Field 2
	    [type] => 1
	    [expl] =>
	    [req] => 0
	    [onfocus] =>
	    [bubble_content] =>
	    [label] => 0
	    [show_in_list] => 1
	    [perstag] =>
	    [relid] => 1
	    [val] =>
	    [dataid] => 0
	    [element] => text
	    [tag] => %PERS_4%
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

	// this is the action that fetches a list info based on the ID you provide
	'api_action'   => 'list_field_view',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// ID(s) of the subscriber custom field(s) you wish to fetch - comma-separate for more than one
	'ids'           => '5',
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