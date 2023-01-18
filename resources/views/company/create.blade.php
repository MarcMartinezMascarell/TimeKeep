@extends('layouts/layoutMaster')

@section('title', 'Create Company')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/wizard-ex-property-listing.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Wizard examples /</span> Property Listing
</h4>

<!-- Property Listing Wizard -->
<div id="wizard-property-listing" class="bs-stepper wizar-numbered horizontal mt-2">
  <div class="bs-stepper-header">
    <div class="step" data-target="#basic-information">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bx-info-circle'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Basic information</span>
          <span class="bs-stepper-subtitle">Company name/logo</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#billing-info">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bx-wallet-alt'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Billing info</span>
          <span class="bs-stepper-subtitle">Company billing data</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    {{-- <div class="step" data-target="#property-features">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bx-star'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Property Features</span>
          <span class="bs-stepper-subtitle">Bedrooms/Floor No</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#property-area">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bx-map'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Property Area</span>
          <span class="bs-stepper-subtitle">Covered Area</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#price-details">
      <button type="button" class="step-trigger">
        <span class="bs-stepper-circle">
          <i class='bx bx-dollar'></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Price Details</span>
          <span class="bs-stepper-subtitle">Expected Price</span>
        </span>
      </button>
    </div> --}}
  </div>
  <div class="bs-stepper-content">
    <form id="wizard-property-listing-form" onSubmit="return false" action="{{route('company.store')}}" method="POST"  novalidate>
      @csrf
      <!-- Basic Information -->
      <div id="basic-information" class="content">
        <div class="row g-3">
          <div class="col-12">
            <div class="row">
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="customRadioBuilder">
                    <span class="custom-option-body">
                      <i class="bx bx-building-house"></i>
                      <span class="custom-option-title">I'm the only Manager</span>
                      <small>I will manage all my workers and all of them depend on me.</small>
                    </span>
                    <input name="manager_type" class="form-check-input" type="radio" value="1" id="customRadioBuilder" checked />
                  </label>
                </div>
              </div>
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="customRadioOwner">
                    <span class="custom-option-body">
                      <i class="bx bx-crown"></i>
                      <span class="custom-option-title">I have Managers</span>
                      <small>Company have Managers who can add new Users. Each user depends on a manager.</small>
                    </span>
                    <input name="manager_type" class="form-check-input" type="radio" value="2" id="customRadioOwner" />
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="name">Company Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="My Company Name" required />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" placeholder="company@mail.com" required />
            <span class="text-muted small">For invoices and company related things.</span>
          </div>
          <div class="mb-3">
            <label for="logo_url" class="form-label">Company Logo</label>
            <input class="form-control" type="file" id="logo" name="logo_url" accept="image/jpg,image/jpeg,image/png,image/svg" required>
          </div>
          {{-- <div class="col-sm-6">
            <label class="form-label" for="plEmail">Email</label>
            <input type="text" id="plEmail" name="plEmail" class="form-control" placeholder="john.doe@example.com" />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="plContact">Contact</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text">US (+1)</span>
              <input type="text" id="plContact" name="plContact" class="form-control contact-number-mask" placeholder="202 555 0111" />
            </div>
          </div> --}}
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-label-secondary btn-prev" disabled> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
          </div>
        </div>
      </div>

      <!-- Billing Info -->
      <div id="billing-info" class="content">
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label" for="full_name">Full company name</label>
            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="My Full Company Name S.L." required />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="cif">CIF</label>
            <input type="text" id="cif" name="cif" class="form-control" placeholder="X9999999999" required />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="C/ Nicaragua 67, At 2" required />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="country">Country</label>
            <select id="country" name="country" class="select2 form-select" data-allow-clear="true">
              <option value="" disabled>Select country</option>
              <option value="Afghanistan">Afghanistan</option>
              <option value="Albania">Albania</option>
              <option value="Algeria">Algeria</option>
              <option value="American Samoa">American Samoa</option>
              <option value="Andorra">Andorra</option>
              <option value="Angola">Angola</option>
              <option value="Anguilla">Anguilla</option>
              <option value="Antartica">Antarctica</option>
              <option value="Antigua and Barbuda">Antigua and Barbuda</option>
              <option value="Argentina">Argentina</option>
              <option value="Armenia">Armenia</option>
              <option value="Aruba">Aruba</option>
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
              <option value="Bermuda">Bermuda</option>
              <option value="Bhutan">Bhutan</option>
              <option value="Bolivia">Bolivia</option>
              <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
              <option value="Botswana">Botswana</option>
              <option value="Bouvet Island">Bouvet Island</option>
              <option value="Brazil">Brazil</option>
              <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
              <option value="Brunei Darussalam">Brunei Darussalam</option>
              <option value="Bulgaria">Bulgaria</option>
              <option value="Burkina Faso">Burkina Faso</option>
              <option value="Burundi">Burundi</option>
              <option value="Cambodia">Cambodia</option>
              <option value="Cameroon">Cameroon</option>
              <option value="Canada">Canada</option>
              <option value="Cape Verde">Cape Verde</option>
              <option value="Cayman Islands">Cayman Islands</option>
              <option value="Central African Republic">Central African Republic</option>
              <option value="Chad">Chad</option>
              <option value="Chile">Chile</option>
              <option value="China">China</option>
              <option value="Christmas Island">Christmas Island</option>
              <option value="Cocos Islands">Cocos (Keeling) Islands</option>
              <option value="Colombia">Colombia</option>
              <option value="Comoros">Comoros</option>
              <option value="Congo">Congo</option>
              <option value="Congo">Congo, the Democratic Republic of the</option>
              <option value="Cook Islands">Cook Islands</option>
              <option value="Costa Rica">Costa Rica</option>
              <option value="Cota D'Ivoire">Cote d'Ivoire</option>
              <option value="Croatia">Croatia (Hrvatska)</option>
              <option value="Cuba">Cuba</option>
              <option value="Cyprus">Cyprus</option>
              <option value="Czech Republic">Czech Republic</option>
              <option value="Denmark">Denmark</option>
              <option value="Djibouti">Djibouti</option>
              <option value="Dominica">Dominica</option>
              <option value="Dominican Republic">Dominican Republic</option>
              <option value="East Timor">East Timor</option>
              <option value="Ecuador">Ecuador</option>
              <option value="Egypt">Egypt</option>
              <option value="El Salvador">El Salvador</option>
              <option value="Equatorial Guinea">Equatorial Guinea</option>
              <option value="Eritrea">Eritrea</option>
              <option value="Estonia">Estonia</option>
              <option value="Ethiopia">Ethiopia</option>
              <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
              <option value="Faroe Islands">Faroe Islands</option>
              <option value="Fiji">Fiji</option>
              <option value="Finland">Finland</option>
              <option value="France">France</option>
              <option value="France Metropolitan">France, Metropolitan</option>
              <option value="French Guiana">French Guiana</option>
              <option value="French Polynesia">French Polynesia</option>
              <option value="French Southern Territories">French Southern Territories</option>
              <option value="Gabon">Gabon</option>
              <option value="Gambia">Gambia</option>
              <option value="Georgia">Georgia</option>
              <option value="Germany">Germany</option>
              <option value="Ghana">Ghana</option>
              <option value="Gibraltar">Gibraltar</option>
              <option value="Greece">Greece</option>
              <option value="Greenland">Greenland</option>
              <option value="Grenada">Grenada</option>
              <option value="Guadeloupe">Guadeloupe</option>
              <option value="Guam">Guam</option>
              <option value="Guatemala">Guatemala</option>
              <option value="Guinea">Guinea</option>
              <option value="Guinea-Bissau">Guinea-Bissau</option>
              <option value="Guyana">Guyana</option>
              <option value="Haiti">Haiti</option>
              <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
              <option value="Holy See">Holy See (Vatican City State)</option>
              <option value="Honduras">Honduras</option>
              <option value="Hong Kong">Hong Kong</option>
              <option value="Hungary">Hungary</option>
              <option value="Iceland">Iceland</option>
              <option value="India">India</option>
              <option value="Indonesia">Indonesia</option>
              <option value="Iran">Iran (Islamic Republic of)</option>
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
              <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
              <option value="Korea">Korea, Republic of</option>
              <option value="Kuwait">Kuwait</option>
              <option value="Kyrgyzstan">Kyrgyzstan</option>
              <option value="Lao">Lao People's Democratic Republic</option>
              <option value="Latvia">Latvia</option>
              <option value="Lebanon" selected>Lebanon</option>
              <option value="Lesotho">Lesotho</option>
              <option value="Liberia">Liberia</option>
              <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
              <option value="Liechtenstein">Liechtenstein</option>
              <option value="Lithuania">Lithuania</option>
              <option value="Luxembourg">Luxembourg</option>
              <option value="Macau">Macau</option>
              <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
              <option value="Madagascar">Madagascar</option>
              <option value="Malawi">Malawi</option>
              <option value="Malaysia">Malaysia</option>
              <option value="Maldives">Maldives</option>
              <option value="Mali">Mali</option>
              <option value="Malta">Malta</option>
              <option value="Marshall Islands">Marshall Islands</option>
              <option value="Martinique">Martinique</option>
              <option value="Mauritania">Mauritania</option>
              <option value="Mauritius">Mauritius</option>
              <option value="Mayotte">Mayotte</option>
              <option value="Mexico">Mexico</option>
              <option value="Micronesia">Micronesia, Federated States of</option>
              <option value="Moldova">Moldova, Republic of</option>
              <option value="Monaco">Monaco</option>
              <option value="Mongolia">Mongolia</option>
              <option value="Montserrat">Montserrat</option>
              <option value="Morocco">Morocco</option>
              <option value="Mozambique">Mozambique</option>
              <option value="Myanmar">Myanmar</option>
              <option value="Namibia">Namibia</option>
              <option value="Nauru">Nauru</option>
              <option value="Nepal">Nepal</option>
              <option value="Netherlands">Netherlands</option>
              <option value="Netherlands Antilles">Netherlands Antilles</option>
              <option value="New Caledonia">New Caledonia</option>
              <option value="New Zealand">New Zealand</option>
              <option value="Nicaragua">Nicaragua</option>
              <option value="Niger">Niger</option>
              <option value="Nigeria">Nigeria</option>
              <option value="Niue">Niue</option>
              <option value="Norfolk Island">Norfolk Island</option>
              <option value="Northern Mariana Islands">Northern Mariana Islands</option>
              <option value="Norway">Norway</option>
              <option value="Oman">Oman</option>
              <option value="Pakistan">Pakistan</option>
              <option value="Palau">Palau</option>
              <option value="Panama">Panama</option>
              <option value="Papua New Guinea">Papua New Guinea</option>
              <option value="Paraguay">Paraguay</option>
              <option value="Peru">Peru</option>
              <option value="Philippines">Philippines</option>
              <option value="Pitcairn">Pitcairn</option>
              <option value="Poland">Poland</option>
              <option value="Portugal">Portugal</option>
              <option value="Puerto Rico">Puerto Rico</option>
              <option value="Qatar">Qatar</option>
              <option value="Reunion">Reunion</option>
              <option value="Romania">Romania</option>
              <option value="Russia">Russian Federation</option>
              <option value="Rwanda">Rwanda</option>
              <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
              <option value="Saint LUCIA">Saint LUCIA</option>
              <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
              <option value="Samoa">Samoa</option>
              <option value="San Marino">San Marino</option>
              <option value="Sao Tome and Principe">Sao Tome and Principe</option>
              <option value="Saudi Arabia">Saudi Arabia</option>
              <option value="Senegal">Senegal</option>
              <option value="Seychelles">Seychelles</option>
              <option value="Sierra">Sierra Leone</option>
              <option value="Singapore">Singapore</option>
              <option value="Slovakia">Slovakia (Slovak Republic)</option>
              <option value="Slovenia">Slovenia</option>
              <option value="Solomon Islands">Solomon Islands</option>
              <option value="Somalia">Somalia</option>
              <option value="South Africa">South Africa</option>
              <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
              <option value="Span" selected>Spain</option>
              <option value="SriLanka">Sri Lanka</option>
              <option value="St. Helena">St. Helena</option>
              <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
              <option value="Sudan">Sudan</option>
              <option value="Suriname">Suriname</option>
              <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
              <option value="Swaziland">Swaziland</option>
              <option value="Sweden">Sweden</option>
              <option value="Switzerland">Switzerland</option>
              <option value="Syria">Syrian Arab Republic</option>
              <option value="Taiwan">Taiwan, Province of China</option>
              <option value="Tajikistan">Tajikistan</option>
              <option value="Tanzania">Tanzania, United Republic of</option>
              <option value="Thailand">Thailand</option>
              <option value="Togo">Togo</option>
              <option value="Tokelau">Tokelau</option>
              <option value="Tonga">Tonga</option>
              <option value="Trinidad and Tobago">Trinidad and Tobago</option>
              <option value="Tunisia">Tunisia</option>
              <option value="Turkey">Turkey</option>
              <option value="Turkmenistan">Turkmenistan</option>
              <option value="Turks and Caicos">Turks and Caicos Islands</option>
              <option value="Tuvalu">Tuvalu</option>
              <option value="Uganda">Uganda</option>
              <option value="Ukraine">Ukraine</option>
              <option value="United Arab Emirates">United Arab Emirates</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="United States">United States</option>
              <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
              <option value="Uruguay">Uruguay</option>
              <option value="Uzbekistan">Uzbekistan</option>
              <option value="Vanuatu">Vanuatu</option>
              <option value="Venezuela">Venezuela</option>
              <option value="Vietnam">Viet Nam</option>
              <option value="Virgin Islands (British)">Virgin Islands (British)</option>
              <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
              <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
              <option value="Western Sahara">Western Sahara</option>
              <option value="Yemen">Yemen</option>
              <option value="Serbia">Serbia</option>
              <option value="Zambia">Zambia</option>
              <option value="Zimbabwe">Zimbabwe</option>
              </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="zip">Zip Code</label>
            <input type="number" id="zip" name="zip" class="form-control" placeholder="08003" />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="state">State</label>
            <input type="text" id="state" name="state" class="form-control" placeholder="Barcelona" />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="city">City</label>
            <input type="text" id="city" name="city" class="form-control" placeholder="Barcelona" />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="phone">Contact Phone</label>
            <input type="phone" id="phone" name="phone" class="form-control" placeholder="+346666666666" />
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
            <button type="submit" class="btn btn-success btn-submit btn-next">Submit</button>
          </div>
        </div>
      </div>

      {{-- <!-- Property Features -->
      <div id="property-features" class="content">
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label d-block" for="plBedrooms">Bedrooms</label>
            <input type="number" id="plBedrooms" name="plBedrooms" class="form-control" placeholder="3" />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="plFloorNo">Floor No</label>
            <input type="number" id="plFloorNo" name="plFloorNo" class="form-control" placeholder="12" />
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="plBathrooms">Bathrooms</label>
            <input type="number" id="plBathrooms" name="plBathrooms" class="form-control" placeholder="4" />
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="plFurnishedStatus">Furnished Status</label>
            <select id="plFurnishedStatus" name="plFurnishedStatus" class="form-select">
              <option selected disabled value="">Select furnished status </option>
              <option value="1">Fully furnished</option>
              <option value="2">Furnished</option>
              <option value="3">Semi furnished</option>
              <option value="4">Unfurnished</option>
            </select>
          </div>
          <div class="col-lg-12">
            <label class="form-label" for="plFurnishingDetails">Furnishing Details</label>
            <input id="plFurnishingDetails" name="plFurnishingDetails" class="form-control" placeholder="select options" value="Fridge, AC, TV, WiFi">
          </div>
          <div class="col-sm-6">
            <label class="form-label">Is there any common area?</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plCommonAreaRadio" id="plCommonAreaRadioYes" checked>
              <label class="form-check-label" for="plCommonAreaRadioYes">Yes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plCommonAreaRadio" id="plCommonAreaRadioNo">
              <label class="form-check-label" for="plCommonAreaRadioNo">No</label>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label">Is there any attached balcony?</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plAttachedBalconyRadio" id="plAttachedBalconyRadioYes" checked>
              <label class="form-check-label" for="plAttachedBalconyRadioYes">Yes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plAttachedBalconyRadio" id="plAttachedBalconyRadioNo">
              <label class="form-check-label" for="plAttachedBalconyRadioNo">No</label>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
          </div>
        </div>
      </div>

      <!-- Property Area -->
      <div id="property-area" class="content">
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label d-block" for="plTotalArea">Total Area</label>
            <div class="input-group input-group-merge">
              <input type="number" class="form-control" id="plTotalArea" name="plTotalArea" placeholder="1000" aria-describedby="pl-total-area">
              <span class="input-group-text" id="pl-total-area">sq-ft</span>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="plCarpetArea">Carpet Area</label>
            <div class="input-group input-group-merge">
              <input type="number" class="form-control" id="plCarpetArea" name="plCarpetArea" placeholder="800" aria-describedby="pl-carpet-area">
              <span class="input-group-text" id="pl-carpet-area">sq-ft</span>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="plPlotArea">Plot Area</label>
            <div class="input-group input-group-merge">
              <input type="number" class="form-control" id="plPlotArea" name="plPlotArea" placeholder="800" aria-describedby="pl-plot-area">
              <span class="input-group-text" id="pl-plot-area">sq-yd</span>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="plAvailableFrom">Available From</label>
            <input type="text" id="plAvailableFrom" name="plAvailableFrom" class="form-control flatpickr" placeholder="YYYY-MM-DD" />
          </div>
          <div class="col-sm-6">
            <label class="form-label">Possession Status</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plPossessionStatus" id="plUnderConstruction" checked>
              <label class="form-check-label" for="plUnderConstruction">Under Construction</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plPossessionStatus" id="plReadyToMoveRadio">
              <label class="form-check-label" for="plReadyToMoveRadio">Ready to Move</label>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label">Transaction Type</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plTransectionType" id="plNewProperty" checked>
              <label class="form-check-label" for="plNewProperty">New Property</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plTransectionType" id="plResaleProperty">
              <label class="form-check-label" for="plResaleProperty">Resale</label>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label">Is Property Facing Main Road?</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plRoadFacingRadio" id="plRoadFacingRadioYes" checked>
              <label class="form-check-label" for="plRoadFacingRadioYes">Yes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plRoadFacingRadio" id="plRoadFacingRadioNo">
              <label class="form-check-label" for="plRoadFacingRadioNo">No</label>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label">Gated Colony?</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plGatedColonyRadio" id="plGatedColonyRadioYes" checked>
              <label class="form-check-label" for="plGatedColonyRadioYes">Yes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plGatedColonyRadio" id="plGatedColonyRadioNo">
              <label class="form-check-label" for="plGatedColonyRadioNo">No</label>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
          </div>
        </div>
      </div>

      <!-- Price Details -->
      <div id="price-details" class="content">
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label d-block" for="plExpeactedPrice">Expected Price</label>
            <div class="input-group input-group-merge">
              <input type="number" class="form-control" id="plExpeactedPrice" name="plExpeactedPrice" placeholder="25,000" aria-describedby="pl-expeacted-price">
              <span class="input-group-text" id="pl-expeacted-price">$</span>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="plPriceSqft">Price per Sqft</label>
            <div class="input-group input-group-merge">
              <input type="number" class="form-control" id="plPriceSqft" name="plPriceSqft" placeholder="500" aria-describedby="pl-price-sqft">
              <span class="input-group-text" id="pl-price-sqft">$</span>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="plMaintenenceCharge">Maintenance Charge</label>
            <div class="input-group input-group-merge">
              <input type="number" class="form-control" id="plMaintenenceCharge" name="plMaintenenceCharge" placeholder="50" aria-describedby="pl-mentenence-charge">
              <span class="input-group-text" id="pl-mentenence-charge">$</span>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="plMaintenencePer">Maintenance</label>
            <select id="plMaintenencePer" name="plMaintenencePer" class="form-select">
              <option value="1" selected>Monthly</option>
              <option value="2">Quarterly</option>
              <option value="3">Yearly</option>
              <option value="3">One-time</option>
              <option value="3">Per sqft. Monthly</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="plBookingAmount">Booking/Token Amount</label>
            <div class="input-group input-group-merge">
              <input type="number" class="form-control" id="plBookingAmount" name="plBookingAmount" placeholder="250" aria-describedby="pl-booking-amount">
              <span class="input-group-text" id="pl-booking-amount">$</span>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label d-block" for="plOtherAmount">Other Amount</label>
            <div class="input-group input-group-merge">
              <input type="number" class="form-control" id="plOtherAmount" name="plOtherAmount" placeholder="500" aria-describedby="pl-other-amount">
              <span class="input-group-text" id="pl-other-amount">$</span>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label">Show Price as</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plShowPriceRadio" id="plNagotiablePrice" checked>
              <label class="form-check-label" for="plNagotiablePrice">Negotiable</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="plShowPriceRadio" id="plCallForPrice">
              <label class="form-check-label" for="plCallForPrice">Call for Price</label>
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label">Price includes</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="plCarParking" id="plCarParking">
              <label class="form-check-label" for="plCarParking">Car Parking</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="plClubMembership" id="plClubMembership">
              <label class="form-check-label" for="plClubMembership">Club Membership</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="plOtherCharges" id="plOtherCharges">
              <label class="form-check-label" for="plOtherCharges">Stamp Duty & Registration charges excluded.</label>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
            <button class="btn btn-success btn-submit btn-next">Submit</button>
          </div>
        </div>
      </div> --}}
    </form>
  </div>
</div>
<!--/ Property Listing Wizard -->
@endsection

