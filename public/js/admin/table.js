$(document).ready(function () {
    $('.userTable').DataTable();
});

$(".userTable").click((e) => {
    let id = e.target.id;
    if (id.split("-")[0] == "deletebtn") {
        swal({
            title: "",
            text: `Are you sure you want to delete this user information?`,
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = `delete/${id.split("-")[1]}`;
                    swal("", "User Information Successfully Deleted", "success");
                }
            });
    }
});