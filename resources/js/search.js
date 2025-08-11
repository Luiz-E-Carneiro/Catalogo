let filter_window = document.getElementById("filter_window")
let filter_button = document.getElementById("filter_button")
let filter_inputs = document.querySelectorAll(".filter_option select")

let filter_button_data = filter_button.getBoundingClientRect()
document.getElementById("cancel_button").addEventListener("click", function() {
    filter()
})
document.getElementById("filter_header").children[1].addEventListener("click", function() {
    filter()
})
document.getElementById("submit_button").addEventListener("click", function() {
    form_submit()
})
console.log(filter_button_data);
for (let i = 0; i <= filter_inputs.length-1; i ++) {
    filter_inputs[i].addEventListener("change", function() {
        input_value(this)
    })
}

filter_window.style.top = filter_button_data.top + 10 + "px"
filter_window.style.left = filter_button_data.left - 250 + 10 + "px"
filter_button.addEventListener("click", function() {filter()})
function filter() {
    if (!filter_window.classList.contains("filter_opened")) {
        filter_window.classList.add("filter_opened")
        filter_window.style.display = "flex"
        filter_window.style.animation = "show 0.25s forwards"
    } else {
        filter_window.classList.remove("filter_opened")
        filter_window.style.animation = "unshow 0.25s forwards"
        setTimeout(() => {
            filter_window.style.display = "none"
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
    if (!filter_window.contains(event.target) && !filter_button.contains(event.target) && filter_window.classList.contains("filter_opened")) {
        filter()
    }
}
function input_value(element) {
    document.getElementsByName(element.id)[0].value = element.value
}
function form_submit() {
    document.getElementById("main_search").submit()
}
