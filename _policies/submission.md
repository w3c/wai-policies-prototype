---
layout: sidenav
title: Add or Update a Web Accessibility Law or Policy
nosidenav: true
---

<style>fieldset {margin-bottom: 1.5em}</style>


This form allows you to provide information about new or updated web
accessibility policies enacted by governments worldwide. We welcome any
additions or corrections to the policies list and detail pages.

**Note:** Information sent using this form is publicly available in
GitHub and/or e-mail archive, and will be reviewed before publishing in
the Laws and Policies page. It can take *up to 10 business days* until
the information is published.

Contact <wai-eo-editors@w3.org> (a publicly archived list) if you have
questions or comments.


<div id="hForm">
<form name="submission" id="submission" method="post" action="{% if jekyll.environment != "server" %}https://www.w3.org/2017/04/policies_submission/{% endif %}submission.php">
<p>* Indicates required field</p>
<fieldset>
  <legend><h3>Information about you</h3></legend>
  <div class="form-block-mini half">
    <p>Your contact information will be used to confirm your submission and to contact you in case we have questions regarding the submission.</p>
    <div class="form-row required"><label for="name">* Your Name: </label><br><span><input name="name" id="name" type="text" value="" required  aria-required="true"></span></div>
    <div class="form-row required"><label for="email">* Your E-Mail: </label><br><span><input name="email" id="email" type="email" value="" required aria-required="true"></span></div>
  </div>
</fieldset>

  <fieldset>
    <legend><h3>Add new or update existing Web accessibility policy</h3></legend>
    <div class="form-block-mini radio">
      <div class="form-row"><span><input type="radio" checked name="submission" id="new" value="new policy"></span> <label for="new">Add new policy</label></div>
      <div class="form-row"><span><input type="radio" name="submission" id="existing" value="existing policy"></span> <label for="existing">Update existing policy</label></div>
    </div>
  </fieldset>

  <fieldset>
    <legend><h3>Country information</h3></legend>
    <div class="form-block-mini half">
      <div class="form-row required"><label for="country">* Country of policy (in English): </label><br><span><input id="country" name="country" type="text" value="" required aria-required="true" ></span></div>
      <div class="form-row"><label for="native-country">Country of policy (in native language): </label><br><span><input name="native-country" id="native-country" type="text" value="" aria-describedby="native-countrydesc"><br><span id="native-countrydesc">If known by multiple names, separate with a semicolon, e.g. Schweiz;Suisse</span></span></div>
      <div class="form-row required"><label for="state-province">State or province (in English): </label><br><span><input id="state-province" name="state-province"></span></div>
    </div>
  </fieldset>

  <fieldset>
    <legend><h3>Policy information</h3></legend>

  <div class="form-block-mini">
    <div class="form-row required"><label for="policyname">* Policy name: </label><br><span><input name="policyname" id="policyname" type="text" value="" required aria-required="true"></span></div>
    <div class="form-row required"><label for="policyurl">* Web address (<abbr title="Universal Resource Identifier">URL</abbr>): </label><br><span><input name="policyurl" id="policyurl" type="url" value="" required aria-required="true"></span></div>
  </div>
  <div class="form-block-mini half">
    <div class="form-row required"><label for="enactdate">Enacted date (format: YYYY): </label><br><span><input name="enactdate" id="enactdate" type="text" value="" aria-describedby="enactdesc"><br><span id="enactdesc">Enter the year the policy was enacted or "Draft" if the policy is not yet finalized or enacted.</span></span></div>
  </div>
  <fieldset>
    <legend>Responsible Entities</legend>
    <p>List the governmental ministries, agencies, or departments that oversee or are related to this policy.</p>
    <ul class="multiple" id="entities-multiple">
      <li class="template">
        <div class="form-block-mini">
          <label class="form-row"><span class="l">Name:</span><span><input type="text" name="entity_name[]"></span></label>
          <label class="form-row"><span class="l">URL:</span> <span><input type="url" name="entity_url[]"></span></label>
          <label class="form-row"><span class="l">Language:</span> <span><select name="entity_lang[]">{% for l in site.data.lang%}<option value="{{l[0]}}"{% if l[0] == "en" %} selected{% endif %}>{{l[1].name}} ({{l[1].nativeName}})</option>{% endfor %}</select></span></label>
        </div>
        <div class="rem"><button type="button" class="remove btn-small">Remove</button></div>
      </li>
    </ul>
    <button type="button" class="multiple btn-small" data-for="entities-multiple">➕ Add Entity</button>
  </fieldset>

  <fieldset><legend><span>Type of policy</span></legend>
    <div class="form-block-mini radio">
      <div class="form-row"><span><input type="checkbox" name="policytype[]" id="policy-a11ylaw" aria-describedby="policy-a11ylaw-desc" value="law"></span> <div><label for="policy-a11ylaw">Accessibility law</label><div id="policy-a11ylaw-desc" class="desc"><small>A general accessibility law that has a broad scope of non-descrimination, accessible technology, employment and/or other topics.</small></div></div></div>
      <div class="form-row"><span><input type="checkbox" name="policytype[]" id="policy-ndlaw" aria-describedby="policy-ndlaw-desc" value="Non-discrimination law"></span> <div><label for="policy-ndlaw">Non-discrimination law</label><div id="policy-ndlaw-desc" class="desc"><small>A law intended to prevent unfair treatment of persons with disabilities.</small></div></div></div>
      <div class="form-row"><span><input type="checkbox" name="policytype[]" id="policy-proclaw" value="Procurement law"></span> <div><label for="policy-proclaw">Procurement law</label><div id="policy-proclaw-desc" class="desc"><small>A law that requires government purchase of accessible goods and services.</small></div></div></div>
      <div class="form-row"><span><input type="checkbox" name="policytype[]" id="policy-procrecomm" value="Procurement recommendation"></span> <div><label for="policy-procrecomm">Procurement recommendation</label><div id="policy-procrecomm-desc" class="desc"><small>An optional, but encouraged goal to purchase accessible goods and services.</small></div></div></div>
      <div class="form-row"><span><input type="checkbox" name="policytype[]" id="policy-mandpolicy" value="Mandatory policy"></span> <div><label for="policy-mandpolicy">Mandatory policy</label><div id="policy-mandpolicy-desc" class="desc"><small>Required accessibility goals or implementation that is not regulated by law.</small></div></div></div>
      <div class="form-row"><span><input type="checkbox" name="policytype[]" id="policy-recommendation" value="Recommended policy"></span> <div><label for="policy-recommendation">Recommended policy</label><div id="policy-recommendation-desc" class="desc"><small>Optional, but encouraged accessibility goals or implementation that is not regulated by law.</small></div></div></div>
      <div class="form-row"><span><input type="checkbox" name="policytype[]" id="policy-dontknow" value="Unsure"></span> <label for="policy-dontknow">Unsure</label></div>
    </div>
    <div class="form-block-mini half">
      <label for="policytype_other" class="form-row"><span class="l">Other:</span> <span><input id="policytype_other" name="policytype[other]" type="text"></span></label>
    </div>
  </fieldset>

  <fieldset>
    <legend>Scope of policy (select all that apply)</legend>
      <div class="form-block-mini radio">
        <div class="form-row"><span><input type="checkbox" name="scope[]" id="scope-gov" value="Government"></span> <label for="scope-public">Government</label></div>
        <div class="form-row"><span><input type="checkbox" name="scope[]" id="scope-public" value="Public sector"></span> <label for="scope-public">Public sector</label></div>
        <div class="form-row"><span><input type="checkbox" name="scope[]" id="scope-private" value="Private sector"></span> <label for="scope-private">Private sector</label></div>
      </div>
  </fieldset>

  <fieldset>
    <legend>Technologies the policy applies to</legend>
      <div class="form-block-mini radio">
        <div class="form-row"><span><input type="radio" checked name="web-only" id="web-only-true" value="true"></span> <label for="web-only-true">Web only</label></div>
        <div class="form-row"><span><input type="radio" name="web-only" id="web-only-false" value="false"></span> <label for="web-only-false">Web plus other technologies (e.g. mobile, software, hardware, etc.)</label></div>
      </div>
  </fieldset>

  <fieldset id="fs-guideline">
    <legend>Select the <abbr title="Web Content Accessibility Guidelines">WCAG</abbr> version referenced or required by this policy</legend>
    <div class="form-block-mini radio">
      <div class="form-row"><span><input data-id="guideline_wcag21" id="guideline_wcag21" name="guideline[]" value="WCAG 2.1" type="checkbox"> </span> <label for="guideline_wcag21"><abbr title="Web Content Accessibility Guidelines">WCAG</abbr> 2.1 — <abbr title="World Wide Web Consortium">W3C</abbr> Web Content Accessibility Guidelines 2.1</label></div>
      <div class="form-row"><span><input data-id="guideline_wcag20" id="guideline_wcag20" name="guideline[]" value="WCAG 2.0" type="checkbox"> </span> <label for="guideline_wcag20"><abbr title="Web Content Accessibility Guidelines">WCAG</abbr> 2.0 — <abbr title="World Wide Web Consortium">W3C</abbr> Web Content Accessibility Guidelines 2.0</label></div>
      <div class="form-row"><span><input data-id="guideline_wcag20derivative" id="guideline_wcag20derivative" name="guideline[]" value="WCAG 2.0 derivate" type="checkbox"> </span> <label for="guideline_wcag20derivative"><abbr title="Web Content Accessibility Guidelines">WCAG</abbr> 2.0 derivative — <abbr title="World Wide Web Consortium">W3C</abbr>Based on Web Content Accessibility Guidelines 2.0, but has additional or modifed requirements</label></div>
      <div class="form-row"><span><input data-id="guideline_wcag10" id="guideline_wcag10" name="guideline[]" value="WCAG 1.0" type="checkbox"> </span> <label for="guideline_wcag10"><abbr title="Web Content Accessibility Guidelines">WCAG</abbr> 1.0 — <abbr title="World Wide Web Consortium">W3C</abbr> Web Content Accessibility Guidelines 1.0</label></div>
      <div class="form-row"><span><input data-id="guideline_none" id="guideline_none" name="guideline[]" value="none" type="checkbox"> </span> <label for="guideline_none">None</label></div>
    </div>
    <div class="form-block-mini half">
      <label for="guideline_other" class="form-row"><span class="l">Other:</span> <span><input id="guideline_other" name="guideline[other]" type="text"></span></label>
    </div>
  </fieldset>

  <fieldset>
    <legend>Standards used by policy:</legend>
    <p>If there are standards used to provide the technical requirements to meet the policy, provide the name, web address, and optionally a brief description.</p>
    <strong>Example:</strong>
    <br>Name: GSA Section 508 website
    <br>URL: https://www.section508.gov/
    <br>Description: General Services Administration guidance on Section 508
    <br>
    <ul class="multiple" id="standards-multiple">
      <li class="template">
        <div class="form-block-mini">
          <label class="form-row"><span class="l">Name:</span> <span><input type="text" name="standard_name[]"></span></label>
          <label class="form-row"><span class="l">URL:</span> <span><input type="url" name="standard_url[]"></span></label>
          <label class="form-row"><span class="l">Description (in English):</span> <span><input type="text" name="standard_desc[]"></span></label>
          <label class="form-row"><span class="l">Language:</span> <span><select name="standard_lang[]">{% for l in site.data.lang%}<option value="{{l[0]}}"{% if l[0] == "en" %} selected{% endif %}>{{l[1].name}} ({{l[1].nativeName}})</option>{% endfor %}</select></span></label>
        </div>
        <div class="rem"><button type="button" class="remove btn-small">Remove</button></div>
      </li>
    </ul>
    <button type="button" class="multiple btn-small" data-for="standards-multiple">➕ Add Standard</button>
  </fieldset>

  <fieldset>
    <legend>Relevant documents:</legend>
    <p>List any documents relevant to the policy.</p>
    <ul class="multiple" id="documents-multiple">
      <li class="template">
        <div class="form-block-mini">
          <label class="form-row"><span class="l">Name:</span> <span><input type="text" name="document_name[]"></span></label>
          <label class="form-row"><span class="l">URL:</span> <span><input type="url" name="document_url[]"></span></label>
          <label class="form-row"><span class="l">Description (in English):</span> <span><input type="text" name="document_desc[]"></span></label>
          <label class="form-row"><span class="l">Language:</span> <span><select name="document_lang[]">{% for l in site.data.lang%}<option value="{{l[0]}}"{% if l[0] == "en" %} selected{% endif %}>{{l[1].name}} ({{l[1].nativeName}})</option>{% endfor %}</select></span></label>
        </div>
        <div class="rem"><button type="button" class="remove btn-small">Remove</button></div>
      </li>
    </ul>
    <button type="button" class="multiple btn-small" data-for="documents-multiple">➕ Add Document</button>
  </fieldset>
</fieldset>

	<div class="form-block-mini">
    <div style="display:none" aria-hidden="true">
      <label for="comment">Comment (Don’t fill out this field)</label><span><textarea name="comment" id="comment" cols="60" rows="10" maxlength="300"></textarea></span>
    </div>
		<div class="form-row"><label for="cmnt">Notes or comments:</label><br><span><textarea name="cmnt" id="cmnt" cols="60" rows="10" maxlength="300" aria-describedby="cmntdesc"></textarea><br><span id="cmntdesc">These notes and comments will be publicly available in GitHub and/or e-mail archive, but are not intended to be published on the main page.</span></span></div>
	</div>
  <p><strong>Note:</strong> Information sent using this form is publicly available in GitHub and/or e-mail archive, and will be reviewed before publishing in the Laws and Policies page. It can take <em>up to 10 business days</em> until the information is published.</p>
  <p><button class="btn btn-primary" style="float:none;" name="send" id="send" type="submit">Send Information</button></p>
  </form>

  <script>
    // Add remove possibility to older browsers
    // Source: https://stackoverflow.com/questions/8830839/javascript-dom-remove-element#8830882

    (function () {
        var typesToPatch = ['DocumentType', 'Element', 'CharacterData'],
            remove = function () {
                // The check here seems pointless, since we're not adding this
                // method to the prototypes of any any elements that CAN be the
                // root of the DOM. However, it's required by spec (see point 1 of
                // https://dom.spec.whatwg.org/#dom-childnode-remove) and would
                // theoretically make a difference if somebody .apply()ed this
                // method to the DOM's root node, so let's roll with it.
                if (this.parentNode != null) {
                    this.parentNode.removeChild(this);
                }
            };

        for (var i=0; i<typesToPatch.length; i++) {
            var type = typesToPatch[i];
            if (window[type] && !window[type].prototype.remove) {
                window[type].prototype.remove = remove;
            }
        }
    })();
    //helper function to iterate through elements – it’s just shorter :-D
    function each(elem, func) {
      Array.prototype.forEach.call(elem, func);
    }

    // Each button with class multiple:
    each(document.querySelectorAll('button.multiple'), function(element) {

      // Add event listener
      element.addEventListener('click', function(e) {

        // When clicked, find the list this button refers to…
        var targetMultiple = document.getElementById(e.target.getAttribute('data-for'));

        // Find the template for the list. Clone it.
        var template = targetMultiple.querySelector('.template').cloneNode(true);

        // Remove Template from the item (not strictly necessary)
        template.classList.remove("template");

        // Find the first input element in the copied template, add focusHere class
        template.querySelector('input').classList.add("focusHere");

        // Find the button element in the cloned element and add a class
        template.querySelector('button').classList.add("needsHandler");

        // Insert the copied template before the end of the list.
        targetMultiple.insertAdjacentHTML('beforeend', template.outerHTML);

        // Focus the first input in the inserted list item.
        document.querySelector('.focusHere').focus();

        // Remove focusHere class from all elements that have one. (should always be only one, but better save than sorry before accidentally focussing the wrong element)
        each(document.querySelectorAll('.focusHere'), function(e) {
          e.classList.remove('focusHere');
        });

        // Find the “remove” button and add event listener
        each(document.querySelectorAll('button.remove.needsHandler'), function(e) {
          e.addEventListener('click', function(elem) {
            elem.target.parentNode.parentNode.parentNode.parentNode.querySelector('button.multiple').focus();
            elem.target.parentNode.parentNode.remove();
          });
          e.classList.remove('needsHandler');
        });

      });

    });
  </script>
</div>
