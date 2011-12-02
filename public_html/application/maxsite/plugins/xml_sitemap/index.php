<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

/*
приоритеты и обновление:
	главная - 1 daily
	страница (не blog) - 0.7 monthly
	запись (blog) - 0.5 weekly
	рубрика - 0.3 weekly
*/


# функция автоподключения плагина
function xml_sitemap_autoload($args = array())
{
	mso_hook_add( 'edit_category', 'xml_sitemap_custom');
	mso_hook_add( 'new_category', 'xml_sitemap_custom');
	mso_hook_add( 'delete_category', 'xml_sitemap_custom');
	mso_hook_add( 'new_page', 'xml_sitemap_custom');
	mso_hook_add( 'edit_page', 'xml_sitemap_custom');
}

# функция выполняется при активации (вкл) плагина
function xml_sitemap_activate($args = array())
{	
	xml_sitemap_custom();
	return $args;
}


# функция плагина
function xml_sitemap_custom($args = array())
{
	// создание sitemap.xml
	
	$t = "\t";
	
	$CI = & get_instance();
	$CI->load->helper('file'); // хелпер для работы с файлами

	// временная зона сайта в формат +03:00 из 3.00
	$time_zone = getinfo('time_zone'); // 3.00 -11.00;
	$znak = ( (int) $time_zone >= 0) ? '+' : '-';
	$time_zone = abs($time_zone);
	if ($time_zone == 0) $time_zone = '0.0';
	$time_zone = trim( str_replace('.', ' ', $time_zone) );
	$time_z = explode(' ', $time_zone);
	if (!isset($time_z[0])) $time_z[0] = '0';
	if (!isset($time_z[1])) $time_z[1] = '0';
	if ($time_z[0] < 10) $time_z[0] = '0' . $time_z[0];
	if ($time_z[1] < 10) $time_z[1] = '0' . $time_z[1];
	$time_zone = $znak . $time_z[0] . ':' . $time_z[1];
	
	$url = getinfo('siteurl');
	
	
	$out = '<'
	. '?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>' . $url . '</loc>
		<lastmod>' . date('Y-m-d') . 'T' . date('H:i:s') . $time_zone . '</lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
';
	
	// страницы не blog
	$CI->db->select('page_slug, page_last_modified');
	$CI->db->where('page_type_name !=', 'blog');
	$CI->db->where('page_status', 'publish');
	$CI->db->where('page_date_publish <', mso_date_convert('Y-m-d H:i:s', date('Y-m-d H:i:s')));
	$CI->db->join('page_type', 'page_type.page_type_id = page.page_type_id', 'left');
	$CI->db->order_by('page_last_modified', 'desc');
	$query = $CI->db->get('page');
	if ($query->num_rows()>0)
	{
		foreach ($query->result_array() as $row)
		{
			$date = str_replace(' ', 'T', $row['page_last_modified']) . $time_zone;
			
			$out .= $t . '<url>' . NR;
			$out .= $t . $t . '<loc>' . $url . 'page/' . $row['page_slug'] . '</loc>' . NR;
			$out .= $t . $t . '<lastmod>' . $date . '</lastmod>' . NR;
			$out .= $t . $t . '<changefreq>monthly</changefreq>' . NR;
			$out .= $t . $t . '<priority>0.7</priority>' . NR;
			$out .= $t . '</url>' . NR;
		}
	}
	

	// страницы blog
	$CI->db->select('page_slug, page_last_modified');
	$CI->db->where('page_type_name', 'blog');
	$CI->db->where('page_status', 'publish');
	$CI->db->where('page_date_publish <', mso_date_convert('Y-m-d H:i:s', date('Y-m-d H:i:s')));
	$CI->db->join('page_type', 'page_type.page_type_id = page.page_type_id', 'left');
	$CI->db->order_by('page_last_modified', 'desc');
	$query = $CI->db->get('page');
	if ($query->num_rows()>0)
	{
		foreach ($query->result_array() as $row)
		{
			$date = str_replace(' ', 'T', $row['page_last_modified']) . $time_zone;
			
			$out .= $t . '<url>' . NR;
			$out .= $t . $t . '<loc>' . $url . 'page/' . $row['page_slug'] . '</loc>' . NR;
			$out .= $t . $t . '<lastmod>' . $date . '</lastmod>' . NR;
			$out .= $t . $t . '<changefreq>weekly</changefreq>' . NR;
			$out .= $t . $t . '<priority>0.5</priority>' . NR;
			$out .= $t . '</url>' . NR;
		}
	}	
	
	// рубрики
	$CI->db->where('category_type', 'page');
	$query = $CI->db->get('category');
	if ($query->num_rows()>0)
	{
		$date = date('Y-m-d') . 'T' . date('H:i:s') . $time_zone;
		
		foreach ($query->result_array() as $row)
		{
			// $date = str_replace(' ', 'T', date('Y-m-d')) . $time_zone;
			
			$out .= $t . '<url>' . NR;
			$out .= $t . $t . '<loc>' . $url . 'category/' . $row['category_slug'] . '</loc>' . NR;
			$out .= $t . $t . '<lastmod>' . $date . '</lastmod>' . NR;
			$out .= $t . $t . '<changefreq>weekly</changefreq>' . NR;
			$out .= $t . $t . '<priority>0.3</priority>' . NR;
			$out .= $t . '</url>' . NR;
		}
	}		
	
	// все метки
	require_once( getinfo('common_dir') . 'meta.php' );
	$alltags = mso_get_all_tags_page();
	foreach ($alltags as $tag => $count) 
    {
		$out .= $t . '<url>' . NR;
		$out .= $t . $t . '<loc>' . $url . 'tag/' . htmlentities(urlencode($tag)) . '</loc>' . NR;
		$out .= $t . $t . '<lastmod>' . $date . '</lastmod>' . NR;
		$out .= $t . $t . '<changefreq>weekly</changefreq>' . NR;
		$out .= $t . $t . '<priority>0.3</priority>' . NR;
		$out .= $t . '</url>' . NR;
    }
		
	// и все комюзеры
	$CI->db->select('comusers_id');
	$query = $CI->db->get('comusers');
	if ($query->num_rows() > 0)	
	{	
		foreach ($query->result_array() as $row)
		{
			$out .= $t . '<url>' . NR;
			$out .= $t . $t . '<loc>' . $url . 'users/' . $row['comusers_id'] . '</loc>' . NR;
			$out .= $t . $t . '<lastmod>' . $date . '</lastmod>' . NR;
			$out .= $t . $t . '<changefreq>weekly</changefreq>' . NR;
			$out .= $t . $t . '<priority>0.3</priority>' . NR;
			$out .= $t . '</url>' . NR;
		}
	}
	
	// и все юзеры
	$CI->db->select('users_id');
	$query = $CI->db->get('users');
	if ($query->num_rows() > 0)	
	{	
		foreach ($query->result_array() as $row)
		{
			$out .= $t . '<url>' . NR;
			$out .= $t . $t . '<loc>' . $url . 'author/' . $row['users_id'] . '</loc>' . NR;
			$out .= $t . $t . '<lastmod>' . $date . '</lastmod>' . NR;
			$out .= $t . $t . '<changefreq>weekly</changefreq>' . NR;
			$out .= $t . $t . '<priority>0.3</priority>' . NR;
			$out .= $t . '</url>' . NR;
		}
	}
	
	$out .= mso_hook('xml_sitemap'); // хук, если нужно добавить свои данные
	
	$out .= NR . '</urlset>' . NR;
	
	$fn = getinfo('FCPATH') . 'sitemap.xml';
	write_file($fn, $out);

	return $args; // для обеспечения цепочки хуков
}

# end file