<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	$CI = & get_instance();
	$plugin_url = getinfo('site_url') . 'admin/samborsky_polls/';
	require_once (getinfo('plugins_dir') . 'samborsky_polls/functions.php');

?>

<div class="admin-h-menu">
	<a href="<?= $plugin_url ?>list" class="select">Управление голосованиями</a>&nbsp;|&nbsp;
	<a href="<?= $plugin_url ?>manage" class="select">Добавить новое</a>&nbsp;|&nbsp;
	<a href="<?= $plugin_url ?>settings" class="select">Настройки</a>
</div>


	<?php

	// подключение стилей и скриптов
	function polls_admin_head(){
		$path = getinfo('plugins_url') .'samborsky_polls/';
		echo <<<EOFA

			<!-- Стили админки -->
		<link rel="stylesheet" href="${path}css/style_admin.css" type="text/css" media="screen" charset="utf-8">
		
EOFA;
	
		
	}
	
	function polls_admin_head_list(){
		$path = getinfo('plugins_url') .'samborsky_polls/';
		$nmb_rec = (int)mso_get_option('polls_admin_number_records', 'plugins', 15);
		$list_ajax = getinfo('ajax') .base64_encode('plugins/samborsky_polls/' .'/list-ajax.php');
		
		
		echo <<<EOFL

			<!-- JS скрипт админки -->
		<script type="text/javascript" src="${path}js/admin.js"></script>
			<!-- jQuery TableSorter + Pagination -->
		<script type="text/javascript">var nmb_rec = {$nmb_rec};</script>
		<script type="text/javascript" src="${path}js/jTPS.js"></script>
		<script type="text/javascript">
			var list_ajax = "{$list_ajax}";
			$(document).ready(function(){
				$('.samborsky_polls_table').jTPS({perPages:[nmb_rec],perPageText:'Голосований на странице: '});
			});
		</script>

EOFL;
	}

	function polls_admin_head_manage(){
		$path = getinfo('plugins_url') .'samborsky_polls/';
		echo <<<EOFM

			<!-- JS скрипт админки -->
		<script src="${path}js/admin.js"></script>
			<!-- jQuery UI (DatePicker) -->
		<script type="text/javascript" src="${path}js/jquery-ui-1.8.16.custom.min.js"></script>
		<link rel="stylesheet" href="${path}css/jquery-ui-1.8.16.custom.css" type="text/css" media="screen">
		<script type="text/javascript">
			$(function() {
				$( "#sortable_polls" ).sortable();
				$( "#sortable123_polls" ).disableSelection();
				$( "#beginDate, #expiryDate" ).datepicker();
			});
		</script>

EOFM;

	}

	$seg = mso_segment(3);

	if( empty($seg) ){
		require(getinfo('plugins_dir') . 'samborsky_polls/list.php');
		mso_hook_add('admin_head', 'polls_admin_head_list');
		mso_hook_add('admin_head', 'polls_admin_head');		
	}
	else if( $seg == 'manage' ){
		require(getinfo('plugins_dir') . 'samborsky_polls/manage.php');
		mso_hook_add('admin_head', 'polls_admin_head_manage');
		mso_hook_add('admin_head', 'polls_admin_head');	
	}
	else if( $seg == 'list' ){
		require(getinfo('plugins_dir') . 'samborsky_polls/list.php');
		mso_hook_add('admin_head', 'polls_admin_head_list');
		mso_hook_add('admin_head', 'polls_admin_head');
	}
	else if( $seg == 'logs' ){
		require(getinfo('plugins_dir') . 'samborsky_polls/logs.php');
		mso_hook_add('admin_head', 'polls_admin_head');	
	}
	else if( $seg == 'settings' ){
		require(getinfo('plugins_dir') . 'samborsky_polls/settings.php');
	}


?>
