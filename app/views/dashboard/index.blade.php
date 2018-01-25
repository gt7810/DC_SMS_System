@extends('template/layout')

@section('content')
<h1>Welcome, {{ $user->firstname }}</h1>
<div class="row">
	<div class="col-sm-6">
		<div class="module">
			<h2>Send to Group</h2>
			<ul class="group-select">
				<li><a href="messages/group/staff" class="btn btn-lg btn-block btn-primary">All Staff</a></li>
				<li><a href="messages/group/all-parents" class="btn btn-lg btn-block btn-primary">All Parents</a></li>
				<li><a href="messages/group/primary" class="btn btn-lg btn-block btn-primary">Primary Parents</a></li>
				<li><a href="messages/group/secondary" class="btn btn-lg btn-block btn-primary">Secondary Parents</a></li>
				<li><a href="#" class="dropdown-toggle btn btn-lg btn-block btn-primary">Select Year Group <span class="fa fa-caret-down pull-right"></span></a>
					<ul class="sub-menu">
						<li>
							<label>
								<input type="checkbox" name="year" value="Y01" />
								Year 1
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y02" />
								Year 2
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y03" />
								Year 3
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y04" />
								Year 4
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y05" />
								Year 5
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y06" />
								Year 6
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y07" />
								Year 7
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y08" />
								Year 8
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y09" />
								Year 9
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y10" />
								Year 10
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y11" />
								Year 11
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y12" />
								Year 12
							</label>
						</li>
						<li>
							<label>
								<input type="checkbox" name="year" value="Y13" />
								Year 13
							</label>
						</li>
						<li>
							<a href="messages/group/year-group?year=" class="send-year-btn btn btn-md btn-primary btn-block">Send to selected year group</a>
						</li>
					</ul>
				</li>
				<li><a href="messages/group/test" class="btn btn-lg btn-block btn-primary">Test Group</a></li>
			</ul>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="module send-test">
			<h2>Send Test Message</h2>
			<p>Use this form to confirm the gateway is working correctly.<br />Make sure you include the country code.</p>
			<form id="send-test-form" class="send-test-form" role="form" method="POST" action="{{url()}}/messages/send-test">
		        <label for="inputPhone" class="sr-only">Mobile Phone</label>
		        <input type="text" class="form-control" placeholder="Mobile phone number" required name="mobile" id="mobileInput">
		        <label for="inputMessage" class="sr-only">Message</label>
		        <textarea class="form-control" name="message" placeholder="Text message" maxlength="160" id="messageInput"></textarea>
		        <button class="btn btn-lg btn-success btn-block" type="submit">Send Test Message</button>
		    </form>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="module">
			<h2>Latest Message</h2>
			@if(!count($message))
				<p>You haven't sent any messages yet.</p>
			@else
			<div class="row">
				<div class="col-sm-6">
					<div class="panel panel-info">
					  <div class="panel-heading">
					    <h3 class="panel-title">Sent to Group: <span class="badge">{{ $message->group_name }}</span> {{ $message->created_at->diffForHumans() }}</h3>
					  </div>
					  <div class="panel-body">
					    <h3>"{{ $message->text }}"</h3>
					  </div>
					</div>
					<p>Sent by <strong>{{ $message->sent_by }}</strong></p>
					<p>Message sent to <strong>{{ $sentCount}} recipients</strong><br />
					There were <strong>{{ $errorCount}} recipients</strong> that did not recieve the message due to errors.</p>
					<a href='{{url("/messages/sent")}}/{{$message->id}}'>View Complete Results</a> 
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
			@endif
		</div>
	</div>
</div>
@stop