<?php
/**
Template Name: Solar Promotion
*/
//NjYxNjMtdG9t ---> Tom
//NjYxNjMtamFjaw== ---> Jack
//MTIzNDUtamFjaw== ---> Jack

global $site_url, $template_url, $navbar;
$site_url = site_url();
$varTest = get_query_var( 'leadID', 0 ); 

$varTest = explode( '-', $varTest );

$lead_id = 0; 
$quote_type = base64_decode($varTest[0]);
$wf_email = $varTest[1];
$img = get_stylesheet_directory_uri()."/images/";
$temp = null; 
$navbar = "false";
$sticky = "false";
$img_src = '';

if(!$quote_type) {
    wp_redirect($site_url);
    exit();
}else{
    $temp = explode("-",strtolower($quote_type));
    $lead_id = $temp[0];
    if (strpos($temp[1], 'tom') !== false){
        $img_src =  "tom";
    }else{
        $img_src =  "jack";
    }
}  

$wf_email  = urlDecode($wf_email).'.png';

get_header(); 

/*
$plugin_public = new Monster_Pack_Public( 'Solar Promo', '1.0.1');
$path_email1 =  $plugin_public->get_service() ."crons/track_clicks.php?lead_id=$lead_id&email_name=$wf_email";
$ch_email1 = curl_init($path_email1);
$result_email1 = curl_exec($ch_email1);    
curl_close($ch_email1);
*/

?>

<style>
   
    .congrats h3{ 
        color: #fdd106;
        font-weight: 700;
        font-size:36px;
    }
    .congrats p{
        font-size: 26px;
        font-weight: 700;
        line-height: 30px;
        color: white;
    }
    .solar-landing-page {
        margin: 0;
        padding: 0;
        width: 100%;
        float: left;
        position: relative;
        z-index: 1;
        font-size: 16px;
        background: #f3f3f3;
        line-height: 20px;
    }
    
    .solar-top-bar,
    .solar-center-section {
        margin: 0;
        padding: 0 15px;
        float: left;
        width: 100%;
        position: relative;
        text-align: center;
    }
    
    .solar-center-section {
        padding-bottom: 20px
    }
    
    .solar-top-bar:after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        background: #e5e6e7;
        height: 43px;
        -moz-box-shadow: inset 0 -6px 16px rgba(0,0,0,0.2);
       -webkit-box-shadow:inset 0 -6px 16px rgba(0,0,0,0.2);
         box-shadow: inset 0 -6px 16px rgba(0,0,0,0.2);
    }
    
    .footer-2,
    #header {
        display: none;
    }
    
    .solar-top-bar-heading {
        margin: 0;
        padding: 0;
        background: url('<?php echo get_stylesheet_directory_uri();?>/images/shape-c.png') 0 0 / contain no-repeat;
        max-width: 522px;
        width: 100%;
        color: #ffffff;
        margin: 18px auto 0 auto;
        position: relative;
        z-index: 9
    }
    
    .solar-top-bar-heading h1 {
        font-weight: 100;
        color: #ffffff;
        font-size: 30px;
        margin: 0;
    }
    
    .solar-top-bar-heading h1> span {
        display: block;
        font-weight: 600;
        font-style: italic;
        font-size: 34px;
    }
    
    .solar-top-bar-heading span span {
        color: #fdd106;
        font-size: 40px;
    }
    
    .solar-top-bar a {
        color: #41c6ef;
        font-style: italic;
        margin: 10px 0;
        display: inline-block;
    }
    
    .solar-landing-container {
        max-width: 730px;
        width: 100%;
        margin: 0 auto;
    }
    
    .solar-center-heading {
        font-weight: 100;
        font-size: 28px;
        padding: 10px 15px;
        border-top: 1px solid #000000;
        border-bottom: 1px solid #000000;
        margin: 0;
    }
    
    .solar-center-content {
        margin: 0;
        padding: 22px 0;
        text-align: left;
    }
    
    .solar-center-content h3 {
        color: #000000;
        margin: 0;
    }
    
    .solar-center-content h3.font-20 {
        font-size: 20px;
        color: #e80000;
        font-style: italic;
    }
    
    .solar-center-content h3.font-24 {
        font-size: 24px;
        font-weight: 100;
    }
    
    .solar-center-content h3.font-28 {
        font-size: 28px;
        color: #004d66
    }
    
    .m-20 {
        margin: 16px 0;
    }
    
    .feature-list {
        margin: 0;
        padding-left: 20px;
    }
    
    .feature-list li {
        margin: 0 0 5px 0;
    }
    
    .mb-5 {
        margin-bottom: 5px;
        ;
    }
    
    .color-blue {
        color: #004d66
    }
    
    .solar-img {
        margin: 15px 0 0 0
    }
    
    .border-left {
        border-left: 1px solid #000000;
    }
    
    .align-items-center {
        align-items: center;
    }
     
    .col {
        padding-top: 0;
        padding-bottom: 0;
    }
    
    .black-border {
        border-color: #000000;
        opacity: 1;
        margin-top: 0;
    }
    
    .code-section {
        margin: 0;
        padding: 40px 0;
        width: 100%;
        background: #ffffff;
        text-align: center;
        float: left;
    }
    
    .code-section h3 {
        font-size: 18px;
        margin: 0 0 20px 0;
    }
    
    .code {
        margin: 0
    }
    
    .code span {
        display: inline-block;
        width: 168px;
        height: 35px;
        background: #fdd106;
        text-align: center;
        margin-left: 10px;
        line-height: 35px;
    }
    
    .form-section {
        background: ;
        float: left;
        width: 100%;
        margin: 0;
        padding: 20px 0 0 0;
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#36879b+0,153970+100 */
        background: #36879b;
        /* Old browsers */
        background: -moz-linear-gradient(left, #36879b 0%, #153970 100%);
        /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #36879b 0%, #153970 100%);
        /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #36879b 0%, #153970 100%);
        /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#36879b', endColorstr='#153970', GradientType=1);
        /* IE6-9 */
    }
    
    .form-section img {
        max-width: initial;
        position: relative;
        left: 40px;
    }
    
    .form-heading {
        font-size: 26px;
        color: #fdd106;
        font-weight: 100;
    }
    
    input.form-control {
        border: none;
        border-radius: 10px;
        margin: 5px 0;
    }
    
    .pr-6 {
        padding-right: 6px;
    }
    
    .pl-6 {
        padding-left: 6px;
    }
    
    .grediant-button {
        font-weight: 100;
        text-transform: capitalize;
        color: #ffffff;
        background: #f0b62e;
        /* Old browsers */
        background: -moz-linear-gradient(left, #f0b62e 0%, #ea1c24 100%);
        /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #f0b62e 0%, #ea1c24 100%);
        /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #f0b62e 0%, #ea1c24 100%);
        /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#f0b62e', endColorstr='#ea1c24', GradientType=1);
        /* IE6-9 */
        width: 240px;
        height: 37px;
        border-radius: 50px;
        border: none;
        box-shadow: none;
        min-height: auto;
        margin: 10px 0 0 0;
        padding: 0;
    }
    
    .form-tagline {
        font-size: 11px;
        color: #ffffff;
        margin-top: 5px;
    }
    
    form {
        margin-bottom: 0
    }
    
    .call-now {
        font-size: 31px;
        font-weight: 600;
        color: #ffffff;
        display: inline-block;
        margin: 14px 0;
    }
    
    .call-now i {
        font-size: 26px;
    }
    
    .trust-pliot {
        margin: 0;
        padding: 40px 0;
        background: #c8e4f2;
        float: left;
        width: 100%;
    }
    
    .trust-pliot img {
        margin-bottom: 10px;
    }
    
    .trust-pliot h2 {
        color: #f38020;
        font-size: 72px;
        font-weight: 700;
        margin-bottom: 0
    }
    
    .trust-pliot h2 span {
        text-transform: uppercase;
        letter-spacing: 11px;
        font-size: 22px;
        color: #000000;
        padding-left: 9px;
    }

    .trust-pliot span {
        text-transform: uppercase;
        letter-spacing: 11px;
        font-size: 22px;
        color: #000000;
        padding-left: 9px;
    }
    
    .trust-pliot-review {
        margin: 0;
        padding: 0 15px 35px 15px;
        float: left;
        width: 100%;
        text-align: center;
        font-weight: 100;
        line-height: 24px;
        font-style: italic;
        position: relative;
    }
    
    .trust-pliot-review h3 {
        font-size: 22px;
    }
    
    .trust-pliot-review p {
        margin-bottom: 10px;
    }
    
    .new-star-rating {
        margin: 0;
        padding: 0;
        list-style-type: none;
        position: absolute;
        bottom: 0;
        right: 0;
        left: 0;
        width: 100%;
    }
    
    .new-star-rating li {
        margin: 0;
        padding: 0;
        display: inline-block;
        width: 20px;
        height: 20px;
        background: url('<?php echo get_stylesheet_directory_uri();?>/images/star-c.png') 0 0 / contain no-repeat;
    }
    
    .solar-landing-footer {
        margin: 0;
        padding: 20px 0;
        background: #231f20;
        float: left;
        width: 100%;
        color: #ffffff;
        font-size: 12px;
    }
    
    .absolute-footer {
        float: left;
        width: 100%;
        font-size: 10px;
        background: #231f20;
    }
    
    .absolute-footer .copyright-footer {
        color: #9a9c9f !important;
    }
    
    input.form-control.error {
        border: 1px solid red !important;
        color: black !important;
    }
    .header {
        background: linear-gradient(90deg, rgba(60, 137, 180, 1) 0, rgba(54, 135, 155, 1) 50%, rgba(21, 57, 112, 1) 100%)!important;
        height: 80px;
        margin: 0;
        padding: 0;
        float: left;
        width: 100%;
    }
    
    .logo {
        margin: 16px 0;
        padding: 0;
        float: left;
    }
    
    .header .call-now {
        float: right;
    }
    
    @media(min-width:500px) {}
    
    @media(max-width:767px) {
        .logo img {
            width: 100px;
        }
        .call-now i {
            font-size: 17px;
        }
        .call-now {
            font-size: 18px;
            margin: 15px 0
        }
        .header {
            height: 60px;
        }
        .solar-top-bar-heading h1 {
            font-size: 20px;
        }
        .solar-top-bar-heading h1> span {
            font-size: 20px;
        }
        .solar-top-bar-heading span span {
            font-size: 20px;
        }
        .solar-top-bar-heading {
            margin-top: 27px;
        }
        .border-left {
                border-left: 0;
    border-top: 1px solid #000000 !important;
    margin-top: 20px;
    padding-top: 20px !important;
        }
        
        .solar-center-content .col {
            padding: 0
        }
        
        .form-section img {
            max-width: 100%;
            left: 0;
        }
        .trust-pliot-review {
            margin: 20px 0
        }
    }
</style>


<div class="header">
    <div class="container">
        <div class="logo">
            <a href="<?php echo $site_url; ?>"><img src="http://solarmonster1.wpengine.com/wp-content/uploads/2018/08/Asset-1-compressor.png" /></a>
        </div>
        <a href="tel:1300 383 031" class="call-now"><i class="icon-phone"></i> 1300 383 031</a>
    </div>
</div>

<div class="solar-landing-page">
    <div class="solar-top-bar">
        <div class="solar-top-bar-heading">
            <h1>LIMITED TIME <span>REDEEM <span>$1000</span> OFF*</span></h1>            
        </div>
        <a href="#termsC">Terms & Conditions</a>
    </div>


    <?php if(strpos($wf_email, "Perc") !== false) { ?> 
        <div id='PERC'  class="solar-center-section">
            <div class="solar-landing-container">
                <h2 class="solar-center-heading">LONGi PERC Panel</h2>

                <div class="solar-center-content">
                    <div class="row d-flex align-items-center">
                        <div class="col medium-6 small-12 large-6 text-center ">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/images/LONGi PERC.png" 
                            alt="" title="" style="height:300px;"/>
                        </div>
                        <div class="col medium-6 small-12 large-6 border-left">
                            <h3 class="font-24">LR6-60PB</h3>
                            <h3 class="font-28">285~305M</h3>
                            <h3 class="font-20">$1000 Off Discount*</h3>

                            <p class="m-20">
                                <strong>Hi-MO1 High Efficiency Low LID Mono PERC Technology (60C/All Black Module)</strong> 
                                <br /> Aesthetic appearance with black frame and backsheet, best suited for rooftop installation
                            </p>

                            <p class="mb-5 color-blue"><strong>Feature</strong>
                            </p>
                            <ul class="feature-list">
                                <li>7 Year Savings Guarantee</li>
                                <li>10 Year Workmanship Warranty</li>
                                <li>10 Year On-site Service agreement</li>
                                <li>10 Year Manufacturer Warranties</li>
                                <li>25 Year Performance Guarantee</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="black-border" />
                <p class="mb-5 color-blue text-left"><strong>Key benefits</strong>
                </p>
                <ul class="feature-list text-left">
                    <li>World’s No.1 Mono-crystalline Module Manufacture</li>
                    <li>Rated Best Preforming Module in the world by German quality auditor TUV Rheinland</li>
                    <li>Broken World Record for Solar Cell Efficiency 3 times over in last 12 months</li>
                </ul>
            </div>
        </div> 
    <?php } else { ?>
        <div id='Mono' class="solar-center-section">
            <div class="solar-landing-container">
                <h2 class="solar-center-heading">LONGi Mono Panel</h2>

                <div class="solar-center-content">
                    <div class="row d-flex align-items-center">
                        <div class="col medium-6 small-12 large-6 text-center ">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/images/solar-c.png" alt="" title="" />
                        </div>
                        <div class="col medium-6 small-12 large-6 border-left">
                            <h3 class="font-24">LR6-60</h3>
                            <h3 class="font-28">280~300M</h3>
                            <h3 class="font-20">$1000 Off Discount*</h3>

                            <p class="m-20"><strong>High Efficiency Mono Technology </strong> <br /> with advanced 5BB
                                design to improve power output</p>

                            <p class="mb-5 color-blue"><strong>Feature</strong>
                            </p>
                            <ul class="feature-list">
                                <li>5 Year Workmanship Warranty</li>
                                <li>5 Year On-site Service agreement</li>
                                <li>5-10 Year Manufacturer Warranties </li>
                                <li>25 Year Performance Guarantee</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="black-border" />
                <p class="mb-5 color-blue text-left"><strong>Key benefits</strong>
                </p>
                <ul class="feature-list text-left">
                    <li>World’s No.1 Mono-crystalline Module Manufacture</li>
                    <li>Rated Best Preforming Module in the world by German quality auditor TUV Rheinland</li>
                    <li>Broken World Record for Solar Cell Efficiency 3 times over in last 12 months</li>
                </ul>
            </div>
        </div> 
    <?php } ?>   

    <div class="code-section">
        <div class="solar-landing-container">
            <h3>Well Done! <br /> Redemption Code Claimed </h3>
            <p class="code">USE CODE <span>OFF1-1000</span></p>
        </div>
    </div>

    <div class="form-section">
        <div class="solar-landing-container">
            <div class="row d-flex align-items-center promo-form">
                <div class="col medium-6 small-12 large-6 text-center">
                    <h4 class="form-heading">Confirm Your Details</h4>
                    <form method="POST" id="solar_lead_promo" name="solar_lead_promo">
                        <div class="row">
                            <div class="col medium-12 small-12 large-12">
                                <input type="text" class="form-control" id="promo_firstname" name="promo_firstname" placeholder="First name" required="" />
                            </div>  

                            <div class="col medium-6 small-6 large-6">
                                <input type="text" class="form-control" id="promo_contact" name="promo_contact" placeholder="Contact Number" required="" />
                            </div>
                            <div class="col medium-6 small-6 large-6">
                                <input type="text" class="form-control" id="promo_postcode" name="promo_postcode" placeholder="Post Code" required="" />
                            </div>

                            <div class="col medium-12 small-12 large-12">
                                <input type="text" class="form-control" id="promo_email" name="promo_email" placeholder="Email Address" required="" />
                            </div>

                            <div class="col medium-12 small-12 large-12">
                                <input type="text" class="form-control" id="promo_code" name="promo_code" placeholder="OFF1-1000" required="" />
                            </div>

                            <div class="col medium-12 small-12 large-12 d-none" id="solar_lead_promo_error2" name="solar_lead_promo_error2">
                                <br>
                                <span class="error">
                                    Please provide the required information.
                                </span>
                            </div>
                        </div>  
                        
                        <input type="hidden" name="promo_leadID" id="promo_leadID" value="<?php echo $lead_id; ?>" />
                        <input type="hidden" name="promo_wf_email" id="promo_wf_email" value="<?php echo $wf_email; ?>" />
                        <input type="hidden" name="promo_local" id="promo_local" value="" />
                        <button type="submit" class="grediant-button cnfm_btn">Let’s Talk </button>
                        <p class="form-tagline">In clicking submit you are agreeing to the terms</p> 
                        <a href="tel:1300 383 031" class="call-now"><i class="icon-phone"></i> 1300 383 031</a>
                    </form>
                </div>
                <div class="col medium-6 small-12 large-6">
                    <img src="<?php echo $img . $img_src . "-c.png"; ?>" alt="" />
                </div>
            </div>
            <div class="row d-flex align-items-center congrats d-none">
                <div class="col medium-6 small-12 large-6 text-center">
                    <h3>Congratulations!</h3>
                    <p>You’ve redeemed your $1000 discount</p> 
                    <a href="tel:1300 383 031" class="call-now"><i class="icon-phone"></i> 1300 383 031</a>
                </div>
                <div class="col medium-6 small-12 large-6">
                    <img src="<?php echo $img . $img_src . "2-c.png"; ?>" alt="" />
                </div>
            </div>
        </div>
    </div>

    <div class="trust-pliot">
        <div class="container">
            <div class="row">
                <div class="col medium-4 small-12 large-4 text-center">
                    <a href="https://au.trustpilot.com/review/electricitymonster.com.au" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/images/trust-pliot-c.png" alt="" />
                    </a>
                    <h2>30,000</h2>
                    <span>Customers</span>
                </div>  

                <?php if (strpos($img_src, 'tom') !== false) { ?>
                <div class="col medium-4 small-12 large-4 text-center">
                    <div class="trust-pliot-review">
                        <h3>Dorothy Parsey</h3>
                        <p>Very impressed with Tom Hall. He explained everything so that it was easy to follow. Love
                            the fact that I don't have to shop around for 2 years, it is so annoying when you're a
                            pensioner to have to do it every year to save a few dollars.</p>

                        <ul class="new-star-rating">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>

                <div class="col medium-4 small-12 large-4 text-center">
                    <div class="trust-pliot-review">
                        <h3>Susan Sole</h3>
                        <p>This review has brought my power bill down by $130 a quarter and given me advice on how to
                            get a better performance for my solar panels as well. Thank You Tom for your help.</p>

                        <ul class="new-star-rating">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <?php } else { ?>
                <div class="col medium-4 small-12 large-4 text-center">
                    <div class="trust-pliot-review">
                        <h3>Charlie Charles</h3>
                        <p>Usually can't be bothered doing reviews but the service was great. Straight to the point,
                            friendly, helpful and without any misunderstandings. :) cheers Jack</p>

                        <ul class="new-star-rating">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>

                <div class="col medium-4 small-12 large-4 text-center">
                    <div class="trust-pliot-review">
                        <h3>Elsa D</h3>
                        <p>Excellent Service from Jack Cockburn. Very efficient, clearly spoken, with all questions
                            answered. An authentic customer service person.</p>

                        <ul class="new-star-rating">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <?php } ?> 
            </div>
        </div>
    </div>

    <div class="solar-landing-footer">
        <div class="container">
            <p id='termsC' class="mb-5 text-left">Terms and Conditions:</p>

            <div class="row">
                <div class="col medium-8 small-12 large-8 text-center">
                    <ul class="feature-list text-left">
                        <li>This exclusive discount is only available to selected customers.</li>
                        <li>Redemption code expires 30 days once it has been redeemed.</li>
                        <li>This redemption code will provide you with a $1,000 discount off selected brands supplied
                            by Solar Monster.</li>
                    </ul>
                </div>
                <div class="col medium-4 small-12 large-4 text-center">
                    <ul class="feature-list text-left">
                        <li>This discount is inclusive of GST.</li>
                        <li>Not to be used with any other offers or discounts.</li>
                        <li>Not redeemable for cash.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<?php get_footer(); ?>

<script>
    jQuery(document).ready(function () {
        if (jQuery("#promo_leadID").val() != 0) {
            jQuery.ajax({
                url: jQuery.trim(monster_pack_ajax_script.ajaxurl),
                type: "POST",
                data: '&action=RecordClicks&subs=check&order_form_id=' + jQuery("#promo_leadID").val() + 
                '&promo_wf_email=' +  jQuery("#promo_wf_email").val(),
                success: function (response) {
                     console.log('RecordClicks :'+JSON . stringify(response)); 
                },
                error: function (response) {
                    console.log('RecordClicks Error:' + JSON.stringify(response));
                }
            })

            jQuery.ajax({
                url: jQuery.trim(monster_pack_ajax_script.ajaxurl),
                type: "POST",
                data: '&action=CheckLeadInfo&subs=check&order_form_id=' + jQuery("#promo_leadID").val() + 
                '&promo_wf_email=' +  jQuery("#promo_wf_email").val(),
                success: function (response) {
                    response = JSON.parse(response);

                    jQuery('#promo_firstname').val(response.name);
                    jQuery('#promo_contact').val(response.contact);
                    jQuery('#promo_postcode').val(response.postcode);
                    jQuery('#promo_email').val(response.email);
                    jQuery('#promo_code').val("OFF1-1000");
                    jQuery('#promo_local').val(response.local_id);

                },
                error: function (response) {
                    console.log('CheckLeadInfo Error:' + JSON.stringify(response));
                }
            })
        }
    });
</script>