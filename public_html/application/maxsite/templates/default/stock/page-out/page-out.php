<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://maxsite.org/
 * Класс для вывода записи
 
	# пример 1
	
	// подготавливаем объект для вывода записей
	$p = new Page_out;
 
	if ( $pages = mso_get_pages(array(параметры получения записей), $pagination) )
	{
		// зададим формат вывода каждого элемента
		// делать перед циклом поскольку он не меняется внутри
		
		// сброс формата к дефолтному, если необходимо
		$p->reset_format();
		
		// первым параметром указывается элемент
		// указаны дефолтные значения
		// если параметр совпадает с дефолтным, его можно не указывать
		
		# $p->format('title', '<h1>', '</h1>', true); // до, после, формировать ссылку
		# $p->format('date', 'Y-m-d H:i:s', '', ''); // формат даты, до, после
		# $p->format('cat', ', ', '', ''); // разделитель, до, после
		# $p->format('tag', ', ', '', ''); // разделитель, до, после
		# $p->format('feed', 'Подписаться', '', ''); // титул, до, после
		# $p->format('author', '', ''); // до, после
		# $p->format('edit', 'Редактировать', '', ''); // титул, до, после
		# $p->format('read', 'Читать дальше', '', ''); // титул, до, после
		# $p->format('comments', 'Обсудить', 'Посмотреть комментарии', '', ''); // без комментариев, есть комментарии, до, после
		
		
		// можно задать вывод по echo (по-умолчанию) или return
		# $p->echo = false; // данные будут возвращаться по return
		
		// напримре сменим вывод заголовка записи
		$p->format('title', '<h4>', '</h4>');
		
		// цикла вывода записей
		foreach ($pages as $page)
		{
			$p->load($page); // загружаем данные записи
			
			# 	Каждый вывод фо формату это line().
			# 	второй и третий параметры - до, после
			
			# 	[title] - заголовок записи
			# 	[date] - дата
			# 	[autor] - автор
			# 	[comments] - ссылка на комментарии
			# 	[cat] - рубрики
			# 	[tag] - метки
			# 	[edit] - ссылка на редактирование записи
			# 	[feed] - rss
			# 	[read] - аля-читать далее
			
			$p->line('[title]'); 
			$p->line('[date] | [autor] | [comments]', '<p>', '</p>');
			$p->line('[cat]', '<p>', '</p>');
			$p->line('[tag]', '<p>', '</p>');
			$p->line('[edit]', '<p>', '</p>');
			$p->line('[feed]', '<p>', '</p>');
			$p->line('[read]', '<p>', '</p>');
			

			// вывод контента - это отдельная функция
			// можно указать дополнительно до и после
			// до = <div class="page_content">  после = </div> 
			
			$p->content(); // просто обычный вывод 
			# $p->content_words(10); // обрезка по кол-ву слов
			# $p->content_chars(100); // обрезка по кол-ву символов
			
			// вывод указанной мета
			$p->meta('title', 'Титул: ');
			
			
			// можно получить значение указанной meta для дальнейшей работы
			# $meta_title = $p->meta_val('title');
			
			// можно получить значение любого ключа из $page
			# $id = $p->val('page_id')
			
			// можно вывести произвольный текст/html 
			# $p->html('<hr>');
			
			// аналог $p->line, только всегда возвращает результат по return
			# $cat = $p->line_r('[cat]');
			
			// можно вывести блок, обрамленный до, после, при условии, непустого содержимого
			# $bl = 'какой-то текст';
			# $p->block('<p>', '</p>', $bl); // если бы $bl == '', то ничего не выведет
			
			// можно вывести заголовок отдельной функцией
			# $p->title(NR . '<li>', '</li>');
		}
	}
 
	# пример 2
	
	$p = new Page_out;
 
	if ( $pages = mso_get_pages(array(параметры получения записей), $pagination) )
	{
		// цикла вывода записей
		foreach ($pages as $page)
		{
			$p->load($page); // загружаем данные записи

			$p->line('[title]'); 
			$p->line('[date] | [autor] | [comments] [edit]', '<p>', '</p>');
			
			// рубрики и метки выведем одним блоком (это пример использования line_r и block)
			$bl = $p->line_r('[cat]', 'Рубрики: ');
			$bl .= $p->line_r('[tag]', 'Метки: ');
			$p->block('<p>', '</p>', $bl);
			
			$p->line('[feed]', '<p>', '</p>');
			$p->line('[read]', '<p>', '</p>');

			$p->content();

			$p->meta('title', 'Титул: ');
			
			$p->html('hr');
			
		}

	}
 
	# пример 3 использование счетчика
	
	$p->reset_counter(count($pages)); // сбросить счетчик и утановить всего записей в цикле
	
	foreach()
	{
		$p->load($page);
		
		// можно сменить заголовок записи
		$p->page['page_title'] = '№' . $p->num . ' «' . $p->page['page_title'] . '»';
		
		$p->line('[title]');
		
		...
		
	
		if (!$p->last) $p->html('<hr>'); // если не последняя запись
	}

*/


class Page_out 
{
	protected $formats = array(); // массив форматов функций
	protected $def_formats = array(); // массив форматов дефолтный
	
	var $page = array(); // массив записи
	var $echo = true; // выводить результат по echo
	
	var $num = 0; // номер текущей записи в цикле
	var $max = 1; // всего записей в цикле
	var $last = false; // признак, что это последняя запись
	
	
	function __construct()
	{
		$this->reset_format();
	}
	
	// сброс форматов аргументов функций до дефолтного
	function reset_format()
	{
		// аргументы совпадают с mso_page_...
		// используются только те что нужно
		$this->def_formats = array(
			
			'title' => array // mso_page_title
				(
					'<h1>',
					'</h1>',
					true, // линк?
				),

			'date' => array
				(
					'Y-m-d H:i:s',
					'',
					''
				),

			'cat' => array
				(
					', ',
					'',
					''
				),

			'tag' => array
				(
					', ',
					'',
					''
				),

			'feed' => array
				(
					'Подписаться',
					'',
					''
				),

			'comments' => array
				(
					'Обсудить',
					'Посмотреть комментарии',
					'',
					''
				),

			'author' => array
				(
					'',
					'',
				),

			'edit' => array
				(
					'Редактировать',
					'',
					''
				),

			'read' => array
				(
					'Читать дальше',
					'',
					''
				)
		);
		
		$this->formats = $this->def_formats;
	}
	
	// принимаем массив записи
	function load($page = array())
	{
		$this->page = $page;
		
		$this->num++; // счетчик увеличим
		$this->last = ($this->num >= $this->max); // ставим признак true, если это последняя запись
	}
	
	// сбросить счетчики
	function reset_counter($max = 1)
	{
		$this->max = $max; // всего записей
		$this->num = 0; // счетчик
	}
	
	// возвращает значение указанного ключа массива $page
	function val($key)
	{
		if (isset($this->page[$key]))
			return $this->page[$key];
		else 
			return '';
	}
	
	
	// вспомогательная функция для вывода результатов
	protected function out($out)
	{
		if ($this->echo) echo $out;
		
		return $out;
	}
	
	// задание формата вывода
	// вывод по заданному формату осуществляется в $this->line()
	function format()
	{
		$numargs = func_num_args(); // кол-во аргументов переданных в функцию

		if ($numargs === 0) 
		{
			return; // нет аргументов, выходим
		}

		$args = func_get_args(); // массив всех полученных аргументов

		// заносим эти данные в свой массив форматов
		// первый аргумент всегда ключ функции - они предопределены как mso_page_...
		// параметры определяются в каждом конкретном случае
		$this->formats[$args[0]] = array_slice($args, 1);
		
		// сливаем с дефолтным, если есть такой же ключ
		if (isset($this->def_formats[$args[0]]))
		{
			$this->formats[$args[0]] = $this->formats[$args[0]] + $this->def_formats[$args[0]];
		}
	}
	
	// получение из массива formats массива ключа и проверка в нем указанного по номеру аргумента
	// номер аргумента функции начинается с 1
	function get_formats_args($key, $numarg)
	{
		if (isset($this->formats[$key][$numarg-1]))
		{
			return $this->formats[$key][$numarg-1];
		}
		else
		{
			return ''; // нет ключа
		}
	}
	
	// вывод данных по указанному в $out формату
	// $echo позволяет принудительно задать выдачу результата: true - по echo, false - return, 0 - как в $this->echo
	function line($out = '', $do = '', $posle = '', $echo = 0)
	{
		if (!$out) return;
		
		$title = '';
		$autor = '';
		$comments = '';
		$cat = '';
		$tag = '';
		$edit = '';
		$date = '';
		$read = '';
		$feed = '';
		
		// title
		if (strpos($out, '[title]') !== false)
		{
			$title = mso_page_title(
				$this->val('page_slug'), // данные из $page
				$this->val('page_title'), // данные из $page
				$this->get_formats_args('title', 1), // $do = '<h1>', 
				$this->get_formats_args('title', 2), // $posle = '</h1>',
				$this->get_formats_args('title', 3), // $link = true, 
				false);
		}
		
		
		// mso_page_author_link($users_nik = '', $page_id_autor = '', $do = '', $posle = '', $echo = true, $type = 'author', $link = true
		if (strpos($out, '[autor]') !== false)
		{
			$autor = mso_page_author_link(
				$this->val('users_nik'), // данные из $page
				$this->val('page_id_autor'), // данные из $page
				$this->get_formats_args('autor', 1), // $do = '', 
				$this->get_formats_args('autor', 2), // $posle = '',
				false);
		}
		
		// mso_page_comments_link($page_comment_allow = true, $page_slug = '', $title = 'Обсудить', $do = '', $posle = '', $echo = true, $type = 'page'
		if (strpos($out, '[comments]') !== false)
		{
			$comments = mso_page_comments_link(
				array(
				'page_comment_allow' => $this->val('page_comment_allow'), // разрешены комментарии?
				'page_slug' => $this->val('page_slug'), // короткая ссылка страницы
				
				// титул, если есть ссылка
				'title' => $this->get_formats_args('comments', 1) . ' ('. $this->val('page_count_comments') . ')', 
				
				// титул если комменты запрещены, но они есть
				'title_no_link' => $this->get_formats_args('comments', 2), 
				
				// титул если еще нет комментариев
				'title_no_comments' => $this->get_formats_args('comments', 1), 
				
				'do' => $this->get_formats_args('comments', 3), // текст ДО
				'posle' => $this->get_formats_args('comments', 4), // текст ПОСЛЕ
				'echo' => false, // выводить?
				'page_count_comments' => $this->val('page_count_comments') // колво комментов
				)
			);
		}
		
		// mso_page_cat_link($cat = array(), $sep = ', ', $do = '', $posle = '', $echo = true, $type = 'category', $link = true
		if (strpos($out, '[cat]') !== false)
		{
			$cat = mso_page_cat_link(
				$this->val('page_categories'), // данные из $page
				$this->get_formats_args('cat', 1), // $sep 
				$this->get_formats_args('cat', 2), // $do
				$this->get_formats_args('cat', 3), // $posle
				false);
		}
		
		// mso_page_tag_link($tags = array(), $sep = ', ', $do = '', $posle = '', $echo = true, $type = 'tag', $link = true
		if (strpos($out, '[tag]') !== false)
		{
			$tag = mso_page_tag_link(
				$this->val('page_tags'), // данные из $page
				$this->get_formats_args('tag', 1), // $sep 
				$this->get_formats_args('tag', 2), // $do
				$this->get_formats_args('tag', 3), // $posle
				false);
		}
		
		// edit
		// mso_page_edit_link($id = 0, $title = 'Редактировать', $do = '', $posle = '', $echo = true
		if (strpos($out, '[edit]') !== false)
		{
			$edit = mso_page_edit_link(
				$this->val('page_id'), // данные из $page
				$this->get_formats_args('edit', 1), // $title 
				$this->get_formats_args('edit', 2), // $do
				$this->get_formats_args('edit', 3), // $posle
				false);
				
				//pr($this->page);
		}
		
		
		// date
		//mso_page_date($date = 0, $format = 'Y-m-d H:i:s', $do = '', $posle = '', $echo = true
		if (strpos($out, '[date]') !== false)
		{
			$date = mso_page_date(
				$this->val('page_date_publish'), // данные из $page
					array('format' => tf($this->get_formats_args('date', 1)), // 'd/m/Y H:i:s'
							'days' => tf('Понедельник Вторник Среда Четверг Пятница Суббота Воскресенье'),
							'month' => tf('января февраля марта апреля мая июня июля августа сентября октября ноября декабря')), 
				$this->get_formats_args('date', 2), // $do
				$this->get_formats_args('date', 3), // $posle
				false);
		}
		
		
		// read
		// mso_page_title($page_slug = '', $page_title = 'no title', $do = '<h1>', $posle = '</h1>', $link = true, $echo = true, $type = 'page'
		if (strpos($out, '[read]') !== false)
		{
			$read = 
				  $this->get_formats_args('read', 2) // $do
				. $this->page_url(true)
				. $this->get_formats_args('read', 1) // 'читать далее'
				. $this->get_formats_args('read', 3) // $posle
				. '</a>';
		}							
		
		// feed
		// mso_page_feed($page_slug = '', $page_title = 'Подписаться', $do = '<p>', $posle = '</p>', $link = true, $echo = true, $type = 'page'
		if (strpos($out, '[feed]') !== false)
		{
			$feed = mso_page_feed(
				$this->val('page_slug'), // данные из $page
				$this->get_formats_args('feed', 1), // 'Подписаться'
				$this->get_formats_args('feed', 2), // $do
				$this->get_formats_args('feed', 3), // $posle
				true,
				false);
		}			
		
		$out = str_replace('[title]', $title, $out);
		$out = str_replace('[autor]', $autor, $out);
		$out = str_replace('[comments]', $comments, $out);
		$out = str_replace('[cat]', $cat, $out);
		$out = str_replace('[tag]', $tag, $out);
		$out = str_replace('[edit]', $edit, $out);
		$out = str_replace('[date]', $date, $out);
		$out = str_replace('[read]', $read, $out);
		$out = str_replace('[feed]', $feed, $out);
		
		if ($out) 
		{
			if ($echo === 0) return $this->out($do . $out . $posle);
			elseif ($echo === true) echo $do . $out . $posle;
			elseif ($echo === false) return $do . $out . $posle;
		}
	}
	
	// вывод контента
	function content($do = '<div class="page_content">', $posle = '</div>')
	{
		return $this->out($do . $this->val('page_content') . $posle);
	}
	
	// обрезка контента по кол-ву слов
	function content_words($max_words = 15, $cut = '', $do = '<div class="page_content">', $posle = '</div>')
	{
		return $this->out($do . mso_str_word(strip_tags($this->val('page_content')), $max_words) . $cut . $posle);
	}
	
	// обрезка контента по кол-ву символов
	function content_chars($max_chars = 100, $cut = '', $do = '<div class="page_content">', $posle = '</div>')
	{
		return $this->out($do . mb_substr(strip_tags($this->val('page_content')), 0, $max_chars, 'UTF-8') . $cut . $posle);
	}
	
	// вывод мета - только значение мета
	function meta_val($meta = '', $default = '', $razd = ', ')
	{
		// mso_page_meta_value($meta = '', $page_meta = array(), $default = '', $razd = ', '
		
		return mso_page_meta_value($meta, $this->val('page_meta'), $default, $razd);
	}
	
	// вывод мета
	function meta($meta = '', $do = '', $posle = '', $razd = ', ')
	{
		// mso_page_meta($meta = '', $page_meta = array(), $do = '', $posle = '', $razd = ', ', $echo = true
		
		return $this->out(mso_page_meta($meta, $this->val('page_meta'), $do, $posle, $razd, false));
	}	
	
	
	// вывод произвольного html
	function html($text = '')
	{
		$this->out($text);
	}
	
	// функция равна line, только всегда отдает по return
	function line_r($out = '', $do = '', $posle = '')
	{
		return $this->line($out, $do, $posle, false);
	}
	
	// вывод произвольного блока
	// только если $out содержит текст
	function block($do = '', $posle = '', $out = '')
	{
		if ($out) return $this->out($do . $out . $posle);
	}
	
	// для заголовка можно использовать отдельную функцию
	// в этом случае можно указать отдельные параметры
	// $echo работает как в line 
	function title($do = '<h1>', $posle = '</h1>', $link = true, $echo = 0)
	{
		$out = mso_page_title(
				$this->val('page_slug'), // данные из $page
				$this->val('page_title'), // данные из $page
				$do, 
				$posle,
				$link, 
				false);
		
		if ($out) 
		{
			if ($echo === 0) return $this->out($out);
			elseif ($echo === true) echo $out;
			elseif ($echo === false) return $out;
		}
	}
	
	
	// возвращает адрес записи
	// если $html_link = true, то формирует <a href="адрес">
	function page_url($html_link = false)
	{
		if ($html_link) 
			return '<a href="' . mso_page_url($this->val('page_slug')) . '">';
		else
			return mso_page_url($this->val('page_slug'));
	}
	
	
} // end  class Page_out 

# end file