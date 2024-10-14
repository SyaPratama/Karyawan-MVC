$("#sign-up").on("click", () => {
  $("#container").toggleClass("active");
});

$("#sign-in").on("click", () => {
  $("#container").toggleClass("active");
});

$(".show").on("click", () => {
  $(".password").attr("type", "text");
  $(".wrap-icon-form").toggleClass("on");
});

$(".hide").on("click", () => {
  $(".password").attr("type", "password");
  $(".wrap-icon-form").toggleClass("on");
});

$("#close").on("click", () => {
  $("#sidebar").toggleClass("active");
  $(".dashboard").toggleClass("flex-grow-1");
});

$("#open").on("click", () => {
  $("#sidebar").toggleClass("active");
  $(".dashboard").toggleClass("flex-grow-1");
});

setInterval(() => {
  if (
    $("#dropdownUser2").attr("aria-expanded") === "false" &&
    $("#dropdownUser2").hasClass("active")
  ) {
    $("#dropdownUser2").removeClass("active");
  }
}, 100);

$("#dropdownUser2").on("click", function () {
  $(this).toggleClass("active");
});

const idUser = [];

$(".update").each(function () {
  $(this).on("click", function () {
    const id = $(this).attr("value");
    $("#addKaryawan").show();
    const url = window.location.origin;
    $.ajax({
      url: `${url}/karyawanId`,
      type: "GET",
      data: { id: id },
      success: (response) => {
        const data = JSON.parse(response);
        $("#addKaryawan .modal-body form").attr("action", "/updateKaryawan");
        $("#addKaryawan .modal-body form").attr("id", "updateId");
        $("#addKaryawan .modal-header .modal-title").html("Update Karyawan");
        $("#addKaryawan .modal-footer .btn-primary").html("Update");
        $("#addKaryawan .modal-body form input[type='hidden']").remove();
        $("#addKaryawan .modal-body form").append(
          `<input type='hidden' name='id' value='${id}'>`
        );
        $("#addKaryawan .modal-body form input[name='nik']").attr(
          "value",
          data.nik
        );
        $("#addKaryawan .modal-body form input[name='nama']").attr(
          "value",
          data.nama
        );
        $("#addKaryawan .modal-body form textarea[name='alamat']").val(
          data.alamat
        );

        $("#updateId").on("submit", function (e) {
          e.preventDefault();
          const form = $(this);
          Swal.fire({
            title: "Apakah Anda Yakin Ingin Mengupdate Nya?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Update",
          }).then((result) => {
            if (result.isConfirmed) {
              form.off("submit");
              form.submit();
            }
          });
        });
      },
    });
  });
});

$("#btn-addKaryawan").on("click", function () {
  $("#addKaryawan").show();
  $("#addKaryawan .modal-body form").attr("action", "/addKaryawan");
  $("#addKaryawan .modal-body form ").removeAttr("id");
  $("#addKaryawan .modal-header .modal-title").html("Tambah Karyawan");
  $("#addKaryawan .modal-footer .btn-primary").html("Tambah");
  $("#addKaryawan .modal-body form input[type='hidden']").remove();
  $("#addKaryawan .modal-body form input[name='nik']").attr("value", "");
  $("#addKaryawan .modal-body form input[name='nama']").attr("value", "");
  $("#addKaryawan .modal-body form textarea[name='alamat']").val("");
});

$(".delete").each(function () {
  $(this).on("click", function (e) {
    const id = $(this).attr("value");
    const url = window.location.origin;
    e.preventDefault();
    Swal.fire({
      title: "Apakah Anda Yakin Ingin Menghapus Nya?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `${url}/deleteKaryawan`,
          type: "POST",
          data: { id: id },
          success: (response) => {
            const res = JSON.parse(response);
            if(res.status == 200)
            {
              Swal.fire({
                title:"Berhasil Menghapus Karyawan",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
              });
              setTimeout(()=>{
                window.location.reload();
              },1600)
            }else
            {
              Swal.fire({
                title:"Gagal Menghapus Karyawan",
                icon: "error",
                showConfirmButton: false,
                timer: 1500
              });
            }
          },
        });
      }
    });
  });
});
