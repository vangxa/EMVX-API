<?php
/**
Title: Create new campaign.

Description: Create and send a new campaign.

Supported formats: xml, json, serialize

Supported request methods: POST

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => campaign_create
	[*api_output] => xml, json, or serialize
}

POST variables (* denotes requirement):
{
	[id] => Adds a new one. Example: 0
	[*type] => Campaign type. Example: 'single', 'recurring', 'split', 'responder', 'reminder', 'special', 'activerss', 'text'
	[filterid] => List segment ID (0 for no segment)
	[*bounceid] => The bounce setting/account to use for bounces. Examples: -1 = use all available bounce accounts, 0 = don't use bounce management, or ID of a bounce account
	[*name] => The internal campaign name. Example: 'Friday Newsletter'
	[*sdate] => The date when the campaign should be sent out (not used for campaign types 'responder', 'reminder', 'special'). Example: '2010-11-05 08:40:00'
	[*status] => The status of the campaign. Example: 0 = draft, 1 = scheduled
	[*public] => The visibility of the campaign - if the campaign should be visible on the public side. Example: 1 = visible, 0 = not visible.
	[mailer_log_file] => Turn on logging for this campaign (will be stored in /cache/ folder). Example: 4 = turn on logging.
	[*tracklinks] => Whether or not to track links, and what type of links to track. Examples: 'all', 'mime', 'html', 'text', 'none'. Setting this value to 'all' will let the system know to fetch, parse, and track all emails it finds in both TEXT and HTML body. If mime/html/text is provided, then variable 'links' also must exist, with a list of URLs to track. Choosing 'html' or 'text' will track only the links in that message body.
	[tracklinksanalytics] => Whether or not to use the lists' Google Analytics settings. Example: 1 = yes, 0 = no.
	[trackreads] => Whether or not to track reads. Examples: 0 = no, 1 = yes.
	[trackreadsanalytics] => Whether or not to use the lists' Google Analytics settings. Example: 1 = yes, 0 = no.
	[analytics_campaign_name] => Set the name of this campaign to use in Google Analytics. Example: 'Friday Newsletter: Analytics'
	[tweet] => Whether or not to use lists' Twitter settings. Example: 1 = yes, 0 = no.
	[facebook] => Whether or not to use lists' Facebook settings. Example: 1 = yes, 0 = no.
	[embed_images] => Whether or not to embed images. Example: 1 = yes, 0 = no.
	[htmlunsub] => Whether or not to append unsubscribe link to the bottom of HTML body. Example: 1 = yes, 0 = no.
	[textunsub] => Whether or not to append unsubscribe link to the bottom of TEXT body. Example: 1 = yes, 0 = no.
	[htmlunsubdata] => (DOWNLOADED USERS ONLY) Provide custom unsubscribe link addons. Example: '<div><a href="%UNSUBSCRIBELINK%">Click here</a> to unsubscribe from future mailings.</div>'.
	[textunsubdata] => (DOWNLOADED USERS ONLY) Provide custom unsubscribe link addons. Example: 'Click here to unsubscribe from future mailings: %UNSUBSCRIBELINK%'.
	[recurring] => If recurring mailing. Repeat every day. Example: 'day1'. Possible values are day1, day2, week1, week2, month1, month2, quarter1, quarter2, year1, year2. Values ending with 1 mean "every", and ending with 2 mean "every other."
	[split_type] => If split mailing. Example: 'even' (send each message to even number of subscribers). Possible values are even, read and click. If read or click is used, 'split_offset' and 'split_offset_type' need to be present. In that case it will use a "winner" scenario.
	[split_offset] => If split mailing. How much to wait. Example: 12.
	[split_offset_type] => If split mailing. How long to wait. Examples: hour, day, week, month.
	[responder_offset] => If auto-responder. How long after (un)subscription to send it. Example: 12.
	[responder_type] => If auto-responder. After what to send it. Examples: 'subscribe' and 'unsubscribe'
	[reminder_field] => If auto-reminder. What subscriber field to use. Examples: cdate, sdate, udate, or an ID of a custom field.
	[reminder_format] => If auto-reminder. Format in which the date is represented in abovementioned subscriber field. Example: 'yyyy-mm-dd'
	[reminder_type] => If auto-reminder. Match just a month and the day (yearly), or match year as well. Examples: 'month_day', 'year_month_day'
	[reminder_offset] => If auto-reminder. How many days/weeks/months/years from that date should it trigger. Example: 5.
	[reminder_offset_type] => If auto-reminder. Examples: day, week, month, year.
	[reminder_offset_sign] => If auto-reminder. Examples: + and -. For example: +5days from today needs to be the value of subscriber's field.
	[activerss_interval] => If ActiveRSS. Same options as for recurring mailings. Example: 'day1'
	[ *p[1] ] => List ID to use. Example: p[1] => 1
	[ *m[1] ] => Message ID to use. Example: m[1] => 100. In this example, 1 = corresponding message ID, 100 = the percentage of subscribers who should get this message (used only in Split Test campaigns, with Winner scenario).
	[ linkurl[] ] => If 'tracklinks' variable is not set to 'all', provide a list of link URL's to track here. Example: 'http://www.google.com/'.
	[ linkname[] ] => If 'tracklinks' variable is not set to 'all', provide a list of link names to track here. Example: 'Google Inc.'.
	[ linkmessage[] ] => If 'tracklinks' variable is not set to 'all', provide a list of link messages to track here. Found in message with this ID. Example: 8.
}

Example response:
{
	[id] => ID of the campaign that was created. Example: 8
	[result_code] => Whether or not the request was successful. Examples: 1 = yes, 0 = no
	[result_message] => A custom message that appears explaining what happened. Example: Campaign saved
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

	// this is the action that creates a campaign
	'api_action'   => 'campaign_create',

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
	//'id'                      => 0, // adds a new one

	'type'                      => 'single', // campaign type (defaults to single)
	// 'single', 'recurring', 'split', 'responder', 'reminder', 'special', 'activerss', 'text'

	'filterid'                  => 0, // use list segment with ID (0 for no segment),
	'bounceid'                  => -1,
	// -1: use all available bounce accounts, 0: don't use bounce management, or ID of a bounce account

	'name'                      => 'ActiveCampaign TEST: ' . date("m/d/Y H:i", strtotime("now")),
	'sdate'                     => '2011-10-05 08:40:00', // the date when campaign should be sent out
	// not used for 'responder', 'reminder', 'special'

	'status'                    => 1, // 0: draft, 1: scheduled
	'public'                    => 1, // if campaign should be visible via public side

	//'mailer_log_file'         => 4, // turn on logging for this campaign (will be stored in /cache/ folder)

	'tracklinks'                => 'all', // possible values: 'all', 'mime', 'html', 'text', 'none'
	// setting this value to all will let the system know to fetch, parse, and track all emails it finds in both TEXT and HTML body
	// if mime/html/text is provided, then variable 'links' also must exist, with a list of URLs to track
	// choosing html or text will track only the links in that message body

	//'tracklinksanalytics'     => 1, // set to 1 if you wish to use list's Google Analytics settings

	'trackreads'                => 1, // possible values: 0 and 1

	'trackreadsanalytics'     => 0, // set to 1 if you wish to use list's Google Analytics settings
	//'analytics_campaign_name' => '', // set the name of this campaign to use in Google Analytics

	//'tweet'                   => 1, // set to 1 if you wish to use list's Twitter settings
	//'facebook'                => 1, // set to 1 if you wish to use list's Facebook settings

	//'embed_images'            => 1, // uncomment this line if you wish to embed images

	'htmlunsub'                 => 1, // append unsubscribe link to the bottom of HTML body
	'textunsub'                 => 1, // append unsubscribe link to the bottom of TEXT body

	// provide custom unsubscribe link addons
	//'htmlunsubdata'           => '<div><a href="%UNSUBSCRIBELINK%">Click here</a> to unsubscribe from future mailings.</div>', // (DOWNLOADED USERS ONLY)
	//'textunsubdata'           => 'Click here to unsubscribe from future mailings: %UNSUBSCRIBELINK%', // (DOWNLOADED USERS ONLY)

	/* IF RECURRING MAILING */
	//'recurring'               => 'day1', // repeat every day
	// possible values are day1, day2, week1, week2, month1, month2, quarter1, quarter2, year1, year2
	// values ending with 1 mean "every", and ending with 2 mean "every other"

	/* IF SPLIT MAILING */
	//'split_type'              => 'even', // send each message to even number of subscribers
	// possible values are even, read and click. if read or click is used, 'split_offset' and 'split_offset_type' need to be present.
	// in that case it will use a "winner" scenario
	//'split_offset'            => 12, // how much to wait
	//'split_offset_type'       => 'hour', // how long to wait. possible values: hour, day, week, month

	/* IF AUTO-RESPONDER */
	//'responder_offset'        => 12, // how long after (un)subscription to send it
	//'responder_type'          => 'subscribe', // after what to send it. possible values are: subscribe and unsubscribe

	/* IF AUTO-REMINDER */
	//'reminder_field'          => 12, // what subscriber field to use. possible values are cdate, sdate, udate, or an ID of a custom field
	//'reminder_format'         => 'yyyy-mm-dd', // format in which the date is represented in abovementioned subscriber field
	//'reminder_type'           => 'month_day', // match just a month and the day (yearly), or match year as well.
	//possible values: month_day, year_month_day
	//'reminder_offset'         => 5, // how many days/weeks/months/years from that date should it trigger
	//'reminder_offset_type'    => 'day', // possible values: day, week, month, year
	//'reminder_offset_sign'    => '+', // possible values: + and -.
	// in this case it would be: +5days from today needs to be the value of subscriber's field

	/* IF ACTIVERSS */
	//'activerss_interval'      => 'day1', // same options as for recurring mailings


	// send to lists:
	'p[1]'                       => 1, // example list ID
	//'p[1]'                     => 345, // some additional lists?

	// send message(s):
	'm[70]'                    => 100, // example message ID would be 123. 100 means send to 100% of subscribers
	/* IF SPLIT MAILING */
	// if sending a split mailing with "winner" scenario, more than one message can be provided.
	// in that case, the sum of all messages should total to under 100%
	// (so the rest of subscribers can receive a winner message after it is determined)
	//'r[453643]'               => 10, // some additional messages?
	//'r[346146]'               => 10, // some additional messages?



	// if 'tracklinks' variable is not set to 'all', provide a list of links to track here

	// tracked link example
	//'linkurl[0]'               => 'http://www.google.com/',
	//'linkname[0]'              => 'Google Inc.',
	//'linkmessage[0]'              => 123, // found in message with this ID

	// more tracked links...
	//'linkurl[1]'               => 'http://www.yahoo.com/',
	//'linkname[1]'              => 'Yahoo Inc.',
	//'linkmessage[1]'              => 345, // found in message with this ID
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
