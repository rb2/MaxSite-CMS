<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

# функция автоподключения плагина
function template_options_autoload($args = array())
{
	global $MSO;
	
	mso_create_allow('template_options_admin', t('Доступ к настройкам шаблона', 'admin'));
	
	if (is_type('admin'))
	{
		$fn = $MSO->config['templates_dir'] . $MSO->config['template'] . '/options.php';
		
		if (file_exists($fn)) 
			mso_hook_add( 'admin_init', 'template_options_admin_init'); # хук на админку
	}
}

# функция выполняется при указаном хуке admin_init
function template_options_admin_init($args = array()) 
{
	if ( !mso_check_allow('template_options_admin') ) return $args;
	
	$this_plugin_url = 'template_options'; // url и hook
	mso_admin_menu_add('options', $this_plugin_url, t('Настройка шаблона', 'admin'));
	mso_admin_url_hook ($this_plugin_url, 'template_options_admin_page');
	
	return $args;
}

# функция вызываемая при выборе пункта меню 'Настройка шаблона'
function template_options_admin_page($args = array()) 
{
	global $MSO;
	
	if ( !mso_check_allow('template_options_admin') ) return $args;
	
	# подключаем options.php из шаблона
	$fn = $MSO->config['templates_dir'] . $MSO->config['template'] . '/options.php';
	require_once($fn);
}

function template_options_uninstall() 
{
	mso_remove_allow('template_options_admin');
}


?>