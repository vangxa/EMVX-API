<?php
/**
Title: View a specific subscription form.

Description: View just a single subscription form details and settings, including the HTML. This is useful for dynamically displaying subscription forms on your site.

Supported formats: xml, json, serialize

Supported request methods: GET

Requires authentication: true

Parameters (* denotes requirement):
{
	[*api_user] => An "Admin" Group username
	[*api_pass] => The corresponding password for the "Admin" Group username
	[*api_action] => form_view
	[*api_output] => xml, json, or serialize
	[*id] => ID of the subscription form you wish to fetch. Example: 1000
	[*generate] => Whether or not to show the subscription form HTML in the result. Examples: 1 = yes, 0 = no
}

Example response:
{
  [id] => ID of the subscription form. Example: 1004
  [name] => Internal name of the subscription form. Example: Form Name
  [type] => Type of subscription form. Examples: 'both', 'subscribe', 'unsubscribe'
  [charset] => Character set of the subscription form.
  [sub1_type] => Successful Subscription action - what happens when someone successfully subscribes using this form? Examples: 'custom', 'redirect', 'default'
  [sub1_value] => Value for sub1_type
  [sub2_type] => Awaiting Confirmation (Subscribe) - what happens if they are awaiting confirmation? Examples: default, custom, redirect
  [sub2_value] => Value for sub2_type
  [sub3_type] => Confirmed Subscription - what happens if they are confirmed? Examples: default, custom, redirect
  [sub3_value] => Value for sub3_type
  [sub4_type] => Subscription Error - what happens if there is an error? Examples: default, custom, redirect
  [sub4_value] => Value for sub4_type
  [unsub1_type] => Successful UnSubscription - what happens when someone successfully UNsubscribes using this form? Examples: default, custom, redirect
  [unsub1_value] => Value for unsub1_type
  [unsub2_type] => Awaiting Confirmation (Unsubscribe) - what happens if they are awaiting confirmation? Examples: default, custom, redirect
  [unsub2_value] => Value for unsub2_type
  [unsub3_type] => Confirmed UnSubscription - what happens if they confirmed their unsubscription? Examples: default, custom, redirect
  [unsub3_value] => Value for unsub3_type
  [unsub4_type] => UnSubscription Error - what happens if there is an error? Examples: default, custom, redirect
  [unsub4_value] => Value for unsub4_type
  [up1_type] => Request to update subscription details. Examples: default, custom, redirect
  [up1_value] => Value for up1_type
  [up2_type] => Updated subscription details. Examples: default, custom, redirect
  [up2_value] => Value for up2_type
  [allowselection] => List Options. Examples: 1 or 0. "Allow user to select lists they wish to subscribe or unsubscribe from" (1) or "Force user to subscribe to or unsubscribe from all lists selected above" (0)
  [emailconfirmations] => Opt-In/Out Confirmation. Examples: 1 or 0. "Send individual email confirmations for each list" (1) or "Send a single email confirmation for all lists" (0).
  [ask4fname] => First Name. Examples: required (1) or not required (0)
  [ask4lname] => Last Name. Examples: required (1) or not required (0)
	[fields] => Array

  [optinoptout] => ID of Opt-In/Out set. Example: 1. Opt-In/Out confirmation set (if "Send a single email confirmation for all lists" is chosen for 'emailconfirmations' field above). This field is ignored if "Send individual email confirmations for each list" is chosen for 'emailconfirmations' field above.
  [captcha] => Require Captcha image? Examples: yes (1) or no (0)
	[lists] => Array

	[require_name] => Whether or not to require name.
	[listslist] => Array
	[fieldslist] => Array
	[fieldsarray] => Array

	[html] => <form method="post" action="http://mysite.com/em/branches/5.2.4/box.php">

	<table>
	<tr>
	<td>Email:</td>
	<td><input name="email" value="" type="text" /></td>
	</tr>


	<tr>
	<td>First Name:</td>
	<td><input name="first_name" value="" type="text" /></td>
	</tr>

	<tr>
	<td>Last Name:</td>
	<td><input name="last_name" value="" type="text" /></td>
	</tr>




			<tr>
	<td>Test Date</td>
	<td><input id='datecfield1' type='text' name='field[1,0]' value='2011-03-09' />
	<style type='text/css'>@import url(http://mysite.com/em/branches/5.2.4/ac_global/jscalendar/calendar-win2k-1.css);</style>
	<script type='text/javascript' src='http://mysite.com/em/branches/5.2.4/ac_global/jscalendar/calendar.js'></script>
	<script type='text/javascript' src='http://mysite.com/em/branches/5.2.4/ac_global/jscalendar/lang/calendar-en.js'></script>
	<script type='text/javascript' src='http://mysite.com/em/branches/5.2.4/ac_global/jscalendar/calendar-setup.js'></script>
	<a href='#' onclick='return false;' id='datecbutton1'><img src='http://mysite.com/em/branches/5.2.4/ac_global/media/calendar.png' border='0' /></a><script type='text/javascript'>Calendar.setup({inputField: 'datecfield1', ifFormat: '%Y-%m-%d', button: 'datecbutton1', showsTime: false, timeFormat: '24'});</script></td>
	</tr>




	<tr>
	<td valign="top">Verify</td>
	<td>
		<img border="1" align="middle" src="http://mysite.com/em/branches/5.2.4/ac_global/scripts/randomimage.php" /><br />
		<input type="text" name="imgverify" id="imgverify" />
		<div style="font-size:10px; color:#999999;">Enter the text as it appears on the image</div>
	</td>
	</tr>




	<tr>
	<td> </td>
	<td>
		<label><input type="radio" name="funcml" value="add" checked="checked" />Subscribe</label><br />
		<label><input type="radio" name="funcml" value="unsub2" />Unsubscribe</label>
	</td>
	</tr>
	<tr>
	<td> </td>
	<td>
	<input type="hidden" name="p" value="1005" />
	<input type="hidden" name="_charset" value="utf-8" />
	<input type="submit" value="Submit" />

	<div style="font-size:10px; margin-top:10px; color:#999999;"><a href="http://www.activecampaign.com/email-marketing/" title="email marketing" style="color:#666666;">Email Marketing</a> by ActiveCampaign</div>
	</td>
	</tr>
	</table>

	</form>
	[htmllink] => http://mysite.com/em/branches/5.2.4/index.php?action=form&type=html&id=1005
	[xml] => <flashform postForm="http://mysite.com/em/branches/5.2.4/box.php" stagecolor="0xFFFFFF">
	<subfield type="text" name="email" value="test@example.com" display="Email:" xpos="100" ypos="20" width="130" height="20" fontsize="12" fontfamily="Arial" fontcolor="0x000000" color="0x000000"></subfield>
	<subfield type="text" name="name" value="Your Name Here" display="Name:" required="no" xpos="100" ypos="50" width="130" height="20" fontsize="12" fontfamily="Arial" fontcolor="0x000000" color="0x000000"></subfield>
	<subfield type="text" name="name" value="Your Name Here" display="Name:" required="no" xpos="100" ypos="70" width="130" height="20" fontsize="12" fontfamily="Arial" fontcolor="0x000000" color="0x000000"></subfield>

	<subfield type="radio" name="funcml" value="add" checked="true" display="Subscribe" title="" xpos="40" ypos="140" fontsize="12" fontfamily="Arial" fontcolor="0x000000" color="0x000000"></subfield>
	<subfield type="radio" name="funcml" value="unsub2" checked="" display="Unsubscribe" title="" xpos="40" ypos="160" fontsize="12" fontfamily="Arial" fontcolor="0x000000" color="0x000000"></subfield>
	<subfield type="hidden" name="p" value="1005"></subfield>
	<subfield type="submit" name="submit" value="submit" display="Submit" xpos="40" ypos="200" height="10" fontsize="12" fontfamily="Arial" fontcolor="0x000000" buttonheight="20.8" buttonwidth="100" color="0x000000"></subfield>
	</flashform>
	[xmllink] => http://mysite.com/em/branches/5.2.4/index.php?action=form&type=xml&id=1005
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

	// this is the action that fetches subscription form info based on the ID you provide
	'api_action'   => 'form_view',

	// define the type of output you wish to get back
	// possible values:
	// - 'xml'  :      you have to write your own XML parser
	// - 'json' :      data is returned in JSON format and can be decoded with
	//                 json_decode() function (included in PHP since 5.2.0)
	// - 'serialize' : data is returned in a serialized format and can be decoded with
	//                 a native unserialize() function
	'api_output'   => 'serialize',

	// ID of the subscription form you wish to fetch
	'id'           => 1000,

	// Flag to show the subscription form HTML in the result
	'generate'     => 1,
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