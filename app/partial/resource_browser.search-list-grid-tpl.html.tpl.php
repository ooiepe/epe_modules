<ul>
<li ng-repeat="row in data | resourceFilter:query.userid  | orderBy:sort:reverse">
<a href="{{row.url}}"><img ng-src="{{row.thumbnail}}" /></a><br/>
<a href="{{row.url}}">{{row.title}}</a><br/>
{{row.last_updated}} <br/>
{{row.author}} <br/>
userid: {{row.userid}} <br/>
{{row.status}}
</li>
</ul>
