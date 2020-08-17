<section class="promo-section jumbotron hero-section" style="background: #000000 url(<?php echo $theme_url; ?>assets/img/footbg.jpg) no-repeat center 100%;">
    <div class="hidden-xs hidden-sm go-left">
        <div class="row">
            <div style="background:black" id="Carousel" class="carousel slide carousel-fade">
                <div class="carousel-inner fadeIn animated">
                    <?php  if($sliderInfo->totalSlides > 0){ foreach($sliderInfo->slides as $ms){ ?>
                    <div class="item <?php echo $ms->sactive; ?> home-slider hero hidden-xs hidden-sm">
                        <img src="<?php echo $ms->thumbnail;?>" alt="">
                        <div class="clearfix"></div>
                        <div class="container hidden-xs hidden-sm">
                            <div class="carousel-caption">
                                <h5 data-wow-duration="1s" data-wow-delay="0.1s" class="fadeInUp wow text-left ttu"><?php echo $ms->title;?></h5>
                                <div class="clearfix"></div>
                                <p data-wow-duration="2s" data-wow-delay="0.1s" class="flash wow text-left text-center"><?php echo $ms->desc;?></p>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <?php } }else{ ?>
                    <div class="item active hero">
                        <div class="slide">
                            <img  src="<?php echo $theme_url; ?>assets/img/slider.jpg">
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php if($sliderInfo->totalSlides > 1){ ?>
                <a class="left carousel-control visible-lg visible-md" href="#Carousel" data-slide="prev">
                <span class="glyphicon-chevron-left fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control visible-lg visible-md" href="#Carousel" data-slide="next">
                <span class="glyphicon-chevron-right fa fa-angle-right"></span>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="cell">
        <div class="container">
        <div class="row">
          <div class="hidden-xs">
                <div style="margin-top:125px"></div>
            </div>
            <div class="col-md-12">
                <ul class="nav nav-tabs RTL nav-justified">
                  <?php include 'menu.php'; ?>
                </ul>
                <div class="tab-content shad RTL_shad search-form" style="border-radius: 0px 25px 25px 0">
                    <?php  if(isModuleActive('hotels')){ ?>
                    <?php $module = 'hotels'; ?>
                    <!-- Hotels  -->
                    <div role="tabpanel" class="tab-pane fade <?=($active_menu == 'hotels')?'active in':''?>" id="hotels" aria-labelledby="home-tab">
                        <?php echo searchForm('hotels'); ?>
                    </div>
                    <!-- Hotels  -->
                    <?php } ?>
                    <?php  if(isModuleActive('pass')){ ?>
                    <?php $module = 'pass'; ?>
                    <!-- Hotels  -->
                    <div role="tabpanel" class="tab-pane fade <?=($active_menu == 'pass')?'active in':''?>" id="pass" aria-labelledby="home-tab">
                        <?php echo searchForm('hotels'); ?>
                    </div>
                    <!-- Hotels  -->
                    <?php } ?>
                    <?php  if(isModuleActive('ean')){ ?>
                    <?php $module = 'ean'; ?>
                    <!-- Expedia Hotels  -->
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'properties')?'active in':''?>" id="properties" aria-labelledby="home-tab">
                        <?php require $themeurl.'views/modules/expedia/main_search.php';?>
                    </div>
                    <!-- Expedia Hotels  -->
                    <?php } ?>
                    <?php  if(isModuleActive('travelpayoutshotels')){ ?>
                    <!-- Travelpayouts Flights  -->
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'tphotels')?'active in':''?>" id="tphotels" aria-labelledby="home-tab">
                        <script charset="utf-8" src="<?php echo $WidgetURLHotel; ?>" async></script>
                    </div>
                    <!-- Travelpayouts Flights  -->
                    <?php } ?>
                    <?php  if(isModuleActive('hotelscombined')){ ?>
                    <!-- HotelsCombine -->
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'hotelsc')?'active in':''?>" id="hotelsc" aria-labelledby="home-tab">
                        <script src="//sbhc.portalhc.com/<?php echo $aid; ?>/SearchBox/<?php echo $searchBoxID;?>" ></script>
                    </div>
                    <!-- HotelsCombine   -->
                    <?php } ?>
                    <?php  if(isModuleActive('Travelpayouts')){ ?>
                    <!-- Travelpayouts Flights  -->
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'air')?'active in':''?>" id="air" aria-labelledby="home-tab">
                        <script charset="utf-8" src="<?php echo $WidgetURLFlight; ?>" async></script>
                    </div>
                    <!-- Travelpayouts Flights  -->
                    <?php } ?>
                    <!-- <?php  if(isModuleActive('Travelstart')){ ?>
                        <li class="text-center">
                            <a href="<?php echo base_url('flightst'); ?>">
                                <i class="fa fa-plane outline-icon visible-xs"></i>
                                <div class="visible-xs visible-md clearfix"></div>
                                <span class="hidden-xs"><?php echo trans('Travelstart');?></span>
                            </a>
                        </li>
                    <?php } ?> -->
                    <?php  if(isModuleActive('wegoflights')){ ?>
                    <!-- Wego Flights  -->
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'flightsw')?'active in':''?>" id="flightsw" aria-labelledby="home-tab">
                        <?php require $themeurl.'views/modules/wegoflights/search.php';?>
                    </div>
                    <!-- Wego  Flights  -->
                    <?php } ?>
                    <?php  if(isModuleActive('tours')){ ?>
                    <?php $module = 'tours'; ?>
                    <!-- Tours  -->
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'tours')?'active in':''?>" id="tours" aria-labelledby="home-tab">
                        <?php echo searchForm('tours', $data); ?>
                    </div>
                    <!-- Tours  -->
                    <?php } ?>
                    <?php  if(isModuleActive('cars')){ ?>
                    <?php $module = 'cars'; ?>
                    <!-- Cars  -->
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'cars')?'active in':''?>" id="cars" aria-labelledby="home-tab">
                        <?php echo searchForm('cars', $data); ?>
                    </div>
                    <!-- Cars  -->
                    <?php } ?>
                    <?php  if(isModuleActive('cartrawler')){ ?>
                    <!-- Cartrawler  -->
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'car')?'active in':''?>" id="car" aria-labelledby="home-tab">
                        <?php echo searchForm('cartrawler', $data); ?>
                    </div>
                    <?php } ?>
                    <!-- Cartrawler  -->
                    <!-- travelport flight form -->
                    <?php  if(isModuleActive('travelport_flight')){ ?>
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'flight')?'active in':''?>" id="flight" aria-labelledby="home-tab">
                        <!-- travelportSearchFormData pass by home -->
                        <?php echo searchForm('travelport_flight', $travelportSearchFormData); ?>
                    </div>
                    <?php } ?>
                    <!-- travelport flight form -->
                    <?php  if(isModuleActive('flights')){ ?>
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'flights')?'active in':''?>" id="flights" aria-labelledby="home-tab">
                        <?php echo searchForm('flights'); ?>
                    </div>
                    <?php } ?>
                    <!--/ .travelport flight form body -->
                    <!-- hotelbeds form -->
                    <?php  if(isModuleActive('hotelbeds')){ ?>
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'hotelb')?'active in':''?>" id="hotelb" aria-labelledby="home-tab">
                        <!-- hotelbedsSearchFormData pass by home -->
                        <?php echo searchForm('hotelbeds'); ?>
                    </div>
                    <?php } ?>
                    <!--/ .hotelbeds flight form body -->
                    <!-- iati flights -->
                    <?php  if(isModuleActive('iati_flight')){ ?>
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'flightsi')?'active in':''?>" id="flightsi" aria-labelledby="home-tab">
                        <!-- iati_flightSearchFormData pass by home -->
                        <?php echo searchForm('iati_flight'); ?>
                    </div>
                    <?php } ?>
                    <!-- end iati -->
                    <!-- Travelport Hotels form -->
                    <?php  if(isModuleActive('Travelport_hotels')){ ?>
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'travelport_hotel')?'active in':''?>" id="travelport_hotel" aria-labelledby="home-tab">
                        <!-- Travelport HotelsSearchFormData pass by home -->
                        <?php echo searchForm('Travelport_hotels'); ?>
                    </div>
                    <?php } ?>
                    <!--/ .Travelport Hotels flight form body -->
                    <?php  if(isModuleActive('ivisa')){ ?>
                    <!-- ivisa  -->
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'ivisa')?'active in':''?>" id="ivisa" aria-labelledby="home-tab">
                        <?php require $themeurl.'views/modules/visa/main_search.php';?>
                    </div>
                    <!-- ivisa  -->
                    <?php } ?>

                    <?php if(isModuleActive('Amadeus')){ ?>
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'amadeus')?'active in':''?>" id="amadeus" aria-labelledby="home-tab">
                        <?php require $themeurl.'views/modules/amadeus/main_search.php';?>
                    </div>
                    <?php } ?>

                    <?php if(isModuleActive('Juniper')){ ?>
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'juniper')?'active in':''?>" id="juniper" aria-labelledby="home-tab">
                        <?php require $themeurl.'views/modules/juniper/main_search.php';?>
                    </div>
                    <?php } ?>

                    <?php if(isModuleActive('sabre')){ ?>
                    <div  role="tabpanel" class="tab-pane fade <?=($active_menu == 'sabre')?'active in':''?>" id="sabre" aria-labelledby="home-tab">
                        <?php require $themeurl.'views/modules/sabre/main_search.php';?>
                    </div>
                    <?php } ?>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
      </div>
    </div>
</section>
