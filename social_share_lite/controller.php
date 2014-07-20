<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

class SocialShareLitePackage extends Package {

	protected $pkgHandle = 'social_share_lite';
	protected $appVersionRequired = '5.6.0';
	protected $pkgVersion = '1.1';
	
	public function getPackageDescription() {
		return t("Add social sharing buttons");
	}
	
	public function getPackageName() {
		return t("Social Share Lite");
	}
	
	public function install() {
		$pkg = parent::install();
		BlockType::installBlockTypeFromPackage('social_share_lite',$pkg);
		
		$ci = new ContentImporter();
		$ci->importContentFile($pkg->getPackagePath() . '/config/singlepages.xml');
	}
	
	public function upgrade() {
	    $pkg = Package::getByHandle('social_share_lite');
		$ci = new ContentImporter();
		$ci->importContentFile($pkg->getPackagePath() . '/config/singlepages.xml');
		
	    parent::upgrade();
	}

}