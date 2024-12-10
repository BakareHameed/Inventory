<!DOCTYPE html>
<html lang="en">
    @include('user.sales_executive.head')
    <body>
      <!-- Back to top button -->
      <div class="back-to-top"></div>
      @include('user.sales_executive.salesAgents.header')

      @if(session()->has ('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">x</button>
          {{session()->get('message')}}
        </div>
      @endif

      <div class="page-hero bg-image overlay-dark" style="background-image: url(../assets/img/sys.jpg);">
        <div class="hero-section">
          <div class="container text-center wow zoomIn">
            <span class="subhead">A Reliable Network Connection Makes A</span>
            <h1 class="display-4">Happy Customer</h1>
            <a href="#" class="btn btn-primary">Let's Connect</a>
          </div>
        </div>
      </div>

      <div class="bg-light">
        <div class="page-section py-3 mt-md-n5 custom-index">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-4 py-3 py-md-0">
                <div class="card-service wow fadeInUp">
                  <div class="circle-shape bg-secondary text-white">
                    <span class="mai-chatbubbles-outline"></span>
                  </div>
                  <p><span>Chat</span> with a marketing personnel</p>
                </div>
              </div>
              <div class="col-md-4 py-3 py-md-0">
                <div class="card-service wow fadeInUp">
                  <div class="circle-shape bg-primary text-white">
                    <span class="mai-shield-checkmark"></span>
                  </div>
                  <p><span>Site</span>-Engineers</p>
                </div>
              </div>
              <div class="col-md-4 py-3 py-md-0">
                <div class="card-service wow fadeInUp">
                  <div class="circle-shape bg-accent text-white">
                    <span class="mai-basket"></span>
                  </div>
                  <p><span>Service</span>-Suport Desk</p>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- .page-section -->

        <div class="page-section pb-0 $blue-100">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-6 py-3 wow fadeInUp">
                <h1>IT Infrastructure and Information Security.</h1>
                <p class="text-grey mb-4">Our Broadband services covers Internet Service Positioning, Virtual Private Network and Communication Systems Integration namely microwave wireless systems, optic fiber installation and provision of last mile connectivity.</p>
                <a href="about.html" class="btn btn-primary">Learn More</a>
              </div>
              <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
                <div class="img-place custom-img-1">
                  <img src="../assets/img/net6.jpg" style="height: 28rem; width: 80rem" alt="">
                </div>
              </div>
            </div>
          </div>
          <!-- </div> .bg-light -->
        </div> <!-- .bg-light -->

        @include('user.doctor')

        @include ('user.latest')
        <!-- .page-section -->
        @include('user.appointment')
        <!-- .banner-home -->
        @include('user.footer')
        
        <!-- Beginning of ALL script -->
          <!-- Generic scripts -->
            <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
            <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
            <script src="{{ asset('assets/js/theme.js') }}"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
          <!-- End of generic scripts -->

          {{-- Script For Showing And Hiding Quote and Sales Form --}}
            <script type="text/javascript">
              function yesnoCheck(that) {
                if (that.value == "Yes") {
                    document.getElementById("ifSalesYes").style.display = "block";
                    document.getElementById("MTC_sales_Yes").style.display = "block";
                    document.getElementById("Service").style.display = "block";
                } else {
                    document.getElementById("ifSalesYes").style.display = "none";
                    document.getElementById("MTC_sales_Yes").style.display = "none";
                    document.getElementById("Service").style.display = "none";
                }
              }
            </script>
            <script type="text/javascript">
              function QuoteCheck(that) {
                if (that.value == "Yes") {
                    document.getElementById("ifQuoteYes").style.display = "block";
                    document.getElementById("MTCYes").style.display = "block";
                } else {
                    document.getElementById("ifQuoteYes").style.display = "none";
                    document.getElementById("MTCYes").style.display = "none";
                }
              }
            </script>
          {{-- Script For Showing And Hiding Quote and Sales Form --}}

          <!-- Script for Showing Bandwidth -->
            <script>
              function Checkroad() {
                let select = document.getElementById('ded_service_type');
                console.log(select.value);
                let road = document.getElementById('dedicated');
                if ((select.value === "fibre") || (select.value === "wireless"))
                  road.style.display = 'block';
                else
                  road.style.display = 'none';
              }
            </script>
          <!-- End of Script for Showing Bandwidth -->

          <!-- Script for Showing Service Plan -->
            <script type="text/javascript">
              function ServicePlan(q) {
                if (document.getElementById('Dedi').checked && q == 0) {
                  document.getElementById('ifYes').style.display = 'block';
                  document.getElementById('ifNo').style.display = 'none';

                } else if (document.getElementById('Shar').checked && q == 1) {
                  document.getElementById('ifNo').style.display = 'block';
                  document.getElementById('ifYes').style.display = 'none';
                } else {
                  document.getElementById('ifNo').style.display = 'none';
                  document.getElementById('ifYes').style.display = 'none';
                }
              }
            </script>
          <!-- End of Script for Showing Service Plan -->

          <!-- Script for Validating other inputs -->
            <script type="text/javascript">
              function SurveyRequest() {
                let sp = document.forms["SurveyRequestForm"]["service_plan"].value;
                let ded_serv = document.forms["SurveyRequestForm"]["ded_service_type"].value;
                let shar_serv = document.forms["SurveyRequestForm"]["shar_service_type"].value;
                let ul = document.forms["SurveyRequestForm"]["upload_bandwidth"].value;
                let dl = document.forms["SurveyRequestForm"]["download_bandwidth"].value;
                let bw = document.forms["SurveyRequestForm"]["bandwidth_unit"].value;
                let mess = document.forms["SurveyRequestForm"]["message"].value;

                if (sp == "") {
                  alert("You can't leave Service Plan field to be null");
                  return false
                }

                if (sp == "Dedicated" && ded_serv == "") {
                  alert("Select the type of Dedicated plan!");
                  return false
                }

                if (sp == "Shared" && shar_serv == "") {
                  alert("Select the type of Shared plan!");
                  return false
                }
                if (ded_serv == "wireless" || ded_serv == "fibre") {
                  if (ul == "") {
                    alert("Please input the Upload Bandwidth!");
                    return false
                  }

                  if (dl == "") {
                    alert("Please input the Download Bandwidth!");
                    return false
                  }

                  if (bw == "") {
                    alert("Please select the Unit of the bandwidth !");
                    return false
                  }
                }

              }
            </script>
          <!-- End of Script for Validating other inputs -->
        <!-- End of ALL script -->
    </body>
</html>