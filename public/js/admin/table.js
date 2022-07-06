const updateStudent = () => {
    $("#studentEditModalLabel").text("Update Student Account");
    $("#studentEditModal").modal("show");
}

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
                    window.location.href = `student/delete/${id.split("-")[1]}`;
                    swal("", "User Information Successfully Deleted", "success");
                }
            });
    }

    if (id.split("-")[0] == "editbtn") {
        $.ajax({
            type: "GET",
            url: "student/edit/joash1",
            success: (response) => {
                console.log(response);
                updateStudent();
            }
        });
    }
});

$(".addStudentBtn").click(() => {
    $("#studentModalLabel").text("Create Student Account");
    $(".studentFormBtn").text("Register");
});

$('#studentModal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
})