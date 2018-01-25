@extends('template/layout')

@section('content')
<h1>Messages</h1>
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
@stop