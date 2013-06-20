<?php  defined('C5_EXECUTE') or die("Access Denied.");
$nh = Loader::helper('navigation');
$th = Loader::helper('text');
$page = Page::getCurrentPage();
$url = $nh->getLinkToCollection($page);

if($page->isEditMode()) { ?>
<div class="ccm-edit-mode-disabled-item"><?php echo t('Sosial share buttons disabled in edit mode.');?></div>
<?php
} else {

echo '<div class="social-share">';

/**
 * Like Button from Facebook
 * get another code: https://developers.facebook.com/docs/reference/plugins/like/
 */
if($fblike){ ?>
<div class="fb-like" data-href="<?php echo BASE_URL . $th->specialchars($url); ?>" data-send="false" data-layout="button_count" data-width="120" data-show-faces="false"></div><?php
}

/**
 * Tweet Button from Twitter
 * get another code: https://dev.twitter.com/docs/tweet-button
 */
if($tweet){ ?>
<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo BASE_URL . $th->specialchars($url); ?>" data-lang="<?php echo LANGUAGE; ?>"<?php if(isset($twitter_site) && !empty($twitter_site)){?> data-via="<?php echo $th->specialchars($twitter_site); ?>"<?php }?>><?php echo t('Tweet'); ?></a><?php
}

/**
 * Google plus Button from Google
 * get another code: https://developers.google.com/+/web/+1button/
 */
if($gplus){ ?>
<div class="g-plusone" data-size="medium" data-href="<?php echo BASE_URL . $th->specialchars($url); ?>"></div><?php
}

/**
 * Hatena bookmark Button from Hatena
 * get another code: http://b.hatena.ne.jp/guide/bbutton
 */
if($bhatena){ ?>
<a href="http://b.hatena.ne.jp/entry/<?php echo BASE_URL . $th->specialchars($url); ?>" class="hatena-bookmark-button" data-hatena-bookmark-layout="simple-balloon" data-hatena-bookmark-lang="<?php echo LANGUAGE; ?>" title="<?php echo t('Add this entry to hatena bookmark');?>"><img src="http://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="<?php echo t('Add this entry to hatena bookmark');?>" width="20" height="20" style="border: none;" /></a><?php
}

echo '</div>';

}