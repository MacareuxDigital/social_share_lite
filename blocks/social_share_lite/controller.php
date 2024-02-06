<?php
namespace Concrete\Package\SocialShareLite\Block\SocialShareLite;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Localization\Localization;
use Concrete\Core\Package\PackageService;
use Concrete\Core\Page\Page;

class Controller extends BlockController
{
    protected $btTable = 'btSocialShareLite';
    protected $btInterfaceWidth = "350";
    protected $btInterfaceHeight = "350";
    protected $btWrapperClass = 'ccm-ui';
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = false;
    protected $btCacheBlockOutputLifetime = 0; //until manually updated or cleared

    protected $fblike;
    protected $tweet;
    protected $bhatena;
    protected $tumblr;
    protected $pinterest;
    protected $linkedin;
    protected $pocket;
    protected $line;
    protected $note;
    
    public function getBlockTypeDescription()
    {
        return t('Add social sharing buttons');
    }
    
    public function getBlockTypeName()
    {
        return t('Social Share Lite');
    }
    
    public function view()
    {
        // Get Open Graph Tags Lite settings
        /** @var PackageService $packageService */
        $packageService = $this->app->make(PackageService::class);
        $pkg = $packageService->getClass('open_graph_tags_lite');
        if($pkg){
            $twitter_site = $pkg->getConfig()->get('concrete.ogp.twitter_site');
            $this->set('twitter_site',$twitter_site);
            $this->set('ogt',$pkg);
        }
        
        $nh = $this->app->make('helper/navigation');
        $this->set('nh',$nh);
        
        $page = Page::getCurrentPage();
        $this->set('page',$page);
        
        $url = $nh->getLinkToCollection($page,true);
        $this->set('url',$url);
        
        $language = Localization::activeLanguage();
        $this->set('language', $language);
    }

    public function save($args)
    {
        $args['fblike'] = empty($args['fblike']) ? 0 : 1;
        $args['tweet'] = empty($args['tweet']) ? 0 : 1;
        $args['gplus'] = empty($args['gplus']) ? 0 : 1;
        $args['bhatena'] = empty($args['bhatena']) ? 0 : 1;
        $args['tumblr'] = empty($args['tumblr']) ? 0 : 1;
        $args['pinterest'] = empty($args['pinterest']) ? 0 : 1;
        $args['linkedin'] = empty($args['linkedin']) ? 0 : 1;
        $args['pocket'] = empty($args['pocket']) ? 0 : 1;
        $args['line'] = empty($args['line']) ? 0 : 1;
        $args['note'] = empty($args['note']) ? 0 : 1;
        parent::save($args);
    }
    
    public function on_page_view()
    {
        $th = $this->app->make('helper/text');

        $packageService = $this->app->make(PackageService::class);
        $pkg = $packageService->getClass('social_share_lite');
        $disable_scripts = $pkg->getConfig()->get('concrete.sharing.disable_scripts');
        if ($disable_scripts) {
            return;
        }
    
        // Facebook SDK
        if($this->fblike){
            // Get Open Graph Tags Lite settings
            $app_id = '';
            $pkg = $packageService->getClass('open_graph_tags_lite');
            if($pkg){
                $app_id = $th->specialchars($pkg->getConfig()->get('concrete.ogp.fb_app_id', ''));
            }
            $this->addFooterItem('<div id="fb-root"></div>');
            $this->addFooterItem($this->script('https://connect.facebook.net/'.Localization::activeLocale().'/sdk.js#xfbml=1&version=v19.0'));
        }
        
        // Twitter widgets.js
        if($this->tweet){
            $this->addFooterItem($this->script('https://platform.twitter.com/widgets.js'));
        }
        
        // Hatena bookmark_button.js
        if($this->bhatena){
            $this->addFooterItem($this->script('https://b.st-hatena.com/js/bookmark_button.js'));
        }
        
        // Tumblr share.js
        if($this->tumblr){
            $this->addFooterItem($this->script('https://assets.tumblr.com/share-button.js'));
        }
        
        // Pinterest pinit.js
        if($this->pinterest){
            $this->addFooterItem($this->script('//assets.pinterest.com/js/pinit.js'));
        }
        
        // Linkedin in.js
        if($this->linkedin){
            $this->addFooterItem('<script src="//platform.linkedin.com/in.js" type="text/javascript">
 lang: '.Localization::activeLocale().'
</script>');
        }
        
        // Pocket btn.js
        if($this->pocket){
            $this->addFooterItem($this->script('https://widgets.getpocket.com/v1/j/btn.js?v=1'));
        }
        
        // LINE
        if($this->line){
            $this->addFooterItem($this->script('https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js'));
        }

        if ($this->note) {
            $this->addFooterItem($this->script('https://cdn.st-note.com/js/social_button.min.js'));
        }
        
        $this->addFooterItem('<!-- load social scripts by social share lite add-on -->');
    }
    
    protected function script($src, $body = false)
    {
        return sprintf('<script async defer src="%s">%s</script>', $src, $body);
    }

}
