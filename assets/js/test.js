function exportToJPG(divID, pdi, name, bloodtest_id, type) {
    // alert(divID)
    // alert(pdi)
    // alert(name)
    // alert(bloodtest_id)
    if (!formValidation()) {
        Swal.fire({
            icon: "error",
            title: "Oops..!",
            background: "#fff",
            text: "cant't submit blank test report!",
            showConfirmButton: true,
            customClass: {
                popup: 'swal2-dark'
            }

            // timer: 2000
        })
        return
    }
    const div = document.getElementById(divID);

    html2canvas(div).then(canvas => {
        const imageData = canvas.toDataURL('image/jpeg');

        const postData = 'image=' + encodeURIComponent(imageData) +
            '&pdi=' + encodeURIComponent(pdi) +
            '&name=' + encodeURIComponent(name) +
            '&bloodtestId=' + encodeURIComponent(bloodtest_id) +
            '&type=' + encodeURIComponent(type);

        fetch('save_image.php', {
                method: 'POST',
                headers: {
                    // 'Content-Type': 'application/json'
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                // body: 'image=' + encodeURIComponent(imageData)
                // body: JSON.stringify(postData)
                body: postData
            })
            .then(response => response.text())
            .then(data => {
                // alert(data);
                if (data == "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Complete!",
                        background: "#fff",
                        text: "blood test report sent successfully!",
                        showConfirmButton: true,
                        customClass: {
                            popup: 'swal2-dark'
                        }

                        // timer: 2000
                    }).then(() => {
                        // alert(data);
                        window.location.href = 'mlt.php?name=registered_mlt';
                        // location.reload();
                        // window.location = "index.php";
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
            .catch(error => {
                console.error('Error:', error);
            });
    });
}

function formValidation() {
    for (const input of Array.from(document.querySelectorAll('input'))) {
        if (input.value == "") return false;
    }
    return true
}