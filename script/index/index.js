$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});

function(d) {
  var e = a(this);
  if (!e.is(".disabled, :disabled")) {
    var f = b(e),
      g = f.hasClass("open");
    if (c(), !g) {
      "ontouchstart" in document.documentElement && !f.closest(".navbar-nav").length && a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click", c);
      var h = {
        relatedTarget: this
      };
      if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented()) return;
      e.trigger("focus").attr("aria-expanded", "true"), f.toggleClass("open").trigger("shown.bs.dropdown", h)
    }
    return !1
  }
}

function(c) {
  if (/(38|40|27|32)/.test(c.which) && !/input|textarea/i.test(c.target.tagName)) {
    var d = a(this);
    if (c.preventDefault(), c.stopPropagation(), !d.is(".disabled, :disabled")) {
      var e = b(d),
        g = e.hasClass("open");
      if (!g && 27 != c.which || g && 27 == c.which) return 27 == c.which && e.find(f).trigger("focus"), d.trigger("click");
      var h = " li:not(.disabled):visible a",
        i = e.find(".dropdown-menu" + h);
      if (i.length) {
        var j = i.index(c.target);
        38 == c.which && j > 0 && j--, 40 == c.which && j < i.length - 1 && j++, ~j || (j = 0), i.eq(j).trigger("focus")
      }
    }
  }
}

function() {
  buttons.removeClass('active');
  var cur = jQuery(this).attr('data-currency');
  jQuery(".currency li[data-currency='" + cur + "']").addClass('active');

  var newCurrency = jQuery(this).attr('data-currency');
  if (newCurrency == Currency.currentCurrency) {
    Currency.convertAll(shopCurrency, newCurrency);
  } else {
    Currency.convertAll(Currency.currentCurrency, newCurrency);
  }

  jQuery(".current-currency").text(cur);
}

function(t) {
  return "undefined" != typeof re && re.event.triggered !== t.type ? re.event.dispatch.apply(e, arguments) : void 0
}

function() {
  $j(".mobile-menu-wrapper").removeClass("open"), $j("body").removeClass("no-scroll")
}

function(e) {
  e.preventDefault;
  var t = 300,
    i = $j(this).parent(),
    o = $j(this).next("ul");
  i.hasClass("open") ? (i.removeClass("open"), o.slideUp(t)) : (i.addClass("open"), o.slideDown(t))
}

function() {
  "block" == o.css("display") ? o.slideUp("slow") : o.slideDown("slow"), e(this).html(i ? "&minus;" : "+"), i = !i
}

function(e) {
  e.preventDefault(), $j(this).parent(".search").addClass("open"), $j(this).next(".search-dropdown").addClass("open"), $j("header .badge").addClass("badge--hidden")
}

function() {
  // What's the search term?
  var term = $(this).val();
  // What's the search form?
  var form = $(this).closest('form');
  // What's the search URL?
  var searchURL = '/search?type=product&q=' + term;
  // What's the search results list?
  var resultsList = form.find('.search-results');
  // If that's a new term and it contains at least 3 characters.
  if (term.length > 3 && term != $(this).attr('data-old-term')) {
    // Saving old query.
    $(this).attr('data-old-term', term);
    // Killing any Ajax request that's currently being processed.
    if (currentAjaxRequest != null) currentAjaxRequest.abort();
    // Pulling results.
    currentAjaxRequest = $.getJSON(searchURL + '&view=json', function(data) {
      // Reset results.
      resultsList.empty();
      // If we have no results.
      if (data.results_count == 0) {
        // resultsList.html('<li><span class="title">No results.</span></li>');
        // resultsList.fadeIn(200);
        resultsList.hide();
      } else {
        // If we have results.
        $.each(data.results, function(index, item) {
          var link = $('<a></a>').attr('href', item.url);
          link.append('<span class="thumbnail"><img src="' + item.thumbnail + '" /></span>');
          link.append('<span class="title">' + item.title + '</span>');
          link.wrap('<li></li>');
          resultsList.append(link.parent());
        });
        // The Ajax request will return at the most 10 results.
        // If there are more than 10, let's link to the search results page.
        if (data.results_count > 10) {
          resultsList.append('<li><span class="title"><a href="' + searchURL + '">See all results (' + data.results_count + ')</a></span></li>');
        }
        resultsList.fadeIn(200);
      }
      $('.search-results').css({
        'width': input.innerWidth() + 2
      });
    });
  }
}

function(e) {
  e.preventDefault(), $j(this).closest(".search").removeClass("open"), $j(this).closest(".search-dropdown").removeClass("open"), $j("header .badge").removeClass("badge--hidden")
}

function(e) {
  e.preventDefault(), $j(this).closest(".dropdown.open .dropdown-toggle").dropdown("toggle")
}

function(e) {
  e.preventDefault()
}

function() {
  var e = $j(this),
    t = e.find(".dropdown-menu");
  clearTimeout(timerVar), $j(window).unbind("scroll", menuScroll), e.hasClass("active") && (t.fadeOut(300), setTimeout(removeActiveItem, 300, e), $j("body").hasClass("hidden-menu") && $j("body").removeClass("hidden-menu"))
}

function() {
  var e = $j(this),
    t = e.find(".dropdown-menu");
  t.length && (t.fadeOut(0), timerVar = setTimeout(function() {
    e.addClass("active"), t.fadeIn(200), submenuXposition(t), submenuYposition(t), $j(window).bind("scroll", {
      obj: t
    }, menuScroll)
  }, 300))
}