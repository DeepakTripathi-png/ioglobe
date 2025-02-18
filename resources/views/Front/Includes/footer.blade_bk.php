<style>
    html,body{
        overflow-x: hidden;
    }
   
    h1, h2, h3, h4, h5, h6 {
}
section {
    padding: 60px 0;
    min-height: 100vh;
}
a, a:hover, a:focus, a:active {
    text-decoration: none;
    outline: none;
}
ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.main-footer{
  position: relative;
  background: #e158183d;
  height: 423px;
}

.footer-content{
  position: relative;
  padding: 85px 0px 80px 0px;
}
.footer-content:before {
    position: absolute;
    content: '';
    background: url(/front/images/earth_1.png);
    width: 316px;
    height: 315px;
    top: 67px;
    right: -55px;
    background-size: cover;
    background-repeat: no-repeat;
    animation-name: float-bob;
    animation-duration: 30s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    -webkit-animation-name: float-bob;
    -webkit-animation-duration: 30s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    -moz-animation-name: float-bob;
    -moz-animation-duration: 30s;
    -moz-animation-iteration-count: infinite;
    -moz-animation-timing-function: linear;
    -ms-animation-name: float-bob;
    -ms-animation-duration: 30s;
    -ms-animation-iteration-count: infinite;
    -ms-animation-timing-function: linear;
    -o-animation-name: float-bob;
    -o-animation-duration: 30s;
    -o-animation-iteration-count: infinite;
    -o-animation-timing-function: linear;
}
.footer-content .logo-widget{
  position: relative;
  margin-top: -5px;
}
.footer-content .logo-widget .footer-social li{
  position: relative;
  display: inline-block;
  margin-right: 9px;
}
.footer-content .logo-widget .footer-social li:last-child{
  margin-right: 0px;
}
.footer-content .logo-widget .footer-social li a{
  position: relative;
  display: inline-block;
  width: 42px;
  height: 42px;
  line-height: 42px;
  background: #2e3138;
  color: #9ea0a9;
  text-align: center;
  border-radius: 50%;
}
.footer-content .logo-widget .footer-social li a:hover{
  color: #ffffff;
  background: #ff5e14;
}
.footer-content .logo-widget .logo-box{
  margin-bottom: 25px;
}
.footer-content .logo-widget .text p{
  color: #000000;
  margin-bottom: 32px;
}
.footer-content .footer-title{
  position: relative;
  font-size: 24px;
  line-height: 35px;
  font-family: 'Playfair Display', serif;
  color: #1a1713;
  font-weight: 700;
  margin-bottom: 27px;
}

.footer-content .service-widget .list li{
  display: block;
  margin-bottom: 12px;
}
.footer-content .service-widget .list li a{
  position: relative;
  display: inline-block;
  color: #000000;
}
.footer-content .service-widget .list li a:hover{
  color: #ff5e14;
}
.footer-content .contact-widget p {
    color: #000000;
    margin-bottom: 15px;
}

.footer-content .contact-widget .footer-title{
  margin-bottom: 29px;
}

.footer-content .contact-widget {
    margin-left: 202px;
    margin-top: 105px;
    text-align: initial;
    color: black;
}
/** footer-bottom **/

.footer-bottom{
  position: relative;
  background: #1a1713;
  padding: 25px 0px 22px 0px;
}
.footer-bottom .copyright,
.footer-bottom .copyright a,
.footer-bottom .footer-nav li a{
  position: relative;
  color: #9ea0a9;
}
.footer-bottom .copyright a:hover,
.footer-bottom .footer-nav li a:hover{
  color: #ff5e14;
}
.footer-bottom .footer-nav{
  position: relative;
  text-align: right;
}
.footer-bottom .footer-nav li{
  position: relative;
  display: inline-block;
  margin-left: 29px;
}
.footer-bottom .footer-nav li:first-child{
  margin-left: 0px;
}
.footer-bottom .footer-nav li:before{
  position: absolute;
  content: '';
  background: #9ea0a9;
  width: 1px;
  height: 14px;
  top: 7px;
  left: -18px;
}
.footer-bottom .footer-nav li:first-child:before{
  display: none;
}
.logo-box img {
    max-width: 220px;
}


a {
    color: #000000;
    text-decoration: underline;
}


@media (max-width: 600px) 
{  
.contact-widget.footer-widget {
    display: none;
}
}

@media (max-width: 600px) {
.footer-bottom .footer-nav {
    position: relative;
    text-align: center;
}
}
</style>
<footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                                                        <a href="{{ url('/') }}">
                                <img src="{{ asset('front/images/ioglobe_front_logo.png') }}" alt="FireAlarm Logo">
                                                              <img src="{{ asset('front/images/ioglobe_front_logo.png') }}" alt="FireAlarm Logo">

>
                            </a></figure>
                            <div class="text">
                                <p>At IoGlobe, great service starts with experienced
                                    professionals. Our skilled team ensures every project is
                                    completed on time, with top-notch quality. With personalized
                                    service, competitive rates, and a commitment to customer
                                    satisfaction, we consistently exceed expectations.</p>
                            </div>
                            <ul class="footer-social">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                    </div>
                   
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-widget">
                        <div class="contact-widget footer-widget">
                            <div class="text">
                                <ul>
                                    <li><a href="#home">Home</a></li>
                                    <li><a href="#about">About</a></li>
                                    <li><a href="#features">Features</a></li>
                                    <li><a href="#services">Services</a></li>
                                    <li><a href="#testimonials">Testimonials</a></li>
                                    <li><a href="#contact">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    

                    {{-- <div class="col-lg-3 col-md-6 col-sm-12 offset-lg-2 footer-column">
                        <div class="service-widget footer-widget">
                            <div class="footer-title">Services</div>
                            <ul class="list">
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 column">
                    <div class="copyright">
                        <a href="https://codepixsolutions.com/">Designed By Codepix Solutions PVT. LTD.</a> &copy; Copyright © 2024, All Right Reserved. </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 column">
                    <ul class="footer-nav">
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

</script>