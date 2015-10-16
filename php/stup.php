	<div class="profile">
		<div class="container">
			<form class="form" role="form" action = "getconnected.php" method = "POST">
				<label for="major">Your major:</label>
		  		<div class="form-group">
		    		<select name="major" id="major" class="form-control">
	                    <option value="">---Please select your major---</option>
	                    <option value="cs">Computer Science</option>
	                    <option value="ece">Electrical and Computer Engineering</option>
	                    <option value="is">Information Science</option>
	                </select> 
		  		</div>
		  		<label for="graduation-year">Graduation Year:</label>
			  	<div class="form-group">
			  		<div class="col-sm-6 month">
				  		<select name="month" id="month" class="form-control">
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
	                    <select name="year" id="year" class="form-control">
				  			<option value="">---Year---</option>
	                        <option value="2015">2015</option>
	                        <option value="2016">2016</option>
	                        <option value="2017">2017</option>
	                    </select>
	            	</div>
			  	</div>
			  	<label for="job-type">Looking for:</label>
			  	<div class="form-group">
			  		<select name="job-type" id="job-type" class="form-control">
			  			<option value="">---Please select one---</option>
	                    <option value="1">Full-time job</option>
	                    <option value="2">Part-time job</option>
	                    <option value="3">Internship</option>
	                </select>
			  	</div>
			  	<button type="reset" class="btn">Reset</button>
			  	<button type="submit" class="btn">Update</button>
			  	<input type = "hidden" name="type" value="stu">


