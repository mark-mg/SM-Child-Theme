<?php
global $site_url, $hero_prm;
$curr_site_url = site_url();

$varTest = base64_decode(get_query_var('leadID', 0));
$lead_id = 0;
$filename = "";
//echo get_query_var('leadID', 0);

if ($varTest != "" || isset($_COOKIE['emLeadID'])) {
    if (isset($_COOKIE['emLeadID'])) {
        $filename = trim($_COOKIE['emLeadID']);
    } else {
        $filename = $varTest;
    }

    if ($filename == "") {
        wp_redirect($site_url);
        exit();
    }
}
?>

<section id="loader" class="section align-middle align-center">
    <div class="section-content relative">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p  class='my-100 font-36'>
                        <img src="<?php echo plugin_dir_url(__DIR__) ?>images/oval.svg" width="100" alt="">
                    </p>
                    <form id="signoff_check" name="signoff_check">
                        <input type="hidden" name="leadIDCheck" id="leadIDCheck" value="<?php echo $filename; ?>" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" name="addLeadID" id="addLeadID" value="<?php echo $filename; ?>" />

<section class="section align-middle align-center">
    <div id="sign-off-part" class="section-content relative d-none">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p class='mt-20 mb-30 font-36'>Going Solar Has Never Been So Easy</p>
                    <p class='mb-0 fw-bold mt-20'>Congratulations on choosing to
                        go solar!</p>
                    <p  class='mb-0 mt-20'>Please click on the below to review your order
                        form.</p>
                    <p class='mb-30 mt-20'>Once you have completed reviewing, please click on
                        sign off to complete the order.</p>
                </div>
            </div>
            <div class="col large-4 medium-2 hide-for-small">
                &nbsp;
            </div>
            <div class="col large-2 medium-4 small-6 align-middle text-center">
                <a id="dwnld1" href="javascript:openPDFlink();" class="button lp-btn review-order-btn align-middle">
                    <span>Review Order</span>
                </a>
            </div>
            <div class="col large-2 medium-4 small-6 align-middle text-center">
                <a id="lp2-btn" href="#" class="button lp-btn sign-off-btn align-middle">
                    <span>Sign Off</span>
                </a>
            </div>
            <div class="col large-4 medium-2 hide-for-small">
                &nbsp;
            </div>
        </div>
    </div>

    <div id="congratulations" class="section-content relative d-none">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p class='mt-20 mb-20 font-36'>Congratulations!</p>
                   

                    <p class="text-center mb-20">
                        <img class="svg-class" src="<?php echo plugin_dir_url(__DIR__) ?>images/check-circle-light.svg"
                            alt="Order Confirmed" title="Order Confirmed" />
                    </p>
                    <p class='mb-0 fw-bold mt-20'>Your order has been completed!</p>
                    <p class='mb-0 mt-20'>Your Broker will now review your paper work and
                        will be in contact if any</p>
                    <p>additional information is required.</p>
                    <p class='mb-30 mt-20'>If you have any questions relating to your order
                        feel free to call us on.</p>

                </div>
            </div>
        </div>
    </div>

    <div id="review" class="section-content relative d-none">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p class='my-20 font-36'>You have already Signed-off!</p> 

                    <p class="text-center" class='mb-20'>
                        <img class="svg-class" src="<?php echo plugin_dir_url(__DIR__) ?>images/check-circle-light.svg"
                            alt="Order Confirmed" title="Order Confirmed" />
                    </p>

                    <p class='mb-0 mt-20'>Click on the button below</p>
                    <p>to review / download again.</p>


                </div>
                <div class="row row-collapse">
                    <div class="col medium-12 small-12 large-12">
                        <div class="col-inner align-middle text-center">
                            <a id="dwnld2" href="javascript:openPDFlink();" class="button secondary lp2 lp-btn review-order-btn">
                                <span>Review Order</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="unauthorized" class="section-content relative d-none">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p class='my-20 font-36'>Unauthorized Access</p>

                    <p class="text-center" class='mb-20'>
                        <img class="svg-class" src="<?php echo plugin_dir_url(__DIR__) ?>images/times-circle-light.svg"
                            alt="Unauthorized Access" title="Unauthorized Access" class='unauthorized'/>
                    </p>

                    <p id='api-err-msg'>&nbsp;</p>
                </div>

            </div>
        </div>
    </div>

</section>

<section id='signature-section' class="section align-middle align-center">
    <div class="section-content relative signature-section py-20 myx-0">
        <div class="row row-full-width row-collapse">
            <div class="col medium-1 hide-for-small large-3">&nbsp;</div>
            <div class="col medium-10 small-12 large-6">
                <div class="col-inner align-middle text-center">
                    <form id="signoff_form" name="signoff_form" method="POST" class='mt-30 mb-0'>
                        <p class='font-24b my-20'>Confirm Your
                            Details & Sign Off</p>
                        <p class='mb-0 mt-20'>By entering the details below you are agreeing
                            to the terms and conditions as per the order from.</p>
                        <p class='my-20'>To review these terms and conditions again
                            please click on the ‘Review Order’ button above.</p>
                        <input type="hidden" name="addLeadID" id="addLeadID" value="<?php echo $filename; ?>" />
                        <div class="row">
                            <div class="col medium-2 small-4 large-2 text-center pr-5 pb-20">
                                Full Name:
                            </div>
                            <div class="col medium-10 small-8 large-10 pl-5 pb-20">
                                <input type="text" class="form-control" id="so_fullname" name="so_fullname" placeholder="Full Name"
                                    required="" />
                            </div>
                            <div class="col medium-2 small-4 large-2 text-center pr-5 pb-0">
                                Signature:
                            </div>
                            <div class="col medium-10 small-8 large-10 pl-5 pb-0">
                                &nbsp;
                            </div>
                            <div class="col medium-12 small-12 large-12 text-left">
                                <div id="signature"></div>
                                <canvas id='blank' class='d-none'></canvas>
                            </div> 
                            
                            <div id="acknowledgements" class="col medium-12 small-12 large-12 text-left d-none"> 
                                <table>
                                    <tr>
                                        <td >
                                            <input type="checkbox" name="ack1" id="ack1" class="css-checkbox" value="true" /> 
                                        </td>
                                        <td>
                                            <label class="css-label">
                                                You acknowledge and agree that your
                                                electricity retailer may change your electricity retail contract or
                                                tariff,
                                                as a result
                                                of you having us install the System at the Premises, and that you
                                                should
                                                contact your
                                                electricity retailer to obtain details in relation to this.</label>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td ><input type="checkbox" name="ack2" id="ack2" class="css-checkbox" value="true" />
                                        </td>
                                        <td>
                                            <label class="css-label">You acknowledge and agree that we
                                                have explained the terms of this agreement to you.</label></td>

                                    </tr>
                                    <tr>
                                        <td ><input type="checkbox" name="ack3" id="ack3" class="css-checkbox" value="true" />
                                        </td>
                                        <td>
                                            <label  class="css-label">You acknowledge and agree that we
                                                will provide you with the Maintenance Documents listed in Attachment 2
                                                once
                                                the System
                                                is installed and commissioned.</label></td>

                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="ack4" id="ack4" class="css-checkbox" value="true" />
                                        </td>
                                        <td>
                                            <label   class="css-label">You understand that provision to
                                                you of this Quote constitutes an offer from us to you on the terms of
                                                the
                                                Quote and the
                                                attached Terms and Conditions and that, by signing below, you accept
                                                that
                                                offer and
                                                enter into a legally binding agreement with us on those terms.</label></td> 
                                    </tr>

                                </table>


                            </div> 

                            <div class="col medium-6 small-6 large-6">
                                <button id="clr-btn" type="button" class="button primary lp1 lp-btn">
                                    <span>CLEAR SIGNATURE</span>
                                </button>
                            </div>
                            <div class="col medium-6 small-6 large-6">
                                <button id="sbmt-btn" type="submit" class="button secondary lp1 lp-btn sign-off-btn"
                                    disabled>
                                    <span id='sbmt-btn-txt'>SUBMIT</span>
                                    <span id='sbmt-btn-icon' class="d-none">
                                        <img src="<?php echo plugin_dir_url(__DIR__) ?>images/three-dots.svg" alt=""
                                            style='height: 15px;'>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col medium-1 hide-for-small large-3">&nbsp;</div>
        </div>
    </div>
</section>

<section class="section align-middle align-center pyx-0">
    <div class="section-content relative subscribe-section py-20 myx-0">
        <div class="row row-full-width row-collapse">
            <div class="col medium-12 small-12 large-12">
                <div class="col-inner align-middle text-center">
                    <p class='mb-0 mt-20'>Got a question?</p>
                    <p class='font-24'>
                        <i class="icon-phone icon-sx icon-flip-x"></i>
                        <span> CALL NOW</span>
                        <a href="tel:1300 383 031" id="subscribe-call-now" title="Call Now">1300 383 031 </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    //console.log('#signoff_check submit');

    var pdf_link = "";

    function openPDFlink() {
        var win = window.open(pdf_link, '_blank');
        if (win) {
            //Browser has allowed it to be opened
            win.focus();
        } else {
            //Browser has blocked it
            alert('Please allow popups for this website');
        }
    }

    function checkUserSignOff(form) { 
        
        jQuery.ajax({
            url: jQuery.trim(monster_pack_ajax_script.ajaxurl),
            type: "POST",
            data: jQuery(form).serialize() + '&action=CheckUserSignOff&subs=check&order_form_id=' + jQuery( "#leadIDCheck" ).val(),
            success: function (response) {
                response = JSON.parse(response);  

                jQuery('#loader').addClass('d-none');
                if(response.is_ok){
                    if(response.done == null){ 
                        jQuery('#sign-off-part').removeClass('d-none');
                        jQuery('#so_fullname').val(response.fname); 
						
						if(response.partner == null){ 
							jQuery( "#acknowledgements" ).remove();
						}else{
							if(response.partner.includes("OTI")){
                            	jQuery( "#acknowledgements" ).removeClass('d-none');
                        	}else{
                            	jQuery( "#acknowledgements" ).remove();
                        	} 
						}                    
                    }else{
                        
                        jQuery('#review').removeClass('d-none');
                    }
                    pdf_link = response.link; 
                }else{
                    jQuery('#unauthorized').removeClass('d-none');
                }

            },
            error: function (response) {
                console.log('checkSignOff Error:' + JSON.stringify(response));
                jQuery('#unauthorized').removeClass('d-none');
                jQuery('#loader').addClass('d-none');
            }
        });
        
    }

    jQuery(document).ready(function () { 
        checkUserSignOff();
    });
</script>