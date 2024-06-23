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


console.log("Produce Loaded")
document.addEventListener('DOMContentLoaded', function() {
    const produceButton = document.getElementById('produceButton');
    const selectedTable = document.getElementById('selectedTable').getElementsByTagName('tbody')[0];

    let prodButton = true;
    window.addToNewTable = function(row) {

        if (prodButton) {
            produceButton.style.display = 'block';
            prodButton = false;
        }

        const name = row.cells[0].textContent;
        const brand = row.cells[1].textContent;
        const quantity = row.cells[2].textContent;
        const expirationDate = row.cells[3].textContent;

        const newRow = selectedTable.insertRow();

        const nameCell = newRow.insertCell(0);
        const brandCell = newRow.insertCell(1);
        const quantityCell = newRow.insertCell(2);
        const expirationDateCell = newRow.insertCell(3);
        const actionCell = newRow.insertCell(4);

        nameCell.textContent = name;
        brandCell.textContent = brand;
        quantityCell.innerHTML = `<input  class="qua-input" type="number" value="0" min="1">`;
        expirationDateCell.textContent = expirationDate;

        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.classList.add('remove-btn');
        removeButton.onclick = function() {
            selectedTable.deleteRow(newRow.rowIndex - 1);
        };
        actionCell.appendChild(removeButton);
        quantityInput();
    };

    produceButton.addEventListener('click', function() {
        const rows = selectedTable.rows;
        for (let i = 0; i < rows.length; i++) {
            const name = rows[i].cells[0].textContent;
            const brand = rows[i].cells[1].textContent;
            const quantity = rows[i].cells[2].getElementsByTagName('input')[0].value;
            console.log(`Medicine: ${name}, Brand: ${brand}, Quantity: ${quantity}`);
        }
    });

    function quantityInput() {
        let quantityInputs = Array.from(document.querySelectorAll('.qua-input'));
        quantityInputs.forEach(input => {
            input.addEventListener('input', () => {
                if (input.value < 0 || !Number.isInteger(parseFloat(input.value))) {
                    input.value = input.value.slice(0, -1);
                }
            });

            input.addEventListener('blur', () => {
                if (input.value === '' || input.value < 0 || !Number.isInteger(parseFloat(input.value))) {
                    input.value = 0;
                }
            });
        });
    }
});