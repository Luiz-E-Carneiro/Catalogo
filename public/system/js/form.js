let inputs = document.getElementsByTagName("input")
let password_button = document.getElementsByClassName("password_button")
let checkbox = document.getElementsByClassName("checkbox")
for (let i = 0; i <= inputs.length-1; i ++) {
    inputs[i].addEventListener("focus", function() {
        input_focus(this)
    })
    inputs[i].addEventListener("blur", function() {
        input_focus(this)
    })
}
for (let i = 0; i <= checkbox.length-1; i ++) {
    checkbox[i].addEventListener("click", function() {
        checked(this)
    })
}
for (let i = 0; i <= password_button.length-1; i ++) {
    password_button[i].addEventListener("click", function() {
        password_input(this)
    })
}
function input_focus(element) {
    if (element.parentNode.classList.contains("focused")) {
        element.parentNode.classList.remove("focused")
    } else {
        element.parentNode.classList.add("focused")
    }
}
function password_input(element) {
    if (element.parentNode.children[1].getAttribute("type") === "password") {
        element.parentNode.children[1].setAttribute("type", "text");
        element.children[0].className = "fa-solid fa-eye"
    } else {
        element.parentNode.children[1].setAttribute("type", "password");
        element.children[0].className = "fa-solid fa-eye-slash"
    }
}
function checked(element) {
    if (element.classList.contains("checked")) {
        element.classList.remove("checked")
        element.children[0].value = 0
        element.children[1].children[0].style.animation = "uncheck 0.25s forwards"
    } else {
        element.classList.add("checked")
        element.children[0].value = 1
        element.children[1].children[0].style.animation = "check 0.25s forwards"
    }
}