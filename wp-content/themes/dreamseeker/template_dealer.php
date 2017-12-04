<?php
/*
  Template Name: Dealer
 */
get_header();
global $post;
global $wpdb;
$mark_points = array();
$info_points = array();
$query = $wpdb->get_results("SELECT * FROM wp_postmeta INNER JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID WHERE (wp_postmeta.meta_key = 'address_d' OR wp_postmeta.meta_key = 'company_name' OR wp_postmeta.meta_key = 'telephone_d' OR wp_postmeta.meta_key = 'email_d' OR wp_postmeta.meta_key = 'webiste_d' OR wp_postmeta.meta_key = 'opening_hours') AND (wp_posts.post_type='dealer' AND post_status='publish')", 'ARRAY_A');
//$query = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE meta_key='address_d' or meta_key='company_name' or meta_key='telephone_d' or meta_key='email_d' or meta_key='webiste_d'", 'ARRAY_A');
$query_ = array();
foreach ($query as $key => $value) {
    if (!isset($query_[$value['post_id']])) $query_[$value['post_id']] = array();
    $query_[$value['post_id']][$value['meta_key']] = $value['meta_value'];
}
foreach ($query_ as $key => $query2) {
//    var_dump($query2['post_id']);
    $map_itm = unserialize(stripslashes($query2['address_d']));
    $addr = $map_itm['address'];
    $lati = $map_itm['lat'];
    $longt = $map_itm['lng'];
    $com_nm = $query2['company_name'];
    $tel_nm = $query2['telephone_d'];
    $em_ad = $query2['email_d'];
    $web_ad = $query2['webiste_d'];
    $opening_hours = $query2['opening_hours'];
    $opening_hours = isset($opening_hours) ? $opening_hours : "";
    
//   $map_data = @file_get_contents('http://labs.silverbiology.com/countylookup/lookup.php?cmd=findCounty&DecimalLatitude=' .$lati. '&DecimalLongitude=' .$longt. '');
//            if ($map_data) {
//                $_dcoder = json_decode($map_data, true);              
//                if (isset($_dcoder['State'])) {
//                $state = $_dcoder['State'];
//                var_dump($state);
//                }
//    }   
    
    $mark_points[] = array($addr, $lati, $longt, $key, $com_nm, $tel_nm, $em_ad, $web_ad, $opening_hours);
    
}
$mark_points = str_replace('&#039;', '', json_encode($mark_points));
?> 
<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.jscrollpane.css" rel="stylesheet" media="all" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/print.css" type="text/css" media="screen, print" />

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>

<script type="text/javascript">
    $.ajax({ url:'http://maps.googleapis.com/maps/api/geocode/json?latlng=<?php echo $lati; ?>,<?php echo $longt; ?>&sensor=true',
         success: function(data){
//            console.log(data[0]);
             /*or you could iterate the components for only the city and state*/
         }
});
     $(".direct_bb").live('click', function(){
           $(".directions-tab a").trigger("click");
     });
    google.maps.event.addDomListener(window, 'load', init);
    var locations =[];
    var map2;
    
    function init() {
        locations = JSON.parse('<?php echo ($mark_points); ?>');
//        locations = JSON.parse('<?php // echo json_encode($mark_points); ?>');
        var mapOptions = {
             zoom : 4, 
            center: new google.maps.LatLng(-25.368268, 135.357241), // australia
            styles: [{"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]}, {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]}, {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#ffffff"}, {"lightness": 17}]}, {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 18}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 16}]}, {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]}, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#dedede"}, {"lightness": 21}]}, {"elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]}, {"elementType": "labels.text.fill", "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]}, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]}, {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#fefefe"}, {"lightness": 20}]}, {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]}]
        };
        var mapElement = document.getElementById('map');
        map2 = new google.maps.Map(mapElement, mapOptions);

        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        var iconBase = $('.path_link').val();    
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map2,
//                animation: google.maps.Animation.DROP,
                icon: iconBase + '/img/marker.png'
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent('<div class="info_wrap"><div class="header"><div class="arrow-up"></div><h4 class="uppercase">DEALERSHIP DETAILS</h4></div><div class="details"><h4 class="uppercase">' + locations[i][4] + '</h4><div class="add_wr">' + locations[i][0] + '</div><div>T: ' + locations[i][5] + '</div><div>E: <a href="mailto:' + locations[i][6] + '" target="_blank" >' + locations[i][6] + '</a></div><div>W: <a href="http://' + locations[i][7] + '" target="_blank" >' + locations[i][7] + '</a></div><div>Opening Hours: ' +locations[i][8]+'</div><button type="submit" class="btn btn-default direct_bb">DIRECTIONS</button></div></div>');
                    infowindow.open(map2, marker);
                        function addcls() {
           $('.gm-style-iw').parent().addClass('info_all');
    };
 setInterval(function () {
        addcls();
       }, 100);
    
                }                   
            })(marker, i));
            
  locations[i].push(marker); 
 
        }
      
    }
         
       jQuery(function($) {
          jQuery('.dl_ulli').live('click',function(event){
                event.preventDefault() 
                var lat = jQuery(this).attr('data-lat');
                var lng = jQuery(this).attr('data-lang');      
                jQuery.each(locations,function(index,marker){   
                    if(marker[1] == lat && marker[2] == lng){ 
                          google.maps.event.trigger(marker[9], 'click' );
                          return false;
                    }
                });
            });
       });
    function load_map_a(locations) {
// console.log('cxxcxc');
//        var locations = JSON.parse('<?php // echo json_encode($mark_points); ?>');
        var mapOptions = {
            zoom: 4,
            center: new google.maps.LatLng(-25.368268, 135.357241), // australia
            styles: [{"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]}, {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]}, {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#ffffff"}, {"lightness": 17}]}, {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 18}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 16}]}, {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]}, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#dedede"}, {"lightness": 21}]}, {"elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]}, {"elementType": "labels.text.fill", "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]}, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]}, {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#fefefe"}, {"lightness": 20}]}, {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]}]
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);

        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        var iconBase = $('.path_link').val();
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: iconBase + '/img/marker.png'
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent('<div class="info_wrap"><div class="header"><div class="arrow-up"></div><h4 class="uppercase">DEALERSHIP DETAILS</h4></div><div class="details"><h4 class="uppercase">' + locations[i][4] + '</h4><div class="add_wr">' + locations[i][0] + '</div><div>T: ' + locations[i][5] + '</div><div>E: <a href="mailto:' + locations[i][6] + '" target="_blank" >' + locations[i][6] + '</a></div><div>W: <a href="http://' + locations[i][7] + '" target="_blank" >' + locations[i][7] + '</a></div><div>Opening Hours: ' +locations[i][8]+'</div><button type="submit" class="btn btn-default direct_bb">DIRECTIONS</button></div></div>');
                     infowindow.open(map, marker);
                     
                         function addcls() {
            $('.gm-style-iw').parent().addClass('info_all');
    };

 setInterval(function () {
        addcls();
       }, 100);
    
                }                   
            })(marker, i));
        }
    }
   
</script>
<script type="text/javascript">
    var source, destination;
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    google.maps.event.addDomListener(window, 'load', function() {
        new google.maps.places.SearchBox(document.getElementById('txtSource'));
        new google.maps.places.SearchBox(document.getElementById('txtDestination'));
//        directionsDisplay = new google.maps.DirectionsRenderer({'draggable': true});
        directionsDisplay = new google.maps.DirectionsRenderer({'suppressMarkers': true,'draggable': true});
    });

    function GetRoute() {
//         console.log('cxcxcx');
//            var mumbai = new google.maps.LatLng(18.9750, 72.8258);
        var mapOptions = {
            zoom: 6,
            center: new google.maps.LatLng(-25.368268, 135.357241),
            styles: [{"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]}, {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]}, {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#ffffff"}, {"lightness": 17}]}, {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 18}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 16}]}, {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]}, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#dedede"}, {"lightness": 21}]}, {"elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]}, {"elementType": "labels.text.fill", "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]}, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]}, {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#fefefe"}, {"lightness": 20}]}, {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]}]

        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('dvPanel'));

        //*********DIRECTIONS AND ROUTE**********************//
        source = document.getElementById("txtSource").value;
        destination = document.getElementById("txtDestination").value;


        var rev_a = $('#txtSource').val();
        var rev_b = $('#txtDestination').val();

        var revaa = rev_a.split(",");
        var revbb = rev_b.split(",");
        $('.a_point').text(revaa[0]);
        $('.b_point').text(revbb[0]);

        var request = {
            origin: source,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
  var iconBase = $('.path_link').val();
    var icons = {
        start: new google.maps.MarkerImage(
        iconBase + '/img/marker_a.png',
        new google.maps.Size(40, 52),
        new google.maps.Point(0, 0),
        new google.maps.Point(22, 32)),
        end: new google.maps.MarkerImage(
          iconBase + '/img/marker_b.png',
        new google.maps.Size(40, 52),
        new google.maps.Point(0, 0),
        new google.maps.Point(22, 32))
    };
    
                  function makeMarker(position, icon, title, map) {
                   var iconBase = $('.path_link').val();
        new google.maps.Marker({
            position: position,
            map: map,
            icon: icon,
        });
    } 
         new google.maps.DirectionsRenderer({
                    map: map,
                    directions: response,
                    suppressMarkers: true
                });
                var leg = response.routes[0].legs[0];
                makeMarker(leg.start_location, icons.start, "A", map);
                makeMarker(leg.end_location, icons.end, 'B', map);
            }

        });

        //*********DISTANCE AND DURATION**********************//
        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix({
            origins: [source],
            destinations: [destination],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
        }, function(response, status) {
            $('.direction-start').css('display', 'block');
            $('#dvDistance').css('display', 'block');
            $('#dvPanel').css('display', 'block');
            if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
                var distance = response.rows[0].elements[0].distance.text;
                var duration = response.rows[0].elements[0].duration.text;
                var dvDistance = document.getElementById("dvDistance");
                dvDistance.innerHTML = "";
                dvDistance.innerHTML += "" + distance + " - ";
                dvDistance.innerHTML += "" + duration;

                var k = $('.adp').html();
                    //var dir_mark = $('.adp-placemark img').attr('src');
                    //  var iconBase = $('.path_link').val();
                    ////var dir_mark = dir_mark_class.attr('src');
                    //if( dir_mark == 'http://mt.googleapis.com/vt/icon/name=icons/spotlight/spotlight-waypoint-b.png&text=B&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=1'){
                    //    $('.adp-placemark img').attr('src', iconBase + '/img/marker_a.png');
                    //}else{
                    //    $('.adp-placemark img').attr('src', iconBase + '/img/marker_b.png');
                    //}
            } else {
                alert("Unable to find the distance via road.");
            }
        });
    }
    function GetRoute2() {
//            var mumbai = new google.maps.LatLng(18.9750, 72.8258);
        var mapOptions = {
            zoom: 6,
            center: new google.maps.LatLng(-25.368268, 135.357241),
            styles: [{"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]}, {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]}, {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#ffffff"}, {"lightness": 17}]}, {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 18}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#ffffff"}, {"lightness": 16}]}, {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]}, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#dedede"}, {"lightness": 21}]}, {"elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]}, {"elementType": "labels.text.fill", "stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]}, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]}, {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#fefefe"}, {"lightness": 20}]}, {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]}]

        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('dvPanel'));

        //*********DIRECTIONS AND ROUTE**********************//

        var rev_a = $('#txtSource').val();
        var rev_b = $('#txtDestination').val();

        $('#txtSource').val(rev_b);
        $('#txtDestination').val(rev_a);

        var revaa = rev_a.split(",");
        var revbb = rev_b.split(",");
        $('.a_point').text(revaa[0]);
        $('.b_point').text(revbb[0]);

        source = document.getElementById("txtSource").value;
        destination = document.getElementById("txtDestination").value;

        var request = {
            origin: source,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING
        };
    directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                
  var iconBase = $('.path_link').val();
    var icons = {
        start: new google.maps.MarkerImage(
        iconBase + '/img/marker_a.png',
        new google.maps.Size(40, 52),
        new google.maps.Point(0, 0),
        new google.maps.Point(22, 32)),
        end: new google.maps.MarkerImage(
          iconBase + '/img/marker_b.png',
        new google.maps.Size(40, 52),
        new google.maps.Point(0, 0),
        new google.maps.Point(22, 32))
    };
    
                  function makeMarker(position, icon, title, map) {
                   var iconBase = $('.path_link').val();
        new google.maps.Marker({
            position: position,
            map: map,
            icon: icon,
        });
    } 
         new google.maps.DirectionsRenderer({
                    map: map,
                    directions: response,
                    suppressMarkers: true
                });
                var leg = response.routes[0].legs[0];
                makeMarker(leg.start_location, icons.start, "A", map);
                makeMarker(leg.end_location, icons.end, 'B', map);
            }

        });

        //*********DISTANCE AND DURATION**********************//
        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix({
            origins: [source],
            destinations: [destination],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
        }, function(response, status) {
            $('.direction-start').css('display', 'block');
            $('#dvDistance').css('display', 'block');
            $('#dvPanel').css('display', 'block');
            if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
                if (rev_a !== '' || rev_b !== '') {
                    var distance = response.rows[0].elements[0].distance.text;
                    var duration = response.rows[0].elements[0].duration.text;
                    var dvDistance = document.getElementById("dvDistance");
                    dvDistance.innerHTML = "";
                    dvDistance.innerHTML += "Distance: " + distance + "<br />";
                    dvDistance.innerHTML += "Duration:" + duration;
                    var k = $('.adp').html();
                    console.log($('.adp').html());
                } else {
                    alert("Select Starting Point and Ending Point.");
                }
            } else {
                alert("Unable to find the distance via road.");
            }
        });
    }

    $(function() {
//	$('.append_search').jScrollPane();
//$("select#prod_filt").selectBoxIt.destroy;
    });
</script>
<style>
    .adp, .adp-directions td, .adp-directions td span, .adp-directions b, .adp-directions p{
        color:#fff!important;
        letter-spacing: 0.8px;
    }
</style>
<!--===============================================================Dealer hero images======================================================================================================-->
<div class="range-heroimg deal_heroimg" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/range-heroimg.jpg');">
    <div class="container ">
        <div class="row">
            <h1>Find A Dealer</h1>
        </div>
    </div> 
</div>

<!--================================================================Range Filters======================================================================================================-->
<div class="filters dealer-filter" >
    <div class="container ">
        <div class="row">
            <input class="path_link" type="hidden" value="<?php echo bloginfo('template_url'); ?>"/>
            <div class="col-lg-offset-2 no_left">
                <form class="form-inline">
                    <div class="form-group loc_ll">
                        <div class="btn-group">
                            <input type="text" class="form-control uppercase searchTextField" id="searchTextField" placeholder="ENTER LOCATION"> 
                            <span class="searchclear dealer_m_serch"></span>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label for="exampleInputName2" class="dealer_name_label">Product</label>
                        <div class="dealer_select_wraper">
                            <select name="test" class="form-control uppercase prod_filt select_style" id="prod_filt">
                                 <option value="">By Product Name</option>
                                 <option value="">All Products</option>
                                <?php
//                            $args = array(
//                                'post_type' => 'products',
//                                'posts_per_page' => -1,
//                                'post_status' => 'publish',
//                            );
//                            $loop = get_posts($args);
//                            foreach ($loop as $loop1) {
//                                $ttl = $loop1-> post_title;
//                                $ttl2 = str_replace(' ', '_', $ttl);
                            ?>
                                <option value="<?php // echo $ttl2; ?>"><?php // echo $ttl; ?></option>
                                      <?php // } ?>
                            </select>
                    </div>-->
                    <button class="btn btn-default uppercase show_deal" type="button" >Find</button>
                    <div class="loading_btn1"></div>
                </form>
            </div>
        </div>
    </div> 
</div>
<!--=============================================================Range Results====================================================================================================-->
<div class="finddealer" >
    <div class="container">
        <div class="row map_result_div" style="margin-bottom:70px;">
            <div class="col-md-4 nopadding" id="leftp">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="Results" class="col-md-6  col-xs-12 active uppercase result_pn"><a href="#results" aria-controls="Results" role="tab" data-toggle="tab">Results</a></li>
                    <li role="Directions" class="col-md-6 col-xs-12 uppercase directions-tab"><a href="#directions" aria-controls="Directions" role="tab" data-toggle="tab">Directions </a></li>
                </ul>
                <div class="tab-content dealer_tab_main">
                    <div role="tabpanel" class="tab-pane active" id="results">
                        <div class="searched-for">
                            <div class="pull-left">YOU SEARCHED: 
                                </br> <span class="bold" style="text-transform:uppercase;">&nbsp;</span> </div> 
                            <div class="pull-right"><a class="glyphicon glyphicon-print print-link2"></a></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="search-results" id="dvPanel2">                             
                            <ul class="append_search">
                                <?php
//                                var_dump($query_);
                                foreach ($query_ as $key => $query2) {
    $map_itm = unserialize(stripslashes($query2['address_d']));
    $lati = $map_itm['lat'];
    $longt = $map_itm['lng'];
    $addr = $map_itm['address'];
    $com_nm = $query2['company_name'];
    $tel_nm = $query2['telephone_d'];
    $em_ad = $query2['email_d'];
    $web_ad = $query2['webiste_d'];    
    
    $opening_hours = $query2['opening_hours'];
    $opening_hours = isset($opening_hours) ? $opening_hours : "";
    ?>
    <li class="dl_ulli" data-lat="<?php echo $lati; ?>" data-lang="<?php echo $longt; ?>">
                                    <span class="uppercase ttl1"><?php echo $com_nm; ?></span><p><?php echo $addr ?></p><p>T: &nbsp;<?php echo $tel_nm; ?></p><p>E:<a href="mailto:<?php echo $em_ad; ?>"><?php echo $em_ad; ?></a> </p> <p>W:<a href="http://<?php echo $web_ad; ?>"> <?php echo $web_ad; ?></a></p><p>Opening Hours:<?php echo $opening_hours; ?></p>
                                </li>
 <?php   
}
                                ?>

                            </ul>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="directions">
                        <div class="location-inputs">
                            <div class="direction-select pull-left ">
                                <div class="direction-from">
                                    <span class="location-icon">A</span>
                                    <div class="btn-group">
                                        <input type="search" class="form-control" id="txtSource" placeholder="Starting Point">
                                        <span class="searchclear"></span>
                                    </div>
                                </div>
                                <div class="direction-to">
                                    <span class="location-icon">B</span>
                                    <div class="btn-group">
                                        <input type="search" class="form-control" id="txtDestination" placeholder="Destination">
                                        <span class="searchclear"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="change-location pull-left ">
                                <a onclick="GetRoute2()" >Change location</a>
                            </div>
                            <div class="clearfix"></div>
                            <p><button class="btn btn-default btn-sm uppercase" type="button" onclick="GetRoute()" >Get directions</button><a class="glyphicon glyphicon-print print-link"></a></p>
                        </div>
                        <div class="directions-step-container">
                            <span></span>
                            <div class="direction-start">
                                <span class="location-icon pull-left">A</span>

                                <h4 class="pull-left"><span class="a_point"></span>, <span class="b_point"></span></h4>
                                <div class="clearfix"></div>
                            </div>
                            <div class="direction-distance" id="dvDistance"></div>
                            <div class="steps-list" id="dvPanel">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 nopadding" id="rightp">
                <div class="direction-toggle"></div>
                <div id="map"></div>
<!--                <div class="map-popup">
                    <div class="header">
                        <div class="arrow-up"></div>
                        <h4 class="uppercase">Dealership Details </h4>
                        <span class="close"></span>
                    </div>
                    <div class="details">
                        <h4 class="uppercase">coastal caravans & rvS</h4>
                        <div>T: 0401 486 638</div>
                        <div>E: info@dreamseekercaravans.com.au</div>
                        <div>W: www.dreamseekercaravans.com.au</div>
                        <button class="btn btn-default" type="submit">DIRECTIONS</button>
                    </div>
                </div>-->
            </div>
        </div> 
    </div>
 <script src="<?php echo get_template_directory_uri(); ?>/js/jQuery.print.js"></script>
        <script type='text/javascript'>
                                    //<![CDATA[
                                    $(function() {
                                        $('.print-link').on('click', function() {
                                            //Print ele2 with default options
                                            $.print("#dvPanel");
                                        });
                                        $('.print-link2').on('click', function() {
                                            //Print ele2 with default options
                                            $.print("#dvPanel2");
                                        });
//                                        $("#ele4").find('button').on('click', function() {
//                                            //Print ele4 with custom options
//                                            $("#ele4").print({
//                                                //Use Global styles
//                                                globalStyles : false,
//                                                //Add link with attrbute media=print
//                                                mediaPrint : false,
//                                                //Custom stylesheet
//                                                stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
//                                                //Print in a hidden iframe
//                                                iframe : false,
//                                                //Don't print this
//                                                noPrintSelector : ".avoid-this",
//                                                //Add this at top
//                                                prepend : "Hello World!!!<br/>",
//                                                //Add this on bottom
//                                                append : "<br/>Buh Bye!"
//                                            });
//                                        });
                                    });
                                    //]]>
        </script>

    <?php
    get_footer();
    ?>