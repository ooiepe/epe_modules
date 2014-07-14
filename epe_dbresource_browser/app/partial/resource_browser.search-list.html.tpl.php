<tabset id="rb-tabs">
  <tab ng-repeat="pane in panes.table" heading="{{pane.type}} ({{pane.data.length}})" active="pane.active" select="fn.activeTab(pane);">
  <table id="rb-tab-pane-{{pane.api}}">
    <thead>
      <th><a ng-click="sort='title'; reverse=!reverse">Title/Info</a></th>
      <th width="134"><a ng-click="sort='author'; reverse=!reverse">Author</a></th>
      <th width="134"><a ng-click="sort='last_updated'; reverse=!reverse">Modify date</a></th>
    </thead>
    <tbody>
      <tr ng-show="!pane.hasrecord">
        <td colspan="3" style="text-align:center;">No {{pane.type}} Found</td>
      </tr>
      <tr ng-repeat="row in pane.data | resourceFilter:query.filter | orderBy:sort:reverse | startFrom:pane.currentPage*pane.pageSize | limitTo:pane.pageSize"
        table-row
        checkbox="pane.show_checkbox" row="row" type="pane.api" dialogmode="panes.dialogmode">
      </tr>
    </tbody>
  </table>

  <div ng-show="pane.data.length > pane.pageSize" class="pagination">
  <button ng-disabled="pane.currentPage == 0" ng-click="pane.currentPage=pane.currentPage-1">Previous</button>
  {{pane.currentPage+1}}/{{pane.numberOfPages()}}
  <button ng-disabled="pane.currentPage >= pane.data.length/pane.pageSize - 1" ng-click="pane.currentPage=pane.currentPage+1">Next</button>
  </tab>
  </div>
</tabset>
