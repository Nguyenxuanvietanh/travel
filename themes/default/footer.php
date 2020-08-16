</div> <!--/ .body-section -->

<?php if($mSettings->mobileSectionStatus == "Yes"){  ?>

<div class="theme-hero-area mobside visible-lg">
    <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url(img/patterns/travel/1.png);"></div>
        <div class="theme-hero-area-grad-mask theme-hero-area-grad-mask-i"></div>
        <div class="theme-hero-area-inner-shadow theme-hero-area-inner-shadow-light"></div>
    </div>
    <div class="theme-hero-area-body">
        <div class="container">
            <div class="theme-page-section _p-0">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="theme-mobile-app">
                            <div class="row">
                                <div class="col-md-6 wow fadeIn">
                                    <div class="theme-mobile-app-section">
                                        <img class="theme-mobile-app-img" src="<?php echo $theme_url; ?>assets/img/apps.png" alt="Image Alternative text" title="Image Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="theme-mobile-app-section">
                                        <div class="theme-mobile-app-body">
                                            <div class="theme-mobile-app-header">
                                                <h2 class="theme-mobile-app-title"><?php echo trans('0386'); ?></h2>
                                                <p class="theme-mobile-app-subtitle"><?php echo trans('0387'); ?></p>
                                            </div>
                                            <ul class="theme-mobile-app-btn-list">
                                            <?php if(!empty($mSettings->iosUrl)){ ?>
                                            <li>
                                                    <a class="btn btn-dark theme-mobile-app-btn" href="<?php echo $mSettings->iosUrl; ?>">
                                                    <i class="theme-mobile-app-logo">
                                                    <img src="<?php echo $theme_url; ?>assets/img/apple.png" alt="Image Alternative text" title="Image Title">
                                                    </i>
                                                    <span>Download on
                                                    <br>
                                                    <span>App Store</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                                <?php if(!empty($mSettings->androidUrl)){ ?>
                                                <li>
                                                    <a class="btn btn-dark theme-mobile-app-btn" href="<?php echo $mSettings->androidUrl; ?>">
                                                    <i class="theme-mobile-app-logo">
                                                    <img src="<?php echo $theme_url; ?>assets/img/android.png" alt="Image Alternative text" title="Image Title">
                                                    </i>
                                                    <span>Download on
                                                    <br>
                                                    <span>Play Market</span>
                                                    </span>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<div id="footer" class="<?php echo @$hidden; ?>">
    <aside class="footer-holder">
        <div class="container">
            <div class="row">
                <div class="footer-section">
                    <div class="col-md-6 col-xs-12">
                        <div class="nav-block">
                            <div class="row">
                                <?php get_footer_menu_items(22,"wow fadeIn col-xs-4 col-md-3 footer-nav go-right","title go-text-right","footerlist go-right go-text-right" );?>
                                <?php get_footer_menu_items(19, "wow fadeIn col-xs-4 col-md-3 footer-nav go-right","title go-text-right","footerlist go-right go-text-right"  );?>
                                <?php get_footer_menu_items(25,"wow fadeIn col-xs-4 col-md-3 footer-nav go-right","title go-text-right","footerlist go-right go-text-right" );?>
                            </div>
                        </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="row custom-r">
                            <div class="col-lg-7 col-md-6 col-sm-6">
                                <div class="row-holder">
                                    <?php if(isModuleActive('newsletter')){ ?>
                                    <strong class="title"><?php echo trans('023');?></strong>
                                    <div class="col-md-12">
                                        <div id="message-newsletter_2"></div>
                                        <form role="search" onsubmit="return false;">
                                        </form>
                                        <div class="row">
                                            <input type="email" class="form-control input-lg fccustom2 sub_email form-group" id="exampleInputEmail1" placeholder="<?php echo trans('023');?> <?php echo trans('0403');?>" required>
                                            <div class="clearfix"></div>
                                            <button type="submit" class="btn btn-primary btn-block sub_newsletter ttu"> <?php echo trans('024');?></button>
                                        </div>
                                        <ul class="nav navbar-nav">
                                            <li>
                                                <a class="newstext" href="javascript:void(0);">
                                                    <div class="wow fadeIn subscriberesponse"></div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-6">
                                <div class="social-holder">
                                    <div class="social-block">
                                        <strong class="title">&nbsp;</strong>
                                        <ul class="social-networks">
                                            <?php foreach($footersocials as $fs){ ?>
                                            <li>
                                                <a href="<?php echo $fs->social_link;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $fs->social_name;?>" target="_blank"><img src="<?php echo PT_SOCIAL_IMAGES; ?><?php echo $fs->social_icon;?>" class="social-icons-footer" /></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="logo-block">
                                    <div class="stripe-holder">
                                        <img src="<?php echo $theme_url; ?>assets/img/payments.png" class="img-responsive payments" alt="payments">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </aside>
    <!--
    <div class="hidden-xs hidden-sm">
    <div class="container">
    <div class="row">
    <div class="col-12 col-sm-12 col-md-2 text-right">
    <a href="<?php echo base_url(); ?>"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" class="pull-right img-responsive"/></a>
    </div>
    </div>
    </div>
    </div>
    -->

    <!-- ********************   Removing powered by linkback will result to cancellation of your support service.    ********************  -->
    <div class="hidden-xs hidden-sm" style="padding:10px;background:#d6ebff;">
      <div class="container">
       <div class="text-center">Powered by <a href="http://www.phptravels.com" target="_blank"> <img src="<?php echo base_url(); ?>uploads/global/phptravels.png" style="height:22px" height="22" alt="PHPTRAVELS" /> <strong>PHPTRAVELS</strong></a></div>
      </div>
    </div>
    <!-- ********************   Removing powered by linkback will result to cancellation of your support service.    ********************  -->

    <footer class="footer-frame">
        <div class="container">
            <div class="row">
                <div class="col-md-6 hidden-xs">
                    <?php if($allowsupplierreg){ ?>
                    <a class="btn btn-warning" target="_blank" href="<?php echo base_url(); ?>supplier-register/"><?php echo trans('0241');?></a>
                    <?php } ?>
                    <a class="btn btn-success" target="_blank" href="<?php echo base_url(); ?>supplier/"><?php echo trans('0527');?></a>
                </div>
                <!--<ul class="phone-list" id="phone-list">
                    <?php if( ! empty($phone) ) { ?>
                    <li class="go-right">
                    <i class="icon_set_1_icon-55 go-right align-M mrg5-R f-grey66 fs13"></i>
                    <span class="contact-no align-M"><?php echo trans('0438');?>: <a href="#tel:<?php echo $phone; ?>" class="number"><?php echo $phone; ?></a></span>
                    </li>
                    <?php } ?>
                    <?php if( ! empty($contactemail) ) { ?>
                    <li class="go-right">
                    <i class="fa fa-envelope-o go-right align-M mrg5-R f-grey66 fs13"></i>
                    <span class="tp-mail"><a title="Mail" href="mailto:<?php echo $contactemail; ?>"><?php echo $contactemail; ?></a></span>
                    </li>
                    <?php } ?>
                    </ul>-->
                <div class="col-md-6">
                    <div class="copyright text-right pull-right m_tc">
                        <h5 style="padding-right:25px"><?php echo $app_settings[0]->copyright;?></h5>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<div class="rightsdiv">
<!-- tripadvisors block -->
<?php if($tripmodule){ ?>
<div class="footerbg text-center hidden-xs hidden-sm">
    <a class="btn-block" target="_blank" href="//www.tripadvisor.com/pages/terms.html"><img width="200" lass="block-center" src="<?php echo PT_GLOBAL_IMAGES_FOLDER . 'tripadvisor.png';?>" alt="TripAdvisor" /></a>
    <p>Ratings and Reviews Powered by TripAdvisor</p>
</div>
<?php } ?>
<!-- tripadvisors block -->

<div class="hidden-xs hidden-sm gotopDiv">
    <div class="container text-right">
        <a href="javascript:void" class="gotop scroll wow fadeInUp btn btn-default"><i class="icon-up-open-big"></i></a>
    </div>
</div>
</div>

<style>
.cc-window{opacity:1;transition:opacity 1s ease;}
.cc-link{text-decoration:underline;}
.cc-window{left:0;right:0;bottom:0px;position:fixed;overflow:hidden;box-sizing:border-box;font-size:16px;line-height:1.5em;display:-ms-flexbox;display:flex;-ms-flex-wrap:nowrap;flex-wrap:nowrap;z-index:9999;}
.cc-window.cc-banner{padding:1em 1.8em;width:100%;-ms-flex-direction:row;flex-direction:row;}
.cc-btn,.cc-link{cursor:pointer;}
.cc-link{opacity:.8;padding:.2em;}
.cc-link:hover{opacity:1;} .cc-link:active,.cc-link:visited{color:initial;}
.cc-btn{display:block;padding:.4em .8em;font-size:.9em;font-weight:700;border-width:2px;border-style:solid;text-align:center;white-space:nowrap;}
.cc-window.cc-banner{-ms-flex-align:center;align-items:center;}
.cc-banner .cc-message{display:block;-ms-flex:1 1 auto;flex:1 1 auto;max-width:100%;margin-right:1em;}
.cc-compliance{display:-ms-flexbox;display:flex;-ms-flex-align:center;align-items:center;-ms-flex-line-pack:justify;align-content:space-between;}
@media print{
.cc-window{display:none;} } @media screen and (max-width:900px){
.cc-btn{white-space:normal;} } @media screen and (max-width:414px) and (orientation:portrait),screen and (max-width:736px) and (orientation:landscape){
.cc-window.cc-top{top:0;}
.cc-window.cc-banner{left:0;right:0;}
.cc-window.cc-banner{-ms-flex-direction:column;flex-direction:column;}
.cc-window.cc-banner .cc-compliance{-ms-flex:1 1 auto;flex:1 1 auto;}
.cc-window .cc-message{margin-bottom:1em;}
.cc-window.cc-banner{-ms-flex-align:unset;align-items:unset;}
.cc-window.cc-banner .cc-message{margin-right:0;} }
.cc-color-override--1961008818.cc-window{color:rgb(255, 255, 255);background-color:rgb(0, 0, 0);}
.cc-color-override--1961008818 .cc-link,.cc-color-override--1961008818
.cc-link:active,.cc-color-override--1961008818 .cc-link:visited{color:rgb(255, 255, 255);}
.cc-color-override--1961008818 .cc-btn{color:rgb(0, 0, 0);border-color:transparent;background-color:rgb(241, 214, 0);padding:5px 25px;}
.cc-color-override--1961008818 .cc-btn:hover,.cc-color-override--1961008818
.cc-btn:focus{background-color:rgb(255, 252, 38);}
</style>

<div id="cookyGotItBtnBox" style="display: none" data-wow-duration="0.5s" data-wow-delay="5s" role="dialog" class="wow fadeIn cc-window cc-banner cc-type-info cc-theme-block cc-color-override--1961008818 ">
<span id="cookieconsent:desc" class="cc-message">This website uses cookies to ensure you get the best experience on our website. <a aria-label="learn more about cookies" role="button" tabindex="0" class="cc-link" href="<?php echo base_url(); ?>cookies-policy" rel="noopener noreferrer nofollow" target="_blank">Learn more</a></span>
<div class="cc-compliance">
<button aria-label="dismiss cookie message" role="button" tabindex="0" class="cc-btn cc-dismiss" id="cookyGotItBtn">Got it!</button></div></div>

<?php include 'scripts.php'; ?>
</body>
</html>