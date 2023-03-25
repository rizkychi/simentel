/*
| ---------------------------------------|
|   Custom Alert (Require: Sweetalert2)  |
| ---------------------------------------|
*/

// Logout alert
$('#btn-logout').on('click', function(e) {
    e.preventDefault()
    const url = $(this).attr('href')
    Swal.fire({
        title: 'Yakin?',
        text: "Kamu akan logout dari aplikasi ini",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Logout!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url
        }
    })
})

// delete confirm alert
function deleteConfirm(e, el) {
    e.preventDefault();
    const url = $(el).data('url');
    const text = $(el).data('text');
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: text + ' ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#dc3545'
    }).then((confirm) => {
        if (confirm.value) {
            window.location.href = url;
        }
    });
}
