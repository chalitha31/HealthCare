document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const fname = document.getElementById('firstName').value;
    const lname = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const contact = document.getElementById('contact').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    if (password.length <= 5) {
        // alert('password must be at least 5 characters!');
        Swal.fire({
            icon: "error",
            title: "Oops...",
            // color: "#22252c",
            background: "#fff",
            // text: "Something went wrong!",
            text: "password must be at least 5 characters!",
            customClass: {
                popup: 'swal2-dark',
            }
        });

        return;
    } else if (password !== confirmPassword) {

        Swal.fire({
            icon: "error",
            title: "Oops...",
            // color: "#22252c",
            background: "#fff",
            // text: "Something went wrong!",
            text: "Passwords do not match!",
            customClass: {
                popup: 'swal2-dark',
            }
        });

        return;
    }

    const userDetails = {
        "firstName": fname,
        "lastName": lname,
        "email": email,
        "contact": contact,
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