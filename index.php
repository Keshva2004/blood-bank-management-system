<?php include 'include/header.php'; ?>

<style>
    .header-img {
        min-height: 100vh;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
                    url('https://liveyourlifept.com/blog/wp-content/uploads/2017/01/Give-blood-save-life.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .header-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        padding: 0 20px;
    }
    .header h1 {
        font-size: 4em;
        color: #fff;
        font-weight: 800;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        margin-bottom: 20px;
    }
    .header p {
        color: #fff;
        font-size: 1.4em;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }
    .search-container {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        margin: 30px auto;
    }
    .search-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    .form-group {
        margin: 10px 0;
        width: 100%;
        max-width: 300px;
    }
    select.form-control {
        width: 100% !important;
        height: 50px !important;
        text-align: center;
        border-radius: 10px;
        border: 2px solid rgba(255,255,255,0.2);
        background: rgba(255,255,255,0.95);
    }
    .btn-danger {
        min-width: 200px;
        background: linear-gradient(45deg, #ff4b2b, #ff416c);
        border: none;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-danger:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255,65,108,0.3);
    }
    .white-bar {
        width: 80px;
        height: 4px;
        background: #fff;
        margin: 20px auto;
        border-radius: 2px;
    }
</style>

<div class="container-fluid header-img">
    <div class="header-content">
        <div class="header">
            <h1>Donate the blood, save the life</h1>
            <p>Donate the blood to help the others.</p>
        </div>

        <div class="search-container">
            <h2 class="text-white mb-4">Search The Donors</h2>
            <hr class="white-bar">
            
            <form action="search.php" method="get" class="search-form">
                <div class="form-group">
                    <select name="city" id="city" class="form-control" required>
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

                        <?php
                            // Your existing city options here
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <select name="blood_group" id="blood_group" class="form-control">
                        <option value="">-- Select Blood Group --</option>
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
                    <button type="submit" class="btn btn-lg btn-danger">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Rest of your code (donate section and cards) remains the same -->

			<!-- header ends -->

			<!-- donate section -->

			<!-- end doante section -->
			
<!-- Donate section -->
<!-- <div class="container-fluid" style="background: #e74c3c; padding: 80px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <h1 class="text-white display-4 mb-4">Donate The Blood</h1>
                <div class="white-bar"></div>
                <p class="text-white lead mb-5" style="line-height: 1.8;">
                    A single pint of blood can save up to three lives – imagine the impact you could make with just a few minutes of your time. Blood donation is not just a noble act; it's a powerful way to give someone a second chance at life. Every drop counts, especially in emergencies, surgeries, and for patients battling life-threatening conditions. You don't need to be a doctor to save lives – just a kind heart and a willingness to help. Be the reason someone smiles today, someone lives tomorrow. Donate blood, and become a real-life hero.
                </p>
                <a href="donate.php" class="btn btn-light btn-lg px-5 py-3">Become a Life Saver!</a>
            </div>
        </div>
    </div>
</div> -->

<!-- Cards section -->
<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <h3 class="card-title mb-4">Our Vision</h3>
                    <div class="icon-wrapper mb-4">
                        <img src="img/binoculars.png" alt="Vision" class="img-fluid" style="width: 120px;">
                    </div>
                    <p class="card-text">
                        Creating a world where every person in need has immediate access to safe blood. We envision a community where blood donation becomes a regular act of compassion.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <h3 class="card-title mb-4">Our Goal</h3>
                    <div class="icon-wrapper mb-4">
                        <img src="img/target.png" alt="Goal" class="img-fluid" style="width: 120px;">
                    </div>
                    <p class="card-text">
                        To establish a robust network of regular donors and ensure that no life is lost due to blood shortage. We aim to make blood donation accessible and convenient.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <h3 class="card-title mb-4">Our Mission</h3>
                    <div class="icon-wrapper mb-4">
                        <img src="img/goal.png" alt="Mission" class="img-fluid" style="width: 120px;">
                    </div>
                    <p class="card-text">
                        To connect donors with recipients efficiently, educate communities about the importance of blood donation, and maintain the highest standards of safety and service.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .card-title {
        color: #2c3e50;
        font-weight: 600;
    }
    .icon-wrapper {
        transition: transform 0.3s ease;
    }
    .card:hover .icon-wrapper {
        transform: scale(1.1);
    }
    .white-bar {
        width: 80px;
        height: 4px;
        background: #fff;
        margin: 20px auto;
        border-radius: 2px;
    }
    .lead {
        font-size: 1.1rem;
    }
</style>
			<!-- end aboutus section -->


<?php
//include footer file
include ('include/footer.php');
 ?>
