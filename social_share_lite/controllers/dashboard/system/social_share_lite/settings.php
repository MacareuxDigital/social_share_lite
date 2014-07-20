<?php defined('C5_EXECUTE') or die(_("Access Denied."));


class DashboardSystemSocialShareLiteSettingsController extends DashboardBaseController {
	
	public function view() {
		$co = new Config();
		$co->setPackageObject(Package::getByHandle('social_share_lite'));
		$disable_scripts = $co->get('DISABLE_SCRIPTS');
		$this->set('disable_scripts', $disable_scripts);
	}

	public function updated() {
		$this->set('message', t("Settings saved."));	
		$this->view();
	}
	
	public function save_settings() {
		if ($this->token->validate("save_settings")) {
			if ($this->isPost()) {
				$disable_scripts = $this->post('disable_scripts');
				$co = new Config();
				$co->setPackageObject(Package::getByHandle('social_share_lite'));
				$co->save('DISABLE_SCRIPTS', $disable_scripts);
				$this->redirect('/dashboard/system/social_share_lite/settings','updated');
			}
		} else {
			$this->set('error', array($this->token->getErrorMessage()));
		}
	}
	
}