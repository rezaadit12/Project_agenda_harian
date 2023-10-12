<?php

session_start();

require 'Data/function.php';
$nama = $_SESSION['nama'];

if($nama !== "Admin"){
    header('Location: mainPage.php');
}

if(isset($_GET['all'])){
  $hasil = read("SELECT * FROM debug_backend");
  $title = "Semua Kegiatan";
}else if(isset($_GET['today'])){
  $title = $tanggal_formatted;
}else if(isset($_GET['tanggal'])){
    $bulan = [
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember'
  ];

  $tanggal_parts = explode('-', $_GET['tanggal']);
  $tanggal_formatted = $tanggal_parts[2] . ' ' . $bulan[(int)$tanggal_parts[1]] . ' ' . $tanggal_parts[0];
  
  $title = $tanggal_formatted;
}

//import koneksi ke database
?>
<html>

<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
    </script>
</head>

<body>
    <div class="container">
        <h2 class="mt-5"><?php echo $title ?></h2>
        <div class="data-tables datatable-dark">

            <!-- Masukkan table nya disini, dimulai dari tag TABLE -->
            <table class="table table-responsive  table-bordered" id="mauexport">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>

                        <th>Nama</th>

                        <th>Agenda</th>
                        <th>Rincian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($hasil as $dataUser): ?>
                    <tr>
                        <td>
                            <?= $i ?>
                        </td>
                        <td>
                            <?php echo $dataUser['tanggal'] ?>
                        </td>
                        <td>
                            <?php echo $dataUser['username']; ?>
                        </td>
                        <td>
                            <?php echo $dataUser['isi_agenda']; ?>
                        </td>
                        <td style="max-width:300">
                            <?php echo $dataUser['rincian']; ?>
                        </td>


                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
                <thead>
                    <tr>
                        <td colspan="5" style="color:white;">
                            <p></p>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#mauexport').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        });
    });
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</body>
</html>