<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - BuyBay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel='stylesheet' id='fontawesome-css' href='https://use.fontawesome.com/releases/v5.0.1/css/all.css?ver=4.9.1' type='text/css' media='all' />
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>
        .blog-content {
            padding: 100px 20px 20px; /* Adjusted to account for fixed navbar */
            background-color: #f9f9f9;
        }
        .blog-content h2, .blog-content h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .blog-content h1 {
            text-align: center;
            margin-top: 80px; /* Added space between header and this heading */
        }
        .creators, .special-thanks {
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 5px;
            margin: 20px 0;
        }
        .creators h5, .special-thanks h5 {
            margin-top: 10px;
        }
        .creators p, .special-thanks p {
            margin: 0;
        }
        .happy-shopping {
            color: coral;
            font-weight: bold;
        }
        .content-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .content-section img {
            max-width: 100%;
            height: auto;
        }

        
            .creators ul li,
            .special-thanks ul li {
                margin-bottom: 10px; 
            }

    </style>
</head>
<body>
    <?php include('layout/header.php'); ?>

    
    <div class="container blog-content">
    <h1 class="text-center mb-5">Welcome to the BuyBay Blog</h1>
    <p>Hey there! Welcome to BuyBay, your ultimate shopping destination. We are thrilled to share what makes our site unique and how we strive to offer you the best online shopping experience. At BuyBay, we believe that shopping should be enjoyable, convenient, and tailored to your lifestyle. Let's dive in!</p>
    <blockquote class="text-center">
        <p><strong>BuyBay: The Bay of Happy Lifestyle</strong></p>
    </blockquote>
    <p>At BuyBay, we combine modern design with user-friendly features to make your shopping journey smooth and enjoyable. Here’s a glimpse of what we offer:</p>

    <ul>
        <li>
            <strong>A Modern Home Page</strong>
            <p>Our home page provides a vibrant snapshot of our top products, featured prominently for your convenience. The sleek navigation bar, present on every page, includes quick links to Home, Shop, Blog, Contact, Cart, and your Account, ensuring you can navigate effortlessly.</p>
        </li>

        <li>
            <strong>Seamless Shopping Experience</strong>
            <p>Click on the Shop button, and you're taken to our extensive product catalog. Browse through our diverse offerings with ease using pagination, and our powerful search feature lets you filter products by category and price, helping you find exactly what you're looking for.</p>
        </li>

        <li>
            <strong>Detailed Product Information</strong>
            <p>Select a product to be redirected to its detailed page, where you can learn more about it, read reviews from other users, leave your own review, add it to your wishlist, or simply add it to your cart. We provide all the information you need to make an informed decision.</p>
        </li>

        <li>
            <strong>Manage Your Cart</strong>
            <p>In your cart, view all the products you’ve selected. You can easily adjust quantities or remove items effortlessly. Ready to buy? Proceed to checkout from here, where the process is simple and intuitive.</p>
        </li>

        <li>
            <strong>Easy Checkout Process</strong>
            <p>On the checkout page, simply provide your delivery address and place your order. You will then be directed to our payment page to complete your purchase, making the entire process quick and hassle-free.</p>
        </li>

        <li>
            <strong>Flexible Payment Options</strong>
            <p>Our payment page offers multiple methods for you to pay for your order. Choose the one that suits you best, whether it’s credit card, debit card, or other methods, and you're all set!</p>
        </li>

        <li>
            <strong>Your Personal Account</strong>
            <p>Your account page is a hub of all your activities on BuyBay. View your order history, reviews, and wishlist in one place. Track orders and make payments directly from your order table, or buy products from your wishlist easily.</p>
        </li>

        <li>
            <strong>Get in Touch</strong>
            <p>Our contact page allows you to reach out to BuyBay via email, phone, or direct message. We strive to respond within a day, ensuring your queries are addressed promptly. Your satisfaction is our top priority, and we’re here to assist you!</p>
        </li>
    </ul>

    <h3>Our Commitment to You</h3>
    <p>At BuyBay, we’re not just about selling products. We’re about creating an experience that’s safe, user-friendly, and tailored to your needs. Our robust admin panel allows us to:</p>
    <ul>
        <li>Upgrade products based on your feedback</li>
        <li>Track orders and payments efficiently</li>
        <li>Maintain a bug-free environment</li>
    </ul>
    <p><em>Your safety and satisfaction are our top priorities. We aim to offer a happy and seamless shopping experience every time you visit BuyBay.</em></p>

   

    <section class="mb-4">
        <h2>Online Shopping Tricks and Tips</h2>
        <p>Discover the best practices for online shopping to enhance your BuyBay experience. <a href="https://www.consumer.org.nz/articles/7-tips-for-online-shopping" target="_blank">Click here to Learn more</a></p>
    </section>

      <h2 class="text-center">FAQs</h2>
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    How to Create a BuyBay Account?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    It's simple! Click on the account icon in the navbar, fill in your details, and register. You're all set!
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How to Shop on BuyBay?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Log in to your account, browse products, add them to your cart, and proceed to checkout. Provide your details and place your order. Pay, and your order will be shipped to your address.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Can I Browse Without an Account?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, you can browse and view all products and details as a guest.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    What Happens if I Don't Pay for My Order?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Your order will be on hold for 7 days. If not paid within that period, it will be canceled.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    How to Pay on BuyBay?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Use our Smart Payment Technique. Choose your preferred payment method at checkout, and BuyBay will charge the amount automatically.
                </div>
            </div>
        </div>
    </div>
    

<div class="content-section my-5">
    <div class="creators">
        <h3>Creators</h3>
        <ul>
            <li>Ridwanul Islam Sanji -Full Stack Project Architect, Lead Developer. Aust CSE 47</li>
            <li>Muhaiminul Haq Mumit - Backend Specialist. Aust CSE 47</li>
            <li>Sumi Akter - Front End Specialist. Aust CSE 47</li>
        </ul>
    </div>

    

    <img src="assets/imgs/logo1.png" alt="BuyBay Logo" class="mx-auto d-block my-3" style="max-width: 200px;">

    <div class="special-thanks">
        <h3>Special Thanks To:</h3>
        <ul>
            <li>Dr. Taslim Taher, Assistant Professor, Department of CSE</li>
            <li>Ms. Tasnuva Binte Rahman, Lecturer, Department of CSE</li>
        </ul>
    </div>
</div>


    <h4 class="text-center">Happy Shopping, Safe Shopping with <a href="shop.php" class="happy-shopping">BuyBay</a>!</h4>
</div>


    <?php include('layout/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pqDlfcVLH8QX/+PLGVX1iq4UmXzBzMPx+rcZ61afzzyOD7/6RgAcN6JPEImNVTNY" crossorigin="anonymous"></script>
</body>
</html>
