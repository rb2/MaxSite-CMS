<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

?>

<div class="comment-form">

	<form method="post" class="fform">
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
				
						<?php if (mso_get_option('allow_comment_anonim', 'general', '1') ) { ?>
						
							<p>
								
								<?php $t_hidden = mso_get_option('allow_comment_comusers', 'general', '1') ? 'type="radio" checked="checked"' : 'type="hidden"'; ?>
								
								<label class="ffirst"><input <?= $t_hidden ?> name="comments_reg" id="comments_reg_1" value="noreg"> <?=t('Ваше имя')?></label>
								
								<span><input type="text" name="comments_author" class="comments_author" onfocus="document.getElementById('comments_reg_1').checked = 'checked';"> </span>
							</p>
								
							<p>
								<span class="ffirst"></span>
								<span class="fhint">
									<?php
									if (mso_get_option('new_comment_anonim_moderate', 'general', '1') )
										echo mso_get_option('form_comment_anonim_moderate', 'general', t('Комментарий будет опубликован после проверки'));
									else
										echo mso_get_option('form_comment_anonim', 'general', t('Используйте нормальные имена'));
									?>
								</span>
							</p>
						
						<?php } ?>
					
						
						<?php if (mso_get_option('allow_comment_comusers', 'general', '1')) { ?>
						
							<p>
							
								<?php $t_hidden = mso_get_option('allow_comment_anonim', 'general', '1') ? 'type="radio"' : 'type="hidden" checked="checked"'; ?>
							
								<label><input <?= $t_hidden ?> name="comments_reg" id="comments_reg_2" value="reg"> <?=t('Вход/регистрация')?> <a href="<?= getinfo('siteurl') ?>login"><?=t('(войти без комментирования)')?></a></label>

							</p>
							
							<p>
								<label for="comments_email" class="ffirst ftitle"><?=t('E-mail')?></label>
								<span><input type="email" name="comments_email" class="comments_email" id="comments_email" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></span> 
										
								<span class="fempty"></span>
								<span class="fbutton"><input type="button" class="comments_copy" title="<?=t('Использовать email как пароль')?>" value="&gt;" onclick="document.getElementById('comments_reg_2').checked = 'checked'; document.getElementById('comments_password').value=document.getElementById('comments_email').value; "></span>
										
								<label for="comments_password" class="ftitle"><?=t('Пароль')?></label>
								<span><input type="password" name="comments_password" class="comments_password" id="comments_password" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></span>
								
							</p>
							
							<p>
								<label for="comments_comusers_nik" class="ffirst ftitle"><?=t('Ваше имя')?></label>
								
								<span><input type="text" name="comments_comusers_nik" class="comments_comusers_nik" id="comments_comusers_nik" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></span> 
								
								<label for="comments_comusers_url" class="ftitle"><?=t('Сайт')?></label>
								<span><input type="url" name="comments_comusers_url" class="comments_comusers_url" id="comments_comusers_url" onfocus="document.getElementById('comments_reg_2').checked = 'checked';"></span>
							</p>
							
							<p>
								<span class="ffirst"></span>
								<span class="fhint"><?=t('Имя и сайт используются только при регистрации')?></span>
							</p>
						
						<?php } ?>
			
				<?php if ($form_comment_comuser = mso_get_option('form_comment_comuser', 'general', '')) 
					echo '<p><span class="ffirst"></span><span class="fhint">', $form_comment_comuser, 
					'</span></p>'; ?>
			
			
				<?php 
					if (mso_hook_present('page-comment-form')) 
					{
						echo '<p class="hint comments_auth"><span class="ffirst">' . t('Авторизация') . '&nbsp;</span>';
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
