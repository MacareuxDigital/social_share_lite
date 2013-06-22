<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="form-horizontal">
	<fieldset>
	  <legend><?php echo t('Select to display.'); ?></legend>
		<div class="control-group">
			<?php	echo $form->label('fblike', t("Facebook's Like"))?>
			<div class="controls">
				<?php  echo $form->checkbox('fblike', 1, $fblike); ?>
			</div>
		</div>
		<div class="control-group">
			<?php	echo $form->label('tweet', t("Twitter's Tweet"))?>
			<div class="controls">
				<?php  echo $form->checkbox('tweet', 1, $tweet); ?>
			</div>
		</div>
		<div class="control-group">
			<?php	echo $form->label('gplus', t("Google+'s plus one"))?>
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
		<div class="control-group">
			<?php	echo $form->label('tumblr', t("Tumblr's Share"))?>
			<div class="controls">
				<?php  echo $form->checkbox('tumblr', 1, $tumblr); ?>
			</div>
		</div>
		<div class="control-group">
			<?php	echo $form->label('pinterest', t("Pinterest's Pin it"))?>
			<div class="controls">
				<?php  echo $form->checkbox('pinterest', 1, $pinterest); ?>
			</div>
		</div>
		<div class="control-group">
			<?php	echo $form->label('linkedin', t("LinkedIn's Share"))?>
			<div class="controls">
				<?php  echo $form->checkbox('linkedin', 1, $linkedin); ?>
			</div>
		</div>
		<div class="control-group">
			<?php	echo $form->label('pocket', t('Pocket Button'))?>
			<div class="controls">
				<?php  echo $form->checkbox('pocket', 1, $pocket); ?>
			</div>
		</div>
	</fieldset>
</div>