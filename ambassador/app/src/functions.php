<?php
function redirect_to_url($url, $permanent = false)
{
	header('Location: ' . $url, true, $permanent ? 301 : 302);
	
	exit();
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function buildAdminMessageBodyFromPost($post){
	$messageBody = '';
	
	$messageBody .= '<h1> About You </h1>
<table>';
	if(isset($post['first_name']) && $post['first_name'] != '') {
		$messageBody .= '<tr>
	<td>First Name:</td>
	<td>'.$post['first_name'].'</td>
</tr>';
	}
	if(isset($post['last_name']) && $post['last_name'] != '') {
		$messageBody .= '<tr>
	<td>Last Name:</td>
	<td>'.$post['last_name'].'</td>
</tr>';
	}
	if(isset($post['day']) && $post['day'] != '') {
		$messageBody .= '<tr>
	<td>Birthdate:</td>
	<td>'.$post['month'].'/'.$post['day'].'/'.$post['year'].'</td>
</tr>';
	}
	if(isset($post['telephone_1']) && $post['telephone_1'] != '') {
		$messageBody .= '<tr>
	<td>Phone Number:</td>
	<td>'.$post['telephone_1'].'</td>
</tr>';
	}
	if(isset($post['email']) && $post['email'] != '') {
		$messageBody .= '<tr>
	<td>Email:</td>
	<td>'.$post['email'].'</td>
</tr>';
	}
	if(isset($post['address1']) && $post['address1'] != '') {
		$messageBody .= '<tr>
	<td>Address:</td>
	<td>'.$post['address1'].'</td>
</tr>';
	}
	if(isset($post['city']) && $post['city'] != '') {
		$messageBody .= '<tr>
	<td>City:</td>
	<td>'.$post['city'].'</td>
</tr>';
	}
	if(isset($post['state']) && $post['state'] != '') {
		$messageBody .= '<tr>
	<td>State:</td>
	<td>'.$post['state'].'</td>
</tr>';
	}
	if(isset($post['zip']) && $post['zip'] != '') {
		$messageBody .= '<tr>
	<td>Zip:</td>
	<td>'.$post['zip'].'</td>
</tr>';
	}
	if(isset($post['diagnosed']) && $post['diagnosed'] != '') {
		$messageBody .= '<tr>
	<td>Have you been diagnosed with Lyme and/or other tick-borne disease? :</td>
	<td>'.$post['diagnosed'].'</td>
	</tr>';
	}
	if(isset($post['friend_diagnosed']) && $post['friend_diagnosed'] != '') {
		$messageBody .= '<tr>
	<td>Has a family member or close friend been diagnosed with Lyme and/or other tick-borne disease? :</td>
	<td>'.$post['friend_diagnosed'].'</td>
	</tr>';
	}
	if(isset($post['why_inter_edu_amb']) && $post['why_inter_edu_amb'] != '') {
		$messageBody .= '<tr>
	<td>Why are you interested in becoming a Lyme Education Ambassador?:</td>
	<td>'.$post['why_inter_edu_amb'].'</td>
	</tr>';
	}
	if(isset($post['how_far']) && $post['how_far'] != '') {
		$messageBody .= '<tr>
	<td>How far are you willing to travel to do a presentation or other volunteer opportunity?:</td>
	<td>'.$post['how_far'].'</td>
	</tr>';
	}
	if(isset($post['lang1']) && $post['lang1'] != '') {
		$messageBody .= '<tr>
	<td>Do you speak another language fluently?:</td>
	<td>'.$post['lang1'].'</td>
	</tr>';
	}
	if(isset($post['language_1']) && $post['language_1'] != '') {
		$messageBody .= '<tr>
	<td>If yes, what language?:</td>
	<td>'.$post['language_1'].'</td>
	</tr>';
	}
	if( (isset($post['check01']) && $post['check01'] != '') || ( isset($post['check02'])  && $post['check02'] != '') || ( isset($post['check03'])  && $post['check03'] != '') || ( isset($post['check04'])  && $post['check04'] != '') ) {
		$messageBody .= '<tr>
	<td>Check any of the following areas that you would also like to help with:</td>
	<td>';
		if(isset($post['check01'])) { $messageBody .= 'Endurance events<br>'; }
		if(isset($post['check02'])) { $messageBody .= 'Grassroot event<br>'; }
		if(isset($post['check03'])) { $messageBody .= 'Local community events (health fairs, etc.)<br>'; }
		if(isset($post['check04'])) { $messageBody .= 'School presentations<br>'; }
		if(isset($post['check05']) && $post['check05'] != '') {
			$messageBody .= 'Others: '.$post['check05'];
		}
		$messageBody .= '</td>
</tr>';
	}
	if(isset($post['how_did']) && $post['how_did'] != '') {
		$messageBody .= '<tr>
	<td>How did you hear about Global Lyme Alliance? :</td>
	<td>';
		if($post['how_did'] == 'opt1') { $messageBody .= 'Family member or Friend<br>'; }
		if($post['how_did'] == 'opt2') { $messageBody .= 'Online (article/other website)<br>'; }
		if($post['how_did'] == 'opt3') { $messageBody .= 'Social media (Facebook, Twitter, Instagram, etc.)<br>'; }
		if($post['how_did'] == 'opt4') { $messageBody .= 'Doctor/other medical professional recommendation<br>'; }
		if($post['how_did'] == 'opt5') { $messageBody .= 'The Mighty blog<br>'; }
		if($post['how_did'] == 'opt6') { $messageBody .= 'Google/Search Engine<br>'; }
		if($post['how_did'] == 'opt7') { $messageBody .= 'Another non-profit<br>'; }
		if($post['how_did'] == 'opt8') { $messageBody .= 'Newspaper/Magazine<br>'; }
		if($post['how_did'] == 'opt9') { $messageBody .= 'Health Conference/Expo<br>'; }
		if($post['how_did'] == 'opt10') { $messageBody .= 'Other'; }
		$messageBody .= '</td>
</tr>';
	}
	$messageBody .= '</table>
<h1> Professional and Personal Achievements </h1>
<table>';
	
	if(isset($post['education']) && $post['education'] != '') {
		$messageBody .= '<tr>
	<td>Education :</td>
	<td>';
		if($post['education'] == 'opt1') { $messageBody .= 'High School/GED<br>'; }
		if($post['education'] == 'opt2') { $messageBody .= 'Some College<br>'; }
		if($post['education'] == 'opt3') { $messageBody .= 'Associate Degree<br>'; }
		if($post['education'] == 'opt4') { $messageBody .= 'Bachelor Degree<br>'; }
		if($post['education'] == 'opt5') { $messageBody .= 'Graduate Degree<br>'; }
		if($post['education'] == 'opt6') { $messageBody .= 'Doctorate<br>'; }
		if($post['education'] == 'opt7') { $messageBody .= 'Other'; }
		$messageBody .= '</td>
</tr>';
	}
	if(isset($post['current_occupation_1']) && $post['current_occupation_1'] != '') {
		$messageBody .= '<tr>
	<td>Current occupation:</td>
	<td>'.$post['current_occupation_1'].'</td>
</tr>';
	}
	if(isset($post['office_skills']) && $post['office_skills'] != '') {
		$messageBody .= '<tr>
	<td>Office skills?:</td>
	<td>'.$post['office_skills'].'</td>
</tr>';
	}
	if(isset($post['please_list_community']) && $post['please_list_community'] != '') {
		$messageBody .= '<tr>
	<td width="60%">Please list community, civic, professional, political, business, cultural, religious, athletic, social or other organizations you are volunteering or have volunteered your time for which you have not received monetary compensation. Indicate your role and length of time for each.:</td>
	<td>'.$post['please_list_community'].'</td>
</tr>';
	}
$messageBody .= '</table>
<h1> Your Role as An Education Ambassador </h1>
<table>';

if(isset($post['why_gla_edu_amb']) && $post['why_gla_edu_amb'] != '') {
	$messageBody .= '<tr>
	<td>Why do you want to be a GLA Education Ambassador?:</td>
	<td>'.$post['why_gla_edu_amb'].'</td>
</tr>';
}
if(isset($post['speaking_publicly']) && $post['speaking_publicly'] != '') {
	$messageBody .= '<tr>
	<td>Please describe your comfort level speaking publicly:</td>
	<td>';
	if($post['speaking_publicly'] == 'opt1') { $messageBody .= 'Very comfortable<br>'; }
	if($post['speaking_publicly'] == 'opt2') { $messageBody .= 'Somewhat comfortable<br>'; }
	if($post['speaking_publicly'] == 'opt3') { $messageBody .= 'Comfortable<br>'; }
	if($post['speaking_publicly'] == 'opt4') { $messageBody .= 'Somewhat uncomfortable<br>'; }
	if($post['speaking_publicly'] == 'opt5') { $messageBody .= 'Uncomfortable<br>'; }
	if($post['speaking_publicly'] == 'opt6') { $messageBody .= 'Not sure<br>'; }
	$messageBody .= '</td>
</tr>';
}
if(isset($post['msg2']) && $post['msg2'] != '') {
	$messageBody .= '<tr>
	<td>Why do you think you would be a good Ambassador?:</td>
	<td>'.$post['msg2'].'</td>
</tr>';
}
if(isset($post['anything_else']) && $post['anything_else'] != '' ) {
	$messageBody .= '<tr>
	<td>Anything else that you would like us to know about you?:</td>
	<td>'.$post['anything_else'].'</td>
</tr>';
}
$messageBody .= '</table>';
$messageBody .= '<h2> Reference #1: </h2>';
$messageBody .= '<table>';
if(isset($post['ref1_full_name']) && $post['ref1_full_name'] != '') {
$messageBody .= '<tr>
	<td>Full Name:</td>
	<td>'.$post['ref1_full_name'].'</td>
</tr>';
}
if(isset($post['ref1_relationship']) && $post['ref1_relationship'] != '') {
$messageBody .= '<tr>
	<td>Relationship:</td>
	<td>'.$post['ref1_relationship'].'</td>
</tr>';
}
if(isset($post['ref1_occupation']) && $post['ref1_occupation'] != '') {
$messageBody .= '<tr>
	<td>Occupation:</td>
	<td>'.$post['ref1_occupation'].'</td>
</tr>';
}
if(isset($post['ref1_telephone']) && $post['ref1_telephone'] != '') {
$messageBody .= '<tr>
	<td>Telephone:</td>
	<td>'.$post['ref1_telephone'].'</td>
</tr>';
}
if(isset($post['ref1_email']) && $post['ref1_email'] != '') {
$messageBody .= '<tr>
	<td>Email:</td>
	<td>'.$post['ref1_email'].'</td>
</tr>';
}
$messageBody .= '</table>
<h2> Reference #2: </h2>
<table>';
if(isset($post['ref2_full_name']) && $post['ref2_full_name'] != '') {
$messageBody .= '<tr>
	<td>Full Name:</td>
	<td>'.$post['ref2_full_name'].'</td>
</tr>';
}
if(isset($post['ref2_relationship']) && $post['ref2_relationship'] != '') {
$messageBody .= '<tr>
	<td>Relationship:</td>
	<td>'.$post['ref2_relationship'].'</td>
</tr>';
}
if(isset($post['ref2_occupation']) && $post['ref2_occupation'] != '') {
$messageBody .= '<tr>
	<td>Occupation:</td>
	<td>'.$post['ref2_occupation'].'</td>
</tr>';
}
if(isset($post['ref2_telephone']) && $post['ref2_telephone'] != '') {
$messageBody .= '<tr>
	<td>Telephone:</td>
	<td>'.$post['ref2_telephone'].'</td>
</tr>';
}
if(isset($post['ref2_email']) && $post['ref2_email'] != '') {
$messageBody .= '<tr>
	<td>Email:</td>
	<td>'.$post['ref2_email'].'</td>
</tr>';
}

if( (isset($post['ref3_full_name']) && $post['ref3_full_name'] != '') || (isset($post['ref3_relationship']) && $post['ref3_relationship'] != '') || (isset($post['ref3_occupation']) && $post['ref3_occupation'] != '') || (isset($post['ref3_telephone']) && $post['ref3_telephone'] != '') || (isset($post['ref3_email']) && $post['ref3_email'] != '') ) {

$messageBody .= '</table>
<h2> Reference #3: </h2>
<table>';
if(isset($post['ref3_full_name']) && $post['ref3_full_name'] != '') {
$messageBody .= '<tr>
	<td>Full Name:</td>
	<td>'.$post['ref3_full_name'].'</td>
</tr>';
}
if(isset($post['ref3_relationship']) && $post['ref3_relationship'] != '') {
$messageBody .= '<tr>
	<td>Relationship:</td>
	<td>'.$post['ref3_relationship'].'</td>
</tr>';
}
if(isset($post['ref3_occupation']) && $post['ref3_occupation'] != '') {
$messageBody .= '<tr>
	<td>Occupation:</td>
	<td>'.$post['ref3_occupation'].'</td>
</tr>';
}
if(isset($post['ref3_telephone']) && $post['ref3_telephone'] != '') {
$messageBody .= '<tr>
	<td>Telephone:</td>
	<td>'.$post['ref3_telephone'].'</td>
</tr>';
}
if(isset($post['ref3_email']) && $post['ref3_email'] != '') {
$messageBody .= '<tr>
	<td>Email:</td>
	<td>'.$post['ref3_email'].'</td>
</tr>';
}
$messageBody .= '</table>';

}

	return $messageBody;
}

function buildUserMessageBodyFromPost($post){
	$messageBody = '';
	
	$messageBody .= '<table>
					  <tr>
						<td>Dear '.$post['first_name'].',</td>
					  </tr>
					  <tr>
						<td></td>
					  </tr>
					  <tr>
						<td>Thank you for applying to join the Global Lyme Alliance Lyme Education Ambassador Program - LEAP.  This program will be launched nationwide to educate and prevent the increase of Lyme and other tick-borne diseases.  A GLA staff member will follow up with you in the next two weeks. We appreciate your interest and look forward to speaking with you soon.</td>
					  </tr>
					  <tr>
						<td></td>
					  </tr>
					  <tr>
						<td>P.S. There are many ways to get involved to support GLA. <a href="https://globallymealliance.org/get-involved/" target="_blank">Learn How.</a></td>
					  </tr>
					  <tr>
						<td></td>
					  </tr>
					  <tr>
						<td>Best,</td>
					  </tr>
					  <tr>
						<td>Sara Tyghter</td>
					  </tr>
					  <tr>
						<td>Director, Education and Outreach</td>
					  </tr>
					  </table>';

	return $messageBody;
}
