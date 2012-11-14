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
			<section class="extended-pricing-table col4 featured clearfix">
				<h5 class="description">My Progress</h5>
				<div class="column features-list">
				<ul class="features">
					<li data-tooltip="Sign up for an account online.">Step 1 - Connect with Facebook</li>
					<li data-tooltip="Search our Listings">Step 2 - Search for an Apartment</li>
					<li data-tooltip="Choose your favorite listings">Step 3 - Choose your favorites</li>
					<li data-tooltip="Book an appointment to view your favorite listings">Step 4 - Call for an appointment</li>
				</ul><!-- end .features -->
				</div>
				
				<div class="column free">
				<ul class="features clearfix">
					<li data-feature="Users"><span class="check">&check;</span></li>
					<li data-feature="Voters &amp; votes">&mdash;</li>
					<li data-feature="Ideas">&mdash;</li>
					<li data-feature="Comments">&mdash;</li>
				</ul><!-- end .features -->
				</div>
			</section>
		    </div>
