import User from './user.js';

const loginForm = document.getElementById('login-form');
const loginError = document.getElementById('login-error');
const loginButton = document.getElementById('login-button');
const responseMsg = document.querySelector('.error-message');

const user = new User(); // instance of class UserInfo

const form = {
  username: document.getElementById('username'),
  password: document.getElementById('password'),
};

// loginButton.addEventListener('click', (e) => {
//   e.preventDefault();
//   const request = new XMLHttpRequest();

//   request.onload = () => {
//     let responseObject = null;

//     try {
//       responseObject = JSON.parse(request.responseText);
//     } catch (e) {
//       console.log('Could not parse JSON');
//     }

//     if (responseObject) {
//       handleResponse(responseObject);
//     }
//   };

//   let requestData = `username=${form.username.value}&password=${
//     form.password.value
//   }&login=${'login'}`;
//   request.open('POST', 'includes/login.php', true);
//   request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   request.send(requestData);
// });

let attempt = 3;
function handleResponse(responseObject) {
  console.log(responseObject);
  if (responseObject.ok) {
    location.href = 'home.html';
  } else {
    loginError.style.opacity = '1';
    responseMsg.innerText = `${responseObject.messages}`;
    invalidCredential();
  }
}

// function loginValidation() {
//   console.log(form);

//   if (emailID.value === '' || user.getPassword() === '') return; // guard clause - return or exit if input is empty

//   // calling getter in UserInfo class and returnign a value
//   // user login verification
//   if (
//     (emailID.value == user.getEmail() ||
//       emailID.value == user.getStudentID()) &&
//     password.value == user.getPassword()
//   ) {
//     window.location = 'home.html';
//   } else {
//     attempt--;
//     if (attempt == 0) {
//       invalidCredential();
//     } else {
//       loginError.style.opacity = '1';
//       setTimeout(() => {
//         loginError.style.opacity = '0';
//       }, 2000);
//     }
//   }
// }

function invalidCredential() {
  attempt--;
  if (attempt == 0) {
    disableForm();
  } else {
    loginError.style.opacity = '1';
    setTimeout(() => {
      loginError.style.opacity = '0';
    }, 2000);
  }
}

// This function will disable thefunctionalities temporarily of the login page
function disableForm() {
  responseMessage.innerText = `Please wait 10 second/s to try again`;
  loginError.style.opacity = '1'; //this will show the error messege
  emailID.disabled = true;
  password.disabled = true;
  loginForm.disabled = true;
  loginButton.disabled = true;
  errorCountdown();

  // after 10 seconds, this statements will execute
  setTimeout(() => {
    emailID.disabled = false;
    password.disabled = false;
    loginForm.disabled = false;
    loginButton.disabled = false;
    loginError.style.opacity = '0'; // hide the error message
    attempt = 3;
  }, 10000);
}

// This function is for countdown only
function errorCountdown() {
  let second = 10;
  const countdownTimer = setInterval(() => {
    if (second == 0) {
      responseMessage.innerText = '';
      second = 10;
      clearInterval(countdownTimer);
      return;
    }
    responseMessage.innerHTML = `Please wait ${
      second - 1
    } second/s to try again`;
    second--;
  }, 1000);
}
