<?php
/**
 * Content Security Policy Administration Panel
 *
 *
 *
 */
?>

<div class="wrap">
<h2>Content Security Policy Settings</h2>

<form method="post" action="options.php">
<?php settings_fields("csp-settings"); ?>
<h3>Content Security Policy</h3>
<p><a href="https://wiki.mozilla.org/Security/CSP">Content Security
Policy</a> is a mechanism that prevents
<a href="http://en.wikipedia.org/wiki/Cross-site_scripting">cross-site
scripting</a> and other content-injection attacks.  It works by informing the
browser about which websites you trust to serve content in your pages, and what
specific types of content are expected.  To provide protection in this way, CSP
fundamentally changes the way JavaScript can be embedded in web pages, so be
aware that <b>WordPress plugins and themes may experience broken
functionality</b> when CSP is enabled.</p>
<table class="form-table" id="csp-form">
<tr valign="top">
  <th><label for="csp_enabled"><?php _e('Enable CSP') ?></label></th>
  <td><input id="csp_enabled" type="checkbox" name="csp_enabled" value="1" <?php checked('1', get_option('csp_enabled')); ?> /></td>
  <th>Trusted Sites:</th>
  <td>
    <div class="feature-filter" id="csp_display"></div>
  </td>
</tr>
</tr>
<tr valign="middle">
  <td colspan="3">&nbsp;</td>
  <td><span id="csp_verify_text">Verify that you trust the sites in the list
  above to serve content in your site.  Remove any sites that you do not trust
  by clicking them.  Your changes will not be saved until you click <b>Save
  Changes</b> below.</span></td>
</tr>
<tr valign="top">
  <td colspan="3"></td>
  <td>
    <div class="tablenav" style="vertical-align:bottom">
      <div class="alignleft actions">
<?php if (get_option("csp_enabled") != "" || get_option("csp_value") != "") { ?>
        <input type="button" id="csp_restore" class="button-secondary" value="<?php esc_attr_e('Restore Defaults') ?>" />
<?php } ?>
        <input type="button" name="suggestpolicy" id="suggestpolicy" class="button-secondary" value="<?php esc_attr_e('Suggest Policy') ?>" />
        <img id="content-loading" alt="" src="images/wpspin_light.gif" />
        <input type="button" class="button-secondary" id="csp_discard" value="<?php esc_attr_e('Discard Changes') ?>" />
        <input type="button" class="button-primary" id="csp_save" value="<?php esc_attr_e('Save Changes') ?>" />
      </div>
    </div>
  </td>
</tr>
<tr>
  <th><label id="csp_toggle_advanced">Show Advanced</label></th>
  <td colspan="3">
    <div class="feature-filter" id="csp_advanced">
      <p><b>Note:</b> if this field is exposed, this textual policy will
      override the visual policy shown above.</p>
      <p>Do not edit the policy directly unless you really know what you are
      doing.</p>
      <input type="text" name="csp_value" id="csp_value"
             value="<?php form_option('csp_value'); ?>" />
    </div>
  </td>
</tr>
</table>
<input type="hidden" id="csp_image_dir" value="<?php echo WP_PLUGIN_URL; ?>" />
</form>

</div><!-- wrap -->
<div id="csp_msg"></div>
<div id="csp_blog_url"><?php
  $siteurl = get_option("siteurl");
  $url = (!empty($_SERVER["HTTPS"])) ? preg_replace("/^http:/", "https:", $siteurl):
                                       preg_replace("/^https:/", "http:", $siteurl);
 echo $url; ?></div>
<div id="csp_post_list">
<?php
// print a JSON list of post URLs for the policy suggestor to analyze
query_posts("nopaging=true");
echo "[";
$first = true;
while (have_posts()):
  the_post();
  if ($first) {
    echo " { \"url\": \""; $first = false;
  }
  else
    echo ", { \"url\": \"";
  // make sure the protocol used in the links is the same as this page so
  // we don't have a same-origin violation
  $permalink = get_permalink();
  $link = (!empty($_SERVER["HTTPS"])) ? preg_replace("/^http:/", "https:", $permalink):
                                        preg_replace("/^https:/", "http:", $permalink);

  echo $link . "\" }";
endwhile;
echo " ]";
?>
</div>
<iframe id="analyze"></iframe>
<pre id="log"></pre>
