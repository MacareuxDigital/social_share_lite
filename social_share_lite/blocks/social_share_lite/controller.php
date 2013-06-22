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
		parent::save($args);
	}
	
	public function on_page_view() {
	
		// Facebook SDK
		if($this->fblike){
			// Get Open Graph Tags Lite settings
			$app_id = '';
			$pkg = Package::getByHandle('open_graph_tags_lite');
			if($pkg){
				$co = new Config();
				$co->setPackageObject($pkg);
				$fb_admin = $co->get('FB_APP_ID');
				if($fb_admin) $app_id = '&appID='.$fb_admin;
			}
			$this->addFooterItem('<div id="fb-root"></div>');
			$this->addFooterItem($this->script('//connect.facebook.net/ja_JP/all.js#xfbml=1'.$app_id,'facebook-jssdk'));
		}
		
		// Twitter widgets.js
		if($this->tweet){
			$this->addFooterItem($this->script('https://platform.twitter.com/widgets.js','twitter-wjs'));
		}
		
		// Google plugone.js
		if($this->gplus){
			$this->addFooterItem('<script type="text/javascript">
  window.___gcfg = {lang: "' . LANGUAGE . '"};
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
			if (strpos(ACTIVE_LOCALE, '.') > -1) {
				$loc = explode('.', ACTIVE_LOCALE);
				if (is_array($loc) && count($loc) == 2) {
					$locale = $loc[0];
				}
			} else {
				$locale = ACTIVE_LOCALE;
			}
			$this->addFooterItem('<script src="//platform.linkedin.com/in.js" type="text/javascript">
 lang: ' . $locale . '
</script>');
		}
		
		// Pocket btn.js
		if($this->pocket){
			$this->addFooterItem($this->script('https://widgets.getpocket.com/v1/j/btn.js?v=1','pocket-btn-js'));
		}
		
		$this->addFooterItem('<!-- load social scripts by social share lite add-on -->');
	}
	
	protected function script($src,$handle) {
		$th = Loader::helper('text');
		$src = $th->specialchars($src);
		$handle = $th->specialchars($handle);
		
		return '<script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="'.$src.'";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","'.$handle.'");</script>';
	}

}
