---
title: Australia
# title_native: # Country name in the country’s language(s), comma separated. For Switzerland: Schweiz, Suisse, Svizzera, Svizra
updated: 2016-08-30
updatemsg: Fixed broken links under the DDA, added new procurement policy announced by the Minister of Finance.
# Related page: Australian states – Not sure yet how to model this, I tend to not have this
policies:
  - title: Disability Discrimination Act 1992 (DDA)
    url: https://www.legislation.gov.au/Details/C2016C00763
    updated: 2016-08-30
    wcagver: WCAG 2.0
    enactdate: 1992
    type: Non-discrimination law # other values: law/policy/procurement
    ministries:
      - title: Attorney General’s Department
        url: https://www.ag.gov.au/Pages/default.aspx
      - title: Australian Human Rights Commission
        url: http://www.humanrights.gov.au/
    webonly: no # other values: yes
    scope: public, private # keys that allows us to use any combination
    standard: false
    documents:
      - title: About Disability Rights
        url: http://www.humanrights.gov.au/our-work/disability-rights/about-disability-rights
        desc: Overview and guide for the Disability Discrimination Act
      - title: Web Accessibility National Transition Strategy
        url: http://www.finance.gov.au/publications/wcag-2-implementation/
        desc: The Australian Government’s adoption and implementation of Web content Accessibility Guidelines version 2.0 (WCAG 2.0)
      - title: Digital Service Standard accessibility requirement
        url: https://www.dto.gov.au/standard/9-make-it-accessible/
        desc: Guide to the standard used by Australian Government agencies for digital services.
  - title: Procurement Standard Guidance
    url: https://www.legislation.gov.au/Details/C2016C00763
    updated: 2016-10-01
    wcagver: WCAG 2.0
    enactdate: draft
    type: Procurement Policy
    ministries:
      - title: Minister of Finance
    scope: gov
    webonly: yes # other values: yes
    standard: EN301549 # URL, additional text, like “, which includes WCAG 2.0 verbatim without modifications for Web content, and WCAG 2.0 as interpreted by WCAG2ICT for non-Web documentation and software.” is taken programatically from the standards.yaml document in _data to avoid different text for the same content.
    documents:
      - title: Announcement from Minister of Finance to use EN 301 549 standard as ICT procurement standard
        url: http://example.com
---
