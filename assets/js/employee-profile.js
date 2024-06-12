document.addEventListener('DOMContentLoaded', function() {

    let editBtn = document.querySelector('.fa-pen-to-square');
    // let blockButn = document.getElementById('blockButton');
    let saveBtn = document.querySelector('.save-details');
    let imageLable = document.querySelector('.image-lable');
    let profileInputs = Array.from(document.querySelectorAll('.profile-inputs'));

    editBtn.addEventListener('click', function() {
        profileInputs.forEach((input, index) => {

            if (index === 0 || index === 3 || index === 4 || index === 5) {

                input.disabled = false;
            }
        });
        imageLable.style.display = 'block';
        saveBtn.style.display = 'block';
        editBtn.style.display = 'none';
        // blockButn.style.display = 'none';
    });

    saveBtn.addEventListener('click', function() {



        // const ima = document.getElementById('imageDisplay');
        // alert(exiteImage)
        const imageDisplay = document.getElementById('imageInput').files[0];
        const name = document.getElementById('name').value;
        const nic = document.getElementById('nic').value;
        const age = document.getElementById('age').value;
        const email = document.getElementById('email').value;
        const address = document.getElementById('address').value;
        const contact = document.getElementById('contact').value;
        const Tname = document.getElementById('Tname').value;


        // if (imageDisplay == null) {
        //     alert("please select an image!");

        // } else 
        if (name == "") {
            alert("please enter your name!");
            alert(imageDisplay);
        } else if (nic == "") {
            alert("please enter your nic!");

        } else if (age == "") {
            alert("please enter your age!");

        } else if (email == "") {
            alert("please enter your email!");

        } else if (address == "") {
            alert("please enter your address!");

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
            formData.append("name", name);
            formData.append("nic", nic);
            formData.append("age", age);
            formData.append("email", email);
            formData.append("address", address);
            formData.append("mobile", contact);
            formData.append("Tname", Tname);
            formData.append("pimage", imageDisplay);



            fetch("http://localhost/HealthCare/employeeProfileProcess.php", {

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
                            // Redirect to index page
                            // window.location.href = "reception/reception.php?name=" + data;

                            if (data === "user") {
                                // console.log("Success");
                                // window.location = "reception.php";
                                location.reload();
                            } else if (data === "registered_doctor") {

                                window.location = "doctor/doctor.php?name=" + data;

                            } else if (data === "registered_mlt") {

                                // window.location = "reception.php";
                            } else if (data === "registered_pharmacists") {

                                // window.location = "reception.php";

                            } else if (data === "registered_reception") {

                                window.location = "reception/reception.php?name=" + data;
                            } else if (data === "admin") {

                                window.location = "admin/admin.php";
                            }

                        }
                    });
                })
                .catch(err => {
                    console.log(err);

                });


            profileInputs.forEach(input => input.disabled = true);
            imageLable.style.display = 'none';
            saveBtn.style.display = 'none';
            editBtn.style.display = 'block';
            // blockButn.style.display = 'block';


        }



    });





    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const imageDisplay = document.getElementById('imageDisplay');
    const imagePlaceholder = document.getElementById('imagePlaceholder');



    imageInput.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                imageDisplay.setAttribute('src', this.result);
                imageDisplay.style.display = 'block';
                imagePlaceholder.style.display = 'none';
            });

            reader.readAsDataURL(file);
        } else {
            imageDisplay.setAttribute('src', '');
            imageDisplay.style.display = 'none';
            imagePlaceholder.style.display = 'block';
        }
    });






    // const changePasswordForm = document.getElementById('changePasswordForm');
    // const confirmationPopup = document.getElementById('confirmationPopup');
    // const proceedBtn = document.getElementById('proceedBtn');

    // changePasswordForm.addEventListener('submit', function(event) {
    //     event.preventDefault();
    //     showPopup('confirmationPopup');
    // });

    // proceedBtn.addEventListener('click', function() {
    //     closePopup('confirmationPopup');
    //     // Here you can add the logic to change the password
    //     alert('Password changed successfully!');
    //     let inputs = Array.from(changePasswordForm.querySelectorAll('input'))
    //     inputs.forEach(input => {
    //         input.value = '';
    //     });
    // });







    // const blockBtn = document.getElementById('blockBtn');
    // const unblockBtn = document.getElementById('unblockBtn');
    // const confirmationMessage = document.getElementById('confirmationMessage');
    // const proceedBtnBlock = document.getElementById('proceedBtnBlock');

    // let action = '';

    // blockBtn.addEventListener('click', function() {
    //     action = 'block';
    //     confirmationMessage.textContent = 'Are you sure you want to block this employee?';
    //     showPopup('confirmationBlockPopup');
    // });

    // unblockBtn.addEventListener('click', function() {
    //     action = 'unblock';
    //     confirmationMessage.textContent = 'Are you sure you want to unblock this employee?';
    //     showPopup('confirmationBlockPopup');
    // });

    // proceedBtnBlock.addEventListener('click', function() {
    //     if (action === 'block') {
    //         blockBtn.disabled = true;
    //         unblockBtn.disabled = false;
    //     } else if (action === 'unblock') {
    //         blockBtn.disabled = false;
    //         unblockBtn.disabled = true;
    //     }
    //     closePopup('confirmationBlockPopup');
    //     alert(`Employee has been ${action}ed successfully!`);
    // });









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