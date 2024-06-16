function blockemployee(idnum, tname) {

    FormData = new FormData();
    FormData.append("idnum", idnum);
    FormData.append("tname", tname);

    fetch("http://localhost/HealthCare/admin/blockemployee.php", {
            method: "post",
            body: FormData
        })
        .then(response => response.text())
        .then(data => {
            if (data === "blocked") {

                Swal.fire({
                    icon: "success",
                    title: "Complete!",
                    // color: "#22252c",
                    background: "#fff",
                    // text: "Something went wrong!",echo "unblocked";
                    text: "Employee Blocked!",
                    customClass: {
                        popup: 'swal2-dark',
                    }
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: "success",
                    title: "Complete!",
                    // color: "#22252c",
                    background: "#fff",
                    // text: "Something went wrong!",
                    text: "Employee Unblocked!",
                    customClass: {
                        popup: 'swal2-dark',
                    }
                }).then(() => {
                    window.location.reload();
                });
            }
        })
        .catch(error => { console.error(error) });



}