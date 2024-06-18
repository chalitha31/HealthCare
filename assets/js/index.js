document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('loginForm');
    // const btn = document.getElementById('loginBtn');
    const span = document.getElementsByClassName('close')[0];

    // btn.onclick = function() {
    //     modal.style.display = 'block';
    // }


    span.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});

function loginbutton() {
    const modal = document.getElementById('loginForm');
    modal.style.display = 'block';
}

window.addEventListener('load', (e) => {
    if (localStorage.getItem('examined') == null || localStorage.getItem('examined') == 'true') {
        localStorage.setItem('examined', 'false');
        console.log(localStorage.getItem('examined'));
    }

})

function login() {

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const userDetails = {
        "email": email,
        "password": password
    };

    fetch("http://localhost/HealthCare/signInProcess.php", {
            method: "POST",
            body: JSON.stringify(userDetails)
        })
        .then(
            response => {
                return response.text();
            }
        )
        .then(data => {
            if (data === "user") {
                // console.log("Success");
                window.location = "index.php?name=" + data;
                // location.reload();
            } else if (data === "registered_doctor") {

                window.location = "doctor/doctor.php?name=" + data;

            } else if (data === "registered_mlt") {

                window.location = "mlt/mlt.php?name=" + data;
            } else if (data === "registered_pharmacists") {

                // window.location = "reception.php";

            } else if (data === "registered_reception") {

                window.location = "reception/reception.php?name=" + data;
            } else if (data === "admin") {

                window.location = "admin/admin.php";
            } else {
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
        .catch(error => {
            console.error('Error:', error);
        });

}