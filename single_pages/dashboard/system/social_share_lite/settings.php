<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<form method="post" action="<?php echo $this->action('save_settings'); ?>">

<?php echo $this->controller->token->output('save_settings'); ?>

	<fieldset>
		<legend><?php echo t('Load scripts')?></legend>
		<div class="control-group">
			<div class="controls">
				<div class="radio">
					<label>
						<?php echo $form->radio('disable_scripts', 0, $disable_scripts); ?>
						<span><?php echo t('Add scripts if social share lite blocks are placed on the particular page (default).') ?></span>
					</label>
				</div>
				<div class="radio">
					<label>
						<?php echo $form->radio('disable_scripts', 1, $disable_scripts); ?>
						<span><?php echo t('Do not add scripts of social network api automatically.') ?></span>
					</label>
				</div>
				<span class="help-block"><?php echo t("If you want to load javascript files (Twitter widgets.js or Google plusone.js) into your theme manually, please choose second option."); ?></span>
			</div>
		</div>
	</fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
    <div class="ccm-dashboard-form-actions">
        <button class="pull-right btn btn-success" type="submit" ><?php echo t('Save')?></button>
    </div>
    </div>

</form>
