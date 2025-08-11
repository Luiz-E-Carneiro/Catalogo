let header = document.getElementsByTagName("header")[0]
let movie_trailer = document.getElementById("movie_trailer")
let watch = document.getElementById("watch")
let settings_button = document.getElementById("settings")
let settings_window = document.getElementById("settings_window")
let settings_button_data = settings_button.getBoundingClientRect()
settings_window.style.top = settings_button_data.top - 87 + "px"
settings_window.style.left = settings_button_data.left - 175 + settings_button_data.width + "px"
document.addEventListener("scroll", function() {scrolling()})
movie_trailer.addEventListener("click", function(event) {trailer_closer(event)})
watch.addEventListener("click", function(event) {trailer()})
document.addEventListener("click", function(event) {
    dropdown_closer(event)
})
settings_button.addEventListener("click", function() {settings()})

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
function settings() {
    if (!settings_window.classList.contains("settings_opened")) {
        settings_window.classList.add("settings_opened")
        settings_window.style.display = "flex"
        settings_window.style.animation = "show 0.25s forwards"
    } else {
        settings_window.classList.remove("settings_opened")
        settings_window.style.animation = "unshow 0.25s forwards"
        setTimeout(() => {
            settings_window.style.display = "none"
        }, 250);
    }
}
function dropdown_closer(event) {
    if (!search_input.contains(event.target) && !search_button.contains(event.target) && !search_input.classList.contains("closed")) {
        search()
    }
    if (!profile_dropdown.contains(event.target) && !profile_button.contains(event.target) && !profile_dropdown.classList.contains("closed")) {
        dropdown()
    }
    if (!settings_window.contains(event.target) && !settings_button.contains(event.target) && settings_window.classList.contains("settings_opened")) {
        settings()
    }
}