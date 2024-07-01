let showMenu = false;
const profileMenu = document.querySelector(".dashboard-profile-menu-button");
const dropdownMenu = document.querySelector("#dashboard-menu-dropdown");

profileMenu.onclick = () => {
    if (!showMenu) {
        dropdownMenu.removeAttribute("class");
        dropdownMenu.setAttribute("class", "dashboard-menu-dropdown");
        showMenu = true;
    } else if (showMenu) {
        dropdownMenu.removeAttribute("class");
        dropdownMenu.setAttribute("class", "dashboard-menu-dropdown-hidden");
        showMenu = false;
    }
};
