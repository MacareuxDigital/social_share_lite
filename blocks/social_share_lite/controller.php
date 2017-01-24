<?php
namespace Concrete\Package\SocialShareLite\Block\SocialShareLite;

use Concrete\Core\Block\BlockController;
use Package;
use Core;
use Page;
use Localization;

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
        $pkg = Package::getByHandle('open_graph_tags_lite');
        if($pkg){
            $twitter_site = $pkg->getConfig()->get('concrete.ogp.twitter_site');
            $this->set('twitter_site',$twitter_site);
            $this->set('ogt',$pkg);
        }
        
        $nh = Core::make('helper/navigation');
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
        parent::save($args);
    }
    
    public function on_page_view()
    {
        $th = Core::make('helper/text');
        
        $pkg = Package::getByHandle('social_share_lite');
        $disable_scripts = $pkg->getConfig()->get('concrete.sharing.disable_scripts');
        if ($disable_scripts) {
            return;
        }
    
        // Facebook SDK
        if($this->fblike){
            // Get Open Graph Tags Lite settings
            $app_id = '';
            $pkg = Package::getByHandle('open_graph_tags_lite');
            if($pkg){
                $fb_admin = $pkg->getConfig()->get('concrete.ogp.fb_app_id');
                if($fb_admin) $app_id = '&appID='.$th->specialchars($fb_admin);
            }
            $this->addFooterItem('<div id="fb-root"></div>');
            $this->addFooterItem($this->script('//connect.facebook.net/'.Localization::activeLocale().'/sdk.js#xfbml=1&version=v2.8'.$app_id));
        }
        
        // Twitter widgets.js
        if($this->tweet){
            $this->addFooterItem($this->script('https://platform.twitter.com/widgets.js'));
        }
        
        // Google plugone.js
        if($this->gplus){
            $this->addFooterItem($this->script('https://apis.google.com/js/platform.js', "{lang: 'ja'}"));
        }
        
        // Hatena bookmark_button.js
        if($this->bhatena){
            $this->addFooterItem($this->script('https://b.st-hatena.com/js/bookmark_button.js'));
        }
        
        // Tumblr share.js
        if($this->tumblr){
            $this->addFooterItem($this->script('https://secure.assets.tumblr.com/share-button.js'));
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
            $this->addFooterItem($this->script('//scdn.line-apps.com/n/line_it/thirdparty/loader.min.js'));
        }
        
        $this->addFooterItem('<!-- load social scripts by social share lite add-on -->');
    }
    
    protected function script($src, $body = false)
    {
        return sprintf('<script async defer src="%s">%s</script>', $src, $body);
    }

}
