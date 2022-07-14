let student_username = "";
let email = "";

$(document).ready(function () {
    $('.userTable').DataTable();
});

$(".userTable").click((e) => {
    let id = e.target.id;
    if (id.split("_")[0] == "deletebtn") {
        swal({
            title: "",
            text: `Are you sure you want to delete this student information?`,
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = `student/delete/${id.split("_")[1]}`;
                    swal("", "User Information Successfully Deleted", "success");
                }
            });
    }

    if (id.split("_")[0] == "editbtn") {
        student_username = id.split("_")[1];
        $.ajax({
            type: "GET",
            url: `student/edit/${student_username}`,
            success: (response) => {
                email = response.student[0].email;
                updateStudent(response);
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
});

$('#studentEditModal').on('hidden.bs.modal', function () {
    removeErrormsg();
});

$("#studentUpdateBtn").click((e) => {
    e.preventDefault();
    let data = {
        'firstname': $("#edit-firstname").val(),
        'middlename': $("#edit-middlename").val(),
        'lastname': $("#edit-lastname").val(),
        'gender': $("#edit-gender").val(),
        'birthdate': $("#edit-birthdate").val(),
        'age': $("#edit-age").val(),
        'birthplace': $("#edit-birthplace").val(),
        'phone_number': $("#edit-phone_number").val(),
        'address': $("#edit-address").val(),
        'email': $("#edit-email").val(),
        'username': $("#edit-username").val(),
        'password': $("#edit-password").val(),
        'password_confirmation': $("#edit-password-confirm").val()
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "PUT",
        url: `student/update/${student_username}/${email}`,
        data: data,
        dataType: "json",
        success: (response) => {
            if (response.status == 400) {
                let errors = response.errors;
                console.log(response.errors);
                errors.firstname != undefined ? $("#edit-firstname").addClass("is-invalid") : $("#edit-firstname").removeClass("is-invalid");
                errors.firstname != undefined ? $("#studentUpdate-error-firstname").text(errors.firstname[0]) : null;

                errors.middlename != undefined ? $("#edit-middlename").addClass("is-invalid") : $("#edit-middlename").removeClass("is-invalid");
                errors.middlename != undefined ? $("#studentUpdate-error-middlename").text(errors.middlename[0]) : null;

                errors.lastname != undefined ? $("#edit-lastname").addClass("is-invalid") : $("#edit-lastname").removeClass("is-invalid");
                errors.lastname != undefined ? $("#studentUpdate-error-lastname").text(errors.lastname[0]) : null;

                errors.gender != undefined ? $("#edit-gender").addClass("is-invalid") : $("#edit-gender").removeClass("is-invalid");
                errors.gender != undefined ? $("#studentUpdate-error-gender").text(errors.gender[0]) : null;

                errors.birthdate != undefined ? $("#edit-birthdate").addClass("is-invalid") : $("#edit-birthdate").removeClass("is-invalid");
                errors.birthdate != undefined ? $("#studentUpdate-error-birthdate").text(errors.birthdate[0]) : null;

                errors.age != undefined ? $("#edit-age").addClass("is-invalid") : $("#edit-age").removeClass("is-invalid");
                errors.age != undefined ? $("#studentUpdate-error-age").text(errors.age[0]) : null;

                errors.birthplace != undefined ? $("#edit-birthplace").addClass("is-invalid") : $("#edit-birthplace").removeClass("is-invalid");
                errors.birthplace != undefined ? $("#studentUpdate-error-birthplace").text(errors.birthplace[0]) : null;

                errors.phone_number != undefined ? $("#edit-phone_number").addClass("is-invalid") : $("#edit-phone_number").removeClass("is-invalid");
                errors.phone_number != undefined ? $("#studentUpdate-error-phone_number").text(errors.phone_number[0]) : null;

                errors.address != undefined ? $("#edit-address").addClass("is-invalid") : $("#edit-address").removeClass("is-invalid");
                errors.address != undefined ? $("#studentUpdate-error-address").text(errors.address[0]) : null;

                errors.email != undefined ? $("#edit-email").addClass("is-invalid") : $("#edit-email").removeClass("is-invalid");
                errors.email != undefined ? $("#studentUpdate-error-email").text(errors.email[0]) : null;

                errors.username != undefined ? $("#edit-username").addClass("is-invalid") : $("#edit-username").removeClass("is-invalid");
                errors.username != undefined ? $("#studentUpdate-error-username").text(errors.username[0]) : null;

                errors.password != undefined ? $("#edit-password").addClass("is-invalid") : $("#edit-password").removeClass("is-invalid");
                errors.password != undefined ? $("#studentUpdate-error-password").text(errors.password[0]) : null;
            }
            else {
                $("#studentEditModal").modal("hide");
                swal("Saved", "Student Account Successfully Updated", "success").then(() => {
                    document.location.reload();
                });
                removeErrormsg();
            }
        }
    });
});

const removeErrormsg = () => {
    $("#edit-firstname").removeClass("is-invalid");
    $("#edit-middlename").removeClass("is-invalid");
    $("#edit-lastname").removeClass("is-invalid");
    $("#edit-gender").removeClass("is-invalid");
    $("#edit-birthdate").removeClass("is-invalid");
    $("#edit-age").removeClass("is-invalid");
    $("#edit-birthplace").removeClass("is-invalid");
    $("#edit-phone_number").removeClass("is-invalid");
    $("#edit-address").removeClass("is-invalid");
    $("#edit-email").removeClass("is-invalid");
    $("#edit-username").removeClass("is-invalid");
    $("#edit-password").removeClass("is-invalid");

}

const updateStudent = (res) => {
    let student = res.student[0];
    $("#studentEditModalLabel").text("Update Student Account");
    $("#studentEditModal").modal("show");
    $("#edit-studentnumber").val(student.studentNumber);
    $("#edit-firstname").val(student.firstname);
    $("#edit-middlename").val(student.middlename);
    $("#edit-lastname").val(student.lastname);
    $("#edit-gender").val(student.gender);
    $("#edit-birthdate").val(student.birthdate);
    $("#edit-age").val(student.age);
    $("#edit-birthplace").val(student.birthplace);
    $("#edit-phone_number").val(student.phone_number);
    $("#edit-address").val(student.address);
    $("#edit-email").val(student.email);
    $("#edit-username").val(student.username);
}

//set the value of fullname
$("#firstname").change(() => {
    $("#fullname").val(`${$("#lastname").val()}, ${$("#firstname").val()} ${$("#middlename").val()}`);
});

$("#middlename").change(() => {
    $("#fullname").val(`${$("#lastname").val()}, ${$("#firstname").val()} ${$("#middlename").val()}`);
});

$("#lastname").change(() => {
    $("#fullname").val(`${$("#lastname").val()}, ${$("#firstname").val()} ${$("#middlename").val()}`);
});

//set the value of fullname for update student account
$("#edit-firstname").change(() => {
    $("#edit-fullname").val(`${$("#edit-lastname").val()}, ${$("#edit-firstname").val()} ${$("##edit-middlename").val()}`);
    console.log($("#edit-fullname").val());
});

$("#edit-middlename").change(() => {
    $("#edit-fullname").val(`${$("#edit-lastname").val()}, ${$("#edit-firstname").val()} ${$("#edit-middlename").val()}`);
    console.log($("#edit-fullname").val());
});

$("#edit-lastname").change(() => {
    $("#edit-fullname").val(`${$("#edit-lastname").val()}, ${$("#edit-firstname").val()} ${$("#edit-middlename").val()}`);
    console.log($("#edit-fullname").val());
});