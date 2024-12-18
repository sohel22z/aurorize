


@extends('layouts.app')

@section('title') RCM @endsection

@section('css')
<style>
/* Pop-up Container */
.popup-container {
    display: none; /* Hidden by default */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    z-index: 9999;
    justify-content: center; /* Horizontally center (only works if display is flex) */
    align-items: center; /* Vertically center (only works if display is flex) */
    transition: opacity 0.3s ease;
}

/* Show popup when active */
.popup-container.active {
    display: flex; /* Makes the container visible */
    opacity: 1;
}

/* Pop-up Content */
.popup-content {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 90%;
    text-align: center;
    transition: transform 0.3s ease;
    animation: popup-entry 0.4s ease-out;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* Pop-up Heading */
.popup-content h3 {
    font-size: 24px;
    color: #333;
    font-weight: bold;
    margin-bottom: 15px;
}

/* Pop-up Paragraph */
.popup-content p {
    font-size: 16px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 25px;
    padding: 0 10px;
}

/* Close Button */
.popup-content .close {
    font-size: 30px;
    color: #333;
    position: absolute;
    top: 15px;
    right: 20px;
    cursor: pointer;
    transition: color 0.3s;
}

/* Close Button Hover Effect */
.popup-content .close:hover {
    color: #e74c3c;
}

/* Animation for Pop-up */
@keyframes popup-entry {
    0% {
        transform: scale(0.8);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

/* For small screens (Mobile) */
@media (max-width: 600px) {
    .popup-content {
        padding: 20px;
        width: 90%;
    }

    .popup-content h3 {
        font-size: 20px;
    }

    .popup-content p {
        font-size: 14px;
    }
}




.schedule {
	background: #fff;
	margin: 0;
	padding: 0;
	height: auto;
	padding: 50px 0;
	border-bottom:1px solid #eee;
}
.schedule .schedule-inner {
	transform: none;
}
.schedule .single-schedule{
	margin:15px 0;
}
.section{
    padding: 0 !important;
}
    
</style>
@endsection

@section('title')
    About
@endsection
@section('content')

<!-- Slider Area -->
<section class="slider">
    <div class="breadcrumbs overlay">
    <div class="container">
        <div class="bread-inner">
        <div class="row">
            <div class="col-12">
            <h2>RCM</h2>
            <ul class="bread-list">
                <li><a href="https://www.free-css.com/free-css-templates">RCM</a></li>
                <li><i class="icofont-simple-right"></i></li>
                <li class="active">Revenue Cycle Management Services</li><br>
                <li>Simplify Billing, Supercharge Collections: Discover Our RCM Advantage</li>
            </ul>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
<!--/ End Slider Area -->

<section class="Feautes section mt-5 mb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Services</h2>
                    <img src="{{ Helper::assets('front_assets/img/section-img.png')}}" alt="#">
                    <p>These featured services highlight the core offerings of Revenue Cycle Management and demonstrate how our solutions can help healthcare organizations optimize financial performance, improve operational efficiency, and enhance overall patient satisfaction.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="schedule">
    <div class="container">
        <div class="schedule-inner">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-user-md"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="eligibility-verification">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Eligibility Verification</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="benefits-verification">
                                    <div class="trainer-item">
                                    
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Benefits Verification</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-lock"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="Authorization">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Authorization</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="Charge-Verification-Entry">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Charge Verification & Entry</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="Clearing-House-Rejections">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Clearing House Rejections</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-calculator"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="Accounts-Receivable-Management">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Account Receivable (AR)</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-times-circle"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="Denial-Management">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Denial Management</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="Provider-Credentialing-Enrollment">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Provider Credentialing & Enrollment</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-table"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="Reportings">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Reportings</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Repeat for other specialties as needed -->
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-undo"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="OLD-AR-Revenue-Recovery">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Old A/R Revenue Recovery</h4>
                                        </div>
                                    </div>
                                </a>
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
                                <a href="javascript:void(0);" class="open-popup" data-popup="Practice-Health-Measurement">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Practice Health Measurement</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="single-schedule">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-credit-card"></i>
                            </div>
                            <div class="single-content">
                                <a href="javascript:void(0);" class="open-popup" data-popup="Payment-Posting">
                                    <div class="trainer-item">
                                        <div class="image-thumb">
                                            <img src="assets/images/corrective.png" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4>Payment posting</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Repeat for other specialties as needed -->
            </div>
        </div>
    </div>


    <div id="eligibility-verification" class="popup-container">
        <div class="popup-content">
            <a href="javascript:void(0);" class="close-popup">&times;</a>
            <h3>Eligibility Verification</h3>
            <p>
                Before the provider delivers services, we confirm the patient's existing insurance eligibility, update their account with the latest insurance eligibility status, and identify and address any potential issues.
            </p>
        </div>
    </div>

    <div id="benefits-verification" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>Benefits Verification</h3>
            <p>Before services are provided by the provider, we check patient benefits and deductible balances in their account.</p>
        </div>
    </div>
    <div id="Authorization" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>Authorization</h3>
        <p>We proactively initiate and diligently pursue pre-authorizations with payers as needed, ensuring our clients can provide services to patients with confidence in timely payment.</p>
        </div>
    </div>
    <div id="Charge-Verification-Entry" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>Charge Verification & Entry</h3>
        <p>We adhere to a meticulous claims scrubbing process during charge posting, aimed at optimizing initial reimbursements from insurers while reducing denial rates to a minimum.</p>
        </div>
    </div>
    <div id="Clearing-House-Rejections" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>Clearing House Rejections</h3>
        <p>Clearing House Rejections: Once the claims are submitted to the insurance clearing house it tends to reject due to their internal edits or for some other reasons. We ensure claims passed through the clearing house and if not we meticulously resolve those rejections very same day or very next day, once they hit the clearing house.</p>
        </div>
    </div>
    <div id="Accounts-Receivable-Management" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>Accounts Receivable Management</h3>
        <p>Our Accounts Receivable (AR) team conducts thorough comparisons between expected and actual collections, identifying any discrepancies and implementing corrective measures to resolve them. Our systematic and regulated processes across each stage of the revenue cycle enable our AR team to maintain Days in AR below 25. Upon onboarding a new client, we conduct an initial analysis of older outstanding receivables, taking proactive steps to recover as much revenue as possible from claims filed before the client's engagement with us.Unpaid claims are managed using a prioritized approach, with a focus on high-value claims and those nearing insurance timely filing limits. Additionally, any discrepancies in contracted amounts or reimbursement rates from insurance companies are flagged for further investigation and corrective action.</p>
        </div>
    </div>
    <div id="Denial-Management" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>Denial Management</h3>
        <p>Upon receiving Explanation of Benefits (EOBs), any claims that are denied undergo thorough analysis to identify the reasons for the denial. Our team promptly corrects any errors or discrepancies and prepares the necessary adjustments for resubmission. This process is completed within two working days to ensure timely resolution and maximize the chances of claim acceptance upon resubmission. By addressing denials swiftly and accurately, we strive to minimize disruptions in the reimbursement process and maintain efficient revenue cycle management.</p>
        </div>
    </div>
    <div id="Provider-Credentialing-Enrollment" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>Provider Credentialing & Enrollment</h3>
        <p>We have a dedicated team specializing in healthcare insurance enrollment, EFT & ERA enrollment and credentialing. Our primary objective is to minimize errors, anticipate potential challenges, and expedite the process of getting you enrolled on the insurance panel of participating providers, all while ensuring ongoing compliance. Aurorize ensures the confidentiality and security of provider information at all times.</p>
        </div>
    </div>
    <div id="Reportings" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>Reportings</h3>
        <p>We offer tailored performance reports designed to meet the specific requirements of each client. These reports are customized to provide insights and metrics that are relevant and valuable to our clients' operations & for decision making. Whether it's analyzing key performance indicators, tracking revenue cycles, monitoring claim processing efficiency, or assessing provider productivity, we ensure that the reports align with our clients' objectives and priorities.</p>
        </div>
    </div>
    <div id="OLD-AR-Revenue-Recovery" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>OLD AR Revenue Recovery</h3>
        <p>We prioritize the recovery of revenue from aged Accounts Receivable (AR). While some billing companies may overlook this aspect, we recognize the substantial potential for revenue recuperation in old AR. Utilizing detailed reports, we meticulously identify aged claims that hold potential for revenue collection. By focusing on this area, we aim to maximize revenue recapture opportunities and optimize financial performance for our clients. Our proactive approach ensures that no revenue opportunities are left unexplored, contributing to the overall financial health and success of our clients' practices.</p>
        </div>
    </div>
    <div id="Practice-Health-Measurement" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>Practice Health Measurement</h3>
        <p>Through the utilization of comparative quarterly reports, we conduct in-depth analyses of practice health, enabling us to discern its current trajectory and forecast future outcomes. These reports offer a comprehensive overview of key performance indicators and financial metrics over time, allowing for a detailed examination of trends and patterns. By comparing data across different quarters, we can identify areas of improvement, potential challenges, and emerging opportunities. This analytical approach provides valuable insights into the overall health of the practice, highlighting areas of strength and areas that may require attention. Armed with this knowledge, we can make informed decisions and implement strategic initiatives to steer the practice towards its desired goals and objectives. Ultimately, our goal is to empower our clients with the information and insights needed to optimize practice performance, enhance efficiency, and drive sustainable growth over time.</p>
        </div>
    </div>
    <div id="Payment-Posting" class="popup-container popup-style-2">
        <div class="popup-content">
            <a href="#" class="close">&times;</a>
            <h3>Payment Posting</h3>
        <p>Insurance payments are promptly applied to patient accounts based on the information provided in the Explanation of Benefits (EOB). Within 24 hours of receipt, all payments are recorded.For payers without Electronic Remittance Advice (ERA), our team manually enters insurance payments into patient accounts, aligning them with the respective allowed amounts for each service.To guarantee accuracy, we reconcile bank deposits with total payments recorded in the Practice Management System (PMS). In cases of co-insurance, any outstanding charges are submitted to secondary insurance following coordination of benefits protocols. Patient responsibilities such as deductibles, copays, and Out-of-Pocket expenses outlined by the insurance are billed to the patient upon statement generation. Prior to issuing statements, we verify account balances to ensure patients are only billed for applicable amounts. Statements are generated monthly.</p>
        </div>
    </div>
</section>

@endsection


@section('script-bottom')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Open popup
        document.querySelectorAll('.open-popup').forEach(function (btn) {
            btn.addEventListener('click', function (event) {
                event.preventDefault();
                const popupId = this.getAttribute('data-popup');
                document.getElementById(popupId).style.display = 'block';
            });
        });

        // Close popup
        document.querySelectorAll('.close').forEach(function (btn) {
            btn.addEventListener('click', function (event) {
                event.preventDefault();
                this.closest('.popup-container').style.display = 'none';
            });
        });

        // Close popup on clicking outside
        document.querySelectorAll('.popup-container').forEach(function (popup) {
            popup.addEventListener('click', function (event) {
                if (event.target === this) {
                    this.style.display = 'none';
                }
            });
        });
    });

</script>
@endsection