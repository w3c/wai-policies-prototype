<?php
  include '/afs/w3.org/pub/WWW/WAI/lib/functions.php';

  $customcss = <<<EOF
EOF;

  $config = [
    "title" => "Submit a Policy",
    "hmenu" => false,
    "excol" => false,
    "customcss" => $customcss
  ];
  wai_html_head($config);
?>
<?php wai_header($config); ?>
<?php wai_menu(); ?>
<div id="main">
  <div id="skipwrapper"> <a id="skip">-</a></div>
<?php

$github_token = "@@@@@@@"; // Do not check token into the repository

if (!$_POST)  { echo ('<h1>Go to submission form</h1><p>To submit a policy, <a href="https://w3c.github.io/wai-policies-prototype/submission.html">return to the submission form</a>.</p>'); } else {
if (trim($_POST['comment'])) { die("This may be spam."); } // If someone enters text into the honeypot, stop form submission

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
//var_dump($_POST);

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
$lang = htmlspecialchars($_POST['entity_lang'][$key]);
$entities .= <<<ENTITIES
\n      - title:
          $lang: "$title"
        url:
          $lang: "$url"
ENTITIES;
}

// standards

$standards = "";
foreach ($_POST['standard_name'] as $key => $value) {
$title = htmlspecialchars($_POST['standard_name'][$key]);
$desc = htmlspecialchars($_POST['standard_desc'][$key]);
$url = htmlspecialchars($_POST['standard_url'][$key]);
$lang = htmlspecialchars($_POST['standard_lang'][$key]);
$standards .= <<<STANDARDS
\n      - title:
          $lang: "$title"
        desc: "$desc"
        url:
          $lang: "$url"
STANDARDS;
}

// documents

$documents = "";
foreach ($_POST['document_name'] as $key => $value) {
$title = htmlspecialchars($_POST['document_name'][$key]);
$desc = htmlspecialchars($_POST['document_desc'][$key]);
$url = htmlspecialchars($_POST['document_url'][$key]);
$lang = htmlspecialchars($_POST['document_lang'][$key]);
$documents .= <<<DOCUMENTS
\n      - title:
          $lang: "$title"
        desc: "$desc"
        url:
          $lang: "$url"
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

// echo $template;

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

Submitted by [$name](mailto:$email):

$comment

~~~yaml
$template
~~~

BODY;

//echo $issue_body;

$ch = curl_init();

$data = json_encode(array('title' => $issue_title, 'body' => $issue_body));

curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/w3c/wai-policies-prototype/issues?access_token='.$github_token);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_USERAGENT, "W3C/POLICIES FORM");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$return = json_decode(curl_exec($ch));

?>

<h1>Thanks for your submission.</h1>

<p>Your suggestion was successfully submitted. You can track it in <a href="<?php echo $return->html_url ?>">issue number #<?php echo $return->number ?> on GitHub.</a></p>

<p>If you want to submit another policy, <a href="http://w3c.github.io/wai-policies-prototype/submission.html">return to the submission form</a>.</p>

<?php } ?>
</div>
<div id="footer">
  <h2>Document Information</h2>
  <p><strong>Content last updated:</strong> 2017<br />
    Editors: Mary Jo Mueller (IBM) and Robert Jolly (Knowbility). Staff support: Eric Eggert (W3C/Knowbility).<br />
    Previous editors: Judy Brewer (W3C) and Shawn Lawton Henry (W3C). Developed with the Education and Outreach Working
    Group (<a href="https://www.w3.org/WAI/EO/">EOWG</a>).</p>
  <div class="footer-nav"><p>[<a href="#disclaimer-this-is-not-legal-advice">Disclaimer</a>] [<a href="https://www.w3.org/WAI/sitemap.html">WAI Site Map</a>] [<a href="https://www.w3.org/WAI/sitehelp.html">Help with WAI Website</a>] [<a href="https://www.w3.org/WAI/search.php">Search</a>] [<a href="https://www.w3.org/WAI/contacts">Contacting WAI</a>]<br />
         <strong>Feedback welcome to <a href="mailto:wai-eo-editors@w3.org">wai-eo-editors@w3.org</a></strong> (a publicly archived list) or <a href="mailto:wai@w3.org">wai@w3.org</a> (a WAI staff-only list).</p></div><div class="copyright">
            <p><a rel="Copyright" href="https://www.w3.org/Consortium/Legal/ipr-notice#Copyright">Copyright</a> © 1994-2017 <a href="https://www.w3.org/"><abbr title="World Wide Web Consortium">W3C</abbr></a><sup>®</sup> (<a href="http://www.csail.mit.edu/"><abbr title="Massachusetts Institute of Technology">MIT</abbr></a>, <a href="http://www.ercim.org/"><abbr title="European Research Consortium for Informatics and Mathematics">ERCIM</abbr></a>, <a href="http://www.keio.ac.jp/">Keio</a>), All Rights Reserved. W3C <a href="https://www.w3.org/Consortium/Legal/ipr-notice#Legal_Disclaimer">liability</a>, <a href="https://www.w3.org/Consortium/Legal/ipr-notice#W3C_Trademarks">trademark</a>, <a rel="Copyright" href="https://www.w3.org/Consortium/Legal/copyright-documents">document use</a> and <a rel="Copyright" href="https://www.w3.org/Consortium/Legal/copyright-software">software
         licensing</a> rules apply. Your interactions with this site are in
         accordance with our <a href="https://www.w3.org/Consortium/Legal/privacy-statement#Public">public</a> and <a href="https://www.w3.org/Consortium/Legal/privacy-statement#Members">Member</a> privacy
         statements.</p>
         </div>
<!-- end footer --></div>
<?php wai_analytics(); ?>
</body>
</html>
