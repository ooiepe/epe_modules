<article class="<?php print $classes . ' ' . $zebra; ?>"<?php print $attributes; ?>>
  
<?php

//print('<pre>');
//print_r($content['comment_body']['#object']->registered_name);
//print('</pre>');


//print('<pre>');
//print_r(format_date($content['comment_body']['#object']->changed, 'long'));
//print('</pre>');


//print('<pre>');
//print_r($content);
//print('</pre>');

    //$submitted = t('NOTSubmitted by !username on !datetime', array('!username' => $content['comment_body']['#object']->registered_name, '!datetime' => $content['comment_body']['#object']->changed);

?>

  <!-- <header>
    <p class="submitted">
      <?php //print $picture; ?>
      <?php //print $submitted; ?>
      <?php //print $permalink; ?>
    </p>

    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h3<?php print $title_attributes; ?>>
        <?php print $title; ?>
        <?php if ($new): ?>
          <mark class="new label label-important"><?php print $new; ?></mark>
        <?php endif; ?>
      </h3>
    <?php elseif ($new): ?>
      <mark class="new label label-important"><?php print $new; ?></mark>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
  </header> -->

  <?php hide($content['links']); ?>
    <div class="comment-item-heading">
      <strong>
        <?php print_r($content['comment_body']['#object']->registered_name); ?>
      </strong>
      <?php print_r(format_date($content['comment_body']['#object']->changed, 'long')); ?>
    </div>
    <?php print render($content); ?>

  <?php if ($signature): ?>
    <footer class="user-signature clearfix">
      <?php print $signature; ?>
    </footer>
  <?php endif; ?>

  <?php print render($content['links']) ?>
</article> <!-- /.comment -->
