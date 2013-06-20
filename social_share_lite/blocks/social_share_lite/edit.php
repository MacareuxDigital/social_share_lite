<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="form-horizontal">
	<fieldset>
	  <legend><?php echo t('Select to display.'); ?></legend>
		<div class="control-group">
			<?php	echo $form->label('fblike', t('Facebook Like'))?>
			<div class="controls">
				<?php  echo $form->checkbox('fblike', 1, $fblike); ?>
			</div>
		</div>
		<div class="control-group">
			<?php	echo $form->label('tweet', t('Twitter Tweet'))?>
			<div class="controls">
				<?php  echo $form->checkbox('tweet', 1, $tweet); ?>
			</div>
		</div>
		<div class="control-group">
			<?php	echo $form->label('gplus', t('Google+ plus one'))?>
			<div class="controls">
				<?php  echo $form->checkbox('gplus', 1, $gplus); ?>
			</div>
		</div>
		<div class="control-group">
			<?php	echo $form->label('bhatena', t('Hatena bookmark'))?>
			<div class="controls">
				<?php  echo $form->checkbox('bhatena', 1, $bhatena); ?>
			</div>
		</div>
	</fieldset>
</div>