<?php require_once("includes/initialize.php"); 
if(!$session->is_logged_in()){ redirect_to("logout.php");}
if(!isset($_GET['id']) && isset($_SESSION['set_plan_id']))
{
  redirectUrl();
}	$ward_address=WardWiseAddress();
	$address= getAddress();
	$datas=Costumerassociationdetails::find_by_plan_id($_GET['id']);
//        print_r($datas);exit;
	$worker=Moreplandetails::find_by_plan_id($_GET['id']);
	$rules_result = Rule::find_by_plan_id($_GET['id']);
	$url = get_base_url(1);
$print_history = PrintHistory::find_by_url_and_plan_id($url, $_GET['id']);
$workers = Workerdetails::find_all();
if(!empty($print_history))
{
    $worker1 = Workerdetails::find_by_id($print_history->worker1);
    $worker2 = Workerdetails::find_by_id($print_history->worker2);
    $worker3 = Workerdetails::find_by_id($print_history->worker3);
    $worker4 = Workerdetails::find_by_id($print_history->worker4);
    $worker5 = Workerdetails::find_by_id($print_history->worker5);
}
else
{
    $print_history = PrintHistory::setEmptyObject();
    if(empty($worker1))
    {
        $worker1 = Workerdetails::setEmptyObject();
    }
    if(empty($worker2))
    {
        $worker2 = Workerdetails::setEmptyObject();
    }
    if(empty($worker3))
    {
        $worker3 = Workerdetails::setEmptyObject();
    }
    if(empty($worker4))
    {
        $worker4 = Workerdetails::setEmptyObject();
    }
     if(empty($worker5))
    {
        $worker5 = Workerdetails::setEmptyObject();
    }
}
$date = !empty($print_history)? $print_history->nepali_date : generateCurrDate();
	?>
<?php 
$data=  Plandetails1::find_by_id($_GET['id']);
$fiscal = FiscalYear::find_by_id($data->fiscal_id);
$invest_details = Ethekka_lagat::find_by_plan_id($_GET['id']);
// print_r($invest_details);
$datainfo = Ethekkainfo::find_by_plan_id($_GET['id']);
// print_r($datainfo);
?>
<?php include("menuincludes/header.php"); ?>
<!-- js ends -->
<title>योजना संझौता फाराम print page:: <?php echo SITE_SUBHEADING;?></title>
<style>
                          table {

                            width: 100%;
                            border: none;
                          }
                          th, td {
                            padding: 8px;
                            text-align: left;
                            border-bottom: 3px solid #ddd;
                          }
                          input {
                              background-color: #eee;
                          }

                          tr:nth-child(even) {background-color: #f2f2f2;}
                          tr:hover {background-color:#f5f5f5;}
                        </style>
</head>
<body>
    <?php include("menuincludes/topwrap.php"); ?>
    <div id="body_wrap_inner"> 
                <div class="maincontent">
                    <form method="get" action="ethekka_samjhauta_patra_print.php?>">
                    <h2 class="headinguserprofile">योजना संझौता फाराम | <a href="letters_select.php" class="btn">पछि जानुहोस </a>

                        <div class="myPrint"><input type="hidden" name="id" value="<?=$_GET['id']?>" /><input type="submit" value="प्रिन्ट गर्नुहोस" name="submit" /></div>

                    </h2>
                    <div class="OurContentFull">
                    	                        <!--<div class="myPrint"><input type="hidden" name="id" value="<?=$_GET['id']?>" /><input type="submit" value="प्रिन्ट" name="submit" /></div>-->
                        <div class="userprofiletable">
                        	<div class="printPage">
									<div class="image-wrapper">
                                    <a href="#" ><img src="images/janani.png" align="left" class="scale-image"/></a>
                                    <div />
                                    <div class="image-wrapper">
                                    <a href="#" target="_blank" ><img src="images/bhaire.png" align="right" class="scale-image"/></a>
                                    <div />
									<h1 class="marginright1.5 letter-title-one"><?php echo SITE_LOCATION;?></h1>
									<h5 class="marginright1.5 letter-title-two"><?php echo $address;?></h5>
									<h5 class="marginright1.5 letter-title-four"><?php echo $ward_address;?></h5>
									<h5 class="marginright1.5 letter-title-three"><?php echo SITE_SECONDSUBHEADING;?></h5>
									<div class="myspacer"></div>
									<div class="printContent">
                                         <div class="mydate">
                                         <input type="text" name="date_selected" value="<?php echo convertedcit($more_plan_details->miti); ?>" id="nepaliDate5" /></form></div>
                                        <div class="patrano">आर्थिक वर्ष : <?php echo convertedcit($fiscal->year); ?></div>
										<div class="patrano"> योजना दर्ता नं : <?php echo convertedcit($_GET['id']) ?>	</div>
										<div class="banktextdetails1">
                                            <div class="subject" border="none">
                                                <u>बिषय :- <label style="margin-left: 5px;">
                                                        <input type="text" style="border:none" class="no-outline" name="subject" value="योजना सम्झौता पत्र"/></label></u>
                                            </div>
                                              <div class="mycontent" >
                                        <table class="table table-bordered table-responsive">
                                      <tr>
                                            <td class="myWidth50 myTextalignLeft ">योजनाको नाम :</td>
                                            <td><?php echo $data->program_name;?></td>
                                          </tr>

                                            <tr>
                                                <td class="myWidth50 myTextLeft">बिनियोजन श्रोत र ब्याख्या :</td>
                                                <td><?php echo $data1->parishad_sno;?></td>
                                            </tr>

                                      <tr>
                                      <tr>
                                            <td class="myTextalignLeft">आयोजना सचालन हुने स्थान / वार्ड नं :</td>
                                            <td><?php echo SITE_LOCATION;?>-<?php echo convertedcit($group_heading->program_organizer_group_address);?></td>
                                          </tr>
                                      <tr>
                                                <td class="myTextalignLeft">योजनाको बिषयगत क्षेत्रको नाम :</td>
                                                <td><?php echo Topicarea::getName($data->topic_area_id); ?></td>
                                          </tr>
                                           <tr>
                                               <td class="myTextalignLeft">योजनाको  शिर्षकगत नाम </td>
                                               <td ><?php echo Topicareatype::getName($data->topic_area_type_id); ?></td>
                                           </tr>
                                           <tr>
                                               <td class="myTextalignLeft">योजनाको  उपशिर्षकगत नाम</td>
                                               <td><?php echo Topicareatypesub::getName($data->topic_area_type_sub_id); ?></td>
                                           </tr>                                       
                                           <tr>
                                               <td class="myTextalignLeft">योजनाको अनुदानको किसिम</td>
                                               <td><?php echo Topicareaagreement::getName($data->topic_area_agreement_id); ?></td>
                                          </tr> 
                                          <tr>
                                               <td class="myTextalignLeft">योजनाको विनियोजन किसिम</td>
                                               <td><?php echo Topicareainvestment::getName($data->topic_area_investment_id); ?></td>
                                          </tr>
                                           <tr>
                                            <td class="myTextalignLeft">अनुदान रु</td>
                                            <td>रु. <?php echo convertedcit($data->investment_amount);?></td>
                                           </tr>
                                           </table>
                                         </div>
                                              <h4> योजनाको कुल लागत अनुमान </h4>
                                              <div class="mycontent" >
                                                  <table class="table table-bordered table-responsive">
                                                         
                                                      <tr>
                                                          <td class="myTextalignLeft">कन्टेन्जेन्सी
                                                          </td>
                                                          <td>रु. <?php echo convertedcit($invest_details->cont);?></td>
                                                      </tr>
                                                    <tr>
                                                      <td class="myTextalignLeft">कुल लागत अनुमान जम्मा </td>
                                                      <td>रु. <?php echo convertedcit($invest_details->total_investment);?></td>
                                                    </tr>
                                                    <tr>
                                                      <td class="myTextalignLeft">साझेदारी निकाए (<marquee><?php echo $invest_details->anya_nikaya;?></marquee>)</td>
                                                      <td>रु. <?php echo convertedcit($invest_details->anya_nikaya_amount);?></td>
                                                    </tr>
                                                   
                                                  </table>
                                                </div>
                                              <?php
                                              if(empty($datainfo)){?>
                                                <h4 >योजना सम्बन्धी अन्य विवरण भरिएको छैन</h4>
                                              <?php }else{?>
                                              <h4 >योजना सम्बन्धी अन्य विवरण</h4>
                                              <div class="mycontent">
                                                  <table class="table table-bordered table-responsive">
                                                      <tr>
                                                            <td class=" myWidth50 myTextalignLeft">बोलपत्र मिति</td>
                                                            <td ><?php echo convertedcit($datainfo->bolpatra_miti);?></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="myTextalignLeft">बोलपत्र निकालिएको श्रोत</td>
                                                            <td><?php echo convertedcit($datainfo->bolpatra_m);?></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="myTextalignLeft">योजना शुरु हुने मिति</td>
                                                            <td><?php echo convertedcit($invest_details->yojana_start_date);?></td>
                                                          </tr>
                                                          <tr>
                                                            <td class="myTextalignLeft">योजना सम्पन्न हुने मिति</td>
                                                            <td><?php echo convertedcit($invest_details->yojana_end_date);?></td>
                                                          </tr>
                                                       </table>
                                                   </div>
                <?php }?>
                             </div>
                            </div><!-- yojana ends -->
<div class="" style="margin-left:15px; ">
   <h4><u>इलेकट्रोनिक विडिंग (E-Bidding) बाट योजना सम्झौता गर्दा पालना गरिने शर्तहरु:</u></h4>

        १). योजनाको सार्वजनिक परीक्षण, सुचना पाटी, आम्दानी खर्चको सार्वजनिकरण, तथा अन्य पारदर्शिता सम्बन्धी प्रावधानको पालना गर्नु पर्नेछ।</li>
        <br><span>
        २). यस संझौतामा उल्लेख नभएका कुराहरु प्रचलित कानुन अनुसार हुनेछ।</li>
        <br>३). योजनाको लागि चाहिने आवश्यक कागजात यसै साथ संलग्न गरिएकोछ ।</li>
        <br>४). कुनै सामाग्री खरिद गर्दा आन्तरिक राजस्व कार्यालयबाट स्थायी लेखा नम्वर र मुल्य अभिबृद्धि कर दर्ता प्रमाण पत्र प्राप्त व्यक्ति वा फर्म संस्था वा कम्पनीबाट खरिद गरी सोही अनुसारको विल भरपाई आधिकारीक व्यक्तिबाट प्रमाणित गरी पेश गर्नु पर्नेछ ।</li>
        <br>५). मूल्य अभिबृद्धि कर (VAT) लाग्ने बस्तु तथा सेवा खरिद गर्दा रु २०,०००।– भन्दा बढी मूल्यको सामाग्रीमा अनिवार्य रुपमा मूल्य अभिबृद्धि कर दर्ता प्रमाणपत्र प्राप्त गरेका व्यक्ति फर्म संस्था वा कम्पनीबाट खरिद गर्नु पर्नेछ । साथै उक्त विलमा उल्लिखित मु.अ.कर बाहेकको रकममा १.५% अग्रीम आयकर बापत करकट्टि गरी बाँकी रकम मात्र सम्वन्धित सेवा प्रदायकलाई भुक्तानी हुनेछ । रु २०,०००।– भन्दा कम मूल्यको सामाग्री खरिदमा पान नम्वर लिएको व्यक्ति वा फर्मबाट खरिद गर्नु पर्नेछ । अन्यथा खरिद गर्ने पदाधिकारी स्वयम् जिम्मेवार हुनेछ ।</li>
        <br>६). डोजर रोलर लगायतका मेशिनरी सामान भाडामा लिएको एवम् घर बहालमा लिई विल भरपाई पेश भएको अवस्थामा १०% प्रतिशत घर भाडा कर एबम् बहाल कर तिर्नु पर्नेछ ।</li>
        <br>७). प्रशिक्षकले पाउने पारिश्रमिक एवम् सहभागीले पाउने भत्तामा प्रचलित नियमानुसार कर लाग्नेछ ।</li>
        <br>८). भवन ट्रष्ट जस्ता भौतिक संरचना निर्माणको लागि सम्झौता गर्न आउदा भवन ट्रष्टको नक्सा पास गरेको प्रमाण पेश गर्न पर्नेछ ।</li>
        <?php  if(!empty($rules_result)):
        foreach($rules_result as $data):?>
    <li> <?=$data->rule?> </li>
        <?php  endforeach;endif;?>

 </div>
<div style="margin-left:10px;">
     <h4><u>कार्यालयको जिम्मेवारी तथा पालना गरिने शर्तहरुः </u> </h4>
     
        <br>१). श्रममुलक प्रविधिबाट कार्य गराउने गरी लागत अनुमान स्वीकृत गराई सोही बमोजिम सम्झौता गरी मेशिनरी उपकरणको प्रयोगबाट कार्य गरेको पाईएमा त्यस्तो उपभोक्ता समितिसंग सम्झौता रद्ध गरी उपभोक्ता समितिलाई भुक्तानी गरिएको रकम मुल्यांकन गरी बढी भएको रकम सरकारी बाँकी सरह असुल उपर गरिनेछ ।</li>
        <br>२). आयोजना सम्पन्न भएपछि कार्यालयबाट जाँच पास गरी फरफारक गर्नु पर्नेछ ।</li>
        <br>३). यसमा उल्लेख नभएका कुराहरु प्रचलित कानून वमोजिम हुनेछ । </li>
     
 </div>
 
                                              <h4>माथि उल्लेख भए बमोजिमका शर्तहरु पालना गर्न हामी निम्न पक्षहरु मन्जुर गर्दछौं ।</h4>
                                               
                                             <h4>कार्यालयको तर्फबाट </h4>
                                                 <div class="mycontent">
                                                   <table class="table table-bordered table-responsive">
                                                     <tr>
                                                       <td class="myWidth25 myCenter">योजना शाखा</td>
                                                       <td class="myWidth25 myCenter">सम्झौता गर्ने अधिकारि</td>
                                                     </tr>
                                                     <tr>
                                                         <td>दस्तखत:</td>
                                                         <td>दस्तखत:</td>
                                                     </tr>
                                                     <tr>
                                                       <td>
                                                           <select name="worker1" class="form-control worker" id="worker_1" >
                                                          <option value="">छान्नुहोस्</option>
                                                          <?php foreach($workers as $worker){?>
                                                            <option value="<?=$worker->id?>" <?php if($print_history->worker1 == $worker->id){echo 'selected="selected"';}?>><?=$worker->authority_name?></option>
                                                          <?php }?>
                                                        </select>
                                                        <!-- <input type="text" name="post" class="form-control" id="post_1" value="<?=$worker1->post_name?>"> -->
                                                      </form></div>
                                                        </td>
                                                       </td>
                                                      </form>
                                                    </div>
                                                    <td>
                                                    <select name="worker2" class="form-control worker" id="worker_2" >
                                                          <option value="">छान्नुहोस्</option>
                                                          <?php foreach($workers as $worker){?>
                                                            <option value="<?=$worker->id?>" <?php if($print_history->worker1 == $worker->id){echo 'selected="selected"';}?>><?=$worker->authority_name?></option>
                                                          <?php }?>
                                                        </select>

                                                    </td>
                                                     </tr>
                                                     <tr>
                                                         <td>पद:</td>
                                                         <td>पद: <?php echo $more_plan_details->post_id_3;?></td>
                                                     </tr>
                                                     <tr>
                                                          <td>ठेगाना: <?php echo SITE_LOCATION;?>-<?php echo SITE_HEADING;?>  </td>
                                                          <td>ठेगाना: <?php echo SITE_LOCATION;?>-<?php echo SITE_HEADING;?>  </td>
                                                     </tr>
                                                     <tr>
                                                       <td colspan="2" class="text-right">मिति
                                                       <?php echo convertedcit($invest_details->yojanaa_samjhauta_date); ?></td>
                                                     </tr>
                                                   </table>

                                                    <!--<div class="settingsMenu1"><a href="settings_topic_add_sub.php">सह शिर्षक थप्नुहोस +</a></div>-->
                                                  </div>
											
										</div><!-- bank details ends -->
										<div class="myspacer"></div>
										
									</div>
                                <!--<div class="settingsMenu1"><a href="settings_topic_add_sub.php">सह शिर्षक थप्नुहोस +</a></div>-->
                            </div>
                        </div>
                  </div>
                </div><!-- main menu ends -->
            </div>
         </div>   
    </div><!-- top wrap ends -->
    <?php include("menuincludes/footer.php"); ?>