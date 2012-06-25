<div class="page-content">
<h3>Welcome $CurrentMember.FirstName!</h3>
<p>Please select from the choices below to continue</p>
<hr>
<form action="$URLSegment/save/group">
	<input type="radio" name="userType" value="current" />Current Resident<br />
	<input type="radio" name="userType" value="potential" />Potential Resident<br />
	<input type="radio" name="userType" value="landlord" />LandLord<br />
	<input type="radio" name="userType" value="community" />Community Member (Posting Board Access Only)<br />
	<input type="submit" value="Save" />
</form>
	
</div>
