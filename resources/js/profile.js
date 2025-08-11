let settings_button = document.getElementById("profile_settings")
let settings_window = document.getElementById("settings_window")
let settings_button_data = settings_button.getBoundingClientRect()
settings_window.style.top = settings_button_data.top + settings_button_data.height + 5 + "px"
settings_window.style.left = settings_button_data.left - 175 + settings_button_data.width + "px"

settings_button.addEventListener("click", function() {settings()})
document.addEventListener("click", function(event) {
    dropdown_closer(event)
})
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
