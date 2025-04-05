/// update content
document.addEventListener("DOMContentLoaded", function(){

document.querySelectorAll('.update-btn').forEach(function(button){
button.addEventListener("click",function(){
let id =this.getAttribute("data-id");
let name =this.getAttribute("data-name");
let description =this.getAttribute("data-description");
let type =this.getAttribute("data-type");
let price =this.getAttribute("data-price");
let status =this.getAttribute("data-status");
let rooms =this.getAttribute("data-rooms");
let rules =this.getAttribute("data-rules");
let address =this.getAttribute("data-address");
let bathrooms =this.getAttribute("data-bathrooms");
let guests = this.getAttribute("data-guests");
let photo =this.getAttribute("data-photo");
let amenities = JSON.parse(this.getAttribute("data-amenities") || "[]");
document.getElementById('updateId').value = id;

console.log(photo);

document.getElementById('name').value = name;
document.getElementById('rules').value = rules;
document.getElementById('description').value = description;
document.getElementById('type').value = type;
document.getElementById('status').value = status;
document.getElementById('rooms').value = rooms;
document.getElementById('bathrooms').value = bathrooms;
document.getElementById('guests').value = guests;
document.getElementById('amenities').value = amenities;
document.getElementById('address').value = address;
document.getElementById('price').value = price;


// Reset and check appropriate amenities
document.querySelectorAll("#amenities input[type='checkbox']").forEach(checkbox => {
    checkbox.checked = amenities.includes(checkbox.value);
});

   // Handle image
    // Handle photo preview
    const photoData = button.dataset.photo;
    let existingImages = [];

try {
    existingImages = JSON.parse(photoData); // expecting JSON string
} catch (e) {
    if (photoData) existingImages = [photoData]; // fallback
}

// Populate preview
const previewContainer = document.getElementById("existingImagePreview");
previewContainer.innerHTML = "";

existingImages.forEach(src => {
    const img = document.createElement("img");
    img.src = src;
    img.width = 100;
    img.classList.add("rounded", "border", "img-thumbnail");
    previewContainer.appendChild(img);
});

// Store as JSON in hidden input
document.getElementById("existingImg").value = JSON.stringify(existingImages);

});
});












    // delete content 
     document.querySelectorAll('.delete-btn ').forEach(function(button) {
         button.addEventListener('click', function() {
             console.log("Delete button clicked");
             let id = this.getAttribute("data-id");
             document.getElementById("deleteId").value = id;
    
         });
     });
});
   
   
   
   