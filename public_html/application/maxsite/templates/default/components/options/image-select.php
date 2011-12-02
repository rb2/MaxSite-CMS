<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	

function component_image_select()
{
	$subdir = mso_get_option('default_header_image', 'templates', '-template-');

	if ($subdir == '-template-')  // каталог шаблона
		$imgs = get_path_files(getinfo('template_dir') . 'images/headers/', getinfo('template_url') . 'images/headers/', false);
	else
		$imgs = get_path_files(getinfo('uploads_dir') . $subdir . '/', getinfo('uploads_url') . $subdir . '/', false); // каталог в uploads
		
	
	return implode($imgs, '#');
	
}