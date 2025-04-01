// Initialize Flatpickr for both inputs
flatpickr("#checkin", {
  dateFormat: "Y-m-d",
  minDate: "today",
});
flatpickr("#checkout", {
  dateFormat: "Y-m-d",
  minDate: "today",
});

// js codes to deal with the payment options.
document
  .getElementById("paymentMethod")
  .addEventListener("change", function () {
    document.getElementById("cardPayment").style.display =
      this.value === "card" ? "block" : "none";
    document.getElementById("paypalPayment").style.display =
      this.value === "paypal" ? "block" : "none";
    document.getElementById("mobilePayment").style.display =
      this.value === "mobile" ? "block" : "none";
  });
