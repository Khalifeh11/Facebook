const id = localStorage.getItem("user_id");
const firstName_stored = localStorage.getItem("first_name");
const lastName_stored = localStorage.getItem("last_name");

const userName = document.getElementById("username");
userName.textContent = firstName_stored.toUpperCase() + " " + lastName_stored.toUpperCase();

