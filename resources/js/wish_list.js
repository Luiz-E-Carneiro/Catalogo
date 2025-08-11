let save_buttons = document.getElementsByClassName("save_button")
for (let i = 0; i <= save_buttons.length-1; i ++) {
    save_buttons[i].addEventListener("click", function() {
        save(this, event)
    })
}
async function save(element, event) {
    if (element.id != "save") {
        event.preventDefault()
    }
    if (element.classList.contains("saved")) {
        element.classList.remove("saved")
        if (element.id == "save") {
            element.children[1].innerHTML = "Save in Wish List"
        } else {
            element.innerHTML = "<i class=\"fa-regular fa-bookmark\"></i>"
        }
    } else {
        element.classList.add("saved")
        if (element.id == "save") {
            element.children[1].innerHTML = "Saved on Wish List"
        } else {
            element.innerHTML = "<i class=\"fa-solid fa-bookmark\"></i>"
        }
    }
    let data = await fetch(`http://localhost:8000/favorite/save/${element.dataset.movie_id}`)
    data = await data.json()
    console.log(data);
}
