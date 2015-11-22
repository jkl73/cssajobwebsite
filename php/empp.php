	<div class="profile">
		<div class="container">
			<form class="form" role="form" action = "three_circles.php" onSubmit = "return checkSubmit()" method = "POST">
				<label for="name">Your Name:</label>
			  	<div class="form-group">
				  	<input type="first_name" class="form-control input-lg" id="first_name" placeholder = "First Name" name="first_name"required>
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
			</form>
		</div>
	</div>

	<script language="javascript">
     function checkSubmit() {
       var t = document.getElementById("text-alert");	
       var first_name= document.getElementById("first_name");
       var last_name= document.getElementById("last_name");
       var company= document.getElementById("company");
       var position= document.getElementById("position");

       if(first_name.value == "" || first_name.value == null) 
       {
        t.innerHTML = "Please input first name!";
        return false;
       }
       if(last_name.value == "" || last_name.value == null) 
       {
        t.innerHTML = "Please input last name!";
        return false;
       }
       if(company.value == "" || company.value == null) 
       {
        t.innerHTML = "Please input your company!";
        return false;
       }
       if(position.value == "" || position.value == null) 
       {
        t.innerHTML = "Please input your position!";
        return false;
       }
       return true;
    }
   </script>
