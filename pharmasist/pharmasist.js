const root = document.documentElement;

function getCustomPropertyValue(propertyName) {
    return getComputedStyle(root).getPropertyValue(propertyName).trim();
}

let basecolor = getCustomPropertyValue('--base-color');
let mediumgrey = getCustomPropertyValue('--medium-gray');




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
    window.location.href = 'produce.php';
}


document.addEventListener('DOMContentLoaded', function() {




    const tabs = document.querySelectorAll('.tab');
    const content = document.getElementById('content');


    function localVarToFalse(itemName) {
        if (localStorage.getItem(itemName) == null || localStorage.getItem(itemName) == 'true') localStorage.setItem(itemName, 'false');
    }

    function localVarToTrue(itemName) {
        if (localStorage.getItem(itemName) == null || localStorage.getItem(itemName) == 'false') localStorage.setItem(itemName, 'true');
    }

    function loadTabContent(tab) {
        const target = tab.getAttribute('data-target');
        if (target == 'produce-list.php') {
            localVarToTrue('mlt-produce');
            localVarToFalse('mlt-inventory')
        }
        if (target == 'inventory.php') {
            localVarToTrue('mlt-inventory');
            localVarToFalse('mlt-produce');
        }
        if (target != 'inventory.php' && target != 'produce-list.php') {
            localVarToFalse('mlt-inventory');
            localVarToFalse('mlt-produce');
        }
        fetch(target)
            .then(response => response.text())
            .then(data => {
                content.innerHTML = data;
                tabs.forEach(colorTab => {
                    colorTab.style.backgroundColor = mediumgrey;
                });
                tab.style.backgroundColor = basecolor;
                initForm();
                if (target == 'stock-manage.php') {
                    stockCalculation();
                } else if (target == 'outofstock.php') {
                    outstockCalculation();
                }
            })
            .catch(error => {
                console.error('Error loading content:', error);
            });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            loadTabContent(tab);
        });
    });
    if (localStorage.getItem('mlt-produce') == 'true') loadTabContent(tabs[0]);
    if (localStorage.getItem('mlt-inventory') == 'true') loadTabContent(tabs[1]);

    function initForm() {
        const form = document.getElementById('medicineForm');
        if (form) {
            let currentDate = new Date(new Date().setDate(new Date().getDate() + 14)).toISOString().split('T')[0];
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let expDate = document.getElementById('expirationDate').value;

                if (expDate < currentDate) {
                    // alert('This medicine is Expired')
                    Swal.fire({
                        icon: "error",
                        title: "About to expire!",
                        background: "#fff",
                        text: "To expire, include medications that are more than 14 days old.",
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
                            // window.location = "index.php";
                            location.reload();
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
                            if (medicine.exp > currentDate) {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                <td>${medicine.name}</td>
                                <td>${medicine.brand}</td>
                                <td>${medicine.quantity}</td>
                                <td>${medicine.exp}</td>
                                `;
                                tableBody.appendChild(row);
                            }
                        });


                    })
                    .catch(error => console.error('Error:', error));
            }

            // Initial load
            loadMedicineData();
        }
    }

    function stockCalculation() {
        let tableBody = document.querySelector('tbody')
        let tableRows = Array.from(tableBody.querySelectorAll('tr'));
        // console.log(tableRows);

        tableRows.forEach(row => {
            let tds = Array.from(row.querySelectorAll('td'));
            let currentStock = tds[2].textContent;
            let weeklyAverage = tds[3].textContent;
            let availabilityDays = Math.ceil(currentStock / (weeklyAverage / 7));
            let sixMonthStock = Math.ceil((weeklyAverage / 7) * 183);
            tds[4].textContent = availabilityDays;
            tds[6].textContent = sixMonthStock;
        });
    }

    function outstockCalculation() {
        let tableBody = document.querySelector('tbody')
        let tableRows = Array.from(tableBody.querySelectorAll('tr'));
        // console.log(tableRows);

        tableRows.forEach(row => {
            let tds = Array.from(row.querySelectorAll('td'));
            let repcount = tds[4].textContent;
            let totalUsage = tds[3].textContent;
            // let availabilityDays = Math.ceil(currentStock / (weeklyAverage / 7));
            let sixMonthStock = Math.ceil(((totalUsage / repcount) * 3) * 183);
            // tds[1].textContent = availabilityDays;
            tds[5].textContent = sixMonthStock;
        });
    }
    // Initial load for the current content
    initForm();

});


function examinePatient(pid) {
    window.location.href = 'produce.php?pid=' + pid;
}