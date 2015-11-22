	<div class="profile">
		<div class="container">
			<form class="form" role="form" action = "three_circles.php" method = "POST">
				<label for="name">Your Name:</label>
			  	<div class="form-group">
				  	<input type="first_name" class="form-control input-lg" id="first_name" placeholder = "First Name" name="first_name">
			  	</div>	
			  	<div class="form-group">
	            	<input type="middle_name" class="form-control input-lg" id="middle_name" placeholder = "middle Name(optional) " name="middle_name">
	            </div>	
	            <div class="form-group">
	            	<input type="last_name" class="form-control input-lg" id="last_name" placeholder = "Last Name" name="last_name">
			  	</div>	
				<label for="company">Your company:</label>
				<div class="form-group">
					<input name = "company" type="company" class="form-control input-lg" id="company" placeholder = "Google">
				</div>
				<div class="form-group">
					<label for="company">Your Position:</label>
					<input name = "position" type="Linkedin" class="form-control input-lg" id="company" placeholder = "Manager">
				</div>
				<label for="graduation-year">Graduation Year: <br><small>(For current student or alumni)</small></label>
				<div class="form-group">
					<div class="col-sm-6 month">
						<select name="month" id="job-type" class="form-control">
							<option value="">---Month---</option>
							<option value="01">January</option>
							<option value="02">February</option>
							<option value="03">March</option>
							<option value="04">April</option>
							<option value="05">May</option>
							<option value="06">June</option>
							<option value="07">July</option>
							<option value="08">August</option>
							<option value="09">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
					</div>
					<div class="col-sm-6 year">
						<select name="year" id="job-type" class="form-control">
							<option value="">---Year---</option>

							<option value="1993">1993</option>
							<option value="1994">1994</option>
							<option value="1995">1995</option>							
							<option value="1996">1996</option>
							<option value="1997">1997</option>
							<option value="1998">1998</option>
							<option value="1999">1999</option>
							<option value="2000">2000</option>
							<option value="2001">2001</option>
							<option value="2002">2002</option>
							<option value="2003">2003</option>
							<option value="2004">2004</option>
							<option value="2005">2005</option>
							<option value="2006">2006</option>
							<option value="2007">2007</option>
							<option value="2008">2008</option>
							<option value="2009">2009</option>
							<option value="2010">2010</option>
							<option value="2011">2011</option>
							<option value="2012">2012</option>
							<option value="2013">2013</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
						</select>
					</div>
				</div>
				<label for="contact-info">Contact Information</label>
			  	<div class="form-group">
	            	<input type="linkedin" class="form-control input-lg" id="linkedin" placeholder = "LinkedIn" name="linkedin">
			  	</div>
			  	<div class="form-group">
	            	<input type="phone" class="form-control input-lg" id="phone" placeholder = "Phone Number" name="phone">
			  	</div>
			  	<div class="form-group">
	            	<input type="address" class="form-control input-lg" id="address" placeholder = "Address" name="address">
			  	</div>
				<button type="reset" class="btn">Reset</button>
				<button type="submit" class="btn">Update</button>
				<input type = "hidden" name="type" value="emp">

