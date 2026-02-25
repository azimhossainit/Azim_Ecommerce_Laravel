@extends('web.layouts.app')
@section('content')
 <!-- start wpo-page-title -->
        <section class="wpo-page-title">
            <h2 class="d-none">Hide</h2>
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="wpo-breadcumb-wrap">
                            <ol class="wpo-breadcumb-wrap">
                                 <li><a href="{{ route('root') }}">Home</a></li>
                                <li>Contact</li>
                            </ol>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end page-title -->

                <!-- start wpo-contact-pg-section -->
                <section class="wpo-contact-pg-section section-padding">
                    <div class="container">
                        <div class="row">
                            <div class="col col-lg-10 offset-lg-1">
                                <div class="office-info">
                                    <div class="row">
                                        <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                                            <div class="office-info-item">
                                                <div class="office-info-icon">
                                                    <div class="icon">
                                                        <i class="fi flaticon-pin"></i>
                                                    </div>
                                                </div>
                                                <div class="office-info-text">
                                                    <h2>Address</h2>
                                                    <p>7 Green Lake Street Crawfordsville, IN 47933</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                                            <div class="office-info-item">
                                                <div class="office-info-icon">
                                                    <div class="icon">
                                                        <i class="fi flaticon-mail"></i>
                                                    </div>
                                                </div>
                                                <div class="office-info-text">
                                                    <h2>Email Us</h2>
                                                    <p>themart@gmail.com</p>
                                                    <p>themart@gmail.com</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                                            <div class="office-info-item">
                                                <div class="office-info-icon">
                                                    <div class="icon">
                                                        <i class="fi flaticon-phone"></i>
                                                    </div>
                                                </div>
                                                <div class="office-info-text">
                                                    <h2>Call Now</h2>
                                                    <p>+1 800 123 456 789</p>
                                                    <p>+1 800 123 654 987</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wpo-contact-title">
                                    <h2>Have Any Question?</h2>
                                    <p>It is a long established fact that a reader will be distracted
                                        content of a page when looking.</p>
                                </div>
                                <div class="wpo-contact-form-area">
                                    <form method="post" class="contact-validation-active" id="contact-form-main">
                                        <div>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Your Name*">
                                        </div>
                                        <div>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Your Email*">
                                        </div>
                                        <div>
                                            <input type="text" class="form-control" name="adress" id="adress"
                                                placeholder="Adress">
                                        </div>
                                        <div>
                                            <select name="service" class="form-control">
                                                <option disabled="disabled" selected="">Services</option>
                                                <option>Architecture</option>
                                                <option>The Rehearsal Dinner</option>
                                                <option>The Afterparty</option>
                                                <option>Videographers</option>
                                                <option>Perfect Cake</option>
                                                <option>All Of The Above</option>
                                            </select>
                                        </div>
                                        <div class="fullwidth">
                                            <textarea class="form-control" name="note" id="note"
                                                placeholder="Message..."></textarea>
                                        </div>
                                        <div class="submit-area">
                                            <button type="submit" class="theme-btn">Get in Touch</button>
                                            <div id="loader">
                                                <i class="ti-reload"></i>
                                            </div>
                                        </div>
                                        <div class="clearfix error-handling-messages">
                                            <div id="success">Thank you</div>
                                            <div id="error"> Error occurred while sending email. Please try again later. </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end container -->
                </section>
                <!-- end wpo-contact-pg-section -->
        
                <!--  start wpo-contact-map -->
                <section class="wpo-contact-map-section">
                    <h2 class="hidden">Contact map</h2>
                    <div class="wpo-contact-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.9147703055!2d-74.11976314309273!3d40.69740344223377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbd!4v1547528325671"
                            allowfullscreen></iframe>
                    </div>
                </section>
                <!-- end wpo-contact-map -->

        <!-- start of wpo-site-footer-section -->
        <footer class="wpo-site-footer">
            <div class="wpo-upper-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="widget about-widget">
                                <div class="logo widget-title">
                                    <img src="assets/images/logo-2.svg" alt="blog">
                                </div>
                                <p>Elit commodo nec urna erat morbi at hac turpis aliquam.
                                    In tristique elit nibh turpis. Lacus volutpat ipsum convallis tellus pellentesque
                                    etiam.</p>
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-linkedin"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-instagram"></i>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="widget link-widget">
                                <div class="widget-title">
                                    <h3>Contact Us</h3>
                                </div>
                                <div class="contact-ft">
                                    <ul>
                                        <li><i class="fi flaticon-mail"></i>themart@gmail.com</li>
                                        <li><i class="fi flaticon-phone"></i>(208) 555-0112 <br>(704) 555-0127</li>
                                        <li><i class="fi flaticon-pin"></i>4517 Washington Ave. Manchter,
                                            Kentucky 495</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col col-xl-3 col-lg-2 col-md-6 col-sm-12 col-12">
                            <div class="widget link-widget">
                                <div class="widget-title">
                                    <h3>Popular</h3>
                                </div>
                                <ul>
                                    <li><a href="product.html">Men</a></li>
                                    <li><a href="product.html">Women</a></li>
                                    <li><a href="product.html">Kids</a></li>
                                    <li><a href="product.html">Shoe</a></li>
                                    <li><a href="product.html">Jewelry</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="widget instagram">
                                <div class="widget-title">
                                    <h3>Instagram</h3>
                                </div>
                                <ul class="d-flex">
                                    <li><a href="project-single.html"><img src="assets/images/instragram/1.jpg"
                                                alt=""></a></li>
                                    <li><a href="project-single.html"><img src="assets/images/instragram/2.jpg"
                                                alt=""></a></li>
                                    <li><a href="project-single.html"><img src="assets/images/instragram/4.jpg"
                                                alt=""></a></li>
                                    <li><a href="project-single.html"><img src="assets/images/instragram/3.jpg"
                                                alt=""></a></li>
                                    <li><a href="project-single.html"><img src="assets/images/instragram/4.jpg"
                                                alt=""></a></li>
                                    <li><a href="project-single.html"><img src="assets/images/instragram/1.jpg"
                                                alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- end container -->
            </div>
            <div class="wpo-lower-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-xs-12">
                            <p class="copyright"> Copyright &copy; 2023 Themart by <a href="index.html">wpOceans</a>.
                                All
                                Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
@endsection