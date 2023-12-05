---
title: "Web Accessibility Laws & Policies"
nav_title: "Countries / Regions"
permalink: /policies/
layout: sidenav
---

{::nomarkdown}
{% include box.html type="start" title="Updates" icon="default" %}
{:/}

Many listings were updated in December 2023. Near the top of each country listing is a "last updated" date.

We welcome additions or corrections to these listings via the [submission form]({{ "/policies/submission/" | relative_url }}).

{::nomarkdown}
{% include box.html type="end" %}
{:/}

This page lists governmental policies related to web accessibility, although it is not a comprehensive or definitive listing.<!-- We welcome additions or corrections to these listings via the [submission form]({{ "/policies/submission/" | relative_url }}). -->

The information on this page is _not_ legal advice. Please consult legal authorities for the appropriate jurisdiction. W3C cannot guarantee the accessibility of these external resources.

For guidance on developing an accessibility policy for an organization, see [Developing Organizational Policies on Web Accessibility]({{ "/planning/org-policies/" | relative_url }}).

{% include excol.html type="start" id="xterms" %}

<h3>Terms used on this page</h3>

{% include excol.html type="middle" %}

-   **Law** – A law has completed the legislation process, and is put
    into effect as the law of the land.
-   **Policy** – Outlines the goals of a government ministry or agency
    as well as the methods and principles to achieve those goals.
    Policies are not laws, but can lead to the development of laws.
-   **Public sector** – Includes government and government-run or owned
    entities, and entities that receive government funding.
-   **Private sector** – Businesses and organizations that are not part
    of the public sector, including non-profit organizations.
-   **WCAG derivative** - Used when a standard is based on a version of
    the Web Content Accessibility Guidelines (WCAG), but some
    requirements were excluded or modified or additional non-WCAG
    requirements were added.
-   **Procurement law** - A law that requires government purchase of
    accessible goods and services.
-   **Procurement recommendation** - An optional, but encouraged goal to
    purchase accessible goods and services.
-   **Mandatory policy** - Required accessibility goals or
    implementation that is not regulated by law.

{% include excol.html type="end" %}


<h2 id="xtable">Law and Policy Overview Table</h2>
<div>
  <table class="sortable dense overviewtable">
    <thead>
    <tr>
      <th>Country / Region</th>
      <th>Name</th>
      <th>Date Enacted</th>
      <th>Type (policy, law, legislation, etc.)</th>
      <th>Scope</th>
      <th>Web Only</th>
      <th>WCAG Version Based On</th>
    </tr>
    </thead>
    <tbody id="results">
      {% for policy in site.policies %}
      {% for p in policy.policies %}
      {% for title in p.title %}
        {% assign policySlug = title[1] | slugify %}
      {% endfor %}
      <tr data-updated="{{policy.updated}}">
        <td>{% assign curl = policy.country.en | slugify | prepend: '#x' %}
          {% include multilang-title.html title=policy.country url=curl %}</td>
        <td><a href="{{ policy.url | prepend: site.baseurl }}#{{ policySlug }}">{% include multilang-policy-title.html title=p.title %}</a></td>
        <td>{{p.enactdate}}</td>
        <td class="hyphenated">{{p.type}}</td>
        <td class="hyphenated">{{p.scope}}</td>
        <td>{%if p.webonly == true %}Yes{% else %}No{%endif%}</td>
        <td>{{p.wcagver}}</td>
      </tr>
      {% endfor %}
      {% endfor %}
    </tbody>
  </table>
</div>

<script type="text/template" id="results-template">
  <tr>
    <td><a href="<%= obj.countryhref %>"><%= obj.title %></a></td>
    <td><a href="<%= obj.policyhref %>"><%= obj.policyname %></a></td>
    <td><%= obj.enactdate %></td>
    <td class="hyphenated"><%= obj.type %></td>
    <td class="hyphenated"><% if (obj.scope instanceof Array && obj.scope.length > 1) { %>
      <%= obj.scope.join(', ') %>
    <% } else { %>
      <%= obj.scope %>
    <% } %></td>
    <td><%= obj.webonly %></td>
    <td><%= obj.wcagver %></td>
  </tr>
</script>


<script src="{{ "/policies/js/jquery.js" | relative_url }}"></script>
<script src="{{ "/policies/js/underscore.js" | relative_url }}"></script>
<script src="{{ "/policies/js/uri.js" | relative_url }}"></script>
<script src="{{ "/policies/js/sorttable.js" | relative_url }}"></script>
<script>var path = "{{ "/" | relative_url }}";</script>
<script src="{{ "/policies/js/script.js" | relative_url }}"></script>
<style>@import url('{{ "/policies/css/policies.css" | relative_url }}');</style>
