document.addEventListener('DOMContentLoaded', function() {

    let editBtn = document.querySelector('.fa-pen-to-square');
    // let blockButn = document.getElementById('blockButton');
    let saveBtn = document.querySelector('.save-details');
    // let imageLable = document.querySelector('.image-lable');
    let profileInputs = Array.from(document.querySelectorAll('.profile-inputs'));

    editBtn.addEventListener('click', function() {
        profileInputs.forEach((input, index) => {

            if (index === 0 || index === 1 || index === 3) {

                input.disabled = false;
            }
        });
        // imageLable.style.display = 'block';
        saveBtn.style.display = 'block';
        editBtn.style.display = 'none';
        // blockButn.style.display = 'none';
    });

    saveBtn.addEventListener('click', function() {



        // const ima = document.getElementById('imageDisplay');
        // alert(exiteImage)

        const fname = document.getElementById('fname').value;
        const lname = document.getElementById('lname').value;

        const email = document.getElementById('email').value;

        const contact = document.getElementById('contact').value;



        if (fname == "") {
            alert("please enter your first name!");

        } else if (lname == "") {
            alert("please enter your last name!");

        } else if (email == "") {
            alert("please enter your email!");

        } else if (contact == "") {
            alert("please enter your contact number!");

        } else {

            // const employee = {

            //     "name": name,
            //     "nic": nic,
            //     "age": age,
            //     "email": email,
            //     "address": address,
            //     "mobile": contact,
            //     "pimage": imageDisplay,
            // }

            const formData = new FormData();
            formData.append("fname", fname);
            formData.append("lname", lname);

            formData.append("email", email);

            formData.append("mobile", contact);




            fetch("http://localhost/HealthCare/userProfileProcess.php", {

                method: "POST",
                body: formData,

            })

            .then(response => {
                    return response.text();
                })
                .then(data => {
                    // alert(data);
                    // location.reload();
                    Swal.fire({
                        icon: "success",
                        title: "Profile updated successfully",
                        background: "#fff",
                        text: "Your profile has been updated.",
                        customClass: {
                            popup: 'swal2-dark'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {


                            if (data === "success") {

                                location.reload();
                            }
                        }
                    });
                })
                .catch(err => {
                    console.log(err);

                });


            profileInputs.forEach(input => input.disabled = true);

            saveBtn.style.display = 'none';
            editBtn.style.display = 'block';
            // blockButn.style.display = 'block';


        }



    });



});

function changePassword(tablen) {

    const currentPassword = document.getElementById("currentPassword").value;
    const newPassword = document.getElementById("newPassword").value;
    const confirmnewPassword = document.getElementById("confirmnewPassword").value;

    const formD = {

        "currentPassword": currentPassword,
        "newPassword": newPassword,
        "confirmnewPassword": confirmnewPassword,
        "table": tablen,
    }

    fetch("http://localhost/HealthCare/changePassword.php", {
        method: "POST",
        body: JSON.stringify(formD),
    })

    .then(responce => {
            return responce.text();
        })
        .then(data => {
            if (data === "success") {
                Swal.fire({
                    icon: "success",
                    title: "Complete!",
                    // color: "#22252c",
                    background: "#fff",
                    // text: "Something went wrong!",
                    text: "Password Change Successful!",
                    customClass: {
                        popup: 'swal2-dark'
                    }

                    // footer: '<a href="#">Why do I have this issue?</a>'
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
        })
        .catch(err => {
            console.error(err);
        });

}




function showPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex';
}

function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
}