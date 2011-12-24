<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	if (!mso_hook_present('main_menu')) // для отладки убрать ! в условии
	{ ?>
		<div id="MainMenu">
			<ul class="menu">
				<?php

					$menu = mso_get_option('top_menu', 'templates', t('/ | Главная_NR_about | О сайте_NR_comments | Комментарии_NR_contact | Контакты_NR_sitemap | Архив_NR_feed | RSS', 'templates'));
					
					if (is_login())
					{
						$menu .= NR . '[';
						$menu .= NR . 'admin | ' . getinfo('users_nik') . ' | Админ-панель | icon icon-admin';
						$menu .= NR . 'admin/page_new | Создать запись';
						$menu .= NR . 'admin/page | Список записей';
						$menu .= NR . 'admin/cat | Рубрики';
						$menu .= NR . 'admin/plugins | Плагины';
						$menu .= NR . 'admin/files | Загрузки';
						$menu .= NR . 'admin/sidebars | Сайдбары';
						$menu .= NR . 'admin/options | Основные настройки';
						$menu .= NR . 'admin/template_options | Настройка шаблона';
						$menu .= NR . 'http://max-3000.com/page/faq | ЧАВО для новичков';
						$menu .= NR . 'http://max-3000.com/help | Центр помощи';
						$menu .= NR . 'http://forum.max-3000.com/ | Форум поддержки';
						$menu .= NR . 'logout | Выход';
						$menu .= NR . ']';
					}
					elseif (is_login_comuser())
					{
						$comuser = is_login_comuser();
						
						$menu .= NR . '[';
						
						if ($comuser['comusers_nik'])
							$menu .= NR . '# | ' . $comuser['comusers_nik'];
						else
							$menu .= NR . '# | Ваши ссылки';
						
						$menu .= NR . 'users/' . $comuser['comusers_id'] . ' | Своя страница';
						$menu .= NR . 'http://max-3000.com/page/faq | ЧАВО для новичков';
						$menu .= NR . 'http://max-3000.com/help | Центр помощи';
						$menu .= NR . 'http://forum.max-3000.com/ | Форум поддержки';
						$menu .= NR . 'logout | Выход';
						$menu .= NR . ']';

					}

					if ($menu) echo mso_menu_build($menu, 'selected', false);
				?>
			</ul>
	</div><!-- div id="MainMenu" -->
	<?php 
	} 
	else 
	{
		// если есть логин, то добавляем свои пункты меню
		if (is_login())
		{
			function _my_users_main_menu_custom($menu = '')
			{
				$menu .= NR . '[';
				$menu .= NR . 'admin | ' . getinfo('users_nik') . ' | Админ-панель | icon icon-admin';
				$menu .= NR . 'admin/page_new | Создать запись';
				$menu .= NR . 'admin/page | Список записей';
				$menu .= NR . 'admin/cat | Рубрики';
				$menu .= NR . 'admin/plugins | Плагины';
				$menu .= NR . 'admin/files | Загрузки';
				$menu .= NR . 'admin/sidebars | Сайдбары';
				$menu .= NR . 'admin/template_options | Настройка шаблона';
				$menu .= NR . 'http://max-3000.com/page/faq | ЧАВО для новичков';
				$menu .= NR . 'http://max-3000.com/help | Центр помощи';
				$menu .= NR . 'http://forum.max-3000.com/ | Форум поддержки';
				$menu .= NR . 'logout | Выход';
				$menu .= NR . ']';
				
				return $menu;
			}
			
			mso_hook_add( 'main_menu_custom', '_my_users_main_menu_custom');
		}
		elseif (is_login_comuser())
		{
			function _my_comusers_main_menu_custom($menu = '')
			{
				$comuser = is_login_comuser();
				
				$menu .= NR . '[';
				
				if ($comuser['comusers_nik'])
					$menu .= NR . '# | ' . $comuser['comusers_nik'];
				else
					$menu .= NR . '# | Ваши ссылки';
				
				$menu .= NR . 'users/' . $comuser['comusers_id'] . ' | Своя страница';
				$menu .= NR . 'http://max-3000.com/page/faq | ЧАВО для новичков';
				$menu .= NR . 'http://max-3000.com/help | Центр помощи';
				$menu .= NR . 'http://forum.max-3000.com/ | Форум поддержки';
				$menu .= NR . 'logout | Выход';
				$menu .= NR . ']';
				
				return $menu;
			}
			
			mso_hook_add( 'main_menu_custom', '_my_comusers_main_menu_custom');	
				
		}

		mso_hook('main_menu'); 
	}
	
?>