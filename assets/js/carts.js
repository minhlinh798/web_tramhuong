document.addEventListener("DOMContentLoaded", function() {
    const checkoutButton = document.querySelector(".checkout");

    checkoutButton.addEventListener("click", function() {
        window.location.href = "bill.php";
    });
});