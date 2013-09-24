<select ng-options="type.label for type in resource.view_types" ng-model="filter.view_type"></select>

<form ng-submit="search()">
<input type="text" ng-model="term" value=""> <input type="submit" class="btn" value="Search">
</form>

<div class="btn-group">
  <button type="button" class="btn btn-primary" ng-model="radioModel" btn-radio="'list'">List</button>
  <button type="button" class="btn btn-primary" ng-model="radioModel" btn-radio="'grid'">Grid</button>
</div>

<div ng-switch="radioModel">
  <div ng-switch-when="list" ng-include="view_templates.list"></div>
  <div ng-switch-when="grid" ng-include="view_templates.grid"></div>
</div>
