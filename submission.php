<?php

$github_token = "@@@@@@@"; // Do not check token into the repository

if (!$_POST)  { die('<p>To submit a policy, <a href="https://w3c.github.io/wai-policies-prototype/submission.html">return to the submission form</a>.</p>'); }
if (trim($_POST['comment'])) { die("This may be spam."); } // If someone enters text into the honeypot, stop form submission

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
var_dump($_POST);

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);

$country = htmlspecialchars($_POST['country']);
$native_country = htmlspecialchars($_POST['native_country']);
$state_province = htmlspecialchars($_POST['state_province']);
$date = date("Y-m-d");

$policy_name = htmlspecialchars($_POST['policyname']);
$policy_url = htmlspecialchars($_POST['policyurl']);
$policy_enactdate = htmlspecialchars($_POST['enactdate']);
$type = htmlspecialchars(implode(', ', $_POST['policytype']));
$guideline = htmlspecialchars(implode(', ', $_POST['guideline']));

$webonly = htmlspecialchars($_POST['web-only']);
$scope = implode(', ', htmlspecialchars($_POST['scope']));

// entities

$entities = "";
foreach ($_POST['entity_name'] as $key => $value) {
$title = htmlspecialchars($_POST['entity_name'][$key]);
$url = htmlspecialchars($_POST['entity_url'][$key]);
$entities .= <<<ENTITIES
\n      - title: "$title"
        url: "$url"
ENTITIES;
}

// standards

$standards = "";
foreach ($_POST['standard_name'] as $key => $value) {
$title = htmlspecialchars($_POST['standard_name'][$key]);
$desc = htmlspecialchars($_POST['standard_desc'][$key]);
$url = htmlspecialchars($_POST['standard_url'][$key]);
$standards .= <<<STANDARDS
\n      - title: "$title"
        desc: "$desc"
        url: "$url"
STANDARDS;
}

// documents

$documents = "";
foreach ($_POST['document_name'] as $key => $value) {
$title = htmlspecialchars($_POST['document_name'][$key]);
$desc = htmlspecialchars($_POST['document_desc'][$key]);
$url = htmlspecialchars($_POST['document_url'][$key]);
$documents .= <<<DOCUMENTS
\n      - title: "$title"
        desc: "$desc"
        url: "$url"
DOCUMENTS;
}

$template = <<<EOF
---
country:
  en: $country
  # Manual enter other country names: $native_country
updated: $date
updatemsg:
# Related page:
province: $state_province
policies:
  - title:
      en: $policy_name
    url: $policy_url
    updated: $policy_enactdate
    wcagver: $guideline
    enactdate: $policy_enactdate
    type: $type
    ministries:$entities
    webonly: $webonly
    scope: $scope
    standard:$standards
    documents:$documents
---
EOF;

echo $template;

if ($_POST['submission'] == 'new policy') {
	$issue_title = 'New Entry for '.$country;
} else {
	$issue_title = 'Update for '.$country;
}

if ($_POST['cmnt'] == '') {
	$comment = '';
} else {
	$comment = preg_replace('/^/m', "> ", htmlspecialchars($_POST['cmnt']));
}

$issue_body = <<<BODY
$issue_title

Submitted by [$name]($email):

$comment

~~~yaml
$template
~~~

BODY;

echo $issue_body;

$ch = curl_init();

$data = json_encode(array('title' => $issue_title, 'body' => $issue_body));

curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/w3c/wai-policies-prototype/issues?access_token='.$github_token);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_USERAGENT, "W3C/POLICIES FORM");

$return = json_decode(curl_exec($ch));

?>

<p>Your suggestion was successfully submitted. You can track it in <a href="<?php echo $return['html_url'] ?>">issue number #<?php echo $return['number'] ?> on GitHub.</a></p>

<p>If you want to submit another policy, <a href="http://w3c.github.io/wai-policies-prototype/submission.html">return to the submission form</a>.</p>
