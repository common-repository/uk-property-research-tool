<?php
/**
* Plugin Name: Property118 Research Tool
* Plugin URI: http://www.property118.com/
* Description: The UK Property Research Tool aggregates information from various websites without the need to visit multiple websites.
* Version: 1.16
* Author: Property118
* Author URI: http://www.property118.com/
*/
/*  
The MIT License (MIT)
Copyright (c) [2014] [Mark Alexander]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

add_action('admin_menu', 'propertysearchtool_setup_menu');
 
function propertysearchtool_setup_menu(){
    add_menu_page( 'P118 Property Research Tool', 'P118 Property Research Tool', 'manage_options', 'p118_property_research_tool', 'p118_research_tool_init' );
}

function p118_research_tool_init(){
    echo "<div style='max-width:900px;'><h1 style='color: #005a83;'>
        <a href='http://www.property118.com'><img src='".plugins_url()."/p118researchtool/img/p118_logo_new.png'></a><br/>
        <a href='http://www.property118.com/' style='color: #ED9200;'>Property118.com</a> Property Research Tool Plugin</h1>";
    echo "<br/><a href='http://www.property118.com/equity-finance-for-buy-to-let-landlords/44713/' target='_blank'>
        <img src='".plugins_url()."/p118researchtool/img/CastleTrustBanner.jpg'>
    </a>";
    echo "<br/><br/><p><b>Description</b></p>
    <p>The Property Research Tool aggregates information from various websites to enable a property buyer or tenant to complete desk top due diligence with ease and without the need to visit multiple websites.</p>
    <p>Development of the Property Research Tool was funded by donations by members of the Property118 landlords forum which has nearly 200,000 members.</p>
    <p>The mission of the Property118 group is to facilitate the sharing of best practice amongst UK landlords, tenants, homeowners and letting agents.</p>
    <p>The Property Research Tool works particularly well in England and Wales and some functionality is also applicable in Scotland and Northern Ireland.</p>
    <p>Users simply input a UK postcode and press search to open up 24 data feeds from renowned sources including the likes of; Google Street View, Rightmove, HM Land Registry, Environment Agency, and the Police.</p>
    <p>Property118 operates on a not for profit basis but did have one corporate sponsor to fund the development of the Property Research Tool. </p>
    <p>This is an equity finance provider for Buy to Let Landlords and they have a banner at the foot of the search results which links back to a forum discussion about their product on Property118. </p>
    <p>There are two other banners, one of which promotes the Wordpress Property Research Tool Plugin and the other promotes free membership of the Property118 community.</p>
    <p>Usage: To use this plugin, install, activate and use the shortcode [p118_property_research_tool] within your page or post.</p>
    <br/><p><b>License</b></p>
    <p>The MIT License (MIT)</p>
    <p>Copyright (c) [2014] [Mark Alexander]</p>
    <p>Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the &quot;Software&quot;), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:</p>
    <p>The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.</p>
    <p>THE SOFTWARE IS PROVIDED &quot;AS IS&quot;, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,</p>
    <p>INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, </p>
    <p>FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE </p>
    <p>AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER </p>
    <p>LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, </p>
    <p>OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE</p>
    <p>SOFTWARE.</p>";
    echo "<a href='http://www.property118.com' style='float:left;'><img src='".plugins_url()."/p118researchtool/img/Property118-175x175.gif' style='width:100px;'></a>    
    </div>";
}

function propertysearchtool()
{
    // Register the script like this for a plugin:
    wp_register_script( 'propertysearchtool', plugins_url( '/js/propertysearchtool.js', __FILE__ ), array( 'jquery', 'jquery-ui-core' ) );
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'propertysearchtool' );
}
add_action( 'wp_enqueue_scripts', 'propertysearchtool' );

function searchjs(){
    // Register the script like this for a plugin:
    wp_register_script( 'search', plugins_url( '/js/search.js', __FILE__ ) , array( 'jquery', 'jquery-ui-core' ) );
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'search' );
    $wnm_custom = array( 'plugin_url' => plugins_url() );
    wp_localize_script( 'propertysearchtool', 'wnm_custom', $wnm_custom );
}
add_action( 'wp_enqueue_scripts', 'searchjs' );

function pluginstyles()
{
    // Register the style like this for a plugin:
    wp_register_style( 'custom-style', plugins_url( '/styles.css', __FILE__ ), array(), '20120208', 'all' );
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'custom-style' );
}
add_action( 'wp_enqueue_scripts', 'pluginstyles' );

//tell wordpress to register the demolistposts shortcode
add_shortcode("p118_property_research_tool", "p118propertyresearch_handler");

function p118propertyresearch_handler() {
    //run function that actually does the work of the plugin
    $output = p118propertyresearch_function();
    //send back text to replace shortcode in post
    return $output;
}

function p118propertyresearch_function() {
    //process plugin
    include('researchtool.php');
    //send back text to calling function
    return $output;
}
?>