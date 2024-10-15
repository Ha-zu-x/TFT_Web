// Style and Video load handle
function slideLoad() {
    let div = document.createElement('div');
    div.setAttribute("class", "item active");
    let avtVideo = "/user-upload/video/tft_vd_compressed.mp4";
    if (window.innerWidth < 576) {
        avtVideo = "/user-upload/video/avt-vid-mb.mp4";
    }
    div.innerHTML = `
    <video muted ="muted" preload = "auto" autoplay= "autoplay" loop= "loop" playsinline>
        <source src="${avtVideo}" type='video/mp4'"></source>
    </video>
    `;
    if (document.querySelector("#slide .carousel-inner") != null) {
        document.querySelector("#slide .carousel-inner").prepend(div);
        document.querySelector("#slide .item video").style.width = "100%";
        document.querySelector("#slide .carousel-inner").style.textAlign = "center";
    }
}

function styleLoad() {
    document.querySelector('.youtube-player').style.cssText = "position: relative; padding-bottom: 56.25%; height: 0;overflow: hidden;max-width: 100%; background: #000;margin: 5px;"
    document.querySelector('.youtube-player img').style.cssText = "object-fit: cover; display: block; left: 0; bottom: 0; margin: auto;  max-width: 100%; width: 100%;  position: absolute;  right: 0;top: 0;  border: none;  height:  auto;cursor: pointer; -webkit-transition: 0.4s all; -moz-transition: 0.4s all;    transition: 0.4s all;"
    document.querySelector('.youtube-player img').onmouseover = function() {

        this.style.filter = "brightness(75%);";
    }
    document.querySelector('.youtube-player img').onmouseout = function() {

        this.style.filter = "brightness(100%);";
    }
    document.querySelector('.youtube-player .play').style.cssText = "height: 72px;  width: 72px; left: 50%; top: 50%; margin-left: -36px;  margin-top: -36px;  position: absolute; background-image: url('/user-upload/imgs/play-button.png'); background-repeat: no-repeat; cursor: pointer;"

}

function labnolIframe(div) {
    let iframe = document.createElement("iframe");
    let playlist = "An4wOouc_W4,t_9aaeG6VhY,M7Z9N60-C8I";
    iframe.setAttribute("src", "https://www.youtube-nocookie.com/embed/" + div.dataset.id + "?autoplay=1&loop=1&modestbranding=1&rel=0&cc_load_policy=1&iv_load_policy=3&fs=0&color=white&controls=1&disablekb=1");
    iframe.setAttribute("frameborder", '0');
    iframe.setAttribute("allowfullscreen", '0');
    iframe.setAttribute("allow", "accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture");
    div.parentNode.replaceChild(iframe, div);
    document.querySelector('.youtube-player iframe').style.cssText = "position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: 100;background: transparent;";

}

function initContents() {
    let playerElements = document.getElementsByClassName('youtube-player');
    for (let i = 0; i < playerElements.length; i++) {
        let videoId = playerElements[i].dataset.id;
        let div = document.createElement("div");
        div.setAttribute("data-id", videoId);
        let thumbNail = document.createElement('img');
        thumbNail.src = "//i.ytimg.com/vi/ID/hqdefault.jpg".replace("ID", videoId);
        div.appendChild(thumbNail);
        let playButton = document.createElement('div');
        playButton.setAttribute("class", "play");
        div.appendChild(playButton);
        div.onclick = function() {
            labnolIframe(this);
        };
        playerElements[i].appendChild(div);
    }
    if (playerElements.length > 0) {
        styleLoad();
    }

    slideLoad();
    //For blog post
    let blogItem = $('.blog-item figcaption');
    blogItem.each(function() {
        let imgElement = $(this).parent().parent().children('.img-responsive');
        $(this).mouseover(function() {
            imgElement.css("transform", "scale(1.2)");
        });
        $(this).mouseout(function() {
            imgElement.css("transform", "scale(1.00)");
        });
    });
    async function modalShow() {
        $("#modal").modal("show");
    }
    if ($(".popup-ad").length > 0) {
        let new_user = 0;
        if (localStorage.getItem("user") == '1') {
            new_user = 0;
        } else {
            new_user = 1;
            localStorage.setItem("user", new_user);
        }
        //if new_user === 1 (Replace by this if just show popup once)
        if (1) {
            modalShow().then(function() {
                $('.popup-ad').css("display", "inline-block");
            })
        } else {
            $('#modal').modal('hide');
            $('.popup-ad').css("display", "none");
        }
        $(".popup-close").on("click", function() {
            $('#modal').modal('hide');
            $('.popup-ad').hide();
        });
        $(window).on('click', function(e) {
            if (e.target.closest(".popup-ad"))
                return;
            else
                $('.popup-ad').hide();
        })
    }
    $(".banner-notify span").on("click", function(e) {
        e.preventDefault();
        $(".banner-notify").hide();
    })
    $(".banner-notify").show();

}
document.addEventListener('DOMContentLoaded', initContents);
// -------Top running notification------
var notifyWidth = document.querySelector(".working-time div").offsetWidth;
var notifyContainerWidth = document.querySelector(".working-time").offsetWidth;
const notifyRunning = [
    { transform: `translateX(${(notifyWidth)}px)` },
    { transform: `translateX(-${(notifyContainerWidth )}px` }

];

const notifyTiming = {
    duration: 35000,
    iterations: Infinity,
}
document.querySelector(".working-time div").animate(notifyRunning, notifyTiming)