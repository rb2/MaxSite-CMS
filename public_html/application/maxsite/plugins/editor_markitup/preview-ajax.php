<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 


if ( $post = mso_check_post(array('data')) )
{
	$output = $post['data'];
	
	$output = trim($output);
	$output = str_replace(chr(10), "<br>", $output);
	$output = str_replace(chr(13), "", $output);
				
	$output = mso_hook('content', $output);
	$output = mso_hook('content_auto_tag', $output);
	$output = mso_hook('content_balance_tags', $output);
	$output = mso_hook('content_out', $output);
	$output = mso_hook('content_content', $output);
	
	$css_link = getinfo('plugins_url') . 'editor_markitup/preview.css';
	
	echo <<<EOF
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
	<title>Предпросмотр</title>
	<meta http-equiv="X-UA-Compatible" content="IE=8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="generator" content="MaxSite CMS">
	<link rel="stylesheet" href="{$css_link}" type="text/css" media="screen">
</head><body>
<div id="all">
	<div class="all-wrap">

{$output}

	</div><!-- div class=class-wrap -->
</div><!-- div id=all -->
</body></html>
EOF;

	
}