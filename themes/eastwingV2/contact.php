<?php
/*
Template Name: Contact
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
		  
		  <div class="twelvecol thetitle">
        <h2>Get In Touch</h2>
      </div><!-- .twelvecol -->
		  
		  <div class="eightcol contact">
		    <p>Thanks for wanting to get in touch! We'd love to hear from you! Use the form below or by email at <a href="mailto:hello@theeastwing.net">hello@theeastwing.net</a>. If you're interested in sponsoring the show, please consult the <a href="/sponsorship">Sponsorship</a> page.</p>
		    
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
							
								<textarea name="comments" placeholder="Question? Comment? Rant? Drop us a line." class="input message required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
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
		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
