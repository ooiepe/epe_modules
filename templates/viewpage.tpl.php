
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-tooltip.js"></script>
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-popover.js"></script>



<style>
.node-tabs, .action-links {
  display: none;
}
.page-header {
  display: none;

}

</style>

<?php 

$hasAccess_Clone = 0;
if ($router_item = menu_get_item("node/" . $node -> nid . "/clone/")) {
  if ($router_item['access']) {
    $hasAccess_Clone = 1;
  }
}

$hasAccess_Edit = 0;
if ($router_item = menu_get_item("node/" . $node -> nid . "/edit/")) {
  if ($router_item['access']) {
    $hasAccess_Edit = 1;
  }
}

$hasAccess_Delete = 0;
if ($router_item = menu_get_item("node/" . $node -> nid . "/delete/")) {
  if ($router_item['access']) {
    $hasAccess_Delete = 1;
  }
}

$hasAccess_Publish = 0;
if ($router_item = menu_get_item("node/" . $node -> nid . "/edit/")) {
  if ($router_item['access']) {
    $hasAccess_Publish = 1;
  }
}

$hasAccess_Share = 0;
if ($router_item = menu_get_item("node/" . $node -> nid . "/edit/")) {
  if ($router_item['access']) {
    $hasAccess_Share = 1;
  }
}

$hasAccess_ApprovePublish = 0;
if ($router_item = menu_get_item("node/" . $node -> nid . "/approvepublic/")) {
  if ($router_item['access']) {
    $hasAccess_ApprovePublish = 1;
  }
}



$field_public_status = 'Private';
if (!empty($node->field_public_status['und'][0]['value'])) {
  $field_public_status = $node->field_public_status['und'][0]['value'];
}

?>



<style>



.resource-links {
  float: right;
}


.resource-links ul {
    list-style-type: none;
}

.resource-links ul li {
    float: left;
    padding-left: 20px;
}

.resource-links ul li a.links {
    color: #356281;
    text-decoration: none;
    background-position: left center;
    background-repeat: no-repeat;
    padding-left: 30px;
    height: 22px;
    display: block;
}

.resource-links ul li a.copy {
    background-image: url(<?php echo base_path() . path_to_theme() ?>/images/icon_copy.jpg);
}
.resource-links ul li a.edit {
    background-image: url(<?php echo base_path() . path_to_theme() ?>/images/icon_edit.jpg);
}
.resource-links ul li a.delete {
    background-image: url(<?php echo base_path() . path_to_theme() ?>/images/icon_delete.jpg);
}
.resource-links ul li a.publish {
    background-image: url(<?php echo base_path() . path_to_theme() ?>/images/icon_publish.jpg);
}
.resource-links ul li a.share {
    background-image: url(<?php echo base_path() . path_to_theme() ?>/images/icon_share.jpg);
}


.resource-heading {
  padding-bottom: 20px;
}

.resource-title {
  color: #aa5f0c;
  font-weight: bold;
  font-size: 24px;
  padding-bottom: 10px;
}

.resource-author {
  color: #000;
}


#comments .title {
  color: #aa5f0c;
  font-weight: bold;
  font-size: 24px;
  padding-bottom: 10px;

}

#comments .form-item-subject, #comments #edit-preview, #comments .form-type-item {
  display: none;
}



</style>


<?php if ($hasAccess_ApprovePublish == 1 && $field_public_status == 'Pending'): ?>
    <div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Please Review</h4>
    This item has been submitted for review and inclusion in the public database. Please review this item and approve or reject as appropriate.<br><br>
    <a class="btn btn-success" href="<?php echo base_path() . "node/" . $node -> nid ?>/approvepublic/">Approve</a> <a class="btn btn-danger" href="<?php echo base_path() . "node/" . $node -> nid ?>/rejectpublic/">Reject</a>

    </div>
<?php endif; ?>


<div class="resource-links">
  <ul>

<?php if ($hasAccess_Clone == 1): ?>
    <li><a href="<?php echo base_path() . "node/" . $node -> nid ?>/clone/" class="links copy">COPY</a></li>
<?php endif; ?>

<?php if ($field_public_status == 'Public' && $hasAccess_Edit == 1): ?>
    <li><a href="#" class="links edit popover-link" id="edit-btn">EDIT</a></li>
<?php elseif ($hasAccess_Edit == 1): ?>
    <li><a href="<?php echo base_path() . "node/" . $node -> nid ?>/edit/" class="links edit"  id="edit-btn">EDIT</a></li>
<?php endif; ?>

<?php if ($hasAccess_Delete == 1): ?>
    <li><a href="#" class="links delete popover-link" id="delete-btn">DELETE</a></li>
<?php endif; ?>

<?php if ($hasAccess_Publish == 1): ?>
    <li><a href="#" class="links publish popover-link" id="publish-btn">PUBLISH</a></li>
<?php endif; ?>

<?php if ($hasAccess_Share == 1): ?>
    <li><a href="#" class="links share popover-link" id="share-btn">SHARE</a></li>
<?php endif; ?>

  </ul>
</div>

<div class="resource-heading">
  <div class="resource-title"><?php print $node -> title ?></div>
  <div class="resource-author"><strong>Created by:</strong> <?php print $node -> name ?></div>
  
  <?php if( !empty($node -> body) ): ?>
      <div class="resource-description"><?php print $node -> body['und'][0]['value'] ?> </div>
  <?php endif; ?>

</div>

<script type="text/javascript">

function loadMenu() {
  (function($) {


<?php if ($field_public_status == 'Public' && $hasAccess_Edit == 1): ?>
    $('#edit-btn').popover({title: '<a style="float:right;margin-top:-9px;" href="#" onclick="closeEditConfirm(); return false;"><i class="icon-remove"></i></button>', html: 'true', placement: 'bottom', content: 'Your resource is currently visible in the public database.<br><br>Please unpublish this resource before editing.<br><br><div align="center"><button onclick="closeEditConfirm();" class="btn">OK</button></div>'});
<?php endif; ?>

<?php if ($field_public_status == 'Public' && $hasAccess_Delete == 1): ?>
    $('#delete-btn').popover({title: '<a style="float:right;margin-top:-9px;" href="#" onclick="closeDeleteConfirm(); return false;"><i class="icon-remove"></i></button>', html: 'true', placement: 'bottom', content: 'Your resource is currently visible in the public database.<br><br>Please unpublish this resource before deleting.<br><br><div align="center"><button onclick="closeDeleteConfirm();" class="btn">OK</button></div>'});
<?php elseif ($hasAccess_Delete == 1): ?>
    $('#delete-btn').popover({title: '<a style="float:right;margin-top:-9px;" href="#" onclick="closeDeleteConfirm(); return false;"><i class="icon-remove"></i></button>', html: 'true', placement: 'bottom', content: 'Are you sure you wish to delete this resource?<br><br><div align="center"><a class="btn btn-primary" href="<?php echo base_path() . "node/" . $node -> nid ?>/deleteresource/">Yes</a>&nbsp;&nbsp;<button onclick="closeDeleteConfirm();" class="btn">No</button></div>'});
<?php endif; ?>

<?php if ($node->status == 0 && $hasAccess_Share == 1): ?>
      $('#share-btn').popover({title: '<a style="float:right;margin-top:-9px;" href="#" onclick="closeShareConfirm(); return false;"><i class="icon-remove"></i></button>', html: 'true', placement: 'bottom', content: 'Do you wish to share this resource with anyone with the link?<br><br><div align="center"><a class="btn btn-primary" href="<?php echo base_path() . "node/" . $node -> nid ?>/share/">Yes</a>&nbsp;&nbsp;<button onclick="closeShareConfirm();" class="btn">No</button></div>'});
<?php elseif ($hasAccess_Share == 1): ?>
      $('#share-btn').popover({title: '<a style="float:right;margin-top:-9px;" href="#" onclick="closeShareConfirm(); return false;"><i class="icon-remove"></i></button>', html: 'true', placement: 'bottom', content: 'Your resource is shared and is visible to anyone with the link.<br><br>Link to share:<br><input type="text" class="input" style="width:100%;" value="<?php echo $GLOBALS['base_url'] . "/node/" . $node -> nid ?>"><br><br>You may unshare your resource at any time.<br><br><div align="center"><a class="btn btn-primary" href="<?php echo base_path() . "node/" . $node -> nid ?>/unshare/">Unshare</a></div><br>Note: Others may be using your resource and care should be taken when Unpublishing.</div>'});
<?php endif; ?>

<?php if ($field_public_status == 'Private' && $hasAccess_Publish == 1): ?>
      $('#publish-btn').popover({title: '<a style="float:right;margin-top:-9px;" href="#" onclick="closePublishConfirm(); return false;"><i class="icon-remove"></i></button>', html: 'true', placement: 'bottom', content: 'Do you wish to submit this resource for review and inclusion in the public database?<br><br><div align="center"><a class="btn btn-primary" href="<?php echo base_path() . "node/" . $node -> nid ?>/submitpublic/">Yes</a>&nbsp;&nbsp;<button onclick="closePublishConfirm();" class="btn">No</button></div>'});
<?php elseif ($field_public_status == 'Pending' && $hasAccess_Publish == 1): ?>
      $('#publish-btn').popover({title: '<a style="float:right;margin-top:-9px;" href="#" onclick="closePublishConfirm(); return false;"><i class="icon-remove"></i></button>', html: 'true', placement: 'bottom', content: 'This resource is currently under review for inclusion in the public database.<br><br>You may withdraw this item from review at any time.<br><br><div align="center"><a class="btn btn-primary" href="<?php echo base_path() . "node/" . $node -> nid ?>/unsubmitpublic/">Unpublish</a></div>'});
<?php elseif ($field_public_status == 'Public' && $hasAccess_Publish == 1): ?>
      $('#publish-btn').popover({title: '<a style="float:right;margin-top:-9px;" href="#" onclick="closePublishConfirm(); return false;"><i class="icon-remove"></i></button>', html: 'true', placement: 'bottom', content: 'This resource is visible in the public database.<br><br>You may withdraw this item from review at any time.<br><br><div align="center"><a class="btn btn-primary" href="<?php echo base_path() . "node/" . $node -> nid ?>/unsubmitpublic/">Unpublish</a></div><br>Note: Others may be using your resource and care should be taken when Unpublishing.</div>'});
<?php endif; ?>


$('body').on('click', function (e) {
    $('.popover-link').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});


  })(jQuery);
}

function closeEditConfirm() {
  jQuery('#edit-btn').popover('hide');
}
function closeDeleteConfirm() {
  jQuery('#delete-btn').popover('hide');
}
function closeShareConfirm() {
  jQuery('#share-btn').popover('hide');
}
function closePublishConfirm() {
  jQuery('#publish-btn').popover('hide');
}


</script>

<?php drupal_add_js('jQuery(document).ready(function () { loadMenu(); });', array('type' => 'inline', 'scope' => 'footer', 'weight' => 5)); ?>

