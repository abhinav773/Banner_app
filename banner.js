(function() {
    var scripts = document.getElementsByTagName('script');
    var thisScript = scripts[scripts.length - 1]; 

    var bannerWidth = thisScript.getAttribute('data-width') || '300px';  // Default: 300px
    var bannerHeight = thisScript.getAttribute('data-height') || '100px'; // Default: 100px
    fetch("http://localhost/banner_app/banner_api.php")
        .then(response => response.json())
        .then(data => {
            if (data.image_url) {
                var banner = document.createElement("a");
                banner.href = data.link;
                banner.target = "_blank";

                var img = document.createElement("img");
                img.src = data.image_url;
                img.alt = data.alt_text;
                img.style.width = bannerWidth;
                img.style.height = bannerHeight;
       

                banner.appendChild(img);
                document.body.appendChild(banner);
            }
        })
        .catch(error => console.error("Error loading banner:", error));
})();
