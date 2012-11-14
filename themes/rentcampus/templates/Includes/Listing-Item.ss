<% control ChildrenOf(listings) %>
				<div class="column">

					<div class="header">
					<div class="one-third">
					<!--<img src="$CroppedImage(270,100).Url"/>-->
					<img src="$ListingImages.First.Url" height="180" width="180" />
					</div>
						<h2 class="title"> <a href="$Link">$Title</a> </h2>
						<h3 class="price"><span> $725 </span> <br />
						<small>1 bedroom / 1 bathroom</small>
						 </h3>
						<h5 class="description"> $Content.LimitCharacters(200) </h5>
					</div><!-- end .header -->

					

					<div class="footer">
						<a class="button" href="$Link"> More Info </a>
						<a class="button" href="#"> RENT NOW </a>
					</div><!-- end .footer -->
				
				</div><!-- end .column -->
				<% end_control %>
