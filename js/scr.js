$(function() {

    let editor;

    ClassicEditor
        .create(document.querySelector('#kegiatan'),{
            ckfinder:
            {
                uploadUrl: '../fileUpload.php'
            }
        })
        .then(dataUser => {
            // console.log(dataUser);
            editor = dataUser;
        })
        .catch(error => {
            console.error(error); 
        });


    $('.tombolTambahData').on('click', function(){
        $('#formModalLabel').html('Buat Kegiatan');
        $('.modal-footer button[type=submit]').html('Buat Kegiatan');
        if (editor) {
            editor.setData('');
        }
        $('#judul').val('');
        $('#tanggal').val('');
        $('#id').val('');
        $('#name').val('');
        });


    $('.tampilModalUbah').on('click', function(){
        
        $('#formModalLabel').html('Ubah Data');
        $('.modal-footer button[type=submit]').html('Ubah Kegiatan');
        $('.modal-body form').attr('action', 'Data/update.php');

        const id = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/Project_agenda_harian/frontend/Data/ubah.php',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                    if (editor) {
                        editor.setData(data[0].rincian);
                    }
                    $('#judul').val(data[0].isi_agenda);
                    $('#tanggal').val(data[0].tanggal);
                    $('#id').val(data[0].id);
                    $('#name').val(data[0].username);
                    
                }
                
            });
            
    });

    $('.tampilModalUbahAdmin').on('click', function(){
        $('#formModalLabel').html('Ubah Data');
        $('.modal-footer button[type=submit]').html('Ubah Kegiatan');
        $('.modal-body form').attr('action', 'Data/update1.php');

        const id = $(this).data('id');


        $.ajax({
            url: 'http://localhost/Project_agenda_harian/frontend/Data/ubah.php',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#judul').val(data[0].isi_agenda);
                $('#kegiatan').val(data[0].rincian)
                $('#tanggal').val(data[0].tanggal);
                $('#id').val(data[0].id);
                $('#name').val(data[0].username);
            }
        });
    });

});