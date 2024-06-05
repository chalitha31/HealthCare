function showPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex';
}

function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
}

// Example function for adding new symptoms
document.getElementById('addSymptomsForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Handle form submission
    closePopup('add-symptoms-popup');
});


let editBtn = document.querySelector('.fa-pen-to-square');
let saveBtn = document.querySelector('.save-details');
let profileInputs = Array.from(document.querySelectorAll('.profile-inputs'));

editBtn.addEventListener('click', function() {
    profileInputs.forEach(input => input.disabled = false);
    saveBtn.style.display = 'block';
    editBtn.style.display = 'none';
});

saveBtn.addEventListener('click', function() {
    profileInputs.forEach(input => input.disabled = true);
    saveBtn.style.display = 'none';
    editBtn.style.display = 'block';
});