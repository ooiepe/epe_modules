<tabset id="rb-tabs">
  <tab ng-repeat="pane in panes.table" heading="{{pane.type}} ({{pane.data.length}})" active="pane.active" select="fn.activeTab(pane);">
  <table id="rb-tab-pane-{{pane.api}}">
    <thead>
      <th><a ng-click="sort='title'; reverse=!reverse">Title/Info</a></th>
      <th width="185"><a ng-click="sort='author'; reverse=!reverse">Author</a></th>
      <th width="134"><a ng-click="sort='last_updated'; reverse=!reverse">Modify date</a></th>
    </thead>
    <tbody>
      <tr ng-repeat="row in pane.data | resourceFilter:query.filter | orderBy:sort:reverse"
        table-row
        checkbox="pane.show_checkbox" id="row.id" type="pane.api" url="row.url" thumbnail="row.thumbnail" title="row.title" author="row.author" updated="row.last_updated">
      </tr>
    </tbody>
  </table>
  </tab>
</tabset>
