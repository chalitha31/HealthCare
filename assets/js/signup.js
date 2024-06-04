document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const fname = document.getElementById('firstName').value;
    const lname = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return;
    }

    const userDetails = {
        "firstName": fname,
        "lastName": lname,
        "email": email,
        "password": password
    };

    fetch("http://localhost/HealthCare/signUpProcess.php", {
        method: "POST",
        body: JSON.stringify(userDetails)
    })

    .then(
        response => {
            return response.text();

        }
    )

    .then(
        data => {
            // alert(data);
            if (data === "success") {
                Swal.fire({
                    icon: "success",
                    title: "Your work has been saved",
                    background: "#fff",
                    showConfirmButton: true,
                    customClass: {
                        popup: 'swal2-dark'
                    }

                    // timer: 2000
                }).then(() => {
                    window.location = "index.php";
                });


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
            // console.log(data);
        }
    )

    .catch(
        error => {
            console.log(error);
        }
    );

    // alert('Form submitted successfully!');
});