<?php
session_start();
error_reporting(0);
include('db/config.php');
if (isset($_POST['submit'])) {
   $pid = intval($_GET['pkgid']);
   $bname = $_POST['fullname'];
   $bemail = $_POST['email'];
   $bmobile = $_POST['mobile'];
   $bnameoncard = $_POST['nameoncard'];
   $bcard_number = $_POST['card_number'];
   $bexpire_month = $_POST['expire_month'];
   $bexpire_year = $_POST['expire_year'];
   $bcvv = $_POST['cvv'];
   $bcountry = $_POST['country'];
   $bstreet_1 = $_POST['street_1'];
   $bstreet_2 = $_POST['street_2'];
   $bcity = $_POST['city'];
   $bstate = $_POST['state'];
   $bpincode = $_POST['pincode'];
   $badditional_information = $_POST['additional_information'];
   $bbooking_date = $_POST['booking_date']; // Capture the booking date
   $status = 0;

   $sql = "INSERT INTO booking(PackageId,FirstName,Email, Phone, NameOnCard, CardNumber, ExpMonth, ExpYear, CVV, Country, StreetLine1, StreetLine2, City, State1, Pincode, Additional_Information, BookingDate, status) 
           VALUES('$pid','$bname','$bemail', '$bmobile', '$bnameoncard', '$bcard_number', '$bexpire_month', '$bexpire_year', '$bcvv', '$bcountry', '$bstreet_1', '$bstreet_2', '$bcity', '$bstate', '$bpincode', '$badditional_information', '$bbooking_date', '$status')";

   if ($conn->query($sql) === TRUE) {
      $lastInsertId = $conn->insert_id;

      if ($lastInsertId) {
         echo "<script>
                alert('Booking Successful 😊');
                window.location.href='confirmation.php?bid=$lastInsertId&pkgid=" . htmlentities($pid) . "';
                </script>";
      } else {
         $error = "Something went wrong. Please try again";
      }
   } else {
      $error = "Error: " . $sql . "<br>" . $conn->error;
   }
}

?>

<!doctype html>
<html lang="en">
<?php include 'include/header.php'; ?>

<body>
   <div id="page" class="page">
      <!-- ***site header html start*** -->
      <?php include 'include/navbar.php'; ?>
      <main id="content" class="site-main">
         <section class="booking-inner-page">
            <!-- ***Inner Banner html start form here*** -->
            <div class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(assets/images/img7.jpg);">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="page-title">Booking</h1>
                     </div>
                  </div>
               </div>
            </div>
            <!-- ***Inner Banner html end here*** -->
            <div class="booking-section">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-8 right-sidebar">
                        <!-- step one form html start -->
                        <div class="booking-form-wrap">
                           <form method="POST" action="">
                              <div class="booking-content">
                                 <div class="form-title">
                                    <span>1</span>
                                    <h3>Your Details</h3>
                                 </div>
                                 <div class="row">

                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label>Full Name*</label>
                                          <input type="text" class="form-control" name="fullname" id="fullname" required>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <?php
                                       include('include/config.php');
                                       $id = $_SESSION['id'];
                                       $sql = "SELECT email from users where id=$id";
                                       $query = $dbh->prepare($sql);
                                       $query->execute();
                                       $results = $query->fetchAll(PDO::FETCH_OBJ);
                                       $cnt = 1;
                                       if ($query->rowCount() > 0) {
                                          foreach ($results as $result) {
                                             //   print_r($result); 
                                       ?>
                                       <?php }
                                       } ?>

                                       <div class="form-group">
                                          <label>Email*</label>
                                          <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlentities($result->email); ?>" readonly>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label>Phone*</label>
                                          <input type="text" class="form-control" name="mobile" id="mobile" required>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label>Travel Booking Date*</label>
                                          <input type="date" class="form-control" name="booking_date" id="booking_date" required>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="booking-content">
                                 <div class="form-title">
                                    <span>2</span>
                                    <h3>Payment Information</h3>
                                 </div>
                                 <div class="row">
                                    <div class="col-12">
                                       <div class="form-group">
                                          <label>Name on card*</label>
                                          <input type="text" class="form-control" name="nameoncard" id="nameoncard" required>
                                       </div>
                                    </div>
                                    <div class="col-12">
                                       <div class="row align-items-center">
                                          <div class="col-sm-6">
                                             <div class="form-group">
                                                <label>Card number*</label>
                                                <input type="text" name="card_number" id="card_number" class="form-control"
                                                   minlength="16" maxlength="16" required>
                                             </div>
                                          </div>
                                          <div class="col-sm-6">
                                             <img src="assets/images/cards.png" alt="Cards">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-12">
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Expiration date*</label>
                                                <div class="row">
                                                   <div class="col-md-6">
                                                      <input type="text" name="expire_month" id="expire_month" class="form-control" placeholder="MM" minlength="1" maxlength="2" required>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <input type="number" name="expire_year" id="expire_year" class="form-control" placeholder="Year" min="2023" max="3000" required>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Security code*</label>
                                                <div class="row">
                                                   <div class="col-4">
                                                      <div class="form-group">
                                                         <input type="text" name="ccv" id="ccv" class="form-control" placeholder="CCV" minlength="3" maxlength="3" required>
                                                      </div>
                                                   </div>
                                                   <div class="col-8">
                                                      <img src="assets/images/icon_ccv.gif" alt="ccv"><small>Last 3 digits</small>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="booking-content">
                                 <div class="form-title">
                                    <span>3</span>
                                    <h3>Billing Address</h3>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="form-group">
                                          <label>Country*</label>
                                          <select name="country" id="country" required>
                                             <option value="" selected>Select your country</option>
                                             <!-- List of all 195 countries -->
                                             <option value="Afghanistan">Afghanistan</option>
                                             <option value="Albania">Albania</option>
                                             <option value="Algeria">Algeria</option>
                                             <option value="Andorra">Andorra</option>
                                             <option value="Angola">Angola</option>
                                             <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                             <option value="Argentina">Argentina</option>
                                             <option value="Armenia">Armenia</option>
                                             <option value="Australia">Australia</option>
                                             <option value="Austria">Austria</option>
                                             <option value="Azerbaijan">Azerbaijan</option>
                                             <option value="Bahamas">Bahamas</option>
                                             <option value="Bahrain">Bahrain</option>
                                             <option value="Bangladesh">Bangladesh</option>
                                             <option value="Barbados">Barbados</option>
                                             <option value="Belarus">Belarus</option>
                                             <option value="Belgium">Belgium</option>
                                             <option value="Belize">Belize</option>
                                             <option value="Benin">Benin</option>
                                             <option value="Bhutan">Bhutan</option>
                                             <option value="Bolivia">Bolivia</option>
                                             <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                             <option value="Botswana">Botswana</option>
                                             <option value="Brazil">Brazil</option>
                                             <option value="Brunei">Brunei</option>
                                             <option value="Bulgaria">Bulgaria</option>
                                             <option value="Burkina Faso">Burkina Faso</option>
                                             <option value="Burundi">Burundi</option>
                                             <option value="Cabo Verde">Cabo Verde</option>
                                             <option value="Cambodia">Cambodia</option>
                                             <option value="Cameroon">Cameroon</option>
                                             <option value="Canada">Canada</option>
                                             <option value="Central African Republic">Central African Republic</option>
                                             <option value="Chad">Chad</option>
                                             <option value="Chile">Chile</option>
                                             <option value="China">China</option>
                                             <option value="Colombia">Colombia</option>
                                             <option value="Comoros">Comoros</option>
                                             <option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
                                             <option value="Congo (Democratic Republic of the Congo)">Congo (Democratic Republic of the Congo)</option>
                                             <option value="Costa Rica">Costa Rica</option>
                                             <option value="Croatia">Croatia</option>
                                             <option value="Cuba">Cuba</option>
                                             <option value="Cyprus">Cyprus</option>
                                             <option value="Czechia (Czech Republic)">Czechia (Czech Republic)</option>
                                             <option value="Denmark">Denmark</option>
                                             <option value="Djibouti">Djibouti</option>
                                             <option value="Dominica">Dominica</option>
                                             <option value="Dominican Republic">Dominican Republic</option>
                                             <option value="Ecuador">Ecuador</option>
                                             <option value="Egypt">Egypt</option>
                                             <option value="El Salvador">El Salvador</option>
                                             <option value="Equatorial Guinea">Equatorial Guinea</option>
                                             <option value="Eritrea">Eritrea</option>
                                             <option value="Estonia">Estonia</option>
                                             <option value="Eswatini (fmr. " Swaziland")">Eswatini (fmr. "Swaziland")</option>
                                             <option value="Ethiopia">Ethiopia</option>
                                             <option value="Fiji">Fiji</option>
                                             <option value="Finland">Finland</option>
                                             <option value="France">France</option>
                                             <option value="Gabon">Gabon</option>
                                             <option value="Gambia">Gambia</option>
                                             <option value="Georgia">Georgia</option>
                                             <option value="Germany">Germany</option>
                                             <option value="Ghana">Ghana</option>
                                             <option value="Greece">Greece</option>
                                             <option value="Grenada">Grenada</option>
                                             <option value="Guatemala">Guatemala</option>
                                             <option value="Guinea">Guinea</option>
                                             <option value="Guinea-Bissau">Guinea-Bissau</option>
                                             <option value="Guyana">Guyana</option>
                                             <option value="Haiti">Haiti</option>
                                             <option value="Honduras">Honduras</option>
                                             <option value="Hungary">Hungary</option>
                                             <option value="Iceland">Iceland</option>
                                             <option value="India">India</option>
                                             <option value="Indonesia">Indonesia</option>
                                             <option value="Iran">Iran</option>
                                             <option value="Iraq">Iraq</option>
                                             <option value="Ireland">Ireland</option>
                                             <option value="Israel">Israel</option>
                                             <option value="Italy">Italy</option>
                                             <option value="Jamaica">Jamaica</option>
                                             <option value="Japan">Japan</option>
                                             <option value="Jordan">Jordan</option>
                                             <option value="Kazakhstan">Kazakhstan</option>
                                             <option value="Kenya">Kenya</option>
                                             <option value="Kiribati">Kiribati</option>
                                             <option value="Korea (North)">Korea (North)</option>
                                             <option value="Korea (South)">Korea (South)</option>
                                             <option value="Kuwait">Kuwait</option>
                                             <option value="Kyrgyzstan">Kyrgyzstan</option>
                                             <option value="Laos">Laos</option>
                                             <option value="Latvia">Latvia</option>
                                             <option value="Lebanon">Lebanon</option>
                                             <option value="Lesotho">Lesotho</option>
                                             <option value="Liberia">Liberia</option>
                                             <option value="Libya">Libya</option>
                                             <option value="Liechtenstein">Liechtenstein</option>
                                             <option value="Lithuania">Lithuania</option>
                                             <option value="Luxembourg">Luxembourg</option>
                                             <option value="Madagascar">Madagascar</option>
                                             <option value="Malawi">Malawi</option>
                                             <option value="Malaysia">Malaysia</option>
                                             <option value="Maldives">Maldives</option>
                                             <option value="Mali">Mali</option>
                                             <option value="Malta">Malta</option>
                                             <option value="Marshall Islands">Marshall Islands</option>
                                             <option value="Mauritania">Mauritania</option>
                                             <option value="Mauritius">Mauritius</option>
                                             <option value="Mexico">Mexico</option>
                                             <option value="Micronesia">Micronesia</option>
                                             <option value="Moldova">Moldova</option>
                                             <option value="Monaco">Monaco</option>
                                             <option value="Mongolia">Mongolia</option>
                                             <option value="Montenegro">Montenegro</option>
                                             <option value="Morocco">Morocco</option>
                                             <option value="Mozambique">Mozambique</option>
                                             <option value="Myanmar (formerly Burma)">Myanmar (formerly Burma)</option>
                                             <option value="Namibia">Namibia</option>
                                             <option value="Nauru">Nauru</option>
                                             <option value="Nepal">Nepal</option>
                                             <option value="Netherlands">Netherlands</option>
                                             <option value="New Zealand">New Zealand</option>
                                             <option value="Nicaragua">Nicaragua</option>
                                             <option value="Niger">Niger</option>
                                             <option value="Nigeria">Nigeria</option>
                                             <option value="North Macedonia (formerly Macedonia)">North Macedonia (formerly Macedonia)</option>
                                             <option value="Norway">Norway</option>
                                             <option value="Oman">Oman</option>
                                             <option value="Pakistan">Pakistan</option>
                                             <option value="Palau">Palau</option>
                                             <option value="Panama">Panama</option>
                                             <option value="Papua New Guinea">Papua New Guinea</option>
                                             <option value="Paraguay">Paraguay</option>
                                             <option value="Peru">Peru</option>
                                             <option value="Philippines">Philippines</option>
                                             <option value="Poland">Poland</option>
                                             <option value="Portugal">Portugal</option>
                                             <option value="Qatar">Qatar</option>
                                             <option value="Romania">Romania</option>
                                             <option value="Russia">Russia</option>
                                             <option value="Rwanda">Rwanda</option>
                                             <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                             <option value="Saint Lucia">Saint Lucia</option>
                                             <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                             <option value="Samoa">Samoa</option>
                                             <option value="San Marino">San Marino</option>
                                             <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                             <option value="Saudi Arabia">Saudi Arabia</option>
                                             <option value="Senegal">Senegal</option>
                                             <option value="Serbia">Serbia</option>
                                             <option value="Seychelles">Seychelles</option>
                                             <option value="Sierra Leone">Sierra Leone</option>
                                             <option value="Singapore">Singapore</option>
                                             <option value="Slovakia">Slovakia</option>
                                             <option value="Slovenia">Slovenia</option>
                                             <option value="Solomon Islands">Solomon Islands</option>
                                             <option value="Somalia">Somalia</option>
                                             <option value="South Africa">South Africa</option>
                                             <option value="South Sudan">South Sudan</option>
                                             <option value="Spain">Spain</option>
                                             <option value="Sri Lanka">Sri Lanka</option>
                                             <option value="Sudan">Sudan</option>
                                             <option value="Suriname">Suriname</option>
                                             <option value="Sweden">Sweden</option>
                                             <option value="Switzerland">Switzerland</option>
                                             <option value="Syria">Syria</option>
                                             <option value="Taiwan">Taiwan</option>
                                             <option value="Tajikistan">Tajikistan</option>
                                             <option value="Tanzania">Tanzania</option>
                                             <option value="Thailand">Thailand</option>
                                             <option value="Timor-Leste">Timor-Leste</option>
                                             <option value="Togo">Togo</option>
                                             <option value="Tonga">Tonga</option>
                                             <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                             <option value="Tunisia">Tunisia</option>
                                             <option value="Turkey">Turkey</option>
                                             <option value="Turkmenistan">Turkmenistan</option>
                                             <option value="Tuvalu">Tuvalu</option>
                                             <option value="Uganda">Uganda</option>
                                             <option value="Ukraine">Ukraine</option>
                                             <option value="United Arab Emirates">United Arab Emirates</option>
                                             <option value="United Kingdom">United Kingdom</option>
                                             <option value="United States of America">United States of America</option>
                                             <option value="Uruguay">Uruguay</option>
                                             <option value="Uzbekistan">Uzbekistan</option>
                                             <option value="Vanuatu">Vanuatu</option>
                                             <option value="Vatican City">Vatican City</option>
                                             <option value="Venezuela">Venezuela</option>
                                             <option value="Vietnam">Vietnam</option>
                                             <option value="Yemen">Yemen</option>
                                             <option value="Zambia">Zambia</option>
                                             <option value="Zimbabwe">Zimbabwe</option>

                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label>Street line 1*</label>
                                          <input type="text" name="street_1" id="street_1" required>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                          <label>Street line 2</label>
                                          <input type="text" name="street_2" id="street_2">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                       <div class="form-group">
                                          <label>City*</label>
                                          <input type="text" name="city" id="city" required>
                                       </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                       <div class="form-group">
                                          <label>State*</label>
                                          <input type="text" name="state" id="state" required>
                                       </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                       <div class="form-group">
                                          <label>Postal code*</label>
                                          <input type="text" name="pincode" id="pincode" required>
                                       </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                       <div class="form-group">
                                          <label>Additional Information</label>
                                          <textarea rows="6" name="additional_information" id="additional_information" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                          <!-- <input type="hidden" value="<?php echo htmlentities($result->BookingId); ?>" name="id"> -->
                                       </div>
                                    </div>
                                 </div>
                                 <!--End row -->
                              </div>
                              <div class="form-policy">
                                 <h3>Cancellation policy</h3>
                                 <div class="form-group">
                                    <label class="checkbox-list">
                                       <input type="checkbox" name="s" required>
                                       <span class="custom-checkbox"></span>
                                       I accept terms and conditions and general policy.
                                    </label>
                                 </div>
                                 <a><button type="submit" name="submit" class="round-btn">SUBMIT</button></a>
                              </div>
                           </form>
                        </div>
                        <!-- step one form html end -->
                     </div>
                     <div class="col-lg-4">
                        <div class="price-table-summary">
                           <h4 class="bg-title">Summary</h4>
                           <?php
                           include('include/config.php');
                           $pid = $_GET['pkgid'];
                           $sql = "SELECT * from tbltourpackages where PackageId=$pid";
                           $query = $dbh->prepare($sql);
                           $query->execute();
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                           $cnt = 1;
                           if ($query->rowCount() > 0) {
                              foreach ($results as $result) {
                                 //   print_r($result); 
                           ?>

                                 <table>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <strong>Packages cost </strong>
                                          </td>
                                          <td class="text-right">₹
                                             <?php echo $price = htmlentities($result->PackagePrice); ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <strong>Dedicated tour guide</strong>
                                          </td>
                                          <td class="text-right">
                                             ₹
                                             <?php echo $dtg = 500; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <strong>tax</strong>
                                          </td>
                                          <td class="text-right">
                                             <?php echo $tax = 20; ?>%
                                          </td>
                                       </tr>
                                       <tr class="total">
                                          <td>
                                             <strong>Total cost</strong>
                                          </td>
                                          <td class="text-right">
                                             <strong>
                                                <?php
                                                $total = ($price + $dtg) + 20 / 100;
                                                echo $total;
                                                ?>
                                             </strong>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                           <?php }
                           } ?>
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