<?php
// Database configuration

$host = "localhost";
$username = "root";
$password = "";
$dbname = "tourindia";


// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT reviewer_name, review_content, rating, review_date FROM reviews ORDER BY review_date DESC";
$result = $conn->query($sql);

$reviews = [];

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
    
} else {
    echo json_encode($reviews);
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Travel </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

      <style>
        :root{
    scroll-behavior: smooth;
}

#carouselSection .carousel-item {
    position: relative;
}

#carouselSection .carousel-item::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.2); /* Adjust the opacity (last value) as needed */
    z-index: 1;
}

#carouselSection .carousel-item img {
    height: 80vh;
    z-index: 2; /* Ensure the image is above the overlay */
}

*{
    margin:0; 
    padding:0;
    box-sizing: border-box;
    font-family: 'circular';
    outline: none;
    border:none;
    text-decoration: none;
    text-transform: capitalize;
    transition: 0.2s linear;
    background-color:#101511;
}


/* Set scrollbar styles */
html::-webkit-scrollbar-track {
    background: #192119;
}

html::-webkit-scrollbar {
    width: 1rem;
}

html::-webkit-scrollbar-thumb {
    background: #E78E28;
    border-radius: 5rem;
}


[data-tooltip] {
    position: relative;
    cursor: pointer;
  }
  [data-tooltip]:before,
  [data-tooltip]:after {
    line-height: 1;
    font-size: .9em;
    pointer-events: none;
    position: absolute;
    box-sizing: border-box;
    display: none;
    opacity: 0;
  }
  [data-tooltip]:before {
    content: "";
    border: 5px solid transparent;
    z-index: 100;
  }
  [data-tooltip]:after {
    content: attr(data-tooltip);
    text-align: center;
    min-width: 3em;
    max-width: 21em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 9px 29px;
    border-radius: 10px;
    background: #e78e28;
    color: #FFFFFF;
    z-index: 99;
  }
  [data-tooltip]:hover:before,
  [data-tooltip]:hover:after {
    display: block;
    opacity: 1;
  }
  [data-tooltip]:not([data-flow])::before,
  [data-tooltip][data-flow="top"]::before {
    bottom: 100%;
    border-bottom-width: 0;
    border-top-color: #e78e28;
  }
  [data-tooltip]:not([data-flow])::after,
  [data-tooltip][data-flow="top"]::after {
    bottom: calc(100% + 5px);
  }
  [data-tooltip]:not([data-flow])::before, [tooltip]:not([data-flow])::after,
  [data-tooltip][data-flow="top"]::before,
  [data-tooltip][data-flow="top"]::after {
    left: 50%;
    -webkit-transform: translate(-50%, -4px);
            transform: translate(-50%, -4px);
  }
  [data-tooltip][data-flow="bottom"]::before {
    top: 100%;
    border-top-width: 0;
    border-bottom-color: #e78e28;
  }
  [data-tooltip][data-flow="bottom"]::after {
    top: calc(100% + 5px);
  }
  [data-tooltip][data-flow="bottom"]::before, [data-tooltip][data-flow="bottom"]::after {
    left: 50%;
    -webkit-transform: translate(-50%, 8px);
            transform: translate(-50%, 8px);
  }
  [data-tooltip][data-flow="left"]::before {
    top: 50%;
    border-right-width: 0;
    border-left-color: #e78e28;
    left: calc(0em - 5px);
    -webkit-transform: translate(-8px, -50%);
            transform: translate(-8px, -50%);
  }
  [data-tooltip][data-flow="left"]::after {
    top: 50%;
    right: calc(100% + 5px);
    -webkit-transform: translate(-8px, -50%);
            transform: translate(-8px, -50%);
  }
  [data-tooltip][data-flow="right"]::before {
    top: 50%;
    border-left-width: 0;
    border-right-color: #e78e28;
    right: calc(0em - 5px);
    -webkit-transform: translate(8px, -50%);
            transform: translate(8px, -50%);
  }
  [data-tooltip][data-flow="right"]::after {
    top: 50%;
    left: calc(100% + 5px);
    -webkit-transform: translate(8px, -50%);
            transform: translate(8px, -50%);
  }
  [data-tooltip=""]::after, [data-tooltip=""]::before {
    display: none !important;
  }
  

html{
    font-size: 62.5%;
    scroll-behavior: smooth;
    scroll-padding-top: 6rem;
    overflow-x: hidden;
}

section{
    padding: 1rem 10% 0rem 10%;
}
#carouselSection {
    padding: 1rem 0.1%;
}

.heading{
    text-align: center;
    font-size: 4rem;
    color: #fff;
    padding: 5rem;
    margin: 5rem 0;
    background: #192119;
}

.heading span{
    color:#e78e28;
    background-color: #161d1600;
    text-decoration: none;
}

.btn{
    display: inline-block;
    margin-top: 1rem;
    border-radius: 1rem;
    background: #cd9258;
    color: #fff;
    padding: 0.9rem 3.5rem;
    cursor: pointer;
    font-size: 1.7rem;
}

.btn:hover{
    background:var(--pink);
    
}

header{
    position: fixed;
    top:0; left:0; right:0;
    background:#192119;
    padding:1rem 5%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 1000;
    box-shadow: 8px 2rem 7rem 11px rgba(0,0,0,.5);
}


header .logo {
    font-size: 3rem;
    color: #E78E28; /* Changed color value */
    font-weight: bolder;
}


header .logo span{
    color: #E78E28;
    background-color: #192119;
}
header .navbar{ 
    background-color: #192119;
}
header .navbar a{
    font-size: 2rem;
    padding:0 1.5rem;
    color:#fff;
    
}

header .navbar a:hover{
    color:#E78E28;
    text-decoration: none;
}
header .icons{
    background-color: #192119;
}
header .icons span{
    background-color: #192119;
}
header .icons a{
    font-size: 2.5rem;
    color:#333;
    margin-left: 1.5rem;
}

header .icons a:hover{
    color:var(--pink);
}

header #toggler{
    display: none;
}

header .fa-bars{
    font-size: 3rem;
    color:#333;
    border-radius: .5rem;
    padding:.5rem 1.5rem;
    cursor: pointer;
    border:.1rem solid rgba(0,0,0,.3);
    display: none;
}

.overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgb(0 0 0 / 50%);
    color: #fff;
    padding: 20px;
    text-align: center;
    border-radius: 1rem;
}

#home {
    margin-left: 20px;
}



.home .content{
    max-width: 50rem;

}

.home .content span{
    font-size: 4.5rem;
    color: #ffffff;
    padding: 1rem 0;
    line-height: 1.5;
    font-weight: 900;
    background-color: transparent;

}

.home .content p{
    font-size: 1.5rem;
    color:white;
    padding:1rem 0;
    line-height: 1.5;
}



.about .row{
    display: flex;
    align-items: center;
    gap:5rem;
    flex-wrap: wrap;
    padding: 6rem 4rem 4rem;
   
}

.about .row .video-container{
    flex:1 1 40rem;
    position: relative;
}

.about .row .video-container video{
    width:100%;
    border: .1rem solid rgb(231 142 40 / 46%);
    border-radius: .5rem;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
    height: 100%;
    object-fit: cover;
}

.about .row .video-container h3{
    position: absolute;
    top:50%; transform: translateY(-50%);
    font-size: 3rem;
    background:#fff;
    width:100%;
    padding:1rem 2rem;
    text-align: center;
    mix-blend-mode: screen;
}

.about .row .content{
    flex:1 1 40rem;
}

.about .row .content h3{
    font-size: 3rem;
    color: #d8d8d8;
}

.about .row .content p{
    font-size: 1.5rem;
    color:#999;
    padding: 0 1rem 1rem;
  
    padding-top: 1rem;
    line-height: 1.5;
}

.icons-container{
    background:#132019;
    display: flex;
    flex-wrap: wrap;
    gap:1.5rem;
    padding-top: 5rem;
    padding-bottom: 5rem;
}

.icons-container .icons{
    background:#132019;
    border: .1rem solid rgb(216 134 39 / 50%);
    padding:2rem;
    display: flex;
    align-items: center;
    flex:1 1 25rem;
    border: .1rem solid rgb(216 134 39 / 50%);
}

.icons-container .icons img{
    height:5rem;
    margin-right: 2rem;
    background-color: #192119;
}

.icons-container .icons h3{
    color:#fff;
    padding-bottom: .5rem;
    font-size: 1.5rem;
    background-color: #132019;
    margin: 0;
}

.icons-container .icons span{
    color:#ffffff87;
    font-size: 1.3rem;
    background-color: #132019;
    margin: 0;
}
.products .box-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Refined gap for a cleaner layout */
    justify-content: center; /* Align items centrally for a balanced look */
    padding: 20px; /* Padding for spacing around the container */
}

.products .box-container .box {
    width: calc(33.333% - 20px); /* Three items per row with gap adjustment */
    transition: transform 0.3s, box-shadow 0.3s; /* Smooth transitions for hover */
    background-color: #d88627; /* Card background */
    overflow: hidden; /* Ensures content fits within the card */
    display: flex;
    flex-direction: column; /* Stack elements vertically */
    position: relative; /* Position relative for absolute positioning of elements inside */
}

@media (max-width: 992px) {
    .products .box-container .box {
        width: calc(50% - 20px); /* Two items per row for tablet views */
    }
}

@media (max-width: 768px) {
    .products .box-container .box {
        width: 100%; /* Single item per row for mobile views */
        max-width: 400px; /* Limit card size for very small devices */
        margin: 0 auto; /* Center cards on the page */
    }
}

.products .box-container .box:hover {
    transform: translateY(-10px); /* Lift effect on hover */
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
}

.products .box-container .box .content {
    padding: 15px;
    text-align: center;
    flex: 1; /* Allow content to grow and occupy remaining space */
}

.products .box-container .box .content h3 {
    margin-bottom: 10px; /* Margin below the title for spacing */
    font-size: 2rem;
    color: #fff; /* Title font size */
}

.products .box-container .box .content .price {
    font-size: 1.5rem;
    color: #28a745;
    font-weight: bold;
}

.products .box-container .box .image {
    height: 200px; /* Fixed height for all image containers */
    width: 100%; /* Full width of the container */
    overflow: hidden; /* Ensures images do not overflow the container */
    position: relative; /* Positions the Visit Us button over the image */
}

.products .box-container .box .image img {
    width: 100%; /* Cover full width of the container */
    height: 100%; /* Cover full height, might cause aspect ratio changes */
    object-fit: cover; /* Ensures the image covers the area, cropping if necessary */
    transition: transform 0.5s ease-in-out; /* Smooth image scaling */
}

.products .box-container .box:hover .image img {
    transform: scale(1.05); /* Slightly enlarge image on hover */
}

.products .box-container .box .image .cart-btn {
    position: absolute; /* Absolute position within the relative container */
    bottom: 10px; /* Position at the bottom of the image container */
    left: 50%; /* Center horizontally */
    transform: translateX(-50%); /* Adjust for exact centering */
    display: inline-block; /* Allows setting dimensions */
    padding: 10px 25px; /* Adequate padding for a clickable area */
    background-color: #cd9258; /* Eye-catching button color */
    color: #ffffff; /* Contrast color for text */
    text-decoration: none; /* Removes underline from links */
    font-weight: bold; /* Makes button text stand out */
    border-radius: 5px; /* Rounded corners for a modern look */
    transition: background-color 0.3s, transform 0.3s; /* Smooth transition for hover effects */
}

.products .box-container .box .image .cart-btn:hover {
    background-color: #0056b3; /* Darker shade on hover for interaction feedback */
     /* Slight lift effect to denote clickable */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Shadow for depth */
}


.review .box-container{
    display: flex;
    flex-wrap: wrap;
    gap:1.5rem;
}

.review .box-container .box{
    flex:1 1 30rem;
    box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1);
    border-radius: .5rem;
    padding:3rem 2rem;
    position: relative;
    border:.1rem solid rgba(0,0,0,.1);
}

.review .box-container .box .fa-quote-right{
    position: absolute;
    bottom:3rem; right:3rem;
    font-size: 6rem;
    color:#eee;
}

.review .box-container .box .stars i{
    color:#8e581a;
    font-size: 2rem;
}

.review .box-container .box p{
    color:#999;
    font-size: 1.5rem;
    line-height: 1.5;
    padding-top: 2rem;
}

.review .box-container .box .user{
    display: flex;
    align-items: center;
    padding-top: 2rem;
}

.review .box-container .box .user img{
    height:6rem;
    width:6rem;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 1rem;
}

.review .box-container .box .user h3{
    font-size: 2rem;
    color:#333;
}

.review .box-container .box .user span{
    font-size: 1.5rem;
    color:#999;
}

.contact .row{
    display: flex;
    flex-wrap: wrap-reverse;
    gap:1.5rem;
    align-items: center;
}

.contact .row form{
    flex:1 1 40rem;
    padding:2rem 2.5rem;
    box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1);
    border:.1rem solid rgba(0,0,0,.1);
    background:#192119;
    border-radius: .5rem;
    margin: 50px 200px;
}

.contact .row .image{
    flex:1 1 40rem;
}

.contact .row .image img{
    width: 100%;
}

.contact .row form .box{
    padding:1rem;
    font-size: 1.7rem;
    color:#333;
    text-transform: none;
    border:.1rem solid rgba(0,0,0,.1);
    border-radius: .5rem;
    margin:.7rem 0;
    width: 100%;
}

.contact .row form .box:focus{
    border-color:#E78E28;
}

.contact .row form textarea{
    height: 15rem;
    resize: none;
}

.footer .box-container{
    display: flex;
    flex-wrap: wrap;
    gap:1.5rem;
}

.footer .box-container .box{
    flex:1 1 25rem;
}

.footer .box-container .box h3{
    color:#fff;
    font-size: 2.5rem;
    padding:1rem 0;
}

.footer .box-container .box a{
    display: block;
    color:#666;
    font-size: 1.5rem;
    padding:1rem 0;
}

.footer .box-container .box a:hover{
    color:#E78E28;
    
}

.footer .box-container .box  img{
    margin-top: 1rem;
}

.footer .credit{
    text-align: center;
    padding:1.5rem;
    margin-top: 1.5rem;
    padding-top: 2.5rem;
    font-size: 2rem;
    color:#333;
    border-top: .1rem solid rgba(0,0,0,.1);
    padding-bottom: 9rem;
}

.footer .credit span{
    color:var(--pink);
}

@media (max-width:991px){
    
    html{
        font-size: 55%;
    }

    header{
        padding:2rem;
    }

    section{
        padding:2rem;
    }

    .home{
        background-position: left;
    }

}

@media (max-width:768px){

    header .fa-bars{
        display: block;
    }

    header .navbar{
        position:absolute;
        top:100%; left:0; right:0;
        background:#eee;
        border-top: .1rem solid rgba(0,0,0,.1);
        clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
    }

    header #toggler:checked ~ .navbar{
        clip-path:polygon(0 0, 100% 0, 100% 100%, 0% 100%);
    }

    header .navbar a{
        margin:1.5rem;
        padding:1.5rem;
        background:#fff;
        border:.1rem solid rgba(0,0,0,.1);
        display: block;
    }

    .home .content h3{
        font-size: 5rem;
    }

    .home .content span{
        font-size: 2.5rem;
    }

    .icons-container .icons h3{
        font-size: 2rem;
    }
    
    .icons-container .icons span{
        font-size: 1.7rem;
    }
    
}

@media (max-width:450px){
    
    html{
        font-size: 50%;
    }

    .heading{
        font-size: 3rem;
    }

}


        .about .row .video-container video{
    width:100%;
    border:0.5rem solid #E78E28;
    border-radius: .5rem;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
    height: 100%;
    object-fit: cover;
}

.icons-container{
    background:#132019;
    display: flex;
    flex-wrap: wrap;
    gap:1.5rem;
    padding-top: 5rem;
    padding-bottom: 5rem;
}

.icons-container .icons{
    background:#132019;
    border:.1rem solid rgba(0,0,0,.1);
    padding:2rem;
    display: flex;
    align-items: center;
    flex:1 1 25rem;
}/* Styling for the view reviews button */
/* Center container */
.center-container {
    display: flex;
    justify-content: center; /* Horizontally center */
    align-items: center; /* Vertically center */
 
}

/* Styling for the view reviews button */
#viewReviewsBtn {
    background-color: #007bff; /* Blue color */
    color: #fff; /* White text */
    padding: 10px 20px; /* Padding */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Cursor style */
    font-size: 16px; /* Font size */
    transition: background-color 0.3s ease; /* Smooth transition */
}

/* Hover effect */
#viewReviewsBtn:hover {
    background-color: #0056b3; /* Darker blue on hover */
}



    </style></style>
    </style>

    </head>
<body>

<!-- Add the FAQ button to the header -->
<header>
    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo"><span>Tour India</span></a>

    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#products">Packages</a>
        <a href="#review">Review</a>
        <a href="./Login/login.php">Login/Signup</a>
        <!-- FAQ button -->
        <a href="faq.php" class="faq-button">FAQ</a>
    </nav>

    <div class="icons">
        <span data-tooltip="Favourites" data-flow="bottom"> <a href="#" class="fas fa-heart"></a></span>
        <span data-tooltip="Cart" data-flow="bottom"> <a href="#" class="fas fa-shopping-cart"></a></span>
        <span data-tooltip="Profile" data-flow="bottom"> <a href="#" class="fas fa-user"></a></span>
    </div>
</header>



<section id="carouselSection">
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./images/geranimo-WJkc3xZjSXw-unsplash.jpg" class="d-block w-100 vh-100" alt="Slide 2">
            </div>
        </div>
    </div>

    <section class="home" id="home">
        <div class="content overlay">
            <span> Incredible India: </span>
            <span class="">Travel Now</span>
           
        </div>
    </section>
</section>




<section class="about" id="about">

    <h1 class="heading"> <span> about </span> us </h1>

    <div class="row">

        <div class="video-container">
            <video src="./images/about-vid.mp4" loop autoplay muted></video>
            <h3>Best Places</h3>
        </div>

        <div class="content">
            <h3>why choose us?</h3>
<p> What truly sets us apart is our unwavering commitment to your satisfaction. Our 24/7 customer support is always ready to assist you, and we offer competitive prices and exclusive deals to save you money while you explore the world. Choose our travel website, and you're not just a traveler; you're part of a community that values your journey and strives to make it enjoyable and hassle-free. Join us today for unforgettable adventures, where your travel needs take center stage.</p>
            
        </div>

    </div>

</section> 

<section class="icons-container">

    <div class="icons">
        <img src="./images/icon-1.png" alt="">
        <div class="info">
            <h3>free booking</h3>
            <span>on all orders</span>
        </div>
    </div>

    <div class="icons">
        <img src="./images/icon-2.png" alt="">
        <div class="info">
            <h3>10 days returns</h3>
            <span>moneyback guarantee</span>
        </div>
    </div>

    <div class="icons">
        <img src="./images/icon-3.png" alt="">
        <div class="info">
            <h3>offer & gifts</h3>
            <span>on all orders</span>
        </div>
    </div>

    <div class="icons">
        <img src="./images/icon-4.png" alt="">
        <div class="info">
            <h3>secure paymens</h3>
            <span>protected by Razorpay</span>
        </div>
    </div>

</section>




<section class="products" id="products">

    <h1 class="heading"> Popular <span>Places</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="image">
                <img src="./images/Manali.jpg" alt="">
                <a href="./viewjourneycopy.php?city=Manali" class="cart-btn">Visit Us</a>
            </div>
            <div class="content">
                <h3>Manali</h3>
                <div class="price">Rs 35000</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/Rajasthan.jpg" alt="">
                <a href="./viewjourneycopy.php?city=Rajasthan" class="cart-btn">Visit Us</a>
               
            </div>
            <div class="content">
                <h3>Rajasthan</h3>
                <div class="price">Rs 40000</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/Ladakh.jpg" alt="">
                <a href="./viewjourneycopy.php?city=Ladakh" class="cart-btn">Visit Us</a>
                
            </div>
            <div class="content">
                <h3>Ladakh</h3>
                <div class="price">Rs 50000 </div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/Chennai.jpg" alt="">
                <a href="./viewjourneycopy.php?city=Chennai" class="cart-btn">Visit Us</a>
               
            </div>
            <div class="content">
                <h3>Chennai</h3>
                <div class="price">Rs 30000 </div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/kerala.jpg" alt="">
                <a href="./viewjourneycopy.php?city=kerala" class="cart-btn">Visit Us</a>
                
            </div>
            <div class="content">
                <h3>Kerala</h3>
                <div class="price">Rs 21000</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/goa.jpg" alt="">
                <a href="./viewjourneycopy.php?city=goa" class="cart-btn">Visit Us</a>
                
            </div>
            <div class="content">
                <h3>Goa</h3>
                <div class="price">Rs 15000</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/sikkim.jpg" alt="">
                <a href="./viewjourneycopy.php?city=sikkim" class="cart-btn">Visit Us</a>
                
            </div>
            <div class="content">
                <h3>Sikkim</h3>
                <div class="price">Rs 55000</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/Pune.jpg" alt="">
                <a href="./viewjourneycopy.php?city=Pune" class="cart-btn">Visit Us</a>
                
            </div>
            <div class="content">
                <h3>Pune</h3>
                <div class="price">Rs 15000</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/Mumbai.jpg" alt="">
                <a href="./viewjourneycopy.php?city=Mumbai" class="cart-btn">Visit Us</a>
               
            </div>
            <div class="content">
                <h3>Mumbai</h3>
                <div class="price">Rs 15000</div>
            </div>
        </div>

    </div>

</section>


<section class="review" id="review">

<h1 class="heading"> customer's <span>review</span> </h1>

<div class="box-container">

    <div class="box">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <p>Booking my dream trip to the serene backwaters of Kerala was a breeze with Travelscapes – seamless and stress-free! </p>
        <div class="user">
            <img src="./images/pic-1.jpg" alt="atharva pfp">
            <div class="user-info">
                <h3>Atharva</h3>
                <span>Goa</span>
            </div>
        </div>
        <span class="fas fa-quote-right"></span>
    </div>

    <div class="box">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <p>Thanks to Travelscapes, I explored the majestic beauty of Rajasthan with ease, and the deals were unbeatable!</p>
        <div class="user">
            <img src="./images/pic-2.png" alt="Yash pfp">
            <div class="user-info">
                <h3>Pretty</h3>
                <span>Maharashtra</span>
            </div>
        </div>
        <span class="fas fa-quote-right"></span>
    </div>

    <div class="box">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <p>Made my adventure to the mesmerizing Himalayan mountains unforgettable, with expert guidance and fantastic itineraries</p>
        <div class="user">
            <img src="./images/pic-3.jpg" alt="Tejas pfp">
            <div class="user-info">
                <h3>Tejas</h3>
                <span>Kerala</span>
            </div>
        </div>
        <span class="fas fa-quote-right"></span>
    </div>
  

</div>  
<div class="center-container">
    <a href="reviews.php" id="viewReviewsBtn">View Reviews</a>
</div>


</section>


<section class="contact" id="contact">

    <h1 class="heading"> <span> contact </span> us </h1>

    <div class="row">

        <form action="">
            <input type="text" placeholder="name" class="box">
            <input type="email" placeholder="email" class="box">
            <input type="number" placeholder="number" class="box">
            <textarea name="" class="box" placeholder="message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" class="btn">
        </form>

     

    </div>

</section>


<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a href="#">Home</a>
            <a href="#">About </a>
            <a href="#">Places</a>
            <a href="#">Review</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="box">
            <h3>extra links</h3>
            <a href="#">My account</a>
            <a href="#">My List</a>
            <a href="#">My favorite</a>
        </div>

        <div class="box">
            <h3>Popular Travel Locations</h3>
            <a href="#">Manali</a>
            <a href="#">Rajasthan</a>
            <a href="#">Mumbai</a>
            <a href="#">Kerala</a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="#">Link</a>
            <img src="./images/payment.png" alt="">
        </div>
    </div>

    <div class="credit">&copy;2024 TourIndia</div>

</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<script>
        // Function to fetch reviews and display them
function fetchAndDisplayReviews() {
    fetch('fetch_reviews.php') // Adjust the path if necessary
        .then(response => response.json())
        .then(reviews => {
            const container = document.getElementById('review');
            container.innerHTML = ''; // Clear existing content
            
            reviews.forEach(review => {
                const reviewElement = document.createElement('div');
                reviewElement.innerHTML = `
                    <h3>${review.reviewer_name}</h3>
                    <p>${review.review_content}</p>
                    <p>Rating: ${review.rating}</p>
                    <p>Date: ${new Date(review.review_date).toLocaleDateString()}</p>
                `;
                container.appendChild(reviewElement);
            });
        })
        .catch(error => console.error('Error fetching reviews:', error));
}

// Call the function when the page loads
window.onload = function() {
    fetchAndDisplayReviews();
};
    </script>



</body>
</html>
