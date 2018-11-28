<?php
/**
 * The template for displaying the footer.
 *
 * @package flatsome
 */

global $flatsome_opt;
$current_user_device = get_user_device();
?>

</main><!-- #main -->

<footer id="footer" class="footer-wrapper sticky-footer">

	<?php do_action('flatsome_footer'); ?>

    <?php if($current_user_device == 'Mobile'){ echo "<br><br>"; } ?>
    
</footer><!-- .footer-wrapper -->

</div><!-- #wrapper -->

<?php wp_footer(); ?>

<?php if($current_user_device == 'Mobile'){ ?>
<div class="simple-sticky-footer-container show-for-small">
    <div class="col medium-12 small-12 large-12 orange-gradient-bg padding-none">  
        <a href="tel:1300962027" class="request-call-back-button1" title="CALL NOW">
            <div class="row">
                <div class="col medium-7 small-7 large-7 pyx-imp" style="text-align:right;">
                    <span class="swap-span-text d-none">
                        <i class="icon-phone"></i>  
                        CALL NOW
                        &nbsp;&nbsp;
                    </span>
                    <span class="swap-span-text">
                        <i class="icon-phone"></i>  
                        FREE SERVICE
                    </span>
                </div> 
                <div class="col medium-5 small-5 large-5 pyx-imp" style="text-align:left;">
                    <b><span>1300 745 095</span></b>
                </div>
            </div> 
        </a> 
    </div>
</div>
<?php } ?>
</body>
</html>
