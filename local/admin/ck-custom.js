// Video embedded handle for admin page

let VidElement = document.querySelector('.video-dai-dien');
if (VidElement) {
    VidElement.addEventListener("change", function() {
        let VidId = VidElement.textContent;
        let div = document.createElement("div");
        div.setAttribute("data-id", VidId);
        let thumbNail = document.createElement('img');
        thumbNail.src = "//i.ytimg.com/vi/ID/hqdefault.jpg".replace("ID", VidId);
        div.appendChild(thumbNail);
        let playButton = document.createElement('div');
        playButton.setAttribute("class", "play");
        playButton.appendChild(`<img src='/user-upload/imgs/play-button.png' />`);
        div.appendChild(playButton);
        console.log("Hello world");
    })
}