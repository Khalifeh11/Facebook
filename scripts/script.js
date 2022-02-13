
const signinBtn = document.getElementById("signin-btn");


signinBtn.addEventListener("click", function(e){
    e.preventDefault();
    const email = document.getElementById("login-email").value;
    const password = document.getElementById("login-password").value;
    fetchLogin(email, password);
})


async function fetchLogin(email,password){
    const settings = {
      method: 'POST',
      body: new URLSearchParams ({
        "email" : email,
        "password" :password
      })
    };
    try{
        const response = await fetch('http://localhost/Facebook/php/login.php', settings);
        console.log(response);
        const json = await response.json();
        console.log(json);
        if (json.status != "User not found!"){
          localStorage.setItem("user_id", json.user_id);
          location.href = "http://localhost/Facebook/views/home.html"; 
        }
      }catch(error){
        console.log("error", error);
    }
};

const id = document.getElementById("ID");
