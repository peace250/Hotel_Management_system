

// Dynamically change the modal's content.
document.addEventListener('DOMContentLoaded', function(){
let viewmoreButtons = document.querySelectorAll('.viewmore');
viewmoreButtons.forEach(function(button){
button.addEventListener('click',function(){

let hotelroomId = this.getAttribute('data-id');
let name = this.getAttribute('data-title');
let description  = this.getAttribute('data-description');
let image = this.getAttribute('data-image');
let price = this.getAttribute('data-price');
 // Populate the modal with property data
document.getElementById("modalTitle").textContent = name;
document.getElementById("modalDescription").textContent =description;
document.getElementById("modalImage").src =image;
document.getElementById("modalPrice").textContent=price;
 
// booking link
document.getElementById("bookNow").onclick = function() {
window.location.href = "../bookings/index.php?id=" + hotelroomId
    console.log('clicked');
};
});
});
});



//  JavaScript to Handle Reviews 

    document.getElementById('review-form').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get input values
        let name = document.getElementById('name').value;
        let rating = document.getElementById('rating').value;
        let comment = document.getElementById('comment').value;

        // Create a new review element
        let reviewCard = document.createElement('div');
        reviewCard.classList.add('review-card');
        reviewCard.innerHTML = `<h5>${name}</h5>
                                <p class="star-rating">${rating}</p>
                                <p>"${comment}"</p>`;

        // Add the review to the container
        document.getElementById('reviews-container').appendChild(reviewCard);

        // Clear form fields
        document.getElementById('review-form').reset();
    });

    // When the 'View Gallery' button is clicked, populate the modal
document.querySelectorAll('.view-gallery').forEach(button => {
    button.addEventListener('click', function() {
        // Get the property ID and the images associated with this property
        const propertyId = this.getAttribute('data-property-id');
        const photos = JSON.parse(this.getAttribute('data-photos'));

        // Select the gallery container in the modal
        const galleryContainer = document.getElementById('galleryImages');
        
        // Clear any previous images
        galleryContainer.innerHTML = '';

        // Loop through the photos and display them in the modal
        photos.forEach(photo => {
            const imgElement = document.createElement('img');
            imgElement.src = '../' + photo; // Make sure the image path is correct
            imgElement.classList.add('col-md-4', 'mb-4');
            imgElement.classList.add('img-fluid');
            imgElement.alt = 'Property Image';
            
            galleryContainer.appendChild(imgElement);
        });
    });
});
