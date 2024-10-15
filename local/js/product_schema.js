// -----GLOBAL PRODUCT INFO VARIABLES
let product_name = document.querySelector(".product-name i").innerText;
let product_descript = document.querySelector(".product-descript").innerText;
let product_origin = document.querySelector(".product-origin i").innerText;
let product_price = document.querySelector(".price").innerText.replace(" đ", "").replaceAll(".", "");
let product_image = window.location.protocol + "//" + window.location.host + document.querySelectorAll(".item a img").item(0).getAttribute("src");
(function() {
    var jsondata = {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": `${product_name}`,
        "image": `${product_image}`,
        "description": `${product_descript}`,
        "brand": {
            "@type": "Brand",
            "name": `${product_origin}`
        },
        "review": {
            "@type": "Review",
            "reviewRating": {
                "@type": "Rating",
                "ratingValue": "4",
                "bestRating": "5"
            },
            "author": {
                "@type": "Person",
                "name": "Tifatech"
            }
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "5",
            "reviewCount": "5"
        },
        "offers": {
            "@type": "Offer",
            "priceCurrency": "VND",
            "price": `${product_price}`,
            "itemCondition": "https://schema.org/UsedCondition",
            "availability": "https://schema.org/InStock"
        },
    };
    var el = document.createElement('script');
    el.type = 'application/ld+json';
    el.innerHTML = JSON.stringify(jsondata);
    document.head.appendChild(el);
})();