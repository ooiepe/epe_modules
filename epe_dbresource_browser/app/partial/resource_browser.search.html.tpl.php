<div class="rb-search-filter">
<select ng-init="filter.view_type=resource.view_types[0]" ng-options="type.label for type in resource.view_types" ng-model="filter.view_type" ng-change="fn.changeViewType()"></select>

<form ng-submit="search()">
<div class="form-horizontal">
<input type="text" ng-model="term" value="" placeholder="Search by Keyword"> <input type="submit" class="btn" value="Search">
</div>
</form>
</div>

<div ng-show="panes.showtabs == true">
<div class="rb-type-selector">
	<ul>
    <li ng-repeat="pane in panes.table" data-api="{{pane.api}}" class="{{pane.api}} {{pane.activeClass}}" ng-click="fn.activeTab(pane);"><span>({{pane.recordcount}})</span></li>
	</ul>
</div>

<div class="rb-ads">
  <div ng-repeat="pane in panes.table" ng-show="pane.showad"><a href="<?php echo base_path(); ?>{{pane.adurl}}"><img ng-src="<?php echo base_path() . drupal_get_path('module','epe_dbresource_browser') ?>/images/rb-ads-{{pane.api}}.jpg" width="247" height="65"></a></div>
</div>
</div>


<!--<div id="rb-list-toggle" class="btn-group">
  <button type="button" class="btn btn-primary" ng-model="radioModel" btn-radio="'list'">List</button>
  <button type="button" class="btn btn-primary" ng-model="radioModel" btn-radio="'grid'">Grid</button>
</div>
-->
<br clear="all">
<div ng-include="view_templates.list"></div>

<!-- <div ng-switch="radioModel">
  <div ng-switch-when="list" ng-include="view_templates.list"></div>
  <div ng-switch-when="grid" ng-include="view_templates.grid"></div>
</div> -->
