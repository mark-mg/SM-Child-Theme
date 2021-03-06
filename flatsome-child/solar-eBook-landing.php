<?php
/**
Template Name: Solar eBook Landing
*/
 
global $site_url, $template_url, $navbar;
$site_url = site_url();  

$varTest = get_query_var( 'leadID', 0 ); 
if(is_numeric($varTest)) {
    $varTest = ""; 
} 

$varTest = urlDecode($varTest);
$varTest = str_replace(array("+", "-"), " ", $varTest);  

$show_blurb = '';   
$varTest2 = strtolower($varTest);

if (strpos($varTest2, 'agl') !== false) {
    $show_blurb = 'agl';  
    $title = "Looking to Compare <br> $varTest Quote?"; 
}else if (strpos($varTest2, 'origin') !== false) {
    $show_blurb = 'origin';  
    $title = "Looking to Compare <br> $varTest Quote?"; 
}else if (strpos($varTest2, 'energy') !== false) {
    $show_blurb = 'ea';  
    $title = "Looking to Compare <br> $varTest Quote?"; 
}else if($varTest2 == ""){
    $title = 'Start Your Solar Journey!'; 
}else{
    $title = $varTest; 
}
 
$device_type = get_user_device();
get_header();

?>

<style>
    .img-cn{
        overflow:hidden;
    } 
    .img-cn img{ 
        position: absolute;
        left: -30px;
        top: -20px;
        /* height: 160%;
        width: 160%; */
    }
    .cn {
        display: table-cell;
        width: 500px;
        height: 300px;
        vertical-align: middle;
        text-align: center;
    }

    .cn-inner {
        display: inline-block;
        width: 200px; height: 150px;
    }

    .cn-tag-title{
        font-size: 22px;
        line-height: 50px;
        height: 50px;
        text-align: center;
        color: white;
        font-weight: 700;
    } 
    .tag-title{
        font-size: 25px;
        line-height: 50px;
        height: 50px;
        text-align: center;
        text-transform: uppercase;
        font-weight: 500;
    } 
    .txt-up-case{
        text-transform: uppercase;
    }
    .txt-low-case{
        text-transform: lowercase;
    }
    .color-w{
        color:white !important;
    }
    .btn-select-box{
        border: none;
        border-radius: 10px;
        margin: 5px 0;
        
    }
    .tnc{
        font-size:10px;
		line-height:12px;
		letter-spacing:0.02em;
		text-align:center;
		color:rgb(255,255,255)
    }
    .tnc a{
        text-decoration-line: underline;
        text-decoration-style: solid;
        color:rgb(255,255,255)
    }
    .mt-15{
        margin-top:15px;
    }
    .mt-20{
        margin-top:20px;
    }
    .mt-50{
        margin-top:50px;
    }
    .font-16{
        font-size: 16px !important;
    }   
    .font-28{
        font-size: 28px !important;
    }   
    .headings h2{
        font-weight: 700;
        font-size: 38px;
        line-height: 46px;
        text-align: center;
        color: rgb(255,255,255);
    }
    .light-gray-bg{
        background: #F0F6F9 !important;
        padding-top: 0px !important; 
    }
    .headings h3{
        font-weight: 700;
        font-size: 28px;
        line-height: 46px;
        text-align: center;
        color: rgb(255,255,255);
        margin: 25px auto; 
    }
    .headings img{
        width: 350px;
    }
    #ebook-form,#ebook-form2{
        max-width: 450px; 
    }
    .bg-animate{        
        background: linear-gradient(310deg, #65ace6, #4dce94);
        background-size: 400% 400%;

        -webkit-animation: AnimationName 22s ease infinite;
        -moz-animation: AnimationName 22s ease infinite;
        animation: AnimationName 22s ease infinite;
    }

    @-webkit-keyframes AnimationName {
        0%{background-position:0% 50%}
        50%{background-position:100% 51%}
        100%{background-position:0% 50%}
    }
    @-moz-keyframes AnimationName {
        0%{background-position:0% 50%}
        50%{background-position:100% 51%}
        100%{background-position:0% 50%}
    }
    @keyframes AnimationName {
        0%{background-position:0% 50%}
        50%{background-position:100% 51%}
        100%{background-position:0% 50%}
    }
    .pr-4{
        padding-right: 4px;
    }
    .pl-4{
        padding-left:4px;
    }

    .easy-steps {
        margin-top: 20px;
        padding: 15px !important;
    }

    .img-cta{
        width: 180px;
        height: 250px;
        margin-bottom: 20px;
    }

    .mt-30 {
        margin-top: 30px !important;
    }
    .lh-25,
    .who-we-are p {
        line-height: 25px;
    }

    .congrats h3 {

        color: #fdd106;
        font-weight: 700;
        font-size: 36px;
    }

    .congrats p {
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
        background: #F0F6F9;
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
        -moz-box-shadow: inset 0 -6px 16px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: inset 0 -6px 16px rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 -6px 16px rgba(0, 0, 0, 0.2);
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

    .solar-top-bar-heading h1>span {
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
    }

    .mb-30 {
        margin-bottom: 30px !important;
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
    .code-section2 {
        margin: 0;
        padding:  0;
        width: 100%; 
        text-align: center;
        float: left;
    }
    /*
    .code-section h3 {
        font-size: 18px;
        margin: 0 0 20px 0;
    }
    */
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
        filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#36879b', endColorstr='#153970', GradientType=1);
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
        background: -moz-linear-gradient(left, #ea1c24 0%, #f0b62e 100%);
        /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #ea1c24 0%, #f0b62e 100%);
        /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #ea1c24 0%, #f0b62e 100%);
        /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#ea1c24', endColorstr='#f0b62e', GradientType=1);
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
    .pt-0{
        padding-top:0px;
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
    .ml-50{
        margin-left:50px !important;
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
        background: linear-gradient(90deg, rgba(60, 137, 180, 1) 0, rgba(54, 135, 155, 1) 50%, rgba(21, 57, 112, 1) 100%) !important;
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

    @media(min-width:500px) {
        
    }

    @media(max-width:500px) { 
        .blue-gradient-bg{
            background: linear-gradient(135deg, #19aae1 11%, #3c4bb3 100%);
            background-image: linear-gradient(135deg, rgb(25, 170, 225) 11%, rgb(60, 75, 179) 100%);
            padding:20px 5px;
        }
        .headings h3{
            font-weight: 700;
            font-size: 28px;
            line-height: 46px;
            text-align: center;
            color: rgb(255,255,255);
            margin: 15px auto 0px; 
        }

        .headings button{
            font-size: 18px;
            margin: 30px auto;
        }    
        .headings p{
            margin-bottom: 30px;
            font-size: 20px;
            margin-top: 10px;
            color: #d4de5c;
            font-style: italic;
        }
        .headings img{
            margin-top: 30px;
            width: 250px;
        }
        .who-we-are p{
            padding: 10px 35px;
        }
        .who-we-are h3{
            margin: 10px;
        }
        #ebook-form, #ebook-form2{
            max-width: 350px;
            margin-left: auto; 
            margin-right: auto;
        }
        .green-gradient-bg{ 
            padding:20px 5px;
            background: linear-gradient(270deg, #69f8d8, #defc36);
            background-size: 400% 400%;
            -webkit-animation: AnimationName 10s ease infinite;
            -moz-animation: AnimationName 10s ease infinite;
            -o-animation: AnimationName 10s ease infinite;
            animation: AnimationName 10s ease infinite; 
        }
    }

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

        .solar-top-bar-heading h1>span {
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
            <a href="<?php echo $site_url; ?>">
                <img src="http://solarmonster1.wpengine.com/wp-content/uploads/2018/08/Asset-1-compressor.png" />
            </a>
        </div>
        <a href="tel:1300 383 031" class="call-now"><i class="icon-phone"></i> 1300 383 031</a>
    </div>
</div>


<div class="solar-landing-page">
    <div class="row headings show-for-small mbl_head">
        <div class="col large-12 medium-12 small-12 text-center blue-gradient-bg">
            <h3>
                <?php echo $title ?>
            </h3>
            <p>FREE SOLAR eBOOK</p>
        </div>
        <div class="col large-12 medium-12 small-12 text-center green-gradient-bg">
            <img class="ml-50" src="<?php echo get_stylesheet_directory_uri();?>/images/eBook-compressor.png" alt="" />
            <button type="submit" class="grediant-button mbl_tag_btn">Free Download</button>
        </div>
    </div>


    <div id="anchor1" class='bg-animate hide-for-small'>
        <div class="row">
            <div class="col large-12 medium-12 hide-for-small text-center headings">
                <h2 class="mt-30 mb-30">
                    <?php echo $title ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col large-12 medium-12 small-12 text-center headings">
                <img class="ml-50" src="<?php echo get_stylesheet_directory_uri();?>/images/eBook-compressor.png" alt="" />
            </div>

            <div class="col large-4 medium-3">&nbsp;</div> 
            <div class="col large-4 medium-6 small-12 text-center">
                <form class="row mb-30" method="POST" id="ebook-form">
                    <div class="form-group large-12 medium-12 small-12 headings">
                        <h3>FREE SOLAR eBOOK</h3>
                    </div>
                    <div class="form-group large-12 medium-12 small-12">
                        <input type="text" name="ebook_firstname" id="ebook_firstname" placeholder="First Name"
                            class="form-control round-border-input required">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group large-6 medium-6 small-6 pr-4">
                        <input type="tel" name="ebook_contact" id="ebook_contact" placeholder="Contact Number"
                            class="form-control round-border-input required validnumber">
                    </div>
                    <div class="form-group large-6 medium-6 small-6 pl-4">
                        <input type="tel" name="ebook_postcode" id="ebook_postcode" placeholder="Postcode"
                            minlength="3" maxlength="4" class="form-control round-border-input required" />
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group large-12 medium-12 small-12">
                        <input type="email" name="ebook_email" id="ebook_email" placeholder="Email" class="form-control round-border-input required">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col medium-12 small-12 large-12 d-none" id="ebook-form-error" name="ebook-form-error">
                        <span class="error">
                            Please provide the required information.
                        </span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="large-12 mt-15">
                        <button class="grediant-button cnfm_btn font-21" id="fbform-btn2" type="submit">Free Download</button>
                        <input type="hidden" name="ebook_action" id="action" value="Save Step 1" />
                        <input type="hidden" name="ebook_page_type" id="page_type" value="<?php echo 'residential'; ?>" />
                        <input type="hidden" name="ebook_source" id="source" value="<?php echo $source; ?>" />
                        <input type="hidden" name="ebook_adset_id" id="adset_id" value="" />
                        <input type="hidden" name="ebook_solar_form" id="solar_form" value="yes" />
                    </div>
                    <div class="clearfix"></div>
                    <div class="large-12 mt-15">
                        <p class="tnc">By clicking submit you are agreeing to our
                            <a href='<?php echo $site_url; ?>/terms-and-conditions/' target='_blank' style="color:white;">
                                terms & conditions</a>
                        </p>
                    </div>
                </form>

                <form class="row d-none" method="POST" id="ebook-form2">
                    <div class="form-group large-12 medium-12 small-12 headings">
                        <h3>Complete to Download <br>Your eBook</h3>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="ebook_step_address" id="ebook_step_address" placeholder="Full Address (Need to look at your roof space)"
                            class="form-control round-border-input required" />
                        <input type="hidden" name="ebook_step_street_name" id="ebook_step_street_name" />
                        <input type="hidden" name="ebook_step_suburb" id="ebook_step_suburb" />
                        <input type="hidden" name="ebook_step_state" id="ebook_step_state" />
                        <input type="hidden" name="ebook_step_country" id="ebook_step_country" />
                        <input type="hidden" name="ebook_step_postcode" id="ebook_step_postcode" value="" />
                        <div id="map-canvas" name="map-canvas"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <select class="btn-select-box required" id="ebook_step_quarter_bill" name="ebook_step_quarter_bill">
                            <option value="">How Much is Your Quaterly Electricity Bill?</option>
                            <option value="< $200">
                                < $200</option> <option value="$200 - $349">$200 - $349
                            </option>
                            <option value="$350 - $599">$350 - $599</option>
                            <option value="$600 - $799">$600 - $799</option>
                            <option value="$800 - $999">$800 - $999</option>
                            <option value="> $1000">> $1000</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <select class="btn-select-box  required" id="ebook_step_retailer" name="ebook_step_retailer">
                            <option value="">Electricity Provider</option>
                            <option value="Energy Australia">Energy Australia</option>
                            <option value="Origin Energy">Origin Energy</option>
                            <option value="AGL Energy">AGL Energy</option>
                            <option value="Simply Energy">Simply Energy</option>
                            <option value="Alinta Energy">Alinta Energy</option>
                            <option value="Red Energy">Red Energy</option>
                            <option value="Lumo Energy">Lumo Energy</option>
                            <option value="">--------------------------</option>
                            <option value="Click Energy">Click Energy</option>
                            <option value="Power Direct">Power Direct</option>
                            <option value="Ergon Energy">Ergon Energy</option>
                            <option value="Sumo Power">Sumo Power</option>
                            <option value="Powershop">Powershop</option>
                            <option value="Dodo Power & Gas">Dodo Power & Gas</option>
                            <option value="Momentum Energy">Momentum Energy</option>
                            <option value="ActewAGL">ActewAGL</option>
                            <option value="Other">Other</option>
                            <option value="Not Sure">Not Sure</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col medium-12 small-12 large-12 d-none" id="ebook-form2-error" name="ebook-form2-error">
                        <span class="error">
                            Please provide the required information.
                        </span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 mt-15">
                        <button class="grediant-button cnfm_btn font-21" type="submit" id="bill_btn">Download</button>
                        <p class="text-center mt-20 mb-30">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/images/trust-poliot-big-black.png"
                                alt="" width="80" />
                        </p>
                    </div>
                </form>

                <div class="clearfix"></div>
                <div id="ebook-form3" class='headings d-none'> 
                    <h3 class="font-50 mt-30 mb-30 pos-rel">Thank you!</h3>
                    <p class="color-w font-16 lh-25">Your download should begin shortly. If it does not, please use the
                        <a target="_blank" download href="<?php echo get_stylesheet_directory_uri();?>/docs/eBook.pdf" style="color: #f5ba31" class="dwnld_link">direct
                            link</a> otherwise check the email address you provided.</p>
                </div>
            </div>
            <div class="col large-4 medium-3">&nbsp;</div> 
        </div>
    </div>


    <div class="code-section white-bg">
        <div class="solar-landing-container who-we-are text-center">
            <h3 class='tag-title'>WHO WE ARE</h3>
            <p>Solar Monster is a free broker that compares solar systems. In the past, <br>
                we’ve helped over 30,000 Australian find great rates on their power <br>
                through Electricity Monster, and now we’re here to help you go solar!</p>
        </div>
    </div>

    <div class="solar-center-section">
        <div class="solar-landing-container2">
            <div class="row mt-30 mb-30">
                <div class="col large-12 medium-12 small-12 text-center">
                    <br>
                    <h3 class='tag-title'>HOW WE CAN HELP</h3>
                    <br>
                </div>
                <div class="col large-6 medium-6 small-12 text-left lh-25">
                    <p>Solar Monster works as a broker between you and several solar installers. We figure out what you
                        need, then present you with a range of solutions from quality installers in your area. We work
                        with the solar installer directly to design the right system for you, at a fair price. Solar
                        Monster will help you make an educated decision on your solar power system, so you get a solar
                        system that satisfies your electricity needs.</p>
                </div>
                <div class="col large-6 medium-6 small-12 text-left lh-25">
                    <p>The difference with us is we explain everything to you in simple English to give you the peace
                        of mind you need when going solar. Solar Monster also can help pair you up with an electricity
                        retailer that fits your solar configuration, making sure you get a great feed-in rate and sharp
                        electricity rates if you need to buy from the grid.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="code-section <?php if($show_blurb=='') echo 'light-gray-bg'; ?>">
        <div class="container">
            <div class="row">
                <div class="col large-12 medium-12 small-12 text-center mb-30">
                    <h3 class='tag-title'>4 EASY STEPS TO GET YOUR SOLAR INSTALLED</h3>
                </div>
            </div>
            <div class="row">
                <div class="col large-3 medium-3 small-6 text-center  who-we-are">
                    <p>STEP 01</p>
                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/1.png" alt="" />
                    <p class="easy-steps">We listen to what you are looking for in your solar system</p>

                </div>
                <div class="col large-3 medium-3 small-6 text-center  who-we-are">
                    <p>STEP 02</p>
                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/2.png" alt="" />
                    <p class="easy-steps">We help you design your solar system and locate installers that can deliver</p>

                </div>
                <div class="col large-3 medium-3 small-6 text-center  who-we-are">
                    <p>STEP 03</p>
                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/3.png" alt="" />
                    <p class="easy-steps">We send you your system design and walk you through the facts and figures</p>

                </div>
                <div class="col large-3 medium-3 small-6 text-center  who-we-are">
                    <p>STEP 04</p>
                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/4.png" alt="" />
                    <p class="easy-steps">We organise the paperwork and connect you with the recommended installer</p>
                </div>
            </div>
        </div>
    </div>

    <?php if($show_blurb=='agl') { ?>
    <div class="code-section light-gray-bg">
        <div class="container">
            <div class="row">
                <div class="col large-12 medium-12 small-12 text-center  mt-50">
                    <h3 class='tag-title'>AGL SOLAR</h3>
                </div>
            </div>
            <div class="row">
                <div class="col large-6 medium-6 small-12 text-left lh-25">
                    <p>More and more Australians are getting into renewable energy, and AGL solar programmes are
                        becoming increasingly popular every day. In 2017, Australia added 1.3 gigawatts of total solar
                        power into the network, and some analysts are predicting that number to triple in 2018! Finding
                        a way to get in on the renewables craze can be a struggle, but with AGL you can get all your
                        renewable needs satisfied in one place. Whether you need panels, a battery, and inverter or any
                        other solar needs they might be a great option for you.</p>
                    <p>Installing some solar panels can really help you save on your energy bills. The way this works
                        is your solar panels will generate electricity during the day, which is then fed into your
                        inverter, and into your home. If you end up feeding more electricity back into the grid than
                        you use, you’ll get an energy credit on your power bill. This credit will reduce the size of
                        your power bill, leaving you with more money at the end of the week. Not to mention the money
                        you could save on your power bill could help cover the cost of the system. It might just pay
                        for itself!</p>
                    <p>Having some high-quality solar panels installed isn’t just a great way to save on power.
                        Installing AGL solar panels can also help you save the environment.</p>
                </div>
                <div class="col large-6 medium-6 small-12 text-left lh-25">
                    <p>The great majority of energy consumed in Australia comes from fossil fuels. This means, coal and
                        oil. The carbon cost of these products is massive. On the other hand, AGL solar panels are
                        renewable energy, so you really have nothing to worry about.</p>
                    <p>In a country where the regular consumer has been subjected to outrageous prices for such a long
                        time, isn’t it about time you took charge of your energy needs? Installing solar makes absolute
                        sense. Whether you live in NSW, Queensland, Victoria or South Australia it’s definitely
                        something you should be thinking about. Especially if you’re environmentally conscious or just
                        looking to save a few bucks.</p>
                    <p>If you’re interested in learning more about solar, give us a call here at Electricity Monster!
                        Our number is 1300 584 872, and our brokers would love to talk with you. Not only can we help
                        you with a new connection, or help you compare rates, we can also sort you out with a quote on
                        solar systems.</p>
                </div>
            </div>
        </div>
    </div>
    <?php } else if($show_blurb=='origin') { ?>
    <div class="code-section light-gray-bg">
        <div class="container">
            <div class="row">
                <div class="col large-12 medium-12 small-12 text-center mt-50">
                    <h3 class='tag-title'>Origin Solar</h3>
                </div>
            </div>
            <div class="row">
                <div class="col large-6 medium-6 small-12 text-left lh-25">
                    <p>More and more Australians are getting into renewable energy, and Origin solar programmes are
                        becoming increasingly popular every day. In 2017, Australia added 1.3 gigawatts of total solar
                        power into the network, and some analysts are predicting that number to triple in 2018! Finding
                        a way to get in on the renewables craze can be a struggle, but with Origin you can get all your
                        renewable needs satisfied in one place. Whether you need panels, a battery, and inverter or any
                        other solar needs they might be a great option for you.</p>
                    <p>Installing some solar panels can really help you save on your energy bills. The way this works
                        is your solar panels will generate electricity during the day, which is then fed into your
                        inverter, and into your home. If you end up feeding more electricity back into the grid than
                        you use, you’ll get an energy credit on your power bill. This credit will reduce the size of
                        your power bill, leaving you with more money at the end of the week. Not to mention the money
                        you could save on your power bill could help cover the cost of the system. It might just pay
                        for itself!</p>
                    <p>Having some high-quality solar panels installed isn’t just a great way to save on power.
                        Installing Origin solar panels can also help you save the environment.</p>
                </div>
                <div class="col large-6 medium-6 small-12 text-left lh-25">
                    <p>The great majority of energy consumed in Australia comes from fossil fuels. This means, coal and
                        oil. The carbon cost of these products is massive. On the other hand, Origin solar panels are
                        renewable energy, so you really have nothing to worry about.</p>
                    <p>In a country where the regular consumer has been subjected to outrageous prices for such a long
                        time, isn’t it about time you took charge of your energy needs? Installing solar makes absolute
                        sense. Whether you live in NSW, Queensland, Victoria or South Australia it’s definitely
                        something you should be thinking about. Especially if you’re environmentally conscious or just
                        looking to save a few bucks.</p>
                    <p>If you’re interested in learning more about solar, give us a call here at Electricity Monster!
                        Our number is 1300 584 872, and our brokers would love to talk with you. Not only can we help
                        you with a new connection, or help you compare rates, we can also sort you out with a quote on
                        solar systems.</p>
                </div>
            </div>
        </div>
    </div>
    <?php } else if($show_blurb=='ea') { ?>
    <div class="code-section light-gray-bg">
        <div class="container">
            <div class="row">
                <div class="col large-12 medium-12 small-12 text-center mt-50">
                    <h3 class='tag-title'>Energy Australia Solar</h3>
                </div>
            </div>
            <div class="row">
                <div class="col large-6 medium-6 small-12 text-left lh-25">
                    <p>More and more Australians are getting into renewable energy, and Energy Australia solar
                        programmes are becoming increasingly popular every day. In 2017, Australia added 1.3 gigawatts
                        of total solar power into the network, and some analysts are predicting that number to triple
                        in 2018! Finding a way to get in on the renewables craze can be a struggle, but with Energy
                        Australia you can get all your renewable needs satisfied in one place. Whether you need panels,
                        a battery, and inverter or any other solar needs they solar might be a great option for you.</p>
                    <p>Installing some solar panels can really help you save on your energy bills. The way this works
                        is your solar panels will generate electricity during the day, which is then fed into your
                        inverter, and into your home. If you end up feeding more electricity back into the grid than
                        you use, you’ll get an energy credit on your power bill. This credit will reduce the size of
                        your power bill, leaving you with more money at the end of the week. Not to mention the money
                        you could save on your power bill could help cover the cost of the system. It might just pay
                        for itself!</p>
                </div>
                <div class="col large-6 medium-6 small-12 text-left lh-25">
                    <p>Having some high-quality solar panels installed isn’t just a great way to save on power.
                        Installing Energy Australia solar panels can also help you save the environment. The great
                        majority of energy consumed in Australia comes from fossil fuels. This means, coal and oil. The
                        carbon cost of these products is massive. On the other hand, Energy Australia solar panels are
                        renewable energy, so you really have nothing to worry about.</p>
                    <p>In a country where the regular consumer has been subjected to outrageous prices for such a long
                        time, isn’t it about time you took charge of your energy needs? Installing solar makes absolute
                        sense. Whether you live in NSW, Queensland, Victoria or South Australia it’s definitely
                        something you should be thinking about. Especially if you’re environmentally conscious or just
                        looking to save a few bucks.</p>
                    <p>If you’re interested in learning more about solar, give us a call here at Electricity Monster!
                        Our number is 1300 584 872, and our brokers would love to talk with you. Not only can we help
                        you with a new connection, or help you compare rates, we can also sort you out with a quote on
                        solar systems.</p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

     <div class="code-section2 bg-animate">
        <div class="container mt-15 show-for-small ">
            <p class="headings">
                <img class="ml-50" src="<?php echo get_stylesheet_directory_uri();?>/images/eBook-compressor.png" alt="" />
            </p>
            <p class="mb-5"><i class="code">FREE Solar eBook</i></p>
            <p><a  href="javascript:void(0);" class="button grediant-button mbl_tag_btn" role="button">Download Now</a></p>            
        </div>
        <div class="container mt-15 hide-for-small">
            <div class="row">
                <div class="col large-6 medium-6"> 
                    <div class="cn">
                        <div class="cn-inner">
                            <p class="mb-5"><i class="code cn-tag-title">FREE Solar eBook</i></p> 
                            <p><a  href="#anchor1" class="button grediant-button" role="button">Download Now</a></p>
                        </div>
                    </div>
                </div> 
                <div class="col large-6 medium-6 img-cn"> 
                    <img src="<?php echo get_stylesheet_directory_uri();?>/images/eBook-compressor.png" alt="" />
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

                <div class="col medium-4 small-12 large-4 text-center">
                    <div class="trust-pliot-review">
                        <h3>Dorothy Parsey</h3>
                        <p>"Very impressed with Tom Hall. He explained everything so that it was easy to follow. Love
                            the fact that I don't have to shop around for 2 years, it is so annoying when you're a
                            pensioner to have to do it every year to save a few dollars."</p>

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
                        <h3>Charlie Charles</h3>
                        <p>"Usually can't be bothered doing reviews but the service was great. Straight to the point,
                            friendly, helpful and without any misunderstandings. :) cheers Jack"</p>

                        <ul class="new-star-rating">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<input type="hidden" name="page_title" id="page_title" value="<?php echo  $title; ?>" />
<input type="hidden" name="param_val" id="param_val" value="<?php echo  $varTest; ?>" />

<?php get_footer(); ?>

<script type="text/javascript">
    var title = document.getElementById("page_title").value;
    document.title = title.replace("<br>", "");
</script>