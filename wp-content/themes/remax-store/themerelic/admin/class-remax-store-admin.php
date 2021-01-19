<?php
/**
 * Remax Store Admin Class.
 *
 * @author  Themerelic
 * @package Remax Store
 * @since   
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Remax_Store_Admin' ) ) :

/**
 * Remax_Store_Admin Class.
 */
class Remax_Store_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'About', 'remax-store' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'remax-store' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'remax-store-welcome', array( $this, 'welcome_screen' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		$RemaxStore = wp_get_theme();
		$Remax_Store_version = $RemaxStore->get( 'Version' );

		wp_enqueue_style( 'remax-store-welcome', get_template_directory_uri() . '/themerelic/admin/css/admin-welcome.css', array(), $Remax_Store_version );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $Remax_Store_version, $pagenow;

		wp_enqueue_style( 'remax-store-message', get_template_directory_uri() . '/themerelic/admin/css/admin-welcome.css', array(), $Remax_Store_version );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'remax_store_Admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'remax_store_Admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['remax-store-hide-notice'] ) && isset( $_GET['remax_store_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['remax_store_notice_nonce'], 'remax_store_hide_notices_nonce' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'remax-store' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'remax-store' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['remax-store-hide-notice'] );
			update_option( 'remax_store_Admin_notice_welcome' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated remax-store-message">
			<a class="remax-store-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'remax-store-hide-notice', 'welcome' ) ), 'remax_store_hide_notices_nonce', 'remax_store_notice_nonce' ) ); ?>"><?php echo  esc_html__( 'Dismiss', 'remax-store' ); ?></a>
			<p><?php printf( esc_html__( 'Welcome! Thank you for choosing Remax Store! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'remax-store' ), '<a href="' . esc_url( admin_url( 'themes.php?page=remax-store-welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=remax-store-welcome' ) ); ?>"><?php echo  esc_html__(  'Get started with Remax Store', 'remax-store' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		global $Remax_Store_version;
		$theme = wp_get_theme( get_template() );

		// Drop minor version if 0
		$major_version = substr( $Remax_Store_version, 0, 3 );
		?>
		<div class="remax-store-theme-info">
				<h1>
					<?php echo  esc_html__( 'About', 'remax-store'); ?>
					<?php echo $theme->display( 'Name' ); ?>
					<?php printf( '%s', $major_version ); ?>
				</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>

				<div class="remax-store-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>

		<p class="remax-store-actions">
			<!-- Theme Demo -->
			<a href="<?php echo esc_url( 'http://demo.themerelic.com/remax-store/' ); ?>" class="button button-secondary" target="_blank"><?php echo  esc_html__(  'Theme Demo', 'remax-store' ); ?></a>

			<!-- Theme Details -->
			<a href="<?php echo esc_url('https://themerelic.com/wordpress-themes/remax-store/'); ?>" class="button button-primary docs" target="_blank"><?php echo  esc_html__(  'Theme Details', 'remax-store' ); ?></a>

			<!-- Theme Documentaion  -->
			<a href="<?php echo esc_url( 'https://themerelic.github.io/remax-store/' ); ?>" class="button button-secondary docs" target="_blank"><?php echo  esc_html__(  'Documentation', 'remax-store' ); ?></a>

			<!-- Go To Pro -->
			<a href="<?php echo esc_url( 'http://demo.themerelic.com/remax-store/demo-2/' ); ?>" class="button button-primary docs" target="_blank"><?php echo  esc_html__(  'Remax Store Pro', 'remax-store' ); ?></a>
		</p>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'remax-store-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'remax-store-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo $theme->display( 'Name' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'supported_plugins' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'remax-store-welcome', 'tab' => 'supported_plugins' ), 'themes.php' ) ) ); ?>">
				<?php echo  esc_html__(  'Supported Plugins', 'remax-store' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'remax-store-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php echo  esc_html__(  'Free Vs Pro', 'remax-store' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'more_themes' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'remax-store-welcome', 'tab' => 'more_themes' ), 'themes.php' ) ) ); ?>">
				<?php echo  esc_html__(  'More Themes', 'remax-store' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'video_document' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'remax-store-welcome', 'tab' => 'video_document' ), 'themes.php' ) ) ); ?>">
				<?php echo  esc_html__(  'Video Document', 'remax-store' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'remax-store-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php echo  esc_html__(  'Changelog', 'remax-store' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
               
					<div class="col">
						<h3><?php echo  esc_html__(  'Theme Customizer', 'remax-store' ); ?></h3>
						<p><?php echo  esc_html__(  'All Theme Options are available via Customize screen.', 'remax-store' ) ?></p>
						<p><a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-secondary"><?php echo  esc_html__(  'Customize', 'remax-store' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php echo  esc_html__(  'Documentation', 'remax-store' ); ?></h3>
						<p><?php echo  esc_html__(  'Please view our documentation page to setup the theme.', 'remax-store' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://themerelic.github.io/remax-store/' ); ?>" class="button button-secondary"><?php echo  esc_html__(  'Documentation', 'remax-store' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php echo  esc_html__(  'Got theme support question?', 'remax-store' ); ?></h3>
						<p><?php echo  esc_html__(  'Please put it in our dedicated support forum.', 'remax-store' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://themerelic.com/' ); ?>" class="button button-secondary"><?php echo  esc_html__(  'Support', 'remax-store' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php echo  esc_html__(  'Need more features?', 'remax-store' ); ?></h3>
						<p><?php echo  esc_html__(  'Upgrade to PRO version for more exciting features.', 'remax-store' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://themerelic.com/wordpress-themes/remax-store/' ); ?>" class="button button-secondary"><?php echo  esc_html__(  'View PRO version', 'remax-store' ); ?></a></p>
					</div>

					<div class="col">
						<h3>
							<?php
							echo  esc_html__(  'Translate', 'remax-store' );
							echo ' ' . $theme->display( 'Name' );
							?>
						</h3>
						<p><?php echo  esc_html__(  'Click below to translate this theme into your own language.', 'remax-store' ) ?></p>
						<p>
							<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/remax-store' ); ?>" class="button button-secondary">
								<?php
								echo  esc_html__(  'Translate', 'remax-store' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</a>
						</p>
					</div>

				</div>
			</div>

			<div class="return-to-dashboard">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html__(  'Return to Updates', 'remax-store' ) :  esc_html__(  'Return to Dashboard &rarr; Updates', 'remax-store' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ?   esc_html__(  'Go to Dashboard &rarr; Home', 'remax-store' ) :  esc_html__(  'Go to Dashboard', 'remax-store' ); ?></a>
			</div>

		</div>
		<?php
	}

		/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php echo  esc_html__(  'View changelog below:', 'remax-store' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'Remax_Store_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}


	/**
	 * Output the supported plugins screen.
	 */
	public function supported_plugins_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php echo  esc_html__(  'This theme recommends following plugins:', 'remax-store' ); ?></p>
			<ol>
				<!-- Woocommerce Plugin -->
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/woocommerce/'); ?>" target="_blank"><?php echo  esc_html__( 'WooCommerce', 'remax-store'); ?></a>
					<?php echo  esc_html__( ' by Automattic', 'remax-store'); ?>
				</li>

				<!-- YITH WooCommerce Quick View -->
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/yith-woocommerce-quick-view/'); ?>" target="_blank"><?php echo  esc_html__( 'YITH WooCommerce Quick View', 'remax-store'); ?></a>
					<?php echo  esc_html__( ' by YITHEMES', 'remax-store'); ?>
				</li>

				<!-- YITH WooCommerce Compare -->
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/yith-woocommerce-compare/'); ?>" target="_blank"><?php echo  esc_html__( 'YITH WooCommerce Compare', 'remax-store'); ?></a>
					<?php echo  esc_html__( ' by YITHEMES', 'remax-store'); ?>
				</li>

				<!-- YITH WooCommerce Wishlist -->
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/yith-woocommerce-wishlist/'); ?>" target="_blank"><?php echo  esc_html__( 'YITH WooCommerce Wishlist', 'remax-store'); ?></a>
					<?php echo  esc_html__( ' by YITHEMES', 'remax-store'); ?>
				</li>

				<!-- Easy Google Fonts -->
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/easy-google-fonts/'); ?>" target="_blank"><?php echo  esc_html__( 'Easy Google Fonts', 'remax-store'); ?></a>
					<?php echo  esc_html__( ' by Easy Google Fonts', 'remax-store'); ?>
				</li>

				<!-- MailChimp for WordPress -->
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/mailchimp-for-wp/'); ?>" target="_blank"><?php echo  esc_html__( 'MailChimp for WordPress', 'remax-store'); ?></a>
					<?php echo  esc_html__( ' by ibericode', 'remax-store'); ?>
				</li>
				
				<!-- MailChimp for WordPress -->
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/woocommerce-grid-list-toggle/'); ?>" target="_blank"><?php echo  esc_html__( 'WooCommerce Grid / List toggle', 'remax-store'); ?></a>
					<?php echo  esc_html__( 'by  jameskoster', 'remax-store'); ?>
				</li>

				<!-- One Click Demo Import -->
				<li><a href="<?php echo esc_url('https://wordpress.org/plugins/one-click-demo-import/'); ?>" target="_blank"><?php echo  esc_html__( 'One Click Demo Import', 'remax-store'); ?></a>
					<?php echo  esc_html__( 'by  ProteusThemes', 'remax-store'); ?>
				</li>
				
				
			</ol>

		</div>
		<?php
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php echo  esc_html__(  'Upgrade to PRO version for more exciting features.', 'remax-store' ); ?></p>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php echo  esc_html__( 'Features', 'remax-store'); ?></h3></th>
						<th><h3><?php echo  esc_html__( 'remax-store', 'remax-store'); ?></h3></th>
						<th><h3 class="remax-store-pro-header"><a href="<?php echo esc_url('http://demo.themerelic.com/remax-store/demo-2/'); ?>"><?php echo  esc_html__( 'Remax Store Pro', 'remax-store'); ?></a></h3></th>
					</tr>
					
					<!-- Header Section -->					
					<tr>
						<td><h3><?php echo  esc_html__( 'Header Section', 'remax-store'); ?></h3></td>
						<td><span class="dashicons dashicons-yes"></span></td>
						<td><?php  echo  esc_html__( '3','remax-store') ?></span></td>
					</tr>


					<tr>
						<td><h3><?php echo  esc_html__( 'Fonts , Fonts Size , Text Color', 'remax-store'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php echo  esc_html__( '600+', 'remax-store'); ?></td>
					</tr>
					
					<tr>
						<td><h3><?php echo  esc_html__( 'Custom Archive Page Layout', 'remax-store'); ?></h3></td>
						<td><?php echo  esc_html__( '1', 'remax-store'); ?></h3></td>
						<td><?php echo  esc_html__( '3', 'remax-store'); ?></h3></td>
					</tr>

					<tr>
						<td><h3><?php echo  esc_html__( 'Newsletter PupUp Window Section', 'remax-store'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					
					<tr>
						<td><h3><?php echo  esc_html__( 'Products List Section', 'remax-store'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					
					<tr>
						<td><h3><?php echo  esc_html__( 'Products Tabs', 'remax-store'); ?></h3></td>
						<td><?php echo  esc_html__( '1', 'remax-store'); ?></td>
						<td><?php echo  esc_html__( '3', 'remax-store'); ?></td>
					</tr>
					
					<tr>
						<td><h3><?php echo  esc_html__( '14+ Different Widgets Layout', 'remax-store'); ?></h3></td>
						<td><?php echo  esc_html__( '7', 'remax-store'); ?></td>
						<td><?php echo  esc_html__( '14+', 'remax-store'); ?></td>
					</tr>

					

					<tr>
						<td><h3><?php echo  esc_html__( 'Edit The Footer Copyright Text', 'remax-store'); ?></h3></td>
						<td><span class="dashicons dashicons-no"></td>
						<td><span class="dashicons dashicons-yes"></td>
					</tr>Product Category Section
					
				

					

					
				</tbody>
			</table>

		</div>
		<?php
	}

	/**
	 * Output the more themes screen
	 */
	public function more_themes_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
			<div class="theme-browser rendered">
				<div class="themes wp-clearfix">
					<?php
						// Set the argument array with author name.
						$args = array(
							'author' => 'themerelic',
						);
						// Set the $request array.
						$request = array(
							'body' => array(
								'action'  => 'query_themes',
								'request' => serialize( (object)$args )
							)
						);
						$themes = $this->themerelic_get_themes( $request );
						$active_theme = wp_get_theme()->get( 'Name' );
						$counter = 1;

						// For currently active theme.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme == $theme->name ) { ?>

								<div id="<?php echo $theme->slug; ?>" class="theme active">
									<div class="theme-screenshot">
										<img src="<?php echo $theme->screenshot_url ?>"/>
									</div>
									<h3 class="theme-name" ><strong><?php _e( 'Active', 'remax-store' ); ?></strong>: <?php echo $theme->name; ?></h3>
									<div class="theme-actions">
										<a class="button button-primary customize load-customize hide-if-no-customize" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php _e( 'Customize', 'remax-store' ); ?></a>
									</div>
								</div><!-- .theme active -->
							<?php
							$counter++;
							break;
							}
						}

						// For all other themes.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme != $theme->name ) {
								// Set the argument array with author name.
								$args = array(
									'slug' => $theme->slug,
								);
								// Set the $request array.
								$request = array(
									'body' => array(
										'action'  => 'theme_information',
										'request' => serialize( (object)$args )
									)
								);
								$theme_details = $this->themerelic_get_themes( $request );
							?>
								<div id="<?php echo $theme->slug; ?>" class="theme">
									<div class="theme-screenshot">
										<img src="<?php echo $theme->screenshot_url ?>"/>
									</div>

									<h3 class="theme-name"><?php echo $theme->name; ?></h3>

									<div class="theme-actions">
										<?php if( wp_get_theme( $theme->slug )->exists() ) { ?>											
											<!-- Activate Button -->
											<a  class="button button-secondary activate"
												href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . $theme->slug );?>" ><?php _e( 'Activate', 'remax-store' ) ?></a>
										<?php } else {
											// Set the install url for the theme.
											$install_url = add_query_arg( array(
													'action' => 'install-theme',
													'theme'  => $theme->slug,
												), self_admin_url( 'update.php' ) );
										?>
											<!-- Install Button -->
											<a data-toggle="tooltip" data-placement="bottom" title="<?php echo 'Downloaded ' . number_format( $theme_details->downloaded ) . ' times'; ?>" class="button button-secondary activate" href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>" ><?php _e( 'Install Now', 'remax-store' ); ?></a>
										<?php } ?>

										<a class="button button-primary load-customize hide-if-no-customize" target="_blank" href="<?php echo $theme->preview_url; ?>"><?php _e( 'Live Preview', 'remax-store' ); ?></a>
									</div>
								</div><!-- .theme -->
								<?php
							}
						}


					?>
				</div>
			</div><!-- .end div -->
		</div><!-- .ena wrapper -->
		<?php
	}

	/** 
	 * Get all our themes by using API.
	 */
	private function themerelic_get_themes( $request ) {

		// Generate a cache key that would hold the response for this request:
		$key = 'Remax_Store_' . md5( serialize( $request ) );

		// Check transient. If it's there - use that, if not re fetch the theme
		if ( false === ( $themes = get_transient( $key ) ) ) {

			// Transient expired/does not exist. Send request to the API.
			$response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

			// Check for the error.
			if ( !is_wp_error( $response ) ) {

				$themes = unserialize( wp_remote_retrieve_body( $response ) );

				if ( !is_object( $themes ) && !is_array( $themes ) ) {

					// Response body does not contain an object/array
					return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
				}

				// Set transient for next time... keep it for 24 hours should be good
				set_transient( $key, $themes, 60 * 60 * 24 );
			}
			else {
				// Error object returned
				return $response;
			}
		}
		return $themes;
	}

	/**
	 * Output the about screen.
	 */
	public function video_document_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div style="margin-top:50px;" >
				<iframe width="100%" height="615" src="https://www.youtube.com/embed/w_nWIT8PKsI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>

		</div>
		<?php
	}


}

endif;

return new Remax_Store_Admin();
