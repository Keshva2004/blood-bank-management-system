<!DOCTYPE html>

	<head>
		<title>Donate The Blood</title>
		<meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Blood Donation Website">
        <meta name="author" content="Exceptional Programmers">

        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


		<!-- Bootstrap Link CSS Files -->
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

        <!-- Custom Link CSS Files -->
		<link rel="stylesheet" href="css/custom.css">

		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	</head>



<?php 
            include 'config.php';

            session_start();
            if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
                include 'usernav.php';
            }else{
               
                include 'navigation.php';

            }
?>