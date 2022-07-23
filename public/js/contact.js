/* Google Map */
function initMap() {
    let options = {
        center: {lat: 43.64286207106479, lng: -79.38372504419783},
        zoom: 17
    }

    let map = new google.maps.Map(document.querySelector(".map-container"), options)
    
    marker = new google.maps.Marker({
        position: {lat: 43.64286207106479, lng: -79.38372504419783},
        map: map,
    });
}

/* Form submit */
const contactForm = document.querySelector("#form");
const submitBtn = document.querySelector("#form-btn");
const confirmMsg = document.querySelector(".confirm-msg");

contactForm.onsubmit = (event) => {
    event.preventDefault();
    submitBtn.innerHTML = "Processing...";
    setTimeout(() => { 
        contactForm.style.display = "none";
        confirmMsg.style.display = "block";
    }, 750);
}