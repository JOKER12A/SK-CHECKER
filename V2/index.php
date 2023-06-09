<?php 


?>


<!DOCTYPE html>
<html lang="en-gb" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="../../16x16-1">
    <link href="../../css-1?family=Muli:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/hyper.css?v=5.2">
    <script src="../js/uikit-1.js"></script>
    </head>

<body>

    
<header class="uk-background-primary uk-background-norepeat uk-background-cover uk-background-center-center uk-light " style="display:none;">
	<nav class="uk-navbar-container">
	  <div class="uk-container">
	    <div data-uk-navbar="">
	      <div class="uk-navbar-left">
	        <a class="uk-navbar-item uk-logo uk-visible@m" href="#"><span class="dr_logo"></span>
        </a>
	        <a class="uk-navbar-toggle uk-hidden@m" href="#offcanvas-docs" data-uk-toggle=""><span data-uk-navbar-toggle-icon=""></span>
               <!-- <span class="uk-margin-small-left">Articles</span> -->
            </a>
	      </div>
	      <div class="uk-navbar-center uk-hidden@m">
	        <a class="uk-navbar-item uk-logo" href="#"><span class="dr_logo"></span></a>
	      </div>
	      <div class="uk-navbar-right">
	        <ul class="uk-navbar-nav uk-visible@m">
	          <li><a href="#">Home</a></li>
			  				<li><a href="index.php">Dashboard</a></li>

					          <li><a href="Usage">Usage</a></li>
	       
	          <li>
	            <div class="uk-navbar-item">
                	              <a class="uk-button uk-button-small uk-button-primary-outline logoutbtn" href="../logout.php">Logout</a>
	                            </div>
	          </li>
	        </ul>
	        <a class="uk-navbar-toggle uk-hidden@m" href="#offcanvas" data-uk-toggle=""><span data-uk-navbar-toggle-icon=""></span> <span class="uk-margin-small-left">Menu</span></a>
	      </div>
	    </div>
	  </div>
	</nav>
	
	
</header>
<div id="hyper_progress"></div>
    <div class="uk-section uk-section-muted">
        <div class="uk-container">
            <div class="uk-background-default uk-border-rounded uk-box-shadow-small">
                <div class="uk-container uk-container-xsmall uk-padding-large">
                    <article class="uk-article">
                        <center>
                            <div class="hyper_logo"></div>
                        </center>
                        <div class="uk-article-content">
                            <h3 class="mtitle">🎉 WELCOME BY <span class="tag_success">BADBOY</span></h3>



<!-- card one  -->
<div class="uk-card uk-card-category hyper_mt uk-card-default uk-card-hover uk-card-body uk-inline uk-border-rounded uk-width-1-1">
  <a class="uk-position-cover" href="skchecker.php"></a>

  <div class="uk-article-meta uk-flex uk-flex-middle">

    <div class="uk-border-circle uk-avatar-small s_logo"></div>
    <div>
      <h3><a href="">Sk Based</a></h3>
      <span class="tag_active">active</span>

    </div>
  </div>
</div>
<!-- card two  -->
<div class="uk-card uk-card-category hyper_mt uk-card-default uk-card-hover uk-card-body uk-inline uk-border-rounded uk-width-1-1">
<?php
if ($_SESSION['status'] == "paid") {
echo "<a class='uk-position-cover' href='checker.php'></a>";
}
else {
echo "<a class='uk-position-cover' href='checker.php'></a>";
}
?>

  <div class="uk-article-meta uk-flex uk-flex-middle">
    <div class="uk-border-circle uk-avatar-small s_logo"></div>
    <div>
          <h3><a href="">Sk Base 2 </a></h3>
<?php
if ($_SESSION['status'] == "paid") {
echo "<span class='tag_danger'>active</span>";
}
else {
echo "<span class='tag_required'>inactive</span>";
}
?>
    </div>
  </div>
</div>
<div class="uk-card uk-card-category hyper_mt uk-card-default uk-card-hover uk-card-body uk-inline uk-border-rounded uk-width-1-1">
  <a class="uk-position-cover" href="#"></a>

  <div class="uk-article-meta uk-flex uk-flex-middle">
    <div class="uk-border-circle uk-avatar-small s_logo"></div>
    <div>
      <h3><a href="">Key Checker</a></h3>
      <span class="tag_required">inactive</span>

    </div>
  </div>
</div>

                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>


  <?php include './include/footer.php'; ?>
    <script src="../js/awesomplete-1.js"></script>
    <script src="../js/custom.js"></script>


</body>

</html>

<script>

function check_session_id()
{
    var session_id = "<?php echo $_SESSION['user_session_id']; ?>";

    fetch('check_login.php').then(function(response){

        return response.json();

    }).then(function(responseData){

        if(responseData.output == 'logout')
        {
            window.location.href = '../logout.php';
        }

    });
}

setInterval(function(){

    check_session_id();
    
}, 10000);

</script>