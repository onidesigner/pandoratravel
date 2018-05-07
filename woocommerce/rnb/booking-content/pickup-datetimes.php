<?php
	$labels = reddq_rental_get_settings( get_the_ID(), 'labels', array('pickup_date') );
	$displays = reddq_rental_get_settings( get_the_ID(), 'display' );
	$labels = $labels['labels'];
	$displays = $displays['display'];
?>
<?php if((isset($displays['pickup_date']) && $displays['pickup_date'] !== 'closed') 
		|| (isset($displays['pickup_time']) && $displays['pickup_time'] !== 'closed')): ?>
<div class="date-time-picker">
<h5><?php echo esc_attr($labels['pickup_datetime']); ?></h5>
<table>
	<tr>
	<?php if(isset($displays['pickup_date']) && $displays['pickup_date'] !== 'closed'): ?>
		<td>
			<span class="pick-up-date-picker">
				<i class="fa fa-calendar"></i>
				<input type="text" name="pickup_date" id="pickup-date" placeholder="<?php echo esc_attr($labels['pickup_date']); ?>" value="">
			</span>
		</td>
	<?php endif; ?>

	<?php if(isset($displays['pickup_time']) && $displays['pickup_time'] !== 'closed'): ?>
		<td>
			<span class="pick-up-time-picker">
				<i class="fa fa-clock-o"></i>
				<input type="text" name="pickup_time" id="pickup-time" placeholder="<?php echo esc_attr($labels['pickup_time']); ?>" value="">
			</span>
		</td>
	<?php endif; ?>
	</tr>
</table>
</div>
<?php endif; ?>