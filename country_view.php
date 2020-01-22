<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	<div class="row">
	  <div class="col-md-6 mb-3">
	  	<label for="validationCustom03">Category:</label>
	      <select class="form-control form-control-lg" name="category" id="validationCustom03" onchange="ChangecatList(this.value)" required>
	        <option value="">Choose... </option>
	        <?php foreach ($country as $key => $value) { ?>
	        <option value="<?php echo $value['id'] ; ?>"><?php echo $value['name'] ; ?></option>
	        <?php } ?>
	      </select>
		<div class="invalid-feedback">
			Please provide a category.
		</div>
	  </div>
	  <div class="col-md-6 mb-3">
	  	<label for="validationCustom04">Activity:</label>
	     <select class="form-control form-control-lg" id="validationCustom04" name="activity" required>
	     	
	     </select>
	    
	  </div>
	</div>
	<script>
		function ChangecatList(id) {
			// body...
			var html='';
			 $.ajax({
				  url: "<?php echo base_url('home/fetch_state'); ?>",
				  type: "POST",
				  data:"country_id=" + id,
				  dataType:"text",
				  success: function(data){
				   var obj = JSON.parse(data);
				    $.each(obj, function(i, field){
                    html += '<option value="'+field.id+'">'+field.name+'</option>';

                   });
				    $('#validationCustom04').html(html);
				  }

			})
		}
	</script>
</body>
</html>