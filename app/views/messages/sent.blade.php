@extends('template/layout')

@section('content')
<h1>Sent Messages</h1>
<div class="row">
	<div class="col-sm-12">
		@if($messages->isEmpty())
			<p>You haven't sent any messages yet!</p>
		@else
			<table class='table table-striped table-bordered' id="results-table">
				<thead>
					<tr>
						<th width="300">Message</th>
						<th>Success</th>
						<th>Sent By</th>
						<th>Date</th>
					</tr>
				</thead>
			@foreach($messages as $message)
				<tr>
					<td><strong>"{{$message->text}}"</strong><br />Sent to Group: <span class="badge">{{ $message->group_name }}</span><br /><a href='{{url("/messages/sent")}}/{{$message->id}}'>View Results</a> </td>
					<td>{{ $message->sentResult() }}</td>
					<td>{{$message->sent_by}}</td>
					<td>{{$message->created_at->toDayDateTimeString()}}</td>
				</tr>
			@endforeach
			</table>
		@endif
	</div>
</div>
@stop