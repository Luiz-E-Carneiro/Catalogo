let profile_dropdown = document.getElementById("profile_dropdown")
let profile_button = document.getElementById("profile_button")
let profile_button_data = profile_button.getBoundingClientRect()
console.log(profile_button_data);

profile_dropdown.style.top = profile_button_data.top + profile_button_data.height + 10 + "px"
profile_dropdown.style.left = profile_button_data.left - profile_dropdown.getBoundingClientRect().width + profile_button_data.width + "px"
profile_button.addEventListener("click", function() {
    dropdown()
})
document.addEventListener("click", function(event) {
    if (event.target != profile_dropdown && event.target != profile_button && !profile_dropdown.classList.contains("closed")) {
        dropdown()
    }
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
