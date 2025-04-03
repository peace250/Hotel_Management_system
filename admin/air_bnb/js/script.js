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
let photo =this.getAttribute("data-photo").trim();
let amenities = JSON.parse(this.getAttribute("data-amenities") || "[]");




document.getElementById('update_propertyForm').setAttribute("data-id", id);
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

// document.getElementById('photos').src = photo;
// document.getElementById('existingImage').value=photo;



console.log(id);
// Reset and check appropriate amenities
document.querySelectorAll("#amenities input[type='checkbox']").forEach(checkbox => {
    checkbox.checked = amenities.includes(checkbox.value);
});

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
   
   
   
   