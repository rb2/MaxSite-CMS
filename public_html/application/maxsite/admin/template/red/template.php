<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */


	# поскольку в хуках могут быть простой вывод данных через echo, следует 
	# включить буферизацию вывода на каждый хук
	
	// в теле контента можно определить хуки на остальные части 
	ob_start();
		$admin_content_hook = mso_hook('mso_admin_content', mso_admin_content());
		$admin_content = ob_get_contents() . $admin_content_hook;
	ob_end_clean();
	
	ob_start();
		$admin_header_hook = mso_hook('mso_admin_header', mso_admin_header());
		$admin_header = ob_get_contents() . $admin_header_hook;
	ob_end_clean();
	
	ob_start();
		$admin_menu_hook = mso_hook('mso_admin_menu', mso_admin_menu());
		$admin_menu = ob_get_contents() . $admin_menu_hook;
	ob_end_clean();
	
	ob_start();
		$admin_footer_hook = mso_hook('mso_admin_footer', mso_admin_footer());
		$admin_footer = ob_get_contents() . $admin_footer_hook;
	ob_end_clean();
	
	if (!$admin_header) $admin_header = t('Админ-панель', 'admin');
	
	$admin_css = getinfo('admin_url') . 'template/' . mso_get_option('admin_template', 'general', 'default') . '/style.css';
	$admin_css = mso_hook('admin_css', $admin_css);
	$admin_title = t('Админ-панель', 'admin') . ' - ' . mso_hook('admin_title', mso_head_meta('title'));
		
	
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title><?= $admin_title ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="<?= getinfo('siteurl') ?>favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?= $admin_css ?>" type="text/css" media="screen">
	<?= mso_load_jquery() ?>
	<?php mso_hook('admin_head') ?>
</head>
<body>
<div id="container">
	<div class="admin-header"><div class="r">
		<h1><a href="<?= getinfo('siteurl') ?>"><?= mso_get_option('name_site', 'general') ?></a></h1>
		<?= $admin_header ?>
	</div></div><!-- div class=admin-header -->
	
	<div id="mc">
		<div class="admin-menu"><div class="r">
		<?= $admin_menu ?>
		</div></div><!-- div class=admin-menu -->
		
		<div class="admin-content"><div class="r">
		<?= $admin_content ?>
		</div></div><!-- div class=admin-content -->
	</div><!-- div id="#mc" -->

	<div class="admin-footer"><div class="r">
		<?= $admin_footer ?>
	</div></div><!-- div class=admin-footer -->

</div><!-- div id="#container" -->
</body>
</html>