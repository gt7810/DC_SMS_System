@extends('template/layout')

@section('content')
<a href="{{url()}}/messages" class="back-link"><span class="fa fa-arrow-left"></span> Back</a>
<h1>Send Message to:
@if($yeargroup)
	{{ $yeargroup }}
	</h3>
@else
	{{ $group_name }}
@endif

</h1>
<div class="row">
	<div class="col-sm-12">
		<ul class="default-messages">
			<li><button class="btn btn-sm btn-primary red-rain-btn">Red Rain</button></li>
			<li><button class="btn btn-sm btn-primary black-rain-btn">Black Rain</button></li>
			<li><button class="btn btn-sm btn-primary typhoon-btn">Typhoon</button></li>
		</ul>

		<form id="send-group-form" class="form-send" role="form" method="POST">		
	        <label for="inputMessage" class="sr-only">Message</label>
	        <textarea class="form-control" name="message" placeholder="Text message" rows="3" maxlength="160" id="message-input"></textarea>
	        <p class="message-error text-danger" style="display: none;"></p>
	        <p><span id="character-count" class="badge">160</span> characters left</p>
	        <button class="btn btn-lg btn-success btn-block" type="submit" onClick="return confirm('Are you sure you want to send the message?')">Send Message</button>
	    </form>
	    <br />
	    <? if($group){ ?>
			<h3>Total Number: {{ count($group) }} - Estimated Cost: &euro;{{ count($group)*0.035 }}</h3>
			<table class='table table-striped table-bordered' id="results-table">
			<?
				foreach($group as $person) {
					echo '<tr><td>'.$person->id.'</td><td>'.$person->name.'</td><td>'.$person->mobile.'</td></tr>';	
				}
			?>
			</table>
		<? }else{ ?>
			<p>No numbers were found.</p>
		<? } ?>
	</div>
</div>
@stop