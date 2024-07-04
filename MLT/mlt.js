const root = document.documentElement;

function getCustomPropertyValue(propertyName) {
    return getComputedStyle(root).getPropertyValue(propertyName).trim();
}

let basecolor = getCustomPropertyValue('--base-color');
let mediumgrey = getCustomPropertyValue('--medium-gray');

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
                if (target == 'stock-manage.php') {
                    loadEquipData();
                    // stockCalculation();
                }
                if (target == 'inventory.php') {
                    initForm();
                }
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


    // if (localStorage.getItem('mlt-produce') == 'true') loadTabContent(tabs[0]);
    // if (localStorage.getItem('mlt-inventory') == 'true') loadTabContent(tabs[2]);

    if (localStorage.getItem('mlt-produce') == 'true') loadTabContent(tabs[0]);
    else if (localStorage.getItem('mlt-inventory') == 'true') loadTabContent(tabs[2]);
    else loadTabContent(tabs[4]);

    function initForm() {
        // console.log('initForm Function')
        const form = document.getElementById('medicineForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                fetch('submit_medicine.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {

                        document.getElementById("medicineName").value = '';
                        document.getElementById("medicineQuantity").value = '';
                        alert(data);


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
                                <td>${medicine.quantity}</td>
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


    function loadEquipData() {
        fetch('get-stock.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#stockTable tbody');
                tableBody.innerHTML = '';
                let number = 1;
                data.forEach(medicine => {
                    const row = document.createElement('tr');
                    let currentStock = medicine.quantity;
                    let weeklyAverage = medicine.weekly;
                    let availabilityDays = Math.ceil(currentStock / (weeklyAverage / 7));
                    let sixMonthStock = Math.ceil((weeklyAverage / 7) * 183);
                    row.innerHTML = `
                        <td>${number++}</td>
                        <td>${medicine.name}</td>
                        <td>${currentStock}</td>
                        <td>${weeklyAverage}</td>
                        <td>${availabilityDays}</td>
                        <td>${sixMonthStock}</td>
                        `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
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






function examinePatient(pdi, type) {
    // alert(type)

    if (type == 'fbc') {
        window.location.href = 'blood-report.php?pdi=' + pdi + '&type=' + type;

    } else if (type == 'lipid') {
        window.location.href = 'hdl-report.php?pdi=' + pdi + '&type=' + type;

    } else if (type == 'ldl') {
        window.location.href = 'ldl-report.php?pdi=' + pdi + '&type=' + type;

    } else if (type == 'ppbs') {
        window.location.href = 'ppbs-report.php?pdi=' + pdi + '&type=' + type;

    } else if (type == 'vldl') {
        window.location.href = 'vldl-report.php?pdi=' + pdi + '&type=' + type;

    } else if (type == 'fpg') {
        window.location.href = 'fbs-report.php?pdi=' + pdi + '&type=' + type;

    }

    // window.location.href = 'blood-report.php?pdi=' + pdi;
}