<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

%%% - замените на имя плагина


# функция автоподключения плагина
function %%%_autoload()
{

}

# функция выполняется при активации (вкл) плагина
function %%%_activate($args = array())
{	
	mso_create_allow('%%%_edit', t('Админ-доступ к настройкам %%%'));
	return $args;
}

# функция выполняется при деактивации (выкл) плагина
function %%%_deactivate($args = array())
{	
	// mso_delete_option('plugin_%%%', 'plugins' ); // удалим созданные опции
	return $args;
}

# функция выполняется при деинсталяции плагина
function %%%_uninstall($args = array())
{	
	mso_delete_option('plugin_%%%', 'plugins' ); // удалим созданные опции
	mso_remove_allow('%%%_edit'); // удалим созданные разрешения
	return $args;
}

# функция отрабатывающая миниопции плагина (function плагин_mso_options)
# если не нужна, удалите целиком
function %%%_mso_options() 
{
	if ( !mso_check_allow('%%%_edit') ) 
	{
		echo t('Доступ запрещен');
		return;
	}
	
	# ключ, тип, ключи массива
	mso_admin_plugin_options('plugin_%%%', 'plugins', 
		array(
			'option1' => array(
							'type' => 'text', 
							'name' => t('Название'), 
							'description' => t('Описание'), 
							'default' => ''
						),
			),
		'Настройки плагина %%%', // титул
		'Укажите необходимые опции.'   // инфо
	);
	
	/*
	# пример использования
	
	mso_admin_plugin_options('my_plugin', 'plugins', 
		array(
			'f1' => array(
							'type' => 'text', 
							'name' => 'название', 
							'description' => 'описание', 
							'default' => ''
						),
			'f2' => array(
							'type' => 'textarea', 
							'name' => 'название', 
							'description' => 'описание', 
							'default' => ''
						),					
			'f3' => array(
							'type' => 'checkbox', 
							'name' => 'название', 
							'description' => 'описание', 
							'default' => '1' // для чекбоксов только 1 и 0
						),						
			'f4' => array(
							'type' => 'select', 
							'name' => 'название', 
							'description' => 'описание',
							'values' => '0.00||Гринвич (0) # 1.00||что-то # 2.00||Киев (+2) # 3.00||Москва (+3)',  // правила для select как в ini-файлах
							'default' => '2.00'
						),	
			)
	);
		
	*/
}

# функции плагина
function %%%_custom($arg = array())
{

	
}

# end file