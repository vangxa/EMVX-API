<?php
/**
Title: Modify existing subscriber custom field.

Description: Modify existing subscriber custom field, just like you would on the Custom Fields page of the admin section.

Supported formats: xml, json, serialize

Supported request methods: POST

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => list_field_edit
	[*api_output] => xml, json, or serialize
}

POST variables (* denotes requirement):
{
	[*id] => ID of the subscriber custom field you are editing
	[*title] => Internal field name. Example: 'Field 1'
	[*type] => Examples: 1 = Text Field, 2 = Text Box, 3 = Checkbox, 4 = Radio, 5 = Dropdown, 6 = Hidden field, 7 = List Box, 8 = Checkbox Group, 9 = Date
	[expl] => Brief explanation of the custom field
	[*req] => Required? Examples: 1 = yes, 0 = no
	[*onfocus] => Default value
	[*bubble_content] => Tooltip - displayed when user hovers over this field with the mouse
	[*label] => Label positioning. Example: 1 = Top, 0 = Left
	[*show_in_list] => Show on subscriber list page (as another column)? Examples: 1 = yes, 0 = no
	[*perstag] => Unique tag used as a placeholder for dynamic content
	[ *p[1] ] => Lists. Example: p[1] => 1, p[2] => 2
}

Example response:
{
	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Custom Field updated
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
	'api_action'   => 'list_field_edit',

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
	'id'                        => 6, // field ID to edit
	'title'                     => 'Field 1', // internal field name
	'type'                      => 1, // 1 = Text Field, 2 = Text Box, 3 = Checkbox, 4 = Radio, 5 = Dropdown, 6 = Hidden field, 7 = List Box, 8 = Checkbox Group, 9 = Date
	//'expl'                      => '',
	'req'                       => 0, // required? 1 or 0
	'onfocus'                   => '', // default value
	'bubble_content'            => '', // tooltip - displayed when user hovers over this field with the mouse
	'label'                     => 0, // label positioning: 1 = Top, 0 = Left
	'show_in_list'              => 1, // show on subscriber list page (as another column)?
	'perstag'                   => '', // unique tag used as a placeholder for dynamic content
	'p[1]'                      => 1, // for use in lists. use 0 for All lists
	//'p[2]'                      => 2, // some more lists?
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