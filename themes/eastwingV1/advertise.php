<?php
/*
Template Name: Advertise
*/
?>

<?php
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = 'Website Form Email From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>

<?php get_header(); ?>

	<div class="container">
		<div class="row content">
		  <div class="eightcol">
		    <h2>Want to sponsor the show? Sweet!</h2>
		    <p>We're honored that you'd want to sponsor the show! Thanks! We're looking for sponsors whose products or services will really benefit our listeners. For that reason, we really make an effort to hand pick who advertises on our site. We only accept sponsors who's products we use, have used or will use.</p>
		    <h3>Options, Options</h3>
		    <p>You can choose between single episode sponsorship or a month long sponsorship. If there's some another type of arrangement you'd like to make, let us know. We might be able to make it happen!</p>
		    <h3>What Do You Get?</h3>
		    <p>So it's fair to fill you in on what you get when you advertise with us. Here's the list:</p> 
		    <ul class="show-notes">
		      <li>A 100&times;100 image ad in the episode page sidebar with an up to 60 character description</li>
  		    <li>Thank you to your product/company before and after episode</li>
  		    <li>30-60 second commercial break during show</li>
		    </ul>
		    
		    <p>Fill out the form below with your name, email and a brief decription of what you want to advertise and we'll get back to you as soon as possible!</p>
		    
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<div class="entry-content">
						<?php if(isset($emailSent) && $emailSent == true) { ?>
							<div class="eightcol statement">
								<h2>Thanks, your email was sent successfully.</h2>
							</div>
						<?php } else { ?>
							<?php the_content(); ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error">Sorry, an error occured.<p>
							<?php } ?>

						<form action="<?php the_permalink(); ?>" class="contactForm" method="post">
						  
							<fieldset>
								<input type="text" name="contactName" placeholder="Name" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="input required requiredField" />
								<?php if($nameError != '') { ?>
									<span class="error"><?=$nameError;?></span>
								<?php } ?>
								
								<input type="email" name="email" placeholder="Email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="input required requiredField email" />
								<?php if($emailError != '') { ?>
									<span class="error"><?=$emailError;?></span>
								<?php } ?>
							
								<textarea name="comments" maxlength="200" placeholder="Tell us about your product. Remember to give us a link!" class="input message required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								<?php if($commentError != '') { ?>
									<span class="error"><?=$commentError;?></span>
								<?php } ?>
								
								<input class="send button" type="submit" value="Send Email"></input>
								</fieldset>

								
							</li>
						</ul>
						<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>
				<?php } ?>
				</div><!-- .entry-content -->
			</div><!-- .post -->

				<?php endwhile; endif; ?>
			</div><!-- .fivecol -->
			
			<div class="threecol last right">
			 <div class="ad">
			   <img src="http://placehold.it/150x100" width="150" height="100" />
			   <p><span class="adtag"><a href="#">Product Name</a></span>This is where we give you an up to 60 character product or service description.</p>
			 </div><!-- .ad -->
			</div><!-- .threecol -->
			
		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
