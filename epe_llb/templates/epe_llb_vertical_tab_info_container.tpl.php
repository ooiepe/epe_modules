<?php if($step_previous || $step_this || $step_next): ?>

<div class="alert alert-info alert-block">
<div class="row-fluid">
  <div class="row-fluid">
    <?php if($step_previous): ?>
    <div class="span4">
    <?php echo $step_previous; ?>
    </div>
    <?php endif; ?>
    <?php if($step_this): ?>
    <div class="span4">
    <?php echo $step_this; ?>
    </div>
    <?php endif; ?>
    <?php if($step_next): ?>
    <div class="span4">
    <?php echo $step_next; ?>
    </div>
    <?php endif; ?>
  </div>
</div>
</div>

<?php endif; ?>
