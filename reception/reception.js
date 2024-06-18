const root = document.documentElement;

function getCustomPropertyValue(propertyName) {
    return getComputedStyle(root).getPropertyValue(propertyName).trim();
}

let basecolor = getCustomPropertyValue('--base-color');
let mediumgrey = getCustomPropertyValue('--medium-gray');

document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const content = document.getElementById('content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            tabs.forEach(colorTab => {
                colorTab.style.backgroundColor = mediumgrey;
            })
            e.preventDefault();
            const target = this.getAttribute('data-target');
            console.log(target)
            fetch(target)
                .then(response => response.text())
                .then(data => {
                    content.innerHTML = data;
                    tab.style.backgroundColor = basecolor;
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                });
        });
    });
});


function filterTable() {
    const searchBar = document.getElementById('searchBar');
    const filter = searchBar.value.toLowerCase();
    const table = document.getElementById('dataTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let rowText = '';
        for (let j = 0; j < cells.length; j++) {
            rowText += cells[j].textContent || cells[j].innerText;
        }
        if (rowText.toLowerCase().indexOf(filter) > -1) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

// function checkAge(){

//     const age = document.getElementById('age').value;
// if(age < 0) {


// }
// }


function registerPatient() {

    const name = document.getElementById('name').value;
    const nic = document.getElementById('nic').value;
    const age = document.getElementById('age').value;
    const email = document.getElementById('email').value;
    const address = document.getElementById('address').value;
    const contact = document.getElementById('contact').value;
    const symptoms = document.getElementById('symptoms').value;
    const medRep = document.getElementById('med-report').checked;

    patientDetails = {

        "name": name,
        "nic": nic,
        "age": age,
        "email": email,
        "address": address,
        "contact": contact,
        "symptoms": symptoms,
        "status": "add",
        "medicalReport": medRep,

    };


    fetch("http://localhost/HealthCare/reception/receptionProcess.php", {


        method: "POST",
        body: JSON.stringify(patientDetails)
    })

    .then(function(response) {
        return response.text();

    })

    .then(function(data) {

        if (data === "success") {
            // alert("success");
            Swal.fire({
                icon: "success",
                title: "Patient Registration Successful!",
                background: "#fff",
                text: "patient symptoms added",
                showConfirmButton: true,
                customClass: {
                    popup: 'swal2-dark'
                }

                // timer: 2000
            }).then(() => {
                window.location.reload();
                // window.location = "index.php";
            });


        } else {
            console.log(data);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                // color: "#22252c",
                background: "#fff",
                // text: "Something went wrong!",
                text: data,
                customClass: {
                    popup: 'swal2-dark'
                }

                // footer: '<a href="#">Why do I have this issue?</a>'
            });
        }

    })

    .catch(function(err) {

        console.error("resiptionProcess  error : ".err);

    })

}