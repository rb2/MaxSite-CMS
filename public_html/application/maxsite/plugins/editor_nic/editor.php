<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');?>

	<script type="text/javascript" src="<?= $editor_config['url'] ?>js/nicEdit.js"></script>
	<script type="text/javascript">
	bkLib.onDomLoaded(function() {
		new nicEditor({fullPanel : true,iconsPath : '<?= $editor_config['url'] ?>js/nicEditorIcons.gif'}).panelInstance('wysiwyg');
	});
	</script>

<form method="post" <?= $editor_config['action'] ?> enctype="multipart/form-data">
<?= $editor_config['do'] ?>
<textarea id="wysiwyg" name="f_content" style="height: <?= $editor_config['height'] ?>px; width: 100%;" ><?= $editor_config['content'] ?></textarea>
<?= $editor_config['posle'] ?>
</form>

