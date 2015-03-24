<?php
function geoip_detect_version_check() {
	global $wp_version;

	if (version_compare ( PHP_VERSION, GEOIP_REQUIRED_PHP_VERSION, '<' )) {
		$flag = 'PHP';
		$min = GEOIP_REQUIRED_PHP_VERSION;
		$yours = PHP_VERSION;
	} elseif (version_compare ( $wp_version, GEOIP_REQUIRED_WP_VERSION, '<' )) {
		$flag = 'WordPress';
		$min = GEOIP_REQUIRED_WP_VERSION;
		$yours = $wp_version;
	} else {
		return true;
	}

	if (WP_DEBUG)
		trigger_error('Plugin GeoIP Detection is disabled. Requires ' . $flag . ' ' .$min ." (you're using " . $flag . " " . $yours . ") ");

	add_action ( 'all_admin_notices', 'geoip_detect_version_minimum_requirements_notice' );

	return false;
}

function geoip_detect_version_minimum_requirements_notice() {
	global $wp_version;
	?>
<div class="error">
	<h3><?php _e( 'GeoIP Detection: Minimum requirements not met.', 'geoip-detect' ); ?></h3>
	<p>
		The plugin <strong>GeoIP Detection</strong> plugin requires PHP <?php echo GEOIP_REQUIRED_PHP_VERSION; ?> (you're using PHP <?php echo PHP_VERSION; ?>) and WordPress version <?php echo GEOIP_REQUIRED_WP_VERSION; ?> (you're using: <?php echo $wp_version; ?>) and therefore does exactly nothing.</p>
	<p>
		You can update, or install an <a
			href="https://github.com/yellowtree/wp-geoip-detect/releases">1.x
			legacy version</a> of this plugin instead.
	</p>
</div>
<?php
}