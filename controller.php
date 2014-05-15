<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class ThemeSwitcherPackage extends Package {

	protected $pkgHandle = 'theme_switcher';
	protected $appVersionRequired = '5.5.0';
	protected $pkgVersion = '1.6';

	public function getPackageName() {
		return t("Theme Switcher");
	}

	public function getPackageDescription() {
		return t("Block to switch themes.");
	}
	
	public function install() {
		$pkg = parent::install();
		
		BlockType::installBlockTypeFromPackage('theme_switcher', $pkg);
		
	}

	public function on_start() {
		define('THEME_SWITCHER_THEME', 'ccmUserTheme');
		Events::extend('on_start', 'ThemeSwitcher', 'checkForTheme', './packages/'.$this->pkgHandle.'/models/theme_switcher.php');
	}

}
