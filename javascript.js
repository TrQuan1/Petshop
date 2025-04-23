function searchProducts() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const products = document.getElementsByClassName("product-item");

    for (let i = 0; i < products.length; i++) {
        const name = products[i].innerText.toLowerCase();
        if (name.includes(input)) {
            products[i].style.display = "";
        } else {
            products[i].style.display = "none";
        }
    }
}
