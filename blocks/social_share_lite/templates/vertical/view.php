<?php defined('C5_EXECUTE') or die("Access Denied.");

/** @var \Concrete\Core\Page\Page $page */
$fblike = isset($fblike) ? $fblike : false;
$tweet = isset($tweet) ? $tweet : false;
$bhatena = isset($bhatena) ? $bhatena : false;
$tumblr = isset($tumblr) ? $tumblr : false;
$pinterest = isset($pinterest) ? $pinterest : false;
$linkedin = isset($linkedin) ? $linkedin : false;
$pocket = isset($pocket) ? $pocket : false;
$line = isset($line) ? $line : false;
$note = isset($note) ? $note : false;

if ($page->isEditMode()) { ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Social share buttons disabled in edit mode.'); ?></div>
    <?php
} else {

    echo '<div class="ccm-social-share">';
    echo '<ul class="ccm-social-vertical">';

    /**
     * Share Button from Facebook
     * @link https://developers.facebook.com/docs/plugins/share-button
     */
    if ($fblike) { ?>
        <li class="fblike">
        <div class="fb-share-button" data-href="<?php echo h($url); ?>" data-layout="button_count" data-size="small">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= h(urlencode($url)) ?>"
               class="fb-xfbml-parse-ignore"><?= t('Share') ?></a>
        </div>
        </li><?php
    }

    /**
     * Post Button from X
     * @link https://developer.twitter.com/en/docs/twitter-for-websites/tweet-button/overview
     */
    if ($tweet) { ?>
        <li class="tweet">
        <a href="https://twitter.com/intent/tweet" class="twitter-share-button" data-url="<?php echo h($url); ?>"
           data-lang="<?php echo h($language); ?>"<?php if (isset($twitter_site) && !empty($twitter_site)) { ?> data-via="<?php echo h($twitter_site); ?>"<?php } ?>><?php echo t('Tweet'); ?></a>
        </li><?php
    }

    /**
     * Hatena bookmark Button from Hatena
     * @link http://b.hatena.ne.jp/guide/bbutton
     */
    if ($bhatena) {
        if (strpos($url, 'http://') === 0) {
            $hatenaUrl = 'https://b.hatena.ne.jp/entry/' . str_replace('http://', '', $url);
        } else {
            $hatenaUrl = 'https://b.hatena.ne.jp/entry/s' . str_replace('https://', '', $url);
        }
        ?>
        <li class="bhatena">
        <a href="https://b.hatena.ne.jp/entry/<?php echo h($hatenaUrl); ?>" class="hatena-bookmark-button"
           data-hatena-bookmark-layout="basic-label-counter" data-hatena-bookmark-lang="<?php echo h($language); ?>"
           title="<?php echo t('Add this entry to hatena bookmark'); ?>"><img
                    src="https://b.st-hatena.com/images/v4/public/entry-button/button-only@2x.png"
                    alt="<?php echo t('Add this entry to hatena bookmark'); ?>" width="20" height="20"
                    style="border: none;"/></a>
        </li><?php
    }

    /**
     * Post Button from Tumblr
     * @link http://www.tumblr.com/buttons
     */
    if ($tumblr) { ?>
        <li class="tumblr">
            <a class="tumblr-share-button" data-color="blue" data-notes="right"
               href="https://embed.tumblr.com/share"></a>
        </li><?php
    }

    /**
     * Save button from Pinterest
     * @link https://developers.pinterest.com/tools/widget-builder/
     */
    if ($pinterest) { ?>
        <li class="pinterest">
        <a data-pin-do="buttonBookmark" data-pin-lang="<?php echo h($language); ?>" data-pin-save="true"
           href="//pinterest.com/pin/create/button/"></a>
        </li><?php
    }

    /**
     * Share Button from LinkedIn
     * @link https://learn.microsoft.com/en-us/linkedin/consumer/integrations/self-serve/plugins/share-plugin
     */
    if ($linkedin) { ?>
        <li class="linkedin">
        <script type="IN/Share" data-url="<?php echo h($url); ?>" data-counter="right"></script>
        </li><?php
    }

    /**
     * Pocket Button from Pocket
     * @link http://getpocket.com/publisher/button
     */
    if ($pocket) { ?>
        <li class="pocket">
        <a data-pocket-label="pocket" data-pocket-count="horizontal" data-save-url="<?php echo h($url); ?>"
           class="pocket-btn" data-lang="<?php echo h($language); ?>"></a>
        </li><?php
    }

    /**
     * Send to LINE Button from LINE
     * @link https://developers.line.biz/en/docs/line-social-plugins/install-guide/using-line-share-buttons/
     */
    if ($line) { ?>
        <li class="line">
        <div class="line-it-button" data-lang="<?php echo h($language); ?>" data-type="share-a" data-end="REAL"
             data-url="<?php echo h($url); ?>" data-color="default" data-size="small" data-count="true" data-ver="3"
             style="display: none;"></div>
        </li><?php
    }

    /**
     * Write on note Button from note
     */
    if ($note) { ?>
        <li class="note">
            <a href="https://note.com/intent/social_button" class="note-social-button"
               data-url="<?php echo h($url); ?>"></a>
        </li>
        <?php
    }

    echo '</ul>';
    echo '</div>';

}
