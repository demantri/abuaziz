
const flashData = $('.flash-data').data('flashdata');
// console.log(flashData);

if (flashData) {
    Swal.fire(
        'Sukses...',
        'Berhasil ' + flashData,
        'success'
      );
}

// btn hapus 
$('.tombol-hapus').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    // alert(href);

    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Data yang sudah dihapus, tidak dapat dikembalikan..",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});
