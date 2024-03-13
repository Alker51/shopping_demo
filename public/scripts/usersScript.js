function showHideToggle() {
    let tr = document.getElementsByClassName("personalInfos");
    let button = document.getElementById("buttonPersonalInfos");

    for (let item of tr) {
        if (item.style.display === "none") {
            button.innerText = 'Masquer';
            item.style.display = "table-row";
        } else {
            button.innerText = 'Afficher';
            item.style.display = "none";
        }
    }
}