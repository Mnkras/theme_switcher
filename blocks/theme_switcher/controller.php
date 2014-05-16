<?php  defined('C5_EXECUTE') or die("Access Denied.");

Loader::model('page_theme');
Loader::model('theme_switcher', 'theme_switcher');

class ThemeSwitcherBlockController extends BlockController {

	protected $btTable = 'btThemeSwitcher';
	protected $btInterfaceWidth = "420";
	protected $btInterfaceHeight = "350";

	public function getBlockTypeName() {
		return t("Theme Switcher");
	}

	public function getBlockTypeDescription() {
		return t("Theme switcher block.");
	}

	function on_page_view(){
		$page = Page::getCurrentPage();
		if($page->isEditMode() || $page->isAdminArea()){
			return;
		}
		$this->addHeaderItem($this->switcher_script());
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

		// Modified by JohnTheFish for Prev/Next/Pause and autoplay behaviour
		
		// next
		if ($this->post('next_theme')){
			$current_theme = $this->post('theme');
			$themes = ThemeSwitcher::getThemeHandles(true);
			$found = false;
			foreach ($themes as $handle){
				if($found){
					$theme = $handle;
					break;
				}
				$found = ($handle == $current_theme);
			}
			// loop
			if (empty($theme)){
				$theme = $themes[0];
			}

		// previous
		} else if ($this->post('previous_theme')){
			$current_theme = $this->post('theme');
			$themes = ThemeSwitcher::getThemeHandles(true);
			$prev = null;
			foreach ($themes as $handle){
				if($found){
					$theme = $handle;
					break;
				}
				if ($handle == $current_theme){
					$theme = $prev;
					break;
				}
				$prev = $handle;
			}

		// catch situation of clicking pause before doc is ready
		} else if ($this->post('pause_theme')){
			$theme = $_COOKIE[THEME_SWITCHER_THEME];

		// selected
		} else {
			$theme = $this->post('theme');
		}

		$pl = PageTheme::getByHandle($theme);

		//on theme switch set the cookie
		if (is_object($pl) && $pl->getThemeID() > 0) {
			ThemeSwitcher::setThemeCookie($theme);
		}

		$url = Page::getCurrentPage()->getCollectionPath();
		$this->redirect($url);

	}

	public function switcher_script(){
		// Moved to a method and modified by JohnTheFish for Prev/Next/Pause and autoplay behaviour
		ob_start();
		?>
		<script type="text/javascript">
		$(document).ready(function() {
			if (CCM_EDIT_MODE){
				return;
			}
			var theme = $("form.theme-switcher select option:selected").text();
			window.console && console && console.log('Current theme: '+theme);
			var asd = parseInt('<?php echo $this->auto;?>',10);
			var t = null;
			$('form.theme-switcher select').one('change', function(){
				var new_theme = $(this).find("option:selected").text();
				window.console && console && console.log('Theme Switching to: '+new_theme);
				clearTimeout(t);
				$(this).closest('form').submit();
			});
			/*
			Automatically cycle through themes
			*/
			if (asd){
				t = setTimeout(function(){
					window.console && console && console.log('Auto changing from: '+theme);
					$('form.theme-switcher input[name="pause_theme"]').off('click');
					$('form.theme-switcher input[name="next_theme"]').first().trigger('click');
				}, asd*1000);
			}
			$('form.theme-switcher input[name="pause_theme"], form.theme-switcher select').on('click', function(ev){
				ev.preventDefault();
				window.console && console && console.log('Paused at theme: '+theme);
				clearTimeout(t);
			});
		});
		</script>
		<?php
		$script = ob_get_contents();
		ob_end_clean();
		return $script;
	}

}
