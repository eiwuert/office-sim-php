<?php if( is_array($stats) && !empty($stats) ): ?>
	<ul>
		<?php foreach($stats AS $stat): ?>
			<li><?php echo $stat['hour']; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>