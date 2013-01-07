<?php
/**
Title: Add new User Group.

Description: Add a new User Group to the system.

Supported formats: xml, json, serialize

Supported request methods: POST

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => group_add
	[*api_output] => xml, json, or serialize
}

POST variables (* denotes requirement):
{
	[title] => Name of the group. Example: 'Group Title'
	[descript] => Brief description of the group.
	[ lists[] ] => Assign to lists. Example: lists[1] => 1, lists[2] => 2, etc.
	[ sendmethods[] ] => Assign sending methods. Example: 1,2,3
	[pg_form_add] => Permission for adding subscription forms. Example: 1 = yes, 0 = no
	[pg_form_delete] => Permission for deleting subscription forms. Example: 1 = yes, 0 = no
	[pg_form_edit] => Permission for editing subscription forms. Example: 1 = yes, 0 = no
	[pg_list_add] => Permission for adding lists. Example: 1 = yes, 0 = no
	[pg_list_bounce] => Permission for accessing list bounce settings. Example: 1 = yes, 0 = no
	[pg_list_delete] => Permission for deleting lists. Example: 1 = yes, 0 = no
	[pg_list_edit] => Permission for editing lists. Example: 1 = yes, 0 = no
	[pg_list_emailaccount] => Permission for managing Unsubscribe By Email. Example: 1 = yes, 0 = no
	[pg_list_headers] => Permission for managing custom email headers. Example: 1 = yes, 0 = no
	[pg_list_opt] => Permission for managing email confirmation sets. Example: 1 = yes, 0 = no
	[pg_message_add] => Permission for adding messages. Example: 1 = yes, 0 = no
	[pg_message_delete] => Permission for deleting messages. Example: 1 = yes, 0 = no
	[pg_message_edit] => Permission for editing messages. Example: 1 = yes, 0 = no
	[pg_message_send] => Permission for sending messages. Example: 1 = yes, 0 = no
	[pg_reports_campaign] => Permission for accessing Campaign Reports. Example: 1 = yes, 0 = no
	[pg_reports_list] => Permission for accessing List Reports. Example: 1 = yes, 0 = no
	[pg_reports_user] => Permission for accessing User Reports. Example: 1 = yes, 0 = no
	[pg_reports_trend] => Permission for accessing Report trends. Example: 1 = yes, 0 = no
	[pg_subscriber_actions] => Permission for managing Subscriber Actions. Example: 1 = yes, 0 = no
	[pg_subscriber_add] => Permission for adding subscribers. Example: 1 = yes, 0 = no
	[pg_subscriber_approve] => Permission for approving subscribers. Example: 1 = yes, 0 = no
	[pg_subscriber_delete] => Permission for deleting subscribers. Example: 1 = yes, 0 = no
	[pg_subscriber_edit] => Permission for editing subscribers. Example: 1 = yes, 0 = no
	[pg_subscriber_export] => Permission for exporting subscribers. Example: 1 = yes, 0 = no
	[pg_subscriber_fields] => Permission for managing subscriber custom fields. Example: 1 = yes, 0 = no
	[pg_subscriber_filters] => Permission for managing subscriber list segments. Example: 1 = yes, 0 = no
	[pg_subscriber_import] => Permission for importing subscribers. Example: 1 = yes, 0 = no
	[pg_subscriber_sync] => Permission for syncing subscribers. Example: 1 = yes, 0 = no
	[pg_template_add] => Permission for adding templates. Example: 1 = yes, 0 = no
	[pg_template_delete] => Permission for deleting templates. Example: 1 = yes, 0 = no
	[pg_template_edit] => Permission for editing templates. Example: 1 = yes, 0 = no
	[pg_user_add] => Permission for adding users. Example: 1 = yes, 0 = no
	[pg_user_delete] => Permission for deleting users. Example: 1 = yes, 0 = no
	[pg_user_edit] => Permission for editing users. Example: 1 = yes, 0 = no
	[group_limit_attachment_checkbox] => Attachments limit. Example: 'on'
	[limit_attachment] => Attachments limit quantity. Example: '23'
	[group_limit_campaign_checkbox] => Campaign sending limit. Example: 'on'
	[limit_campaign] => Campaign sending limit quantity. Example: '34'
	[limit_campaign_type] => Campaign sending limit by type. Examples: 'day', 'week', 'month', 'month1st', 'monthcdate', 'year', 'ever'
	[group_limit_list_checkbox] => List maximum limit. Example: 'on'
	[limit_list] => List maximum limit quantity. Example: '45'
	[group_limit_mail_checkbox] => Email sending limit (campaigns * subscribers). Example: 'on'
	[limit_mail] => Email sending limit quantity. Example: '67'
	[limit_mail_type] => Email sending limit by type. Examples: 'day', 'week', 'month', 'month1st', 'monthcdate', 'year', 'ever'
	[group_limit_subscriber_checkbox] => Subscriber limit. Example: 'on'
	[limit_subscriber] => Subscriber limit quantity. Example: '56'
	[group_limit_user_checkbox] => User limit. Example: 'on'
	[limit_user] => User limit quantity. Example: '12'
	[optinconfirm] => Force opt-in confirmations. Example: 'on'
	[unsubscribelink] => Force unsubscribe links. Example: 'on'
	[abuseratio] => Abuse ratio threshold (default: 4%). Example: 4
	[req_approval] => Does this group need approval to send. Uncomment for yes. Example: 'on'
	[req_approval_1st] => If yes, then first how many should be approved. Example: 2
	[req_approval_notify] => If yes, comma-separated email addresses to notify when they send4approval. Example: 'email1@example.com, email2@example.com'
}

Example response:
{
	[group_id] => ID of the Group just added. Example: 5
	[result_code] => Whether or not the response was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Group added
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

	// this is the action that adds a group
	'api_action'   => 'group_add',

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
	//'id'       => 0, // adds a new one
	'title' => 'Group Title',
	'descript' => 'Group Description',

	// assign it lists:
	'lists[1]' => '1', // access to one list
	//'lists[2]' => '2', // some more lists?

	// assign it sending methods:
	'sendmethods[]' => '1,2', // comma-separated mailer ID's

	// permissions (uncomment the ones you wish to add):
	//'pg_form_add' => '1',
	//'pg_form_delete' => '1',
	//'pg_form_edit' => '1',
	//'pg_list_add' => '1',
	//'pg_list_bounce' => '1',
	//'pg_list_delete' => '1',
	//'pg_list_edit' => '1',
	//'pg_list_emailaccount' => '1',
	//'pg_list_headers' => '1',
	//'pg_list_opt' => '1',
	//'pg_message_add' => '1',
	//'pg_message_delete' => '1',
	//'pg_message_edit' => '1',
	//'pg_message_send' => '1',
	//'pg_reports_campaign' => '1',
	//'pg_reports_list' => '1',
	//'pg_reports_user' => '1',
	//'pg_reports_trend' => '1',
	//'pg_subscriber_actions' => '1',
	//'pg_subscriber_add' => '1',
	//'pg_subscriber_approve' => '1',
	//'pg_subscriber_delete' => '1',
	//'pg_subscriber_edit' => '1',
	//'pg_subscriber_export' => '1',
	//'pg_subscriber_fields' => '1',
	//'pg_subscriber_filters' => '1',
	//'pg_subscriber_import' => '1',
	//'pg_subscriber_sync' => '1',
	//'pg_template_add' => '1',
	//'pg_template_delete' => '1',
	//'pg_template_edit' => '1',
	//'pg_user_add' => '1',
	//'pg_user_delete' => '1',
	//'pg_user_edit' => '1',

	// limits (uncomment each set to use that limit):

	// attachments limit
	//'group_limit_attachment_checkbox' => 'on',
	//'limit_attachment' => '23',

	// how many campaigns can be sent. type can be: 'day', 'week', 'month', 'month1st', 'monthcdate', 'year', 'ever'
	//'group_limit_campaign_checkbox' => 'on',
	//'limit_campaign' => '34',
	//'limit_campaign_type' => 'month',

	// how many lists can the group have
	//'group_limit_list_checkbox' => 'on',
	//'limit_list' => '45',

	// how many emails (campaigns * subscribers) can be sent. type can be: 'day', 'week', 'month', 'month1st', 'monthcdate', 'year', 'ever'
	//'group_limit_mail_checkbox' => 'on',
	//'limit_mail' => '67',
	//'limit_mail_type' => 'month',

	// how many subscribers can it handle
	//'group_limit_subscriber_checkbox' => 'on',
	//'limit_subscriber' => '56',

	// how many users can this group have
	//'group_limit_user_checkbox' => 'on',
	//'limit_user' => '12',

	//'optinconfirm' => 'on', // force opt-in confirmations

	//'unsubscribelink' => 'on', // force unsubscribe links

	'abuseratio' => 4, // abuse ratio threshold (default: 4%)

	// does this group need approval to send
	//'req_approval' => 'on', // uncomment for yes
	'req_approval_1st' => 2, // if yes, then first how many should be approved
	'req_approval_notify' => '', // if yes, comma-separated email addresses to notify when they send4approval
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