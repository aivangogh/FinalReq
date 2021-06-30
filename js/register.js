const id = document.getElementById('id');
const email = document.getElementById('email');
const password = document.getElementById('password');
const college = document.getElementById('college');
const course = document.getElementById('course');
const yearLevel = document.getElementById('year-level');
const role = document.getElementById('role');

window.onload = () => {
  loadJSON();
};

// This is AJAX XHR Request
function loadJSON() {
  const request = new XMLHttpRequest();
  request.overrideMimeType('application/json');
  request.open('GET', 'json/colleges-courses.json', true);
  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == '200') {
      parseJSON(request.responseText);
    }
  };
  request.send(null);
}

// Parse JSON to create Array of objects
function parseJSON(response) {
  const parsedData = JSON.parse(response);
  const collegeArray = [...parsedData.College];
  const yearLevelArray = [...parsedData.YearLevel];
  collegeSelection(collegeArray);
  college.addEventListener('change', () => {
    changeCourses(collegeArray, college.value);
  });
  yearLevelSelection(yearLevelArray);
}

// EVENT LISTERNERS
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

// This function will population the options but if user select one of colleges,
// it will also affects the list options of the courses
function collegeSelection(collegeArray) {
  collegeArray.forEach((colleges) => {
    const optionCollege = document.createElement('option');
    optionCollege.appendChild(document.createTextNode(colleges.college));
    optionCollege.value = colleges.id;
    college.appendChild(optionCollege);
  });
}

// This will populate the selection base on college selection
// It has the same functionality of functions in login.js
function changeCourses(collegeArray, value) {
  let courseOptions = '';
  collegeArray.forEach((college) => {
    college.courses.filter((courses) => {
      if (college.id == value) {
        courseOptions += `<option value="${courses.id}">${courses.course}</option>`;
      }
    });
  });
  course.innerHTML = courseOptions;
}

// Populate the year level selection
function yearLevelSelection(yearLevelArray) {
  yearLevelArray.forEach((year) => {
    const optionYearLevel = document.createElement('option');
    optionYearLevel.appendChild(document.createTextNode(year.year));
    optionYearLevel.value = year.id;
    yearLevel.appendChild(optionYearLevel);
  });
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
    passwordIcon.src = 'assets/images/eye-regular.svg';
  } else {
    password.type = 'password';
    passwordIcon.src = 'assets/images/eye-slash-regular.svg';
  }
});
