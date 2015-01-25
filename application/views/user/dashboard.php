<?php require 'application/views/_templates/header_controller.php'; ?>

<style>
	.form_heading{
		background-color: #41D66D;
		color: white;
		font-size: 18px;
		padding: 5px;
		text-align: center;
	}
	.heading_middle{
		text-align:center;

	}
	.spliter{
		height: 50px;
		width: 100%;
	}
	.profile_heading{
		color:#5C9DC5;
		font-weight: bold;
		font-size: 18px;
		text-align: center;
	}
	.a_post{
		border: 1px solid #C5C7BC ;
		border-radius: 3px;
		padding: 5px;
		min-height: 150px;
		margin-bottom: 5px;
	}
	.post_image{
		width: 100px;
		height: 100px;
		display: block;
		margin: 0 auto;
	}
	.post_content{
		font-size:12px;
		color: #c3c3c3;
	}
	#new_post_form textarea
	{
		width: 100%;
		height: 100px;
		border-radius: 3px;
	}
	#new_post_form #selectbox{
		float: left;
		
	}
	#new_post_form input{
		background: #5C9DC5;
		border: none;
		border-radius: 3px;
		color:white;
		padding: 5px;
		float: left;
		margin-left: 10px;
	}
</style>

<div class="container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<h1 class="heading_middle">
				Welcome <?=$param['name']?>
			</h1>

			<p>
				<?php if(isset($_COOKIE['notification']) &&  !empty($_COOKIE['notification'])) { echo $_COOKIE['notification']; } ?>
			</p>
		</div>
	</div>
</div>


<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">Wall</a></li>
			  <li role="presentation"><a href="#profile" role="tab" data-toggle="tab">New Post</a></li>
			  <li role="presentation"><a href="#messages" role="tab" data-toggle="tab">People</a></li>
			  <li role="presentation"><a href="#friends" role="tab" data-toggle="tab">Friends</a></li>
			  <li role="presentation"><a href="#settings" role="tab" data-toggle="tab">Settings</a></li>
			</ul>


			<div class="spliter">
			</div>


			<!-- Tab panes -->
			<div class="tab-content">
			  <div role="tabpanel" class="tab-pane active" id="home">
				
				<div class="col-lg-4">
					<img src="../bootstrap/img/default.png">
					<h2 class="profile_heading"><?=$param['name']?></h2>
					<h2 class="profile_heading"><?=$param['email']?></h2>
					<h2 class="profile_heading"><?=$param['country']?></h2>
					<a href="logout">Logout</a>
					
				</div>

				<div class="col-lg-8">
					
					<?php

					foreach($param['posts'] as $posts){

						?>
						<div class="a_post">
							<div class="col-lg-3">
								<img class="post_image" src="../bootstrap/img/default.png">
								<h2 class="profile_heading"><?=$posts['name']?></h2>
						
							</div>
							<div class="col-lg-9">
								<p class="post_content">
								<?php echo stripcslashes($posts['post_content']); ?>
								</p>
								<p>
								<?php echo $posts['date']; ?>
								</p>
							</div>
						</div>


						<?php



					}


					?>
					
					
				</div>
				


			  </div>
			  <div role="tabpanel" class="tab-pane" id="profile">

				<div class="col-lg-4">
					<img src="../bootstrap/img/default.png">
					<h2 class="profile_heading"><?=$param['name']?></h2>
					<h2 class="profile_heading"><?=$param['email']?></h2>
					<h2 class="profile_heading"><?=$param['country']?></h2>
					
				</div>

				<div class="col-lg-8">
					
					<div class="a_post">
						<form id="new_post_form" action="../post/new_post" method="post">
							<textarea name="post" id="" cols="50" rows="10" placeholder="Please type post here.."></textarea>
							<select name="privacy" id="selectbox" >
								<option value="0">Public
								</option>
								<option value="1">Friends Only</option>
							</select>
							<input name="submit" type="submit" value="Submit">
						</form>

					</div>

				</div>

			  </div>
			  <div role="tabpanel" class="tab-pane" id="messages">
			  	
				<div class="col-lg-4">
					<img src="../bootstrap/img/default.png">
					<h2 class="profile_heading"><?=$param['name']?></h2>
					<h2 class="profile_heading"><?=$param['email']?></h2>
					<h2 class="profile_heading"><?=$param['country']?></h2>
					
				</div>

				<div class="col-lg-8">
					
						<?php
						foreach($param['users'] as $user){

							?>
							<div class="a_post">
					
				
								<div class="col-lg-3">
									<img class="post_image" src="../bootstrap/img/default.png">
									
							
								</div>
								<div class="col-lg-9">
									<h2 class="heading"><?=$user['name']?></h2>
									<a href="../friends/registerObserver/<?php echo $user['id']; ?>" class="btn btn-primary">Follow</a>
									</p>
								</div>
							</div>

							<?php

						}


						?>

						
					

				</div>

			  </div>
			  <div role="tabpanel" class="tab-pane" id="friends">
			  	<div class="col-lg-4">
					<img src="../bootstrap/img/default.png">
					<h2 class="profile_heading"><?=$param['name']?></h2>
					<h2 class="profile_heading"><?=$param['email']?></h2>
					<h2 class="profile_heading"><?=$param['country']?></h2>
					
				</div>

				<div class="col-lg-8">
				
						<?php
						foreach($param['friends'] as $user){

							?>
							<div class="a_post">
					
				
								<div class="col-lg-3">
									<img class="post_image" src="../bootstrap/img/default.png">
									
							
								</div>
								<div class="col-lg-9">
									<h2 class="heading"><?=$user['name']?></h2>
									<a href="../friends/removeObserver/<?php echo $user['id']; ?>" class="btn btn-primary">Unfollow</a>
									</p>
								</div>
							</div>

							<?php

						}


						?>

					</div>
			  </div>
			  <div role="tabpanel" class="tab-pane" id="settings">
			  	<div class="col-lg-3 col-lg-offset-2">
				<h1 class="form_heading">Update Password</h1>
				<form role="form"  action="../user/update" method="post">
			   	<div class="form-group">
			      <label for="email">Old Password</label>
			      <input type="password" name="oldpass" class="form-control" id="email" 
			       placeholder="Enter Old Password">
			   	</div>
			   <div class="form-group">
			      <label for="password">New Password</label>
			      <input type="password" class="form-control" id="password" name="newpass" 
			         placeholder="Enter New Password">
			   </div>
			   <button type="submit" class="btn btn-default">Update</button>
			</form>	
			
			</div>
			</div>
			  </div>
			</div>
		
		</div>
		
	</div>
</div>



<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/js/checkbox.js"></script>
	<script src="../bootstrap/js/radio.js"></script>
	<script src="../bootstrap/js/bootstrap-switch.js"></script>
	<script src="../bootstrap/js/toolbar.js"></script>
	<script src="../bootstrap/js/application.js"></script>
	
	
<script>
  $('.nav-tabs a').click(function (e) {
  		e.preventDefault()
  		$(this).tab('show')
	});
</script>

<?php require 'application/views/_templates/footer_controller.php'; ?>