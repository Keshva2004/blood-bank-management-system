<?php include 'include/header.php'; ?>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        padding: 80px 0;
    }

    .panel {
        background: #ffffff;
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
        font-size: 18px;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        padding: 12px 30px;
        font-size: 18px;
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
    font-size: 26px;
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
    font-size: 22px;
    font-weight: 700;
}

.donors_data {
    background-color: white;
    border-radius: 5px;
    margin: 20px 5px 0px 5px;
    -webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
    -moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
    box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
    padding: 20px;
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

                    <div class="donors_data">
                    <span class="name">Congratulation!</span>
                    <span> You Already Safe the life. You will donate the blood after three months. We are very thanking full to you.</span>
</div>


                </div>
            </div>
        </div>
    </div>
</div>


