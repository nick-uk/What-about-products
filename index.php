<?
	session_start();
	$thisfile=file_get_contents($_SERVER["SCRIPT_FILENAME"]);
	$hash=hash("sha256",$thisfile);

	if (isset($_POST['logout'])) {
  		unset($_SESSION['clientid']);
  		header("Refresh: 0; url=/");
	}
    include "settings.php";
    /*
        Within this flat file you will find things like $("table#activeroutes").load("loader.php?selectactive=1"); (Wow not even Rest..)
        where the backend magic happens.
    */
?>

<html>
<head>
<title>SWITCH</title>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
<style type="text/css">
	@import "css/demo_table_jui.css";
	@import "css/jquery-ui-1.7.2.custom.css";

	@font-face {
  		font-family: 'Ruslan Display';
  		font-style: normal;
  		font-weight: 400;
  		src: local('Ruslan Display'), local('RuslanDisplay'), url(css/header.ttf) format('truetype');
	}
	@font-face {
  		font-family: 'Droid Sans';
  		font-style: normal;
  		font-weight: 400;
  		src: local('Droid Sans'), local('DroidSans'), url(css/body.ttf) format('truetype');
	}

	@font-face {
  		font-family: 'Monoton';
  		font-style: normal;
  		font-weight: 400;
  		src: local('Monoton'), local('Monoton-Regular'), url(css/header2.woff) format('woff');
	}

	body {
		background: url("img/back.jpg") no-repeat #D3D3D3;
		color: #020046;
		margin: 0;
		font-family: 'Droid Sans', sans-serif;
	}

        div.admin {
                margin:100px auto;
                width: 900px;
        }

        select {
                background: #FFFFDF;
                border: 1px solid #ffab73;
        }
        select.dst option {
                padding: 5px;
                border-bottom: 1px solid #ffab73;
        }
        select option#selectdst {
        }

	input {
		background: #FFFFDF;
                border: 1px solid #ffab73;
		outline: 0;
	}

	input:hover {
		background: #fffddd;
	}

	div#lastupdate {
	}

	input#popup_ok {
		background: #914e00;
		color: #fff;
	}

	input#button {
		border-radius: 10px 10px 10px 10px;
                -moz-border-radius: 10px 10px 10px 10px;
                -webkit-border-radius: 10px 10px 10px 10px;
                padding: 5px;
		margin: 3px;
                background: #ffdf4a;
                border: 1px solid #ff7d4a;
		font-weight: bold;
		display: inline-block;
		cursor: pointer;
	}

	input#button:hover {
		background: #ff7d4a;
	}

	div#button {
                border-radius: 10px 10px 10px 10px;
                -moz-border-radius: 10px 10px 10px 10px;
                -webkit-border-radius: 10px 10px 10px 10px;
                padding: 5px;
                margin: 3px;
                background: #ffdf4a;
                border: 1px solid #ff7d4a;
                font-weight: bold;
                display: inline-block;
                cursor: pointer;
        }

        div#button:hover {
                background: #ff7d4a;
        }

	span.title {
		color: #8a0000;
		font-weight: bold;
		font-size: 110%;
	}

	div#saving {
		border-radius: 10px 10px 10px 10px;
                -moz-border-radius: 10px 10px 10px 10px;
                -webkit-border-radius: 10px 10px 10px 10px;
		padding: 10px;
		background: #ffdf4a;
		border: 1px solid #ff7d4a;
		display:none;
		position: absolute;
		right: 10px;
	}

	img#loading {
		display: none;
		position: absolute;
	}

	a#addnew {
		background: #00127E;
    		border-radius: 5px 5px 5px 5px;
		-moz-border-radius: 5px 5px 5px 5px;
		-webkit-border-radius: 5px 5px 5px 5px;
    		color: #FFFFFF;
    		display: block;
    		float: right;
    		font-weight: bold;
    		padding: 3px;
    		text-decoration: none;
	}

	a#addnewcustomer {
                background: #00127E;
                border-radius: 5px 5px 5px 5px;
                -moz-border-radius: 5px 5px 5px 5px;
                -webkit-border-radius: 5px 5px 5px 5px;
                color: #FFFFFF;
                display: block;
                float: right;
                font-weight: bold;
                padding: 3px;
                text-decoration: none;
        }

	a#addnewpaypal {
                background: #00127E;
                border-radius: 5px 5px 5px 5px;
                -moz-border-radius: 5px 5px 5px 5px;
                -webkit-border-radius: 5px 5px 5px 5px;
                color: #FFFFFF;
                display: block;
                float: right;
                font-weight: bold;
                padding: 3px;
                text-decoration: none;
		margin: 2px;
        }

	a#clearpaypal {
                background: #00127E;
                border-radius: 5px 5px 5px 5px;
                -moz-border-radius: 5px 5px 5px 5px;
                -webkit-border-radius: 5px 5px 5px 5px;
                color: #FFFFFF;
                display: block;
                float: right;
                font-weight: bold;
                padding: 3px;
                text-decoration: none;
                margin: 2px;
        }

	input#submit {
                background: #00127E;
                border-radius: 5px 5px 5px 5px;
                -moz-border-radius: 5px 5px 5px 5px;
                -webkit-border-radius: 5px 5px 5px 5px;
                color: #FFFFFF;
                display: block;
                float: right;
                font-weight: bold;
                padding: 3px;
                text-decoration: none;
                margin: 2px;
		border: 0;
		cursor: pointer;
        }

	input#submit:hover {
		background: #22284b;
	}

	a {
   		outline: 0;
	}
	a#addnew:hover {
		background: #22284b;
	}

	a#addnewcustomer:hover {
                background: #22284b;
        }

	a#addnewpaypal:hover {
                background: #22284b;
        }

	a#clearpaypal:hover {
                background: #22284b;
        }

	ul#menu {
		margin: 8px 0 0;
	}

	
	ul#menu li {
		background: #002D6B;
    		border-radius: 0 0 5px 5px;
		-moz-border-radius: 0 0 5px 5px;
                -webkit-border-radius: 0 0 5px 5px;
    		color: #FFFFFF;
    		cursor: pointer;
    		display: inline;
    		font-weight: bold;
    		padding: 8px;
		border: 1px solid #002D6B;
	}

	ul#menu li:hover {
		background: #005ede;
	}

	ul#menu li.active {
                background: #005ede;
        }

	div#header {
		background: url("img/headback.png");
		padding: 10px 20px 20px 0;
		border-bottom: 1px solid #002D6B;
	}

	div#header h1 {
		margin: 0;
		padding: 0;
		/* font-family: 'Ruslan Display', cursive; */
		font-family: 'Monoton', cursive;
	}

	table tr#titles {
		text-align: center;
		color: #fff;
		background: #002D6B;
		font-weight: bold;
	}

	table {
		border: 1px solid #00127e;
	}

	table td {
		padding: 5px;
		border-right: 1px dotted #00127e;
	}

	table tr.row1 {
		background: #c0c9ff;
		border-bottom: 1px solid #c0c9ff;
	}

	table tr.row2 {
		background: #e4e8ff;
		border-bottom: 1px solid #e4e8ff;
        }
	table tr:hover {
                 background: #fffed9;
        }

       table.infos {
                margin-top: 10px;
                padding: 5px;
		/*
                border-radius: 5px 5px 5px 5px;
                -moz-border-radius: 5px 5px 5px 5px;
                -webkit-border-radius: 5px 5px 5px 5px;
                background: #E4E8FF;
                border: 1px solid #399fff;
		*/
                float:left;
                /* height: 193px; */
        }

        table.infos td {
                padding: 2px;
		border-right: none;
        }

        table.infos tr:hover {
                background: #e3f1ff;
        }

	.ui-dialog .ui-dialog-title {
		color: #00127E;
	}

	div.del {
    		background: url("img/del.png") no-repeat left;
    		cursor: pointer;
    		height: 35px;
    		width: 35px;
	}
	div.del:hover {
		 background: url("img/del.png") no-repeat right;
	}

	div.maxheight {
		max-height: 450px;
		overflow-y: auto;
	}

	.ui-dialog {
    		position:absolute;
		box-shadow: 2px 2px 10px #545454;
	}

	div#filters {
		margin: 5px;
	}

	.ui-widget-content a {
		color: #3c6fcd;
		font-weight: bold;
	}

	.ui-widget-content a:hover {
		color: #000;
	}

	div#prof {
		background: #FFFFB1;
		border: 1px solid #FFAF32;
		padding: 5px;
		width: 425px;
	}

	a.reset {
		color: #bd0000;
		text-decoration: none;
	}

	td.total {
		color: #bd0000;
		font-weight: bold;
	}

	form.login {
    		background: #FFF5B0;
    		border: 1px solid #0C4D7B;
    		border-radius: 10px 10px 10px 10px;
    		margin: 100px auto;
    		padding: 20px;
    		width: 400px;
		box-shadow: 2px 2px 10px #545454;
	}

	table#login {
		border: 0;
	}

	table#login tr:hover {
		background: transparent;
	}

	table#login td {
		border: 0;
		padding: 0;
	}

	form.login h3 {
		font-family: 'Monoton',cursive;
		margin: 5px 0 15px;
	}

	div#sys {
		padding: 10px;
		background: #efefef;
		border-radius: 10px 10px 10px 10px;
                -moz-border-radius: 10px 10px 10px 10px;
                -webkit-border-radius: 10px 10px 10px 10px;
		border: 1px solid #CDCDCD;
    		padding: 10px;
    		width: auto;
		display: inline-block;
	}

	table#sysdata td {
		border: 1px solid #000;
	}

	.datatable {
    		width: 100% !Important;
	}

	.datatable td {
		padding: 2px;
	}

	.datatable tr:hover {
		background: #ffcece;
	}

	.ui-state-default, .ui-widget-content .ui-state-default {
		font-weight: bold;
	}

</style>

<?
	if (isset($_POST['pass'])) {
		$user=addslashes(strip_tags($_POST['user']));
		$pass=addslashes(strip_tags($_POST['pass']));

		$sql="SELECT * FROM `system` WHERE USER = '".$user."' AND PASS = '".$pass."'";
                $result=mysql_query($sql);
                $num=mysql_num_rows($result);

		if ($num == 1) {
			$_SESSION['clientid']="OK";
		}
		echo '<script>document.location.href="/";</script>';
	}

	if (isset($_SESSION['clientid'])) {
           $CLIENTID=$_SESSION['clientid'];
           $admin="1";
	   $_SESSION['tries']=0;
        } else {
	   $_SESSION['tries']++;
           $admin="0";
        }

	if ($admin == 0) {
		echo "</head><body>";
		echo '<div id="header">';
        	echo '<img style="float:left" src="img/icones_01024.png"><h1>VoIPEncSwitch ®</h1>';
        	echo '<span style="padding: 7px;font-weight: bold">VoIP Routes Maker with Dialer Complete Solution</span>';
		echo '</div>';

		echo '<form method="post" action="http://'.$_SERVER["HTTP_HOST"].'" class="login">
		<h3>System login</h3>
		<table id="login"><tr><td><b>Username:</b></td><td><input id="user" name="user" ></td></tr>
		<tr><td><b>Password:</b></td><td><input name="pass" id="pass" type="password"></td></tr></table>';
		if ($_SESSION['tries'] > 2)
			echo "<font color=red>Login failed</font>";
		if ($_SESSION['tries'] > 5)
			sleep (3);
		echo '<input type="submit" value="Enter" id="submit"><div style="clear:both"></div></form>';
		echo "</body></html>";
		return 0;
	}
?>

<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.ui.all.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/jquery.alert.js"></script>
<link href="css/jquery.alert.css" rel="stylesheet" type="text/css" media="screen" />
<script>

   function update() {
		$("table#activeroutes").load("loader.php?selectactive=1");
   }

   function reset(route, type) {
	var r = confirm("Are you sure you want to reset "+type+" statistics for this route?");
	if (r == true) {
    		$.post("loader.php", { reset: route, type: type }, function(data) {
        	});
	} else {
    		alert("Reset Canceled!");
	} 

   }

   function fnFeaturesInit(){$('ul.limit_length>li').each(function(i){if(i>10){this.style.display='none'}});$('ul.limit_length').append('<li class="css_link">Show more<\/li>');$('ul.limit_length li.css_link').click(function(){$('ul.limit_length li').each(function(i){if(i>5){this.style.display='list-item'}});$('ul.limit_length li.css_link').css('display','none')})}

   $(function() {

	var lastpos = 140;
	var looper;
	var statslooper;

	$("table#activeroutes").load("loader.php?selectactive=1", function() {
                        $("div#activeroutes").dialog("open");
                });

	$("li#destsettings").click(function() {
		$("div#selectdst").load("loader.php?selectdst=1", function() {
                	$("#destination").dialog("open");
		});
         });

	 $("li#activeroutes").click(function() {
                $("table#activeroutes").load("loader.php?selectactive=1", function() {
			$("div#activeroutes").dialog("open");
                });
         });

	 $("li#customers").click(function() {
                $("table#customers").load("loader.php?selectcustomers=1", function() {
			$("div#addnewcustomer").load("loader.php?addcustomers=1");
                        $("div#customers").dialog("open");
			$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
                });
         });

	 $("li#cdrs").click(function() {
                $("table#cdrs").load("loader.php?cdrs=1", function() {
			$("div#filters").load("loader.php?filters=1");
                        $("div#cdrs").dialog("open");
			$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
                });
         });

	 $("li#payments").click(function() {
                $("div.payments").load("loader.php?payments=1", function() {
                        $("div#payments").dialog("open");
			$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
                });
         });

	 $("li#system").click(function() {
		$("div#system").load("loader.php?system=1", function() {
                	$("div#system").dialog("open");
			$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
		});
         });

	 $("li#callingcards").click(function() {
                $("div#callingcards").load("loader.php?callingcards=1", function() {
                        $("div#callingcards").dialog("open");
                        $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
                });
         });

	 $("#destination").dialog({
		autoOpen: false,
		open: function(event,ui) {
			$("li#destsettings").addClass("active");
			var t = $(this).parent(), w = window;
                        t.offset({
                                top: 140
                        });
			$("img#loading").show();
        		$("table.infos").hide().load("loader.php?dstid=0").fadeIn( function() {
                   		$("img#loading").hide();
        		});
		},
		close: function(event,ui) {
                        $("li#destsettings").removeClass("active");
                },
		show: {
			effect: "fade",
			duration: 500
		},
		hide: {
			effect: "fade",
			duration: 500
		},
		modal: true,
		width: 1095,
		title: "Add/Edit Destination"
	});

	$("div#activeroutes").dialog({
                autoOpen: false,
                open: function(event,ui) {
                        $("li#activeroutes").addClass("active");
			var t = $(this).parent(), w = window;
    			t.offset({
        			top: lastpos,
        			left: 70
    			});
			lastpos = $(this).parent().position().top + $(this).parent().height()+20;
			looper  = setInterval(function(){update()}, 3000);
                },
                close: function(event,ui) {
                        $("li#activeroutes").removeClass("active");
			clearInterval(looper);
                },
		beforeClose: function(event,ui) {
			lastpos = $(this).parent().position().top;
		},
                show: {
                        effect: "fade",
                        duration: 500  
                },
                hide: {
                        effect: "fade",
                        duration: 500  
                },
                width: 1010,
                title: "Active VoIP Routes"
        });

	 $("div#customers").dialog({
                autoOpen: false,
                open: function(event,ui) {
                        $("li#customers").addClass("active");
			var t = $(this).parent(), w = window;
                        t.offset({
                                top: lastpos,
                                left: 70
                        });
			lastpos = $(this).parent().position().top + $(this).parent().height()+20;
                },
                close: function(event,ui) {
                        $("li#customers").removeClass("active");
                },
		beforeClose: function(event,ui) {
                        lastpos = $(this).parent().position().top;
                },
                show: {
                        effect: "fade",
                        duration: 500
                },
                hide: {
                        effect: "fade",
                        duration: 500
                },
                width: 1010,
                title: "Add/Del Accounts for Dialers"
        });

	$("div#cdrs").dialog({
                autoOpen: false,
                open: function(event,ui) {
                        $("li#cdrs").addClass("active");
			var t = $(this).parent(), w = window;
                        t.offset({
                                top: lastpos,
                                left: 70
                        });
			lastpos = $(this).parent().position().top + $(this).parent().height()+20;
                },
                close: function(event,ui) {
                        $("li#cdrs").removeClass("active");
                },
		beforeClose: function(event,ui) {
                        lastpos = $(this).parent().position().top;
                },
                show: {
                        effect: "fade",
                        duration: 500
                },
                hide: {
                        effect: "fade",
                        duration: 500
                },
                width: 1010,
                title: "CDR Data Analysis"
        });

	$("div#payments").dialog({
                autoOpen: false,
                open: function(event,ui) {
                        $("li#payments").addClass("active");
                        var t = $(this).parent(), w = window;
                        t.offset({
                                top: lastpos,
                                left: 70
                        });
                        lastpos = $(this).parent().position().top + $(this).parent().height()+20;
                },
                close: function(event,ui) {
                        $("li#payments").removeClass("active");
                },
                beforeClose: function(event,ui) {
                        lastpos = $(this).parent().position().top;
                },
                show: {
                        effect: "fade",
                        duration: 500
                },
                hide: {
                        effect: "fade",
                        duration: 500
                },
                width: 1010,
                title: "Payment Gateway Settings"
        });

	$("div#statistics").dialog({
                autoOpen: false,
                open: function(event,ui) {
			var t = $(this).parent(), w = window;
                        t.offset({
                                top: 140
                        });
			statslooper  = setInterval(function(){$("div#statistics").load("loader.php?stats=0")}, 5000);
                },
                close: function(event,ui) {
			clearInterval(statslooper);
                },
                beforeClose: function(event,ui) {
                },
                show: {
                        effect: "fade",
                        duration: 500
                },
                hide: {
                        effect: "fade",
                        duration: 500
                },
		modal: true,
                width: 1010,
                title: "Route Statistics"
        });

	$("div#system").dialog({
                autoOpen: false,
                open: function(event,ui) {
                        $("li#system").addClass("active");
                        var t = $(this).parent(), w = window;
                        t.offset({
                                top: lastpos,
                                left: 70
                        });
                        lastpos = $(this).parent().position().top + $(this).parent().height()+20;
                },
                close: function(event,ui) {
                        $("li#system").removeClass("active");
                },
                beforeClose: function(event,ui) {
                        lastpos = $(this).parent().position().top;
                },
                show: {
                        effect: "fade",
                        duration: 500
                },
                hide: {
                        effect: "fade",
                        duration: 500
                },
                width: 1010,
                title: "System Settings"
        });

	$("div#callingcards").dialog({
                autoOpen: false,
                open: function(event,ui) {
                        $("li#callingcards").addClass("active");
                        var t = $(this).parent(), w = window;
                        t.offset({
                                top: lastpos,
                                left: 70
                        });
                        lastpos = $(this).parent().position().top + $(this).parent().height()+20;
                },
                close: function(event,ui) {
                        $("li#callingcards").removeClass("active");
                },
                beforeClose: function(event,ui) {
                        lastpos = $(this).parent().position().top;
                },
                show: {
                        effect: "fade",
                        duration: 500
                },
                hide: {
                        effect: "fade",
                        duration: 500
                },
                width: 1010,
                title: "Calling Cards Generator"
        });
   });

</script>

</head>
<body>

<div id="header">
	<img style="float:left" src="img/icones_01024.png"><h1>VoIP EncTel Switch ®</h1>
	<span style="padding: 7px;font-weight: bold">VoIP Routes Maker</span>
	<form style="float: right" method="post"><input type="hidden" name="logout" value="1"><input type="submit" id="submit" value="Logout"></form>
</div>

<ul id="menu">
	<li id="activeroutes">Active Routes</li>
	<li id="destsettings">Rate/Routing Managment</li>
	<li id="customers">Accounts</li>
	<? // <li id="agents">Agents</li> ?>
	<li id="cdrs">CDR Analysis</li>
	<li id="payments">e-Pay</li>
	<li id='callingcards'>Calling Cards</li>
	<li id="system">System</li>

</ul>

    <div id='destination'>

	<div id="selectdst"></div>

	<table class="infos" cellspacing=0>
	</table>

	<img id="loading" src="img/load_s.gif">
	<div id="saving">Saving...</div>
    </div> <? //end destination ?>

    <div id='activeroutes'>
	<div class="maxheight">
	<table id="activeroutes" cellspacing=0>
	</table>
	</div>
    </div> <? //end active routes ?>

    <div id='customers'>
	<div class="maxheight">
        <table id="customers" cellspacing=0>
        </table>
	</div>
	<div id="addnewcustomer"></div>
    </div> <? //end customers ?>
   
    <div id='cdrs'>
        <div class="maxheight">
	<div id="filters"></div>
        <table id="cdrs" cellspacing=0>
        </table>
        </div>
    </div> <? //end cdrs ?>

    <div id='payments'>
	<img width=200 style="float:left" src="img/paypal.jpg"><br>Allow customers to pay via <b>PayPal</b> and optionally <b>credit card or debit card</b> on a securely hosted checkout form. 
	This payment method requires a PayPal Business account. 
	<a href="https://www.paypal.com/webapps/merchantboarding/webflow/unifiedflow?execution=e2s1" target="_blank"><b>Sign up here</b></a> 
	and edit this rule to start accepting payments.<br>
	Find your API credentials and ensure your payment method and account settings are configured properly.<br>
	<b>After a successful payment the system will create automatically an account for the mobile dialer with a balance charged.</b>
        <div class="payments" cellspacing=0>
        </div>
    </div> <? //end cdrs ?>

    <div id='statistics'>
    </div>

    <div id='system'>
    </div>

    <div id='callingcards'>
    </div>

</body>
</html>
