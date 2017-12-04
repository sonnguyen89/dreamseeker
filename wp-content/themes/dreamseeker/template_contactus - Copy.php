  <?php
/*
  Template Name: Contact us
 */
get_header();
global $post;
?> 
  

 <!-- Second Navigation
    ================================================== -->
    <nav class="navbar navbar-inverse navbar-top second-navbar hidden-xs" role="navigation">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse navbar-second">
            <?php wp_nav_menu(array(
                'theme_location' => 'sub-menu-dream',
                'menu_class'     => 'nav navbar-nav navbar-right'
            )); ?>
        </div>
      </div>
    </nav>
   
 
    <!-- Contact Us  Hero Image
    ================================================== -->
    <div class="range-heroimg" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/range-heroimg.jpg');">
        <div class="container ">
            <div class="row">
                <h1>Contact Us</h1>
            </div>
        </div> 
    </div>
    
    <div class="contact-us">
        <div class="container ">
            <div class="row">
                <div class="col-md-8 contact-left">
                    <div class="col-md-12">
                        <h2>Enquiry</h2>
                    </div>
                    <form>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Phone">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Postcode">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Chassis Number">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Dealer">
                        </div>
                        <div class="form-group col-md-6">
                            <select name="test" class="form-control" id="hereus">
                                <option value="SelectBoxIt is:">Caravan World</option>
                                <option value="a jQuery Plugin">On The Road Magazine</option>
                                <option value="a Select Box Replacement">Facebook</option>
                                <option value="a Stateful UI Widget">Google</option>
                                <option value="a Stateful UI Widget">Friend</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <select name="test" class="form-control" >
                                <option value="SelectBoxIt is:">General</option>
                                <option value="a jQuery Plugin">Feedback</option>
                                <option value="a Select Box Replacement">Warranty</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-default">Submit</button></div>
                    </form>
                </div>
                <div class="col-md-4 contact-right">
                    <h2>CONTACT US</h2>
                    <div class="contact-itm">
                        <h5>FIND A DEALERSHIP</h5>
                        <p>For any product enquires or question
    please contact your nearest dealer</p>
                        <a>DEALER LOCATOR ></a>
                    </div>
                    <div class="contact-itm">
                        <h5>FIND A DEALERSHIP</h5>
                        <p>Please contact our Dreamseeker Customer Care team memeber customer enquiries or general enquiries </p>
                        <div>Call: 0401 486 638</div>
                        <div>8:30am - 4:00pm EST Monday to Friday </div>
                        <div>Email: <a href="#">enquiries@dreamseekercaravans.com.au</a></div>
                    </div>
                    <div class="contact-itm">
                        <h5>POSTAL ADDRESS  </h5>
                        <div>Dreamseeker Caravans</div>
                        <div>Customer Care Manager</div>
                        <div>24 Grasslands Avenue Craigieburn,</div>
                        <div>VIC 3064</div>
                    </div>
                </div>
             </div>
        </div>
    </div>
    
    <!-- Locate us on Map
    ================================================== -->
    <div class="range-viewmore" >
        <div class="container ">
            <div class="row scroll">
                <a href="#" class="uppercase">LOCATE US ON MAP &nbsp; <i class="fa fa-angle-down fa-2x"></i></a>
            </div>
        </div> 
    </div>
    
     <!-- Location Map
    ================================================== -->
    <div class="location-map" >
       <div id="map"></div>
    </div>
<?php
get_footer();
?>