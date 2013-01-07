<?php
/**
Title: View a single email message.

Description: View a email message data, such as internal name, subject, content, visibility, etc.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => message_view
	[*api_output] => xml, json, or serialize
	[*id] => ID of the email message you want to view
}

Example response:
{
	[userid] => User ID who created the message. Example: 1
	[cdate] => Date message was created. Example: 2011-03-02 15:09:08
	[mdate] => Date message was modified. Example: 2011-03-07 11:40:28
	[name] => Internal name of the message. Example: Email 1
	[fromname] => From Name for the message. Example: Matt Jones
	[fromemail] => From Email for the message. Example: matt@testing.com
	[reply2] => Reply-To for the message.
	[priority] => Priority of the message. Example: 1 = High, 3 = Medium, 5 = Low
	[charset] => Character Set of the message.
	[encoding] => Encoding of the message. Example: quoted-printable
	[format] => Format of the message. Example: html
	[subject] => Subject of the message. Example: Email 1
	[text] => Text version of the message.
	[html] => HTML version of the message. Example: <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
		<head>
		<title>My document title</title>
		</head>
		<body>
		<p>test</p><p><a href="%WEBCOPY%">Click here to see a web copy of this email</a></p><p>juhhjk</p><p>%SOCIALSHARE%</p><p>jkijk</p><p><a href="%FORWARD2FRIEND%">Click here to forward this email to a friend</a></p><p>klk</p>
		</body>
		</html>
	[htmlfetch] => When to fetch HTML content for the message. Example: now
	[textfetch] => When to fetch text content for the message. Example: now
	[hidden] => Whether or not this message is hidden. Example: 1 = yes, 0 = no
	[preview_mime] => Mime preview of the message.
	[preview_data] => Preview of the message.
	[lists] => Array
	[files] => Array
	[filescnt] => Number of files attached to message. Example: 0
	[listslist] => List ID's associated with this message. Example: 1
	[fields] => Array
	[personalizations] => Array
	[activerss_show] => new
	[htmlfetchurl] => URL for HTML fetch.
	[textfetchurl] => URL for text fetch.
	[links] => Array
	[images] => Array
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

	// this is the action that fetches a message info based on the ID you provide
	'api_action'   => 'message_view',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// ID of the message you wish to fetch
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