<?php  defined('C5_EXECUTE') or die("Access Denied.");
/*
Added by John Liddiard (aka JohntheFish) www.c5magic.co.uk
*/

$form = Loader::helper('form');
?>

<div class="theme-switcher-reset">
	<form method="post" action="<?php  echo $this->action('switch_theme')?>" class="theme-switcher">
		<h3><?php  echo $title?></h3>
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
