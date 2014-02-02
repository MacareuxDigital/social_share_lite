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

/**
 * Share Button from Tumblr
 * get another code: http://www.tumblr.com/buttons
 */
if($tumblr){ ?>
<a href="http://www.tumblr.com/share" title="<?php echo t('Share on Tumblr'); ?>" class="tumblr-button"><?php echo t('Share on Tumblr'); ?></a><?php
}

/**
 * Pin It button from Pinterest
 * get another code: http://business.pinterest.com/widget-builder/#do_pin_it_button
 */
if($pinterest){ ?>
<a href="//pinterest.com/pin/create/button/" class="pin-it-button" data-pin-do="buttonBookmark" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a><span class="social-share-spacer"></span><?php
}

/**
 * Share Button from LinkedIn
 * get another code: http://developer.linkedin.com/plugins/share-plugin-generator
 */
if($linkedin){ ?>
<script type="IN/Share" data-url="<?php echo BASE_URL . $th->specialchars($url); ?>" data-counter="right"></script><?php
}

/**
 * Pocket Button from Pocket
 * get another code: http://getpocket.com/publisher/button
 */
if($pocket){ ?>
<a data-pocket-label="pocket" data-pocket-count="horizontal" class="pocket-btn" data-lang="<?php echo LANGUAGE; ?>"></a><?php
}

/**
 * Send to LINE Button from LINE
 * get another code: http://media.line.me/howto/ja/
 */
if($line){ ?>
<span class="line"><script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140127" ></script><script type="text/javascript">new media_line_me.LineButton({"pc":true,"lang":"ja","type":"a"});</script></span><?php
}

echo '</div>';

}