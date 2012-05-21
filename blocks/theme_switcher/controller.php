<?php   

defined('C5_EXECUTE') or die(_("Access Denied."));
class  ThemeSwitcherBlockController extends BlockController {
	 
	protected $btDescription = "Theme switcher block.";
	protected $btName = "Theme Switcher";
	protected $btTable = 'btThemeSwitcher';
	protected $btInterfaceWidth = "420";
	protected $btInterfaceHeight = "350";
	

	/** 
	 * Used for localization. If we want to localize the name/description we have to include this
	 */
	public function getBlockTypeDescription() {
		return t("Theme switcher block.");
	}
	
	public function getBlockTypeName() {
		return t("Theme Switcher");
	} 
	function on_page_view(){
		$html = Loader::helper('html');
		$this->addHeaderItem('<style type="text/css"> .themeSwitcher select{ margin-top: 10px;} </style>');
		$this->addHeaderItem('<script type="text/javascript"> $(document).ready(function() { $(\'#theme-switcher\').change(function(){ this.submit(); }); }); </script>');
	}
	
	function view(){

        Loader::model('page_theme'); 
		//get the list of themes		
		$themeHandles=PageTheme::getList();
		//reverse the array
		$themeHandles= array_reverse($themeHandles);
		//if the cookie exists set the theme
		if($_COOKIE['ccmUserTheme']){
			$theme = $_COOKIE['ccmUserTheme'];
			$this->set('selectedTheme', $theme);
		} else {
			// this will set the default selected theme for the dropdown if no theme is selected
			$current = PageTheme::getSiteTheme();
			$this->set('selectedTheme', $current->getThemeHandle());
		}
		
		// get theme colors from css color files in the css subdirectory of the theme
		/* The themes need to be properly set up and modified for this to work */
		if($_GET['t']){
			$theme = PageTheme::getByHandle($_GET['t']);
			//if the get is set make the cookie
			setcookie("ccmUserTheme", $_GET['t'], time() + 1209600, DIR_REL . '/');	
			$this->set('selectedTheme', $_GET['t']);
			//most ppl won't use this
			/*$dir = $theme->getThemeDirectory().'/css';
			if(file_exists($dir)){
				$files = scandir($dir);
				foreach($files as $file){
					if ($file != '.' && $file != '..'){
						// simple css check 
						$ext = substr($file, strrpos($file, '.') + 1);
						if($ext == 'css'){
							$colors[] = substr($file, 0, -4);
						}
					}
				}
				if ($_GET['c']){
					$this->set('selectedColor', $_GET['c'] );
				} else {
					// TODO: need this to choose the defualt, instead of first one
					$this->set('selectedColor', $colors[0]);
				}
				
				$this->set('colors', $colors );
			}*/
		} 
		
		$this->set('themeHandles', $themeHandles);
	}
	
	function delete() {
	}
	
	function action_switch_theme() {
		$db = Loader::db();
		$c = Page::getCurrentPage();
		
		// get theme and color from form
		$theme=$this->post('theme');
		$color=$this->post('color');
		//$color=$_GET['c'];
		
		// load theme from db
		$pl = PageTheme::getByHandle($theme);
		$url=$c->getCollectionPath();
		
		$dir = $pl->getThemeDirectory().'/css';
		//on theme switch set the cookie
		if ($pl->getThemeID() > 0 ) {
			setcookie("ccmUserTheme", $theme, time() + 1209600, DIR_REL . '/');
		}

		$this->redirect($url);		
		
		//return true;
	}		
	

}

?>