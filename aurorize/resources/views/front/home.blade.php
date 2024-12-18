


@extends('layouts.app')

@section('title') Home @endsection
@section('css')
<style>

.schedule {
	background: #fff;
	margin: 0;
	padding: 0;
	height: auto;
	padding: 70px 0;
	border-bottom:1px solid #eee;
}
.schedule .schedule-inner {
	transform: none;
}
.schedule .single-schedule.last{
	margin-top:30px;
}
    /* General Layout Styles */
.row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 30px;
}

/* Left Column Styling (Who We Are) */
.choose-left {
    padding-right: 20px;
    padding-left: 20px;
}

.choose-left h3 {
    font-size: 1.8rem;
    margin-bottom: 15px;
    font-weight: bold;
    color: #1c2c56; /* Dark blue color */
}

.choose-left p {
    font-size: 1rem;
    line-height: 1.6;
    color: #555;
    margin-bottom: 10px;
}

/* Right Column Styling (Why Choose Us) */
.choose-right {
    padding-right: 20px;
    padding-left: 20px;
}

.choose-right h3 {
    font-size: 1.8rem;
    margin-bottom: 20px;
    font-weight: bold;
    color: #1c2c56; /* Dark blue color */
}

.list {
    list-style-type: none;
    padding-left: 0;
}

.list li {
    margin-bottom: 12px;
    font-size: 1.1rem;
    color: #333;
}

.list li i {
    color: #007bff; /* Icon color blue */
    font-size: 1.4rem;
    margin-right: 10px;
}

.list li strong {
    font-weight: bold;
    color: #222; /* Darker shade for emphasis */
}

.list p {
    font-size: 0.95rem;
    color: #777;
    margin-left: 25px;
    margin-top: 5px;
    line-height: 1.6;
}

/* Responsive Design for Small Screens */
@media (max-width: 992px) {
    .choose-left,
    .choose-right {
        padding-left: 15px;
        padding-right: 15px;
    }

    .choose-left h3,
    .choose-right h3 {
        font-size: 1.5rem;
    }

    .list li {
        font-size: 1rem;
    }
}

@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }

    .col-lg-6 {
        width: 100%;
        margin-bottom: 20px;
    }

    .choose-left h3,
    .choose-right h3 {
        font-size: 1.4rem;
    }

    .list li {
        font-size: 1rem;
    }
}
    
</style>
@endsection

@section('title')
    About
@endsection
@section('content')

<!-- Slider Area -->
<section class="slider">
    <div class="hero-slider">
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('front_assets/img/slider2.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <!-- We provide Medical Billing & Revenue Cycle Management Services that you can Trust!!!! -->
                            <h1>We Provide <span>Medical Blling</span> & Revenue Cycle Management Services <span>that you can Trust!</span></h1>
                            <p>With more than 8 years of expertise, Aurorize Healthcare Solution LLC ensures unmatched accuracy and excellence in billing management.</p>
                            <div class="button">
                                <a href="{{route('home.inquiry')}}" class="btn">Let's Discuss!</a>
                                <!-- <a href="#" class="btn primary">Learn More</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('front_assets/img/slider.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>We Provide <span>Medical Blling</span> & Revenue Cycle Management Services <span>that you can Trust!</span></h1>
                            <p>Navigating the complexities of the No Surprises Act? We specialize in Independent Dispute Resolutions (IDRs) for out-of-network providers, achieving an impressive success rate of up to 98%. Let us help you secure the reimbursement you deserve.</p>
                            <div class="button">
                                <a href="{{route('home.inquiry')}}" class="btn">Let's Discuss!</a>
                                <!-- <a href="#" class="btn primary">About Us</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start End Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('front_assets/img/slider3.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>We Provide <span>Medical Blling</span> & Revenue Cycle Management Services <span>that you can Trust!</span></h1>
                            <p>Focus on your patients—let us handle the rest. From billing to every administrative detail, we’ve got you covered, ensuring seamless operations so you can provide exceptional care without distractions. Trust us to manage the business side, while you do what you do best.</p>
                            <div class="button">
                                <a href="{{route('home.inquiry')}}" class="btn">Let's Discuss!</a>
                                <!-- <a href="#" class="btn primary">Conatct Now</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
    </div>
</section>
<!--/ End Slider Area -->

<!-- Start Schedule Area -->
<!-- <section class="schedule">
    <div class="container">
        <div class="schedule-inner">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 ">
                    <div class="single-schedule first">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-ambulance"></i>
                            </div>
                            <div class="single-content">
                                <span>Lorem Amet</span>
                                <h4>Emergency Cases</h4>
                                <p>Lorem ipsum sit amet consectetur adipiscing elit. Vivamus et erat in lacus convallis sodales.</p>
                                <a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-schedule middle">
                        <div class="inner">
                            <div class="icon">
                                <i class="icofont-prescription"></i>
                            </div>
                            <div class="single-content">
                                <span>Fusce Porttitor</span>
                                <h4>Doctors Timetable</h4>
                                <p>Lorem ipsum sit amet consectetur adipiscing elit. Vivamus et erat in lacus convallis sodales.</p>
                                <a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="single-schedule last">
                        <div class="inner">
                            <div class="icon">
                                <i class="icofont-ui-clock"></i>
                            </div>
                            <div class="single-content">
                                <span>Donec luctus</span>
                                <h4>Opening Hours</h4>
                                <ul class="time-sidual">
                                    <li class="day">Monday - Fridayp <span>8.00-20.00</span></li>
                                    <li class="day">Saturday <span>9.00-18.30</span></li>
                                    <li class="day">Monday - Thusday <span>9.00-15.00</span></li>
                                </ul>
                                <a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--/End Start schedule Area -->

<!-- Start Feautes -->
<section class="Feautes section mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Let us handle the complexities while you focus on what truly matters providing top-quality care</h2>
                    <img src="{{ Helper::assets('front_assets/img/section-img.png')}}" alt="#">
                    <p>While you prioritize patient care, we’ll handle your billing and operational needs with precision—giving you more time to focus on what truly matters.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12">
                <!-- Start Single features -->
                <div class="single-features">
                    <div class="signle-icon">
                        <i class="icofont-light-bulb"></i>
                    </div>
                    <h3>Our belief</h3>
                    <p>We love doing billing for healthcare providers and the only way to do great work is to love what you do.</p>
                </div>
                <!-- End Single features -->
            </div>
            <div class="col-lg-4 col-12">
                <!-- Start Single features -->
                <div class="single-features">
                    <div class="signle-icon">
                        <i class="icofont-rocket-alt-1"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p>We are dedicated to leveraging the most advanced solutions to help our clients eliminate barriers and optimize the efficiency of their practice, ensuring long-term success and seamless operations.</p>
                </div>
                <!-- End Single features -->
            </div>
            <div class="col-lg-4 col-12">
                <!-- Start Single features -->
                <div class="single-features last">
                    <div class="signle-icon">
                        <i class="icofont-brainstorming"></i>
                    </div>
                    <h3>Our Vision</h3>
                    <p>We strive to be the leading partner for healthcare providers, setting the standard for accuracy, innovation, and excellence in billing management, while driving maximum financial performance</p>
                </div>
                <!-- End Single features -->
            </div>
        </div>
    </div>
</section>
<!--/ End Feautes -->

<!-- Start Fun-facts -->
<div id="fun-facts" class="fun-facts section overlay">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="single-fun">
                    <i class="icofont icofont-home"></i>
                    <div class="content">
                        <span class="counter">3468</span>
                        <p>Hospital Rooms</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont icofont-user-alt-3"></i>
                    <div class="content">
                        <span class="counter" id="win-ratio">98</span>
                        <p>IDR Win ration</p> 
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont-simple-smile"></i>
                    <div class="content">
                        <span class="counter">15</span>
                        <p>Specialties</p>
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Fun -->
                <div class="single-fun">
                    <i class="icofont icofont-table"></i>
                    <div class="content">
                        <span class="counter">8</span>
                        <p>Years of Experience</p>
                    </div>
                </div>
                <!-- End Single Fun -->
            </div>
        </div>
    </div>
</div>
<!--/ End Fun-facts -->

<!-- Start Why choose -->
<section class="why-choose section" style="padding: 60px 0;">
    <div class="container">
        <div class="row">
            <!-- Start Choose Left -->
            <div class="col-lg-6 col-12">
                <div class="choose-left">
                    <h3 class="section-heading" style="font-size: 28px; font-weight: 600; color: #333;">Who We Are</h3>
                    <p style="font-size: 16px; line-height: 1.6; color: #555;">At Aurorize Healthcare Solutions, we are a dedicated team of healthcare billing professionals committed to optimizing the revenue cycle for medical practices, hospitals, and healthcare providers. With years of experience in the industry, we specialize in providing comprehensive, accurate, and timely medical billing solutions that ensure maximum reimbursement with minimal stress.</p>
                    <p style="font-size: 16px; line-height: 1.6; color: #555;">Our team consists of certified coders, billing experts, and compliance specialists who are well-versed in the complexities of medical billing and insurance claims. We understand the unique challenges faced by healthcare providers, from navigating evolving regulations to managing payer negotiations. That's why we focus on streamlining your billing process, reducing claim denials, and improving cash flow so you can focus on what matters most—delivering quality patient care.</p>
                    <p style="font-size: 16px; line-height: 1.6; color: #555;">We pride ourselves on delivering personalized, transparent, and results-driven services. Whether you're a small clinic or a large healthcare system, we tailor our solutions to meet your specific needs, ensuring that you receive the highest level of support and expertise at every step of the process.</p>
                </div>
            </div>
            <!-- End Choose Left -->

            <!-- Start Choose Right -->
            <div class="col-lg-6 col-12">
                <div class="choose-right">
                    <h3 class="section-heading" style="font-size: 28px; font-weight: 600; color: #333;">Why Choose Us?</h3>
                    <div class="row">
                        <!-- List of reasons with icons -->
                        <div class="col-lg-6 col-md-6">
                            <ul class="list" style="padding-left: 0; list-style: none;">
                                <li style="margin-bottom: 20px; font-size: 16px; color: #555;"><i class="fa fa-caret-right" style="color: #ff6600; margin-right: 8px;"></i><strong>Industry Expertise</strong></li>
                                <p style="font-size: 14px; color: #777;">Years of experience in medical billing and coding across multiple specialties.</p>
                                <li style="margin-bottom: 20px; font-size: 16px; color: #555;"><i class="fa fa-caret-right" style="color: #ff6600; margin-right: 8px;"></i><strong>End-to-End Solutions</strong></li>
                                <p style="font-size: 14px; color: #777;">From claim submission to reimbursement, we handle every aspect of the billing process.</p>
                                <li style="margin-bottom: 20px; font-size: 16px; color: #555;"><i class="fa fa-caret-right" style="color: #ff6600; margin-right: 8px;"></i><strong>Accuracy & Compliance</strong></li>
                                <p style="font-size: 14px; color: #777;">We prioritize accuracy and compliance with ever-changing healthcare regulations to ensure your practice remains profitable and compliant.</p>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <ul class="list" style="padding-left: 0; list-style: none;">
                                <li style="margin-bottom: 20px; font-size: 16px; color: #555;"><i class="fa fa-caret-right" style="color: #ff6600; margin-right: 8px;"></i><strong>Customized Services</strong></li>
                                <p style="font-size: 14px; color: #777;">We tailor our approach to fit the specific needs of your practice, whether it's handling insurance claims, managing denials, or optimizing your revenue cycle.</p>
                                <li style="margin-bottom: 20px; font-size: 16px; color: #555;"><i class="fa fa-caret-right" style="color: #ff6600; margin-right: 8px;"></i><strong>Client-Centered Approach</strong></li>
                                <p style="font-size: 14px; color: #777;">Your success is our success. We build long-term partnerships with our clients by delivering superior service and measurable results.</p>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Choose Right -->
        </div>
    </div>
</section>

<!--/ End Why choose -->

<!-- Start Call to action -->
<!-- <section class="call-action overlay" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="content">
                    <h2>Do you need Emergency Medical Care? Call @ 1234 56789</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque porttitor dictum turpis nec gravida.</p>
                    <div class="button">
                        <a href="#" class="btn">Contact Now</a>
                        <a href="#" class="btn second">Learn More<i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--/ End Call to action -->

<!-- Start portfolio -->
<!-- <section class="portfolio section" >
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>We Maintain Cleanliness Rules Inside Our Hospital</h2>
                    <img src="img/section-img.png" alt="#">
                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="owl-carousel portfolio-slider">
                    <div class="single-pf">
                        <img src="img/pf1.jpg" alt="#">
                        <a href="portfolio-details.html" class="btn">View Details</a>
                    </div>
                    <div class="single-pf">
                        <img src="img/pf2.jpg" alt="#">
                        <a href="portfolio-details.html" class="btn">View Details</a>
                    </div>
                    <div class="single-pf">
                        <img src="img/pf3.jpg" alt="#">
                        <a href="portfolio-details.html" class="btn">View Details</a>
                    </div>
                    <div class="single-pf">
                        <img src="img/pf4.jpg" alt="#">
                        <a href="portfolio-details.html" class="btn">View Details</a>
                    </div>
                    <div class="single-pf">
                        <img src="img/pf1.jpg" alt="#">
                        <a href="portfolio-details.html" class="btn">View Details</a>
                    </div>
                    <div class="single-pf">
                        <img src="img/pf2.jpg" alt="#">
                        <a href="portfolio-details.html" class="btn">View Details</a>
                    </div>
                    <div class="single-pf">
                        <img src="img/pf3.jpg" alt="#">
                        <a href="portfolio-details.html" class="btn">View Details</a>
                    </div>
                    <div class="single-pf">
                        <img src="img/pf4.jpg" alt="#">
                        <a href="portfolio-details.html" class="btn">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--/ End portfolio -->

<!-- Start service -->
<section class="services section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Redefining Efficiency in Medical Billing</h2>
                    <img src="{{ Helper::assets('front_assets/img/section-img.png')}}" alt="#">
                    <p>We drive an increase in your monthly revenue by optimizing reimbursement, closing revenue gaps, and streamlining workflows for maximum efficiency and results. Our tailored billing process is designed to enhance your financial performance without compromising on accuracy or compliance.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="icofont-prescription"></i>
                    <h4><a href="javascript:void(0);">Enhanced Billing Process</a></h4>
                    <p>At Aurorize, with our optimized approach to handling billing operations we improve the speed, accuracy, and overall effectiveness of the entire billing process.</p>    
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="icofont-clock-time"></i>
                    <h4><a href="javascript:void(0);">Timely Billing</a></h4>
                    <p>We prioritize timely billing, dispatching invoices within 48-72 hours to uphold accuracy and reliability.</p>    
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="icofont-check-circled"></i>
                    <h4><a href="javascript:void(0);">Strict Quality Assurance</a></h4>
                    <p>Each charge undergoes a dual meticulous review process by our quality analysts to ensure accuracy before submission to payers.</p>    
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="icofont-close-circled"></i>
                    <h4><a href="javascript:void(0);">Prompt Rejection Handling</a></h4>
                    <p>We identify and resolve rejections within 24 hours, enabling fast claim resubmission.</p>    
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="icofont-ban"></i>
                    <h4><a href="javascript:void(0);">Proactive Denial Management</a></h4>
                    <p>Diligent in their approach, our AR team pinpoints denial causes and takes corrective action to stop reoccurrences.</p>    
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="icofont-credit-card"></i>
                    <h4><a href="javascript:void(0);">Streamlined Payment Processing</a></h4>
                    <p>We promote EFTs and ERAs to facilitate prompt claims payments and efficient posting workflows.</p>    
                </div>
                <!-- End Single Service -->
            </div>
            
            <!-- Centered Persistent Follow-ups Section -->
            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center mx-auto">
                <!-- Start Single Service -->
                <div class="single-service text-center">
                    <i class="icofont-refresh"></i>
                    <h4><a href="javascript:void(0);">Persistent Follow-ups</a></h4>
                    <p>Our proactive, fortnightly claims follow-up strategy maintains AR days under 30 days, optimizing cash flow.</p>    
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!--/ End service -->

<!-- Pricing Table -->
<section class="pricing-table section schedule">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">
                <h2>We deliver our expertise to numerous specialties across the healthcare field.</h2>
                <img src="{{ Helper::assets('front_assets/img/section-img.png')}}" alt="#">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="schedule-inner">
            <div class="row">
                <!-- Start of schedule cards -->
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-cut"></i>
                            </div>
                            <div class="single-content">
                                <span>Plastic and Reconstructive Surgery</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-heartbeat"></i>
                            </div>
                            <div class="single-content">
                                <span>Pain Management</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-stethoscope"></i>
                            </div>
                            <div class="single-content">
                                <span>Neurology & Neurosurgery</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add remaining specialties here, reducing redundancy -->
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-medkit"></i>
                            </div>
                            <div class="single-content">
                                <span>Cardiology</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-syringe"></i>
                            </div>
                            <div class="single-content">
                                <span>General Surgery</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-heartbeat"></i>
                            </div>
                            <div class="single-content">
                                <span>Pulmonology</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-ribbon"></i>
                            </div>
                            <div class="single-content">
                                <span>Oncology</span>
                            </div>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-user-md"></i>
                            </div>
                            <div class="single-content">
                                <span>Anesthesiology</span>
                            </div>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-thermometer"></i>
                            </div>
                            <div class="single-content">
                                <span>Chiropractic</span>
                            </div>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="single-content">
                                <span>Family Practice</span>
                            </div>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-dumbbell"></i>
                            </div>
                            <div class="single-content">
                                <span>Physical Therapy</span>
                            </div>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-radiation"></i>
                            </div>
                            <div class="single-content">
                                <span>Radiology</span>
                            </div>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-user-md"></i>
                            </div>
                            <div class="single-content">
                                <span>Ambulatory Surgical Center</span>
                            </div>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-user-md"></i>
                            </div>
                            <div class="single-content">
                                <span>Durable Medical Equipment</span>
                            </div>
                        </div>
                    </div>
                </div><div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-user-md"></i>
                            </div>
                            <div class="single-content">
                                <span>Wound Care</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Repeat for other specialties as needed -->
            </div>
        </div>
    </div>
</section>


<!--/ End Pricing Table -->



<!-- Start Blog Area -->
<section class="blog section" id="blog">
    <div class="container">
        <!-- Section Title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>We are HIPAA Compliant & to protect PHI is our utmost priority</h2>
                    <img src="{{ Helper::assets('front_assets/img/section-img.png')}}" alt="#">
                    <p>Trust Aurorize Healthcare Solutions to be your partner in achieving financial success while you focus on providing exceptional patient care.</p>
                </div>
            </div>
        </div>

        <!-- Blocks for HIPAA Compliance Details -->
        <div class="row">
            <!-- Block 1: HIPAA-Trained Personnel -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-news">
                    <div class="news-body">
                        <div class="news-content">
                            <h2><a href="javascript:void(0);">HIPAA-Trained Personnel</a></h2>
                            <p class="text">Our team undergoes regular HIPAA training and assessments to ensure full compliance.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Block 2: Secure Environment -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-news">
                    <div class="news-body">
                        <div class="news-content">
                            <h2><a href="javascript:void(0);">Secure Environment</a></h2>
                            <p class="text">Our facilities feature 24/7 CCTV monitoring and advanced security measures for confidentiality.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Block 3: Continuous Evaluation -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-news">
                    <div class="news-body">
                        <div class="news-content">
                            <h2><a href="javascript:void(0);">Continuous Evaluation</a></h2>
                            <p class="text">We regularly review technology solutions to meet HIPAA standards and protect patient data.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Block 4: Secure IT Infrastructure -->
            <div class="col-lg-4 col-md-6 col-12 mt-3">
                <div class="single-news">
                    <div class="news-body">
                        <div class="news-content">
                            <h2><a href="javascript:void(0);">Secure IT Infrastructure</a></h2>
                            <p class="text">Our cloud and server systems are equipped with robust security protocols to minimize risks.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Block 5: Regular Audits -->
            <div class="col-lg-4 col-md-8 col-12 mt-3">
                <div class="single-news">
                    <div class="news-body">
                        <div class="news-content">
                            <h2><a href="javascript:void(0);">Regular Audits</a></h2>
                            <p class="text">We perform routine audits to ensure compliance and safeguard healthcare data integrity.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-12"></div>
        </div> <!-- End of row for blocks -->

    </div> <!-- End of container -->
</section>
<!-- End Blog Area -->

<!-- Start clients -->
<div class="clients overlay">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="owl-carousel clients-slider">
                    <div class="single-clients">
                        <img src="{{ Helper::assets('front_assets/img/eclinical.png')}}" height="200" width="200" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="{{ Helper::assets('front_assets/img/nextech.svg')}}" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="{{ Helper::assets('front_assets/img/nextgen.svg')}}" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="{{ Helper::assets('front_assets/img/practicefusion.svg')}}" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="{{ Helper::assets('front_assets/img/Progno.png')}}" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="{{ Helper::assets('front_assets/img/veradigm.svg')}}" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="{{ Helper::assets('front_assets/img/advancemd.svg')}}" alt="#">
                    </div>
                    <div class="single-clients">
                        <img src="{{ Helper::assets('front_assets/img/epic.png')}}" alt="#">
                    </div>
                    <!-- <div class="single-clients">
                        <img src="{{ Helper::assets('front_assets/img/client4.png')}}" alt="#">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Ens clients -->

<!-- Start Appointment -->
<section class="appointment">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>We Are Always Ready to Help You. Book A Demo!</h2>
                    <img src="{{ Helper::assets('front_assets/img/section-img.png')}}" alt="#">
                </div>
            </div>
        </div>
        <div class="row"> 
                <div class="col-lg-12">
                    <div class="contact-us-form">
                        <form class="form" id="contact_form" method="post" action="{{ route('home.inquiry.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Name" required>
                                        @error('name')
                                            <label id="name-error" class="invalid-feedback" for="name">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Email" required>
                                        @error('email')
                                            <label id="email-error" class="invalid-feedback" for="email">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="subject" id="subject" placeholder="Subject" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Your Message" id="message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-06 align-center">
                                    <div class="form-group login-btn">
                                        <button type="submit" class="btn" type="submit">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
            </div>
    </div>
</section>
<!-- End Appointment -->

<!-- Start Newsletter Area -->
<!-- <section class="newsletter section">
    <div class="container">
        <div class="row ">
            <div class="col-lg-6  col-12">
                <div class="subscribe-text ">
                    <h6>Sign up for newsletter</h6>
                    <p class="">Cu qui soleat partiendo urbanitas. Eum aperiri indoctum eu,<br> homero alterum.</p>
                </div>
            </div>
            <div class="col-lg-6  col-12">
                <div class="subscribe-form ">
                    <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                        <input name="EMAIL" placeholder="Your email address" class="common-input" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Your email address'" required="" type="email">
                        <button class="btn">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- /End Newsletter Area -->

@endsection