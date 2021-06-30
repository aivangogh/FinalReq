const id = document.getElementById('id');
const email = document.getElementById('university-email');
const password = document.querySelectorAll('.password');
const firstName = document.getElementById('first-name');
const middleName = document.getElementById('middle-name');
const lastName = document.getElementById('last-name');
const phone = document.getElementById('phone');
const gender = document.querySelectorAll('input[name="gender"]');
const genderMale = document.getElementById('male');
const genderFemale = document.getElementById('female');
const college = document.getElementById('college');
const course = document.getElementById('course');
const yearLevel = document.getElementById('year-level');

const emailLabel = document.querySelector('.email .email-label');
const updateProfileButton = document.getElementById('update-profile-button');

changeAvatar();
disableRestrictedInput();

function disableRestrictedInput() {
  id.disabled = true;
  email.disabled = true;
  college.disabled = true;
  course.disabled = true;
  yearLevel.disabled = true;
  genderMale.disabled = true;
  genderFemale.disabled = true;
}

function changeAvatar() {
  for (let check of gender) {
    if (check.checked) {
      avatar.src = 'assets/images/female.png';
    } else {
      avatar.src = 'assets/images/male.png';
    }
  }
}

// This function will get data from User Info class to update the Card Profile Info
function updateCardProfileInfo() {
  const avatar = document.getElementById('avatar');

  document.getElementById(
    'user-name'
  ).innerText = `${user.getFirstName()} ${user.getLastName()}`;
  document.getElementById('user-email').innerText = `${user.getEmail()}`;

  // This statement will change the src attribute base on users gender
  let gender = user.getGender();
  if (gender === 'male') avatar.src = 'assets/images/male.png';
  else avatar.src = 'assets/images/female.png';
}

// Same as above
function updateProfileInfo() {
  id.value = user.getStudentID();
  email.value = user.getEmail();
  email.disabled = true;
  emailLabel.innerText = `Email Address (disabled)`;
  firstName.value = user.getFirstName();
  middleName.value = user.getMiddleName();
  lastName.value = user.getLastName();
  phone.value = user.getPhone();
  password.value = user.getPassword();

  // This statement will change the checked state base on users gender
  if (user.getGender() == 'male') sexMale.checked = true;
  else sexFemale.checked = true;

  setCollegeAndCourse(user.getCourse());
  setYearLevel(user.getYearLevel());
}

// This function will set the college and courses selected options. This is loop within the loop or nested loop
// It loops in array of objects and find the id of course and return an id and college.
// if courseID from UserInfo match in course array of objects then return the
// id and course   and  id and college. after this it will populate the option base on the result

function setCollegeAndCourse(courseId) {
  collegeArray.forEach((collegeMap) => {
    collegeMap.courses.filter((coursesMap) => {
      if (coursesMap.id == courseId) {
        college.value = collegeMap.id;
        college.innerHTML = `<option>${collegeMap.college}</option>`;
        document.getElementById(
          'user-college'
        ).innerText = `${collegeMap.college}`;

        course.value = coursesMap.id;
        course.innerHTML = `<option>${coursesMap.course}</option>`;
        document.getElementById('user-course').innerText = `${coursesMap.id}`;
      }
    });
  });
}

// They have similarities in previous function but this is jus only an array of objects
function setYearLevel(yearLevelId) {
  yearLevelArray.filter((year) => {
    if (year.id == yearLevelId) {
      yearLevel.value = year.id;
      yearLevel.innerHTML = `<option>${year.year}</option>`;
      document.getElementById('user-year').innerText = `${year.id}`;
    }
  });
}

// Update Button
updateProfileButton.addEventListener('click', (e) => {
  e.preventDefault();
  alert(`Sorry, this function is temporarily unavailable.`);
});

// Show and hide icon in password button
const passwordIcon = document.querySelectorAll('.password-icon');
const passwordButton = document.querySelectorAll('.password-button');

passwordButton.forEach((btn) => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    if (password.type == 'password') {
      password.type = 'text';
      passwordIcon.src = 'assets/images/eye-regular.svg';
    } else {
      password.type = 'password';
      passwordIcon.src = 'assets/images/eye-regular.svg';
    }
  });
});
