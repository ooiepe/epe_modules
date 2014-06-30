<tabset id="rb-tabs">
  <tab ng-repeat="pane in panes.table" heading="{{pane.type}} ({{pane.recordcount}})" active="pane.active" select="fn.activeTab(pane);">
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

  <div ng-show="pane.total_pages > 1" class="pagination">
  <button ng-disabled="pane.currentPage == 0" ng-click="fn.toPrevPage(pane)">Previous</button>
  {{pane.currentPage+1}}/{{pane.total_pages}}
  <button ng-disabled="pane.currentPage >= pane.total_pages - 1" ng-click="fn.toNextPage(pane)">Next</button>
  </tab>
  </div>
</tabset>
