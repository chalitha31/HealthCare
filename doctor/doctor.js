const root = document.documentElement;

function getCustomPropertyValue(propertyName) {
    return getComputedStyle(root).getPropertyValue(propertyName).trim();
}

let basecolor = getCustomPropertyValue('--base-color');
let mediumgrey = getCustomPropertyValue('--medium-gray');

// document.addEventListener('DOMContentLoaded', function() {
//     const tabs = document.querySelectorAll('.tab');
//     const content = document.getElementById('content');

//     tabs.forEach(tab => {
//         tab.addEventListener('click', function(e) {
//             tabs.forEach(colorTab => {
//                 colorTab.style.backgroundColor = mediumgrey;
//             })
//             e.preventDefault();
//             const target = this.getAttribute('data-target');
//             console.log(target)
//             fetch(target)
//                 .then(response => response.text())
//                 .then(data => {
//                     content.innerHTML = data;
//                     tab.style.backgroundColor = basecolor;
//                 })
//                 .catch(error => {
//                     console.error('Error loading content:', error);
//                 });
//         });
//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const content = document.getElementById('content');

    function loadTabContent(tab) {
        const target = tab.getAttribute('data-target');
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
            e.preventDefault();
            loadTabContent(tab);
        });
    });

    let examinedStatus = localStorage.getItem('examined');
    if (examinedStatus == 'true') {
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


function examinePatient(pid) {
    window.location.href = 'examine.php?pid=' + pid;
}