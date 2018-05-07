<?php
		$labels = reddq_rental_get_settings( get_the_ID(), 'labels', array('return_date') );
		$displays = reddq_rental_get_settings( get_the_ID(), 'display' );
		$labels = $labels['labels'];
		$displays = $displays['display'];
?>
<?php if((isset($displays['return_date']) && $displays['return_date'] !== 'closed')
			|| (isset($displays['return_time']) && $displays['return_time']!=='closed')): ?>
<div class="date-time-picker">
<h5><?php echo esc_attr($labels['return_datetime']); ?></h5>
<table>
	<tr>
	<?php if(isset($displays['return_date']) && $displays['return_date'] !== 'closed'): ?>
		<td>
			<span class="drop-off-date-picker">
				<i class="fa fa-calendar"></i>
				<input type="text" name="dropoff_date" id="dropoff-date" placeholder="<?php echo esc_attr($labels['return_date']); ?>" value="">
			</span>
		</td>
	<?php endif; ?>

	<?php if(isset($displays['return_time']) && $displays['return_time']!=='closed'): ?>
		<td>
			<span class="drop-off-time-picker">
				<i class="fa fa-clock-o"></i>
				<input type="text" name="dropoff_time" id="dropoff-time" placeholder="<?php echo esc_attr($labels['return_time']); ?>" value="">
			</span>
		</td>
	<?php endif; ?>
	</tr>
</table>
</div>
<?php endif; ?>