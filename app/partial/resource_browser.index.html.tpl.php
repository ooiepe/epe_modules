<form ng-submit="search()">

<input type="text" ng-model="term">

<div class="btn-group">
  <button type="button" class="btn btn-primary" ng-model="radioModel" btn-radio="'image'">Images</button>
  <button type="button" class="btn btn-primary" ng-model="radioModel" btn-radio="'document'">Documents</button>
  <button type="button" class="btn btn-primary" ng-model="radioModel" btn-radio="'multimedia'">Multimedia</button>
</div>

<input type="submit" class="btn btn-primary" value="Submit">

</form>
