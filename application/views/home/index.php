<?php require 'application/views/_templates/header.php'; ?>

<style>
	.form_heading{
		background-color: #41D66D;
		color: white;
		font-size: 18px;
		padding: 5px;
		text-align: center;
	}
</style>

<div class="container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<h1>
				WELCOME TO SOCIAL-MVC
			</h1>
		</div>
	</div>
</div>


<div class="container">
	<div class="row">
		<div class="col-lg-3 col-lg-offset-2">
			<h1 class="form_heading">SIGN UP</h1>
			<form role="form" action="home/signup" method="post">
			   <div class="form-group">
			      <label for="name">Name</label>
			      <input type="text" class="form-control" id="name" 
			         placeholder="Enter Name">
			   </div>
			   <div class="form-group">
			      <label for="email">Email</label>
			      <input type="email" name="email" class="form-control" id="email" 
			         placeholder="Enter Email">
			   </div>
			   <div class="form-group">
			      <label for="password">Password</label>
			      <input type="password" class="form-control" id="password" name="password" 
			         placeholder="Enter Password">
			   </div>
			   <div class="form-group">
			      <label for="country">Country</label>
			      <input type="text" class="form-control" id="country" name="country" 
			         placeholder="Enter Country">
			   </div>
			   <button type="submit" class="btn btn-default">SIGN UP</button>
			</form>	
		
		</div>
		<div class="col-lg-3 col-lg-offset-2">
			<h1 class="form_heading">LOGIN UP</h1>
			<form role="form"  action="user/login" method="post">
			   <div class="form-group">
			      <label for="email">Email</label>
			      <input type="email" name="email" class="form-control" id="email" 
			         placeholder="Enter Email">
			   </div>
			   <div class="form-group">
			      <label for="password">Password</label>
			      <input type="password" class="form-control" id="password" name="password" 
			         placeholder="Enter Password">
			   </div>
			   <button type="submit" class="btn btn-default">LOGIN</button>
			</form>	

		</div>
	</div>
</div>



<?php require 'application/views/_templates/footer.php'; ?>