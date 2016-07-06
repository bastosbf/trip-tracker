<form id="trip-form" enctype="multipart/form-data">
 <div class="form-group">
  <label for="trip_country">Country</label>
  <select id="trip_country" name="trip_country" class="form-control"></select>
 </div>
 <div class="form-group">
  <label for="trip_state">State</label>
  <select id="trip_state" name="trip_state" class="form-control" disabled="disabled"></select>
 </div>
 <div id="trip-alert" class="alert alert-info" style="display: none">
  Please, input the latitude and longitude of the selected state. It can be obtained in:
  <a href="http://www.latlong.net/" target="_blank">http://www.latlong.net/</a>
 </div>
 <div id="latitude-form-group" class="form-group" style="display: none">
  <label for="trip_latitude">Latitude</label>
  <input type="text" id="trip_latitude" name="trip_latitude" class="form-control" placeholder="Latitude" />
 </div>
 <div id="longitude-form-group" class="form-group" style="display: none">
  <label for="trip_longitude">Longitude</label>
  <input type="text" id="trip_longitude" name="trip_longitude" class="form-control" placeholder="Longitude" />
 </div>
 <div class="form-group">
  <label for="trip_date">Date (yyyy-mm-dd)</label>
  <div class='input-group date' id='datetimepicker'>
   <input name="trip_date" id="trip_date" type='text' class="form-control" placeholder="Date" />
   <span class="input-group-addon">
    <span class="glyphicon glyphicon-calendar"></span>
   </span>
  </div>
 </div>
 <div class="form-group">
  <label for="trip_photo">Photo</label>
  <input id="trip_photo" name="trip_photo" type="file" class="file file-loading" placeholder="Photo" data-allowed-file-extensions='["jpg", "png"]'>
 </div>
 <br />
 <div align="right">
  <input type="submit" class="btn btn-primary" value="Add" />
 </div>
</form>
<script type="text/javascript">
 $( document ).ready(function() {
   $.ajax({
		type : "POST",
		url : "ajax/get-countries.php",
		success : function(data) {
			$("#trip_country").html(data);
		}
	});
   $("#trip_photo").fileinput({
       showUpload: false,       
   });
 });
 $(function() {
	    $('#datetimepicker').datetimepicker({
	    	format: 'YYYY-MM-DD'
	    });	    
 });
 </script>
<script type="text/javascript">
$("#trip_country").on("change", function() {
 $.ajax({
  type : "POST",
  url : "ajax/get-states.php",
  data : 'country=' + $("#trip_country option:selected").val(),
  success : function(data) {
   $("#trip_state").prop("disabled", null);
   $("#trip_state").html(data);
   $("#trip_state").on("change", function() {
    var value = $("#trip_state option:selected").val()
    var data = value.split(":");
    if (data[1] == "0" && data[2] == "0") {
     $("#trip-alert").show();
     $("#latitude-form-group").show();
     $("#longitude-form-group").show();
    } else {
     $("#trip-alert").hide();
     $("#latitude-form-group").hide();
     $("#longitude-form-group").hide();
    }
   });
  }
 });
});
</script>
<script type="text/javascript">
$("#trip-form").on("submit", function(e) {
   return false;
 });
 </script>
