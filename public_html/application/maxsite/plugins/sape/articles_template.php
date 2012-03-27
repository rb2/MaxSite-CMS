<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

mso_head_meta('title', '{title}');
mso_head_meta('description', '{description}');
mso_head_meta('keywords', '{keywords}');

require(getinfo('template_dir') . 'main-start.php');

echo '<h1>{header}</h1>';
echo '{body}';

require(getinfo('template_dir') . 'main-end.php');
	
# end file