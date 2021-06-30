const modalElement = document.querySelector('.modal-container');
const deleteModalElement = document.querySelector('.delete-modal-container');
const overlayElement = document.querySelector('#overlay');
const editBtn = document.querySelector('.edit-btn');
const deleteBtn = document.querySelectorAll('.delete-btn');
const addBtn = document.querySelector('.add-btn');
const cancelBtn = document.querySelector('.action-cancel-btn');
const modalHeaderElement = document.querySelector('.modal-header');
const passwordElement = document.querySelector('.password');
const tableRows = document.querySelector('.table-rows');
const talbleData = document.querySelector('.table-data');

const emailData = document.querySelector('[data-email]');
const passwordData = document.querySelector('[data-password]');
const firstNameData = document.querySelector('[data-first-name]');
const middleNameData = document.querySelector('[data-middle-name]');
const lastNameData = document.querySelector('[data-last-name]');
const phoneData = document.querySelector('[data-phone]');
const genderData = document.querySelector('[data-gender]');
const courseIdData = document.querySelector('[data-course-id]');
const yearLevelData = document.querySelector('[data-year-level]');
const roleData = document.querySelector('[data-role]');

const idPrompt = document.querySelector('.prompt-id');
const emailPrompt = document.querySelector('.prompt-email');
const passwordPrompt = document.querySelector('.prompt-password');
const firstNamePrompt = document.querySelector('.prompt-first-name');
const middleNamePrompt = document.querySelector('.prompt-middle-name');
const lastNamePrompt = document.querySelector('.prompt-last-name');
const phonePrompt = document.querySelector('.prompt-phone');
const genderPrompt = document.querySelector('.prompt-gender');
const courseIdPrompt = document.querySelector('.prompt-course');
const yearLevelPrompt = document.querySelector('.prompt-year-level');
const rolePrompt = document.querySelector('.prompt-role');

const actionDeleteBtn = document.querySelector('.action-delete-btn');

actionDeleteBtn.addEventListener('click', deleteUser);

console.log(tableRows);

function deleteUser() {
  var xhttp = new XMLHttpRequest();
  
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      alert('Deleted!');
    }
  };

  xhttp.open('GET', 'admin/includes/delete.php', true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.send('id=' + id);
}

// Event Listener
cancelBtn.addEventListener('click', cancelAction);

// Delete btn
deleteBtn.forEach((btn) => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    if (e.target.classList.contains('delete-btn')) {
      let row = e.target.parentElement.parentElement.parentElement;
      let userData = new Map();

      userData.set('id', row.cells[0].innerText);
      userData.set('email', row.cells[1].innerText);
      userData.set('password', row.cells[2].innerText);
      userData.set('firstName', row.cells[3].innerText);
      userData.set('middleName', row.cells[4].innerText);
      userData.set('lastName', row.cells[5].innerText);
      userData.set('phone', row.cells[6].innerText);
      userData.set('gender', row.cells[7].innerText);
      userData.set('course', row.cells[8].innerText);
      userData.set('yearLevel', row.cells[9].innerText);
      userData.set('role', row.cells[10].innerText);

      console.log(userData.get('id'));

      document.getElementById('delete-id').value = userData.get('id');

      showRowDetails(userData);
      deleteAction();
    }
  });
});

function deleteAction() {
  showDeleteModal();
}

function cancelAction() {
  hideModal();
}

function showRowDetails(userData) {
  idPrompt.innerText = userData.get('id');
  emailPrompt.innerText = userData.get('email');
  passwordPrompt.innerText = userData.get('password');
  firstNamePrompt.innerText = userData.get('firstName');
  middleNamePrompt.innerText = userData.get('middleName');
  lastNamePrompt.innerText = userData.get('lastName');
  phonePrompt.innerText = userData.get('phone');
  genderPrompt.innerText = userData.get('gender');
  courseIdPrompt.innerText = userData.get('course');
  yearLevelPrompt.innerText = userData.get('yearLevel');
  rolePrompt.innerText = userData.get('role');
}

function showDeleteModal() {
  deleteModalElement.style.display = 'flex';
  overlayElement.classList.add('active');
}

function hideModal() {
  overlayElement.classList.remove('active');
  deleteModalElement.style.display = 'none';
}
