@extends('template/layout')

@section('content')
<a href="{{url()}}/messages/sent" class="back-link"><span class="fa fa-arrow-left"></span> Back</a>
<h1>Message Report</h1>
<h3>Sent by <strong>{{ $message->sent_by }}</strong></h3>
<div class="module">
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-info">
			  <div class="panel-heading">
			    <h3 class="panel-title">
			    	<small>{{ $message->created_at->toDayDateTimeString() }}</small><br />
			    	Sent to Group: <span class="badge">{{ $message->group_name }}</span>
			    </h3>
			  </div>
			  <div class="panel-body">
			    <h3>"{{ $message->text }}"</h3>
			  </div>
			</div>
			<p>Message sent to <strong>{{ $sentCount}} recipients</strong><br />
			There were <strong>{{ $errorCount}} recipients</strong> that did not recieve the message due to errors.</p>
		</div>
		<div class="col-sm-6 chart-block">
			<h3>Success Rate: <strong>{{ $message->sentResult() }}</strong></h3>
			<canvas id="chart" width="250" height="250"></canvas>
			<script type="text/javascript">
				$(document).ready(function() {
					var ctx = $("#chart").get(0).getContext("2d");
					var options = {
								    //Boolean - Whether we should show a stroke on each segment
								    segmentShowStroke : true,

								    //String - The colour of each segment stroke
								    segmentStrokeColor : "#fff",

								    //Number - The width of each segment stroke
								    segmentStrokeWidth : 2,

								    //Number - The percentage of the chart that we cut out of the middle
								    percentageInnerCutout : 50, // This is 0 for Pie charts

								    //Number - Amount of animation steps
								    animationSteps : 100,

								    //String - Animation easing effect
								    animationEasing : "easeOutBounce",

								    //Boolean - Whether we animate the rotation of the Doughnut
								    animateRotate : true,

								    //Boolean - Whether we animate scaling the Doughnut from the centre
								    animateScale : false,

								    //String - A legend template
								    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

								}
					var data = [
							    {
							        value: <?= $errorCount ?>,
							        color:"#F7464A",
							        highlight: "#FF5A5E",
							        label: "Not Sent"
							    },
							    {
							        value: <?= $sentCount ?>,
							        color: "#4cae4c",
							        highlight: "#8ad58a",
							        label: "Sent"
							    }
							];
					var myChart = new Chart(ctx).Pie(data,options);
					var legend = myChart.generateLegend();
					$('.chart-block').append(legend);
				})		
			</script>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		@if($recipients->isEmpty())
			<p>This message was sent to no mobile numbers.</p>
		@else
			<table class='table table-striped table-bordered' id="results-table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Mobile</th>
						<th>Status</th>
						<th>SMS Received</th>
						<th>SMS Id</th>
					</tr>
				</thead>
			@foreach($recipients as $recipient)
				<?
					if($recipient->scts){
						$date = rtrim(chunk_split(substr($recipient->scts,0,6),2,'-'),'-');
						$time = rtrim(chunk_split(substr($recipient->scts,-4),2,':'),':');
						$datetime = new DateTime($date.' '.$time, new DateTimeZone('UTC')); // Timestamp received in UTC
						$datetime->setTimezone(new DateTimeZone(Config::get('app.timezone'))); // Convert to Hong Kong time
						$datetime = date_format($datetime, 'd-m-Y H:i');
					}else{
						$datetime = '-';
					}
				?>
				<tr {{ ($recipient->status == 'Sent') ? 'class="text-success"' : 'class="text-danger"' }}>
					<td>{{ $recipient->school_id }}</td>
					<td>{{ $recipient->name }}</td>
					<td>{{ $recipient->mobile }}</td>
					<td>{{ ($recipient->status == 'Sent')? '<span class="fa fa-thumbs-up"></span> '.$recipient->status.': '.$recipient->status_message : '<span class="fa fa-thumbs-down"></span> '.$recipient->status.': '.$recipient->status_message }}</td>
					<td>{{ $datetime }}</td>
					<td>{{ $recipient->sms_id }}</td>
				</tr>
			@endforeach
			</table>
		@endif
	</div>
</div>
@stop