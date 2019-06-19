<?php
/*
Plugin Name: HQ Login Plus
Plugin URI: https://github.com/loghq/hq-login-plus/
Description: HQ Login Plus for WordPress login.
Author: LogHQ
Author URI: https://login.plus/
Version: 0.1
License: GPL3
Contributors: LogHQ
Tags: admin, login
Requires at least: 3.0
Tested up to: 4.9.2
Stable tag: 0.1
Donate link: https://paypal.me/loghq/
*/

/*

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/**
 * @package      HQ Login Plus
 * @contributors LogHQ
 * @author       LogHQ
 * @author uri   http://login.plus/
 * @license      GPL3
 * @version      0.1
 * @link         https://login.plus/
 * @tags         admin, login
 * @donate link: http://paypal.me/loghq
 */
define ('HQLOGINPLUS_GROUP', 'hqloginplus');
define ('HQLOGINPLUS_PAGE', 'hqloginplus_admin');
define ('HQLOGINPLUS_SECTION', 'hqloginplus_section');
define ('HQLOGINPLUS_OPTIONS', 'hqloginplus_options');
define ('HQLOGINPLUS_LOCAL', 'hqloginplus');

$hqloginplus_options = array ();


/**
 *
 * @global type $hqloginplus_options
 * @return type 
 */
function hqloginplus_get_options () {
	
	global $hqloginplus_options;
	
	if (empty ($hqloginplus_options)) {
		$hqloginplus_options = get_option (HQLOGINPLUS_OPTIONS);
	}
	
	return $hqloginplus_options;
	
}


/**
 * 
 */
 
	
function hqloginplus () {
	
	$hqloginplus_options = hqloginplus_get_options ();


	// default wordpress mu plugin path
	$pluginPath = '/wp-content/mu-plugins/';
	
	// is it wordpress mu or wordpress normal?
	if (!is_dir ($pluginPath)) {
		$pluginPath = '/wp-content/plugins/';
	}

	$pluginUrl = get_option ('siteurl') . $pluginPath . plugin_basename (dirname (__FILE__)) ;
	
	// output styles
	echo '<link rel="stylesheet" type="text/css" href="' . $pluginUrl . '/hqloginplus.css" />';
	echo '<style>';
	
	/*


	// text colour
	if (!empty ($hqloginplus_options['hqloginplus_color'])) {
?>
	#login,
	#login label {
		color:#<?php echo $hqloginplus_options['hqloginplus_color']; ?>;
	}
<?php
	}

	// text colour
	if (!empty ($hqloginplus_options['hqloginplus_backgroundColor'])) {
?>
	html,
	body.login {
		background-color:#<?php echo $hqloginplus_options['hqloginplus_backgroundColor']; ?>;
	}
<?php
	}
	*/
	$background = $hqloginplus_options['hqloginplus_background'];
	
	if (!empty ($background)) {
?>
	.login,body.login {
		background:url(<?php echo $background; ?>) left top no-repeat;
        background-size:cover;
	}
<?php
	}else{
?>
        .login,body.login {
                background:url('<?php echo $pluginUrl; ?>/images/save_mountains.jpg') left top no-repeat;
                
        background-size:cover;
        }
<?php
        }
/*
	// text colour
	if (!empty ($hqloginplus_options['hqloginplus_linkColor'])) {
?>
	.login #login a {
		color:#<?php echo $hqloginplus_options['hqloginplus_linkColor']; ?> !important;
	}
<?php
	}
	*/
	echo '#loginform p {color: white !important;}'; // jetpack msg font color fix
	echo 'a{color:#66ffff;}';
	echo '</style>';
}


/**
 * 
 */
function hqloginplus_url () {

    echo bloginfo ('url');
	
}


/**
 * 
 */
function hqloginplus_title () {
	
	$hqloginplus_options = hqloginplus_get_options ();
	
	if (empty ($hqloginplus_options['hqloginplus_poweredby'])) {
	    echo printf (__('%s', HQLOGINPLUS_LOCAL), get_option('blogname'));
	} else {
		echo $hqloginplus_options['hqloginplus_poweredby'];
	}
	
}


/**
 * 
 */
function hqloginplus_admin_add_page () {
	
	add_options_page ('HQ Login Plus', 'HQ Login Plus', 'manage_options', HQLOGINPLUS_PAGE, 'hqloginplus_options');	
}


/**
 * 
 */
function hqloginplus_options () {
?>
	
<style>
	.wrap {
		position:relative;
	}
	
	.hqloginplus_notice {
		padding:10px 20px;
		-moz-border-radius:3px;
		-webkit-border-radius:3px;
		border-radius:3px;
		background:lightyellow;
		border:1px solid #e6db55;
		margin:10px 5px 10px 0;
	}
	
	.hqloginplus_notice h3 {
		margin-top:5px;
		padding-top:0;
	}
	
	.hqloginplus_notice li {
		list-style-type:disc;
		margin-left:20px;
	}
</style>

<div class="wrap">
	<div class="icon32" id="icon-options-general"><br /></div>
	<h2>HQ Login Plus Options</h2>
	
	<div class="hqloginplus_notice">
		<h3>More WordPress Goodies &rsaquo;</h3>
		<p>Please send us your feedback on <a href="https://login.plus/" target="_blank">Login.plus</a><br />
		</p>
	</div>
	
	<form action="options.php" method="post">
<?php	
	settings_fields (HQLOGINPLUS_GROUP);
	do_settings_sections (HQLOGINPLUS_PAGE);
?>
		<p class="submit">
			<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" class="button-primary" />	
		</p>
	</form>
	<div>
	        <h3>Screenshot</h3>
	  <?php      
        $pluginPath = '/wp-content/mu-plugins/'; // default wordpress mu plugin path	
        if (!is_dir ($pluginPath)) { // is it wordpress mu or wordpress normal?
	        $pluginPath = '/wp-content/plugins/'; 
        }
	$pluginUrl = get_option ('siteurl') . $pluginPath . plugin_basename (dirname (__FILE__)) ;
	?>
	        <img src="<?php echo $pluginUrl; ?>/screenshot-1.png" alt="Login Page" />
	        <br /><br /><br />
	</div>
</div>

<?php
}


/**
 * 
 */
function hqloginplus_init () {
	
	$vars = hqloginplus_get_options ();
		
	register_setting (HQLOGINPLUS_GROUP, HQLOGINPLUS_OPTIONS, 'hqloginplus_validate');
	add_settings_section (HQLOGINPLUS_SECTION, __('Login Screen Settings', HQLOGINPLUS_LOCAL), 'hqloginplus_section_validate', HQLOGINPLUS_PAGE);

	add_settings_field (
		'hqloginplus_background',
		__('Background Image Url:', HQLOGINPLUS_LOCAL),
		'hqloginplus_form_text',
		HQLOGINPLUS_PAGE,
		HQLOGINPLUS_SECTION,
		array (
			'id' => 'hqloginplus_background',
			'value' => $vars,
			'default' => '',
			'description' => __('URL path to image to use for background. You can upload your image with the media uploader', HQLOGINPLUS_LOCAL),
		)
	);
/*
	add_settings_field (
		'hqloginplus_poweredby',
		__('Powered by:', HQLOGINPLUS_LOCAL),
		'hqloginplus_form_text',
		HQLOGINPLUS_PAGE,
		HQLOGINPLUS_SECTION,
		array (
			'id' => 'hqloginplus_poweredby',
			'value' => $vars,
			'default' => 'Powered by DoSurfIn',
			'description' => '',
		)
	);

	add_settings_field (
		'hqloginplus_backgroundColor',
		__('Page Background Color:', HQLOGINPLUS_LOCAL),
		'hqloginplus_form_text',
		HQLOGINPLUS_PAGE,
		HQLOGINPLUS_SECTION,
		array (
			'id' => 'hqloginplus_backgroundColor',
			'value' => $vars,
			'default' => 'eeeeee',
			'description' => __('6 digit hex color code', HQLOGINPLUS_LOCAL),
		)
	);
	
	add_settings_field (
		'hqloginplus_color',
		__('Text Color:', HQLOGINPLUS_LOCAL),
		'hqloginplus_form_text',
		HQLOGINPLUS_PAGE,
		HQLOGINPLUS_SECTION,
		array (
			'id' => 'hqloginplus_color',
			'value' => $vars,
			'default' => 'ffffff',
			'description' => __('6 digit hex color code', HQLOGINPLUS_LOCAL),
		)
	);
	
	add_settings_field (
		'hqloginplus_linkColor',
		__('Text Link Color:', HQLOGINPLUS_LOCAL),
		'hqloginplus_form_text',
		HQLOGINPLUS_PAGE,
		HQLOGINPLUS_SECTION,
		array (
			'id' => 'hqloginplus_linkColor',
			'value' => $vars,
			'default' => 'ffffff',
			'description' => __('6 digit hex color code', HQLOGINPLUS_LOCAL),
		)
	);
	*/
}


/**
 *
 * @param type $fields
 * @return type 
 */
function hqloginplus_validate ($fields) {

	// colour validation
	$fields['hqloginplus_color'] = str_replace ('#', '', $fields['hqloginplus_color']);
	//$fields['hqloginplus_color'] = str_pad ('f', 6, $fields['hqloginplus_color'], STR_PAD_RIGHT);
	$fields['hqloginplus_color'] = substr ($fields['hqloginplus_color'], 0, 6);
	
	// background colour validation
	$fields['hqloginplus_backgroundColor'] = str_replace ('#', '', $fields['hqloginplus_backgroundColor']);
	//$fields['hqloginplus_backgroundColor'] = str_pad ('f', 6, $fields['hqloginplus_backgroundColor'], STR_PAD_RIGHT);
	$fields['hqloginplus_backgroundColor'] = substr ($fields['hqloginplus_backgroundColor'], 0, 6);
	
	// colour validation
	$fields['hqloginplus_linkColor'] = str_replace ('#', '', $fields['hqloginplus_linkColor']);
	//$fields['hqloginplus_linkColor'] = str_pad ('f', 6, $fields['hqloginplus_linkColor'], STR_PAD_RIGHT);
	$fields['hqloginplus_linkColor'] = substr ($fields['hqloginplus_linkColor'], 0, 6);
	
	// clean image urls
	$fields['hqloginplus_background'] = esc_url_raw ($fields['hqloginplus_background']);
	
	// sanitize powered by message
	$fields['hqloginplus_poweredby'] = esc_html ($fields['hqloginplus_poweredby']);
	$fields['hqloginplus_poweredby'] = strip_tags ($fields['hqloginplus_poweredby']);
	
	return $fields;
	
}


/**
 *
 * @param type $fields
 * @return type 
 */
function hqloginplus_section_validate ($fields) {
	
	return $fields;
	
}


/**
 *
 * @param type $args 
 */
function hqloginplus_form_text ($args) {
	
	// defaults
	$id = '';
	$value = '';
	$description = '';
	
	// set values
	if (!empty ($args['value'][$args['id']])) {
		$value = $args['value'][$args['id']];
	} else {
		if (!empty ($args['default'])) {
			$value = $args['default'];				
		}
	}
	
	if (!empty ($args['description'])) {
		$description = $args['description'];
	}
	
	$id = $args['id'];
?>
	<input type="text" id="<?php echo $id; ?>" name="<?php echo HQLOGINPLUS_OPTIONS; ?>[<?php echo $id; ?>]" value="<?php echo $value; ?>" class="regular-text"/>
<?php
	if (!empty ($description)) {
		echo '<br /><span class="description">' . $description . '</span>';
	}
	
}


function hqloginplus_footer() {

        $pluginPath = '/wp-content/mu-plugins/'; // default wordpress mu plugin path	
        if (!is_dir ($pluginPath)) { // is it wordpress mu or wordpress normal?
	        $pluginPath = '/wp-content/plugins/'; 
        }
	$pluginUrl = get_option ('siteurl') . $pluginPath . plugin_basename (dirname (__FILE__)) ;
	echo '<div >Thank you for supporting <a href="https://login.plus/" title="HQ Login Plus" style="padding: 1px 1px 1px 20px;background:url('.$pluginUrl.'/images/loginplus-icon.png) left top no-repeat;">"HQ Login Plus"</a> and mountains.  <br /></div>';
}


add_action ('admin_init', 'hqloginplus_init');
add_action ('admin_menu', 'hqloginplus_admin_add_page');
add_action ('login_head', 'hqloginplus');
//add_filter ('login_headerurl', 'hqloginplus_url');
//add_filter ('login_headertitle', 'hqloginplus_title');
add_action( 'in_admin_footer', 'hqloginplus_footer' );

function hq_login_plus_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'hq_login_plus_logo_url' );

function hq_login_plus_logo_url_title() {
    $blog_title = get_bloginfo();
    return $blog_title;
    
}




function hq_login_plus_login_head_img() {
 
    if ( has_custom_logo() ){
        
        $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        $padding_top =  absint( $image[2] ) + 10;
        ?>
        <style>
            .login h1 a {
                background-image: url(<?php echo esc_url( $image[0] ); ?>) !important;
                background-repeat: no-repeat !important;
                -webkit-background-size: <?php echo absint( $image[1] )?>px !important;
                background-size: <?php echo absint( $image[1] ) ?>px !important;
                /*height: <?php echo absint( $image[2] ); ?>px !important;*/
                height: 30px !important;
                width: <?php echo absint( $image[1] ); ?>px !important;
                padding-top: <?php echo $padding_top; ?>px !important;
                font-size: 19px !important;
                font-weight: 450 !important;
            }
        </style>
        <?php
    } else {
            
        add_filter( 'login_headerheader', 'hq_login_plus_logo_url_title' );
            
    }
    
}
 
add_action( 'login_head', 'hq_login_plus_login_head_img', 100 );
