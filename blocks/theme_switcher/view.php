<?php  defined('C5_EXECUTE') or die("Access Denied.");

$form = Loader::helper('form');
?>

<div class="themeSwitcher">
	<form method="post" action="<?php  echo $this->action('switch_theme')?>" class="theme-switcher">
		<h2><?php  echo $title?></h2>
		<select name="theme">
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
