/*
 * Script for Content Security Policy admin page
 * Brandon Sterne <bsterne@mozilla.com>
 *
 * Loads entries from the user's blog and analyzes the content embedded
 * in each entry to provide a policy reccommendation
 *
 * Uses Mark Perkins' jQuery URL Parser plugin documented here
 * http://projects.allmarkedup.com/jquery_url_parser/
 */

// keep a list of hosts for each type of content served on this blog
var sources = {
  'images': {}, 'media': {}, 'script': {}, 'object': {},
  'frame': {},  'font': {},  'style': {}
};

// store mappings between content-types and CSP directive names
var directives = {
  'images': 'img-src', 'media': 'media-src', 'script': 'script-src',
  'object': 'object-src', 'frame': 'frame-src',  'font': 'font-src',
  'style': 'style-src'
};
// allows us to look up directive mappings in either direction
directives.invert = function() {
  var inverted = {};
  for (var prop in this) {
    if (prop != "invert") inverted[this[prop]] = prop;
  }
  return inverted;
}

// Douglas Crockford's trim() implementation
String.prototype.trim = function () {
  return this.replace(/^\s+|\s+$/g, "");
};

// return a word with the first letter capitalized
function capWord(w) {
  return w.charAt(0).toUpperCase() + w.slice(1);
}

// return whether or not an object has no properties
function objIsEmpty(obj) {
  for (var prop in obj) {
    if (obj.hasOwnProperty(prop))
      return false;
  }
  return true;
}

// log debugging info
var DEBUG = false;

// for debugging: return a pretty-printed version of the content sources
function display(sources) {
  var s = "{\n";
  for (type in sources) {
    s += "  "+type+": [";
    for (host in sources[type]) {
      s += host+", ";
    }
    s += "],\n";
  }
  s += "}";
  return s;
}

// page loaded
jQuery(document).ready(function($) {
  // if there is an existing policy saved we will display it visually
  var policy = $("#csp_value").val();
  // CSP is enabled, but not customized.  The default policy is to allow content
  // only from this site
  if (policy == "allow 'self';") {
    var myHost = jQuery.url.setUrl(window.location.href).attr("host");
    // show non-editable policy representation.  we don't want them to be able
    // to remove "allow 'self'" (at least through the visual policy editor).
    showVisualPolicy({"allowing":{"'self'":null}}, "csp_display", false);
  }
  // policy has been customized by the user
  else if (policy.match(/\S/)) {
    // parse the CSP syntax into our JS object format
    var myDirs = policy.split(";");  // current CSP directives
    // directive-to-readable-name mappings
    var invDirectives = directives.invert();
    for (var i = 0 ; i < myDirs.length ; i++) {
      var dirParts = myDirs[i].trim().split(/[\s]+/);
      // only process directives we know about
      if (dirParts[0] in invDirectives) {
        // add hosts allowed for this directive
        for (var j = 1 ; j < dirParts.length ; j++)
          sources[ invDirectives[dirParts[0]] ][dirParts[j]] = null;
      }
    }
    if (DEBUG) $("#log").text(display(sources));
    // show editable list of policy sources
    showVisualPolicy(sources, "csp_display", true);
  }
  // no CSP set
  else {
    $("#csp_display").html("<p>&nbsp;</p>");
  }

  // discard changes to the policy settings by reloading the page
  $("#csp_discard").click( function() {
    window.location.reload(true);
  });

  // restore the default settings
  $("#csp_restore").click( function() {
    if (confirm("Are you sure you want to restore the default settings?")) {
      //window.location.href += "&restore_defaults=1";
      $("#csp_enabled").attr("checked", false);
      $("#csp_value").val("");
      $("form").submit();
    }
  });


  // show/hide the advanced panel for manual editing
  $("#csp_toggle_advanced").click( function() {
    if ($(this).text() == "Show Advanced") {
      $("#csp_advanced").show();
      $(this).text("Hide Advanced");
    }
    else {
      $("#csp_advanced").hide();
      $(this).text("Show Advanced");
    }
  });

  // fetch the front page of the blog and the individual post pages to analyze
  // for Content Security Policy suggestion
  var posts;
  $("#suggestpolicy").click( function() {
    // show throbber while analyzing
    $("#content-loading").css("visibility", "visible");
    // list of posts to analyze
    posts = jQuery.parseJSON($("#csp_post_list").text());
    // also analyze the home page URL
    var blogUrl = $("#csp_blog_url").text();
    posts.push( {"url": blogUrl} );

    // load the first post for analysis
    var post = posts.shift();
    $("#csp_msg").text("Analyzing " + post.url).show();
    $("#analyze").attr("src", post.url);
    return false;
  });

  // when "Enable CSP" preference is toggled, enable "Discard Changes" button
  $("#csp_enabled").click( function() {
    $("#csp_discard").show();
    // if CSP is enabled, ensure that the source list contains at least
    // the site itself, since "allow 'self'" is the default policy
    if ($(this).attr("checked")) {
      var sourcesIsEmpty = true;
      for (type in sources) {
        if (!objIsEmpty(sources[type])) {
          sourcesIsEmpty = false;
          break;
        }
      }
      // show non-editable policy representation.  we don't want them to be able
      // to remove "allow 'self'" (at least through the visual policy editor).
      if (sourcesIsEmpty)
        showVisualPolicy({"allowing":{"'self'":null}}, "csp_display", false);
    }
  });

  // once the blog page has loaded, examine its content for policy suggestions
  $("#analyze").load(function() {
    // don't examine until we've loaded a page in the frame
    if (!$(this).attr("src"))
      return false;

    // use 'self' for content from this host
    var myHost = jQuery.url.setUrl($(this).attr("src")).attr("host");
    // TODO compare this protocol with resources used in the posts, we might
    // need to white list certain protocols if they differ
    var myProtocol = jQuery.url.setUrl($(this).attr("src")).attr("protocol");

    /* images */
    // XXX bsterne - nearly every blog I've looked at sources images from
    // all over the place.  It's potentially confusing to users to show a list
    // containing every site they get images from.  For now, will allow
    // images from anywhere.
    sources.images["*"] = null;
    /*
    $.each($(this).contents().find("img"), function() {
      var host = jQuery.url.setUrl($(this).attr("src")).attr("host");
      // relative URL, use 'self'
      if (host == null) {
        if (!(host in sources.images))
          sources.images["'self'"] = null;
      }
      // absolute URL, store the hostname
      else {
        if (!(host in sources.images))
          sources.images[host] = null;
      }
    });
    */

    /* media: <video> and <audio> */
    $.each($(this).contents().find("video,audio"), function() {
      var host = jQuery.url.setUrl($(this).attr("src")).attr("host");
      // relative URL, use 'self'
      if (host == null) {
        if (!(host in sources.media))
          sources.media["'self'"] = null;
      }
      // absolute URL, store the hostname
      else {
        if (host == myHost)
          host = "'self'";
        if (!(host in sources.media))
          sources.media[host] = null;
      }
    });

    /* external script resources */
    $.each($(this).contents().find("script"), function() {
      var host = jQuery.url.setUrl($(this).attr("src")).attr("host");
      // relative URL, use 'self'
      if (host == null) {
        if (!(host in sources.script))
          sources.script["'self'"] = null;
      }
      // absolute URL, store the hostname
      else {
        if (host == myHost)
          host = "'self'";
        if (!(host in sources.script))
          sources.script[host] = null;
      }
    });

    /* <object>, <applet>, <embed> */
    // object, applet
    // http://www.w3.org/TR/1999/REC-html401-19991224/struct/objects.html#h-13.3
    $.each($(this).contents().find("object,applet"), function() {
      // codebase: base URI for classid, data, archive attrs
      var codebase = $(this).attr("codebase");
      var host = jQuery.url.setUrl(codebase).attr("host");
      // relative URL, use 'self'
      if (host == null) {
        if (!(host in sources.object))
          sources.object["'self'"] = null;
      }
      // absolute URL, store the hostname
      else {
        if (host == myHost)
          host = "'self'";
        if (!(host in sources.object))
          sources.object[host] = null;
      }

      // classid: location of an object's implementation.
      // XXX bsterne - spec says this is a URI, but in the wild this usually
      // references a COM registry ID. For now, skipping this URL for any
      // non-data-returning protocols, e.g. clsid:.
      var classid = $(this).attr("classid");  // applet won't have this
      var protocol = jQuery.url.setUrl(classid).attr("protocol");
      if (jQuery.inArray(protocol, ["http", "https", "ftp", null]) != -1) {
        host = jQuery.url.setUrl(classid).attr("host");
        // relative URL, use 'self'
        if (host == null) {
          if (!(host in sources.object))
            sources.object["'self'"] = null;
        }
        // absolute URL, store the hostname
        else {
          if (host == myHost)
            host = "'self'";
          if (!(host in sources.object))
            sources.object[host] = null;
        }
      }

      // data: object's or applet's location
      var data = $(this).attr("data");  // applet won't have this
      host = jQuery.url.setUrl(data).attr("host");
      // relative URL, use 'self'
      if (host == null) {
        if (!(host in sources.object))
          sources.object["'self'"] = null;
      }
      // absolute URL, store the hostname
      else {
        if (host == myHost)
          host = "'self'";
        if (!(host in sources.object))
          sources.object[host] = null;
      }

      // archive: space-separated list of URIs of relevant resources
      var archive = $(this).attr("archive");
      var hosts = archive.split(" ");
      $.each(hosts, function() {
        host = jQuery.url.setUrl(this).attr("host");
        // relative URL, use 'self'
        if (host == null) {
          if (!(host in sources.object))
            sources.object["'self'"] = null;
        }
        // absolute URL, store the hostname
        else {
          if (host == myHost)
            host = "'self'";
          if (!(host in sources.object))
            sources.object[host] = null;
        }
      });
    });

    // embed
    $.each($(this).contents().find("embed"), function() {
      var host = jQuery.url.setUrl($(this).attr("src")).attr("host");
      // relative URL, use 'self'
      if (host == null) {
        if (!(host in sources.object))
          sources.object["'self'"] = null;
      }
      // absolute URL, store the hostname
      else {
        if (host == myHost)
          host = "'self'";
        if (!(host in sources.object))
          sources.object[host] = null;
      }
    });

    // frame, iframe
    $.each($(this).contents().find("frame,iframe"), function() {
      var host = jQuery.url.setUrl($(this).attr("src")).attr("host");
      // relative URL, use 'self'
      if (host == null) {
        if (!(host in sources.frame))
          sources.frame["'self'"] = null;
      }
      // absolute URL, store the hostname
      else {
        if (host == myHost)
          host = "'self'";
        if (!(host in sources.frame))
          sources.frame[host] = null;
      }
    });

    // @font-face (downloadable fonts)
    var stylesheets = {};
    try {
      var stylesheets = this.contentDocument.styleSheets;
    }
    // XXX bsterne - parsing style rules in IE is hard :-(
    // see http://www.quirksmode.org/dom/w3c_css.html
    catch (e) {}

    for (var i = 0 ; i < stylesheets.length ; i++) {
      // XXX bsterne - apparently, cross-site stylesheets' rules are subject to
      // same-origin.  We'll only be able to make font policy reccommendations
      // based on same-site stylesheets.
      var rules = {};
      try {
        // Firefox, Chrome, Safari, etc.
        rules = stylesheets[i].cssRules;
        // Internet Explorer would use .rules if we can add support
        // rules = stylesheets[i].rules;
      }
      catch (e) { // probably a cross-site stylesheet which we can't read
        continue;
      }
      // XXX bsterne - Chrome can return null for cssRules but not throw
      if (!rules) {
        continue;
      }
      // search stylesheet rules for @font-face
      for (var j = 0 ; j < rules.length ; j++) {
        if (rules[j].type == rules[j].FONT_FACE_RULE) {
          var src = rules[j].style.getPropertyValue("src");
          if (src) {
            // remove url() wrapper from font-face src
            var url = src.replace(/^url['"]*/, "").replace(/['"]*\)$/, "");
            var host = jQuery.url.setUrl(url).attr("host");
            // relative URL, use 'self'
            if (host == null) {
              if (!(host in sources.font))
                sources.font["'self'"] = null;
            }
            // absolute URL, store the hostname
            else {
              if (host == myHost)
                host = "'self'";
              if (!(host in sources.font))
                sources.font[host] = null;
            }
          }
        }
      }
    }

    // external stylesheets
    $.each($(this).contents().find("link[rel='stylesheet']"), function() {
      var host = jQuery.url.setUrl($(this).attr("href")).attr("host");
      // relative URL, use 'self'
      if (host == null) {
        if (!(host in sources.style))
          sources.style["'self'"] = null;
      }
      // absolute URL, store the hostname
      else {
        if (host == myHost)
          host = "'self'";
        if (!(host in sources.style))
          sources.style[host] = null;
      }
    });

    // load the next post
    var post = posts.shift();
    if (post) {
      $("#csp_msg").text("Analyzing " + post.url).show();
      $("#analyze").attr("src", post.url);
      // display a reccommended policy that the user can edit, then accept or reject
      showVisualPolicy(sources, "csp_display", true);
      // changes were made, enable "Discard Changes" button and change
      // border of "Trusted Sites" panel
      $("#csp_discard").show();
      $("#csp_display").css("border-style", "dashed").css("border-width","2px");
    }
    // we're done
    else {
      // turn off throbber
      $("#content-loading").css("visibility", "hidden");
      // hide progress message
      $("#csp_msg").fadeOut(500);
    }
  });

  // display a visual representation of the policy defined in a source list
  // inside the specified DOM element.  If |editable| is passed in as true,
  // the printed list will be interactive
  function showVisualPolicy(sourceList, elementID, editable) {
    if (DEBUG) $("#log").text(display(sourceList))
    $("#"+elementID).empty();
    var myHost = jQuery.url.setUrl(window.location.href).attr("host");
    for (type in sourceList) {
      var div = document.createElement("div");
      // skip content types which have no sources
      if (objIsEmpty(sourceList[type]))
        continue;
      $(div).addClass("feature-name").text(capWord(type));
      $("#"+elementID).append(div);
      var ol = document.createElement("ol");
      $(ol).addClass("feature-group");
      for (host in sourceList[type]) {
        var li = document.createElement("li");
        $(li).attr("host", host);
        $(li).attr("ctype", type); // content type
        // if list is editable, permit the user to remove a source from the
        // suggested source list or add it back in
        if (editable) {
          $(li).click(function() {
            // changes were made, enable "Discard Changes" button and change
            // border of "Trusted Sites" panel
            $("#csp_discard").show();
            $("#csp_display").css("border-style", "dashed").css("border-width",
                                                                "2px");
            // re-enable a previously removed source
            if ($(this).css("text-decoration") == "line-through") {
              $(this).css("text-decoration", "none");
              //sourceList[this.type][this.host] = null;
              sourceList[$(this).attr("ctype")][$(this).attr("host")] = null;
            }
            // remove a source from the list of suggestions
            else {
              $(this).css("text-decoration", "line-through");
              //delete sourceList[this.type][this.host];
              delete sourceList[$(this).attr("ctype")][$(this).attr("host")];
            }
            if (DEBUG) $("#log").text(display(sourceList));
          });
        }
        if (host == "*") {
          var displayName = "Everyone";
          var faviconUrl = $("#csp_image_dir").val() +
            "/content-security-policy/images/everyone.gif";
        }
        else if (host == "'self'") {
          var displayName = myHost;
          var faviconUrl = "http://" + myHost + "/favicon.ico";
        }
        else {
          var displayName = host;
          var faviconUrl = "http://" + host + "/favicon.ico";
        }
        $(li).html("<img src=\"" + faviconUrl + "\" class=\" csp-trusted\"" +
                   " onerror=\"this.parentNode.removeChild(this)\">");
        if (editable)
          $(li).append("<label>" + displayName + "</label>");
        else
          $(li).append(displayName);
        $(ol).append(li);
      }
      $("#"+elementID).append(ol).append("<br class=\"clear\">");
    }
    // show a message describing how to treat the list of sources
    $("#csp_verify_text").show();
  }

  // turn a list of sources into proper CSP syntax
  function generatePolicyFromSources(sourceList) {
    var policy = "allow 'self'; ";
    for (type in sourceList) {
      // skip types which have no sources specified
      if (objIsEmpty(sourceList[type]))
        continue;
      policy += directives[type] + " ";
      for (host in sourceList[type]) {
        policy += host+" ";
      }
      policy += "; ";
    }
    return policy;
  }

  // once the user has verified the list of sources they want to allow, turn the
  // list of hosts-per-content-type into proper CSP syntax
  $("#csp_save").click( function() {
    // if the advanced view is hidden, then generate policy from the visual
    // editor and place in the form field
    if ($("#csp_toggle_advanced").text() == "Show Advanced") {
      $("#csp_value").val( generatePolicyFromSources(sources) );
    }
    // otherwise the user wants to edit the policy directly, so we'll use what's
    // in the form field
    $("form").submit();
  });

});
