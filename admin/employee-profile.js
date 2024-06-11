document.addEventListener('DOMContentLoaded', function() {

    let editBtn = document.querySelector('.fa-pen-to-square');
    let blockButn = document.getElementById('blockButton');
    let saveBtn = document.querySelector('.save-details');
    let imageLable = document.querySelector('.image-lable');
    let profileInputs = Array.from(document.querySelectorAll('.profile-inputs'));

    editBtn.addEventListener('click', function() {
        profileInputs.forEach(input => input.disabled = false);
        imageLable.style.display = 'block';
        saveBtn.style.display = 'block';
        editBtn.style.display = 'none';
        blockButn.style.display = 'none';
    });

    saveBtn.addEventListener('click', function() {
        profileInputs.forEach(input => input.disabled = true);
        imageLable.style.display = 'none';
        saveBtn.style.display = 'none';
        editBtn.style.display = 'block';
        blockButn.style.display = 'block';
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

function showPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex';
}

function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
}