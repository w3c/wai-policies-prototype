---
title: European Union
# title_native: # Country name in the country’s language(s), comma separated. For Switzerland: Schweiz, Suisse, Svizzera, Svizra
updated: 2017-02-09
updatemsg: Adding EU to prototype from proposal document.
# Related page: 
policies:
  - title: Web Accessibility Directive
    url: http://eur-lex.europa.eu/legal-content/EN/TXT/?uri=uriserv:OJ.L_.2016.327.01.0001.01.ENG&toc=OJ:L:2016:327:TOC
    updated: 2016-10-26
    wcagver: WCAG 2.0
    status: in effect
    type: Law # other values: law/policy/procurement
    ministries:
      - title: European Commission
        url: http://ec.europa.eu/index_en.htm
    webonly: yes # other values: no
    scope: public, private # keys that allows us to use any combination
    standard: EN301549
    documents: 
      - title: The adoption of a directive on the accessibility of the sector bodies’ websites and mobile apps
        url: https://ec.europa.eu/digital-single-market/en/news/adoption-directive-accessibility-sector-bodies-websites-and-mobile-apps
  - title: European Accessibility Act (proposed)
    url: http://eur-lex.europa.eu/legal-content/EN/TXT/?uri=COM:2015:0615:FIN
    updated: 2015-12-02
    wcagver: WCAG 2.0 derivative
    status: draft
    type: Proposed Law
    ministries:
      - title: TEuropean Commission
        url: ttp://ec.europa.eu/index_en.htm
    scope: public, private
    webonly: no # other values: yes
    standard: Not specified yet # URL, additional text, like “, which includes WCAG 2.0 verbatim without modifications for Web content, and WCAG 2.0 as interpreted by WCAG2ICT for non-Web documentation and software.” is taken programatically from the standards.yaml document in _data to avoid different text for the same content.
    documents:
      - title: Guidance on implementing the standard on web accessibility
        url: https://www.tbs-sct.gc.ca/hgw-cgf/oversight-surveillance/communications/ws-nw/wa-aw-guid-eng.asp
---
