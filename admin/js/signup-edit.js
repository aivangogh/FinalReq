const id = document.getElementById('id');
const email = document.getElementById('email');
const password = document.getElementById('password');
const role = document.getElementById('role');

// EVENT LISTENERS
id.addEventListener('input', () => {
  autoFillup(id);
});
id.addEventListener('blur', autoComplete);
// This will be executed if user select a college
role.addEventListener('change', selectRole);

function autoFillup(id) {
  email.value = id.value;
}

function autoComplete() {
  if (role.value === 'admin') email.value = `${id.value}@admin.buksu.edu.ph`;
  else email.value = `${id.value}@student.buksu.edu.ph`;
}

function selectRole() {
  const roleId = document.querySelector('.role-id');
  const roleEmail = document.querySelector('.role-email');
  if (role.value === 'admin') {
    roleId.innerText = 'Admin';
    roleEmail.innerText = 'admin';
    id.placeholder = 'Admin ID';
    email.value = `${id.value}@admin.buksu.edu.ph`;
  } else {
    roleId.innerText = 'Student';
    roleEmail.innerText = 'student';
    id.placeholder = 'Student ID';
    email.value = `${id.value}@student.buksu.edu.ph`;
  }
}

// Show and hide icon in password button
const passwordIcon = document.querySelector('.password-icon');
document.querySelector('.password-button').addEventListener('click', (e) => {
  e.preventDefault();
  if (password.type == 'password') {
    password.type = 'text';
    passwordIcon.src = '../assets/images/eye-regular.svg';
  } else {
    password.type = 'password';
    passwordIcon.src = '../assets/images/eye-slash-regular.svg';
  }
});
