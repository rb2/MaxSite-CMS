<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

# функция автоподключения плагина
function pre_to_ol_autoload($args = array())
{
	mso_hook_add( 'content_out', 'pre_to_ol_custom'); # хук на вывод контента
}

function pre_to_ol_callback($matches) 
{
	global $flag_code;
	
	$php_replace = array(
			'function_exists' => '<b>function_exists</b>', 
			'function' => '<b>function</b>', 
			'foreach' => '<b>foreach</b>', 
			'endforeach' => '<b>endforeach</b>', 
			'true' => '<b>true</b>', 
			'false' => '<b>false</b>', 
			'endif' => '<b>endif</b>', 
			'if' => '<b>if</b>', 
			'else' => '<b>else</b>', 
			'isset' => '<b>isset</b>', 
			'explode' => '<b>explode</b>', 
			'return' => '<b>return</b>', 
			'count' => '<b>count</b>', 
			'global' => '<b>global</b>',
			'echo' => '<b>echo</b>',
			'include' => '<b>include</b>',
			'print' => '<b>print</b>',
			'exit' => '<b>exit</b>',
			'stristr' => '<b>stristr</b>',
			'<?php' => '<b><?php</b>',
			'&lt;?php' => '<b>&lt;?php</b>',
			'?&gt;' => '<b>?&gt;</b>',
			'?>' => '<b>?></b>',
			'new ' => '<b>new </b>',
			'var ' => '<b>var </b>',
			'class ' => '<b>class </b>',
			'as ' => '<b>as </b>',
			'continue' => '<b>continue</b>',
			'__FUNCTION__' => '<b>__FUNCTION__</b>',
			'$_GET' => '<b>$_GET</b>',
			'$_POST' => '<b>$_POST</b>',
			'md5' => '<b>md5</b>',
			'serialize' => '<b>serialize</b>',
			'ob_start' => '<b>ob_start</b>',
			'define' => '<b>define</b>',
			'endwhile' => '<b>endwhile</b>',
			'while' => '<b>while</b>',
			'trim' => '<b>trim</b>',
			'unset' => '<b>unset</b>',
			'implode' => '<b>implode</b>',
			'ob_get_flush' => '<b>ob_get_flush</b>',
			'strtolower' => '<b>strtolower</b>',
			'str_replace' => '<b>str_replace</b>',
			'array_keys' => '<b>array_keys</b>',
			'in_array' => '<b>in_array</b>',
			'array(' => '<b>array</b>(',
			'//' => '<span class="php-comment">//</span>',
			'# ' => '<span class="php-comment"># </span>',
			'/*' => '<span class="php-comment">/*</span>',
			'*/' => '<span class="php-comment">*/</span>',
			"\t" => '    ',
	);	
	
	
	if ( isset($matches[1]) )
	{
		$t = trim($matches[1]);
		
		# если это <code>, то заменяем в нем тэги
		if ($flag_code)
		{
			$t = strtr($t, array(
								chr(13) => '',
								"\p" => '', 
								"</p>\n" => "\n", 
								"\n<p>" => "\n", 
								'<p>' => "", 
								'</p>' => "", 
								
								'<br>' => "", 
								'<br />' => "", 
								
								'< ?' => '&lt;?', 
								'<code>' => '---', 
								'<pre>' => '---', 
								
								"'" => '&#039;',
								'\"' => '&quot;',
								'\\' => '\\\\',
								
								'<' => '&lt;',
								'>' => '&gt;', 	
								
															
								) );
			$t = trim($t);
			// $t = htmlspecialchars($t);
		}

		$t = explode("\n", $t);
		
		$alt = true;
		foreach ($t as $k => $v )
		{
			$v = strtr($v, $php_replace); 
			
			if ($alt) 
			{
				$t[$k] = '<li class="odd">&nbsp;' . $v . "</li>";
				$alt = false;
			}
			else 
			{
				$t[$k] = '<li>&nbsp;' . $v . "</li>";
				$alt = true;
			}
			
		}
		
		$t = implode("\n", $t);
		
		return '<div class="pre"><ol class="pre">' . $t ."</ol></div>\n";
	}
}


function pre_to_ol_custom($text) 
{
	global $flag_code;
	
	$flag_code = false;
	$pattern = '|<pre>(.*?)</pre>|si';
	$text = preg_replace_callback($pattern, 'pre_to_ol_callback', $text);

	$flag_code = true;
	$pattern = '|<code>(.*?)</code>|si';
	$text = preg_replace_callback($pattern, 'pre_to_ol_callback', $text);

	unset($flag_code);
	
	return $text;
}

?>