<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));

$form = Loader::helper('form');

?>


<div class="themeSwitcher">
	<?php   //get the title?>
	<h2><?php   echo $title?></h2>
		
	<form method="post" action="<?php   echo $this->action('switch_theme')?>" id="theme-switcher">
		<select style="width: 175px; " id="theme" name="theme" class="ccm-input-select">
			<?php   //get all the themes ?>
			<?php   foreach($themeHandles as $theme){ ?>
			<?php  
				$themeName=$theme->getThemeName();
				$themeHandle=$theme->getThemeHandle();
			?>
			<option value="<?php   echo $themeHandle ?>"<?php   if ($themeHandle == $selectedTheme){echo ' selected=\'selected\'';}?>><?php   echo $themeName ?></option>
			<?php   } ?>
		</select>
		<?php   if($colors){ ?>
		<br/>
		<b>Color</b> <select style="width: 120px;" id="color" name="color" class="ccm-input-select">
			<?php   foreach($colors as $color){ ?>
			<option value="<?php   echo $color ?>"<?php   if ($color == $selectedColor){echo ' selected=\'selected\'';}?>><?php   echo $color ?></option>
			<?php   } ?>
		</select>
		<?php   } ?>
		<?php   //echo $form->select('theme', $themeList , array('style' => 'width: 120px'));?>
		<br/><br/>
		<?php   // echo $form->submit('submit', 'Submit');?>	
	</form>
	
	<?php  
	if ($info){
	foreach ($info as $info){ ?>
	<p><?php   echo $info ?></p>
	<?php   }
	}?>
</div>