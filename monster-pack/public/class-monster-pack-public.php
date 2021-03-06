<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/mark-mg
 * @since      1.0.0
 *
 * @package    Monster_Pack
 * @subpackage Monster_Pack/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Monster_Pack
 * @subpackage Monster_Pack/public
 * @author     Mark Anthony Adriano <mark.anthony@monstergroup.com.au>
 */


class Monster_Pack_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.2
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name; 

    /**
     * The version of this plugin.
     *
     * @since    1.0.2
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.2
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */

    private $api_url; 
    private $pdf_url; 
    private $auth; 
    private $headers; 
    public $service_url;  
    

    public function __construct($plugin_name, $version)
    {
         
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        
        $auth = base64_encode('ImMonster40K@:h6onIgQRg16dOC5R');
        $this->headers = array(
                "Authorization: Basic  $auth",
                'Content-Type: application/json',
                "accept:application/json",
            ); 
        
        
        if($_SERVER["HTTP_HOST"] == 'localhost'){

           $this->service_url = 'http://localhost/electricitymonster/';  
           $this->api_url = "http://localhost/electricitymonster/services/webservices.php";    
           $this->pdf_url = "http://localhost/electricitymonster/documents/order_forms/";   

        }else{
            if(count($_POST) && isset($_POST['source'])) {
                mail('anvesh@monstergroup.com.au, augusto@monstergroup.com.au, mark.anthony@monstergroup.com.au', 'Data Posted to SM', print_r($_POST, true));
            }    
           
            $this->service_url = 'https://mga.electricitymonster.com.au/'; //----> PRD

            //$this->api_url = "https://staging.electricitymonster.com.au/services/webservices.php"; //----> STG
            $this->api_url = "https://mga.electricitymonster.com.au/services/webservices.php";   //----> PRD

            //$this->pdf_url = "https://staging.electricitymonster.com.au/documents/order_forms/"; //----> STG
            $this->pdf_url = "https://mga.electricitymonster.com.au/documents/order_forms/";   //----> PRD
        }   
         

        add_shortcode('cta_form',       array($this, 'cta_form'));
        add_shortcode('hero_form',      array($this, 'hero_form'));
        add_shortcode('hero_file',      array($this, 'hero_file'));
        add_shortcode('trust_pilot',    array($this, 'trust_pilot'));
        add_shortcode('product_form',   array($this, 'product_form'));
        add_shortcode('contact_form',   array($this, 'contact_form'));
        add_shortcode('subscribe_form', array($this, 'subscribe_form'));
        add_shortcode('download_form',  array($this, 'download_form'));
        add_shortcode('order_signoff',  array($this, 'order_signoff'));  
        add_shortcode('site_map',       array($this, 'site_map'));

        add_action('wp_print_scripts', array($this, 'monster_pack_ajax_load_request'));

        add_action("wp_ajax_SubscribeForm", array($this, "SubscribeForm"));
        add_action("wp_ajax_nopriv_SubscribeForm", array($this, "SubscribeForm"));

        add_action("wp_ajax_SaveAppointment", array($this, "SaveAppointment"));
        add_action("wp_ajax_nopriv_SaveAppointment", array($this, "SaveAppointment"));

        add_action("wp_ajax_SaveUserDetails", array($this, "SaveUserDetails"));
        add_action("wp_ajax_nopriv_SaveUserDetails", array($this, "SaveUserDetails"));

        add_action("wp_ajax_SaveStep2", array($this, "SaveStep2"));
        add_action("wp_ajax_nopriv_SaveStep2", array($this, "SaveStep2"));

        add_action("wp_ajax_SaveNote", array($this, "SaveNote"));
        add_action("wp_ajax_nopriv_SaveNote", array($this, "SaveNote"));

        add_action("wp_ajax_SaveContactDetails", array($this, "SaveContactDetails"));
        add_action("wp_ajax_nopriv_SaveContactDetails", array($this, "SaveContactDetails"));

        add_action("wp_ajax_CheckUserSignOff", array($this, "CheckUserSignOff"));
        add_action("wp_ajax_nopriv_CheckUserSignOff", array($this, "CheckUserSignOff"));  

        add_action("wp_ajax_CheckLeadInfo", array($this, "CheckLeadInfo"));
        add_action("wp_ajax_nopriv_CheckLeadInfo", array($this, "CheckLeadInfo"));  
        
        add_action("wp_ajax_RecordClicks", array($this, "RecordClicks"));
        add_action("wp_ajax_nopriv_RecordClicks", array($this, "RecordClicks")); 

        add_action("wp_ajax_SMQuoteStep", array($this, "SMQuoteStep"));
        add_action("wp_ajax_nopriv_SMQuoteStep", array($this, "SMQuoteStep")); 

        add_action("wp_ajax_SMQuoteStep2", array($this,"SMQuoteStep2"));
        add_action("wp_ajax_nopriv_SMQuoteStep2", array($this,"SMQuoteStep2"));
    }

    public function get_service() {
        return $this->service_url;
    }

    public function wpd_catalogueitem_rewrites()
	{
        add_rewrite_rule('order-signoff/([a-zA-Z0-9-=]+)', 'index.php?pagename=order-signoff&leadID=$matches[1]', 'top');
        add_rewrite_rule('solar-promo/([a-zA-Z0-9-=%]+)', 'index.php?pagename=solar-promo&leadID=$matches[1]', 'top');
        add_rewrite_rule('solar-ad-landing/([a-zA-Z0-9-=%+.]+)', 'index.php?pagename=solar-ad-landing&leadID=$matches[1]', 'top');
        add_rewrite_rule('solar-ebook-landing/([a-zA-Z0-9-=%+.]+)', 'index.php?pagename=solar-ebook-landing&leadID=$matches[1]', 'top');
	}
	

	public function flush_rules()
	{
		flush_rewrite_rules();
	} 

	public function wpd_query_vars($query_vars)
	{
		$query_vars[] = 'leadID'; 
		return $query_vars;
	}

    public function monster_pack_ajax_load_request()
    {
        wp_localize_script($this->plugin_name, 'monster_pack_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));        
    }

    public function load_resources()
    {
        /*
        wp_register_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/monster-pack-public.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name);

        wp_register_style('DatePicker', plugin_dir_url(__FILE__) . 'css/datepicker.min.css', array(), $this->version, 'all');
        wp_enqueue_style('DatePicker');

        wp_register_script('DatePicker', plugin_dir_url(__FILE__) . 'js/datepicker.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script('DatePicker');

        wp_register_script('jQueryValidate', plugin_dir_url(__FILE__) . 'js/jquery.validate.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script('jQueryValidate');
 
        wp_register_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/monster-pack-public.js', array('jquery'), $this->version, true);
        wp_enqueue_script($this->plugin_name);  
        */
        
        wp_register_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/mp-plugin-styles.min.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name);

        wp_register_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/mp-plugin-scripts.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script($this->plugin_name); 
       

        if(is_page('order-signoff')){
            wp_register_script('jSignature', plugin_dir_url(__FILE__) . 'js/jSignature.min.noconflict.js', array('jquery'), $this->version, true);
            wp_enqueue_script('jSignature');

            wp_register_script('flashcanvas', plugin_dir_url(__FILE__) . 'js/flashcanvas.js', array('jquery'), $this->version, true);
            wp_enqueue_script('flashcanvas');
        }
    }

    public function get_metabox_meta()
    {

        $css_field_content = get_post_meta(get_the_ID(), '_monster_pack_content', true);

        // Check if set
        if (!empty($css_field_content)) {
            echo '<!-- Monster Pack --><style type="text/css">' . $css_field_content . '</style><!-- End Monster Pack -->';
        }

    }

    public function cta_form($atts, $content = null)
    {
        //[cta_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'cta_form'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-cta.php';
        return ob_get_clean();
    }

    public function site_map($atts, $content = null)
    {
        //[hero_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'site_map'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-sitemap.php';
        return ob_get_clean();
    }

    public function hero_form($atts, $content = null)
    {
        global $hero_prm;
        //[hero_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(  
                'step1_title'     =>  '',
                'step1_subtitle'  =>  '',
                'step1_button'    =>  '',
                'step2_title'     =>  '',
                'step2_subtitle'  =>  '',
                'step2_button'    =>  '',
            ),
            $atts,
            'hero_form'
        );

        $hero_prm = $atts;
        //return HTML
        ob_start();
        include 'partials/monster-pack-hero-form.php';
        return ob_get_clean();
    }

    public function base30_to_jpeg($base30_string, $output_file) {

        $data = str_replace('image/jsignature;base30,', '', $base30_string);
        $converter = new jSignature_Tools_Base30();
        $raw = $converter->Base64ToNative($data);
        //Calculate dimensions
        $width = 0;
        $height = 0;
        foreach($raw as $line)
        {
            if (max($line['x'])>$width)$width=max($line['x']);
            if (max($line['y'])>$height)$height=max($line['y']);
        }
        
        // Create an image
            $im = imagecreatetruecolor($width+20,$height+20);
        
        
        // Save transparency for PNG
            imagesavealpha($im, true);
        // Fill background with transparency
            $trans_colour = imagecolorallocatealpha($im, 255, 255, 255, 127);
            imagefill($im, 0, 0, $trans_colour);
        // Set pen thickness
            imagesetthickness($im, 2);
        // Set pen color to black
            $black = imagecolorallocate($im, 0, 0, 0);   
        // Loop through array pairs from each signature word
            for ($i = 0; $i < count($raw); $i++)
            {
                // Loop through each pair in a word
                for ($j = 0; $j < count($raw[$i]['x']); $j++)
                {
                    // Make sure we are not on the last coordinate in the array
                    if ( ! isset($raw[$i]['x'][$j])) 
                        break;
                    if ( ! isset($raw[$i]['x'][$j+1])) 
                    // Draw the dot for the coordinate
                        imagesetpixel ( $im, $raw[$i]['x'][$j], $raw[$i]['y'][$j], $black); 
                    else
                    // Draw the line for the coordinate pair
                    imageline($im, $raw[$i]['x'][$j], $raw[$i]['y'][$j], $raw[$i]['x'][$j+1], $raw[$i]['y'][$j+1], $black);
                }
            } 
        
        //Create Image
        $ifp = fopen($output_file, "wb"); 
        imagepng($im, $output_file);
        fclose($ifp);  
        imagedestroy($im);
    
        return $output_file; 
    }

    public function hero_file($atts, $content = null)
    { 
        //[hero_file]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'hero_file'
        );

        $hero_prm = $atts;
        //return HTML
        ob_start();
        include 'partials/monster-pack-hero-file.php';
        return ob_get_clean();
    }

    public function product_form($atts, $content = null)
    {
        global $prd_prm;
        //[product_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(  
                'step1_title'     =>  '',
                'step1_subtitle'  =>  '',
                'step1_button'    =>  '',
                'step2_title'     =>  '',
                'step2_subtitle'  =>  '',
                'step2_button'    =>  '',
            ),
            $atts,
            'product_form'
        );
        $prd_prm = $atts;
        //return HTML
        ob_start();
        include 'partials/monster-pack-product.php';
        return ob_get_clean();
    }

    public function trust_pilot($atts, $content = null)
    {
        //[download_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'trust_pilot'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-trust-pilot.php';
        return ob_get_clean();
    }
    public function download_form($atts, $content = null)
    {
        //[download_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'download_form'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-download.php';
        return ob_get_clean();
    }
    public function subscribe_form($atts, $content = null)
    {
        //[subscribe_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'subscribe_form'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-subscribe.php';
        return ob_get_clean();
    }
    public function order_signoff($atts, $content = null)
    {
        //[order_signoff]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'order_signoff'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-sign-off.php';
        return ob_get_clean();
    }

    public function contact_form($atts, $content = null)
    {
        //[contact_form]
        //get the attribute_escape
        $atts = shortcode_atts(
            array(),
            $atts,
            'contact_form'
        );
        //return HTML
        ob_start();
        include 'partials/monster-pack-contact.php';
        return ob_get_clean();
    }

    public function a_column($atts, $content = null)
    {
        //usage: [a_column class="filipstefansson" style="simple"]Follow me on Twitter![/a_column]
        extract(shortcode_atts(array(
            'class' => 'class',
            'style' => 'style',
        ), $atts));
        return '<div class="col-md-12' . esc_attr($style) . '" ' . esc_attr($style) . '">' . $content . '</div>';
    }

    public function SubscribeForm()
    {
        global $wpdb;
        $subscribe_email = $_POST['subscribe_email'];
        $table_name = $wpdb->prefix . 'email_signups';

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL  AUTO_INCREMENT,
				email_address text NOT NULL,
				date_added datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  	UNIQUE KEY (id)
			) $charset_collate;";
            $wpdb->query($sql);
        }

        $subscribe_email_check = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE email_address = '" . $subscribe_email . "'");
        if ($wpdb->num_rows > 0) {
            echo 'Email id already exists';
        } else {
            $wpdb->insert($table_name, array(
                'email_address' => $subscribe_email,
                'date_added' => date('Y-m-d H:i:s'),
            ));
            echo 'You are successfully subscribed to our mailing list!';
        }

        die();
    }

    public function SaveAppointment()
    {

        global $wpdb;
        $everything_is_ok = true;
        $table_name = $wpdb->prefix . 'appt_data';

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL  AUTO_INCREMENT,
				appt_date date NOT NULL,
				appt_time text NOT NULL,
				appt_range text NOT NULL,
				form_data text NOT NULL,
				date_added datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  	UNIQUE KEY (id)
			) $charset_collate;";
            $wpdb->query($sql);
        }

        $quote_data = array(
            'appt_date' => $_POST['booking_date'],
            'appt_time' => $_POST['booking_time'],
            'appt_range' => $_POST['booking_time_range'],
            'form_data' => json_encode($_POST),
            'date_added' => date("Y-m-d H:i:s"),
        );

        $wpdb->insert($table_name, $quote_data);
        $appt_id = $wpdb->insert_id;

        $time = "";
        $appt_time = "";
        if ($_POST['booking_time'] == "morning") {
            $time = "Mornings - 8am to 12pm";
            $appt_time = "morning";
        } else if ($_POST['booking_time'] == "afternoon") {
            $time = "Afternoon - 12pm to 5pm";
            $appt_time = "afn";
        } else {
            $time = "Evenings - 5pm to 8.30pm";
            $appt_time = "evening";
        }

        $shifting_date = '';
        if ($_POST['booking_date'] != '') {
            $shifting_date = str_replace('/', '-', $_POST['booking_date']);
            $shifting_date = date('Y-m-d', strtotime($shifting_date));
        }

        $data = null;
        $res_data = null;
        $error_msg = '';
         
        if ($appt_id == 0) { 
            $everything_is_ok = false;
            if ($wpdb->last_error !=  ''):
                $error_msg = $wpdb->print_error();
            endif;
        }
        
        $return_msg = array(
            'appt_date' => $_POST['booking_date'],
            'appt_time' => ucfirst($_POST['booking_time']) . ' - ' . $_POST['booking_time_range'],
            'appt_id' => $appt_id,
            'appt_data' => $data,
            'appt_res' => $res_data,
        ); 

        if($everything_is_ok){
            header('Content-Type: application/json');
            echo json_encode(array("return_msg" => $return_msg, "data" => $data)); 
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) == ""){
                echo json_encode('Error 500: Internal Server. Please try again.');  
            } else {                
                echo json_encode('Error 400: Bad Request - ['.$error_msg.']. Please try again.'); 
            }  

            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) != ""){
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.'); 
            } else if(trim($curl_error_msg) != ""){                
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else { 
                echo json_encode('Error 409: Conflict.['.json_encode($response).']. Please try again.'); 
            }                      
        }


        die(0);
    }

    public function SaveUserDetails()
    {
        global $wpdb;
        $everything_is_ok = true;
        $error_msg = '';
        $curl_error_msg = '';
        $test = 0;

        $table_name = $wpdb->prefix . 'lead_data';
        $q1 = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");
        if ($q1 != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL  AUTO_INCREMENT,
                power varchar(100) DEFAULT NULL,
				fname text NOT NULL,
				lname text NOT NULL,
				email_id text NOT NULL,
				mobile_phn text NOT NULL,
                full_address text DEFAULT NULL,
                street_name text DEFAULT NULL,
                suburb text DEFAULT NULL,
				postcode text DEFAULT NULL,
                state_name text DEFAULT NULL,
                source text DEFAULT NULL,
                service_req text NOT NULL,
                quarter_bill text DEFAULT NULL,
                step2_sync tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
                section_src  text NOT NULL,
                page_src  text NOT NULL,
                advertising text DEFAULT NULL, 
                wf_email text DEFAULT NULL, 
                lead_source text DEFAULT NULL, 
                refresh_source text DEFAULT NULL, 
                promo_code text DEFAULT NULL, 
				booking_id int(11) DEFAULT NULL,
                em_ref_id int(11) DEFAULT NULL,
                power_company  text DEFAULT NULL,
                shifting_date datetime DEFAULT NULL,
                note text DEFAULT NULL,
				date_added datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  	UNIQUE KEY (id)
            ) $charset_collate;";  

            $q2 = $wpdb->query($sql);
        }

        $prepend = "";
        if (isset($_POST['prepend']) && $_POST['prepend'] != "") {
            $prepend = trim($_POST['prepend']);
        }

        $codezones = "";
        if (isset($_POST['codezones']) && $_POST['codezones'] != "") {
            $codezones = trim($_POST['codezones']);
        } 

        $refresh_source = "";
        if (isset($_POST['refresh_source']) && $_POST['refresh_source'] != "") {
            $refresh_source = trim($_POST['refresh_source']);
        } 

        $service_req = "";
        if (isset($_POST['service_req'])) {
            $service_req = $_POST['service_req'];
        } 
        
        $promo = "";
        if (isset($_POST[$prepend . '_code'])) {
            $promo = ucwords(strtolower($_POST[$prepend . '_code']));
        }

        $sm_lead = "";
        if (isset($_POST[$prepend . '_local'])) {
            $sm_lead = $_POST[$prepend . '_local'];
        } 

        $em_lead = "";
        if (isset($_POST[$prepend . '_leadID'])) {
            $em_lead = $_POST[$prepend . '_leadID'];
        }

        $fname = ucwords(strtolower($_POST[$prepend . '_firstname']));
        $lname = "";
        if (isset($_POST[$prepend . '_lastname'])) {
            $lname = ucwords(strtolower($_POST[$prepend . '_lastname']));
        } 

        $phone_num = "";
        if (isset($_POST[$prepend . '_contact'])) {
            $phone_num = $_POST[$prepend . '_contact'];
            $to_remove_array = array('$', '-', '_', '(', ')', ',', ' ');
            $phone_num = str_replace($to_remove_array, '', $phone_num);
        }

        $email_id = trim($_POST[$prepend . '_email']);

        $power = "";
        if ( isset($_POST['power']) ) {
            $power = trim($_POST['power']);
        }
        

        $postcode = $_POST[$prepend . '_postcode'];
        $postcode_details = $wpdb->get_row('SELECT * FROM sm_postcodes WHERE postcode = ' . $postcode, ARRAY_A);
        $state_name = ($postcode_details) ? $postcode_details['state'] : "";

         //$href_url = "";
        //if (isset($_POST['href_url']))  $href_url = $_POST['href_url'];   
        $source = (isset($_POST[$prepend . '_source']) ? $_POST[$prepend . '_source'] : '');

        $page_src = "";
        if (isset($_POST['page_src'])) {
            $page_src = $page_src . $_POST['page_src'];
        } else {
            $page_src = $page_src . 'homepage';
        }
        $href_url = $page_src . $source;   
        $page_src = "SM-" . $page_src;
        
        $wf_email = "";
        if (isset($_POST[$prepend . '_wf_email']))  $wf_email   =   $_POST[$prepend . '_wf_email'];  

        $booking_id = "";
        if (isset($_POST['book_appt_id']))  $booking_id     =   $_POST['book_appt_id']; 

        $booking_date = "";
        if (isset($_POST['booking_date']))  $booking_date   =   $_POST['booking_date']; 

        $booking_time = "";  
        if (isset($_POST['booking_time']))  $booking_time   =   $_POST['booking_time'];  
        
        $quarter_bill = "";
        if (isset($_POST[$prepend . '_quarter_bill']))  $quarter_bill = strtolower($_POST[$prepend . '_quarter_bill']);  

        $advertising = "";
        if (isset($_COOKIE['campaign'])) {
            $advertising = $_COOKIE['campaign'];
        }
        $advertising = ($advertising == "organic" ? "Organic" : ($advertising == 'direct' ? 'DIRECT' : $advertising));

        if($sm_lead == ""){
            $cnfm_details = array(
                'service_req'   =>  $service_req,
                'power'         =>  $power,
                'fname'         =>  $fname,
                'lname'         =>  $lname,
                'email_id'      =>  $email_id,
                'source'        =>  $source,
                'lead_source'   =>  $source,
                'mobile_phn'    =>  $phone_num,
                'date_added'    =>  date('Y-m-d H:i:s'), 
                'postcode'      =>  $postcode,
                'advertising'   =>  $advertising,
                'state_name'    =>  ($state_name ? $state_name : ""),
                'section_src'   =>  $prepend,
                'quarter_bill'   => $quarter_bill,
                'page_src'      =>  $page_src,
                'booking_id'    =>  $booking_id,
                'wf_email'      =>  $wf_email, 
            );
    
            $wpdb->insert($table_name, $cnfm_details);
            $test = $wpdb->insert_id; 
            $lastq = $wpdb->last_query; 
        
            if ($wpdb->last_error !== ''):
                $error_msg = $wpdb->print_error();
            endif;

        }else{
            $cnfm_details = array( 
                'power'         =>  $power,
                'fname'         =>  $fname, 
                'email_id'      =>  $email_id, 
                'mobile_phn'    =>  $phone_num, 
                'postcode'      =>  $postcode, 
                'section_src'   =>  $prepend, 
                'refresh_source'=>  $refresh_source,
                'source'        =>  $source,
                'promo_code'    =>  $promo,  
                'wf_email'      =>  $wf_email, 
            ); 
            
            $result = $wpdb->update($table_name, $cnfm_details, array("id" => $sm_lead));

            $test = $sm_lead;
            $cuso_step = null;
            $cuso_step = $wpdb->get_row( "SELECT * FROM $table_name WHERE em_ref_id = $sm_lead" ); 
            if($cuso_step){                 
                $service_req    =   $cuso_step->service_req; 
                $lname          =   $cuso_step->lname;
                $page_src       =   $cuso_step->page_src;
                $source         =   $cuso_step->source;
                $advertising    =   $cuso_step->advertising;
                $quarter_bill   =   $cuso_step->quarter_bill;  
            }
        } 

        $api_msg = '';
        $response = '';
        $em_lead_id = '';
        $data = null;
        $response_em_id = null;

        if ($test != 0) {    
            $postdata = array(
                'action'            =>      'save_em_lead',  
                'lead_from'         =>      'solarmonster',
                'sm_lead_no'        =>      $test,              //--> SM DB ID
                'power'             =>      $power,
                'fname'             =>      $fname,
                'lname'             =>      $lname, 
                'email_id'          =>      $email_id,
                'phone_num'         =>      $phone_num,
                'postcode'          =>      $postcode,

                'getpostcodezones'  =>      $codezones,
                'refresh_source'  =>        $refresh_source,
                'redeem_code'       =>      $promo,
                'wf_email_name'     =>      $wf_email, 
               
                'lead_source'       =>      $prepend,    
                'page_type'         =>      $page_src,
                'source'            =>      $href_url, 

                'service_req'       =>      $service_req, 
                'advertising'       =>      $advertising,  
                'appt_date'         =>      $booking_date,
                'appt_time'         =>      $booking_time, 
                'estimate_bill'     =>      strtolower($quarter_bill),
                'power'             =>      $power
            );  

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER,  $this->headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

            $data = curl_exec($ch);
            if (!curl_errno($ch)) {  
                $response_em_id = json_decode($data);
                $em_lead_id = $response_em_id->lead_id;
                $wpdb->update($table_name, array("em_ref_id" => $response_em_id->lead_id), array("id" => $test));
                $api_msg = json_encode(array("saved" => 1, "seeking_for" => $service_req, "data" => $data, "em_lead_response" => $response_em_id->lead_id, "this_em_id" => $test, 'state_name' => $state_name, 'all' => $response_em_id, 'd'=> $this->api_url));
            } else {
                $everything_is_ok = false;
                $curl_error_msg = curl_error($ch);
            }
            curl_close($ch);
        } else {
            $everything_is_ok = false;
            $response = array(
                'code' => 401,
                'message' => "Some Error Occurred. Please try again.",
            );
        }  
        $everything_is_ok = true;
        if($everything_is_ok){
            header('Content-Type: application/json');

            // set the expiration date to 1 day
            setcookie("smLeadID", $test, time()+86400);
            setcookie("emLeadID", $em_lead_id, time()+86400);
            setcookie("smSection", $page_src, time()+86400);
            setcookie("smSectionStep", $prepend, time()+86400);

            $return_msg = array(
                'error'         =>  $error_msg,
                'lastq'         =>  $lastq,
                'source'        =>  $_POST['page_src'] . "-->" . $prepend,
                'lead_id'       =>  $test,
                'api_msg'       =>  $api_msg,
                'em_lead_id'    =>  $em_lead_id,
                'booking_id'    =>  $_POST['book_appt_id'],
                'response'      =>  $response,    
                'saved'         =>  1,
                'data'          =>  $data, 
                'step'          =>  'yes',  
                 
                //'headers'   =>  $this->headers,
                //'url'       =>  $this->api_url,
            );

            if(isset($response_em_id->bill_size_html))
                $return_msg['bill_size_html'] = $response_em_id->bill_size_html;
            if(isset($response_em_id->distrib_html))
                $return_msg['distrib_html'] = $response_em_id->distrib_html;
            if(isset($response_em_id->bill_size_htmls))
                $return_msg['bill_size_htmls'] = $response_em_id->bill_size_htmls;

            echo json_encode( $return_msg );
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) != ""){
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.'); 
            } else if(trim($curl_error_msg) != ""){                
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else { 
                echo json_encode('Error 409: Conflict.['.json_encode($response).']. Please try again.'); 
            }            
        }
        die(0);

    }
    

    public function SaveStep2()
    {
        global $wpdb;
        $everything_is_ok = true;
        $error_msg = '';
        $curl_error_msg = '';

        $table_name = $wpdb->prefix . 'lead_data'; 
        $prepend = "";
        if (isset($_POST['prepend']) && $_POST['prepend'] != "") {
            $prepend = trim($_POST['prepend']);
        }

        $user_id = "";
        if (isset($_COOKIE['smLeadID'])) {
            $user_id = $_COOKIE['smLeadID'];
        } else {
            $user_id = $_POST[$prepend . '_step_user_id'];
        }

        $lead_id = "";
        if (isset($_COOKIE['emLeadID'])) {
            $lead_id = $_COOKIE['emLeadID'];
        } else {
            $lead_id = $_POST[$prepend . '_step_lead_id'];
        }  

        $power_company = $_POST[$prepend . '_step_retailer'];

        $shifting_date = '';
        if ($_POST[$prepend . '_step_shifting_date'] != '') {
            $shifting_date = str_replace('/', '-', $_POST[$prepend . '_step_shifting_date']);
            $shifting_date = date('Y-m-d', strtotime($shifting_date));
        }

        $lead_data = array(
            'full_address'  => $_POST[$prepend . '_step_address'],
            'street_name'   => $_POST[$prepend . '_step_street_name'],
            'suburb'        => $_POST[$prepend . '_step_suburb'],
            'postcode'      => $_POST[$prepend . '_step_postcode'],
            'state_name'    => $_POST[$prepend . '_step_state'],
            'shifting_date' => $shifting_date,
            'power_company' => $power_company,            
        );

       
        $return_msg = $wpdb->update($table_name, $lead_data, array('id' => $user_id));
        $data = null;

        $response = ''; 
        if ($wpdb->last_error !=  ''):
            $error_msg = $wpdb->print_error();
        endif;

        if ($return_msg) {  
            $postdata = array(
                'address'       =>  $_POST[$prepend . '_step_address'],
                'street_name'   =>  $_POST[$prepend . '_step_street_name'],
                'suburb'        =>  $_POST[$prepend . '_step_suburb'],
                'state'         =>  $_POST[$prepend . '_step_state'],
                'country'       =>  $_POST[$prepend . '_step_country'],
                'postcode'      =>  $_POST[$prepend . '_step_postcode'],
                'power_company' =>  $power_company,
                'em_lead_id'    =>  $lead_id,
                'shifting_date' =>  $shifting_date,
                'action'        =>  "save_em_lead_step2",
                'lead_from'      => 'solarmonster'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER,  $this->headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

            $data = curl_exec($ch);

            if (curl_errno($ch)) { 
                $everything_is_ok = false;
                $curl_error_msg = curl_error($ch); 
            } else {
                $wpdb->update($table_name, array("step2_sync" => 1), array("id" => $lead_id));
            }
            curl_close($ch);
        }else{
            $everything_is_ok = false; 
            $response = array(
                'id'        =>  $return_msg,
                'code'      =>  401,
                'message'   =>  "Some Error Occurred. Please try again.",
                'query'     => $wpdb->last_query,
            );
        }

        if($everything_is_ok){
            header('Content-Type: application/json');
            echo json_encode(array("return_msg" => $return_msg, "data" => $data)); 
        }else{ 
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) != ""){
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.'); 
            } else if(trim($curl_error_msg) != ""){                
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else { 
                echo json_encode('Error 409: Conflict.['.json_encode($response).']. Please try again.'); 
            }                      
        }

        
        die(0);
    }


    public function SaveContactDetails()
    {
        global $wpdb;

        $everything_is_ok = true;
        $error_msg = '';
        $curl_error_msg = '';

        $table_name = $wpdb->prefix . 'contact_us';
        $sql = "";
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();
    
            $sql = "CREATE TABLE $table_name (
                id int(11) NOT NULL  AUTO_INCREMENT,
                service_request text NOT NULL,
                fname text NOT NULL,
                lname text NOT NULL,
                email_id text NOT NULL,
                contact_num text NOT NULL,
                company text NOT NULL,
                full_address text DEFAULT NULL,
                street_name text DEFAULT NULL,
                suburb text DEFAULT NULL,
                postcode text DEFAULT NULL,
                state_name text DEFAULT NULL,
                contact_message text NOT NULL,
                source text DEFAULT NULL,
                date_added datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY (id)
                ) $charset_collate;";
            $wpdb->query($sql);
        }

        $prepend  = "";
        if(isset($_POST['prepend']) && $_POST['prepend'] != "")  $prepend = trim($_POST['prepend']); 
       
        $to_remove_array = array('$','-','_','(',')',',',' ');

        $fname = ucwords(strtolower(trim(stripslashes($_POST[ $prepend.'_firstname']))));
        $lname = ucwords(strtolower(trim(stripslashes($_POST[ $prepend.'_lastname']))));
        $phone_num = str_replace($to_remove_array,"",trim($_POST[ $prepend.'_phone']));

        $mobile = $land_line = '';
        $code = substr($phone_num, 0, 2);
        if($code == '04')
        $mobile = $phone_num;
        else
        $land_line = $phone_num;

        $service_request = trim($_POST[$prepend.'_customerservice']);
        $email_id = trim($_POST[$prepend.'_email']);
        $source = (isset($_POST['source']) ? $_POST['source'] : 'contact-us'); 

        $cnfm_details = array(
            'service_request'   =>      $service_request,
            'fname'             =>      $fname,
            'lname'             =>      $lname,
            'email_id'          =>      $email_id,
            'contact_num'       =>      $phone_num,
            'company'           =>      trim($_POST[ $prepend.'_company']),
            'full_address'      =>      trim($_POST[ $prepend.'_address']),
            'street_name'       =>      trim($_POST[ $prepend.'_street_name']),
            'suburb'            =>      trim($_POST[ $prepend.'_suburb']),
            'postcode'          =>      trim($_POST[ $prepend.'_postcode']),
            'state_name'        =>      trim($_POST[ $prepend.'_state']),
            'contact_message'   =>      trim($_POST[ $prepend.'_message']),
            
        );
        $wpdb->insert( $table_name, $cnfm_details);
        $contact_us_id = $wpdb->insert_id;

        $name = $fname.' '.$lname;
        $email = $email_id;
        $message = trim($_POST[ $prepend.'_message']);
        $subject = "Solar Monster Contact Message";

        $content="From: $name \n Email: $email \n Message: $message";
        $recipient = "mark.anthony@monstergroup.com.au;";
        $mailheader = "From: $email \r\n";
        mail($recipient, $subject, $content, $mailheader) or die("Error!");
        $contact_us_msg  = "Email sent!";

       
        if ($contact_us_id) {  
            $data = "";
            $postdata = array(
                'customerservice'   =>  $service_request,
                'fname'             =>  $fname,
                'lname'             =>  $lname,
                'phone_num'         =>  $phone_num,
                'email_id'          =>  $email_id,
                'address'           =>  trim($_POST[ $prepend.'_address']),
                'postcode'          =>  trim($_POST[ $prepend.'_postcode']),
                'street_name'       =>  trim($_POST[ $prepend.'_street_name']),
                'suburb'            =>  trim($_POST[ $prepend.'_suburb']),
                'state'             =>  trim($_POST[ $prepend.'_state']),
                'country'           =>  trim($_POST[ $prepend.'_country']),
                'company'           =>  trim($_POST[ $prepend.'_company']), 
                'source'            =>  $source,
                'comment_query'     =>  $message,
                'site_source'       =>  "solarmonster",
                'action'            =>  "save_em_enquiry",
                'sm_contact_id'     =>  $contact_us_id
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER,  $this->headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

            $data = curl_exec($ch);
            if (!curl_errno($ch)) {
            } else {
                $everything_is_ok = false;
                $curl_error_msg = curl_error($ch);
            }
            curl_close($ch);
        } else {
            $everything_is_ok = false;
            if ($wpdb->last_error !=  ''):
                $error_msg = $wpdb->print_error();
            endif;
        }

        $return_msg = array(
            'return_id'     =>      $contact_us_id,            
            'return_msg'    =>      $contact_us_msg,
        );  
        
        if($everything_is_ok){
            header('Content-Type: application/json');
            echo json_encode(array("return_msg" => $return_msg, "data" => $data)); 
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) == ""){
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else {                
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.'); 
            }            
        } 
        die(0); 
    } 
    
    public function CheckUserSignOff()
    {
        global $wpdb; 
        $everything_is_ok = true;
        $error_msg = '';
        $curl_error_msg = '';
        $cuso_step = null;

        $table_name = $wpdb->prefix . 'sign_off';
        $sql = "";  

        $order_form_id  = "0";
        if(isset($_POST['order_form_id']) && $_POST['order_form_id'] != "")  $order_form_id = trim($_POST['order_form_id']); 

        $sub_action = "check";
        if (isset($_POST['subs']) && $_POST['subs'] != "") $sub_action = trim($_POST['subs']); 

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();
    
            $sql = "CREATE TABLE $table_name (
                id int(11) NOT NULL  AUTO_INCREMENT,
                source text DEFAULT NULL,
                em_lead_id text DEFAULT NULL,  
                order_form_id text DEFAULT NULL,
                order_form_name text DEFAULT NULL, 
                crm_lead_name text DEFAULT NULL, 
                partner_name text DEFAULT NULL, 
                ack_confirm1 text DEFAULT NULL, 
                ack_confirm2 text DEFAULT NULL, 
                ack_confirm3 text DEFAULT NULL, 
                ack_confirm4 text DEFAULT NULL, 
                order_lead_name text DEFAULT NULL, 
                order_lead_sign text DEFAULT NULL, 
                sign_off_date datetime DEFAULT NULL,
                date_added  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY (id)
                ) $charset_collate;";
            $wpdb->query($sql);  
        } else {
            $cuso_step = $wpdb->get_row( "SELECT * FROM $table_name WHERE order_form_id = $order_form_id" ); 
        }

        $response = ''; 
        $em_data = null;
        $pdf_link = null;
        $signed_off = null;
        $postdata = null;
        $step = 0;
        $fname = "";
        $partner = "";
        if($cuso_step){
            if ($sub_action == 'check') {
                $step = 2;
                $signed_off = $cuso_step->sign_off_date;
                $fname = $cuso_step->crm_lead_name;
                $pdf_link = $this->pdf_url . $cuso_step->order_form_name; 
                $partner = $cuso_step->partner_name;
            }else{
                $step = 3;   
                if (isset($_POST['so_fullname']) && $_POST['so_fullname'] != ""){
                    $fname = trim($_POST['so_fullname']);
                }  

                $ack1 = "";
                if (isset($_POST['ack1']) && $_POST['ack1'] != ""){
                    $ack1 = trim($_POST['ack1']);
                }  

                $ack2 = "";
                if (isset($_POST['ack2']) && $_POST['ack2'] != ""){
                    $ack2 = trim($_POST['ack2']);
                }  

                $ack3 = "";
                if (isset($_POST['ack3']) && $_POST['ack3'] != ""){
                    $ack3 = trim($_POST['ack3']);
                }  

                $ack4 = "";
                if (isset($_POST['ack4']) && $_POST['ack4'] != ""){
                    $ack4 = trim($_POST['ack4']);
                }  

                $dirs = wp_upload_dir();
                $path = $dirs['basedir'] .'/signatures';  
                $text = '';  
                $stamp = $order_form_id.'-'.date("Ymd").'.png';
                if (isset($_POST['sign']) && $_POST['sign'] != ""){  
                    if(is_dir($path)){ 
                        $text = $path .'/'. $stamp;
                    }else{
                        if (!mkdir($dirs['basedir'] .'/signatures', 0777, true)) {
                            die('Failed to create folders...');
                        }else{
                            $text = $path .'/'. $stamp;
                        } 
                    }                     
                  
                    if ($text != "") $this->base30_to_jpeg($_POST['sign'], $text);
                }   

                $postdata = array(
                    'order_form_id' =>  $order_form_id,
                    'confirm_name'  =>  $fname,
                    'stamp_file'    =>  $stamp,
                    'ack_confirm1'  =>  $ack1,
                    'ack_confirm2'  =>  $ack2,
                    'ack_confirm3'  =>  $ack3,
                    'ack_confirm4'  =>  $ack4,
                    'action'        =>  "record_signoff",
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->api_url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

                $em_data = curl_exec($ch);
                if (!curl_errno($ch)) {
                    $em_data = json_decode($em_data);
                    if ($em_data->code==200){
                        $wpdb->update($table_name, array(
                            "sign_off_date" => date("Y-m-d H:i:s"),
                            "order_lead_name" => $fname,
                            "order_lead_sign" => $text,
                            "ack_confirm1" =>  $ack1,
                            "ack_confirm2" =>  $ack2, 
                            "ack_confirm3" =>  $ack3, 
                            "ack_confirm4" =>  $ack4, 
                        ), array("id" => $cuso_step->id));  
                    }else{
                        $everything_is_ok = false;
                        $error_msg = '[CURL]:'.$em_data->code.' -->'.$em_data->message; 
                    }
                } else {
                    $everything_is_ok = false;
                    $error_msg = '[#3-CURL]:' . curl_error($ch); 
                } 
                curl_close($ch);
           }  
        }else{ 
            $step = 1;
            $postdata = array(
                'order_form_id' => $order_form_id,
                'action' => "get_quote_data",
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

            $em_data = curl_exec($ch);
            if (!curl_errno($ch)) {
                $em_data = json_decode($em_data);
                
                if ($em_data->code==200){
                    $cnfm_details = array(
                        'em_lead_id'        =>      $em_data->em_lead_id,
                        'order_form_name'   =>      $em_data->order_form_name,
                        'crm_lead_name'     =>      $em_data->full_name,
                        'order_form_id'     =>      $order_form_id,
                        'sign_off_date'     =>      null,
                        'source'            =>      'SM SignOff',
                        'partner_name'      =>      $em_data->partner,
                    );
                   
                    $wpdb->insert($table_name, $cnfm_details); 
                    $pdf_link = $this->pdf_url.$em_data->order_form_name; 
                    $partner = $em_data->partner;
                    $fname = $em_data->full_name;
                    $lastq = $wpdb->last_query;
                    $test = $wpdb->insert_id;
                }else{
                    $everything_is_ok = false;
                    $error_msg = '[#2-CURL]:'.curl_error($ch);
                } 
            } else {
                $everything_is_ok = false;
                $error_msg = '[#1-CURL]:'.curl_error($ch);
            } 
            curl_close($ch);
        } 
 

        $response = array(
            'order_form_id' =>$order_form_id,
            'postdata'  =>  $postdata,
            'action'    =>  $sub_action,
            'lead'      =>  $lead_sign_off,
            'error'     =>  $error_msg,
            'id'        =>  $cuso_step->id,
            'sql'       =>  $wpdb->last_query,
            'res'       =>  $cuso_step,
            'crm'       =>  $em_data, 
            'link'      =>  $pdf_link,
            'done'      =>  $signed_off,
            'step'      =>  $step,
            'is_ok'     =>  $everything_is_ok,
            'path'      =>  $path,
            'text'      =>  $text,
            'fname'     =>  $fname,
            'partner'   =>  $partner,
        );

      
        if($everything_is_ok){ 
            echo json_encode($response); 
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) == ""){
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else {                
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.');  
            }            
        }  
        
        die(0); 
    } 

    public function CheckLeadInfo()
    {
        global $wpdb; 
        $everything_is_ok = true;
        $error_msg = '';
        $curl_error_msg = '';
        $cuso_step = null;
        $step = 0;
        $postdata = null;
        $response = null; 
        $crm_data = null; 
        
        $name = '';
        $contact = '';
        $postcode = '';
        $email = ''; 

        $table_name = $wpdb->prefix . 'lead_data';
        $local_id = "";  

        $order_form_id  = "0";
        if(isset($_POST['order_form_id']) && $_POST['order_form_id'] != "")  $order_form_id = trim($_POST['order_form_id']); 

        $sub_action = "check";
        if (isset($_POST['subs']) && $_POST['subs'] != "") $sub_action = trim($_POST['subs']); 

        $wf_email = "";
        if(isset($_POST['promo_wf_email']))  $wf_email = $_POST['promo_wf_email'];  

        $q1 = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");

        if ($q1 != $table_name) {  
        
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL  AUTO_INCREMENT,
				fname text NOT NULL,
				lname text NOT NULL,
				email_id text NOT NULL,
				mobile_phn text NOT NULL,
                full_address text DEFAULT NULL,
                street_name text DEFAULT NULL,
                suburb text DEFAULT NULL,
				postcode text DEFAULT NULL,
                state_name text DEFAULT NULL,
                source text DEFAULT NULL,
                service_req text NOT NULL,
                quarter_bill text DEFAULT NULL,
                step2_sync tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
                section_src  text NOT NULL,
                page_src  text NOT NULL,
                advertising text DEFAULT NULL,  
                lead_source text DEFAULT NULL,  
				booking_id int(11) DEFAULT NULL,
                em_ref_id int(11) DEFAULT NULL,
                power_company  text DEFAULT NULL,
                shifting_date datetime DEFAULT NULL,

                wf_email text DEFAULT NULL, 
                refresh_source text DEFAULT NULL, 
                promo_code text DEFAULT NULL, 

				date_added datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  	UNIQUE KEY (id)
            ) $charset_collate;";  

            $q2 = $wpdb->query($sql);  

        } else {
            $cuso_step = $wpdb->get_row( "SELECT * FROM $table_name WHERE em_ref_id = $order_form_id" ); 
        }   

        if($cuso_step){
            $step = 2;
            $local_id   =   $cuso_step->id;
            $name       =   $cuso_step->fname;
            $contact    =   $cuso_step->mobile_phn;
            $postcode   =   $cuso_step->postcode;
            $email      =   $cuso_step->email_id; 

        }else{  
            $step = 1;
            $postdata = array(
                'lead_id'   =>      $order_form_id,
                'action'    =>      "get_lead_details",
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));

            $crm_data = curl_exec($ch);
            if (!curl_errno($ch)) {
                $crm_data = json_decode($crm_data);
                
                if ($crm_data->dets_found==1){

                    $name       =   $crm_data->fname;
                    $contact    =   $crm_data->mobile_phn;
                    $postcode   =   $crm_data->postcode;
                    $email      =   $crm_data->email_id; 

                     
                    $cnfm_details = array(
                        'em_ref_id'         =>      $order_form_id,
                        'fname'             =>      $name,
                        'mobile_phn'        =>      $contact,
                        'postcode'          =>      $postcode,
                        'wf_email'          =>      $wf_email,
                        'email_id'          =>      $email,
                        'source'            =>      'solar-promo',
                    );

                    $wpdb->insert($table_name, $cnfm_details);  

                }else{
                    $everything_is_ok = false;
                    $error_msg = '[CURL]:'.curl_error($ch);
                } 
            } else {
                $everything_is_ok = false;
                $error_msg = '[CURL]:'.curl_error($ch);
            } 
            curl_close($ch);
        }  

        $response = array(
            'step'      =>      $step, 
            'lead_id'   =>      $order_form_id,
            'local_id'  =>      $local_id,
            'name'      =>      $name,
            'contact'   =>      $contact,
            'postcode'  =>      $postcode,
            'email'     =>      $email,
            'error'     =>      $error_msg,
            'action'    =>      $sub_action, 
            'crm_data'  =>      json_encode($crm_data),
        ); 

        if($everything_is_ok){ 
            echo json_encode($response); 
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) == ""){
                echo json_encode('Error 500: Internal Server.[' .$curl_error_msg. ']. Please try again.');  
            } else {                
                echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.'); 
            }            
        }   
        die(0); 
    }  
    
    public function RecordClicks()
    {
        global $wpdb; 
        $everything_is_ok = true;
        $error_msg = '';
        $curl_error_msg = ''; 

        $order_form_id  = "0";
        if(isset($_POST['order_form_id']) && $_POST['order_form_id'] != "") {
            $order_form_id = trim($_POST['order_form_id']); 
        }

        $wf_email = "";
        if (isset($_POST['promo_wf_email'])) {
            $wf_email = $_POST['promo_wf_email'];
        }

        $path_email1 = $this->service_url . "crons/track_clicks.php?lead_id=$order_form_id&email_name=$wf_email";
        
        $postdata = array(
            'lead_id'       =>  $order_form_id,
            'email_name'    =>  $wf_email,
            'action'        =>  "record_rd_email_click",
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); 
        $crm_data = curl_exec($ch);


        if (curl_errno($ch)) {
            $everything_is_ok = false;
            $error_msg = '[CURL]:' . curl_error($ch); 
        } 

        curl_close($ch); 

      

        $response = array( 
            'lead_id'       =>      $order_form_id,
            'email_name'    =>      $wf_email,
            'path'          =>      $path_email1, 
            'error'         =>      $error_msg, 
        );

        if($everything_is_ok){  
            echo json_encode($response); 
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');

            if(trim($error_msg) == ""){
                echo json_encode('Error 500: Internal Server.[' .json_encode($response). ']. Please try again.');  
            } else {                
                echo json_encode('Error 400: Bad Request.['.json_encode($response).']. Please try again.'); 
            }            
        }   
        die(0); 
    } 
     

    public function SMQuoteStep2() {
        global $wpdb, $site_url, $state_list, $api_url;
        $lead_Details = null;
        $everything_is_ok = true;
        $error_msg ='';

        $table_name = $wpdb->prefix . 'lead_data';   

        $lead_id = $_POST['this_fbsm_id']; 

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $error_msg = $table_name . ' is not defined.';
            $everything_is_ok = false;
        } else {
            $lead_Details = $wpdb->get_row( "SELECT * FROM $table_name WHERE id = $lead_id" ); 
        }   
         
        $estimate_bill = '';
        if(isset($_POST['campaign_step_quarter_bill'])){
            $extras['estimate_bill'] = $_POST['campaign_step_quarter_bill'];
            $estimate_bill = $_POST['campaign_step_quarter_bill'];
        }

        $power_company = '';
        if(isset($_POST['campaign_step_retailer'])){
            $power_company = $_POST['campaign_step_retailer'];  
        }  

        $address = '';
        if(isset($_POST['campaign_step_address'])){
            $address = $_POST['campaign_step_address'];  
        }  

        $street_name = '';
        if(isset($_POST['campaign_step_street_name'])){
            $street_name = $_POST['campaign_step_street_name'];  
        }  

        $suburb = '';
        if(isset($_POST['campaign_step_suburb'])){
            $suburb = $_POST['campaign_step_suburb'];  
        }  

        $postcode = '';
        if(isset($_POST['campaign_step_postcode'])){
            $postcode = $_POST['campaign_step_postcode'];  
        }  

        $state = '';
        if(isset($_POST['campaign_step_state'])){
            $state = $_POST['campaign_step_state'];  
        }    

        $em_lead_id = '';
        if(isset($_POST['sm_lead_response'])){
            $em_lead_id = $_POST['sm_lead_response'];  
        }  

        $lead_data = array(
            'full_address'     =>   $address,
            'street_name'      =>   $street_name,
            'suburb'           =>   $suburb,
            'postcode'         =>   $postcode,
            'state_name'       =>   $state,
            'power_company'    =>   $power_company,
            'quarter_bill'     =>   $estimate_bill,
            'extras'           =>   json_encode($extras),
        ); 
        $result = $wpdb->update($table_name, $lead_data, array("id" => $lead_id));   
             
        $postdata = array(
            'em_lead_id'    =>      $em_lead_id,
            'address'       =>      $address,
            'street_name'   =>      $street_name,
            'suburb'        =>      $suburb,
            'postcode'      =>      $postcode,
            'state'         =>      $state,
            'power_company' =>      $power_company,
            'estimate_bill' =>      $estimate_bill,
            'action'        =>      "save_sm_quote_step",
        ); 
        
        $filename = '';
        $res_data = null; 

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); 
        $data = curl_exec($ch);
        
       
        if(curl_errno($ch)) {
            $everything_is_ok = false;
            $error_msg = '[CURL]:'.curl_error($ch);
        }else{
            $wpdb->update($table_name, array("step2_sync" => 1), array("id" => $lead_id));
            $data = (array)json_decode($data);    

            if(isset($res_data['filename']))
                $filename =  $this->pdf_url ."/documents/solar_quotes/". $data['filename'];
                
           
        }
        curl_close($ch);
         
        
        $res_data = array(
            'em_lead_id' => $em_lead_id,
            'address' => $address,
            'street_name' => $street_name,
            'suburb' => $suburb,
            'postcode' => $postcode,
            'state' => $state,
            'power_company' => $power_company,
            'estimate_bill' => $estimate_bill,
            'action' => "save_sm_quote_step",
            'filename' => $filename,
            'error_msg' => $error_msg,
        );  
        
        if($everything_is_ok) {
            echo json_encode($res_data);
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');  
            echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.');  
        } 
        
        die(0);
    }

    // Save Note from Solar Monster last step if exist
    public function SaveNote() {
        global $wpdb, $site_url, $state_list, $api_url;
        $lead_Details = null;
        $everything_is_ok = true;
        $error_msg ='';

        $table_name = $wpdb->prefix . 'lead_data';   

        $lead_id = $_POST['this_fbsm_id']; 

        $save_in_crm = $_POST['save_in_crm'];

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $error_msg = $table_name . ' is not defined.';
            $everything_is_ok = false;
        } else {
            $lead_Details = $wpdb->get_row( "SELECT * FROM $table_name WHERE id = $lead_id" ); 
        }   
         

        $note = '';
        if(isset($_POST['note'])){
            $note = $_POST['note'];  
        }    

        $em_lead_id = '';
        if(isset($_POST['sm_lead_response'])){
            $em_lead_id = $_POST['sm_lead_response'];  
        }  

        $lead_data = array(
            'note'     =>   $note
        ); 
        $result = $wpdb->update($table_name, $lead_data, array("id" => $lead_id));   
             
        $postdata = array(
            'em_lead_id'    =>      $em_lead_id,
            'note'          =>      $note,
            'action'        =>      "SMQuoteNote",
        ); 
        
        $filename = '';
        $res_data = null; 

        if( isset($_POST['save_in_crm']) && $_POST['save_in_crm'] == "yes" ) {
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata)); 
            $data = curl_exec($ch);
            
           
            if(curl_errno($ch)) {
                $everything_is_ok = false;
                $error_msg = '[CURL]:'.curl_error($ch);
            }else{
                $data = (array)json_decode($data);    

                if(isset($res_data['filename']))
                    $filename =  $this->pdf_url ."/documents/solar_quotes/". $data['filename'];
                    
               
            }
            curl_close($ch);
            
        }      
         
        
        $res_data = array(
            'em_lead_id' => $em_lead_id,
            'note' => $note,
            'action' => "SMQuoteNote",
            'filename' => $filename,
            'error_msg' => $error_msg,
        );  
        
        if($everything_is_ok) {
            echo json_encode($res_data);
        }else{
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');  
            echo json_encode('Error 400: Bad Request.['.$error_msg.']. Please try again.');  
        } 
        
        die(0);
    }
}

