<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Just display the form if the request is a GET
    display_form(array());
} else {
    // The request is a POST, so validate the form
    $errors = validate_form();
    if (count($errors)) {
        // If there were errors, redisplay the form with the errors
        display_form($errors);
    } else {
        // The form data was valid, so update database and display success page

$conference_id = 2;
$title = htmlentities($_POST['title']);
$author = htmlentities($_POST['author']);
$bio = htmlentities($_POST['bio']);
$email = htmlentities($_POST['email']);
$track = htmlentities($_POST['track']);
$description = htmlentities($_POST['word_count']);
$outline = htmlentities($_POST['outline']);
$package_list = htmlentities($_POST['package_list']);
$documentation = htmlentities($_POST['documentation']);

include('inc/db_conn.php');

$sql ="INSERT INTO talk_tutorial_submissions ";
$sql .="(conference_id, ";
$sql .="title, ";
$sql .="author, ";
$sql .="bio, ";
$sql .="email, ";
$sql .="track, ";
$sql .="description, ";
$sql .="outline, ";
$sql .="package_list, ";
$sql .="documentation, ";
$sql .="date_submitted) ";
$sql .="VALUES ";
$sql .="(\"$conference_id\", ";
$sql .="\"$title\", ";
$sql .="\"$author\", ";
$sql .="\"$bio\", ";
$sql .="\"$email\", ";
$sql .="\"$track\", ";
$sql .="\"$description\", ";
$sql .="\"$outline\", ";
$sql .="\"$package_list\", ";
$sql .="\"$documentation\", ";
$sql .="NOW())";

$result = @mysql_query($sql, $connection) or die("Error #". mysql_errno() . ": " . mysql_error());

?>

<!DOCTYPE html>
<html>
<?php $thisPage="Speaking"; ?>
<head>
<?php include_once "inc/markdown.php"; ?>
<?php include('inc/header.php') ?>

<link rel="shortcut icon" href="http://conference.scipy.org/scipy2014/favicon.ico" />
</head>

<body>

<div id="container">

<?php include('inc/page_headers.php') ?>

<section id="sidebar">
  <?php include("inc/sponsors.php") ?>
</section>

<section id="main-content">
<h1>Tutorial Submission Form</h1>

<p>Thank you for your submission. The following information has been recorded.</p>

<p><span class="data_field">Title:</span> <?php echo $title ?></p>
<p><span class="data_field">Author:</span> <?php echo $author ?></p>
<p><span class="data_field">Bio:</span> <?php echo Markdown($bio) ?></p>
<p><span class="data_field">email:</span> <?php echo $email ?></p>
<p><span class="data_field">Track:</span> <?php echo $track ?></p>
<p><span class="data_field">Description:</span> <?php echo Markdown($description) ?></p>
<p><span class="data_field">Outline:</span> <?php echo Markdown($outline) ?></p>
<p><span class="data_field">Package List?:</span> <?php echo Markdown($package_list) ?></p>
<p><span class="data_field">Documentation:</span> <?php echo Markdown($documentation) ?></p>

</section>
<div style="clear:both;"></div>
<footer id="page_footer">
<?php include('inc/page_footer.php') ?>
</footer>
</div>
</body>

</html>

<?php
            }
}

function display_form($errors) {

  $defaults['title'] = isset($_POST['title']) ? htmlentities($_POST['title']) : '';
  $defaults['author'] = isset($_POST['author']) ? htmlentities($_POST['author']) : '';
  $defaults['bio'] = isset($_POST['bio']) ? htmlentities($_POST['bio']) : '';
  $defaults['email'] = isset($_POST['email']) ? htmlentities($_POST['email']) : '';
  $defaults['track'] = isset($_POST['track']) ? htmlentities($_POST['track']) : '';
  $defaults['word_count'] = isset($_POST['word_count']) ? htmlentities($_POST['word_count']) : '';
  $defaults['outline'] = isset($_POST['outline']) ? htmlentities($_POST['outline']) : '';
  $defaults['package_list'] = isset($_POST['package_list']) ? htmlentities($_POST['package_list']) : '';
  $defaults['documentation'] = isset($_POST['documentation']) ? htmlentities($_POST['documentation']) : '';

?>

<!DOCTYPE html>
<html>
<?php $thisPage="Talks"; ?>
<head>

<?php
//force redirect to secure page
//if($_SERVER['SERVER_PORT'] != '443') { header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); exit(); }
?>

        <link rel="stylesheet" href="inc/validationEngine.jquery.css" type="text/css"/>
        <!-- <link rel="stylesheet" href="inc/template.css" type="text/css"/> -->
        <script src="inc/jquery-1.6.min.js" type="text/javascript">
        </script>
        <script src="inc/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
        </script>
        <script src="inc/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
        </script>
        <script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();
            });
        </script>


<!--<script type="text/javascript" src="../inc/jquery.js"></script> -->
<script type="text/javascript" src="inc/jquery.wordcount.js"></script>
<script type="text/javascript">
<!--//---------------------------------+
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->
$(document).ready(function()
{
	
	$('#word_count').wordCount();
	//alternatively you can use the below method to display count in element with id word_counter  
	//$('#word_count').wordCount({counterElement:"word_counter"});

	
});
</script>

<?php include('inc/header.php') ?>

<link rel="shortcut icon" href="http://conference.scipy.org/scipy2014/favicon.ico" />

</head>

<body>

<div id="container">

<?php include('inc/page_headers.php') ?>

<section id="sidebar">
  <?php include("inc/sponsors.php") ?>
</section>


<section id="main-content">
<h1>Tutorial Submission Form</h1>

<form method="post" name="PaymentInfo" action="<?php echo $SERVER['SCRIPT_NAME'] ?>">

<div id="instructions">
<p>Tutorial submission template for SciPy 2014: The 12th Python in Science Conference, to be held in Austin, TX, July 6th-12th 2014.</p>

<p>Program chairs: Kristen Thyng &amp; Jake Vanderplas.</p>

<p>For any questions, or to submit a proposal directly contact us at  <a href="mailto: tutorials@scipy.org">tutorials@scipy.org</a></p>
</div>

<div class="row">
  <div class="cell" style="width: 25%;">
    <label for="title">Tutorial Title:<?php print_error('title', $errors) ?></label> 
  </div>
  <div class="cell" style="width: 74%;">
    <input type="text" name="title" id="title" value="<?php echo $defaults['title'] ?>" style="width: 100%;"/>
  </div>
</div>

<div class="row">
  <div class="cell" style="width: 25%;">
    <label for="author">Author(s):<?php print_error('author', $errors) ?></label>
  </div>
  <div class="cell" style="width: 74%;">
    <input type="text" name="author" id="author" placeholder="last name, first name, organization; last name, first name, organization" value="<?php echo $defaults['author'] ?>" style="width: 100%;"/>
  </div>
</div>

<div class="row">

  <div class="cell" style="width: 25%;">
    <span class="form_tips"><label for="description">Bio(s):<?php print_error('bio', $errors) ?></label></span> 
  </div>
  <div class="cell" style="width: 74%;">
    <p class="other_form_tips">A short bio of the presenter or team members, containing a description of past experiences as a trainer/teacher/speaker, and (ideally) links to videos of these experiences if available.</p>
    <textarea id="bio" name="bio" rows="5" placeholder="bio of the presenter or team members"><?php echo $defaults['bio'] ?></textarea>
  </div>
</div>

<div class="row">
  <div class="cell" style="width: 25%;">
    <label for="author">Contact Email(s):<?php print_error('email', $errors) ?></label>
  </div>
  <div class="cell" style="width: 74%;">
    <input type="text" name="email" id="email" value="<?php echo $defaults['email'] ?>" style="width: 100%;"/>
  </div>
</div>

<div class="row" style="margin-bottom: 2em;">
  <div class="cell" style="width: 25%;">
    <p>Which track:<?php print_error('track', $errors) ?></p>
  </div>
  <div class="cell" style="width: 74%;">
    <input class="rb" name="track" type="radio" value="introductory_basics" <?php if ($defaults['track'] == 'introductory_basics') { echo "checked"; } ?> /> Introduction Scientific Python Basics (Numpy and IPython)<br />
    <input class="rb" name="track" type="radio" value="introductory_matplotlib" <?php if ($defaults['track'] == 'introductory_matplotlib') { echo "checked"; } ?> /> Introduction to plotting with Matplotlib<br />
    <input class="rb" name="track" type="radio" value="introductory_scipy" <?php if ($defaults['track'] == 'introductory_scipy') { echo "checked"; } ?> /> Intro: Overview of Scipy<br />
    <input class="rb" name="track" type="radio" value="introductory_sw_carpentry" <?php if ($defaults['track'] == 'introductory_sw_carpentry') { echo "checked"; } ?> /> Intro: Software Carpentry<br />
    <input class="rb" name="track" type="radio" value="intermediate" <?php if ($defaults['track'] == 'intermediate') { echo "checked"; } ?> /> Intermediate<br />
    <input class="rb" name="track" type="radio" value="advanced" <?php if ($defaults['track'] == 'advanced') { echo "checked"; } ?> /> Advanced
  </div>

</div>

<div class="row">
<div class="row">
  <div class="cell" style="width: 25%;">
    <span class="form_tips"><label for="description">Tutorial Description:<?php print_error('word_count', $errors) ?></label></span> 
  </div>
  <div class="cell" style="width: 74%;">
    <p class="other_form_tips">A description of the tutorial, suitable for posting on the SciPy website for attendees to view. It should include the target audience, the expected level of knowledge prior to the class, and the goals of the class.</p>
    <textarea id="word_count" name="word_count" rows="5"><?php echo $defaults['word_count'] ?></textarea>
  </div>
</div>

<div class="row">
  <div class="cell" style="width: 25%;">
    <span class="form_tips"><label for="description">Outline:<?php print_error('outline', $errors) ?></label></span> 
  </div>
  <div class="cell" style="width: 74%;">
    <p class="other_form_tips">A more detailed outline of the tutorial content, including the duration of each part, and exercise sessions. Please include a description of how you plan to make the tutorial hands-on.</p>
    <textarea id="outline" name="outline" rows="5" placeholder="detailed outline of the tutorial content" ><?php echo $defaults['outline'] ?></textarea>
  </div>
</div>

<div class="row">
  <div class="cell" style="width: 25%;">
    <span class="form_tips"><label for="description">Package List:</label></span> 
  </div>
  <div class="cell" style="width: 74%;">
    <p class="other_form_tips">A list of Python packages that attendees will need to have installed prior to the class to follow along. Please mention if any packages are not cross platform. Installation instructions or links to installation documentation should be provided for packages that are not available through easy_install, pip, EPD, Anaconda, etc., or that require third party libraries.</p>
    <textarea id="package_list" name="package_list" rows="5" placeholder="list of Python packages" ><?php echo $defaults['package_list'] ?></textarea>
  </div>
</div>

<div class="row">
  <div class="cell" style="width: 25%;">
    <span class="form_tips"><label for="description">Documentation:</label></span> 
  </div>
  <div class="cell" style="width: 74%;">
    <p class="other_form_tips">If available, URL links to tutorial notes, slides, exercise files, ipython notebooks, that you already have, even if they are preliminary.</p>
    <textarea id="documentation" name="documentation" rows="5" placeholder="tutorial notes, slides, exercise files, ipython notebooks, etc." ><?php echo $defaults['documentation'] ?></textarea>
  </div>
</div>


<div align="center">
<input type="submit" name="SubmitOrder" value="Submit Tutorial">
</div>
</form>
</section>
<div style="clear:both;"></div>
<footer id="page_footer">
<?php include('inc/page_footer.php') ?>
</footer>
</div>
</body>

</html>


<?php }

// A helper function to make generating the HTML for an error message easier
function print_error($key, $errors) {
    if (isset($errors[$key])) {
        print "<br /><span class='error'>{$errors[$key]}</span>";
    }
}

function validate_form() {
    
    // Start out with no errors
    $errors = array();



    // title is required and must be at least 2 characters
    if (! (isset($_POST['title']) && (strlen($_POST['title']) > 1))) {
        $errors['title'] = '<< Enter Title >>';
    }

    // author is required and must be at least 2 characters
    if (! (isset($_POST['author']) && (strlen($_POST['author']) > 1))) {
        $errors['author'] = '<< Enter Name(s) >>';
    }

    // bio is required and must be at least 2 characters
    if (! (isset($_POST['bio']) && (strlen($_POST['bio']) > 1))) {
        $errors['bio'] = '<< Enter Bio(s) >>';
    }

    // description is required and must be at least 2 characters
    if (! (isset($_POST['word_count']) && (strlen($_POST['word_count']) > 1))) {
        $errors['word_count'] = '<< Enter Description >>';
    }

    // outline is required and must be at least 2 characters
    if (! (isset($_POST['outline']) && (strlen($_POST['outline']) > 1))) {
        $errors['outline'] = '<< Enter Outline >>';
    }

    // email is required and must be at least 2 characters
    if (! (isset($_POST['email']) && (strlen($_POST['email']) > 1))) {
        $errors['email'] = '<< Enter email >>';
    }

    // specific_session is required
    if (! (isset($_POST['track']) 
          && ($_POST['track']) == 'introductory_basics' 
          || ($_POST['track']) == 'introductory_matplotlib' 
          || ($_POST['track']) == 'introductory_scipy' 
          || ($_POST['track']) == 'introductory_sw_carpentry' 
          || ($_POST['track']) == 'intermediate' 
          || ($_POST['track']) == 'advanced')) {
        $errors['track'] = '<< Please check one >>';
    }


    return $errors;


}


?>