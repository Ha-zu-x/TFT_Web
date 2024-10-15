// -----MAIN PAGES SCHEMA--------
let post_name = document.querySelector('meta[property="og:title"]').content;
let post_descript = document.querySelector('meta[property="og:description"]').content;
let post_image = document.querySelector('meta[property="og:image"]').content;
(function() {
    var jsondata = {
        "@context": "https://schema.org/",
        "@type": "CreativeWorkSeries",
        "name": `${post_name}`,
        "image": `${post_image}`,
        "description": `${post_descript}`,
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "5",
            "bestRating": "5",
            "ratingCount": "20"
        },
    };
    var el = document.createElement('script');
    el.type = 'application/ld+json';
    el.innerHTML = JSON.stringify(jsondata);
    document.head.appendChild(el);
})();