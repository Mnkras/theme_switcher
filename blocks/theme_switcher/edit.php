<?php  defined('C5_EXECUTE') or die("Access Denied.");

?>
<label>
	<?php
		echo t('Name:');
	?>
</label>
<?php
	echo $form->text('title', $title, array('style' => 'width: 220px'));
?>
<label style="margin-top:15px">
	<?php
		// Modified by JohnTheFish for autoplay timer
		echo t('Auto switcher delay: ');
	?>
	<span class="my_auto_slider">
		<?php
		if (!empty($auto)){
		  echo $auto;
		} else {
		  echo '0';
		}
		?>
	</span>&nbsp;
	<?php
		echo t('seconds');
	?>
</label>

<?php
echo $form->text('auto', $percentage_field, array('class'=>'my_auto_slider'));
?>

<div class="my_auto_slider" style="margin:5px">
</div>
<script type="text/javascript">
(function($){
	$('input.my_auto_slider').hide();
	$('div.my_auto_slider').
	  slider(
		{ min  : 0,
		  step : 1,
		  max  : 120,
		  value: parseInt($('span.my_auto_slider').text(),10),
		  slide: function(event, uiobj) {
				   $('span.my_auto_slider').text(uiobj.value);
				   $('input.my_auto_slider').val(uiobj.value);
				 }
		});
})(jQuery);
</script>
