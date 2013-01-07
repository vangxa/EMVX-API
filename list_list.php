<?php
/**
Title: View multiple mailing lists.

Description: View multiple mailing lists in the system, including all information associated with each.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => list_list
	[*api_output] => xml, json, or serialize
	[*ids] => A comma-separated list of subscription form ID's of lists you wish to view.
	[ filters[name] ] => Filter: Perform a pattern match (LIKE) for List Name.
	[global_fields] => Whether or not to include global custom fields.
}

Example response:
{
  [0] => Array
    (
      [id] => ID of the list. Example: 1
      [stringid] => URL-friendly name of list. Example: general-list
      [userid] => User ID who created this list. Example: 1
      [name] => Internal name of list. Example: General List
      [cdate] => Date/time the list was created. Example: 2011-03-02 14:46:40
      [p_use_tracking] => 1
      [p_use_analytics_read] => Whether or not to use Google Analytics Read Tracking. Examples: yes = 1, no = 0
      [p_use_analytics_link] => Whether or not to use Google Analytics Link Tracking. Examples: yes = 1, no = 0
      [p_use_twitter] => Whether or not to use Twitter campaign auto-sharing. Examples: yes = 1, no = 0
      [p_use_facebook] => Whether or not to use Facebook campaign auto-sharing. Examples: yes = 1, no = 0
      [p_embed_image] => Whether or not to embed images for campaigns send to this list. Examples: yes = 1, no = 0
      [p_use_captcha] => Whether or not to use captcha image verification when subscribing to this list. Examples: yes = 1, no = 0
      [p_duplicate_send] => Whether or not to allow duplicate emails to be sent. Examples: yes = 1, no = 0
      [p_duplicate_subscribe] => Whether or not to allow duplicate emails to subscribe to this list. Examples: yes = 1, no = 0
      [send_last_broadcast] => Whether or not to send last broadcast message to new subscribers of this list. Examples: yes = 1, no = 0
      [private] => Whether or not this list is private (not visible on public side). Examples: yes = 1, no = 0
      [analytics_domains] => Domains that use Analytics for tracking site traffic.
      [analytics_source] => The source name in your Analytics account relating to this list.
      [analytics_ua] => Your Analytics UA number
      [twitter_token] => The Twitter token used to send updates to your Twitter account.
      [twitter_token_secret] => The Twitter token secret used to send updates to your Twitter account.
      [facebook_session] => The Facebook session used to send updates to your Facebook account.
      [carboncopy] => Additional email addresses that campaigns for this list are sent to.
      [subscription_notify] => Whenever a subscriber subscribes to this list, an email gets sent to this address.
      [unsubscription_notify] => Whenever a subscriber UNsubscribes to this list, an email gets sent to this address.
      [require_name] => Whether or not to require a name when subscribing to this list. Examples: yes = 1, no = 0
      [get_unsubscribe_reason] => Whether or not to ask for a reason when subscribers UNsubscribe. Examples: yes = 1, no = 0
      [to_name] => Default subscriber name (used when subscriber has not entered a name). Example: Subscriber
      [optinoptout] => 1
      [sender_name] => Sender's Contact Information.
      [sender_addr1] => Sender's Contact Information.
      [sender_addr2] => Sender's Contact Information.
      [sender_city] => Sender's Contact Information.
      [sender_state] => Sender's Contact Information.
      [sender_zip] => Sender's Contact Information.
      [sender_country] => Sender's Contact Information.
      [sender_phone] => Sender's Contact Information.
      [listid] => ID of the list. Example: 1
      [p_admin] => 1
      [p_list_add] => Permission for adding lists. Example: 1 = yes, 0 = no
      [p_list_edit] => Permission for editing lists. Example: 1 = yes, 0 = no
      [p_list_delete] => Permission for deleting lists. Example: 1 = yes, 0 = no
      [p_list_sync] => Permission for accessing database sync. Example: 1 = yes, 0 = no
      [p_list_filter] => Permission for accessing list segments. Example: 1 = yes, 0 = no
      [p_message_add] => Permission for adding messages. Example: 1 = yes, 0 = no
      [p_message_edit] => Permission for editing messages. Example: 1 = yes, 0 = no
      [p_message_delete] => Permission for deleting messages. Example: 1 = yes, 0 = no
      [p_message_send] => Permission for sending messages. Example: 1 = yes, 0 = no
      [p_subscriber_add] => Permission for adding subscribers. Example: 1 = yes, 0 = no
      [p_subscriber_edit] => Permission for editing subscribers. Example: 1 = yes, 0 = no
      [p_subscriber_delete] => Permission for deleting subscribers. Example: 1 = yes, 0 = no
      [p_subscriber_import] => Permission for importing subscribers. Example: 1 = yes, 0 = no
      [p_subscriber_approve] => Permission for approving subscribers. Example: 1 = yes, 0 = no
      [subscribers] => Number of subscribers to this list. Example: 1
      [campaigns] => Number of campaigns sent to this list. Example: 8
      [emails] => Number of unique emails sent to this list. Example 19
      [fields] => Array
      [groups] => Array
      [groupsCnt] => 2
      [require_optin] => Whether or not Opt-in is required for this list. Examples: yes = 1, no = 0
      [optid] => The Opt Set ID. Example: 1
      [optname] => Internal name of the email confirmation set. Example: Default Email Confirmation Set
      [optin_confirm] => Whether or not Opt-in confirmation is being used. Examples: yes = 1, no = 0
      [optin_format] => Format of Opt-in confirmation email. Example: mime
      [optin_from_name] => From Name for Opt-in confirmation email. Example: ActiveCampaign Email Marketing Software
      [optin_from_email] => From Email for Opt-in confirmation email. Example: email@test.com
      [optin_subject] => Subject for Opt-in confirmation email. Example: Please confirm your subscription
      [optin_text] => Text of Opt-in confirmation email. Example: Thank you for subscribing.

Click here to confirm your subscription:
%CONFIRMLINK%
      [optin_html] => HTML of Opt-in confirmation email. Example: <body><div style="font-size: 12px; font-family: Arial, Helvetica;"><strong>Thank you for subscribing to %LISTNAME%!</strong></div> <div style="padding: 15px; font-size: 12px; background: #F2FFD8; border: 3px solid #E4F4C3; margin-bottom: 0px; margin-top: 15px; font-family: Arial, Helvetica;">To confirm that you wish to be subscribed, please click the link below:<br /><br /><a href="%CONFIRMLINK%"><strong>Confirm My Subscription</strong></a></div><p> </p></body>
      [optout_confirm] => Whether or not Opt-out confirmation is being used. Examples: yes = 1, no = 0
      [optout_format] => Format of Opt-out confirmation email. Example: mime
      [optout_from_name] => From Name for Opt-out confirmation email. Example: ActiveCampaign Email Marketing Software
      [optout_from_email] => From Email for Opt-out confirmation email. Example: email@test.com
      [optout_subject] => Subject for Opt-out confirmation email. Example: Please confirm your unsubscription
      [optout_text] => Text of Opt-out confirmation email. Example: Please click this link to confirm your unsubscription: %CONFIRMLINK%
      [optout_html] => HTML of Opt-in confirmation email. Example: Please click this link to confirm your unsubscription:<br /><a href="%CONFIRMLINK%">%CONFIRMLINK%</a>
      [bounces] => Array
      [analytics_domains_list] => Array
      [facebook_oauth_me] => Array
      [facebook_oauth_logout_url] => URL to log-out of Facebook session.
      [facebook_oauth_login_url] => URL to log-in to Facebook session.
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
	'api_action'   => 'list_list',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// a comma-separated list of IDs of lists you wish to fetch
	'ids'          => '1,2,3,4,5',

	// filters: supply filters that will narrow down the results
	//'filters[name]'      => 'General',  // perform a pattern match (LIKE) for List Name

	// include global custom fields? by default, it does not
	//'global_fields'      => true,
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