<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

# основной файл html-структуры

# секция HEAD
if (file_exists(getinfo('template_dir') . 'custom/head-section.php')) 
	require(getinfo('template_dir') . 'custom/head-section.php'); // подключение HEAD из файла
elseif (function_exists('mso_default_head_section')) mso_default_head_section(); // подключение через функцию

?>
<body>
<!-- end header -->
<?php mso_hook('body_start') ?>
<?php if (function_exists('ushka')) echo ushka('body_start'); ?>
<?php if (file_exists(getinfo('template_dir') . 'custom/body-start.php')) 
			require(getinfo('template_dir') . 'custom/body-start.php'); ?>

<div class="all">
	<div class="all-wrap">
		<div class="section header-main">

			<?php if (function_exists('ushka')) echo ushka('header-pre'); ?>

			<div class="header">
				<div class="header-wrap">
				<?php 

					if (file_exists(getinfo('template_dir') . 'custom/header-start.php')) 
						require(getinfo('template_dir') . 'custom/header-start.php');
					
					if (function_exists('ushka')) echo ushka('header-start');

					if ($fn = get_component_fn('default_header_component1', 'logo-links.php')) require($fn);

					if ($fn = get_component_fn('default_header_component2', 'menu.php')) require($fn);

					if ($fn = get_component_fn('default_header_component3', 'image-slider.php')) require($fn);
					
					if ($fn = get_component_fn('default_header_component4')) require($fn);
					
					if ($fn = get_component_fn('default_header_component5')) require($fn);
					
					if (function_exists('ushka')) echo ushka('header-end');
					
					if (file_exists(getinfo('template_dir') . 'custom/header-end.php')) 
						require(getinfo('template_dir') . 'custom/header-end.php'); 

				?>
				</div><!-- div class="header-wrap" -->
			</div><!-- div class="header" -->

			<?php if (function_exists('ushka')) echo ushka('header-out'); ?>
			
			<div class="section article main">
				<div class="main-wrap">
					<?php 
						if (file_exists(getinfo('template_dir') . 'custom/content-start.php')) 
							require(getinfo('template_dir') . 'custom/content-start.php'); 
						
						if (function_exists('ushka')) echo ushka('content-start');
					?>
					
					<div class="content">
						<div class="content-wrap">
						<?php 
					
							if (function_exists('ushka')) echo ushka('main-out-start');
							
							if (file_exists(getinfo('template_dir') . 'custom/main-out-start.php')) 
								require(getinfo('template_dir') . 'custom/main-out-start.php');
								
							if (file_exists(getinfo('template_dir') . 'custom/main-out.php')) 
								require(getinfo('template_dir') . 'custom/main-out.php');
							else
							{ 
								global $MAIN_OUT; 
								echo $MAIN_OUT; 
							}
							
							if (function_exists('ushka')) echo ushka('main-out-end');
							
							if (file_exists(getinfo('template_dir') . 'custom/main-out-end.php')) 
								require(getinfo('template_dir') . 'custom/main-out-end.php');
						?>
						</div><!-- div class="content-wrap" -->
					</div><!-- div class="content" -->
					
					<?php
						if (file_exists(getinfo('template_dir') . 'custom/sidebars.php')) 
							require(getinfo('template_dir') . 'custom/sidebars.php'); 
						else
						{
							echo '<div class="aside sidebar sidebar1"><div class="sidebar1-wrap">';
							mso_show_sidebar('1');
							echo '</div><!-- div class="sidebar1-wrap" --></div><!-- div class="aside sidebar sidebar1" -->';
						}
					?>

					<div class="clearfix"></div>
					
				</div><!-- div class="main-wrap" -->
			</div><!-- div class="section article main" -->
		</div><!-- div class="section header-main" -->

		<div class="footer-do-separation"></div>
		
		<?php if (function_exists('ushka')) echo ushka('footer-pre'); ?>
		
		<div class="footer">
			<div class="footer-wrap">
			<?php 
				
				if (file_exists(getinfo('template_dir') . 'custom/footer-start.php')) 
					require(getinfo('template_dir') . 'custom/footer-start.php');
				
				if (function_exists('ushka')) echo ushka('footer-start');
				
				if ($fn = get_component_fn('default_footer_component1', 'footer-copyright.php')) require($fn);

				if ($fn = get_component_fn('default_footer_component2', 'footer-statistic.php')) require($fn);

				if ($fn = get_component_fn('default_footer_component3')) require($fn);

				if ($fn = get_component_fn('default_footer_component4')) require($fn);

				if ($fn = get_component_fn('default_footer_component5')) require($fn); 
				
				if (function_exists('ushka')) echo ushka('footer-end');
				
				if (file_exists(getinfo('template_dir') . 'custom/footer-end.php')) 
					require(getinfo('template_dir') . 'custom/footer-end.php'); 
				
			?>
			</div><!-- div class="footer-wrap" -->
		</div><!-- div class="footer" -->
	</div><!-- div class="all-wrap" -->
</div><!-- div class="all" -->

<?php if (file_exists(getinfo('template_dir') . 'custom/body-end.php')) 
			require(getinfo('template_dir') . 'custom/body-end.php'); ?>
			
<?php 
	if (function_exists('ushka')) 
	{
		echo ushka('google_analytics'); 
		echo ushka('body_end');
	} 
	
	mso_hook('body_end'); 
?>
</body></html>