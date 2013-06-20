<?php  defined('C5_EXECUTE') or die("Access Denied.");

class SocialShareLiteBlockController extends BlockController {
	
	public function getBlockTypeDescription() {
		return t('Add social sharing buttons');
	}
	
	public function getBlockTypeName() {
		return t('Social Share Lite');
	}
	
	protected $btTable = 'btSocialShareLite';
	
	protected $btInterfaceWidth = "300";
	protected $btInterfaceHeight = "400";
	protected $btWrapperClass = 'ccm-ui';
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = true;
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
		parent::save($args);
	}
	
	public function on_page_view() {
		$th = Loader::helper('text');
		
		$scripts = array();
		
		// Facebook SDK
		if($this->fblike){
			// Get Open Graph Tags Lite settings
			$app_id = '';
			$pkg = Package::getByHandle('open_graph_tags_lite');
			if($pkg){
				$co = new Config();
				$co->setPackageObject($pkg);
				$fb_admin = $co->get('FB_APP_ID');
				$app_id = '&appID='.$fb_admin;
			}
			$scripts[] = '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1'.$th->specialchars($app_id).'";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>';
		}
		
		// Twitter widgets.js
		if($this->tweet){
			$scripts[] = '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
		}
		
		// Google plugone.js
		if($this->gplus){
			$scripts[] = '<script type="text/javascript">
  window.___gcfg = {lang: "' . LANGUAGE . '"};

  (function() {
    var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
    po.src = "https://apis.google.com/js/plusone.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
  })();
</script>';
		}
		
		// Hatena bookmark_button.js
		if($this->bhatena){
			$scripts[] = '<script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>';
		}
		
		$scripts[] = '<!-- load social scripts by social share lite add-on -->';
		
		/* debug
		$scripts[] = '<!--';
		$scripts[] = $this->get('fblike');
		$scripts[] = $this->get('tweet');
		$scripts[] = $this->get('gplus');
		$scripts[] = $this->get('bhatena');
		$scripts[] = '-->';
		/* */
		
		$script = implode('',$scripts);
		
		$this->addFooterItem($script);
	}

}
