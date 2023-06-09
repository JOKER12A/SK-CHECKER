<?php 


?>


<!DOCTYPE html>
<html lang="en-gb" dir="ltr">

<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checker</title>
  <link rel="shortcut icon" type="image/png" href="../../16x16-1">
  <link href="../../css-1?family=Muli:300,400,500,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/hyper.css?v=6.2">
  <link rel="stylesheet" href="../../ajax/libs/animate.css/4.1.1/animate.min.css">
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
			  				<li><a href="dashboard.php">Dashboard</a></li>

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
                            <!-- <p class="uk-text-lead uk-text-muted">Warning: don't use generated ccs don't be noob!</p> -->
              <div class="uk-form-stacked uk-margin-medium-top">

                <div class="uk-margin-bottom">
                  <!-- <span id="totalCount">430</span> -->
                  <label class="uk-form-label" for="message"><span>Drop Ccs
                      <span class="tag_required" id="lista_leb">Required</span></span>
                    <span class="tag_total">Total <span id="totalCount">0</span></span>

                    <span class="tag_info">Checked <span id="totalChecked">0</span></span>
                  </label>
                  <div class="uk-form-controls" id="lista_con">
                    <textarea id="message" class="hyper_ccs uk-textarea uk-border-rounded" placeholder="XXXXXXXXXXXXX|XX|XXXX|XXX" name="lista" rows="5" minlength="10" required=""></textarea>
                  </div>
                </div>


                <div class="uk-margin-bottom" id="amount_container2">
                  <label class="uk-form-label" for="name">SK KEY<span class="tag_required">Required</span></label>
                  <div class="uk-form-controls hyper_login">
                    <input id="skkey" class="hyper_input uk-input uk-border-rounded" name="name" type="text" placeholder="Enter Sk Live" required="">
                  </div>
                </div>

                <div class="row-col">
                <div class="uk-margin-bottom" id="amount_container">
                  <label class="uk-form-label" for="name">Telegram ID <span class="tag_optional">optional</span></label>
                  <div class="uk-form-controls hyper_login">
              <?php
                  echo '<input id="tg_id" class="hyper_input uk-input uk-border-rounded" name="name" type="text" value="'.$_SESSION["access"].'" required>';
                  ?>
                  </div>
                </div>

                <div class="uk-margin-bottom" id="amount_container">
                  <label class="uk-form-label" for="name">Amount <span class="tag_optional">optional</span></label>
                  <div class="uk-form-controls hyper_login">
                    <input id="amount" class="hyper_input uk-input uk-border-rounded" name="number" type="text" placeholder="Enter Amount" required="">
                  </div>
                </div>
            </div>

                <div class="row-col">
                <div class="uk-margin-bottom" id="amount_container">
                  <label class="uk-form-label" for="name">Forwarder<span class="tag_required">Types</span></label>
                  <div class="uk-form-controls hyper_login">
                    <select name="fwtype" id="fwtype">
                      <option value="hit">Hits</option>
                      <option value="cvv">Hits + CVV</option>
                      <option value="live">Hits + CVV + CCN</option>
                    </select>
                  </div>
                </div>

                <div class="uk-margin-bottom" id="amount_container">
                  <label class="uk-form-label" for="name">Currency<span class="tag_required">Choose</span></label>
                  <div class="uk-form-controls hyper_login">
                    <select name="curr" id="curr">
                      <option value="usd">USD</option>
                      <option value="gbp">GBP</option>
                      <option value="inr">INR</option>
                      <option value="cad">CAD</option>
                      <option value="eur">EUR</option>
                    </select>
                  </div>
                </div>
                </div>

                

                <!-- <div class="uk-margin-bottom">
                <label class="uk-form-label" for="_subject">SK KEY</label>
                <div class="uk-form-controls hyper_login">
                  <input id="_subject" class="hyper_input uk-input uk-border-rounded" placeholder="sk_live_xxxxxxxx" name="_subject" type="text">
                </div>
              </div> -->

                <div class="uk-text-center">
                  <button class="uk-button uk-button-primary uk-border-rounded" id="startbtn" type="submit">start check</button>
                  <button class="uk-button uk-button-primary uk-border-rounded" id="stopbtn" type="submit"> Reload It</button>

                </div>
              </div>




              <div class="uk-card card_cvv uk-card-category hyper_mt3 uk-card-default uk-card-hover uk-card-body uk-inline uk-border-rounded uk-width-1-1">
                <!-- <a class="uk-position-cover" href="article.html"></a> -->
                <h3 class="uk-card-title uk-margin-remove uk-text-primary green_title">CVV - <span id="cvvCount">0</span>

                  <span id="showCvv">Show</span>
                  <span id="saveCvv">Save</span>
                </h3>
                <span id="cvvList">
                  <!-- <p class="uk-margin-small-top">4562463863427327|12|22|223 - Insufficient Funds</p>
                <p class="uk-margin-small-top">5362463863427326|12|27|674 - Insufficient Funds</p> -->
                </span>

              </div>

              <!-- ccn  -->
              <div class="uk-card ccn_card uk-card-category hyper_mt3 uk-card-default uk-card-hover uk-card-body uk-inline uk-border-rounded uk-width-1-1">

                <h3 class="uk-card-title uk-margin-remove uk-text-primary warn_title">CCN - <span id="ccnCount">0</span>
                  <span id="showCcn">Show</span>
                  <span id="saveCcn">Save</span>
                </h3>
                <span id="ccnList">
                  <!-- <p class="uk-margin-small-top">4562463863427327|12|22|223</p> -->
                </span>


              </div>

              <!-- dead  -->
              <div class="uk-card dead_card uk-card-category hyper_mt3 uk-card-default uk-card-hover uk-card-body uk-inline uk-border-rounded uk-width-1-1">

                <h3 class="uk-card-title uk-margin-remove uk-text-primary dead_title">Ded - <span id="deadCount">0</span>
                  <span id="showDead">Show</span>
                </h3>
                <div id="deadList">
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
  <script src="../js/jquery.js"></script>
  <script src="../js/hyper.js?v=1.2"></script>
  <script src="../js/hyper.notify.js?v=1.2"></script>
  <script src="../js/hyper.skbased.js?v=6.9"></script>
  <!-- <script src="js/session.js"></script> -->



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