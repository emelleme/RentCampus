<!DOCTYPE html>

<!--[if IE 8]> <html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9]> <html class="ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<% base_tag %>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Rent Campus Online</title>
	<% require themedCSS(stylenew) %>
	<% require themedCSS(style) %>
	<% require themedCSS(typography) %>
	<% require themedCSS(jquery.idealforms) %>
	
	
	<!--[if lt IE 9]>
	<script src="mysite/dist/html5shiv.js"></script>
	<![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.22/jquery-ui.min.js"></script>
    <script src="mysite/javascript/idealforms/jquery.idealforms.min.js"></script>
	<script src="mysite/javascript/application.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Fontdiner+Swanky|Black+Ops+One|Slackey' rel='stylesheet' type='text/css' />
    <!--Start of Zopim Live Chat Script-->
<!--End of Zopim Live Chat Script-->
</head>
<body class="home blog">
<div id="cork">

<div id="wrapper">

	<div id="container">
	
	<nav id="main-nav">
		
		<ul>
			<% include Navigation %>
		</ul>

	</nav><!-- end #main-nav -->
	<div id="logo">	
	<a href="home"><img src="themes/rentcampus/images/rent-campus-logo.png" alt="Rent Campus Online" ></a>
	</div>
	<div class="clear"></div>
	<div id="main" style="background-color:#fff">
		<h2 class="align-center">Rental Application</h2>
         <% if CurrentMember %>
         <h4>Hello $CurrentMember.FirstName!</h4>
         <p class="notice">Rental Application Status: <strong style="color:darkgreen">$CurrentMember.Application.Status</strong></p>
         <% control CurrentMember %>
         <% control Application %>
         <% if Status = sent %>
         <p>Your application has been sent to the email address below. We will notify you once your application is approved.</p>
         <!--<p><a href="/rental-application/resend">Re-Send</a></p> -->
         <% else %>
         <p>Please fill out the form below and click submit to begin the Application Process.</p>
         <% end_if %>
         <% end_control %>
         <% end_control %>
         <% else %><h4>Hello!</h4>
         <p>Please fill out the form below to begin the Application Process.</p>
         <% end_if %>

        
        <form id="my-form" action="$URLSegment/submit">
        <section name="Property Applying for" class="page-content">
        <div>
        <p>Please enter the Property Address you are interested in. Visit our Listings Page to view all of our available listings.</p>
        <div><label>Property Address</label><input id="property" name="property" type="text" data-ideal="required property" value="$CurrentMember.Application.PropertyName"/>
        </div>
        <div><label>Unit Number</label><input id="unit" name="unit" type="text" value="$CurrentMember.Application.PropertyUnit"/></div>
        
        </div>
        
        </section>
        <section name="Contact Information" class="page-content">
        <div class="field text">
        <h4>Fill in the fields below and click submit. You will recieve an email with further instructions on completeting the application.</h4>
        
        </div>
        <div><label>First Name</label><input id="firstName" name="firstName" type="text" value="$CurrentMember.FirstName" data-ideal="required fullName"/></div>

        <div><label>Last Name</label><input id="surname" name="surname" type="text" value="$CurrentMember.Surname" data-ideal="required fullName"/></div>
        
        <div><label>Phone Number</label><input id="phoneNum" name="phoneNum" type="text" value="$CurrentMember.HomePhoneNumber" data-ideal="required phone"/></div>
		<div><input type="hidden" name="pid" value="$PropertyId" /></div>
		<div><label>Email Address</label><input id="appEmail" name="appEmail" type="email" value="$CurrentMember.Email" data-ideal="required appEmail"/></div>
		 <div><label>Choose from below:</label>
         <% control CurrentMember %>
            <label><input type="radio" name="cosigner" value="part" <% if Cosigner = part %> checked="true"<% end_if %>/>My Co-signer will be paying part of the rent</label>
            <label><input type="radio" name="cosigner" value="all" <% if Cosigner = all %> checked="true"<% end_if %>/>My Co-signer will be paying the full ammount of the rent</label>
            <label><input type="radio" name="cosigner" value="none" <% if Cosigner = none %> checked="true"<% end_if %>/>I will be the sole  individual paying rent on this property</label>
          <% end_control %>
          </div>
		
		<div class="ideal-full-width">
           
           <p>After clicking submit, the Rental Application and Instructions will be sent to the Email Address above for you to fill out and sign.</p> 
        <div>
            
            </div>
        </div>


        </section>
        
        <section name="Roommates" class="page-content">
        <div class="field text">
        <h5>Roommates</h5>
        <p>Once your application is approved, You can invite your friends to complete the application.</p></div><br>
        <div><label>Roommate Email Address</label><input disabled id="roommate" name="roommate[]" type="text" value="" data-ideal=""/></div>
        <div><label>Roommate Email Address</label><input disabled id="roommate" name="roommate[]" type="text" value="" data-ideal=""/></div>
        <div><label>Roommate Email Address</label><input disabled id="roommate" name="roommate[]" type="text" value="" data-ideal=""/></div>
        <div><label>Roommate Email Address</label><input disabled id="roommate" name="roommate[]" type="text" value="" data-ideal=""/></div>
        

        </section>
        
        <section name="Deposit" class="page-content">
        <div class="field text">
        <h4>We will review your application once submitted and provide details on how you can make a deposit.</h4>
        
        </div>

        </section>
        
        <section name="Finalize Leasing and Move-In" class="page-content">
        <div class="field text">
        <h4>We will review your application once submitted and provide details on finalizing moving arrangements.</h4>
        <p>Move In Resources</p>
        </div>
        </section>
		
        
      <div></div>
      
      <div class="ideal-buttons">
      <div>
        <p>$Content</p>
        </div>	
        <button type="submit">Submit</button>
        <!--<button id="reset" type="button">Reset</button>-->
      </div>
    </form>
	</div>
	<div class="clear"></div>
	</div>
</div>
</div>
</body>
</html>
	
	
