let header = document.getElementsByTagName("header")[0]
let movie_trailer = document.getElementById("movie_trailer")
let watch = document.getElementById("watch")
document.addEventListener("scroll", function() {scrolling()})
movie_trailer.addEventListener("click", function(event) {trailer_closer(event)})
watch.addEventListener("click", function(event) {trailer()})

function scrolling() {
    if (window.scrollY > 50) {
        header.classList.add("scroll_header")
    } else {
        header.classList.remove("scroll_header")
    }
}
function trailer() {
    if (movie_trailer.classList.contains("closed_movie")) {
        movie_trailer.classList.remove("closed_movie")
        movie_trailer.classList.add("opened_movie")
        movie_trailer.style.display = "flex"
        movie_trailer.style.animation = "show 0.25s forwards"
    } else {
        movie_trailer.classList.remove("opened_movie")
        movie_trailer.classList.add("closed_movie")
        movie_trailer.style.animation = "unshow 0.25s forwards"
        setTimeout(() => {
            movie_trailer.style.display = "none"
        }, 250);
    }
}
function trailer_closer(event) {
    if (movie_trailer.children[0] != event.target) {
        trailer()
    }
}