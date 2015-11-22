	<div class="profile">
		<div class="container">
			<form class="form" role="form" action = "three_circles.php" onSubmit = "return checkSubmit()" method = "POST">
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
			  	<input type = "hidden" name="type" value="stu">
			</form>
		</div>
	</div>

	<script language="javascript">
     function checkSubmit() {
       var t = document.getElementById("text-alert");
       var first_name= document.getElementById("first_name");
       var last_name= document.getElementById("last_name");
       var major= document.getElementById("major");
       var month= document.getElementById("month");
       var year= document.getElementById("year");


       if(first_name.value == "" || first_name.value == null) 
       {
        t.innerHTML = "Please input first name!";
        alert('dfsf');
        return false;
       }
       if(last_name.value == "" || last_name.value == null) 
       {
        t.innerHTML = "Please input last name!";
        return false;
       }
       if(major.value == "" || major.value == null) 
       {
        t.innerHTML = "Please input your major!";
        return false;
       }
       if(year.value == "" || year.value == null) 
       {
        t.innerHTML = "Please input your graduation year!";
        return false;
       }
       if(month.value == "" || month.value == null) 
       {
        t.innerHTML = "Please input your graduation month!";
        return false;
       }
       return true;
    }
   </script>
