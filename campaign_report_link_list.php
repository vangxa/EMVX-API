<?php
/**
Title: View all links (and click data) for a specific campaign.

Description: View all links (and click data) for a specific campaign. You will be able to see each individual link, and which subscribers clicked on each, much like on the Campaign Reports page.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => campaign_report_link_list
	[*api_output] => xml, json, or serialize
	[*campaignid] => ID of the campaign you wish to see bounces for
	[*messageid] => Message ID
}

Example response:
{
	[0] => Array
	  (
	    [id] => ID of the link row in the database. Example: 71
	    [name] => Short name of the link, often found in the title attribute. Example: Web Copy Link
	    [link] => Actual URL. Example: http://mysite.com/em/p_v.php
	    [a_unique] => Number of unique clicks on this link. Example: 1
	    [a_total] => Total number of clicks on this link. Example: 1
	    [info] => Array
	      (
	        [0] => Array
	          (
	            [email] => test@gmail.com
	            [subscriberid] => 2
	            [tstamp] => 2011-03-07 11:52:16
	            [times] => 1
	          )
	      )
	  )

	[1] => Array
	  (
	    [id] => 72
	    [name] => Social: Facebook
	    [link] => http://mysite.com/em/index.php?action=social&c=cmpgnhash.currentmesg&ref=facebook
	    [a_unique] => 1
	    [a_total] => 1
	    [info] => Array
        (
	        [0] => Array
	          (
	            [email] => test@gmail.com
	            [subscriberid] => 2
	            [tstamp] => 2011-03-07 11:52:30
	            [times] => 1
	          )
        )
	  )

	[2] => Array
		(
	    [id] => 73
	    [name] => Social: Twitter
	    [link] => http://mysite.com/em/index.php?action=social&c=cmpgnhash.currentmesg&ref=twitter
	    [a_unique] => 1
	    [a_total] => 1
	    [info] => Array
	      (
	        [0] => Array
	          (
	            [email] => test@gmail.com
	            [subscriberid] => 2
	            [tstamp] => 2011-03-07 11:52:26
	            [times] => 1
	          )
	      )
		)

	[3] => Array
	  (
	    [id] => 74
	    [name] => Social: Digg
	    [link] => http://mysite.com/em/index.php?action=social&c=cmpgnhash.currentmesg&ref=digg
	    [a_unique] => 0
	    [a_total] => 0
	    [info] => Array
	      (
	      )
	  )

	[4] => Array
	  (
	    [id] => 75
	    [name] => Social: del.icio.us
	    [link] => http://mysite.com/em/index.php?action=social&c=cmpgnhash.currentmesg&ref=delicious
	    [a_unique] => 0
	    [a_total] => 0
	    [info] => Array
	      (
	      )
	  )

	[5] => Array
	  (
	    [id] => 76
	    [name] => Social: buzz
	    [link] => http://mysite.com/em/index.php?action=social&c=cmpgnhash.currentmesg&ref=greader
	    [a_unique] => 0
	    [a_total] => 0
	    [info] => Array
	      (
	      )
	  )

	[6] => Array
	  (
	    [id] => 77
	    [name] => Social: Reddit
	    [link] => http://mysite.com/em/index.php?action=social&c=cmpgnhash.currentmesg&ref=reddit
	    [a_unique] => 0
	    [a_total] => 0
	    [info] => Array
        (
        )
	  )

	[7] => Array
    (
	    [id] => 78
	    [name] => Social: StumbleUpon
	    [link] => http://mysite.com/em/index.php?action=social&c=cmpgnhash.currentmesg&referral=stumbleupon
	    [a_unique] => 0
	    [a_total] => 0
	    [info] => Array
	      (
	      )
    )

	[8] => Array
	  (
	    [id] => 79
	    [name] => Forward to a Friend Link
	    [link] => http://mysite.com/em/p_f.php
	    [a_unique] => 1
	    [a_total] => 1
	    [info] => Array
	      (
	        [0] => Array
            (
              [email] => test@gmail.com
              [subscriberid] => 2
              [tstamp] => 2011-03-07 11:42:24
              [times] => 1
            )
	      )
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
	'api_action'   => 'campaign_report_link_list',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// ID you wish to fetch
	'campaignid'          => '137',
	'messageid'           => '4',
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