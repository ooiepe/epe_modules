<tabset>
  <tab ng-repeat="pane in panes.table" heading="{{pane.type}} ({{pane.data.length}})" active="pane.active" select="fn.activeTab(pane);">
  <table>
    <thead>
      <th></th>
      <th><a ng-click="sort='title'; reverse=!reverse">Title</a></th>
      <th><a ng-click="sort='author'; reverse=!reverse">Author</a></th>
      <th><a ng-click="sort='last_updated'; reverse=!reverse">Mod date</a></th>
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

<!--
<tabs>
  <pane ng-repeat="pane in panes.table" heading="{{pane.type}} ({{pane.data.length}})" active="pane.active" select="fn.activeTab(pane);">
  <table>
    <thead>
      <th></th>
      <th><a ng-click="sort='title'; reverse=!reverse">Title</a></th>
      <th><a ng-click="sort='author'; reverse=!reverse">Author</a></th>
      <th><a ng-click="sort='last_updated'; reverse=!reverse">Mod date</a></th>
    </thead>
    <tbody>
      <tr ng-repeat="row in pane.data | resourceFilter:query.filter | orderBy:sort:reverse"
        table-row
        checkbox="pane.show_checkbox" id="row.id" type="pane.api" url="row.url" thumbnail="row.thumbnail" title="row.title" author="row.author" updated="row.last_updated">
      </tr>
    </tbody>
  </table>
  </pane>
</tab>
-->
