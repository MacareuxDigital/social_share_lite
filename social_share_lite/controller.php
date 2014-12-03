<?php
namespace Concrete\Package\SocialShareLite;

use \Concrete\Core\Backup\ContentImporter;

class Controller extends \Concrete\Core\Package\Package
{
    protected $pkgHandle = 'social_share_lite';
    protected $appVersionRequired = '5.7.2.1';
    protected $pkgVersion = '2.0';
    
    public function getPackageDescription()
    {
        return t("Add social sharing buttons");
    }
    
    public function getPackageName()
    {
        return t("Social Share Lite");
    }
    
    public function install()
    {
        $pkg = parent::install();
        
        $ci = new ContentImporter();
        $ci->importContentFile($pkg->getPackagePath() . '/config/install.xml');
    }

}