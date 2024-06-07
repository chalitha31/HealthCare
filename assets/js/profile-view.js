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
let profileInputs = Array.from(document.querySelectorAll('.profile-inputs')).slice(2);

editBtn.addEventListener('click', function() {
    profileInputs.forEach(input => {

        input.disabled = false
        input.style.border = '3px solid var(--base-color)';
    });

    saveBtn.style.display = 'block';
    editBtn.style.display = 'none';
});

saveBtn.addEventListener('click', function() {
    profileInputs.forEach(input => {
        input.disabled = true
        input.style.border = '1px solid var(--medium-gray)';
    });
    saveBtn.style.display = 'none';
    editBtn.style.display = 'block';
});


function updatePatientProfile(patientId) {
    // alert(patientId);
    // let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let contact = document.getElementById('contact').value;
    let age = document.getElementById('age').value;
    let address = document.getElementById('address').value;
    // let nic = document.getElementById('nic').value;

    const updatePatientDetails = {

        // "name": name,
        "email": email,
        "contact": contact,
        "age": age,
        "address": address,
        // "nic": nic,
        "status": "update",
        "patientProfile_id": patientId,
    }

    fetch("http://localhost/HealthCare/reception/receptionProcess.php", {
        method: "POST",
        body: JSON.stringify(updatePatientDetails),

    })

    .then(response => {
        return response.text();
    })

    .then(data => {

        console.log(data);
        // alert(data);
    })

    .catch(error => {
        console.error('UpdatePertionProcess Error:', error);
    });

}

function exsitsPatientAddSymptoms(p_id) {

    let age = document.getElementById('age').value;
    let symptoms = document.getElementById('symptoms').value;

    const addNewsymptoms = {

        "age": age,
        "symptoms": symptoms,
        "status": "addSymptoms",
        "patientProfile_id": p_id,
    }

    fetch("http://localhost/HealthCare/reception/receptionProcess.php", {
        method: "POST",
        body: JSON.stringify(addNewsymptoms),

    })

    .then(response => {
        return response.text();
    })

    .then(data => {
        location.reload();
        console.log(data);
        // alert(data);
    })

    .catch(error => {
        console.error('addNewsymptoms Error:', error);
    });

}