<?php  defined('C5_EXECUTE') or die("Access Denied.");

$form = Loader::helper('form');
?>

<div class="ccm-ui themeSwitcher">
	<h2><?php  echo $title?></h2>
		
	<form method="post" action="<?php  echo $this->action('switch_theme')?>" class="theme-switcher">
		<select name="theme" class="ccm-input-select">
			<?php  
			foreach($themeHandles as $theme){ 
				$themeName = $theme->getThemeName();
				$themeHandle = $theme->getThemeHandle();
				$selected = '';
				if($themeHandle == $selectedTheme) {
					$selected = ' selected="selected"';
				}
				
				echo '<option value="'.$themeHandle.'"'.$selected.'>'.$themeName.'</option>';
			} ?>
		</select>
	</form>
</div>
