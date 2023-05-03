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

if (!$_POST)  { echo ('<h1>Go to submission form</h1><p>To submit a policy, <a href="https://www.w3.org/WAI/policies/submission/">return to the submission form</a>.</p>'); } else {
if (trim($_POST['comment'])) { die("This may be spam."); } // If someone enters text into the honeypot, stop form submission

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);

$country = mb_convert_case(htmlspecialchars($_POST['country']), MB_CASE_TITLE, 'UTF-8');
$state_province = htmlspecialchars($_POST['state-province']);
$date = date("Y-m-d");

$native_country = "";
if($_POST['native-country']) {
  $native_country = "# Additional country names will need to be added manually. Use the format: <code>: <name>\n  # " . htmlspecialchars($_POST['native-country']);
}


$policy_name = htmlspecialchars($_POST['policyname']);
$policy_url = htmlspecialchars($_POST['policyurl']);
$policy_enactdate = htmlspecialchars($_POST['enactdate']);
$type = htmlspecialchars(rtrim(implode(', ', $_POST['policytype']), ', '));
$guideline = htmlspecialchars(rtrim(implode(', ', $_POST['guideline']), ', '));

$webonly = htmlspecialchars($_POST['web-only']);
$scope = rtrim(implode(', ', htmlspecialchars($_POST['scope[]'])), ', ');

// entities
$entities     = "";
$has_entities = false;
if(!empty($_POST['entity_name'])) {
  foreach ($_POST['entity_name'] as $key => $value) {
    if($_POST['entity_name'][$key]) {
      $has_entities = true;
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
  }
  if($has_entities) {
    $entities = "ministries:" . $entities;
  }
}

// standards
$standards     = "";
$has_standards = false;
if(!empty($_POST['standard_name'])) {
  foreach ($_POST['standard_name'] as $key => $value) {
    if($_POST['standard_name'][$key]) {
      $has_standards = true;
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
  }
  if($has_standards) {
    $standards = "standard:" . $standards;
  }
}

// documents
$documents     = "";
$has_documents = false;
if(!empty($_POST['document_name'])) {
  foreach ($_POST['document_name'] as $key => $value) {
    if($_POST['document_name'][$key]) {
      $has_documents = true;
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
  }
  if($has_documents) {
    $documents = "documents:" . $documents;
  }
}

// Determine the order of the entry in the side navigation
$order = hexdec(bin2hex(strtolower(substr(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE',$country), 0, 3))));

$template = <<<EOF
---
lang: en
order: $order
title: "$country"
country:
  en: "$country"
  $native_country
updated: $date
updatemsg:
province: $state_province
policies:
  - title:
      en: "$policy_name"
    url:
      en: $policy_url
    updated: $policy_enactdate
    wcagver: $guideline
    enactdate: $policy_enactdate
    type: $type
    $entities
    webonly: $webonly
    scope: $scope
    $standards
    $documents
---
EOF;
$template = preg_replace('/^\h*\v+/m', '', $template);

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
  <p><strong>Content last updated:</strong> 2023<br />
    Editors: Vera Lange (HAN University), Michel Hansma (HAN University) and Eric Velleman (HAN University). Staff support: Kevin White (W3C).<br />
    Previous editors: Mary Jo Mueller (IBM) and Robert Jolly (Knowbility). Staff support: Eric Eggert (W3C/Knowbility).<br />
    Previous editors: Judy Brewer (W3C) and Shawn Lawton Henry (W3C). Developed with the Education and Outreach Working
    Group (<a href="https://www.w3.org/WAI/EO/">EOWG</a>).</p>
  <div class="footer-nav"><p>[<a href="#disclaimer-this-is-not-legal-advice">Disclaimer</a>] [<a href="https://www.w3.org/WAI/sitemap.html">WAI Site Map</a>] [<a href="https://www.w3.org/WAI/sitehelp.html">Help with WAI Website</a>] [<a href="https://www.w3.org/WAI/search.php">Search</a>] [<a href="https://www.w3.org/WAI/contacts">Contacting WAI</a>]<br />
         <strong>Feedback welcome to <a href="mailto:wai-eo-editors@w3.org">wai-eo-editors@w3.org</a></strong> (a publicly archived list) or <a href="mailto:wai@w3.org">wai@w3.org</a> (a WAI staff-only list).</p></div><div class="copyright">
            <p>Copyright © 2023 World Wide Web Consortium (<a href="https://www.w3.org/">W3C</a><sup>®</sup>). See <a href="/WAI/about/using-wai-material/">Permission to Use WAI Material</a>.</p>
         </div>
<!-- end footer --></div>
<?php wai_analytics(); ?>
</body>
</html>
