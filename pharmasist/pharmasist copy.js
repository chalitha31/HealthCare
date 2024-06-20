const root = document.documentElement;

function getCustomPropertyValue(propertyName) {
    return getComputedStyle(root).getPropertyValue(propertyName).trim();
}

let basecolor = getCustomPropertyValue('--base-color');
let mediumgrey = getCustomPropertyValue('--medium-gray');

document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const content = document.getElementById('content');

    function loadTabContent(tab) {
        const target = tab.getAttribute('data-target');
        if (target == 'inventory.php') {
            if (localStorage.getItem('pharlog') == null || localStorage.getItem('pharlog') == 'false') {
                localStorage.setItem('pharlog', 'true');
                console.log(localStorage.getItem('pharlog'));
            }
        }
        fetch(target)
            .then(response => response.text())
            .then(data => {
                content.innerHTML = data;
                tabs.forEach(colorTab => {
                    colorTab.style.backgroundColor = mediumgrey;
                });
                tab.style.backgroundColor = basecolor;
            })
            .catch(error => {
                console.error('Error loading content:', error);
            });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            // try {
            //     document.querySelector('.content-backdrop').style.display = 'none';
            // } catch (error) {
            //     console.log('couldnt block',error);
            // }
            e.preventDefault();
            loadTabContent(tab);
        });
    });
    let pharlog = localStorage.getItem('pharlog');
    if (pharlog == 'true') {
        loadTabContent(tabs[0]);
    }



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






function examinePatient() {
    window.location.href = 'produce.html';
}


// pharmasist.js
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();

            const target = e.target.getAttribute('data-target');

            fetch(target)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('content').innerHTML = data;
                    // Re-initialize form submission and data loading after content load
                    initForm();
                })
                .catch(error => console.error('Error:', error));
        });
    });

    function initForm() {
        const form = document.getElementById('medicineForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let expDate = document.getElementById('expirationDate').value;
                let currentDate = new Date().toISOString().split('T')[0];

                if (expDate < currentDate) {
                    // alert('This medicine is Expired')
                    Swal.fire({
                        icon: "error",
                        title: "This medicine is Expired",
                        background: "#fff",
                        showConfirmButton: true,
                        customClass: {
                            popup: 'swal2-dark'
                        }

                        // timer: 2000
                    });
                    return;
                }

                const formData = new FormData(form);
                fetch('submit_medicine.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        // alert(data);
                        Swal.fire({
                            icon: "success",
                            title: data,
                            background: "#fff",
                            showConfirmButton: true,
                            customClass: {
                                popup: 'swal2-dark'
                            }

                            // timer: 2000
                        }).then(() => {
                            window.location = "index.php";
                        });
                        // Refresh the table
                        loadMedicineData();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            function loadMedicineData() {
                fetch('get_medicine.php')
                    .then(response => response.json())
                    .then(data => {
                        const tableBody = document.querySelector('#medicineTable tbody');
                        tableBody.innerHTML = '';

                        data.forEach(medicine => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${medicine.name}</td>
                                <td>${medicine.brand}</td>
                                <td>${medicine.quantity}</td>
                                <td>${medicine.exp}</td>
                            `;
                            tableBody.appendChild(row);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Initial load
            loadMedicineData();
        }
    }

    // Initial load for the current content
    initForm();
});