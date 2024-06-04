document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('loginForm');
    const btn = document.getElementById('loginBtn');
    const span = document.getElementsByClassName('close')[0];

    btn.onclick = function() {
        modal.style.display = 'block';
    }

    span.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});

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
            if (data === "success") {
                console.log("Success");
                // window.location = "reception.php";
                location.reload();
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