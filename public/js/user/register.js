let date = new Date();
let month = date.getMonth() + 1 < 10 ? `0${date.getMonth() + 1}` : date.getMonth() + 1;
let day = date.getDate() < 10 ? `0${date.getDate()}` : date.getDate();
let year = date.getFullYear();
let today = `${year}-${month}-${day}`;

const getAge = (birthdate, yearToday, monthToday, dateToday) => {
    let age = 0;
    let birthYear = parseInt(birthdate.split("-")[0]);
    let birthMonth = parseInt(birthdate.split("-")[1]);
    let birthday = parseInt(birthdate.split("-")[2]);
    age = yearToday - birthYear;
    if (birthYear % 4 == 0 && birthMonth == 2 && birthday == 29) {
        age = age / 4;
    }
    else {
        monthToday < birthMonth || monthToday == birthMonth && birthday > dateToday ? age-- : null;
    }
    return parseInt(age);
}

$(".userform").submit(() => {
    let firstname = $("#firstname").val();
    let middlename = $("#middlename").val();
    let lastname = $("#lastname").val();
    let birthdate = $("#birthdate").val();
    let password = $("#password").val();
    let confirmpassword = $("#password-confirm").val();

    firstname.length == 1 ? $(".error-text").text("Invalid Firstname") :
        middlename.length == 1 ? $(".error-text").text("Invalid Middlename") :
            lastname.length == 1 ? $(".error-text").text("Invalid Lastname") :
                today == birthdate || parseInt(birthdate.split("-")[0]) > 2004 ? $(".error-text").text("Required Age is 18yrs old above") :
                    password != confirmpassword ? $(".error-text").text("Password did not match") :
                        null;
});

$("input[name='phone_number']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
});

$("input[name='firstname']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^A-Z a-z]/g, ''));
});

$("input[name='middlename']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^A-Z a-z]/g, ''));
});

$("input[name='lastname']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^A-Z a-z]/g, ''));
});

$("input[name='birthplace']").on('input', function (e) {
    $(this).val($(this).val().replace(/[^A-Z a-z]/g, ''));
});

$("#birthdate").change(() => {
    $("#age").val(getAge($("#birthdate").val(), parseInt(year), parseInt(month), parseInt(day)));
});

$("#edit-birthdate").change(() => {
    $("#edit-age").val(getAge($("#edit-birthdate").val(), parseInt(year), parseInt(month), parseInt(day)));
});