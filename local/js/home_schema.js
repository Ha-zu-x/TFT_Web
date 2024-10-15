let home_name = document.querySelector('meta[property="og:title"]').content;
let home_descript = document.querySelector('meta[property="og:description"]').content;
let home_image = document.querySelector('meta[property="og:image"]').content;
(function() {
    //---- FAQ and Sitelinks search box for homepage ----
    var homeJson = [{
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": [{
                    "@type": "Question",
                    "name": "Bạn có bo mạch cho những dòng máy nào?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Chúng tôi có bo mạch cho các dòng máy Casadio, Cime, Faema, Expobar, Nuova Simonelli,..."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Thời gian giao hàng trong bao lâu?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Thời gian giao hàng trong nước mất khoảng 3-4 ngày và 6-10 ngày cho các nước khu vực châu Á."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Bạn có sửa chữa bo mạch, máy pha không?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Chúng tôi có hỗ trợ sửa chữa cho các loại bo mạch và máy pha ở Việt Nam."
                    }
                }
            ]
        },
        {
            "@context": "https://schema.org",
            "@type": "Website",
            "name": "Tifatech",
            "url": "https://tifatech.vn",
            "potentialAction": {
                "@type": "SearchAction",
                "target": {
                    "@type": "EntryPoint",
                    "urlTemplate": "https://tifatech.vn/linh-kien-may-pha/search?q={search_term_string}"
                },
                "query-input": "required name=search_term_string"
            }
        },
        {
            "@context": "https://schema.org/",
            "@type": "CreativeWorkSeries",
            "name": `${home_name}`,
            "image": `${home_image}`,
            "description": `${home_descript}`,
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "5",
                "bestRating": "5",
                "ratingCount": "20"
            },
        }
    ]

    var el = document.createElement('script');
    el.type = "application/ld+json";
    el.innerHTML = JSON.stringify(homeJson);
    document.head.appendChild(el);
})();