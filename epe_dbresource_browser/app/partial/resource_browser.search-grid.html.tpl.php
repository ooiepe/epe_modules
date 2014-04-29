<tabset>
  <tab ng-repeat="pane in panes.table" heading="{{pane.type}} ({{pane.data.length}})" active="pane.active" select="fn.activeTab(pane);">
    <ul>
    <li ng-repeat="row in pane.data | resourceFilter:query.filter | orderBy:sort:reverse">
      <div list-item
        checkbox="pane.show_checkbox" id="row.id" type="pane.api" url="row.url" thumbnail="row.thumbnail" title="row.title" author="row.author" updated="row.last_updated" org="row.org" />
    </li>
    </ul>
  </tab>
</tabset>