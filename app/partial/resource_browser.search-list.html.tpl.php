<tabs>
  <pane ng-repeat="pane in panes.table" heading="{{pane.type}} ({{pane.data.length}})" active="pane.active">
  <table>
    <thead>
      <th>Thumbnail</th>
      <th><a ng-click="sort='title'; reverse=!reverse">Title</a></th>
      <th><a ng-click="sort='author'; reverse=!reverse">Author</a></th>
      <th><a ng-click="sort='last_updated'; reverse=!reverse">Mod date</a></th>
    </thead>
    <tbody>
      <tr ng-repeat="row in pane.data | resourceFilter:query.userid  | orderBy:sort:reverse">
        <td><a href="{{row.url}}"><img ng-src="{{row.thumbnail}}" /></a></td>
        <td><a href="{{row.url}}">{{row.title}}</a></td>
        <td>{{row.author}}</td>
        <td>{{row.last_updated}}</td>
      </tr>
    </tbody>
  </table>
  </pane>
</tab>

