<?php  
defined('C5_EXECUTE') or die('Access Denied');

class ThemeSwitcher {

	public function checkForTheme($view) {
		//get the current page
		$page = Page::getCurrentPage();
		//get the path of the page,
		$cpath = $page->getCollectionPath();
		//Make sure its not a system page or the login screen or some other pages, we don't wanna theme the Dashboard
		if (!$page->isAdminArea() && !$page->isSystemPage()) {
			//if there is a suffix to the url and its t=<value> set the theme handle
			if($_GET['t']) {
				$theme = PageTheme::getByHandle($_GET['t']);
				self::setThemeCookie($_GET['t']);
				$view->setTheme($theme);
			} else if($_COOKIE['ccmUserTheme']) {
				$theme = PageTheme::getByHandle($_COOKIE['ccmUserTheme']);
				$view->setTheme($theme);
			}
		}
	}
	
	public static function setThemeCookie($theme = false) {
		setcookie("ccmUserTheme", $theme, time() + 1209600, DIR_REL . '/');	
	}
	
	public static function getThemeHandles() {
		 Loader::model('page_theme'); 
		//get the list of themes		
		$themeHandles = PageTheme::getList();
		//reverse the array
		return array_reverse($themeHandles);
	}

}