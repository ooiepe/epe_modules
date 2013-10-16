<?php echo drupal_render($content); ?>
<div class="row">
  <div class="span4">
    <div class="control-group">
      <label>Knowledge Base</label>
      <?php echo views_embed_view('epe_help_sections','kb'); ?>
    </div>
    <div class="control-group">
      <label>Concept Map</label>
      <?php echo views_embed_view('epe_help_sections','cm'); ?>
    </div>
  </div>
  <div class="span4">
    <div class="control-group">
      <label>Visualization</label>
      <?php echo views_embed_view('epe_help_sections','ev'); ?>
    </div>
    <div class="control-group">
      <label>Resources</label>
      <?php echo views_embed_view('epe_help_sections','db'); ?>
    </div>
  </div>
  <div class="span4">
    <div class="control-group">
      <form action="<?php echo base_path(); ?>help/search" method="get">
        <input name="search" size="40" /><button class="btn btn-small btn-primary">Search</button>
      </form>
    </div>
    <div class="control-group">
      <label>Lab Lessons</label>
      <?php echo views_embed_view('epe_help_sections','llb'); ?>
    </div>
  </div>
</div>
