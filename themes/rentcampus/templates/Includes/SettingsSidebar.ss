<section class="page-content col5 featured clearfix">
	<header class="header">
	<h3>Menu</h3>
	</header>
	<ul class="features">
		<li><a href="">My Account</a></li>
		<li><a href="">My Favorites</a></li>
		<li><a href="">My Postings</a></li>
	</ul><!-- end .features -->
</section>

<section ng-controller="PhoneController" class="page-content col5 featured clearfix">
	<header class="header">
	<h3>Mobile Alerts</h3>
	</header>
	<div id="cellPhone">
	<% if CurrentMember.MobilePhoneNumber %>
	<h6>Your Mobile Number is saved</h6>
	<p id="phoneNotice">Change your Cell Number</p>
		<form ng-submit="savePhone()">
			<input ng-model="cellNumber" type="text" placeholder="(xxx)xxx-xxxx" />
			<input type="submit" value="Update" />
		</form>
	<% else %>
	
		<p id="phoneNotice">Enter your mobile number below to recieve SMS notifications</p>
		<form ng-submit="savePhone()">
			<input ng-model="cellNumber" type="text" placeholder="Cell #" />
			<input type="submit" value="Save" />
		</form>
	
	<% end_if %>
	</div>
</section>
