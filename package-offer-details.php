<?php
session_start();
error_reporting(0);
?>
<!doctype html>
<html lang="en">
<?php include 'include/header.php'; ?>
<?php
require_once 'api.php'; // Import API keys

// Use the keys
$unsplashApiKey = UNSPLASH_API_KEY;
$googleMapsApiKey = GOOGLE_MAPS_API_KEY;
?>
<body>
   <div id="page" class="page">
      <!-- ***site header html start*** -->
      <?php include 'include/navbar.php'; ?>
      <!-- ***site header html end*** -->
      <main id="content" class="site-main">
         <section class="package-inner-page">
            <!-- ***Inner Banner html start form here*** -->
            <div class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(assets/images/img7.jpg);">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="page-title">Offer Deatil</h1>
                     </div>
                  </div>
               </div>
            </div>
            <!-- ***Inner Banner html end here*** -->
            <!-- ***career section html start form here*** -->
            <div class="inner-package-detail-wrap">
               <div class="container">
                  <?php
                  include('admin/includes/config.php');
                  $pkgid = $_GET['pkgid'];
                  // echo $pkgid;
                  $sql = "SELECT * from packageoffer where OfferId = $pkgid";
                  $query = $dbh->prepare($sql);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                     foreach ($results as $result) {
                        //   print_r($result);
                     }
                  }
                  ?>
                  <div class="row">
                     <div class="col-lg-8 primary right-sidebar">
                        <div class="single-packge-wrap">
                           <div class="single-package-head d-flex align-items-center">
                              <div class="package-title">
                                 <h2><?php echo htmlentities($result->OfferName); ?></h2>
                                 <div class="rating-start-wrap">
                                    <div class="rating-start">
                                       <span style="width: 80%"></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="package-price">
                                 <h6 class="price-list">
                                    <span style="font-size: 25px;">Price:
                                       <del>₹<?php echo htmlentities($result->ActualPrice); ?></del>
                                       <ins>₹<?php echo htmlentities($result->OfferPrice); ?></ins>
                                       <?php if ($_SESSION['email']) { ?>
                                          <a href="booking.php" class="outline-btn outline-btn-blue" style="margin-top: 15px;">Book now</a>
                                       <?php } else { ?>
                                          <a href="sign-in.php" class="outline-btn outline-btn-blue" style="margin-top: 15px;">Book now</a>
                                       <?php } ?>
                                    </span>
                                 </h6>
                              </div>
                           </div>
                           <div class="package-meta">
                              <ul>
                                 <li>
                                    <i class="fas fa-clock"></i>
                                    7D/6N
                                 </li>
                                 <li>
                                    <div class="offer-badge">
                                       UPTO <span><?php echo htmlentities($result->PercentageOff); ?></span> off
                                    </div>
                                 <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo htmlentities($result->OfferLocation); ?>
                                 </li>
                              </ul>
                           </div>
                           <figure class="single-package-image">
                              <img src=admin/offerimages/<?php echo htmlentities($result->OfferImage); ?> alt="">
                           </figure>
                           <div class="package-content-detail">
                              <article class="package-overview">
                                 <h3>OVERVIEW :</h3>
                                 <p><?php echo htmlentities($result->OfferDetails); ?></p>
                              </article>
                              <article class="package-include bg-light-grey">
                                 <h3>INCLUDE & EXCLUDE :</h3>
                                 <ul>
                                    <li><i class="fas fa-check"></i>Specialized bilingual guide</li>
                                    <li><i class="fas fa-times"></i>Guide Service Fee</li>
                                    <li><i class="fas fa-check"></i>Private Transport</li>
                                    <li><i class="fas fa-times"></i>Room Service Fees</li>
                                    <li><i class="fas fa-check"></i>Entrance Fees</li>
                                    <li><i class="fas fa-times"></i>Driver Service Fee</li>
                                    <li><i class="fas fa-check"></i>Breakfast And Lunch Box</li>
                                    <li><i class="fas fa-times"></i>Any Private Expenses</li>
                                 </ul>
                              </article>
                              <article class="package-ininerary">
                                 <h3>ITINERARY :</h3>
                                 <p>Malesuada incidunt excepturi proident quo eros? Id interdum praesent magnis, eius cumque? Integer aptent officiis recusandae habitasse iure, quisque culpa!</p>
                                 <ul>
                                    <li>
                                       <i aria-hidden="true" class="fas fa-dot-circle"></i>
                                       <span>DAY 1</span>
                                       Free pickup and drop facility.
                                    </li>
                                    <li>
                                       <i aria-hidden="true" class="fas fa-dot-circle"></i>
                                       <span>DAY 2</span>
                                       Visit the main museums and lunch included
                                    </li>
                                    <li>
                                       <i aria-hidden="true" class="fas fa-dot-circle"></i>
                                       <span>DAY 3</span>
                                       Excursion in the natural oasis and picnic
                                    </li>
                                    <li>
                                       <i aria-hidden="true" class="fas fa-dot-circle"></i>
                                       <span>DAY 4</span>
                                       Transfer to the airport and return to the agency
                                    </li>
                                 </ul>
                              </article>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="sidebar">
                           <div class="related-package">
                              <h3>RELATED IMAGES</h3>
                              <p>Quaerat inventore! Vestibulum aenean volutpat gravida. Sagittis, euismod perferendis.</p>
                              <div class="related-package-slide">
                                 <?php
                                 // Fetch the location from your database
                                 $location = $result->OfferName; // Example: "New York City"

                                 // Use urlencode to handle spaces and special characters
                                 $encodedLocation = urlencode($location);

                                 // Unsplash API endpoint with your API Key
                                
                                 $url = "https://api.unsplash.com/search/photos?query={$encodedLocation}&client_id={$unsplashApiKey}&per_page=3";


                                 // Fetch the API response
                                 $response = file_get_contents($url);
                                 $data = json_decode($response);

                                 // Check if the response contains images
                                 if (isset($data->results)) {
                                    foreach ($data->results as $image) {
                                       // Display each image in the carousel
                                       echo '<div class="related-package-item">';
                                       echo '<img src="' . htmlentities($image->urls->regular) . '" alt="Related Image">';
                                       echo '</div>';
                                    }
                                 } else {
                                    // If no images are found, display default images
                                    echo '<div class="related-package-item"><img src="assets/images/img1.jpg" alt="Default Image"></div>';
                                    echo '<div class="related-package-item"><img src="assets/images/img2.jpg" alt="Default Image"></div>';
                                    echo '<div class="related-package-item"><img src="assets/images/img3.jpg" alt="Default Image"></div>';
                                 }
                                 ?>
                              </div>
                           </div>

                           <div class="package-map">
                              <?php
                              // Fetch the location for the map
                              $location = htmlentities($result->OfferName);
                              $mapQuery = urlencode($location); // Properly encode the location to handle spaces and special characters

                              $mapUrl = "https://www.google.com/maps/embed/v1/place?key={$googleMapsApiKey}&q={$mapQuery}";

                              ?>
                              <iframe src="<?php echo $mapUrl; ?>" width="600" height="320" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                           </div>
                           <div class="package-list">
                              <div class="overlay"></div>
                              <h4>MORE PACKAGES</h4>
                              <ul>
                                 <li>
                                    <a href="#"><i aria-hidden="true" class="icon icon-arrow-right-circle"></i>Vacation Packages</a>
                                 </li>
                                 <li>
                                    <a href="#"><i aria-hidden="true" class="icon icon-arrow-right-circle"></i>Homeymoon Packages</a>
                                 </li>
                                 <li>
                                    <a href="#"><i aria-hidden="true" class="icon icon-arrow-right-circle"></i>New Year Packages</a>
                                 </li>
                                 <li>
                                    <a href="#"><i aria-hidden="true" class="icon icon-arrow-right-circle"></i>Weekend Packages</a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- ***career section html start form here*** -->
         </section>
      </main>
      <?php include 'include/footer.php'; ?>
      <a id="backTotop" href="#" class="to-top-icon">
         <i class="fas fa-chevron-up"></i>
      </a>
      <!-- ***custom search field html*** -->
      <?php include 'include/custom_search.php'; ?>
      <!-- ***custom search field html*** -->

   </div>

   <!-- JavaScript -->
   <?php
   include 'include/javascript.php';
   ?>
</body>

</html>