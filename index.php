<?php
/*
Plugin Name: Wp postviews data delete
Plugin URI: https://www.wpajans.net
Description: Wp Postviews plugin data delete  counter reset.
Version: 1.0
Author: WpAJANS
Author URI: https://www.wpajans.net
License: GNU
*/




function my_plugin_init() {
  load_plugin_textdomain( 'wp-postviews-delete', false, 'wp-postviews-delete/languages' );
}
add_action('init', 'my_plugin_init');

add_action('admin_menu', 'wpajans_wppvdcrplugin');
 
function wpajans_wppvdcrplugin()
 {
 add_options_page('Wp-postviews Data delete','Wp-postviews Data delete', '8', 'wpajans_wppvdcr', 'wpajans_wppvdcrfunc');
 }
 
 function wpajans_wppvdcrfunc() {
 ## Translte Text ##
$dashboard_text = __('Dashboard', 'wp-postviews-delete');
$settings_text = __('Settings', 'wp-postviews-delete');
$other_text = __('Other Plugins', 'wp-postviews-delete');
$redirecting_text = __('Redirecting, please wait.', 'wp-postviews-delete');
$dashboard_desc_text = __('Hi, thanks for download my plugin.', 'wp-postviews-delete');
$total_row = __('Total row', 'wp-postviews-delete');
$data_delete = __('Data Delete', 'wp-postviews-delete');
$data_delete_button = __('Now Data Delete', 'wp-postviews-delete');
$data_deleted = __('Row Deleted', 'wp-postviews-delete');
$no_data = __('Sorry, no data stored in your database.', 'wp-postviews-delete');
$not_install_plugin = __('Oops! plese <a href="https://wordpress.org/plugins/wp-postviews/" target="_blank">Wp-postviews</a> Plugin Install.', 'wp-postviews-delete');
## functions ##
$current_link = 'http://'.$_SERVER['HTTP_HOST' ].$_SERVER['REQUEST_URI']; 
 ?>
 		<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'css/normalize.css', __FILE__ );?>" />
 		<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'css/demo.css', __FILE__ );?>" />
 		<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'css/tabs.css', __FILE__);?>" />
 		<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'css/tabstyles.css', __FILE__);?>" />
 		<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'js/modernizr.custom.js', __FILE__);?>" />
 <svg class="hidden">
			<defs>
				<path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"/>
			</defs>
		</svg>
		<div class="container">
			<!-- Top Navigation -->		
			<section>
				<div class="tabs tabs-style-flip">
					<nav>

						<ul>
							<li><a href="#section-flip-5"><img class="wpajans_icon_style" src="<?php echo plugins_url( 'images/dashboard.png', __FILE__ );?>"><span><?php echo $dashboard_text;?></span></a></li>
							<li><a href="#section-flip-4"><img class="wpajans_icon_style" src="<?php echo plugins_url( 'images/settings.png', __FILE__ );?>"><span><?php echo $settings_text;?></span></a></li>
							<li><a href="<?php echo admin_url( 'plugin-install.php?tab=search&type=author&s=truser'); ?>"><img class="wpajans_icon_style" src="<?php echo plugins_url( 'images/moreplugins.png', __FILE__ );?>"><span><?php echo $other_text;?></span></a></li>

						</ul>
					</nav>
					<div class="content-wrap">
						<section id="section-flip-1"><p style="margin: 0;padding: 0.75em 0;color: rgba(41, 41, 41, 0.56);font-weight: 900;font-size: 1em;line-height: 1;"><?php echo $dashboard_desc_text;?></p>
						
<?php
$file = get_headers(plugins_url( 'wp-postviews/wp-postviewsd.php', dirname(__FILE__) ));
if( $file['0'] == 'HTTP/1.1 200 OK' ) {
} else {
echo'<div style="text-align: left;padding: 8px;/* color: #fff; */background: #E8E8E8;" class="error">'.$not_install_plugin.'</div>';
}
?>
						 <?php if($_GET["action"]=="row_delete"){

global $wpdb;
$begeni_list = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='views'" );
if($wpdb->num_rows<=0)
{
echo'<div style="text-align: left;padding: 8px;/* color: #fff; */background: #E8E8E8;" class="error">'.$no_data.'</div>';
}else
{
global $wpdb;
$deleteds = $wpdb->delete($wpdb->prefix.'postmeta',array('meta_key'=>'views'));
    if($deleteds){
echo'<div id="message" style="text-align: left;padding: 8px;/* color: #fff; */background: #E8E8E8;" class="updated notice notice-success is-dismissible below-h2">'.$data_deleted.'.<button type="button" class="notice-dismiss"><span class="screen-reader-text">This Hidden Message</span></button></div>';
 
}
}
}
?></section>
						<section id="section-flip-2"><p style="margin: 0;padding: 0.75em 0;color: rgba(41, 41, 41, 0.56);font-weight: 900;font-size: 1em;line-height: 1;text-align:left"><?php echo $total_row;?> : <?php global $wpdb;
$user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->postmeta where meta_key='views'" );
echo $user_count;?> <br> <br> <?php echo $data_delete;?> : <a href="<?php echo $current_link;?>&action=row_delete" class="button"><?php echo $data_delete_button;?></a>
						<br>
						</p></section>
						<section id="section-flip-3"><p class="wpajans_tab_redirecting" style="margin: 0;padding: 0.75em 0;color: rgba(41, 41, 41, 0.56);font-weight: 900;font-size: 2em;line-height: 1;"><?php echo $redirecting_text;?>

						</p></section>
						<section id="section-flip-4"><p >4</p></section>
						<section id="section-flip-5"><p>5</p></section>
					</div><!-- /content -->
				</div><!-- /tabs -->
			</section>
			
		</div><!-- /container -->

		<script src="<?php echo plugins_url( 'js/cbpFWTabs.js', __FILE__);?>"></script>
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
 <?php }
?>
