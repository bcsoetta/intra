<script>
	$(document).ready(function() {
		var code = "<?php echo $code; ?>";
		if (code !== "") {
		   $.ajax({
				type: "POST",
				url: "/app/db/db_data.php",
				data: 'action=activation&code=' + code,
				dataType: 'json',
				success: function(data) {
					$("#actinfo").text(data.status);
				}
			});
		}
	});
</script>
