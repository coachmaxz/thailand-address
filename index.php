
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thailand Address</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<style>
			body { font-family: "Open Sans"; }
			.container { width: 980px; margin: 0 auto; padding: 20px; }
		</style>
    </head>
    <body>
        <div class="container">
			<div class="page-header">
  				<h1>Thailand Address (pdo + php + ajax)</h1>
			</div>
			<form class="form-horizontal" method="POST" accept-charset="UTF-8" autocomplete="off" novalidate>
				<div class="form-group">
					<label for="address_province" class="col-sm-2 control-label">จังหวัด</label>
					<div class="col-sm-5">
						<select name="Address[province]" id="address_province" class="form-control">
							<option value="">--- เลือก จังหวัด ---</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="address_amphur" class="col-sm-2 control-label">อำเภอ</label>
					<div class="col-sm-5">
						<select name="Address[amphur]" id="address_amphur" class="form-control">
							<option value="">--- เลือก อำเภอ ---</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="address_district" class="col-sm-2 control-label">ตำบล</label>
					<div class="col-sm-5">
						<select name="Address[district]" id="address_district" class="form-control">
							<option value="">--- เลือก ตำบล ---</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="address_post" class="col-sm-2 control-label">รหัสไปรษณีย์</label>
					<div class="col-sm-5">
						<input type="text" name="Address[post]" id="address_post" class="form-control" placeholder="รหัสไปรษณีย์">
					</div>
				</div>
				<div class="form-group"><hr />
					<div class="col-sm-offset-2 col-sm-10">
					  	<button type="submit" class="btn btn-default">Register</button>
					</div>
				</div>
            </form>
		</div>	
		<script>
			$(function() {
				$.get("api.php?action=province", function(province){
					$("#address_province").html(province);
				});
				$("#address_province").on('change',function(){
					var province_id = $("#address_province").val();
					$.get("api.php?action=amphur&province_id="+province_id,function(amphur){
						$("#address_amphur").html(amphur);
					});
				});
				$("#address_amphur").on('change',function(){
					var amphur_id = $("#address_amphur").val();
					$.get("api.php?action=district&amphur_id="+amphur_id,function(district){
						$("#address_district").html(district);
					});

				});
				$("#address_district").on('change',function(){
					var amphur_id = $("#address_amphur").val();
					$.get("api.php?action=post&amphur_id="+amphur_id,function(post){
						$("#address_post").val(post);
					});
				});
			});
		</script>    
    </body>
</html>

<!-- end -->