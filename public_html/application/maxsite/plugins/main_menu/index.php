<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */


# функция автоподключения плагина
function main_menu_autoload()
{
	mso_hook_add( 'main_menu', 'main_menu_custom');
	mso_hook_add( 'head', 'main_menu_head');
	mso_hook_add( 'admin_init', 'main_menu_admin_init'); # хук на админку
}

# функция выполняется при активации (вкл) плагина
function main_menu_activate($args = array())
{	
	mso_create_allow('main_menu_edit', t('Админ-доступ к редактированию MainMenu'));
	return $args;
}

# функция выполняется при деинсталяции плагина
function main_menu_uninstall($args = array())
{	
	mso_delete_option('plugin_main_menu', 'plugins' ); // удалим созданные опции
	mso_remove_allow('main_menu_edit'); // удалим созданные разрешения
	return $args;
}

# функция отрабатывающая миниопции плагина (function плагин_mso_options)
# если не нужна, удалите целиком
function main_menu_mso_options() 
{
	if ( !mso_check_allow('main_menu_edit') ) 
	{
		echo t('Доступ запрещен');
		return $args;
	}
	
	# ключ, тип, ключи массива
	mso_admin_plugin_options('plugin_main_menu', 'plugins', 
		array(
			'menu_default' => array(
							'type' => 'checkbox', 
							'name' => 'Пункты меню задаются в «Настройках шаблона»', 
							'description' => 'В этом случае пункты меню ниже не будут учитываться.', 
							'default' => '1'
						),
			'menu_admin' => array(
							'type' => 'checkbox', 
							'name' => 'Пункт Admin', 
							'description' => 'Нужно ли добавлять пункт Admin в конце меню, если вы вошли в систему', 
							'default' => '1'
						),
		
			'menu' => array(
							'type' => 'textarea', 
							'name' => 'Пункты меню', 
							'description' => 'Укажите полные адреса в меню и через | название ссылки. Каждый пункт в одной строчке.<br>Пример: http://maxsite.org/ | Блог Макса<br> Для группы меню используйте [ для открытия и ] для закрытия группы выпадающих пунктов. Например:<pre>[<br># | Медиа<br>audio | Аудио<br>video | Видео<br>photo | Фото<br>]</pre>', 
							'default' => ''
						),
			
			),
		'Настройки плагина Main menu', // титул
		'Укажите необходимые опции.'   // инфо
	);
}

# функции плагина
function main_menu_head($arg = array())
{
	echo mso_load_jquery();
	
	echo mso_load_jquery('ddsmoothmenu.js');
	
	if (file_exists(getinfo('template_dir') . 'main-menu.css'))
		echo NR . '	<link rel="stylesheet" href="' . getinfo('template_url') . 'main-menu.css' . '" type="text/css" media="screen">
	';
	elseif (file_exists(getinfo('template_dir') . 'css/main-menu.css'))
		echo NR . '	<link rel="stylesheet" href="' . getinfo('template_url') . 'css/main-menu.css' . '" type="text/css" media="screen">
	';
	else
		echo NR . '	<link rel="stylesheet" href="' . getinfo('plugins_url') . 'main_menu/main-menu.css' . '" type="text/css" media="screen">
	';
	
	
}

# функции плагина
function main_menu_custom($arg = array())
{

	$options = mso_get_option('plugin_main_menu', 'plugins', array());
	
	 
	if (!isset($options['menu_default'])) $options['menu_default'] = false;
	if (!isset($options['menu'])) $options['menu'] = '';
	if (!isset($options['menu_admin'])) $options['menu_admin'] = true;
	
	// используются пункты из настроек шаблона
	if ($options['menu_default'])
	{
		$menu_default = mso_get_option('top_menu', 'templates', '');
		if ($menu_default) $options['menu'] = $menu_default;
	}
	
	if (!$options['menu']) return $arg;
	
	// для динамического изменения меню используем хук 
	$options['menu'] = mso_hook('main_menu_custom', $options['menu']);
	
	$menu = mso_menu_build($options['menu'], 'selected', (bool) $options['menu_admin']);
	
	if ($menu)
		echo '
		<div id="MainMenu">
			<div id="smoothmenu1" class="ddsmoothmenu">
				<ul>
				' . $menu . '
				</ul>
			</div>
		</div>
	';
	
	return $arg;
}


# подключим страницу опций, как отдельную ссылку
function main_menu_admin_init($args = array()) 
{
	if ( mso_check_allow('main_menu_edit') ) 
	{
		$this_plugin_url = 'plugin_options/main_menu'; // url и hook
		mso_admin_menu_add('plugins', $this_plugin_url, t('Меню (Main menu)'));
		mso_admin_url_hook ($this_plugin_url, 'plugin_main_menu');
	}
	
	return $args;
}

# end file