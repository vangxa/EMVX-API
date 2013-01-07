<?php
/**
Title: Add new email message.

Description: Add a new email message to the system.

Supported formats: xml, json, serialize

Supported request methods: POST

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => message_add
	[*api_output] => xml, json, or serialize
}

POST variables (* denotes requirement):
{
	[*format] => Examples: html, text, mime (both html and text)
	[*subject] => Subject of the email message.
	[*fromemail] => The "From" email address. Example: 'test@example.com'
	[*fromname] => The "From" name. Example: 'From Name'
	[*reply2] => The "Reply To" email address. Example: 'reply2@example.com'
	[*priority] => Examples: 1 = high, 3 = medium/default, 5 = low
	[*charset] => Character set used. Example: 'utf-8'
	[*encoding] => Encoding used. Example: 'quoted-printable'
	[*htmlconstructor] => HTML version. Examples: editor, external, upload. If editor, it uses 'html' parameter. If external, uses 'htmlfetch' and 'htmlfetchwhen' parameters. If upload, uses 'message_upload_html'.
	[*html] => HTML version. Content of your html email. Example: '<strong>html</strong> content of your email'
	[*htmlfetch] => HTML version. URL where to fetch the body from. Example: 'http://somedomain.com/somepage.html'
	[*htmlfetchwhen] => HTML version. Examples: (fetch at) 'send' and (fetch) 'pers'(onalized)
	[message_upload_html[]] => HTML version. Not supported yet: an ID of an uploaded content.
	[*textconstructor] => Text version. Examples: editor, external, upload. If editor, it uses 'text' parameter. If external, uses 'textfetch' and 'textfetchwhen' parameters. If upload, uses 'message_upload_text'.
	[*text] => Text version. Content of your text only email. Example: '_text only_  content of your email'
	[*textfetch] => Text version. URL where to fetch the body from. Example: 'http://somedomain.com/somepage.txt'
	[*textfetchwhen] => Text version. When to fetch. Examples: (fetch at) 'send' and (fetch) 'pers'(onalized)
	[ message_upload_text[] ] => Text version. Not supported yet: an ID of an uploaded content
	[ attach[] ] => Not supported yet: an ID of an uploaded file
	[ *p[] ] => Assign to lists. Example: p[2] => 2, p[3] => 3
}

Example response:
{
	[id] => ID of the message just added. Example: 2
	[subject] => Subject of the message just added. Example: Email Subject
	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Email Message added
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
	'api_action'   => 'message_add',

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
	'format'                   => 'mime', // possible values: html, text, mime (both html and text)
	'subject'                  => 'Fetch at send: ' . date("m/d/Y H:i", strtotime("now")), // username cannot be changed!
	'fromemail'                => 'test@example.com',
	'fromname'                 => 'From Name',
	'reply2'                   => 'reply2@example.com',
	'priority'                 => '3', // 1=high, 3=medium/default, 5=low
	'charset'                  => 'utf-8',
	'encoding'                 => 'quoted-printable',

	// html version
	'htmlconstructor'          => 'external', // possible values: editor, external, upload
	                                       // if editor, it uses 'html' parameter
	                                      // if external, uses 'htmlfetch' and 'htmlfetchwhen' parameters
	                                     // if upload, uses 'message_upload_html'
	//'html'                     => '<strong>html</strong> content of your email', // content of your html email
	'htmlfetch'                => 'http://yoursite.com', // URL where to fetch the body from
	'htmlfetchwhen'            => 'send', // possible values: (fetch at) 'send' and (fetch) 'pers'(onalized)
	//'message_upload_html[]'  => 123, // not supported yet: an ID of an uploaded content

	// text version
	'textconstructor'          => 'external', // possible values: editor, external, upload
	                                       // if editor, it uses 'text' parameter
	                                      // if external, uses 'textfetch' and 'textfetchwhen' parameters
	                                     // if upload, uses 'message_upload_text'
	//'text'                     => '_text only_  content of your email', // content of your text only email
	'textfetch'                => 'http://yoursite.com', // URL where to fetch the body from
	'textfetchwhen'            => 'send', // possible values: (fetch at) 'send' and (fetch) 'pers'(onalized)
	//'message_upload_text[]'  => 123, // not supported yet: an ID of an uploaded content


	// assign attachments
	//'attach[123]'            => 123, // not supported yet: an ID of an uploaded file



	// assign to lists:
	'p[1]'                   => 1, // example list ID
	//'p[345]'                 => 345, // some additional lists?
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