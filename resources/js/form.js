let inputs = document.getElementsByClassName("input")
for (let i = 0; i <= inputs.length-1; i ++) {
    inputs[i].children[1].addEventListener("keypress", function() {
        input_value(this)
    })
}
function input_value(element) {
    if (element.parentNode.classList.contains("error")) {
        element.parentNode.classList.remove("error")
    }
}
