<?php

  // include php file for epe_ev functions.
  include($_SERVER["DOCUMENT_ROOT"] . $GLOBALS["base_path"] . drupal_get_path('module', 'epe_ev') . "/inc/epe_ev_lib.php");

  // set paths for EduVis and epe_ev
  $EduVis_Paths = epe_EduVis_Paths();

  // initialize the tool array
  $ev_tool = array();

  // get the tool details (name, path_css, path_js) from the instance parent reference "field_parent_tool"
  $ev_tool["tool"] = epe_getNodeValues( array("field_tool_name"), $node );

  // add EduVis framework to page
  drupal_add_js( $EduVis_Paths["EduVis"]["javascript"]);

?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="resource-links">
    <ul>
      <li><a href="../node/add/ev-tool-instance/?ev_toolid=<?php print $node->nid; ?>" class="links edit popover-link" title="Creative a Custom Visualization Instance.">CUSTOMIZE</a></li>
    </ul>
  </div>

  <?php 
    $hideActionButtons = 1;
  ?>
<?php include realpath(drupal_get_path('theme','bootstrap')) . '/templates/viewpage.tpl.php'; ?>

  <div style="background-color: #c8d5de;padding:23px;margin-bottom:20px;">
    <div style="border: 1px solid #0195bd;background-color: #fff;padding:20px 31px;">

      <div id="vistool" style="margin-bottom:20px;"></div>

    </div>
  </div>

<?php

$query = new EntityFieldQuery();
$query->entityCondition('entity_type', 'node')
  ->propertyCondition('type', array('ev_tool_instance'))
  ->propertyOrderBy('created', 'DESC')
  ->fieldCondition('field_parent_tool', 'value', $node->nid, '=')
  ->fieldCondition('field_public_status', 'value', 'Public')
  ->range(0, 10);

$result = $query->execute();

// are there any instances
if(count($result)>0){

?>
  <div class="container-fluid" style="margin-bottom:150px">
    <div class="row-fluid">

      <div class="resource-title"> Published Instances </div>
      <div class="thumbnails">

<?php

  $nids = array_keys($result['node']);
  $nodes = node_load_multiple($nids);
  $node_count = 0;
  foreach($nodes as $id => $instance_node){

    $styleOut="";
    $node_count++;
    if($node_count%2!=0){
      $styleOut = 'margin-left:0 !important;"';
    }
    //print_r($instance_node->body);
?>
    <div class="span6 thumbnail" style="margin-top:6px;<?php echo $styleOut;?>">

      <div class="row-fluid">
        <div class="span5">
          <a href="../node/<?php echo $instance_node->nid;?>">
          <?php echo render(field_view_field('node',$instance_node, 'field_instance_thumbnail', array(
              'label'=>'hidden',
              'settings' => array('image_style' => 'medium')
              )));
          ?></a>
        </div>
        <div class="span7">
          <div>
             <b><a href="../node/<?php echo $instance_node->nid;?>"><?php echo $instance_node->title;?></a></b>
          </div>
          <div>
            <?php echo render(field_view_field('node',$instance_node, 'body',array(
                'label' => 'hidden',
                'type' => 'text_summary_or_trimmed',
                'settings'=>array('trim_length' => 150)
                )));
            ?>
          </div>
        </div>
      </div>
    </div>

<?php

  }
?>

        </div>
    </div>
  </div>

<?php
}

?>

</article>

<script type="text/javascript">

  (function(EduVis){

    EduVis.Environment.setPaths(
      '<?php echo $EduVis_Paths["EduVis"]["root"];?>', // eduvis
      '<?php echo $EduVis_Paths["EduVis"]["tools"];?>', // tools
      '<?php echo $EduVis_Paths["EduVis"]["resources"];?>' // resources
    );

    // load EduVis tool into vistool container
    EduVis.tool.load(
      {
        "name" : "<?php print $ev_tool['tool']['field_tool_name'];?>",
        "tool_container_div": "vistool"
      }
    );

  }(EduVis));

</script>
