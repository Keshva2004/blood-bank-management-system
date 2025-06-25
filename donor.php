<?php include 'include/header.php'; ?>

<style>
    .size {
        min-height: 250px;
        padding: 60px 0 40px 0;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
                    url('https://t3.ftcdn.net/jpg/01/37/30/90/360_F_137309034_4oK5BoYqUc7sUoNor1ltGW0PAYNzExK9.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    .donors_data {
        background-color: white;
        border-radius: 15px;
        margin: 20px 10px;
        padding: 25px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border-top: 5px solid #2196F3;
    }
    .donors_data:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    .name {
        color: #2196F3;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 15px;
        text-transform: capitalize;
    }
    .donors_data span {
        display: block;
        margin: 8px 0;
        color: #555;
        font-size: 16px;
    }
    .donors_data span i {
        margin-right: 10px;
        color: #2196F3;
    }
    h1 {
        color: white;
        font-size: 3.5em;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    .custom-bar {
        width: 80px;
        height: 4px;
        background: #2196F3;
        margin: 20px auto;
        border-radius: 2px;
    }
    .donated-badge {
        background: linear-gradient(135deg, #4CAF50 0%,rgb(80, 156, 83) 100%);
        color: white;

        padding: 8px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        display: inline-block;
        margin-top: 10px;
    }
	.header-section {
        background: url('https://png.pngtree.com/background/20210711/original/pngtree-blood-donation-art-free-simple-white-banner-picture-image_1100873.jpg') center/cover no-repeat;
        padding: 80px 0;
        position: relative;
        text-align: center;
    }
    .header-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
    }
    .header-content {
        position: relative;
        z-index: 1;
    }
    .header-title {
        color: #fff;
        font-size: 4em;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        margin: 0;
        padding-bottom: 10px;
        position: relative;
    }
    .header-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: #fff;
    }
</style>
<div class="header-section">
    <div class="header-content">
        <h1 class="header-title">Donors</h1>
    </div>
</div>
<div class="container" style="padding: 60px 0;">
	<div class="row data">



<?php
    $sql = "SELECT * FROM donor";
    $result = mysqli_query($connection, $sql);
    
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['save_life_date']=='0'){
                echo '
                <div class="col-md-3 col-sm-12 col-lg-3 donors_data">
                    <span class="name">'." ".$row['name'].'</span>
                    <span><i class="fas fa-map-marker-alt"></i>'." ".$row['city'].'</span>
                    <span><i class="fas fa-tint"></i>'." ".$row['blood_group'].'</span>
                    <span><i class="fas fa-user"></i>'." ".$row['gender'].'</span>
                    <span><i class="fas fa-envelope"></i>'." ".$row['email'].'</span>
                    <span><i class="fas fa-phone"></i>'." ".$row['contact_no'].'</span>
                </div>
                ';
            } else {
                $date= $row['save_life_date'];
                 $start= date_create("$date");
                       $end  = date_create();
                       $diff = date_diff( $start, $end );

                     
                       $diffMonth = $diff->m;
                      
                        
                       if($diffMonth >=3){
                echo '
                <div class="col-md-3 col-sm-12 col-lg-3 donors_data">
                    <span class="name">'." ".$row['name'].'</span>
                    <span><i class="fas fa-map-marker-alt"></i>'." ".$row['city'].'</span>
                    <span><i class="fas fa-tint"></i>'." ".$row['blood_group'].'</span>
                    <span><i class="fas fa-user"></i>'." ".$row['gender'].'</span>
                    <span><i class="fas fa-envelope"></i>'." ".$row['email'].'</span>
                    <span><i class="fas fa-phone"></i>'." ".$row['contact_no'].'</span>
                </div>
                ';
                       }
                       else{
                echo '
                <div class="col-md-3 col-sm-12 col-lg-3 donors_data">
                    <span class="name">'." ".$row['name'].'</span>
                    <span><i class="fas fa-map-marker-alt"></i>'." ".$row['city'].'</span>
                    <span><i class="fas fa-tint"></i>'." ".$row['blood_group'].'</span>
                    <span><i class="fas fa-user"></i>'." ".$row['gender'].'</span>
                    <div class="text-center">
                        <span class="donated-badge"><i class="fas fa-heart"></i> Blood Donated</span>
                    </div>
                </div>
                ';
                       }

                
            }
        }
    }
?>


	<!-- <div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                <strong>Are you delete this record?</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form target="" method="post">
                <br>
                <input type="hidden" name="delId" value="">
                <button type="submit" name="delete" class="btn btn-danger">Yes</button>

                <button type="button" class="btn btn-info" data-dismiss="alert">
                <span aria-hidden="true">Oops! No </span>
                </button>      
            </form>
     </div>

     <br>

     <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Message</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>-->



<?php	

	include ('include/footer.php'); 

?>
