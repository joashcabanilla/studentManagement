$(document).ready(function () {
    $('#announcementTable').DataTable();
});

$('#announcementModal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
    $("#title").val("");
    $("#title").removeClass("is-invalid");
    $("#content").val("");
    $("#content").removeClass("is-invalid");
});

$('#announcementEditModal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
});


//announcement ID in table
let announcementID = "";
$('#announcementTable').click((e) => {
    let id = e.target.id;
    if (id.split("_")[0] == "editbtn") {
        $("#announcementEditModal").modal("show");
        announcementID = id.split("_")[1];
        $.ajax({
            type: "GET",
            url: `announcement/edit/${announcementID}`,
            success: (response) => {
                editAnnouncement(response);
            }
        });
    }

    if (id.split("_")[0] == "deletebtn") {
        swal({
            title: "",
            text: `Are you sure you want to delete this  announcement?`,
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = `announcement/delete/${id.split("_")[1]}`;
                }
            });
    }
});

const editAnnouncement = (res) => {
    $("#editTitle").val(res.data.title);
    $("#editContent").val(res.data.content);
    $("#announcementEditForm").attr("action", `announcement/update/${res.data.id}`);
    let container = $(".updateAnnouncementImages-container");
    container.empty();

    if (res.images.length != 0) {
        res.images.forEach((data) => {
            let image = data.image;
            let img = $('<img/>');
            img.attr("id", `image-${data.id}`);
            img.attr("src", `/AnnouncementImages/${image}`);
            container.append(img);
            $("#announcementUploadImage-label").text("Update Images");
        });
    }
    else {
        container.append($('<p>Image Not Found</p>'));
        $("#announcementUploadImage-label").text("Upload Images");
    }
}