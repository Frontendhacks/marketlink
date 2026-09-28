const API_URL = "http://localhost:8080/api";


/* ================= ELEMENTS ================= */

const searchInput = document.getElementById("searchInput");
const categoryFilter = document.getElementById("categoryFilter");
const products = document.querySelectorAll(".product-item");
const noResults = document.getElementById("noResults");


/* ================= PRODUCT FILTER ================= */

const initialSearch=new URLSearchParams(window.location.search).get("search");
if(searchInput && initialSearch){searchInput.value=initialSearch;}

function filterProducts() {

    const search = searchInput.value.trim().toLowerCase();
    const category = categoryFilter.value;

    let count = 0;

    products.forEach(function (product) {

        const name = product.dataset.name.toLowerCase();
        const productCategory = product.dataset.category;

        const matchName = name.includes(search);

        const matchCategory =
            category === "all" ||
            productCategory === category;

        if (matchName && matchCategory) {

            product.classList.remove("d-none");

            count++;

        } else {

            product.classList.add("d-none");

        }

    });


    if (count === 0) {

        noResults.classList.remove("d-none");

    } else {

        noResults.classList.add("d-none");

    }

}


/* ================= TOGGLE FAVORITE ================= */

async function toggleFavorite(button) {

    const productId = button.dataset.productId;

    try {

        const response = await fetch(
            API_URL + "/favorites/toggle",
            {
                method: "POST",

                headers: {
                    "Content-Type": "application/json"
                },

                body: JSON.stringify({
                    productId: productId
                })
            }
        );


        if (!response.ok) {

            alert("Unable to update favorite.");

            return;

        }


        const data = await response.json();


        if (data.favorite) {

            button.classList.add("active");

            button.textContent = "♥";

        } else {

            button.classList.remove("active");

            button.textContent = "♡";

        }

    } catch (error) {

        console.log(error);

        alert("Backend connection is not available.");

    }

}


/* ================= LOAD FAVORITES ================= */

async function loadFavorites() {

    try {

        const response = await fetch(
            API_URL + "/favorites"
        );


        if (!response.ok) {

            return;

        }


        const favorites = await response.json();


        document
            .querySelectorAll(".favorite-btn")
            .forEach(function (button) {

                const productId =
                    button.dataset.productId;


                if (
                    favorites.includes(Number(productId)) ||
                    favorites.includes(productId)
                ) {

                    button.classList.add("active");

                    button.textContent = "♥";

                }

            });


    } catch (error) {

        console.log(
            "Favorites could not be loaded."
        );

    }

}


/* ================= FAVORITE BUTTON EVENTS ================= */

document
    .querySelectorAll(".favorite-btn")
    .forEach(function (button) {

        button.addEventListener(
            "click",
            function () {

                toggleFavorite(button);

            }
        );

    });


/* ================= SEARCH EVENTS ================= */

if(searchInput) searchInput.addEventListener("input",filterProducts);


if(categoryFilter) categoryFilter.addEventListener("change",filterProducts);


/* ================= INITIAL LOAD ================= */

if(document.querySelector(".favorite-btn")) loadFavorites();