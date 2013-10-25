<style type="text/css">
.rb-search-filter {
	float: left;
	padding-right: 25px;
}

.rb-type-selector {
	float: left;
	padding-right: 25px;
}


.rb-table-wrapper {
  border: 1px solid #0094bb;
}

table.ng-scope {
    width: 100%;
    border-width: 1px;
    border-spacing: 2px;
    border-style: solid;
    border-color: #0094bb;
    border-collapse: collapse;
    background-color: white;
}
table.ng-scope th {
    border-width: 1px;
    padding: 3px 1px;
    border-style: solid;
    border-color: #cbcbcb;
    background-color: #979797;
    -moz-border-radius: ;
    text-align: left;
    padding-left: 13px;
    color: #fff;
    font-weight: normal;
}
table.ng-scope th a {
  color: #fff;
}

table.ng-scope td {
    border-width: 1px;
    padding: 1px;
    border-style: solid;
    border-color: #cbcbcb;
    background-color: #ffffff;
    -moz-border-radius: ;
    vertical-align:top;
    padding: 13px;
    color: #000;
}
table.ng-scope tr:hover td {
    background-color: #ebf7fb;
    border-color: #8fbbca;
}

table.ng-scope td input {
	float: left;
	margin-right:10px;
	margin-top:40px;
}


table.ng-scope  tr:hover td .thumb {
  border-color: #0a98be;
}

table.ng-scope td a {
  color: #000;
}

table.ng-scope td .title {
  font-weight: bold;

}

table.ng-scope td .author {
  font-weight: bold;

}



table.ng-scope td .thumb {
    border: 1px solid #c1c1c1;
    margin-right: 15px;
    float: left;
    height: 89px;
}


.rb-type-selector ul {
  list-style: none;
  margin: 0;
}
.rb-type-selector ul li {
  float: left;
  width: 48px;
  height: 65px;
  text-align: center;
}

.rb-type-selector ul li span {
  display: block;
  margin-top: 40px;
  color: #316c83;
  font-size: 12px;

}

.rb-type-selector ul li.cm {
    width: 49px;
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_cm.png);
}
.rb-type-selector ul li.ev {
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_ev.png);
}
.rb-type-selector ul li.llb {
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_llb.png);
}
.rb-type-selector ul li.image {
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_image.png);
}
.rb-type-selector ul li.multimedia {
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_video.png);
}
.rb-type-selector ul li.document {
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_doc.png);
}

.rb-type-selector ul li.active span {
  color: #fff;
}

.rb-type-selector ul li.cm.active {
    width: 49px;
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_cm_sel.png);
}
.rb-type-selector ul li.ev.active {
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_ev_sel.png);
}
.rb-type-selector ul li.llb.active {
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_llb_sel.png);
}
.rb-type-selector ul li.image.active {
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_image_sel.png);
}
.rb-type-selector ul li.multimedia.active {
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_video_sel.png);
}
.rb-type-selector ul li.document.active {
    background-image: url(<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb_buttons_doc_sel.png);
}

.dialog .rb-ads {
	display: none;
}




</style>



<div class="rb-search-filter">
<select ng-options="type.label for type in resource.view_types" ng-model="filter.view_type"></select>

<form ng-submit="search()">
<div class="form-horizontal">
<input type="text" ng-model="term" value=""> <input type="submit" class="btn" value="Search">
</div>
</form>
</div>


<div class="rb-type-selector">
	<ul>
		<li class="cm"><span>0</span></li>
		<li class="ev"><span>0</span></li>
		<li class="llb"><span>0</span></li>
		<li class="image"><span>0</span></li>
		<li class="multimedia"><span>0</span></li>
		<li class="document"><span>0</span></li>
	</ul>
</div>

<div class="rb-ads">
	<div class="rb-ads-cm" style="display:none;"><a href="<?php echo base_path() ?>node/add/cm-resource"><img src="<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb-ads-cm.png" width="247" height="65"></a></div>
	<div class="rb-ads-ev" style="display:none;"><a href="<?php echo base_path() ?>ev/tools"><img src="<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb-ads-ev.png" width="247" height="65"></a></div>
	<div class="rb-ads-llb" style="display:none;"><a href="<?php echo base_path() ?>node/add/llb-resource"><img src="<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb-ads-llb.png" width="247" height="65"></a></div>
	<div class="rb-ads-image" style="display:block;"><a href="<?php echo base_path() ?>resource/add/file"><img src="<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb-ads-image.png" width="247" height="65"></a></div>
	<div class="rb-ads-multimedia" style="display:none;"><a href="<?php echo base_path() ?>resource/add/file"><img src="<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb-ads-video.png" width="247" height="65"></a></div>
	<div class="rb-ads-document" style="display:none;"><a href="<?php echo base_path() ?>resource/add/file"><img src="<?php echo base_path() . drupal_get_path('theme','bootstrap') ?>/images/rb-ads-doc.png" width="247" height="65"></a></div>
</div>

<script type="text/javascript">
jQuery('.rb-type-selector > ul > li').on('click', function (e) {
	typeName = e.currentTarget.className.split(' ');
	typeName = typeName[0];
	switchTabByTypeName(typeName);
});

function switchTabByTypeName(typeName) {
	jQuery('#rb-tabs .tab-pane').removeClass('active');
	jQuery('#rb-tab-pane-' + typeName).parent().addClass('active');

	jQuery('.rb-type-selector > ul > li').removeClass('active');
	jQuery('.rb-type-selector > ul > li.' + typeName).addClass('active');

	jQuery('.rb-ads > div').hide();
	jQuery('.rb-ads-' + typeName).show();

}


</script>





<style type="text/css">
#rb-tabs .nav-tabs {
	display: none;
}

#rb-list-toggle {

	display:none;
}
</style>


<div id="rb-list-toggle" class="btn-group">
  <button type="button" class="btn btn-primary" ng-model="radioModel" btn-radio="'list'">List</button>
  <button type="button" class="btn btn-primary" ng-model="radioModel" btn-radio="'grid'">Grid</button>
</div>

<br clear="all">

<div ng-switch="radioModel">
  <div ng-switch-when="list" ng-include="view_templates.list"></div>
  <div ng-switch-when="grid" ng-include="view_templates.grid"></div>
</div>
