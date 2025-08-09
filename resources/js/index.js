let profile_dropdown = document.getElementById("profile_dropdown")
let profile_button = document.getElementById("profile_button")
let search_button = document.getElementById("search_button")
let search_input = document.getElementById("search_input")
let profile_button_data = profile_button.getBoundingClientRect()
let search_button_data = search_button.getBoundingClientRect()
console.log(search_input.children[0].getBoundingClientRect());


profile_dropdown.style.top = profile_button_data.top + profile_button_data.height + 10 + "px"
profile_dropdown.style.left = profile_button_data.left - profile_dropdown.getBoundingClientRect().width + profile_button_data.width + "px"
search_input.style.top = search_button_data.top + "px"
search_input.style.left = search_button_data.left - 345 + search_button_data.width + "px"
profile_button.addEventListener("click", function() {
    dropdown()
})
search_button.addEventListener("click", function() {
    search()
})
document.addEventListener("click", function(event) {
    dropdown_closer(event)
})
function dropdown() {
    if (profile_dropdown.classList.contains("closed")) {
        profile_dropdown.classList.remove("closed")
        profile_dropdown.classList.add("opened")
    } else {
        profile_dropdown.classList.remove("opened")
        profile_dropdown.classList.add("closed")
    }
}
function search() {
    if (search_input.classList.contains("closed")) {
        search_input.classList.remove("closed")
        search_input.classList.add("opened")
        search_input.children[0].focus()
    } else {
        search_input.classList.remove("opened")
        search_input.classList.add("closed")
    }
}
function dropdown_closer(event) {
    if (!search_input.contains(event.target) && !search_button.contains(event.target) && !search_input.classList.contains("closed")) {
        search()
    }
    if (!profile_dropdown.contains(event.target) && !profile_button.contains(event.target) && !profile_dropdown.classList.contains("closed")) {
        dropdown()
    }
}
