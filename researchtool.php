<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> 
<html class="no-js" lang="en" style="margin-top:0px !important; min-height:750px;"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyDegSBZF-D5G1Y8gzaUghxjZ4OWtkswBw4"></script>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <meta name="google-site-verification" content="OgsNI30HO7ebXNUScqCyBcOoyY1-U_v-xQZLjUTvULE" />
        <?php 
        $embed_host = "www.property118.com";
        if(isset($_GET['hostidentifier']) && $_GET['hostidentifier'] != ""){
            $embed_host = $_GET['hostidentifier'];
        }else if(isset($_POST['hostidentifier']) && $_POST['hostidentifier'] != ""){
            $embed_host = $_POST['hostidentifier'];
        } 
        ?>
    </head>
    <body style="position:relative;background:none">
        <div id="ptool-postcode-research-wrap" class="clearfix">  
            <div id="ptool-postcodeResearchContainer" class="clearfix">
                <div class="ptool-postcodeSearchContainer" <?php if (isset($_POST['postcodeSearch'])&& $_POST['postcodeSearch'] !='') echo 'style="border-bottom:none;"'; ?> >
                    <div class="ptool-inner">
                        <div class="ptool-headerText">   
                            <h1 class='ptool-headtext'>UK Property Research Tool</h1>
                            <div style='clear:both;'></div>
                        </div>
                        <div calss="searchDesc">
                            <p>Enter a UK postcode, hit '<strong>Search</strong>', and see important information you need to check out the area thoroughly.</p>
                        </div>
                        <div class="searchContainer">
                            <div class ="searchBar">
                                <form name="ptool-postcodeResearch" id="ptool-postcodeResearch">
                                    <input type="hidden" name="hostidentifier" value="<?= $embed_host;?>">
                                    <input type="text" name="ptool-postcodeSearch" id="ptool-postcodeSearch" value="<?php if (isset($_POST['postcodeSearch'])&& $_POST['postcodeSearch'] !='') echo $_POST['postcodeSearch']; ?>">
                                    <input type="hidden" name="cityText" id="cityText" value="<?php if (isset($_POST['cityText'])&& $_POST['cityText'] !='') echo $_POST['cityText']; ?>"/>
                                    <input type="hidden" name="countyText" id="countyText" value="<?php if (isset($_POST['countyText'])&& $_POST['countyText'] !='') echo $_POST['countyText']; ?>"/>
                                    <input type="hidden" name="lat" id="latitude" value="<?php if (isset($_POST['lat'])&& $_POST['lat'] !='') echo $_POST['lat']; ?>"/>
                                    <input type="hidden" name="lng" id="longitude" value="<?php if (isset($_POST['lng'])&& $_POST['lng'] !='') echo $_POST['lng']; ?>" /> 
                                    <input type="hidden" name="location_id" id="location_id">
                                    <input type="submit" value="Search" id="ptool-postcodeSearchSubmit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="moreContainer <?php if (isset($_POST['postcodeSearch'])&& $_POST['postcodeSearch'] !='') echo 'hidden'; ?> ">
                    <div id="more"><div class="triangle"></div><div class="moreText">More</div></div>                   
                </div>
                <div class="ptool-postcodeResultContainer hidden" >
                    <div class="ptool-inner">
                        <div class="ptool-resultHeader">
                            Results for <span class="postcode_title"></span>, <span class="city_label"></span>, <span class="county_label"></span>
                            (click the links to see more)
                        </div> 
                        <div class="ptool-resultWrapper">
                            <div class="ptool-resultColumn" id="ptool-postcodeResultCol1">
                                Sold Property Prices
                                <ul class="col1UL postcode_results_list">
                                    <li><a href="" data-src="http://houseprices.landregistry.gov.uk/sold-prices/%postcode%" id="HMLand" class="generatedLink">
                                        <img src="<?php echo plugins_url(); ?>/uk-property-research-tool/img/landregistry.png" alt="landregistry icon" width='16px'> HM Land Registry</a>
                                    </li> 
                                </ul>
                                Property for Sale
                                <ul class="col1UL postcode_results_list">
                                    <li><a href="#" data-src="http://www.rightmove.co.uk/property-for-sale/find.html?searchType=SALE&locationIdentifier=POSTCODE%5E%location_id%&insId=1&radius=0.0&displayPropertyType=&minBedrooms=&maxBedrooms=&minPrice=&maxPrice=&retirement=&partBuyPartRent=&maxDaysSinceAdded=&_includeSSTC=on&sortByPriceDescending=&primaryDisplayPropertyType=&secondaryDisplayPropertyType=&oldDisplayPropertyType=&oldPrimaryDisplayPropertyType=&newHome=&auction=false" id="rightmoveSale" class="generatedLink"><img src="<?php echo plugins_url(); ?>/uk-property-research-tool/img/rightmove.ico" alt="RightMove icon"> Rightmove</a></li>
                                    <li><a href="#" data-src="http://www.zoopla.co.uk/for-sale/property/%postcode%" id="zooplaSale" class="generatedLink"><img src="<?php echo plugins_url(); ?>/uk-property-research-tool/img/zoopla.ico" alt="zoopla icon"> Zoopla</a></li>
                                    <li><a href="#" data-src="http://www.smartnewhomes.com/new-homes/%city%" id="newbuildSale" class="generatedLink"><img src="<?php echo plugins_url(); ?>/uk-property-research-tool/img/smartnewhomes.ico" class="suppicon" alt="smartnewhomes icon"> New Build - Smart New Homes</a></li>
                                </ul>
                                Property to Let
                                <ul class="col1UL postcode_results_list">
                                    <li><a href="" data-src="http://www.rightmove.co.uk/property-to-rent/find.html?searchType=SALE&locationIdentifier=POSTCODE%5E%location_id%&insId=1&radius=0.0&displayPropertyType=&minBedrooms=&maxBedrooms=&minPrice=&maxPrice=&retirement=&partBuyPartRent=&maxDaysSinceAdded=&_includeSSTC=on&sortByPriceDescending=&primaryDisplayPropertyType=&secondaryDisplayPropertyType=&oldDisplayPropertyType=&oldPrimaryDisplayPropertyType=&newHome=&auction=false" id="rightmoveRent" class="generatedLink"><img src="<?php echo plugins_url(); ?>/uk-property-research-tool/img/rightmove.ico" alt="RightMove icon"> Rightmove</a></li>
                                    <li><a href="" data-src="http://www.zoopla.co.uk/to-rent/property/%postcode%" id="zooplaRent" class="generatedLink"><img src="<?php echo plugins_url(); ?>/uk-property-research-tool/img/zoopla.ico" alt="zoopla icon"> Zoopla</a></li>
                                    <li><a href="" data-src="http://www.spareroom.co.uk/flatshare/search.pl?action=search&flatshare_type=offered&search=%postcode%" id="spareroom" class="generatedLink"><img src="<?php echo plugins_url(); ?>/uk-property-research-tool/img/spareroom.ico" width="16px"> Spare Room </a></li>
                                </ul>
                            </div>
                            <div class="ptool-resultColumn" id="ptool-postcodeResultCol2">
                                The Area
                                <ul class="ptool-postcode_results_list">
                                    <li><a href="" data-src="" id="Gstreet" class="generatedLink"><img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/Google-Maps-Logo.png' class='ptool-smalllogo'> Google Street View</a></li>
                                    <li><a href="" data-src="http://www.streetcheck.co.uk/Postcode/%postcode%" id="StreetCheck" class="generatedLink"><img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/streetcheck.png' class='ptool-smalllogo'> Street Check</a></li>
                                    <li><a href="" data-src="http://www.police.uk/crime/?q=%postcode%" id="CrimStat" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/police.png' class='ptool-smalllogo'> Crime Statistics</a>
                                    </li>
                                    <li><a href="" data-src="http://maps.environment-agency.gov.uk/wiyby/wiybyController?value=%postcode%&submit=Search%09&lang=_e&ep=map&topic=floodmap&layerGroups=default&scale=7&textonly=off" id="FloodRisk" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/environment_agency.png' class='ptool-smalllogo'> Flood Risk</a>
                                    </li>
                                    <li><a href="" data-src="http://www.planningfinder.co.uk/search/near?radius=1.0&postcode=%postcode%&order=distance_closest" id="PlanningApp" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/planning-finder.png' class='ptool-smalllogo'> Planning Applications</a>
                                    </li>
                                    <li><a href="" data-src="http://www.checkmyarea.com/%postcode%.htm" id="affluence" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/checkmyarea.png' class='ptool-smalllogo'> Affluence of the area</a></li>
                                    <li><a href="" data-src="http://lha-direct.voa.gov.uk/SearchResults.aspx?Postcode=%postcode%&LHACategory=999&Month=11&Year=2013&SearchPageParameters=true" id="LHARates" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/dg1.png' class='ptool-smalllogo'> LHA rates</a>
                                    </li>
                                    <li><a href="" data-src="http://www.fixmytransport.com/issues/browse?name=%postcode%" id="PublicTransport" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/fixmytransport.png' class='ptool-smalllogo'> Public Transport</a></li>
                                    <li><a href="" data-src="http://www.theyworkforyou.com/postcode?pc=%postcode%" id="LocalMP" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/mplocate.png' class='ptool-smalllogo'> Local MP</a></li>
                                    <li><a href="" data-src="http://www.education.gov.uk/cgi-bin/schools/performance/search.pl?postcode=%postcode%&distance=1&phase=all&searchType=postcode" id="Schools" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/school_icon.png' class='ptool-smalllogo'> Schools</a></li>
                                    <li><a href="" data-src="http://www.beerintheevening.com/pubs/results.shtml?l=%postcode%" id="LocalPubs" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/pubs.png' class='ptool-smalllogo'> Local Pubs</a></li>
                                    <li><a href="" data-src="http://en.parkopedia.co.uk/parking/%postcode%/" id="parking" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/parking.png' class='ptool-smalllogo'> Parking</a></li>
                                    <li><a href="" data-src="http://www.nhs.uk/Service-Search/GP/%postcode%/Results/4/%lng%/%lat%/4/0?distance=25" id="doctors" class="generatedLink">
                                       <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/nhs.png' class='ptool-smalllogo'> Doctors</a></li>
                                    <li><a href="" data-src="http://www.nhs.uk/Service-Search/Dentists/%postcode%/Results/12/%lng%/%lat%/3/0?distance=25" id="dentists" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/nhs.png' class='ptool-smalllogo'> Dentists</a></li>
                                    <li><a href="" data-src="http://maps.thinkbroadband.com/#!lat=%lat%&lng=%lng%&zoom=15&type=terrain&speed-cluster" id="broadband" class="generatedLink">
                                        <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/broadband.png' class='ptool-smalllogo'> Broadband Speed</a></li>
                                </ul>
                            </div >
                            <div class="ptool-resultColumn" id="ptool-postcodeResultCol3">
                                Finance
                                <ul>
                                    <li><a href="" data-src="http://www.themoneycentre.net/GetQuote1.asp" id="mortgageSourcing" class="generatedLink">BTL Mortgage Sourcing</a></li>
                                    <li><a href="" data-src="http://www.property118.com/simple-landlord-calculator/" id="stressTest" class="generatedLink">Calculate Returns</a></li>
                                </ul>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="ptool-sponsorsWrapper <?php if (!isset($_POST['postcodeSearch'])|| $_POST['postcodeSearch'] =='') echo 'hidden'; ?>" >
                    <div class="ptool-inner">    
                        <div class="ptool-sponsorsContainer">
                            <div class="ptool-embedCodeContainer">
                               <a href="http://www.property118.com/btl-second-charge-mortgages-no-monthly-payments/44627/"><img src="<?php echo plugins_url(); ?>/uk-property-research-tool/img/CastleTrustBannerSmall.jpg"></a> 
                            </div>
                            <br/>
                            <a href="http://www.property118.com/membership/40048/" class="clickable" style='float:left;'>
                            <div class="ctas">
                                <img src="<?php echo plugins_url(); ?>/uk-property-research-tool/img/nav_cta_member.png" class="just_image">
                                <img src="<?php echo plugins_url(); ?>/uk-property-research-tool/img/nav_cta_arrow.png" class="arrow">
                            </div>
                            </a>
                            <a href="https://wordpress.org/plugins/uk-property-research-tool/" class="clickable" style='float:left;'>
                            <div class="ctas">
                                <h3 style='padding-left:10px;'>Download This Plugin</h3>
                                <img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/wordpress-logo.png' class='arrow' style='width:30px;'>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ptool-sponsorsFooter">
                </div>
            </div>
        </div>
        <div id="ptool-modal-background"></div>
        <div id="ptool-modal-link-content">
            <div><button id="ptool-modal-close"><img src='<?php echo plugins_url(); ?>/uk-property-research-tool/img/closeicon.png' class='closeicon'></button></div>
            <div class="ptool-modal-link-header">                    
                <div class="ptool-modal-link-header-wrapper">
                    <div class="ptool-headerText">
                        <h1>UK Property Research Tool in Association</h1>
                    </div>
                    <div class="ptool-backLink">
                    </div>
                </div>
            </div>
            <div class="ptool-modal-link-body">
                <div id="ptool-loadingMessage" style="font-size: 20px;text-align: center;padding-top: 2%;">Loading...Please Wait</div>
                <div id="map-canvas" class="hidden"  style="width: 100%; height: 100%"> </div>
                <div class='iframescroll-wrapper'>
                    <iframe class="ptool-modal-link-iframe" id="ptool-modal-link-iframe" src=""></iframe>
    
                </div>
                
            </div>              
        </div>
        <script>    
            
            var $j = jQuery.noConflict();
             
        </script>
        <script type="text/javascript">
        var sc_project=7456578; 
        var sc_invisible=1; 
        var sc_security="363ea8db"; 
        </script>
    </body>
</html>