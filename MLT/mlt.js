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
            localVarToFalse('mlt-inventory');
            localVarToFalse('mlt-stock'); //
        }
        if (target == 'inventory.php') {
            localVarToTrue('mlt-inventory');
            localVarToFalse('mlt-produce');
            localVarToFalse('mlt-stock'); //
        }
        if (target == 'stock-manage.php') {
            localVarToFalse('mlt-inventory');
            localVarToFalse('mlt-produce');
            localVarToTrue('mlt-stock'); //
        }
        if (target != 'inventory.php' && target != 'produce-list.php' && target != 'stock-manage.php') {
            localVarToFalse('mlt-inventory');
            localVarToFalse('mlt-produce');
            localVarToFalse('mlt-stock'); //
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
                    // loadEquipData();
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
    else if (localStorage.getItem('mlt-stock') == 'true') loadTabContent(tabs[3]);
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
                                <td>${medicine.purchase_date}</td>
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


    //     function loadEquipData() {
    //         fetch('get-stock.php')
    //             .then(response => response.json())
    //             .then(data => {
    //                 // const tableBody = document.querySelector('#stockTable tbody');
    //                 // const eqAqty = document.getElementById('eqAqty');
    //                 // const eqName = document.getElementById('eqName');
    //                 // const eqPqty = document.getElementById('eqPqty');

    //                 const tableBody = document.getElementById('stmediTable');
    //                 const upModel = document.getElementById('upModel');

    //                 tableBody.innerHTML = '';
    //                 let number = 1;
    //                 data.forEach(medicine => {

    //                     // eqName.innerText = medicine.name;
    //                     // eqAqty.innerText = medicine.quantity;
    //                     // eqPqty.innerText = medicine.avalable_quantity;

    //                     const row = document.createElement('tr');
    //                     row.addEventListener('click', showUpdateModel);
    //                     let currentStock = medicine.quantity;
    //                     //                let weeklyAverage = medicine.weekly;
    //                     //                let availabilityDays = Math.ceil(currentStock / (weeklyAverage / 7));
    //                     //              let sixMonthStock = Math.ceil((weeklyAverage / 7) * 183);
    //                     upModel.innerHTML = `

    //                     <div id="myModal" class="modal">


    //                         <div class="modal-content">
    //                             <span onclick="closeModel()" class="close">&times;</span>
    //                             <h2 class="modelHead">Update equipments Details</h2>
    //                             <div class="eqipmentDetails">
    //                                 <div style="max-width: 340px; " class="">
    //                                     <strong class="">Name : </strong>
    //                                     <span id="eqName" style="word-wrap:break-word;" class="">${medicine.name}</span>
    //                                 </div>
    //                                 <div class="">
    //                                     <strong class="">Purchase Quantitiy : </strong>
    //                                     <span id="eqPqty" class="">${currentStock} </span>
    //                                 </div>
    //                                 <div class="">
    //                                     <strong class="">Avalabile Quantitiy : </strong>
    //                                     <span id="eqAqty" class="">${medicine.avalable_quantity} </span>
    //                                 </div>

    //                             </div>

    //                             <br />
    //                             <hr>

    //                             <div class="updateQuantitiy">
    //                                 <h3>Update Quantitiy : </h3>
    //                                 <br />
    //                                 <input type="number" min="0">
    //                                 <button onclick="updateEquiDetails()" style="background-color: rgb(13, 141, 45);" class="outofstock">Update</button>
    //                                 <button onclick="updateEquiDetails()" class="outofstock">Out Of Stock</button>
    //                             </div>

    //                         </div>

    //                     </div>
    //                                 `;

    //                     row.innerHTML = `
    //                         <td>${number++}</td>
    //                         <td>${medicine.name}</td>
    //                         <td>${currentStock}</td>
    //                       <td>${medicine.purchase_date}</td>
    //                       <td>${medicine.avalable_quantity}</td>
    //                        <td></td>
    //                       <td></td>
    //                         `;
    //                     tableBody.appendChild(row);


    //                 });
    //             })
    //             .catch(error => console.error('Error:', error));
    //     }

});


function filterTable() {
    const searchBar = document.getElementById('searchBar');
    const filter = searchBar.value.toLowerCase();
    const table = document.getElementById('medicineTable');
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

function openReportImage(reportName) {
    // Get the modal
    var modal = document.getElementById("myModal");
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    // var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = "../MLT/images/" + reportName;
    captionText.innerHTML = "Medical Test Report";


}

function closeOpenImage() {
    // Get the <span> element that closes the modal

    var modal = document.getElementById("myModal");
    // When the user clicks on <span> (x), close the modal

    modal.style.display = "none";
}


function closeModel(id) {
    var modal = document.getElementById("myModal-" + id);
    const editQty = document.getElementById("editQty-" + id).value = '';
    modal.style.display = "none";
}

function showUpdateModel(id) {

    var modal = document.getElementById("myModal-" + id);
    modal.style.display = "block";


}

function updateEquiDetails(eqId) {

    const editQty = document.getElementById("editQty-" + eqId).value;

    if (editQty == "") {
        alert("Please enter a quantity.");
        return;
    }

    const url = `updateMltStockProcess.php?upQty=${editQty}&eqid=${eqId}`;
    fetch(url, {
        method: "GET",
        // body: "upQty=" + editQty + "&eqid=" + eqId,

    })

    .then((response) => response.text())
        .then(data => {
            if (data == "success") {
                location.reload();
            } else {
                alert(data);
            }
        })
        .catch(error => { console.error("Error :", error) });

}