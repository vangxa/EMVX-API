<?php
/**
Title: View one or many campaigns.

Description: View one or many campaigns already created in the system, including all information associated with each.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => campaign_list
	[*api_output] => xml, json, or serialize
	[*ids] => A comma-separated list of campaign ID's you wish to view.
	[ filters[name] ] => Filter: Perform a pattern match (LIKE) for Campaign Name.
	[ filters[type] ] => Type of campaign. ('single', 'recurring', 'split', 'responder', 'reminder', 'special', 'activerss', 'text')
	[ filters[cdate_since_datetime] ] => Campaigns created since a certain date.
	[ filters[sdate_since_datetime] ] => Campaigns that started sending since a certain date.
	[ filters[ldate_since_datetime] ] => Campaigns that last sent since a certain date.
	[ filters[groupids] ] => Campaigns sent by users of a certain group.
	[full] => Whether or not to return ALL data, or an abbreviated portion (set to 1 for ALL data, and 0 for abbreviated).
}

Example response:
{
  [0] => Array
      (
        [id] => 1
        [type] => single
        [userid] => 1
        [filterid] => 0
        [bounceid] => 0
        [realcid] => 0
        [processid] => 3
        [threadid] => 0
        [source] => web
        [name] => uhhjk
        [cdate] => 2011-01-31 15:34:28
        [sdate] => 2011-01-31 19:30:00
        [ldate] => 2011-02-01 08:21:55
        [send_amt] => 1
        [total_amt] => 1
        [opens] => 0
        [uniqueopens] => 0
        [linkclicks] => 0
        [uniquelinkclicks] => 0
        [subscriberclicks] => 0
        [forwards] => 0
        [uniqueforwards] => 0
        [hardbounces] => 0
        [softbounces] => 0
        [unsubscribes] => 0
        [unsubreasons] => 0
        [updates] => 0
        [socialshares] => 0
        [status] => 5
        [public] => 1
        [mail_transfer] => 1
        [mail_send] => 1
        [mail_cleanup] => 1
        [mailer_log_file] => 0
        [tracklinks] => html
        [tracklinksanalytics] => 0
        [trackreads] => 1
        [trackreadsanalytics] => 0
        [analytics_campaign_name] =>
        [tweet] => 0
        [facebook] => 0
        [embed_images] => 0
        [htmlunsub] => 1
        [textunsub] => 1
        [htmlunsubdata] => HTML DATA
        [textunsubdata] => Click here to unsubscribe from future mailings: %UNSUBSCRIBELINK%
        [recurring] => day1
        [split_type] => even
        [split_offset] => 2
        [split_offset_type] => day
        [split_winner_messageid] => 0
        [split_winner_awaiting] => 0
        [responder_offset] => 0
        [responder_type] => subscribe
        [reminder_field] => sdate
        [reminder_format] =>
        [reminder_type] => month_day
        [reminder_offset] => 0
        [reminder_offset_type] => day
        [reminder_offset_sign] => +
        [reminder_last_cron_run] =>
        [activerss_interval] => day1
        [ip4] => 0
        [lists] => Array
        [p_duplicate_send] => 0
        [p_embed_image] => 1
        [p_use_scheduling] =>
        [p_use_tracking] => 1
        [p_use_analytics_read] => 0
        [p_use_analytics_link] => 0
        [p_use_twitter] => 1
        [p_use_facebook] => 0
        [listslist] => 1
        [fields] => Array
        [ratios] => Array
        [sources] => Array
        [messages] => Array
        [messageslist] => 1
        [tlinks] => Array
        [readactions] => Array
    	)

  [result_code] => 1
  [result_message] => Success: Something is returned
  [result_output] => serialize
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

	// this is the action that fetches campaign info based on the ID you provide
	'api_action'   => 'campaign_list',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// a comma-separated list of IDs of campaigns you wish to fetch
	'ids'          => '1,2,3,4,5',

	// filters: supply filters that will narrow down the results
	//'filters[name]'           => 'General',  // perform a pattern match (LIKE) for Campaign Name
	//'filters[type]'           => 'single',   // campaign type ('single', 'recurring', 'split', 'responder', 'reminder', 'special', 'activerss', 'text')
	//'filters[cdate_since_datetime]' => '2009-10-22 00:00:00', // Campaigns created *since* a specified date in the past: exact match - provide MySQL-formatted date/time string
	//'filters[sdate_since_datetime]' => '2009-10-22 00:00:00', // Campaigns that started sending *since* a specified date in the past: exact match - provide MySQL-formatted date/time string
	//'filters[ldate_since_datetime]' => '2009-10-22 00:00:00', // Campaigns that last sent *since* a specified date in the past: exact match - provide MySQL-formatted date/time string
	//'filters[groupids]' => '5,7,9', // Campaigns created by users of specific group(s). Please note your API user must be in the "Admin" Group to retrieve different group data

	// whether or not to return ALL data, or an abbreviated portion (set to 0 for abbreviated)
	'full'         => 1,
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