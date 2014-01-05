@extends('layouts.master')

@section('main_content')
<div class="row">
	<div class="col-md-8">
		<h1>FootyTracker</h1>
		<p class="lead">
			Helping with the management of a casual football meetup.
		</p>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Store details on meetup participants</h2>
			</div>
			<div class="panel-body">
				Footytracker stores a central list of names, e-mail addresses and phone numbers for all that participate in your football meetup. 
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Track match results</h2>
			</div>
			<div class="panel-body">
				Store team details and scorelines for each meetup. Who played for which team? What was the score?
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Coming next time?</h2>
			</div>
			<div class="panel-body">
				Players can notify the group whether or not they're planning on coming to the next meetup.
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Track attendance with overpayments/underpayments</h2>
			</div>
			<div class="panel-body">
				With each meetup, store whether players attended, and if they overpaid or underpaid their fees. With each new meetup you will be reminded of any balance discrepancies.
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Generate reports on attendance/payments</h2>
			</div>
			<div class="panel-body">
				Find answers to questions like "who's the most dependable participant", "who owes us money", "who underpays the most frequently".
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Notify participants of cancellations/other group news</h2>
			</div>
			<div class="panel-body">
				Using an SMS service integration, FootyTracker can automatically push text messages out to your players informing them of cancellations or other news about your meetup.
			</div>
		</div>	
	</div>
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h2 class="panel-title">Sounds good! When/how can I sign up?</h2>
			</div>
			<div class="panel-body">
				<p>
					I'm still ironing out features, and deciding how I'd like FootyTracker to work.
				</p>
				<p>
					Once I've got a stable set of features and a decent, working, reliable product, I'll release this for public use.
				</p>
				<p>
					If you're interested in helping me test and develop features in this software, please contact me via twitter - <a href="http://twitter.com/yegnold">@yegnold</a>
				</p>
			</div>
		</div>	
	</div>
</div>
@stop