 // update content
 document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.edit-btn').forEach(function(button) {
        button.addEventListener("click", function() {

            let id = this.getAttribute("data-id");
            let name = this.getAttribute("data-name");
            let description = this.getAttribute("data-description");
            let price = this.getAttribute("data-price");
            let capacity = this.getAttribute("data-capacity");
            let status = this.getAttribute("data-status");
            let type = this.getAttribute("data-type");
            let amenities = JSON.parse(this.getAttribute("data-amenities") || "[]"); // Parse JSON
            let image = this.getAttribute("data-image").trim();
            document.getElementById("editId").value = id;
            document.getElementById("editName").value = name;
            document.getElementById("editDescription").value = description;
            document.getElementById("editPrice").value = price;
            document.getElementById("editCapacity").value = capacity;
            document.getElementById("editStatus").value = status;
            document.getElementById("editType").value = type;
            document.getElementById("editAmenities").value = amenities;
            document.getElementById("editImage").src = image;

            document.getElementById("existingImage").value = image;


            // Reset and check appropriate amenities
            document.querySelectorAll("#editAmenities input[type='checkbox']").forEach(checkbox => {
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
