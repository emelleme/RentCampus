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
			<section class=" col5 featured clearfix">
				<h5 class="description">My Postings</h5>
				<p>Coming Soon!</p>
			</section>
		    </div>