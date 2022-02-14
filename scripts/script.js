const signinBtn = document.getElementById("signin-btn");

signinBtn.addEventListener("click", function (e) {
  e.preventDefault();
  const email = document.getElementById("login-email").value;
  const password = document.getElementById("login-password").value;
  fetchLogin(email, password);
});

async function fetchLogin(email, password) {
  const settings = {
    method: "POST",
    body: new URLSearchParams({
      email: email,
      password: password,
    }),
  };
  try {
    const response = await fetch(
      "http://localhost/Facebook/php/login.php",
      settings
    );
    console.log(response);
    const json = await response.json();
    console.log(json);
    if (json.status != "User not found!") {
      localStorage.clear();
      localStorage.setItem("user_id", json.user_id);
      localStorage.setItem("first_name", json.first_name);
      localStorage.setItem("last_name", json.last_name);

      location.href = "../views/home.html";
    }
  } catch (error) {
    console.log("error", error);
  }
}


const registerBtn = document.getElementById("signup-btn");
  registerBtn.addEventListener("click", function (e) {
  e.preventDefault();
  const email = document.getElementById("register-email").value;
  const firstName = document.getElementById("register-first-name").value;
  const lastName = document.getElementById("register-last-name").value;
  const password = document.getElementById("register-password").value;
  fetchRegister(firstName, lastName, email, password);
  
});

async function fetchRegister(firstName, lastName, email, password) {
  const settings = {
    method: "POST",
    body: new URLSearchParams({
      email: email,
      password: password,
      first_name: firstName,
      last_name: lastName
    }),
  };
  try {
    const response = await fetch(
      "http://localhost/Facebook/php/sign_up.php",
      settings
    );
    console.log(response);
    const json = await response.json();
    console.log(json);
  } catch (error) {
    console.log("error", error);
  }
}


