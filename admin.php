<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/admin.css">
    <title>Admin</title>
</head>
<style>
    header {
    width: 102%;
    background-color: #749BC2;
    margin-top: -2rem;
    height: 78px;
    margin-left: -8px;
}

a {
    font-family: none;
    text-decoration: none;
    color: black;
}
</style>
<body>
    <form action="prosesregis.php" method="post">
    <header>
        <div class="slide">
        <img class="user" src="../img/userr.png" alt="img" width="30" height="30">
        <img class= "home" src="../img/home.png" alt="img" width="30" height="30">
            <h2>Selamat Datang Admin!</h2>
    </header>
    <div class="tambah">
        <img class="plus"src="../img/plus.png" alt="img" width="15" height="15">
        <a href="admin.php">Tambah Data</a>
        </div>
        <div class="search">
        <input type="text" placeholder="Search..">
        <input type="submit" name="submit" >
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Agenda</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Wanda Halimatu</td>
                <td>Agenda 1</td>
                <td>2023-09-18</td>
                <td><button>Edit</button><button>Hapus</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jihan febrianti</td>
                <td>Agenda 2</td>
                <td>2023-09-19</td>
                <td>
                <a href="edit.php">Edit</a>
                <a href="hapus.php"> | Hapus</a>
            </td>
            </tr>
        </tbody>
    </table>

    </form>
</body>
</html>