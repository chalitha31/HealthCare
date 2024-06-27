<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Website</title>
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../admin/admin.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <header>
        <div class="logo">Healthcare</div>
        <div class="header-username">Admin</div>
        <!-- <button id="loginBtn">Login</button> -->
    </header>
    <div id="loading" class="loadingMain">
        <div class="loadingdiv">
            <div class="loading-content">
                <img src="../assets/images/AnimationSmall.gif" class="Loadinganimation" />

                <h4 class="loading-text">Please Wait...</h4>
            </div>
        </div>
    </div>
    <div class="main-container">
        <aside class="sidebar">
            <ul>
                <li><a href="#" class="tab" data-target="dashboard.php">Dashboard</a></li>
                <li><a href="#" class="tab" data-target="doctor.php">Doctors</a></li>
                <li><a href="#" class="tab" data-target="pharmacist.php">Pharmacists</a></li>
                <li><a href="#" class="tab" data-target="mlt.php">MLTs</a></li>
                <li><a href="#" class="tab" data-target="reception.php">Reception</a></li>
                <li><a style="background-color: #ff4848;" href="adminLogout.php" class="tabb">Log Out</a></li>
            </ul>
        </aside>

        <div class="content" id="content">



        </div>
    </div>

    <script>
        // document.getElementById('myForm').addEventListener('submit', function(e)
        function sendemail() {
            // e.preventDefault(); // Prevent the default form submission
            let loading = document.getElementById('loading');
            loading.style.display = 'block'; // Show loading gif

            var formData = {
                "nic": document.getElementById('nic').value,
                "email": document.getElementById('email').value,
                "source": document.getElementById('source').value
            };

            fetch('sendLoginDetails.php', {
                    method: 'POST',
                    body: JSON.stringify(formData)
                }).then(response => response.text())
                .then(data => {
                    loading.style.display = 'none'; // Hide loading gif

                    if (data === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Email Send Successful!",
                            background: "#fff",
                            showConfirmButton: true,
                            customClass: {
                                popup: 'swal2-dark'
                            }

                            // timer: 2000
                        }).then(() => {
                            window.location.reload();
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
                }).catch(error => {
                    loading.style.display = 'none'; // Hide loading gif
                    alert('An error occurred: ' + error);
                });
        }
        // );
    </script>
    <script src="admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>