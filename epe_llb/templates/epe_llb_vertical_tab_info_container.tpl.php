<?php if($step_previous || $step_this || $step_next): ?>


<div class="llb-bb">
	<div class="llb-bb-header">
	<h3>Backward Design Approach</h3>
	<span><a href="<?php echo base_path() . "node/214" ?>" target="_blank">Learn More</a></span>
	<br clear="all">
	</div>
	<div class="llb-bb-body">
		<div class="llb-bb-previous">
		<?php echo $step_previous; ?>
		</div>
		<div class="llb-bb-this">
		<?php echo $step_this; ?>
		</div>
		<div class="llb-bb-next">
		<?php echo $step_next; ?>
		</div>
	</div>
</div>
<br clear="all">



<?php endif; ?>
