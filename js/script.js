_.mixin({
  to_slug: function(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
      str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
      .replace(/\s+/g, '-') // collapse whitespace and replace by -
      .replace(/-+/g, '-')  // collapse dashes
      .replace(/(^[0-9]*-)/g, '-') // remove numbers and - from the beginning of the string
      .replace(/^-*/g, ''); // remove dash from the begining of the string

    return str;
  }
});
_.mixin({
	strip_html: function(html) {
		var tmp = document.createElement("DIV");
		tmp.innerHTML = html;
		return tmp.textContent || tmp.innerText || "";
	}
});
_.mixin({
	parsedate: function(datestr) {
		var date = "";
  	if (datestr instanceof Array) {
        date = datestr[0];
      } else {
        date = datestr;
      }
      var dateParts = date.split("-");
      var month = '';
      switch (parseInt(dateParts[1],10)) {
        case 1:
          month = 'Jan';
          break;
        case 2:
          month = 'Feb';
          break;
        case 3:
          month = 'Mar';
          break;
        case 4:
          month = 'Apr';
          break;
        case 5:
          month = 'May';
          break;
        case 6:
          month = 'Jun';
          break;
        case 7:
          month = 'Jul';
          break;
        case 8:
          month = 'Aug';
          break;
        case 9:
          month = 'Sep';
          break;
        case 10:
          month = 'Oct';
          break;
        case 11:
          month = 'Nov';
          break;
        case 12:
          month = 'Dec';
          break;
      }
    return dateParts[0] + '-' + month + '-' + dateParts[2];
  }
});

$(function(){

  var location = window.history.location || window.location;
  var uri = new URI(location);
  var selected = uri.search(true);
  if (selected.q !== undefined) {
    if (_.isArray(selected.q)) {
      selected = selected.q;
    } else {
      selected = [selected.q];
    }
  }
  console.log(selected.q);

	var item_template = $('#results-template').text();
	var a11y_policies = $.getJSON( "./js/data.json", function() {

	}).done(function(jsn) {

		var settings = {
			items            : jsn,
			facets           : {
				'wcagver' : {'title': 'WCAG Version Used', 'collapsed': true},
				'type'  : {'title': 'Type of Policy', 'collapsed': true},
				'scope': {'title': 'Scope of Policy', 'collapsed': true}
			},
			resultSelector   : '#results',
			facetSelector    : '#facets',
			resultTemplate   : item_template,
			enablePagination : false,
			paginationCount  : 10,
			orderByOptions   : {'title': 'Title'},
			facetSortOption  : {},
			facetListContainer : '<ul class=facetlist></ul>',
			listItemTemplate   : '<li><span><input type="checkbox" class="facetitem" aria-pressed="false" id="<%= id %>" data-name="<%= _(_(name).strip_html()).to_slug() %>"></span> <span><label for="<%= id %>"><%= name %> <span class="facetitemcount">(<%= count %>&nbsp;<% if (count==1) { %>policy<% } else {%>policies<% } %>)</span></label></span></li>',
			listItemInnerTemplate   : '<span><%= name %> <span class=facetitemcount>(<%= count %> <% if (count==1) { %>policy<% } else {%>policies<% } %>)</span></span>',
			orderByTemplate    : '',
			countTemplate      : '<div class="facettotalcount"><strong><span aria-live="true">Showing <%= count %> <% if (count==1) { %>policy<% } else {%>policies<% } %></span><% if (filters) { %>, matching the filters:</strong> <span class="filter"><%= filters.join("</span>, <span class=\'filter\'>") %></span><% } else { %></strong><% } %></div>',
			facetTitleTemplate : '<% if (!obj.plain) { %><summary class="facettitle"><%= title %></summary><% } %>',
			facetContainer     : '<% if (!obj.plain) { %><details <% if (obj.collapsed) { %><% } else { %>open="true"<% } %> class="facetsearch <% if (obj.collapsed) { %><% } else { %>open<% } %>" id="<%= id %>"></details><% } else { %><div class="plainitem"></div><% } %>',
			showMoreTemplate   : '<button type="button" id="showmorebutton">Show more</button>',
      deselectTemplate   : '<button type="button" id="deselect" class="btn"><svg aria-hidden="true" class="i-refresh"><use xlink:href="#i-refresh"></use></svg> Clear filters</button>',
      shareviewTemplate  : '<div class="permalink_wrapper" id="sharethisview"><a href="#" class="btn"><svg aria-hidden="true" class="i-share"><use xlink:href="#i-share"></use></svg> Share this view</a><div class="sharebox"><p><label>Link to this view:<input type="url" value="" readonly=""> Shortcut to copy the link: <kbd>ctrl</kbd>+<kbd>C</kbd> <em>or</em> <kbd>⌘</kbd><kbd>C</kbd></label></p><p><a href="">E-mail a link to this section</a><button>Close</button></p></div></div>',
      selected           : selected,
      state              : {
                         orderBy : false,
                         filters : {}
                       },
		};

	// use them!
	//
	$.facetelize(settings);
	// Emulate <details> where necessary and enable open/close event handlers
	// alert($.fn.details.support);
	$('html').addClass($.fn.details.support ? 'details' : 'no-details');
	$('#facets details, .navigation > details, #editdetail').details();

  $('.bottomline').on('animationend webkitAnimationEnd oanimationend MSAnimationEnd', function(event) {
    event.preventDefault();
    /* Act on the event */
    $(event.target).removeClass('active');
  });

	});

});
