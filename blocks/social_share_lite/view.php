<?php  defined('C5_EXECUTE') or die("Access Denied.");

if($page->isEditMode()) { ?>
<div class="ccm-edit-mode-disabled-item"><?php echo t('Social share buttons disabled in edit mode.');?></div>
<?php
} else {

echo '<div class="ccm-social-share">';
echo '<ul>';

/**
 * Like Button from Facebook
 * @link https://developers.facebook.com/docs/plugins/share-button
 */
if($fblike){ ?>
<li class="fblike">
<div class="fb-share-button" data-href="<?php echo h($url); ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"></div>
</li><?php
}

/**
 * Tweet Button from Twitter
 * @link https://dev.twitter.com/web/tweet-button
 */
if($tweet){ ?>
<li class="tweet">
<a href="https://twitter.com/intent/tweet" class="twitter-share-button" data-url="<?php echo h($url); ?>" data-lang="<?php echo h($language); ?>"<?php if(isset($twitter_site) && !empty($twitter_site)){?> data-via="<?php echo h($twitter_site); ?>"<?php }?>><?php echo t('Tweet'); ?></a>
</li><?php
}

/**
 * Google plus Button from Google
 * @link https://developers.google.com/+/web/+1button/
 */
if($gplus){ ?>
<li class="gplus">
<div class="g-plusone" data-size="medium" data-href="<?php echo h($url); ?>"></div>
</li><?php
}

/**
 * Hatena bookmark Button from Hatena
 * @link http://b.hatena.ne.jp/guide/bbutton
 */
if($bhatena){ ?>
<li class="bhatena">
<a href="http://b.hatena.ne.jp/entry/<?php echo h($url); ?>" class="hatena-bookmark-button" data-hatena-bookmark-layout="simple-balloon" data-hatena-bookmark-lang="<?php echo h($language); ?>" title="<?php echo t('Add this entry to hatena bookmark');?>"><img src="http://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="<?php echo t('Add this entry to hatena bookmark');?>" width="20" height="20" style="border: none;" /></a>
</li><?php
}

/**
 * Share Button from Tumblr
 * @link http://www.tumblr.com/buttons
 */
if($tumblr){ ?>
<li class="tumblr">
<a class="tumblr-share-button" data-color="blue" data-notes="right" href="https://embed.tumblr.com/share"></a>
</li><?php 
}

/**
 * Pin It button from Pinterest
 * @link https://developers.pinterest.com/tools/widget-builder/
 */
if($pinterest){ ?>
<li class="pinterest">
<a data-pin-do="buttonBookmark" data-pin-lang="<?php echo h($language); ?>" data-pin-save="true" href="//pinterest.com/pin/create/button/"></a>
</li><?php
}

/**
 * Share Button from LinkedIn
 * @link https://developer.linkedin.com/plugins/share
 */
if($linkedin){ ?>
<li class="linkedin">
<script type="IN/Share" data-url="<?php echo h($url); ?>" data-counter="right"></script>
</li><?php
}

/**
 * Pocket Button from Pocket
 * @link http://getpocket.com/publisher/button
 */
if($pocket){ ?>
<li class="pocket">
<a data-pocket-label="pocket" data-pocket-count="horizontal" data-save-url="<?php echo h($url); ?>" class="pocket-btn" data-lang="<?php echo h($language); ?>"></a>
</li><?php
}

/**
 * Send to LINE Button from LINE
 * @link http://media.line.me/howto/en/
 */
if($line){ ?>
<li class="line">
<div class="line-it-button" data-lang="<?php echo h($language); ?>" data-type="share-a" data-ver="3" data-url="<?php echo h($url); ?>" data-color="default" data-size="small" data-count="true" style="display: none;"></div>
</li><?php
}

echo '</ul>';
echo '</div>';

}
