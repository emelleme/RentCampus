<div class="page-content">
		    
		    <div class="column featured">
		    <% if CurrentMember.CoverPhoto %>
		    	<img src="$CurrentMember.CoverPhoto" />
	    	<% end_if %>
				<div class="header">
				<div>
					<img class="align-left" src="$CurrentMember.Avatar" />
				</div>
					<h2 class="title">Hey $CurrentMember.FirstName!</h2>
					<h3 class="price"><span>$CurrentMember.GroupName</span></h3>
					<hr>
				</div><!-- end .header -->
			</div>
			<section class="extended-pricing-table col5 featured clearfix">
				<h5 class="description">My Progress</h5>
				<div class="column features-list">
				<ul class="features">
					<li data-tooltip="Sign up for an account online.">Step 1 - Register Online</li>
					<li data-tooltip="Complete Rental Application online or in person">Step 2 - Complete Application</li>
					<li data-tooltip="Book an Appointment to View a Place">Step 3 - Book Appointment</li>
					<li data-tooltip="Tooltip - Optional description of the feature can go here!">Step 4</li>
					<li data-tooltip="Tooltip - Optional description of the feature can go here!">Step 5</li>
					<li data-tooltip="Tooltip - Optional description of the feature can go here!">Step 6</li>
					<li data-tooltip="Tooltip - Optional description of the feature can go here!">Step 7</li>
					<li data-tooltip="Tooltip - Optional description of the feature can go here!">Step 8</li>
				</ul><!-- end .features -->
				</div>
				
				<div class="column free">
				<ul class="features clearfix">
					<li data-feature="Users"><span class="check">&check;</span></li>
					<li data-feature="Voters &amp; votes">&mdash;</li>
					<li data-feature="Ideas">&mdash;</li>
					<li data-feature="Comments">&mdash;</li>
					<li data-feature="Moderation tools">&mdash;</li>
					<li data-feature="Sign-in / singup options">&mdash;</li>
					<li data-feature="Widget tracking">&mdash;</li>
					<li data-feature="Admins / moderators">&mdash;</li>
				</ul><!-- end .features -->
				</div>
			</section>
		    </div>
