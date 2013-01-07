<?php
/**
Title: Update Design/Branding settings for User Groups.

Description: Allows you to modify Design/Branding settings for a particular User Group, such as site name, logo location, and HTML/CSS templates for the public and admin sections of the software.

Supported formats: xml, json, serialize

Supported request methods: POST

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => branding_edit
	[*api_output] => xml, json, or serialize
}

POST variables (* denotes requirement):
{
	[*id] => Row id number (might not be the same as the group id)
	[branding_url] => URL of logo
	[copyright] => Hide copyright. Example: 'on' means you are hiding it
	[demo] => Enable demo mode. Example: 'on' to enable
	[footer_html] => You are able to specify a block of content that will be included at the bottom of all emails sent for this user group. Example: 'html'
	[footer_html_valueEditor] => Content of non-removeable footer. Example: '<p>footer content here</p>'
	[footer_text] => You are able to specify a block of content that will be included at the bottom of all emails sent for this user group. Example: 'text'
	[footer_text_value] => Content of non-removeable footer. Example: 'text footer content'
	[*groupid] => Group ID number. Example: '4'
	[header_html] => You are able to specify a block of content that will be included at the top of all emails sent for this user group. Example: 'html'
	[header_html_valueEditor] => Content of non-removable header. Example: '<p>header content here</p>'
	[header_text] => You are able to specify a block of content that will be included at the top of all emails sent for this user group. Example: 'text'
	[header_text_value] => Content of non-removable header. Example: 'text header content'
	[help] => Hide external help content. Example: 'on' means you want to hide it
	[license] => Hide license information. Example: 'on'
	[links] => Hide product links. Example: 'on'
	[logo_source] => Must be set to 'url' if you are including a branding_url above
	[site_name] => Title of software. Example: 'ActiveCampaign Email Marketing'
	[version] => Hide version number. Example: 'on'
	[admin_template_show] => Customize admin section template. Example: '1' means yes
	[admin_template] => The actual HTML template, if admin_template_show is '1'
	[admin_style_show] => Customize admin section CSS styles. Example: '1' means yes
	[admin_style] => The actual CSS, if admin_style_show is '1'. Example: 'test { color: green; }'
	[public_template_show] => Customize public section template. Example: '1' means yes
	[public_template] => The actual HTML template, if public_template_show is '1'
	[public_style_show] => Customize public section CSS styles. Example: '1' means yes
	[public_style] => The actual CSS, if public_style_show is '1'. Example: 'test { color: green; }'
}

Example response:
{
	[result_code] => Whether or not the request was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Design Settings updated
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

	// this is the action that modifies group info based on the ID you provide
	'api_action'   => 'branding_edit',

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
	'id'         => 2, // row id number (might not be the same as the group id)
	'branding_url' => 'http://emvx.net/logo.jpg', //logo location
	//'copyright' => 'on', //hide copyright ('on' means you are hiding it)
	//'demo' => 'on', //enables demo mode
	//'footer_html' => 'html', //uncomment this and the below line to include a non-removeable footer
	//'footer_html_valueEditor' => '<p>footer content here</p>', //content of non-removeable footer
	//'footer_text' => 'text',
	//'footer_text_value' => 'text footer content',
	'groupid' => '4', //group id number
	//'header_html' => 'html',
	//'header_html_valueEditor' => '<p>header content here</p>',
	//'header_text' => 'text',
	//'header_text_value' => 'text header content',
	//'help' => 'on', //hide external help content ('on' means you want to hide it)
	//'license' => 'on', //hide license information
	//'links' => 'on', //hide product links
	'logo_source' => 'url', //must be set to 'url' if you are including a branding_url above
	'site_name' => 'ActiveCampaign Email Marketing', //title of software
	//'version' => 'on', //hide version number
	//'admin_template_show' => '1',
	//'admin_template' => '',
	//'admin_style_show' => '1',
	//'admin_style' => 'test { color: green; }',
	//'public_template_show' => '1',
	//'public_template' => '',
	//'public_style_show' => '1',
	//'public_style' => '',
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
