<tabs>
  <pane ng-repeat="pane in panes.table" heading="{{pane.type}} ({{pane.data.length}})" active="pane.active">
    <ul>
    <li ng-repeat="row in pane.data | resourceFilter:query.userid  | orderBy:sort:reverse">
    <a href="{{row.url}}"><img ng-src="{{row.thumbnail}}" /></a><br/>
    <a href="{{row.url}}">{{row.title}}</a><br/>
    {{row.last_updated}} <br/>
    {{row.author}} <br/>
    {{row.last_updated}}
    </li>
    </ul>
  </pane>
</tabs>
