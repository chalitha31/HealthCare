// pharmasist.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('medicineForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        let expDate = document.getElementById('expirationDate').value;
        let currentDate = new Date().toISOString().split('T')[0];

        console.log('added', expDate);
        console.log('current', currentDate);
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
                // alert(data); // Show success or error message
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
                // Optionally, refresh the table to show the new data
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
                tableBody.innerHTML = ''; // Clear the table

                data.forEach(medicine => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${medicine.name}</td>
                        <td>${medicine.brand}</td>
                        <td>${medicine.quantity}</td>
                        <td>${medicine.expiration_date}</td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Initial load
    loadMedicineData();
});