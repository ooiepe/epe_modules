<form ng-submit="search()">

<input type="text" ng-model="term">

<div class="btn-group">
  <button type="button" class="btn btn-primary" ng-model="radioModel.id" ng-repeat="module in resource_modules" btn-radio="module.api">{{module.label}}</button>
</div>

<input type="submit" class="btn btn-primary" value="Submit">

</form>
