<tabs>
  <pane ng-repeat="pane in panes.table" heading="{{pane.type}} ({{pane.data.length}})" active="pane.active">
    <ul>
    <li ng-repeat="row in pane.data | resourceFilter:query.userid  | orderBy:sort:reverse">
      <div list-item
        checkbox="pane.show_checkbox" id="row.id" type="pane.api" url="row.url" thumbnail="row.thumbnail" title="row.title" author="row.author" updated="row.last_updated" />
    </li>
    </ul>
  </pane>
</tabs>
