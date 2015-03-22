<form method="get" name="stats_options">
<label>Resource Type:</label>
<select name="type">
  <option value="viz" <?php if($params['type'] == 'viz'): echo 'selected'; endif; ?>>Visualizations</option>
  <option value="cm" <?php if($params['type'] == 'cm'): echo 'selected'; endif; ?>>Concept Maps</option>
  <option value="llb" <?php if($params['type'] == 'llb'): echo 'selected'; endif; ?>>Data Investigations</option>
  <option value="file" <?php if($params['type'] == 'file'): echo 'selected'; endif; ?>>File resources</option>
</select>

<label>Frequency</label>
<select name="frequency">
  <option value="month" <?php if($params['frequency'] == 'month'): echo 'selected'; endif; ?>>Month</option>
  <option value="year" <?php if($params['frequency'] == 'year'): echo 'selected'; endif; ?>>Year</option>
  <option value="all" <?php if($params['frequency'] == 'all'): echo 'selected'; endif; ?>>All Time</option>
</select>

<input type="submit" value="submit" />
</form>

<?php if($output) { echo $output; } ?>
