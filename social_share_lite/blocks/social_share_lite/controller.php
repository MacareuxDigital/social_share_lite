<?php  defined('C5_EXECUTE') or die("Access Denied.");

class SocialShareLiteBlockController extends BlockController {
	
	public function getBlockTypeDescription() {
		return t('Add social sharing buttons');
	}
	
	public function getBlockTypeName() {
		return t('Social Share Lite');
	}
	
	protected $btTable = 'btSocialShareLite';
	
	protected $btInterfaceWidth = "350";
	protected $btInterfaceHeight = "450";
	protected $btWrapperClass = 'ccm-ui';
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = false;
	protected $btCacheBlockOutputLifetime = 0; //until manually updated or cleared
	
	public function view() {
		// Get Open Graph Tags Lite settings
		$pkg = Package::getByHandle('open_graph_tags_lite');
		if($pkg){
			$co = new Config();
			$co->setPackageObject($pkg);
			$twitter_site = $co->get('TWITTER_SITE');
			$this->set('twitter_site',$twitter_site);
			$this->set('ogt',$pkg);
		}
		
		$nh = Loader::helper('navigation');
		$th = Loader::helper('text');
		$this->set('nh',$nh);
		$this->set('th',$th);
		
		$page = Page::getCurrentPage();
		$url = $nh->getLinkToCollection($page,true);
		$this->set('url',$url);
		
		$this->set('language',LANGUAGE);
	}

	public function save($args) {
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
	
	public function on_page_view() {
		$th = Loader::helper('text');
		
		$co = new Config();
		$co->setPackageObject(Package::getByHandle('social_share_lite'));
		$disable_scripts = $co->get('DISABLE_SCRIPTS');
		if ($disable_scripts) {
			return;
		}
	
		// Facebook SDK
		if($this->fblike){
			// Get Open Graph Tags Lite settings
			$app_id = '';
			$pkg = Package::getByHandle('open_graph_tags_lite');
			if($pkg){
				$co = new Config();
				$co->setPackageObject($pkg);
				$fb_admin = $co->get('FB_APP_ID');
				if($fb_admin) $app_id = '&appID='.$th->specialchars($fb_admin);
			}
			$this->addFooterItem('<div id="fb-root"></div>');
			$this->addFooterItem($this->script('//connect.facebook.net/'.$this->getLocale().'/sdk.js#xfbml=1&version=v2.3'.$app_id,'facebook-jssdk'));
		}
		
		// Twitter widgets.js
		if($this->tweet){
			$this->addFooterItem($this->script('https://platform.twitter.com/widgets.js','twitter-wjs'));
		}
		
		// Google plugone.js
		if($this->gplus){
			$this->addFooterItem('<script type="text/javascript">
  window.___gcfg = {lang: "' . $th->specialchars(LANGUAGE) . '"};
</script>');
			$this->addFooterItem($this->script('https://apis.google.com/js/plusone.js','google-plusone'));
		}
		
		// Hatena bookmark_button.js
		if($this->bhatena){
			$this->addFooterItem($this->script('http://b.st-hatena.com/js/bookmark_button.js','hatena-bookmark'));
		}
		
		// Tumblr share.js
		if($this->tumblr){
			$this->addFooterItem($this->script('http://platform.tumblr.com/v1/share.js','tumblr'));
		}
		
		// Pinterest pinit.js
		if($this->pinterest){
			$this->addFooterItem($this->script('//assets.pinterest.com/js/pinit.js','pinit'));
		}
		
		// Linkedin in.js
		if($this->linkedin){
			$this->addFooterItem('<script src="//platform.linkedin.com/in.js" type="text/javascript">
 lang: '.$th->specialchars($this->getLocale()).'
</script>');
		}
		
		// Pocket btn.js
		if($this->pocket){
			$this->addFooterItem($this->script('https://widgets.getpocket.com/v1/j/btn.js?v=1','pocket-btn-js'));
		}
		
		// LINE
		if($this->line){
			$html = Loader::helper('html');
			$this->addHeaderItem($html->javascript('//media.line.me/js/line-button.js?v=20140411'));
		}
		
		$this->addFooterItem('<!-- load social scripts by social share lite add-on -->');
	}
	
	protected function script($src,$handle) {
		return '<script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="'.$src.'";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","'.$handle.'");</script>';
	}
	
	protected function getLocale() {
		$localization = Localization::getInstance();
		$locale = $localization->getLocale();
		
		// remove charset like as utf8 from locale string
		if (strpos($locale, '.') > -1) {
			$loc = explode('.', $locale);
			if (is_array($loc) && count($loc) == 2) {
				$locale = $loc[0];
			}
		}
		return $locale;
	}

}
