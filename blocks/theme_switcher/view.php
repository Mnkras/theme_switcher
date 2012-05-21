<?php defined('C5_EXECUTE') or die("Access Denied.");

$form = Loader::helper('form');
?>

<div class="themeSwitcher">
	<h2><?php echo $title?></h2>
		
	<form method="post" action="<?php echo $this->action('switch_theme')?>" id="theme-switcher">
		<select style="width: 175px; " id="theme" name="theme" class="ccm-input-select">
			<?php 
			foreach($themeHandles as $theme){ 
				$themeName = $theme->getThemeName();
				$themeHandle = $theme->getThemeHandle();
			?>
			<option value="<?php   echo $themeHandle ?>"<?php   if ($themeHandle == $selectedTheme){echo ' selected=\'selected\'';}?>><?php echo $themeName;?></option>
			<?php } ?>
		</select>
	</form>
</div>