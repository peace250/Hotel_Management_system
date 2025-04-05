<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select all buttons with class "view-details"
        let viewDetailsButtons = document.querySelectorAll(".view-details");

        viewDetailsButtons.forEach(button => {
            button.addEventListener("click", function() {
                // Get data attributes from the clicked button
                let propertyId = this.getAttribute("data-id");
                let title = this.getAttribute("data-title");
                let description = this.getAttribute("data-description");
                let image = this.getAttribute("data-image");

                // Populate the modal with property data
                document.getElementById("propertyModalLabel").textContent = title;
                document.getElementById("modalTitle").textContent = title;
                document.getElementById("modalDescription").textContent = description;
                document.getElementById("modalImage").src = image;

                // Set booking button link (optional)
                document.getElementById("bookNow").onclick = function() {
                    window.location.href = "book.php?property_id=" + propertyId;
                };
            });
        });
    });
</script>






