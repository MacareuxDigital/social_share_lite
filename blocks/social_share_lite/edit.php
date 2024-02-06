<?php
defined('C5_EXECUTE') or die("Access Denied.");

$fblike = isset($fblike) ? $fblike : null;
$tweet = isset($tweet) ? $tweet : null;
$bhatena = isset($bhatena) ? $bhatena : null;
$tumblr = isset($tumblr) ? $tumblr : null;
$pinterest = isset($pinterest) ? $pinterest : null;
$linkedin = isset($linkedin) ? $linkedin : null;
$pocket = isset($pocket) ? $pocket : null;
$line = isset($line) ? $line : null;
$note = isset($note) ? $note : null;
?>
<fieldset>
    <legend><?php  echo t('Select to display.'); ?></legend>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('fblike', 1, $fblike); ?>
            <?php echo t("Facebook's Share"); ?>
        </label>
    </div>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('tweet', 1, $tweet); ?>
            <?php echo t("X's Post"); ?>
        </label>
    </div>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('bhatena', 1, $bhatena); ?>
            <?php echo t('Hatena bookmark'); ?>
        </label>
    </div>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('tumblr', 1, $tumblr); ?>
            <?php echo t("Tumblr's Share"); ?>
        </label>
    </div>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('pinterest', 1, $pinterest); ?>
            <?php echo t("Pinterest's Pin it"); ?>
        </label>
    </div>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('linkedin', 1, $linkedin); ?>
            <?php echo t("LinkedIn's Share"); ?>
        </label>
    </div>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('pocket', 1, $pocket); ?>
            <?php echo t('Pocket Button'); ?>
        </label>
    </div>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('line', 1, $line); ?>
            <?php echo t('LINE Button'); ?>
        </label>
    </div>
    <div class="checkbox">
        <label>
            <?php echo $form->checkbox('note', 1, $note); ?>
            <?php echo t('note Button'); ?>
        </label>
    </div>
</fieldset>