	<div class="profile">
		<div class="container">
			<form class="form" role="form" action = "getconnected.php" method = "POST">
				<label for="company">Your company:</label>
		  		<div class="form-group">
		    		<input name = "company" type="company" class="form-control" id="company" placeholder = "Google">
		  		</div>
		  		<div class="form-group">
		  			<label for="company">Your Linkedin url:</label>
		    		<input name = "Linkedin" type="Linkedin" class="form-control" id="company" placeholder = "LinkedinUrl">
		  		</div>
		  		<label for="graduation-year">Graduation Year:</label>
			  	<div class="form-group">
			  		<div class="col-sm-6 month">
				  		<select name="month" id="job-type" class="form-control">
				  			<option value="">---Month---</option>
	                        <option value="january">January</option>
						    <option value="february">February</option>
						    <option value="march">March</option>
						    <option value="april">April</option>
						    <option value="may">May</option>
						    <option value="june">June</option>
						    <option value="july">July</option>
						    <option value="august">August</option>
						    <option value="september">September</option>
						    <option value="october">October</option>
						    <option value="november">November</option>
						    <option value="december">December</option>
	                    </select>
	            	</div>
	            	<div class="col-sm-6 year">
	                    <select name="year" id="job-type" class="form-control">
				  			<option value="">---Year---</option>
	                        <option value="2015">2015</option>
	                        <option value="2016">2016</option>
	                        <option value="2017">2017</option>
	                    </select>
	            	</div>
			  	</div>
			  	<button type="reset" class="btn">Reset</button>
			  	<button type="submit" class="btn">Update</button>
			  	<input type = "hidden" name="type" value="alu">

