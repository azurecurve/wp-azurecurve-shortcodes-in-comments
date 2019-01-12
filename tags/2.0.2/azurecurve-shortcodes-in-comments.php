<?php
/*
Plugin Name: azurecurve Shortcodes In Comments
Plugin URI: http://development.azurecurve.co.uk/plugins/shortcodes-in-comments

Description: Allows shortcodes to be used in comments.
Version: 2.0.2

Author: azurecurve
Author URI: http://development.azurecurve.co.uk

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.


The full copy of the GNU General Public License is available here: http://www.gnu.org/licenses/gpl.txt

*/

//include menu
require_once( dirname(  __FILE__ ) . '/includes/menu.php');

add_filter( 'comment_text', 'shortcode_unautop');
add_filter( 'comment_text', 'do_shortcode' );


// azurecurve menu
function azc_create_sic_plugin_menu() {
	global $admin_page_hooks;
    
	add_submenu_page( "azc-plugin-menus"
						,"Shortcodes in Comments"
						,"Shortcodes in Comments"
						,'manage_options'
						,"azc-sic"
						,"azc_sic_settings" );
}
add_action("admin_menu", "azc_create_sic_plugin_menu");

function azc_sic_settings() {
	if (!current_user_can('manage_options')) {
		$error = new WP_Error('not_found', __('You do not have sufficient permissions to access this page.' , 'azc_pa'), array('response' => '200'));
		if(is_wp_error($error)){
			wp_die($error, '', $error->get_error_data());
		}
    }
	?>
	<div id="azc-t-general" class="wrap">
			<h2>azurecurve Shortcodes in Comments</h2>
			<p>
				<?php _e('This plugin allows shortcodes to be used in comments.', 'azc_pa'); ?>
			</p>
			<p>
				azurecurve <?php _e('has a sister plugin to this one which allows shortcodes to be used in widgets:', 'azc_md'); ?>
				<ul class='azc_plugin_index'>
					<li>
						<?php
						if ( is_plugin_active( 'azurecurve-shortcodes-in-widgets/azurecurve-shortcodes-in-widgets.php' ) ) {
							echo "<a href='admin.php?page=azc-siw' class='azc_plugin_index'>Shortcodes in Widgets</a>";
						}else{
							echo "<a href='https://wordpress.org/plugins/azurecurve-shortcodes-in-widgets/' class='azc_plugin_index'>Shortcodes in Widgets</a>";
						}
						?>
					</li>
				</ul>
			</p>
	</div>
	
<?php
}

?>