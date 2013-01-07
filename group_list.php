<?php
/**
Title: View many User Groups.

Description: View multiple User Groups with a single API call.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => group_list
	[*api_output] => xml, json, or serialize
	[*ids] => A comma-separated list of User Group ID's you wish to view.
}

Example response:
{
	[0] => Array
	  (
	    [id] => ID of the group. Example: 3
	    [title] => Name of the group. Example: Admin
	    [descript] => Description of the group. Example: This is a group for admin users (people that can manage content)
	    [unsubscribelink] => Whether or not to force unsubscribe links. Example: 0
	    [optinconfirm] => Whether or not to force opt-in confirmations. Example: 0
	    [p_admin] => Whether or not this group has admin privileges. Example: 1
	    [pg_list_add] => Permission for adding lists. Example: 1 = yes, 0 = no
	    [pg_list_edit] => Permission for editing lists. Example: 1 = yes, 0 = no
	    [pg_list_delete] => Permission for deleting lists. Example: 1 = yes, 0 = no
	    [pg_list_opt] => Permission for managing email confirmation sets. Example: 1 = yes, 0 = no
	    [pg_list_headers] => Permission for managing custom email headers. Example: 1 = yes, 0 = no
	    [pg_list_emailaccount] => Permission for managing Unsubscribe By Email. Example: 1 = yes, 0 = no
	    [pg_list_bounce] => Permission for accessing list bounce settings. Example: 1 = yes, 0 = no
	    [pg_message_add] => Permission for adding messages. Example: 1 = yes, 0 = no
	    [pg_message_edit] => Permission for editing messages. Example: 1 = yes, 0 = no
	    [pg_message_delete] => Permission for deleting messages. Example: 1 = yes, 0 = no
	    [pg_message_send] => Permission for sending messages. Example: 1 = yes, 0 = no
	    [pg_subscriber_add] => Permission for adding subscribers. Example: 1 = yes, 0 = no
	    [pg_subscriber_edit] => Permission for editing subscribers. Example: 1 = yes, 0 = no
	    [pg_subscriber_delete] => Permission for deleting subscribers. Example: 1 = yes, 0 = no
	    [pg_subscriber_import] => Permission for importing subscribers. Example: 1 = yes, 0 = no
	    [pg_subscriber_approve] => Permission for approving subscribers. Example: 1 = yes, 0 = no
	    [pg_subscriber_export] => Permission for exporting subscribers. Example: 1 = yes, 0 = no
	    [pg_subscriber_sync] => Permission for syncing subscribers. Example: 1 = yes, 0 = no
	    [pg_subscriber_filters] => Permission for managing subscriber list segments. Example: 1 = yes, 0 = no
	    [pg_subscriber_actions] => Permission for managing Subscriber Actions. Example: 1 = yes, 0 = no
	    [pg_subscriber_fields] => Permission for managing subscriber custom fields. Example: 1 = yes, 0 = no
	    [pg_user_add] => Permission for adding users. Example: 1 = yes, 0 = no
	    [pg_user_edit] => Permission for editing users. Example: 1 = yes, 0 = no
	    [pg_user_delete] => Permission for deleting users. Example: 1 = yes, 0 = no
	    [pg_group_add] => Permission for adding groups. Example: 1 = yes, 0 = no
	    [pg_group_edit] => Permission for editing groups. Example: 1 = yes, 0 = no
	    [pg_group_delete] => Permission for deleting groups. Example: 1 = yes, 0 = no
	    [pg_template_add] => Permission for adding templates. Example: 1 = yes, 0 = no
	    [pg_template_edit] => Permission for editing templates. Example: 1 = yes, 0 = no
	    [pg_template_delete] => Permission for deleting templates. Example: 1 = yes, 0 = no
	    [pg_personalization_add] => Permission for adding personalization tags. Example: 1 = yes, 0 = no
	    [pg_personalization_edit] => Permission for editing personalization tags. Example: 1 = yes, 0 = no
	    [pg_personalization_delete] => Permission for deleting personalization tags. Example: 1 = yes, 0 = no
	    [pg_form_add] => Permission for adding subscription forms. Example: 1 = yes, 0 = no
	    [pg_form_edit] => Permission for editing subscription forms. Example: 1 = yes, 0 = no
	    [pg_form_delete] => Permission for deleting subscription forms. Example: 1 = yes, 0 = no
	    [pg_reports_campaign] => Permission for viewing campaign reports. Example: 1 = yes, 0 = no
	    [pg_reports_list] => Permission for viewing list reports. Example: 1 = yes, 0 = no
	    [pg_reports_user] => Permission for viewing user reports. Example: 1 = yes, 0 = no
	    [pg_reports_trend] => Permission for viewing trend reports. Example: 1 = yes, 0 = no
	    [pg_startup_reports] => 9
	    [pg_startup_gettingstarted] => 1
	    [sdate] => 2011-03-02 14:46:40
	    [req_approval] => 0
	    [req_approval_1st] => 2
	    [req_approval_notify] =>
	    [socialdata] => 0
	  )

	[1] => Array
	  (
	    [id] => 4
	    [title] => Group 1
	    [descript] => Group for all other users
	    [unsubscribelink] => 0
	    [optinconfirm] => 0
	    [p_admin] => 1
	    [pg_list_add] => 1
	    [pg_list_edit] => 1
	    [pg_list_delete] => 1
	    [pg_list_opt] => 1
	    [pg_list_headers] => 1
	    [pg_list_emailaccount] => 1
	    [pg_list_bounce] => 1
	    [pg_message_add] => 1
	    [pg_message_edit] => 1
	    [pg_message_delete] => 1
	    [pg_message_send] => 1
	    [pg_subscriber_add] => 1
	    [pg_subscriber_edit] => 1
	    [pg_subscriber_delete] => 1
	    [pg_subscriber_import] => 1
	    [pg_subscriber_approve] => 1
	    [pg_subscriber_export] => 1
	    [pg_subscriber_sync] => 1
	    [pg_subscriber_filters] => 1
	    [pg_subscriber_actions] => 1
	    [pg_subscriber_fields] => 1
	    [pg_user_add] => 1
	    [pg_user_edit] => 1
	    [pg_user_delete] => 1
	    [pg_group_add] => 1
	    [pg_group_edit] => 1
	    [pg_group_delete] => 1
	    [pg_template_add] => 1
	    [pg_template_edit] => 1
	    [pg_template_delete] => 1
	    [pg_personalization_add] => 1
	    [pg_personalization_edit] => 1
	    [pg_personalization_delete] => 1
	    [pg_form_add] => 1
	    [pg_form_edit] => 1
	    [pg_form_delete] => 1
	    [pg_reports_campaign] => 1
	    [pg_reports_list] => 1
	    [pg_reports_user] => 1
	    [pg_reports_trend] => 1
	    [pg_startup_reports] => 9
	    [pg_startup_gettingstarted] => 1
	    [sdate] => 2011-03-02 14:46:40
	    [req_approval] => 0
	    [req_approval_1st] => 2
	    [req_approval_notify] =>
	    [socialdata] => 0
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

	// this is the action that fetches a group info based on the ID you provide
	'api_action'   => 'group_list',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// a comma-separated list of IDs of groups you wish to fetch
	'ids'          => '1,2,3,4,5',
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