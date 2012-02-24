<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

mso_cur_dir_lang('templates');

?>

<div class="comment-form">

	<form method="post">
		<input type="hidden" name="comments_page_id" value="<?= $page_id ?>">
		<?= mso_form_session('comments_session') ?>

		<div class="comments-textarea">
		
			<?php  if (is_login()) { ?>
				<input type="hidden" name="comments_user_id" value="<?= getinfo('users_id') ?>">
				<div class="comments-user">
					<?=t('Привет')?>, <?= getinfo('users_nik') ?>! <a href="<?= getinfo('siteurl') ?>logout"><?=t('Выйти')?></a>
				</div>
			<?php } // автор ?>
		
		
			<?php if ($comuser = is_login_comuser()) { ?>
				<input type="hidden" name="comments_email" value="<?= $comuser['comusers_email'] ?>">
				<input type="hidden" name="comments_password" value="<?= $comuser['comusers_password'] ?>">
				<input type="hidden" name="comments_password_md" value="1">
				<input type="hidden" name="comments_reg" value="reg">
				
				<div class="comments-user comments-comuser">
					<?php
						if (!$comuser['comusers_nik']) echo t('Привет!');
							else echo t('Привет,') . ' <a href="' .getinfo('siteurl') . 'users/' . $comuser['comusers_id'] . '">' . $comuser['comusers_nik'] . '</a>!';
					?> 
					<a href="<?= getinfo('siteurl') ?>logout"><?=t('Выйти')?></a>
				</div>
			<?php }  // комюзер ?>
		
			<?php mso_hook('comments_content_start') ?>
			<textarea name="comments_content" id="comments_content" rows="10"></textarea>
			
		<?php  if (!is_login() and (!$comuser = is_login_comuser())) { // нет залогирования ?>

			<div class="comments-auth">
				
						<?php if ($allow_comment_anonim = mso_get_option('allow_comment_anonim', 'general', '1') ) { ?>
						
							<p class="radio">
							
							<?php if (mso_get_option('allow_comment_comusers', 'general', '1')) { ?>
								<label><input type="radio" name="comments_reg" id="comments_reg_1" value="noreg" checked="checked"> <?=t('Ваше имя')?></label> 
							<?php } else { ?>
								<input type="hidden" name="comments_reg" value="noreg"><?=t('Ваше имя')?> 
							<?php } ?>
								
							<input type="text" name="comments_author" class="comments_author" onfocus="document.getElementById('comments_reg_1').checked = 'checked';"> <small><?php
								if (mso_get_option('new_comment_anonim_moderate', 'general', '1') )
									echo mso_get_option('form_comment_anonim_moderate', 'general', t('Комментарий будет опубликован после проверки'));
								else
									echo mso_get_option('form_comment_anonim', 'general', t('Используйте нормальные имена'));
							?></small></p>
						
						<?php } ?>
					
						
						<?php if (mso_get_option('allow_comment_comusers', 'general', '1')) { ?>
						
							<p class="radio">
							
							<?php if ($allow_comment_anonim = mso_get_option('allow_comment_anonim', 'general', '1') ) { ?>
								<label><input type="radio" name="comments_reg" id="comments_reg_2" value="reg"> <?=t('Вход/регистрация')?></label>
							<?php } else { ?>
								<input type="hidden" name="comments_reg" id="comments_reg_2" value="reg" checked="checked">
								<?=t('Вход/регистрация')?> 
							<?php } ?>
							(<a href="<?= getinfo('siteurl') ?>login">войти без комментирования</a>)
							</p>
							
							<p><label>
									<span class="indent"><?=t('E-mail')?></span><input type="email" name="comments_email" class="comments_email" id="comments_email" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></label> 
										
									<input type="button" class="comments_copy" title="<?=t('Использовать email как пароль')?>" value="&gt;" onclick="document.getElementById('comments_reg_2').checked = 'checked'; document.getElementById('comments_password').value=document.getElementById('comments_email').value; "> 
										
									<label><?=t('Пароль')?> <input type="password" name="comments_password" class="comments_password" id="comments_password" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></label>
							</p>
							
							<p><label><span class="indent"><?=t('Ваше имя')?></span><input type="text" name="comments_comusers_nik" class="comments_comusers_nik" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></label> 
							<label><?=t('Сайт')?> <input type="text" name="comments_comusers_url" class="comments_comusers_url" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></label>
							</p>
							<p class="hint"><?=t('Имя и сайт используются только при регистрации')?></p>
						
						<?php } ?>
			
				<?php if ($form_comment_comuser = mso_get_option('form_comment_comuser', 'general', t('Если вы уже зарегистрированы как комментатор или хотите зарегистрироваться, укажите пароль и свой действующий email. При регистрации на указанный адрес придет письмо с кодом активации и ссылкой на ваш персональный аккаунт, где вы сможете изменить свои данные, включая адрес сайта, ник, описание, контакты и т.д., а также подписку на новые комментарии.'))) echo '<p class="hint">', $form_comment_comuser, '</p>'; ?>
			
			
				<?php 
					if (mso_hook_present('page-comment-form')) 
					{
						echo '<p class="hint comments_auth">' . t('Авторизация:') . ' ';
						mso_hook('page-comment-form');
						echo '</p>';
					}
				?>
			
			</div> <!-- class="comments-auth"-->
			
			<?php  } // залогирование ?>

			<?php mso_hook('comments_content_end') ?>
			<div><input name="comments_submit" type="submit" value="<?=t('Отправить')?>" class="comments_submit"></div>
		</div><!-- div class="comments-textarea" -->
		
	</form>
</div><!-- div class=comment-form -->
