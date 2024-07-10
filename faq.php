<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Page</title>
    <style>
       @import url("https://fonts.googleapis.com/css2?family=Inconsolata:wght@500&display=swap");

@import url("https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap");

* {
  margin: 0;
  background-color: #192119;
}

h1 {
  font-family: "JetBrains Mono", monospace;
  font-size: 50px;
  text-align: center;
  margin: 30px 0;    
  color: #E78E28;
}

.accordion-wrapper {
  margin: 0 50px;
}

.accordion {
  color: #fff;
  cursor: pointer;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
  margin: 10px 0 0;
  font-family: "Inconsolata", monospace;
  font-size: 20px;
}

.main-acc {
  border: 3px solid #e78e285e;
  box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.2);
  border-radius: 6px 6px 6px 6px;
  padding: 28px;
  background: #101511;    
  margin: 0 0 20px;
}

.main-acc.active {
  border-top: 3px solid #000000;
  border-right: 3px solid #000000;
  border-left: 3px solid #000000;
  border-bottom: none;
  border-radius: 6px 6px 0px 0px;
}

.main-acc:hover {
    background-color: #3b563b;
  }

.sub-acc {
  background-color: #3b563b;
  text-decoration: underline;
  margin: 0;
  padding: 18px 28px;
}

.accordion:after {
  content: "\002B";
  color: black;
  font-weight: bold;
  float: right;
  margin-left: 5px;
  font-size: 28px;
}

.active:after {
  content: "\2212";
}

.panel {
  position: relative;
  z-index: 2;
  background-color: white;
  border: none;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}

.sub-panel {
  border: none;
}

.sub-panel p {
  padding: 0 18px;
  margin: 10px 20px;
  font-family: sans-serif;
  background-color: white;
}

.accordion.active + .main-panel {
  border: 3px solid #e78e285e;
  border-radius: 0px 0px 6px 6px;
  box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.4);
}

header {
    color: #fff;
    justify-content: space-between;
    padding: 10px 20px;
    position: relative;
    flex-direction: row-reverse;
    font-family: "Inconsolata", monospace;
    font-size: 20px;
    text-align: left;
    margin-left: 20px;
    font-size: xx-large;
    color: #e78e28;
}

.hamburger {
  display: none;
  cursor: pointer;
}

.nav-links {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
}

.nav-links li {
  margin-right: 20px;
}

.nav-links a {
    color: #e78e28;
  text-decoration: none;
}

@media (max-width: 767px) {
  
  header {
    flex-direction: row;
  }
  
  .hamburger {
    display: block;
  }
  
  .nav-links a {
  color: white; 
}
  
  .nav-links a:hover {
  color: #f0afe9; 
}
  
  .nav-links {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background-color: #333;
    flex-direction: column;
    align-items: center;
    width: 10%;
    margin-left: 20px;
    padding: 20px;
 
  }
  
  .nav-links.show {
    height: 200px;
    display: flex; 
    justify-content: space-between;
    background: black;
     padding: 20px;
  }
  
  .bar {
  background-color: black;
  height: 3px;
  margin: 6px 0;
  width: 26px;
}
}
    </style>
</head>
<body>


<header>
  <nav>
    <ul class="nav-links">
      <li><a href="./home.php">Home</a></li>
    </ul>
  </nav>
</header>

<div class="accordion-wrapper">

  <h1>FAQs</h1>

  <button class="accordion main-acc one">Booking and Reservations</button>
  <div class="panel main-panel">
    <button class="accordion sub-acc">How do I book a tour?</button>
    <div class="panel sub-panel">
      <p>You can book a tour by visiting our website, browsing through the available tours, and selecting the one you're interested in. Then, follow the booking instructions to reserve your spot.</p>
    </div>
    <button class="accordion sub-acc">Can I make reservations for accommodations?</button>
    <div class="panel sub-panel">
      <p>Yes, you can make reservations for accommodations through our website. We offer a variety of options, including hotels, resorts, and vacation rentals.</p>
    </div>
    <button class="accordion sub-acc">Do I need to pay in advance for bookings?</button>
    <div class="panel sub-panel">
      <p>Payment policies vary depending on the tour or accommodation you're booking. Some may require full payment in advance, while others may offer the option to pay a deposit with the remainder due closer to the travel date.</p>
    </div>
  </div>

  <button class="accordion main-acc two">Travel Information</button>
  <div class="panel main-panel">
    <button class="accordion sub-acc">What documents do I need for international travel?</button>
    <div class="panel sub-panel">
      <p>For international travel, you typically need a valid passport and may also require a visa depending on the destination. Make sure to check the entry requirements for your specific destination well in advance of your trip.</p>
    </div>
    <button class="accordion sub-acc">How do I prepare for a tour?</button>
    <div class="panel sub-panel">
      <p>It's important to research your destination, pack appropriate clothing and gear, and make any necessary arrangements such as obtaining travel insurance or vaccinations.</p>
    </div>
    <button class="accordion sub-acc">What should I do if I encounter travel disruptions?</button>
    <div class="panel sub-panel">
      <p>If you encounter travel disruptions such as flight delays or cancellations, contact our customer support team for assistance. We'll do our best to help you find alternative arrangements and minimize any inconvenience.</p>
    </div>
  </div>

  <button class="accordion main-acc three">Cancellation and Refunds</button>
  <div class="panel main-panel">
    <button class="accordion sub-acc">Can I cancel my tour reservation?</button>
    <div class="panel sub-panel">
      <p>Yes, you can cancel your tour reservation, but cancellation policies vary depending on the tour operator and timing of your cancellation. Be sure to review the cancellation policy before booking.</p>
    </div>

    <button class="accordion sub-acc">What is your refund policy?</button>
    <div class="panel sub-panel">
      <p>Our refund policy also varies depending on the tour or accommodation provider. In general, refunds may be subject to cancellation fees or restrictions based on the timing of your cancellation.</p>
    </div>
  </div>

  <button class="accordion main-acc four">Customer Support</button>
  <div class="panel main-panel">
    <button class="accordion sub-acc">How do I contact customer support?</button>
    <div class="panel sub-panel">
      <p>If you need assistance or have any questions, you can reach our customer support team via email at support@travelagency.com or by phone at +1 (555) 555-5555. We're available to assist you during our business hours.</p>
    </div>

    <button class="accordion sub-acc">What are your business hours for customer support?</button>
    <div class="panel sub-panel">
      <p>Our customer support team is available to assist you during our business hours, which are Monday-Friday from 9:00am to 5:00pm EST.</p>
    </div>

    <button class="accordion sub-acc">How do I get help during my trip?</button>
    <div class="panel sub-panel">
      <p>If you encounter any issues or need assistance during your trip, contact our customer support team for help. We're here to ensure your travel experience goes smoothly.</p>
    </div>
  </div>

  <button class="accordion main-acc five">Site Security and Privacy</button>
  <div class="panel main-panel">
    <button class="accordion sub-acc">Is my personal information secure?</button>
    <div class="panel sub-panel">
      <p>Yes, we take the security of your personal information seriously and use industry-standard encryption and security measures to protect it.</p>
    </div>

    <button class="accordion sub-acc">What is your privacy policy?</button>
    <div class="panel sub-panel">
      <p>Our privacy policy outlines how we collect, use, and protect your personal information. You can review our privacy policy on our website for more details.</p>
    </div>
  </div>

</div>
<script>
   var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var parent = this.parentElement;
    var panel = this.nextElementSibling;
    var mainPanel = document.querySelector(".main-panel");
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
      parent.style.maxHeight =
        parseInt(parent.style.maxHeight) + panel.scrollHeight + "px";
    }
  });
}


const hamburger = document.querySelector(".hamburger-menu");
const navLinks = document.querySelector(".nav-links");

hamburger.addEventListener("click", function() {
  navLinks.classList.toggle("show");
});
</script>

</body>
</html>
