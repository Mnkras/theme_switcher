<?php defined('C5_EXECUTE') or die("Access Denied.");

Loader::model('page_theme');
Loader::model('theme_switcher', 'theme_switcher');

class ThemeSwitcherBlockController extends BlockController {

	protected $btTable = 'btThemeSwitcher';
	protected $btInterfaceWidth = "420";
	protected $btInterfaceHeight = "350";
	protected $btWrapperClass = 'ccm-ui';

	public function getBlockTypeName() {
		return t("Theme Switcher");
	}

	public function getBlockTypeDescription() {
		return t("Theme switcher block.");
	}

	function on_page_view(){
		$this->addHeaderItem('<style type="text/css"> .themeSwitcher select{ margin-top: 10px;} </style>');
		$this->addHeaderItem('<script type="text/javascript"> $(document).ready(function() { $(\'#theme-switcher\').change(function(){ this.submit(); }); }); </script>');
	}
	
	public function view(){
		//if the cookie exists set the theme
		if($_COOKIE[THEME_SWITCHER_THEME]) {
			$theme = $_COOKIE[THEME_SWITCHER_THEME];
			if(!in_array($theme, ThemeSwitcher::getThemeHandles(true))) {
				$theme = PageTheme::getSiteTheme()->getThemeHandle();
			}
			$this->set('selectedTheme', $theme);
		} else {
			$current = PageTheme::getSiteTheme();
			$this->set('selectedTheme', $current->getThemeHandle());
		}
		
		$this->set('themeHandles', ThemeSwitcher::getThemeHandles());
	}
	
	public function action_switch_theme() {

		$theme = $this->post('theme');
		$pl = PageTheme::getByHandle($theme);
		
		//on theme switch set the cookie
		if (is_object($pl) && $pl->getThemeID() > 0) {
			ThemeSwitcher::setThemeCookie($theme);
		}
		
		$url = Page::getCurrentPage()->getCollectionPath();
		$this->redirect($url);		
		
	}		
	
}