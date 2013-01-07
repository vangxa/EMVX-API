<?php
/**
Title: Import message template.

Description: Import message template into the software (must be XML formatted file from an export).

Supported formats: xml, json, serialize

Supported request methods: POST

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => message_template_import
	[*api_output] => xml, json, or serialize
}

POST variables (* denotes requirement):
{
	[ *names[] ] => Array of internal template names. Example: 'My Template' (each array item corresponds to the same item in the 'urls' array)
	[*template_scope2] => List visibility. Examples: 'all', 'specific'
	[ p[1] ] => If template_scope is 'specific', supply individual list ID's. Example: p[1] => 1
	[ *urls[] ] => Array of URL's to XML files. Example: http://mysite.com/template.xml
}

Example response:
{
  [templates] => Array
    (
      [0] => Array
        (
        	[id] => 61
          [url] => http://mysite.com/template1.xml
          [result] => Array
            (
              [succeeded] => 1
              [message] => Your template has been successfully imported.
            )
        )
      [1] => Array
        (
        	[id] => 62
          [url] => http://mysite.com/template2.xml
          [result] => Array
            (
              [succeeded] => 1
              [message] => Your template has been successfully imported.
            )
        )
    )

	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Template added
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

	// this is the action that adds a message template
	'api_action'   => 'message_template_import',

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
	'names[0]'                  => 'My Template', // internal template name
	//'names[1]'                => 'My Template 2', // another? (corresponds to each URL added)
	'template_scope2'          => 'all', // list visibility: 'all' or 'specific'
	'p[1]'                     => '1', // if template_scope = 'specific', supply individual list ID's
  'urls[0]'									 => 'http://mysite.com/template.xml', // URL to XML file
  //'urls[1]'								 => 'http://mysite.com/template2.xml', // another?
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