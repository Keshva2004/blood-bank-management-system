<?php 
	// Include header file
	include ('include/header.php');
?>
<style>
	.size {
		background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://www.lompocvmc.com/images/blog/heart/organ-donation.jpg') center/cover no-repeat;
		background-attachment: fixed;
		padding: 70px 0 50px;
		min-height: 100vh;
	}

	.container {
		background-color: rgba(255, 255, 255, 0.85);
		padding: 40px 30px;
		border-radius: 15px;
		box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
	}

	.container h1 {
		font-size: 38px;
		color: #2c3e50;
		font-weight: 700;
		text-align: center;
		margin-bottom: 20px;
	}

	.container .white-bar {
		width: 100px;
		height: 3px;
		background: #e74c3c;
		margin: 10px auto 30px;
		border-radius: 1px;
	}

	.form-inline {
		display: flex;
		justify-content: center;
		align-items: center;
		gap: 20px;
	}
	.form-group {
		display: inline-block;
		width: 200px;
	}

	.form-group select {
		width: 100%;
		padding: 12px;
		border-radius: 25px;
		font-size: 16px;
		border: 2px solid #ddd;
		box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
		transition: border 0.3s ease;
	}

	.form-group select:focus {
		border-color: #3498db;
		outline: none;
	}

	#search {
		background-color: #e74c3c;
		color: white;
		border-radius: 25px;
		padding: 14px 30px;
		font-size: 16px;
		border: none;
		cursor: pointer;
		transition: background-color 0.3s ease, transform 0.2s ease;
	}

	#search:hover {
		background-color: #c0392b;
		transform: translateY(-2px);
		box-shadow: 0 8px 20px rgba(231, 76, 60, 0.2);
	}

	.donors_data {
		border-radius: 12px;
		background-color: #ffffff;
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
		overflow: hidden;
		margin-bottom: 20px;
	}

	.donor-card {
		padding: 20px;
		text-align: center;
	}

	.donor-card h3 {
		color: #e74c3c;
		font-size: 24px;
		margin-bottom: 15px;
	}

	.donor-info p {
		font-size: 16px;
		color: #333;
		margin: 10px 0;
	}

	.donor-info i {
		color: #e74c3c;
		margin-right: 8px;
	}

	.donated-badge {
		background-color: #2ecc71;
		color: white;
		padding: 8px 15px;
		border-radius: 25px;
		font-weight: bold;
		margin-top: 15px;
		font-size: 14px;
	}

	.donor-info {
		text-align: left;
	}

	.alert {
		background-color: #f8d7da;
		color: #721c24;
		font-size: 16px;
		padding: 15px;
		border-radius: 10px;
	}

	.loader {
		display: none;
		width: 70px;
		height: 70px;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.loader .fa {
		color: #e74c3c;
		font-size: 40px;
	}
</style>

<div class="container-fluid size">
	<div class="container">
		<h1>Search Donors</h1>
		<div class="white-bar"></div>

		<div class="form-inline">
			<div class="form-group">
				<select name="city" id="city" required>
					<option value="">-- Select City --</option>
					<optgroup title="A" label="&raquo; A"></optgroup>
<option value="Aambaliyasan">Aambaliyasan</option>
<option value="Agol">Agol</option>
<option value="Aithor">Aithor</option>
<option value="Akhaj">Akhaj</option>
<option value="Ambasan">Ambasan</option>

<optgroup title="B" label="&raquo; B"></optgroup>
<option value="Badarpur">Badarpur, Gujarat</option>
<option value="Bhandu">Bhandu</option>
<option value="Bhankhar">Bhankhar</option>
<option value="Bokarvada">Bokarvada</option>
<option value="Boriavi">Boriavi (Mehsana Taluka)</option>
<option value="Brahmanwada,Unjha">Brahmanwada, Unjha</option>

<optgroup title="C" label="&raquo; C"></optgroup>
<option value="Chansol">Chansol</option>

<optgroup title="D" label="&raquo; D"></optgroup>
<option value="Dabhad">Dabhad</option>
<option value="Dabhoda">Dabhoda, Mehsana</option>
<option value="Davol">Davol, Mehsana</option>
<option value="Deloli">Deloli</option>

<optgroup title="G" label="&raquo; G"></optgroup>
<option value="Gambhu">Gambhu</option>
<option value="Ghumasan">Ghumasan</option>
<option value="Gorisana">Gorisana</option>
<option value="Gozaria">Gozaria</option>

<optgroup title="J" label="&raquo; J"></optgroup>
<option value="Jetalvasana">Jetalvasana</option>

<optgroup title="K" label="&raquo; K"></optgroup>
<option value="Kesimpa">Kesimpa, Mehsana</option>
<option value="Kharod">Kharod, Gujarat</option>
<option value="Kherva">Kherva</option>
<option value="Kuda">Kuda, Mehsana</option>

<optgroup title="L" label="&raquo; L"></optgroup>
<option value="Ladol">Ladol, Gujarat</option>
<option value="Langhnaj">Langhnaj</option>

<optgroup title="M" label="&raquo; M"></optgroup>
<option value="Madhasana">Madhasana</option>
<option value="Mahiyal">Mahiyal</option>
<option value="Maktupur">Maktupur</option>
<option value="Malarpura">Malarpura</option>
<option value="Mandropur">Mandropur</option>
<option value="Modhera">Modhera</option>
<option value="Mota Kotarna">Mota Kotarna</option>

<optgroup title="N" label="&raquo; N"></optgroup>
<option value="Nava Sudasana">Nava Sudasana</option>

<optgroup title="P" label="&raquo; P"></optgroup>
<option value="Pilvai">Pilvai</option>

<optgroup title="R" label="&raquo; R"></optgroup>
<option value="Rahemanpur">Rahemanpur</option>

<optgroup title="S" label="&raquo; S"></optgroup>
<option value="Sadikpur, Kheralu">Sadikpur, Kheralu</option>
<option value="Sakari">Sakari, Mehsana</option>
<option value="Saldi">Saldi</option>
<option value="Samoja">Samoja</option>
<option value="Sangathala">Sangathala</option>
<option value="Satlasana">Satlasana</option>
<option value="Shahpur">Shahpur, Kheralu</option>
<option value="Suvariya">Suvariya</option>

<optgroup title="T" label="&raquo; T"></optgroup>
<option value="Thangana">Thangana, Mehsana</option>
<option value="Timba">Timba, Mahesana</option>
<option value="Tundav">Tundav</option>

<optgroup title="U" label="&raquo; U"></optgroup>
<option value="Ucharpi">Ucharpi</option>
<option value="Unad">Unad, Mehsana</option>
<option value="Unava">Unava</option>

<optgroup title="V" label="&raquo; V"></optgroup>
<option value="Vaghvadi">Vaghvadi, Mehsana</option>
<option value="Vakhtapur">Vakhtapur (Mahi Kantha)</option>
<option value="Vamaj">Vamaj</option>
<option value="Varetha">Varetha</option>
<option value="Vavdi">Vavdi, Mehsana</option>
<option value="Vithoda">Vithoda</option>
				</select>
			</div>
			<div class="form-group">
				<select name="blood_group" id="blood_group">
					<option value="A+">A+</option>
					<option value="A-">A-</option>
					<option value="B+">B+</option>
					<option value="B-">B-</option>
					<option value="AB+">AB+</option>
					<option value="AB-">AB-</option>
					<option value="O+">O+</option>
					<option value="O-">O-</option>
				</select>
			</div>
			<div class="form-group">
				<button type="button" id="search">Search</button>
			</div>
		</div>
	</div>

	<!-- Donor list will appear here -->
	
		<div class="row" id="data">
			<!-- Donors will be dynamically loaded here -->
		</div>
	</div>
</div>

<div class="loader" id="wait">
	<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>
</div>

<?php 
	// Include footer file
	include ('include/footer.php');
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#search").on("click", function() {
            var city = $("#city").val();
            var blood_group = $("#blood_group").val();

            if(city == "" || blood_group == "") {
                alert("Please select both city and blood group");
                return false;
            }

            // Show loader
            $("#wait").show();

            // Make AJAX request to fetch donors data
            $.ajax({
                url: 'fetch_donors.php', // PHP file to fetch donor data
                method: 'GET',
                data: { city: city, blood_group: blood_group },
                success: function(response) {
                    $("#wait").hide();
                    $("#data").html(response); // Display the fetched data
                }
            });
        });
    });
</script>
