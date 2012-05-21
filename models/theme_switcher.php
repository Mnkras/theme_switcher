<?php  

class ThemeSwitcher {

	public function checkForTheme($view) {
		//get the current page
		$page = Page::getCurrentPage();
		//get the path of the page,
		$cpath = $page->getCollectionPath();
		//Make sure its not a system page or the login screen or some other pages, we don't wanna theme the Dashboard
		if (!$page->isAdminArea() && !$page->isSystemPage()) {
			//if there is a suffix to the url and its t=<value> set the theme handle
			if ($_GET['t']) {
				$theme = PageTheme::getByHandle($_GET['t']);
				$view->setTheme($theme);
			}
			//if the get is not set, then set it from the cookie
			else if ($_COOKIE['ccmUserTheme']) {
				$theme = PageTheme::getByHandle($_COOKIE['ccmUserTheme']);
				$view->setTheme($theme);
			}
		}
	}

}

?>