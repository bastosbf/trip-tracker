<?php
require_once 'config/database_config.php';

$data = "";
$bombs = "";
$arcs = "";

if (isset ( $_SESSION ["uuid"] )) {
	$uuid = $_SESSION ["uuid"];
	$sql = "SELECT country.code, state.name, state.latitude, state.longitude, trip.date, trip.photo FROM trip INNER JOIN state ON trip.state_id = state.id INNER JOIN country ON state.country_id = country.id WHERE user_id = '$uuid' ORDER BY trip.date ASC";
	$result = $conn->query ( $sql );
	
	if ($result->num_rows > 0) {
		$first_arcs_flag = true;
		$last_arcs_flag = false;
		$arcs_counter = 0;
		while ( $row = $result->fetch_assoc () ) {
			$arcs_counter ++;
			$county_code = $row ["code"];
			$state_name = $row ["name"];
			$state_latitude = $row ["latitude"];
			$state_longitude = $row ["longitude"];
			$trip_date = $row ["date"];
			$trip_photo = $row ["photo"];
			
			if ($state_latitude != 0 && $state_longitude != 0) {
				$coordinates = "latitude : $state_latitude, longitude : $state_longitude";
			}
			$data .= "$county_code : { fillKey : 'hasTraveledTo' },";
			$bombs .= "{ name : '$state_name', radius : 5, country : '$county_code', date : '$trip_date', img : 'photos/$uuid/$trip_photo', $coordinates},";
			if ($result->num_rows > 1) {
				$last_arcs_flag = $result->num_rows == $arcs_counter;
				if ($first_arcs_flag) {
					$arcs .= "{ origin : { $coordinates },";
					$first_arcs_flag = false;
				} else if ($last_arcs_flag) {
					$arcs .= "destination : { $coordinates }, },";
				} else {
					$arcs .= "destination : { $coordinates }, }, { origin : { $coordinates },";
				}
			}
		}
	}
}
?>
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="css/bootstrap-theme.min.css" />
<link type="text/css" rel="stylesheet" href="css/bootstrap-dialog.min.css" />
<link type="text/css" rel="stylesheet" href="css/fileinput.min.css" />
<script type="text/javascript" src="js/d3.min.js"></script>
<script type="text/javascript" src="js/topojson.min.js"></script>
<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-dialog.min.js"></script>
<script type="text/javascript" src="js/moment-with-locales.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/additional-methods.min.js"></script>
<script type="text/javascript" src="js/datamaps.world.hires.min.js"></script>
<script type="text/javascript" src="js/fileinput.min.js"></script>
</head>
<body>
 <div class="container">
  <nav class="navbar navbar-default">
   <div class="container-fluid">
    <div class="navbar-header">
     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
     </button>
     <a class="navbar-brand" href="#">Trip Tracker</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
     <ul class="nav navbar-nav">
      <li class="active">
       <a href="#">Home</a>
      </li>
      <li>
       <a id="about-menu" href="#">About</a>
      </li>
      <li>
       <a id="contact-menu" href="#">Contact</a>
      </li>
     </ul>
     <ul class="nav navbar-nav navbar-right">
     <?php if(isset($_SESSION["uuid"])) { ?>
      <li>
       <a id="add-trip-menu" href="#">Add Trip</a>
      </li>
      <li>
       <a id="logout-menu" href="#">Logout</a>
      </li>
     <?php } else { ?>
      <li>
       <a id="login-menu" href="#">Login</a>
      </li>
      <li>
       <a id="register-menu" href="#">Register</a>
      </li>
      <?php } ?>
     </ul>
    </div>
   </div>
  </nav>
  <div id="container" style="position: relative; margin: 0 auto; width: 750px; height: 500px;"></div>
 </div>
 <div id="about-modal" class="modal fade">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header" style="padding: 35px 50px;">
     <button type="button" class="close" data-dismiss="modal">X</button>
     <h4>
      About
     </h4>
    </div>
    <div class="modal-body" style="padding: 10% 10%;">
     <?php include 'about.php';?>    
    </div>
   </div>
  </div>
 </div>
 <div id="login-modal" class="modal fade">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header" style="padding: 35px 50px;">
     <button type="button" class="close" data-dismiss="modal">X</button>
     <h4>
      <span class="glyphicon glyphicon-lock"></span>
      Login
     </h4>
    </div>
    <div class="modal-body" style="padding: 10% 10%;">
     <?php include 'login.php';?>    
    </div>
   </div>
  </div>
 </div>
 <div id="register-modal" class="modal fade">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header" style="padding: 35px 50px;">
     <button type="button" class="close" data-dismiss="modal">X</button>
     <h4>New User</h4>
    </div>
    <br />
    <div class="modal-body" style="padding: 10% 10%;">
     <?php include 'register.php';?>
    </div>
   </div>
  </div>
 </div>
 <div id="add-trip-modal" class="modal fade">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header" style="padding: 35px 50px;">
     <button type="button" class="close" data-dismiss="modal">X</button>
     <h4>New Trip</h4>
    </div>
    <br />
    <div class="modal-body" style="padding: 10% 10%;">
     <?php include 'trip.php';?>
    </div>
   </div>
  </div>
 </div>
 <script type="text/javascript">
	var map = new Datamap({
		element : document.getElementById('container'),
		projection : 'mercator',
		fills : {
			defaultFill : "#ABDDA4",
			hasTraveledTo : "#AFAFAF",
			bubbleColor : "#7F7FFF"
		},
		data : {
			<?=$data?>
		},
	});
	map.bubbles([ <?=$bombs?> ],
	 {
	  fillKey : 'bubbleColor',
	  popupTemplate : function(geo, data) {
		  return [
					'<div class="hoverinfo" align="center">' + data.name,
					'<br/>Country: ' + data.country,
					'<br/>Date: ' + data.date,
					'<br/><div align="center"><img src="'+ data.img +'" widht="100px" height="100px"/></div>',
					'</div>' ].join('');
		},
		
	 });
	map.arc([<?=$arcs?>]);
 </script>
 <script type="text/javascript">
 $("#logout-menu").on("click", function() {
	 $.ajax({
	  type : "POST",
	  url : "ajax/logout-user.php",
	  success : function(data) {
	   window.location.reload();	   
	  }
	 });
 });
 </script>
 <script type="text/javascript">
 $("#contact-menu").on("click", function() {
	 BootstrapDialog.show({
	  type : BootstrapDialog.TYPE_INFO,
	  message : 'Send an e-mail to: bastosbf at gmail dot com'
	 });
 });
 </script>
 <script type="text/javascript">
 $("#about-modal").on("show", function() {
     $("#about-modal a.btn").on("click", function(e) {
         $("#about-modal").modal('hide');
     });
 });

 $("#about-modal").on("hide", function() {
     $("#about-modal a.btn").off("click");     
 });
 
 $("#about-modal").on("hidden", function() {
     $("#about-modal").remove();
 });

 $("#about-menu").on("click", function() {
     $("#about-modal").modal({
       "keyboard"  : true,
       "show"      : true                   
     });
 });
 </script>
 <script type="text/javascript">
 $("#login-modal").on("show", function() {
     $("#login-modal a.btn").on("click", function(e) {
         $("#login-modal").modal('hide');
     });
 });

 $("#login-modal").on("hide", function() {
     $("#login-modal a.btn").off("click");     
 });
 
 $("#login-modal").on("hidden", function() {
     $("#login-modal").remove();
 });

 $("#login-menu").on("click", function() {
     $("#login-modal").modal({
       "keyboard"  : true,
       "show"      : true                   
     });
 });
 </script>
 <script type="text/javascript">
 $("#register-modal").on("show", function() {
     $("#register-modal a.btn").on("click", function(e) {
         $("#register-modal").modal('hide');
     });
 });

 $("#register-modal").on("hide", function() {
     $("#register-modal a.btn").off("click");
 });
 
 $("#register-modal").on("hidden", function() {
     $("#register-modal").remove();
 });

 $("#register-menu").on("click", function() {
     $("#register-modal").modal({                  
       "keyboard"  : true,
       "show"      : true                   
     });
 });
 </script>
 <script type="text/javascript">
 $("#add-trip-modal").on("show", function() {
     $("#add-trip-modal a.btn").on("click", function(e) {
         $("#add-trip-modal").modal('hide');
     });
 });

 $("#add-trip-modal").on("hide", function() {
     $("#add-trip-modal a.btn").off("click");
 });
 
 $("#add-trip-modal").on("hidden", function() {
     $("#add-trip-modal").remove();
 });

 $("#add-trip-menu").on("click", function() {
     $("#add-trip-modal").modal({                  
       "keyboard"  : true,
       "show"      : true                   
     });
 });
 </script>
 <script type="text/javascript" src="js/validation.js"></script>
</body>
</html>
