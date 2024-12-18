


@extends('layouts.app')
@section('title') IDR @endsection


@section('css')
<style>

body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f7fc;
    color: #333;
}

/* Hero Section */
.hero-section {
    /* background: linear-gradient(to right, #00b4d8, #007bff); */
    color: white;
    padding: 80px 0;
    text-align: center;
}

.hero-section .main-heading {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 20px;
}

.hero-section .hero-text {
    font-size: 20px;
    margin-bottom: 30px;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

.cta-button {
    background-color: #ff6f61;
    padding: 15px 30px;
    color: white;
    font-size: 18px;
    text-decoration: none;
    border-radius: 25px;
    transition: background-color 0.3s ease;
}

.cta-button:hover {
    background-color: #d7564b;
}

/* How We Help Section */
.how-we-help {
    padding: 60px 0;
    background-color: #ffffff;
}

.section-heading {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    text-align: center;
    margin-bottom: 40px;
}

.help-cards {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.help-card {
    background-color: #f8f8f8;
    padding: 30px;
    margin: 15px;
    width: 22%;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease;
}

.help-card:hover {
    transform: translateY(-10px);
}

.help-card .icon {
    font-size: 40px;
    color: #007bff;
    margin-bottom: 20px;
}

.help-card h3 {
    font-size: 22px;
    color: #333;
    font-weight: 600;
    margin-bottom: 15px;
}

.help-card p {
    font-size: 16px;
    color: #777;
    line-height: 1.5;
}

/* Why Choose Us Section */
.why-choose-us {
    background-color: #f8f9fa;
    padding: 50px 0;
}

.why-choose-us .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.why-choose-us .section-heading {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 40px;
    text-align: center;
    color: #333;
}

.reasons {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 30px;
}

.reason {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: 22%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.reason:hover {
    transform: translateY(-10px);
}

.icon {
    font-size: 40px;
    color: #007bff;
    margin-bottom: 15px;
}

.reason p {
    font-size: 18px;
    margin: 10px 0;
}

.reason .description {
    font-size: 14px;
    color: #777;
    line-height: 1.5;
    margin-top: 10px;
}


/* CTA Section */
.cta-section {
    /* background-color: #007bff; */
    color: white;
    padding: 60px 0;
    text-align: center;
}

.cta-heading {
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 20px;
}

.cta-text {
    font-size: 20px;
    margin-bottom: 30px;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}



/* Responsive Design */
@media (max-width: 768px) {
    .help-cards {
        flex-direction: column;
    }

    .reason {
        flex: 1 1 100%;
        margin-bottom: 20px;
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
    <div class="breadcrumbs overlay">
    <div class="container">
        <div class="bread-inner">
        <div class="row">
            <div class="col-12">
            <h2>IDR</h2>
            <ul class="bread-list">
                <li><a href="https://www.free-css.com/free-css-templates">IDR</a></li>
                <li><i class="icofont-simple-right"></i></li>
                <li class="active">Independent Dispute Resolution</li><br>
                <li>The U.S. federal government released the final rule on the No Surprises Act, establishing clear guidelines for how out-of-network medical bills will be reimbursed when providers and payers cannot reach an agreement, and the case enters independent dispute resolution (IDR).</li>
            </ul>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
<!--/ End Slider Area -->

<section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="main-heading">Independent Dispute Resolution for Out-of-Network Claims</h1>
                <p class="hero-text">
                    Tired of the headaches with out-of-network claims disputes? Let Aurorize take the hassle out of the process! Our Independent Dispute Resolution (IDR) services are here to help you secure fair reimbursement under the No Surprises Act.
                </p>
                <a href="{{route('home.inquiry')}}" class="cta-button">Get Your Free Consultation</a>
            </div>
        </div>
    </section>

    <!-- How We Help Section -->
    <section class="how-we-help">
        <div class="container">
            <h2 class="section-heading">How We Help with IDR for OON Claims</h2>
            <div class="help-cards">
                <div class="help-card">
                    <div class="icon"><i class="fa fa-search"></i></div>
                    <h3>Detailed Case Analysis</h3>
                    <p>We dive deep into every claim, meticulously assessing procedural details, patient acuity, and service complexity. Our comprehensive analysis builds a rock-solid foundation for your case, showcasing the unique elements that warrant fair reimbursement!</p>
                </div>
                <div class="help-card">
                    <div class="icon"><i class="fa fa-credit-card"></i></div>
                    <h3>Fair Reimbursement Benchmarking</h3>
                    <p>Using cutting-edge data sources like Fair Health, we determine an appropriate reimbursement range that reflects the true value of your services. With our insightful benchmarking, we’ll make a compelling case that your billed amount is not just justified but essential!</p>
                </div>
                <div class="help-card">
                    <div class="icon"><i class="fa fa-file"></i></div>
                    <h3>Documentation and Submission</h3>
                    <p>Success in IDR hinges on impeccable documentation! We handle every detail, ensuring that all requirements are met with precision. You can count on us for a seamless submission process that’s compliant and comprehensive!</p>
                </div>
                <div class="help-card">
                    <div class="icon"><i class="fa fa-comments"></i></div>
                    <h3>Expert Negotiation</h3>
                    <p>With our remarkable 98% win ratio, our skilled negotiators are ready to advocate for you! We present compelling, data-driven arguments to IDR entities, maximizing your chances of a favorable outcome. You can trust us to leverage our deep knowledge of medical billing and the No Surprises Act to your advantage!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us">
        <div class="container">
            <h2 class="section-heading">Why Choose Aurorize for IDR?</h2>
            <div class="reasons">
                <div class="reason">
                    <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                    <p><strong>Proven Success</strong> with a 98% Win Ratio</p>
                    <p class="description">Our results speak volumes! With a phenomenal 98% success rate in securing fair outcomes through IDR, healthcare providers rely on us to deliver the results they need. Join the ranks of satisfied clients who trust us to fight for their financial well-being!</p>
                </div>
                <div class="reason">
                    <div class="icon"><i class="fa fa-book"></i></div>
                    <p><strong>In-Depth Knowledge</strong> of IDR Regulations</p>
                    <p class="description">Our team stays on the cutting edge of IDR guidelines and industry trends, ensuring that you receive the most appropriate reimbursement. We make navigating this complex landscape a breeze!</p>
                </div>
                <div class="reason">
                    <div class="icon"><i class="fa fa-cogs"></i></div>
                    <p><strong>Experience</strong> with Complex Cases</p>
                    <p class="description">Whether it’s high-acuity procedures or intricate multi-stage surgical interventions, we understand the complexities that influence fair reimbursement. Count on us to effectively communicate the value of your services!</p>
                </div>
                <div class="reason">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <p><strong>Commitment</strong> to Provider Advocacy</p>
                    <p class="description">Your success is our mission! We are passionate about achieving fair compensation for providers, allowing you to focus on delivering top-notch patient care without the burden of financial uncertainty.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section id="contact-us" class="cta-section">
        <div class="container">
            <h2 class="cta-heading">Ready to resolve your OON claim disputes?</h2>
            <p class="cta-text">Contact us today to schedule a free consultation and get started on your path to fair reimbursement!</p>
            <a href="mailto:contact@aurorize.com" class="cta-button">Contact Us</a>
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