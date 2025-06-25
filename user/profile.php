<?php include 'include/header.php'; ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    
    body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(-45deg, #8e2de2,rgb(127, 85, 213), #ff416c, #ff4b2b);
    background-size: 400% 400%;
    animation: gradientRad 12s ease infinite;
    color: #ffffff;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    overflow-x: hidden;
}


@keyframes gradientRad {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}



    .container {
        padding: 80px 0;
    }

    .panel {
        background:rgb(243, 227, 227);
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .heading h1, .heading h3 {
        display: inline-block;
        margin: 0 10px;
        color: #dc3545;
    }

    .text-center {
        text-align: center;
        font-weight:bold;
        font-size: 20px;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        padding: 12px 30px;
        font-size: 20px;
        border-radius: 50px;
        transition: background 0.3s;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .alert {
        margin-top: 20px;
        border-radius: 10px;
    }

    .buttons button {
        margin: 10px;
        border-radius: 30px;
        font-size: 16px;
        padding: 10px 25px;
    }

    .test-success {
        margin-top: 20px;
        font-size: 18px;
        color: #28a745;
        font-weight: 500;
    }

    .thank-you-message {
        font-size: 18px;
        color: #333;
        margin-top: 20px;
        text-align: center;
    }
    .heading {
    margin-bottom: 20px;
}

.welcome-text {
    font-size: 36px;
    font-weight: 500;
    color: #555;
    margin-right: 10px;
}

.username-text {
    font-size: 36px;
    font-weight: bold;
    color: #dc3545;
    display: inline-block;
    animation: fadeInUp 1s ease-out;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
}

/* Simple fade-in animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.name {
    color: #e74c3c;
    font-size: 25px;
    font-weight: 700;
}

.donors_data {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
    color: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    margin: 20px 5px 0px 5px;
    text-align: center;
    font-size: 20px;
}

.thank-you-box {
    background: linear-gradient(135deg, #fff0f0, #ffeaea);
    padding: 30px;
    border: 2px solid #dc3545;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
    margin-top: 30px;
}

.congrats-text {
    color: #dc3545;
    font-weight: 700;
    font-size: 28px;
    margin-bottom: 15px;
    animation: fadeInUp 1s ease-out;
}

.message-text {
    font-size: 18px;
    color: #444;
    line-height: 1.6;
    animation: fadeInUp 1.2s ease-out;
}


</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="panel">
                <div class="panel-body">

                    <div class="alert alert-danger alert-dismissable text-center" style="display: none;">
                        <strong>Warning!</strong> Are you sure you want to save a life? If you press yes, you will not be able to donate again for 3 months.
                        <div class="buttons">
                            <input type="text" value="" hidden name="today">
                            <button class="btn btn-primary" id="yes" name="yes" type="submit">Yes</button>
                            <button class="btn btn-info" id="no" name="no">No</button>
                        </div>
                    </div>

                    <div class="heading text-center">
                        <h3 class="welcome-text">Welcome</h3> 
                        <h1 class="username-text"> <?php if(isset($_SESSION['name'])) echo $_SESSION['name'];?></h1>
                    </div>
                    <p class="text-center">Here you can manage your account and update your profile</p>

                    <div class="text-center">
                        <button id="save_the_life" class="btn btn-danger">Save The Life</button>
                    </div>

                    <div class="test-success text-center" id="data"><!-- Display Message here --></div>

                   <div class="donors_data thank-you-box text-center">
    <h2 class="congrats-text">🎉 Congratulations, <?php echo $_SESSION['name']; ?>!</h2>
    <p class="message-text">
        You've already saved a life. <br>
        You can donate blood again after three months.<br>
        Thank you for your life-saving contribution!
    </p>
</div>



                </div>
            </div>
        </div>
    </div>
</div>

<?php
//include footer file
include('include/footer.php');

?>


