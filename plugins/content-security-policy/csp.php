<?php
/*
Plugin Name: Content Security Policy
Plugin URI: http://people.mozilla.org/~bsterne/content-security-policy/wordpress.html
Description: <a href="http://people.mozilla.org/~bsterne/content-security-policy/">Content Security Policy</a> prevents content injection attacks by allowing admins to specify which sites they trust to serve content in their site.  The Content Security Policy plugin implements these features in WordPress.
Version: 0.3
Author: Brandon Sterne
Author URI: http://people.mozilla.org/~bsterne
License: GPL2
*/

if (!defined("CSP_OPTIONS_PAGE_STR"))
  define("CSP_OPTIONS_PAGE_STR", "content_security_policy");
if (!defined("CSP_SETTINGS_PAGE_PATH")) {
  $parts = parse_url(admin_url());
  define("CSP_SETTINGS_PAGE_PATH", $parts["path"] . "options-general.php?page=" .
         CSP_OPTIONS_PAGE_STR);
}
if (!defined("CSP_IMAGE_DIR"))
  define("CSP_IMAGE_DIR", WP_PLUGIN_URL . "/content-security-policy/images/");

$csp_errors = array();

function csp_admin_init() {
  wp_register_style("CSPStyle", WP_PLUGIN_URL . "/content-security-policy/style/csp-options.css");
  wp_register_script("CSPScript", WP_PLUGIN_URL . "/content-security-policy/script/csp-options.js");
  wp_register_script("jQueryURL", WP_PLUGIN_URL . "/content-security-policy/script/jquery.url.js");
  register_setting("csp-settings", "csp_enabled");
  register_setting("csp-settings", "csp_value");
}

add_action("admin_init", "csp_admin_init");

function show_csp_menu() {
  $page = add_options_page("Content Security Policy Settings", "CSP",
                           "administrator", CSP_OPTIONS_PAGE_STR,
                           "csp_options_page");
  add_action("admin_print_styles-" . $page, "csp_admin_style");
  add_action("admin_print_scripts-" . $page, "csp_admin_script");
}

function csp_admin_style() {
  wp_enqueue_style("CSPStyle");
  wp_enqueue_style("theme-install"); // from WordPress core
}

function csp_admin_script() {
  wp_enqueue_script("CSPScript");
  wp_enqueue_script("jQueryURL");
}

function csp_options_page() {
  include_once("csp-options-page.php");
}

add_action("admin_menu", "show_csp_menu");

function get_csp() {
  if (!get_option("csp_enabled"))
    return false;
  $policy = get_option("csp_value");
  // use default policy "allow 'self'" if user has not configured a policy
  if ( !strlen(trim($policy)) )
    return "allow 'self'";
  else
    return $policy;
}

function send_csp_header() {
  // Content Security Policy header
  $csp = get_csp();
  if ($csp) {
    // Do not send the CSP header for the admin portion of the site.
    // As of May 2010, WP Core developers don't feel it's architecturally
    // feasible to move all the inline script to external script files.
    if (!is_admin())
      header("X-Content-Security-Policy: " . $csp);
  }
}

add_action("init", "send_csp_header", 1);

// Since we're disallowing inline script, add a button to allow users to
// upload external script files for use in posts, etc.
function csp_add_script_upload_button($content) {
  // For trunk:
  // cribbed from _media_button()
	// $script_button = "<a href='" . get_upload_iframe_src("script") . "' id='add_script' class='thickbox' title='Add Script'><img src='" . esc_url(CSP_IMAGE_DIR."media-button-script.gif") . "' alt='Add Script' /></a>";
  // For 2.9
  // cribbed from media_buttons()
  global $post_ID, $temp_ID;
  $uploading_iframe_ID = (int) (0 == $post_ID ? $temp_ID : $post_ID);
  $media_upload_iframe_src = "media-upload.php?post_id=$uploading_iframe_ID";
  $script_button = "<a href='" . $media_upload_iframe_src . "&amp;TB_iframe=true' id='add_script' class='thickbox' title='Add Script' onclick='return false;'><img src='" . esc_url(CSP_IMAGE_DIR."media-button-script.gif") . "' alt='Add Script' /></a>";
  return $content . $script_button;
}

add_filter("media_buttons_context", "csp_add_script_upload_button");

// allow user to upload a script file, or create a new one via text editor
// calls media_upload_type_form($type = 'file', $errors = null, $id = null)
function csp_show_script_uploader() {
  return wp_iframe("media_upload_type_form", "script");
}

add_action("media_upload_script", "csp_show_script_uploader");

// Using the list of "valid" MIME types on Anne's blog:
// http://annevankesteren.nl/2005/02/javascript-mime-type
$jsMimeTypes = array("application/x-javascript", "application/javascript",
                     "text/ecmascript", "text/javascript", "text/ecmascript");

function csp_send_script_to_editor($content) {
  // get the ID of the attachment we are inserting
  $aid = Null;
  foreach($_POST["send"] as $k => $v) {
    if (is_int($k))
      $aid = $k;
  }
  // check the MIME type of the file we're inserting
  global $wpdb, $jsMimeTypes;
  $row = $wpdb->get_row("SELECT * FROM wp_posts WHERE ID={$aid}");
  // verify the file has a valid JavaScript MIME type before converting to
  // a <script src=""> HTML blob.
  if (in_array($row->post_mime_type, $jsMimeTypes)) {
    // printing directly, instead of returning to media_send_to_editor,
    // which creates escaping problems due to addslashes
?>
<script type="text/javascript">
/* <![CDATA[ */
var win = window.dialogArguments || opener || parent || top;
win.send_to_editor('<script src=\'<?php echo $row->guid; ?>\'><\/script>');
/* ]]> */
</script>
<?php
    die();
  }
  else {
    // not a valid JS file, use the default insertion format
    return $content;
  }
}

add_filter("media_send_to_editor", "csp_send_script_to_editor");

function csp_add_script_mime_type($mime_types) {
  // only use application/javascript to organize script files.  We'll enforce
  // this type on upload
  $mime_types["application/javascript"] = array("Script", "Manage Script",
                                                array("Script (%s)", "Script (%s)"));
  return $mime_types;
}

add_filter("post_mime_types", "csp_add_script_mime_type");

// for a script upload make sure it is stored as application/javascript because
// a single MIME type is easier to manage in our media library list
function csp_handle_upload($fileArray) {
  global $jsMimeTypes;
  if (in_array($fileArray["type"], $jsMimeTypes))
    $fileArray["type"] = "application/javascript";
  return $fileArray;
}

add_filter("wp_handle_upload", "csp_handle_upload");

// add a tab to create a new script file with the text editor
function csp_new_script_from_editor($tabs) {
  $tabs["script_editor"] = "From Editor";
  return $tabs;
}

add_filter("media_upload_tabs", "csp_new_script_from_editor");

// show a text editor from which to create a new script file
// based on media_upload_type_form
function media_csp_display_script_editor($type = "script") {
  global $csp_errors;

	media_upload_header();
	$post_id = intval($_REQUEST['post_id']);
  $form_action_url = admin_url("media-upload.php?type=$type&tab=script_editor&post_id=$post_id");
  $code_icon_url = wp_mime_type_icon("code");
?>

<form enctype="multipart/form-data" method="post" action="<?php echo esc_attr($form_action_url); ?>" class="media-upload-form type-form validate" id="<?php echo $type; ?>-form">
  <input type="submit" class="hidden" name="save" value="" />
  <input type="hidden" name="post_id" id="post_id" value="<?php echo (int) $post_id; ?>" />
<?php wp_nonce_field("csp-script-form"); ?>

<h3 class="media-title"><?php _e("Create a new script file using the editor"); ?></h3>

<table class="slidetoggle describe">
  <tr valign="top">
    <td class="A1B1">
      <p><img class="thumbnail" src="<?php echo $code_icon_url;?>" alt="" style="margin-top: 3px" /></a></p>
    </td>
    <td>
      <p><strong>File type:</strong> application/javascript</p>
    </td>
  </tr>
  <tr class="post_title">
    <th valign="top" scope="row" class="label"><label for="csp_script_file_name"><span class="alignleft">File Name</span><br class="clear" /></label></th>
    <td class="field"><input type="text" class="text" id="csp_script_file_name" name="csp_script_file_name" /></td>
  </tr>
  <tr class="post_content">
    <th valign="top" scope="row" class="label"><label for="csp_script_content"><span class="alignleft">Contents</span><br class="clear" /></label></th>
    <td class="field"><textarea type="text" id="csp_script_content" name="csp_script_content" rows="10" ></textarea></td>
  </tr>
  <tr class="submit">
    <td></td>
    <td class="savesend"><input type="submit" class="button" name="send-script" value="Insert into Post" /></td>
  </tr>
</table>
</form>
<?php
  if (isset($csp_errors["upload_error"])) {
    printf("<div id=\"media-upload-error\">%s</div>", $csp_errors["upload_error"]);
  }
}

// create a tab containing the script editor
function csp_display_script_editor_tab() {
  return wp_iframe("media_csp_display_script_editor", "script");
}

add_action("media_upload_script_editor", "csp_display_script_editor_tab");

// create a new uploaded file based on the script text editor contents
// cribbed from media_handle_upload which calls wp_handle_upload
function csp_create_script_upload() {
  global $csp_errors;

  if (!isset($_POST["csp_script_file_name"]))
    return;
  // security check
  check_admin_referer('csp-script-form');

  $post_id = (int)$_POST["post_id"];
  $time = current_time("mysql");
  if ($post = get_post($post_id)) {
    if (substr($post->post_date, 0, 4) > 0)
      $time = $post->post_date;
  }

  $name = mysql_real_escape_string($_POST["csp_script_file_name"]);

  // test that uploads dir is writable
  if ( !(( $uploads = wp_upload_dir($time) ) && false === $uploads['error']) ) {
    $csp_errors["upload_error"] = $uploads["error"];
    return;
  }

  $filename = wp_unique_filename($uploads["path"], $name, null);

  // create new file in the uploads dir
  $new_file = $uploads["path"] . "/" . $filename;
  $fp = fopen($new_file, "w");
  fwrite($fp, stripslashes($_POST["csp_script_content"]));
  fclose($fp);

  // set correct file permissions
  $stat = stat(dirname($new_file));
  $perms = $stat["mode"] & 0000666;
  @chmod($new_file, $perms);

  // compute the URL
  $url = $uploads["url"] . "/" . $filename;

  // Only works on trunk
  // if (is_multisite())
  //   delete_transient("dirsize_cache");

  // allow others the chance to filter the upload we created
  $file = apply_filters("wp_handle_upload", array("file" => $new_file, "url" => $url,
                                                  "type" => "application/javascript"),
                        "upload");

  if (isset($file["error"]))
    return new WP_Error("upload_error", $file["error"]);

  $name_parts = pathinfo($name);
  $name = trim(substr($name, 0, -(1 + strlen($name_parts["extension"]))));

  $url = $file["url"];
  $type = $file["type"];
  $file = $file["file"];
  $content = "";

  // construct the attachment array
  $attachment = array("post_mime_type" => $type,
                      "guid" => $url,
                      "post_parent" => $post_id,
                      "post_title" => $name,
                      "post_content" => $content);

  // update the DB with the file data
  $id = wp_insert_attachment($attachment, $file, $post_id);    

  // insert the new script file into the post
?>
<script type="text/javascript">
/* <![CDATA[ */
var win = window.dialogArguments || opener || parent || top;
win.send_to_editor('<script src=\'<?php echo $url; ?>\'><\/script>');
/* ]]> */
</script>
<?php
  die();
}

add_action("admin_init", "csp_create_script_upload");
?>
