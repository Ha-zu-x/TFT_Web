(function(){
    var jsondata = {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "TIFATECH CO., LTD",
    "image": "https://tifatech.vn/user-upload/imgs/tft-logo.png",
    "@id": "",
    "url": "https://tifatech.vn",
    "telephone": "0899.600.009",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "14 Trần Tử Bình",
        "addressLocality": "Đà Nẵng",
        "postalCode": "50815",
        "addressCountry": "VN"
    },
    "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        ],
        "opens": "07:00",
        "closes": "17:00"
    },
    "sameAs": "https://www.facebook.com/tifatech.com.vn" 
};
  var el = document.createElement('script');
  el.type = 'application/ld+json';
  el.innerHTML = JSON.stringify(jsondata);
  document.head.appendChild(el);
})();
