   
   
   
   
   
   
   
   // prevent form submission when the inputs are null(login.js)
    document.querySelector("form").addEventListener('submit', function(event) {
        let password = document.querySelector("input[name='password']").value;
        let name = document.querySelector("input[name='name']").value;
        if (name == "" || password == "") {
            alert("Inputs can't be null!");
            event.preventDefault(); // Stops form from submitting
        }
    });