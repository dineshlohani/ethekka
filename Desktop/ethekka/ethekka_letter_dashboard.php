<?php require_once("includes/initialize.php"); ?>
<?php	
	if(!$session->is_logged_in()){ redirect_to("logout.php");}
	$plan_selected = Plandetails1::find_by_id($_SESSION['set_plan_id']);

$program_id=$_SESSION['set_plan_id'];
?>
<?php include("menuincludes/header.php"); ?>
<title>पत्रहरु छान्नुहोस् :: <?php echo SITE_SUBHEADING;?></title>
<style>
* {
  box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.userprofile {
  float: left;
  width: 33.33%;
  padding: 20px;
  background-color:#bbb;
  height: 150px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
#rcorners1 {
  border-radius: 25px;
  background: #87CEEB;
  padding: 40px; 
  width: 350px;
  height: 150px;
  color: red;  
}
</style>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
<div id="body_wrap_inner"> 
    <div class="maincontent">
        <h2 class="dashboard">ठेक्का  संचालन प्रकृया | <a href="contract_dashboard.php?id=<?= $program_id ?>" class="btn" >पछी जानुहोस </a></h2>
            <div class="OurContentFull">
                <div class="myMessage"><?php echo $message;?></div>
                <h2>ठेक्का सम्झौता संग सम्बन्धित पत्रहरु छान्नुहोस् </h2>
                <div class="grid-container">
                    <div class="container">
                    <h1 class="myHeading1">योजनाको नाम :: <?=$plan_selected->program_name?></h1>
                    <div class="myspacer"></div>
                        <div class="row">
                        <div class="col-md-4">
                                                <a href="ethekka_tippani_patra.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">लागत अनुमान स्वीकृत गरि कार्य अगाडी बढाउने सम्बन्धमा<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="ethekka_aashay_suchana.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">आशयको सूचना प्रकाशन सम्बन्धमा<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="ethekka_bolpatra_aashay.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">बोलपत्र स्वीकृत गर्ने आशयको सुचना<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="ethekka_jamanat_fukuwa.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">कार्य सम्पादन जमानत फुकुवा सम्बन्धमा<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="ethekka_bolpatra_samjhauta.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">बोलपत्र स्वीकृत  एवं सम्झौता सम्बन्धमा<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="ethekka_samjhauta.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">सम्झौता गर्न आउने सम्बन्धमा<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="ethekka_karyadesh_patra.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">कार्यादेश सम्बन्धमा<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="ethekka_samjhauta_patra.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">सम्झौता पत्र<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        </div>
                    </div>
            </div>
            <div class="myspacer"></div>
            <div class="grid-container">
                <div class="container">
                <h2>ठेक्का पेस्की/म्याद थप/मुल्यांकन र अन्तिम भुक्तानी सम्बन्धित पत्रहरु छान्नुहोस् </h2>
                    <div class="myspacer"></div>
                    <div class="row">
                        <div class="col-md-4">
                                                <a href="contract_print_karyadesh_report_03.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">पेश्की कार्यदेशको टिप्पणी<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="contract_print_karyadesh_report_04.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">म्याद थप को टिप्पणी<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="contract_print_karyadesh_report_05.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">म्याद थप को पत्र<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="contract_print_karyadesh_report_06.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">मुल्यांकन भुक्तानीको टिप्पणी<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                        <div class="col-md-4">
                                                <a href="contract_print_karyadesh_report_07.php" target="_blank">
                                                    <p id="rcorners1" class="text-center" style="font-size: 22px;">अन्तिम भुक्तानीको टिप्पणी<br>
                                                    <img src="images/n/patra.png" alt="Upabhokta Icon" class="dashimg" />
                                                </p>
                                                </a>
                                                </div>
                    </div>
                </div>
            </div>
       </div>
    </div><!-- main menu ends -->
</div><!-- top wrap ends -->
<?php include("menuincludes/footer.php"); ?>