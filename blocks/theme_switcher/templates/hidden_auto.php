<?php  defined('C5_EXECUTE') or die("Access Denied.");
<?php  defined('C5_EXECUTE') or die("Access Denied.");
/*
Added by John Liddiard (aka JohntheFish) www.c5magic.co.uk
*/
if($page->isEditMode() || $page->isAdminArea()){
	?>
	<div class="ccm-edit-mode-disabled-item">
		<div style="padding:8px">
			<?php 
				echo t('Theme Switcher, disabled in Edit Mode');
			?>
		</div>
	</div>
	<?php 
} 
?>
<div class="theme-switcher-reset" style="display:none">
	<form method="post" action="<?php  echo $this->action('switch_theme')?>" class="theme-switcher">
		<input type="hidden" name="theme" value="<?php echo $selectedTheme;?>" >
		<input type="submit" name="next_theme" value=">" >
	</form>
</div>
