<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Social Share Lite'),'', 'span10 offset1', false); ?>
<form method="post" id="site-form" action="<?php echo $this->action('save_settings'); ?>" class="form-horizontal">

<?php echo $this->controller->token->output('save_settings'); ?>

<div class="ccm-pane-body">
	<fieldset>
		<legend><?php echo t('Developers option')?></legend>
		<div class="control-group">
			<?php echo $form->label('disable_scripts', t('Load scripts'))?>
			<div class="controls">
				<label class="radio">
					<?php echo $form->radio('disable_scripts', 0, $disable_scripts); ?>
					<?php echo t('Add scripts if social share lite blocks are placed on the particular page (default).') ?>
				</label>
				<label class="radio">
					<?php echo $form->radio('disable_scripts', 1, $disable_scripts); ?>
					<?php echo t('Do not add scripts of social network api automatically.') ?>
				</label>
				<span class="help-block"><?php echo t("If you want to load javascript files (Twitter widgets.js or Google plusone.js) into your theme manually, please choose second option."); ?></span>
			</div>
		</div>
	</fieldset>
</div>
<div class="ccm-pane-footer">
	<?php print $interface->submit(t('Save'), 'site-form', 'right', 'primary'); ?>
</div>

</form>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>