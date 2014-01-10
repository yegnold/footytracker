<table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th>Date</th>
			<th colspan="2">Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($matches as $match)
		<tr>
			<td>{{{ \Carbon\Carbon::parse($match->match_date)->formatLocalized('%A %d %B %Y') }}}</td>
			<td><a class="btn btn-info btn-sm" href="{{ url('match/edit/'.$match->id) }}"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a></td>
			<td><a class="btn btn-warning btn-sm" href="{{ url('match/delete/'.$match->id) }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a></td>
		</tr>
		@endforeach
	</tbody>
</table>