<?php defined('C5_EXECUTE') or die(_("Access Denied."));


class DashboardSystemSocialShareLiteController extends DashboardBaseController {

	public function view() {
		$this->redirect('/dashboard/system/social_share_lite/settings');
	}
	
}