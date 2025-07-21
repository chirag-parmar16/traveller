<?php
session_start();
error_reporting(0);
include('include/config.php');
?>
<!doctype html>
<html lang="en">
<?php include 'include/header.php'; ?>

<body>
   <div id="page" class="page">
      <?php include 'include/navbar.php'; ?>
      <main id="content" class="site-main">
         <section class="confirm-inner-page">
            <div class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(assets/images/img7.jpg);">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="page-title">Confirmation</h1>
                     </div>
                  </div>
               </div>
            </div>
            <div class="confirmation-outer">
               <div class="container">
                  <?php
                  $bid = $_GET['bid'];
                  $sql = "SELECT * from booking where BookingId=$bid";
                  $query = $dbh->prepare($sql);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  if ($query->rowCount() > 0) {
                     foreach ($results as $result) {
                  ?>
                  <?php }
                  } ?>
                  <div class="success-notify">
                     <div class="success-icon">
                        <i class="fas fa-check"></i>
                     </div>
                     <div class="success-content">
                        <h3>UNDER PROCESS</h3>
                        <p>Thank you, your payment has been successful and your booking is now confirmed. A confirmation email has been sent to <?php echo htmlentities($result->Email); ?></p>
                     </div>
                  </div>
                  <div class="confirmation-inner">
                     <div class="row">
                        <div class="col-lg-9 right-sidebar">
                           <div id="boarding-pass" class="boarding-pass-container">
                              <div class="boarding-pass-header">
                                 <img src="assets/images/site-logo1.png" alt="Site Logo" class="boarding-pass-logo">
                                 <div class="boarding-pass-title-wrapper">
                                    <h2 class="boarding-pass-title">Booking Confirmation</h2>
                                    <p class="boarding-pass-id">Booking ID: <strong>QSD-8DE-A<?php echo htmlentities($result->BookingId); ?></strong></p>
                                 </div>
                              </div>
                              <div class="boarding-pass-body">
                                 <div class="boarding-pass-left-column">
                                    <h3>Passenger Information</h3>
                                    <p><strong>Name:</strong> <?php echo htmlentities($result->FirstName); ?></p>
                                    <p><strong>Email:</strong> <?php echo htmlentities($result->Email); ?></p>
                                    <p><strong>Phone:</strong> <?php echo htmlentities($result->Phone); ?></p>
                                    <p><strong>Address:</strong> <?php echo htmlentities($result->StreetLine1); ?>, <?php echo htmlentities($result->StreetLine2); ?></p>

                                    <!-- Flight Image Below Passenger Information -->
                                    <div class="boarding-pass-flight-image">
                                       <img id="random-image" src="" alt="Random Image" class="flight-image">
                                    </div>
                                    <!-- Separate QR Code Section -->
                                    <div class="qr-code-section">
                                       <h4>Your QR Code</h4>
                                       <div id="qrcode"></div> <!-- QR code will appear here -->
                                    </div>
                                 </div>

                                 <div class="boarding-pass-middle-column">
                                    <h3>Package Information</h3>
                                    <?php
                                    $bid = $_GET['bid'];
                                    $pid = $_GET['pkgid'];

                                    // Combine queries using JOIN to fetch booking and package details
                                    $sql = "SELECT 
            b.BookingId, 
            b.FirstName, 
            b.Email, 
            b.Phone, 
            b.StreetLine1, 
            b.StreetLine2, 
            t.PackageName, 
            t.PackageDetails, 
            t.PackageImage, 
            t.PackageLocation, 
            t.PackageType ,
            t.PackagePrice
            
        FROM booking b 
        LEFT JOIN tbltourpackages t 
        ON b.PackageId = t.PackageId 
        WHERE b.BookingId = :bid AND t.PackageId = :pid";

                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':bid', $bid, PDO::PARAM_INT);
                                    $query->bindParam(':pid', $pid, PDO::PARAM_INT);
                                    $query->execute();

                                    $result = $query->fetch(PDO::FETCH_OBJ);

                                    // Ensure $result is valid
                                    if ($result) {
                                       $packageName = $result->PackageName ?? "Package Not Found";
                                       $packageDetails = $result->PackageDetails ?? "No details available.";
                                       $packageImage = $result->PackageImage ?? "default.jpg";
                                       $packageLocation = $result->PackageLocation ?? "Location not specified";
                                       $packageType = $result->PackageType ?? "Type not specified";
                                       $price = $result->PackagePrice ?? "Price not specified";



                                       // Limit package details to the first sentence
                                       $sentences = explode('.', $packageDetails);
                                       $limitedDetails = $sentences[0] . '.';
                                    } else {
                                       // Fallback in case no results are found
                                       $packageName = "Package Not Found";
                                       $limitedDetails = "No details available.";
                                       $packageImage = "default.jpg";
                                       $packageLocation = "Location not specified";
                                       $packageType = "Type not specified";
                                       $price = "Price not specified";
                                       $paymentStatus = "Payment status not available";
                                    }
                                    ?>


                                    <figure class="single-package-image">
                                       <img src="admin/packageimages/<?php echo htmlentities($packageImage); ?>" alt="Package Image">
                                    </figure>
                                    <p><strong>Package Name:</strong> <?php echo htmlentities($packageName); ?></p>
                                    <p><strong>Package Location:</strong> <?php echo htmlentities($packageLocation); ?></p>
                                    <p><strong>Package Type:</strong> <?php echo htmlentities($packageType); ?></p>
                                    <p><strong>Package Details:</strong> <?php echo htmlentities($limitedDetails); ?></p>
                                    <p><strong>Package Price:</strong> ₹<?php echo htmlentities($price); ?></p>

                                    <h4>Package Features:</h4>
                                    <ul>
                                       <li>
                                          <i aria-hidden="true" class="fas fa-dot-circle"></i>
                                          <span>DAY 1:</span>
                                          Free pickup and drop facility.
                                       </li>
                                       <li>
                                          <i aria-hidden="true" class="fas fa-dot-circle"></i>
                                          <span>DAY 2:</span>
                                          Visit the main museums and lunch included
                                       </li>
                                       <li>
                                          <i aria-hidden="true" class="fas fa-dot-circle"></i>
                                          <span>DAY 3:</span>
                                          Excursion in the natural oasis and picnic
                                       </li>
                                       <li>
                                          <i aria-hidden="true" class="fas fa-dot-circle"></i>
                                          <span>DAY 4:</span>
                                          Transfer to the airport and return to the agency
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <br><br><br><br>
                              <?php
                              $bid = $_GET['bid'];
                              $sql = "SELECT * from booking where BookingId=$bid";
                              $query = $dbh->prepare($sql);
                              $query->execute();
                              $results = $query->fetchAll(PDO::FETCH_OBJ);
                              if ($query->rowCount() > 0) {
                                 foreach ($results as $result) {
                                    $bookingDate = $result->BookingDate;
                                    $travelExpiredDate = date('Y-m-d', strtotime($bookingDate . ' + 4 days'));

                                    // Generate random check-in time between 12:00 PM and 6:00 PM
                                    $checkInTime = date('h:i A', rand(strtotime('12:00 PM'), strtotime('6:00 PM')));

                                    // Generate random check-out time between 10:00 AM and 2:00 PM
                                    $checkOutTime = date('h:i A', rand(strtotime('10:00 AM'), strtotime('2:00 PM')));

                                    $hotelName = 'Hotel Paradise';
                                    $hotelLocation = $result->PackageLocation;

                                    // Additional Info (dummy)
                                    $bookingStatus = 'Confirmed'; 
                                    $paymentStatus = 'Paid'; 

                                    $roomType = 'Deluxe Room'; 
                                    $hotelAmenities = ['Free Wi-Fi', 'Swimming Pool', 'Spa', 'Gym', 'Parking'];
                              ?>
                                    <!-- Booking Details -->
                                    <div class="booking-details-container">
                                       <div class="booking-info">
                                          <p><strong>Booking Date:</strong> <?php echo date("F j, Y", strtotime($bookingDate)); ?></p>
                                          <p><strong>Travel Expired Date:</strong> <?php echo date("F j, Y", strtotime($travelExpiredDate)); ?></p>
                                          <p><strong>Booking Status:</strong> <?php echo $bookingStatus; ?></p>
                                          <p><strong>Payment Status:</strong> <?php echo $paymentStatus; ?></p>
                                       </div>

                                       <div class="hotel-info">
                                          <p><strong>Hotel:</strong> <?php echo htmlentities($hotelName); ?>, <?php echo htmlentities($packageLocation); ?></p>
                                          <p><strong>Check-in Time:</strong> <?php echo htmlentities($checkInTime); ?></p>
                                          <p><strong>Check-out Time:</strong> <?php echo htmlentities($checkOutTime); ?></p>
                                          <p><strong>Room Type:</strong> <?php echo htmlentities($roomType); ?></p>
                                          <p><strong>Amenities:</strong> <?php echo implode(', ', $hotelAmenities); ?></p>
                                       </div>
                                    </div>

                                    <!-- Notice Board -->
                                    <div class="notice-board-container">
                                       <div class="notice-board">
                                          <h3>Important Notice</h3>
                                          <ul>
                                             <li><strong>Booking Confirmation:</strong> Please ensure your booking is confirmed before arrival. Check your email for the booking confirmation details.</li>
                                             <li><strong>Check-in Time:</strong> Our standard check-in time is <?php echo $checkInTime; ?>. Early check-ins are subject to room availability. Kindly inform us in advance if you plan to arrive earlier.</li>
                                             <li><strong>Check-out Time:</strong> The check-out time is <?php echo $checkOutTime; ?>. Late check-outs may incur additional charges. Please arrange your departure accordingly.</li>
                                             <li><strong>Hotel Reach-out:</strong> For any questions or assistance during your stay, feel free to contact our front desk at the hotel or call our customer service hotline at 1-800-123-4567.</li>
                                             <li><strong>Missed Reach-out:</strong> If you miss contacting the hotel prior to your arrival or fail to show up during your travel period, your booking may be reassigned to other travelers. Please ensure you arrive or communicate with the hotel in advance to confirm your arrival.</li>
                                             <li><strong>Limited Travel Period:</strong> The travel period is limited to the dates mentioned in your booking. If you do not show up within the designated travel dates, we will not be able to extend your travel dates. Please plan your stay within the given timeframe to avoid losing your booking.</li>
                                             <li><strong>Hotel Location:</strong> Our hotel is located in the heart of the city. Visit the front desk for local maps, transportation details, and sightseeing recommendations.</li>
                                             <li><strong>Special Requests:</strong> If you have any special requests (e.g., extra bedding, dietary restrictions), kindly inform us at the time of booking or at least 24 hours prior to check-in.</li>
                                             <li><strong>Stay Safe:</strong> Please follow all safety and health protocols during your stay. Your well-being is our top priority.</li>
                                          </ul>
                                       </div>
                                    </div>

                                    <style>
                                       .booking-details-container {
                                          display: flex;
                                          justify-content: space-between;
                                          margin: 8px 0;
                                          padding: 20px;
                                          background-color: #f9f9f9;
                                          border-radius: 10px;
                                          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                          font-family: Arial, sans-serif;
                                       }

                                       .booking-info,
                                       .hotel-info {
                                          width: 48%;
                                          padding: 20px;
                                          background-color: #fff;
                                          border-radius: 8px;
                                          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                       }

                                       .booking-info p,
                                       .hotel-info p {
                                          font-size: 16px;
                                          line-height: 1.6;
                                          color: #333;
                                          margin-bottom: 10px;
                                       }

                                       .booking-info p strong,
                                       .hotel-info p strong {
                                          color: #333;
                                          font-weight: bold;
                                       }

                                       .notice-board-container {
                                          margin: 10px 0;
                                          padding: 20px;
                                          background-color: #f0f0f0;
                                          border-radius: 10px;
                                          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                          font-family: Arial, sans-serif;
                                       }

                                       .notice-board {
                                          background-color: #fff;
                                          padding: 20px;
                                          border-radius: 8px;
                                          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                       }

                                       .notice-board h3 {
                                          font-size: 24px;
                                          color: #333;
                                          margin-bottom: 15px;
                                          text-align: center;
                                       }

                                       .notice-board ul {
                                          list-style-type: none;
                                          padding: 0;
                                       }

                                       .notice-board li {
                                          font-size: 16px;
                                          color: #555;
                                          line-height: 1.6;
                                          margin-bottom: 12px;
                                       }

                                       .notice-board li strong {
                                          color: #333;
                                       }
                                    </style>
                              <?php
                                 }
                              }
                              ?>

                              <div class="boarding-pass-footer">
                                 <h4>Barcode</h4>
                                 <svg id="barcode"></svg>
                                 <p>Thank you for booking with us. Visit <a href="#">traveler.com</a> for more details.</p>
                              </div>

                           </div>
                        </div>
                        <div class="col-lg-3">
                           <div class="price-table-summary">
                              <h4 class="bg-title">Your Ticket</h4>
                              <button id="downloadTicket" class="btn btn-primary">Download Ticket</button>
                           </div>
                           <div class="widget-bg widget-support-wrap">
                              <div class="icon">
                                 <i class="fas fa-phone-volume"></i>
                              </div>
                              <div class="support-content">
                                 <h5>HELP AND SUPPORT</h5>
                                 <a href="telto:12345678" class="phone">+91 8126XXXXXX</a>
                                 <small>Monday to Friday 9.00am - 7.30pm</small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>
      <?php include 'include/footer.php'; ?>
      <a id="backTotop" href="#" class="to-top-icon">
         <i class="fas fa-chevron-up"></i>
      </a>
      <?php include 'include/custom_search.php'; ?>
   </div>
   <?php include 'include/javascript.php'; ?>

   <!-- Include jQuery and the other libraries -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
   <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

   <script>
      $(document).ready(function() {
         // Replace the BookingId dynamically from PHP
         var bookingId = "<?php echo htmlentities($result->BookingId); ?>";

         // Generate Barcode for Booking ID
         JsBarcode("#barcode", "QSD-8DE-A" + bookingId, {
            format: "CODE128",
            width: 2,
            height: 40,
            displayValue: true
         });

         // Generate QR Code for Booking ID using QRCode.js
         new QRCode(document.getElementById("qrcode"), {
            text: "QSD-8DE-A" + bookingId,
            width: 245, // QR Code width
            height: 245, // QR Code height
            colorDark: "#000000", // QR code dark color
            colorLight: "#ffffff", // QR code light color
            correctLevel: QRCode.CorrectLevel.H // Error correction level (L, M, Q, H)
         });
      });
   </script>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
   <script>
      document.getElementById('downloadTicket').addEventListener('click', function() {
         // Extract the ticket content
         const ticketContent = document.getElementById('boarding-pass').outerHTML;

         // Extract stylesheets linked in the main document
         const stylesheets = Array.from(document.styleSheets)
            .map(sheet => {
               try {
                  return Array.from(sheet.cssRules)
                     .map(rule => rule.cssText)
                     .join('');
               } catch (e) {
                  return ''; // Skip inaccessible stylesheets (like cross-origin)
               }
            })
            .join('');

         // Create a container to merge styles and content for the PDF
         const container = document.createElement('div');
         container.innerHTML = `
      <style>
        ${stylesheets} /* Inline styles from the main document */
        body {
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 0;
          background-color: #f4f4f4; /* Match the background color of the boarding pass */
          background-image: linear-gradient(to right, #f4f4f4, #fff); /* Match the gradient */
        }
        #boarding-pass {
          max-width: 1000px;
          margin: 0 auto;
          border: 1px solid #ddd;
          border-radius: 10px;
          padding: 20px;
          background-color: #fff; /* Keep the boarding pass background white */
        }
        .boarding-pass-header {
          text-align: center;
          margin-bottom: 20px;
        }
        .boarding-pass-header img {
          max-width: 250px;
          margin-bottom: 10px;
        }
        .boarding-pass-body h3 {
          margin-top: 20px;
        }
        .boarding-pass-footer {
          text-align: center;
          margin-top: 20px;
          font-size: 0.8em;
        }
      </style>
      ${ticketContent}
    `;

         // Use html2pdf to generate the PDF
         html2pdf()
            .from(container)
            .set({
               filename: 'BoardingPass.pdf',
               html2canvas: {
                  scale: 2
               },
               jsPDF: {
                  unit: 'mm',
                  format: 'a4',
                  orientation: 'portrait',
                  background: '#f4f4f4', // Set background color for the entire PDF page
               },
            })
            .save();
      });
   </script>

   <script>
      // Array of image options
      const images = ["assets/images/flight.png", "assets/images/hotel.png"];

      // Select a random image
      const randomImage = images[Math.floor(Math.random() * images.length)];

      // Set the image src attribute
      document.getElementById("random-image").src = randomImage;
   </script>

   <style>
      /* Enhanced Styling for Realistic Boarding Pass */
      .boarding-pass-container {
         background: #fff;
         border: 3px solid #aaa;
         padding: 30px;
         border-radius: 12px;
         font-family: 'Arial', sans-serif;
         box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
         max-width: 1800px;
         margin: 0 auto;
         background-image: linear-gradient(to right, #f4f4f4, #fff);
         position: relative;
      }

      .boarding-pass-header {
         display: flex;
         justify-content: space-between;
         /* Space logo and title/ID evenly */
         align-items: center;
         /* Vertically align all elements */
         border-bottom: 3px solid #ccc;
         margin-bottom: 25px;
         padding-bottom: 15px;
      }

      .boarding-pass-logo {
         max-width: 250px;
         /* Adjust logo size for balance */
         height: auto;
         /* Maintain aspect ratio */
      }

      .boarding-pass-title-wrapper {
         text-align: right;
         /* Align all title content to the right */
         max-width: 70%;
         /* Ensure title stays within a reasonable width */
      }

      .boarding-pass-title {
         font-size: 24px;
         /* Adjust font size for better readability */
         font-weight: bold;
         color: #333;
         margin: 0;
      }

      .boarding-pass-id {
         font-size: 14px;
         /* Smaller size for the Booking ID */
         color: #555;
         margin-top: 5px;
         /* Add some space below the title */
      }

      .boarding-pass-body {
         display: flex;
         justify-content: space-between;
         margin-top: 20px;
         gap: 25px;
         padding-bottom: 5px;
      }

      .boarding-pass-left-column {
         width: 48%;
         border-right: 2px solid #ccc;
         /* Add this line for the vertical border */
         padding-right: 15px;
         /* Add padding to give space between text and the border */
      }

      .boarding-pass-middle-column {
         width: 48%;
      }


      .boarding-pass-left-column p,
      .boarding-pass-middle-column p {
         font-size: 16px;
         line-height: 1.6;
         color: #555;
      }

      .boarding-pass-flight-image {
         text-align: center;
         margin-top: 20px;
      }

      .flight-image {
         width: 80%;
         max-width: 350px;
         border-radius: 8px;
      }

      .boarding-pass-footer {
         text-align: center;
         margin-top: 30px;
         font-size: 18px;
         padding-top: 20px;
         border-top: 3px solid #ccc;
         color: #444;
      }

      .btn-primary {
         background-color: #86b817;
         ;
         color: white;
         border: none;
         padding: 15px 30px;
         border-radius: 25px;
         font-size: 18px;
         cursor: pointer;
         display: block;
         width: 100%;
         margin-top: 20px;
      }

      .btn-primary:hover {
         background-color: #005f72;
      }

      /* Style for the package features list (ul) */
      .boarding-pass-middle-column ul {
         list-style: none;
         /* Remove default list bullets */
         padding: 0;
         margin: 0;
         font-size: 16px;
         line-height: 1.6;
         color: #555;
      }

      .boarding-pass-middle-column ul li {
         display: flex;
         /* Align items horizontally */
         align-items: center;
         /* Vertically align the items */
         margin-bottom: 15px;
         /* Space between list items */
      }

      .boarding-pass-middle-column ul li i {
         font-size: 18px;
         /* Icon size */
         color: #008cba;
         /* Icon color to match the brand color */
         margin-right: 10px;
         /* Space between the icon and the text */
      }

      .boarding-pass-middle-column ul li span {
         font-weight: bold;
         /* Make the day label bold */
         color: #333;
         /* Darker color for the day label */
      }

      .boarding-pass-middle-column ul li p {
         margin: 0;
         /* Remove extra margin for the text */
         color: #666;
         /* Light gray for the description */
      }

      /* Style for the package features list (ul) */
      .boarding-pass-middle-column ul {
         list-style: none;
         /* Remove default list bullets */
         padding: 0;
         margin: 0;
         font-size: 14px;
         /* Smaller font size */
         line-height: 1.4;
         /* Adjust line height for better compactness */
         color: #555;
         /* Default text color */
      }

      .boarding-pass-middle-column ul li {
         display: flex;
         /* Align items horizontally */
         align-items: center;
         /* Vertically align the items */
         margin-bottom: 10px;
         /* Reduced space between list items */
         font-weight: normal;
         /* Normal font weight for better readability */
      }

      .boarding-pass-middle-column ul li i {
         font-size: 14px;
         /* Smaller icon size */
         color: #008cba;
         /* Icon color */
         margin-right: 8px;
         /* Reduced space between icon and text */
      }

      .boarding-pass-middle-column ul li span {
         font-weight: bold;
         /* Bold the day label */
         color: #333;
         /* Dark color for day label */
         margin-right: 5px;
         /* Slightly reduced space */
      }

      .boarding-pass-middle-column ul li p {
         margin: 0;
         /* Remove extra margin for text */
         color: #666;
         /* Lighter color for description */
         font-size: 13px;
         /* Smaller font size for descriptions */
      }
   </style>
</body>

</html>