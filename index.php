<!DOCTYPE html>
<html>
    <head>
        <title>Pendaftaran Rute Penerbangan</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    </head>
</html>
<body>
<!-- Navbar dan Logo -->
<nav class="navbar navbar-light bg-dark">
  <a class="navbar-brand text-white" href="#">
    <img src="img/airplane.png" width="35" height="auto" class="d-inline-block align-top" alt="">
    AIRLINES REGISTRATION
  </a>
</nav>
  <!--Form untuk memasukkan data tiket yang dibeli-->
    <div class="container bg-light mt-5 py-2 rounded-lg border border-dark">
        <h3 class="text-center mt-3 mb-3">Pendaftaran Rute Penerbangan</h3>
            <table class="table table-borderless">
                <form action="index.php" method="post" id="formItem" >
                    <tr>
                        <!--Masukkan Nama Maskapai-->
                        <td><label for="maskapai">Maskapai </label></td>
                        <td><input class="form-control form-control-sm" required type="text" id="maskapai" name="maskapai" placeholder="Nama Maskapai"></td>
                    </tr>
                    <tr>
                        <!--Masukkan Bandara Asal-->
                        <td><label for="asalPenerbangan">Bandara Asal </label></td>
                        <td><select class="form-control" name="asalPenerbangan">
                                <option value="Soekarno-Hatta (CGK)">Soekarno-Hatta (CGK)</option>
                                <option value="Husein Sastranegara (BDO)">Husein Sastranegara (BDO)</option>
                                <option value="Abduh Rachman Saleh (MLG)">Abduh Rachman Saleh (MLG)</option>
                                <option value="Juanda (SUB)">Juanda (SUB)</option>
                            </select></td>
                    </tr>
                    <tr>
                        <!--Masukkan Bandara Tujuan-->
                        <td><label for="tujuanPenerbangan">Bandara Tujuan </label></td>
                        <td><select class="form-control" required name="tujuanPenerbangan">
                                <option value="Sultan Iskandarmuda (BTJ)">Sultan Iskandarmuda (BTJ)</option>
                                <option value="Ngurah Rai (DPS)">Ngurah Rai (DPS)</option>
                                <option value="Hasanuddin (UPG)">Hasanuddin (UPG)</option>
                                <option value="Inanwatan (INX)">Inanwatan (INX)</option>
                        </select></td>
                    </tr>
                    <tr>
                        <!--Harga Tiket-->
                        <td><label for="hargaTiket">Harga Tiket </label></td>
                        <td><input class="form-control" type="number" id="hargaTiket" name="hargaTiket" placeholder="Harga Tiket"></td>
                    </tr>
                    <tr>
                        <!--Tombol Kirim-->
                        <td></td>
                        <td><button type="submit" class="btn btn-secondary btn-lg btn-block" form="formItem" value="Kirim" name="Kirim">Kirim</button></td>
                        <td></td>
                    </tr>
                </form>
            </table>
    </div>
        <?php
            // Fungsi untuk menghitung Total Item
            // Total Item didapat dengan cara menjumlahkan harga tiket dan pajak
            // Variabel $a dan $b merupakan harga tiket dan pajak
            function totalItem($a, $b){
                $total = $a + $b;
                return $total;
            }

            $berkas = "data/data.json"; // Variabel berisi nama berkas di mana data dibaca dan ditulis
            $dataPenerbangan = array(); // Variabel array kosong untuk menampung data penerbangan dari berkas

            // Variabel data dari berkas dan mengkonversi data tersebut menjadi array PHP
            // Variabel $dataJson berisi data dari berkas dalam bentuk array Json
            // Variabel $dataPenerbangan berisi data pada $dataJson yang sudah dikonversi menjadi array PHP
            $dataJson = file_get_contents($berkas); 
            $dataPenerbangan = json_decode ($dataJson, true); 

            //echo "$dataJson"; //menampilkan isi data json
            //echo "<br><br>"; 
            //print_r($dataPenerbangan); //menampilkan isi dataPenerbangan yang sudah berupa array
            if(isset($_POST['Kirim'])){
                $item = array();// Variabel array kosong untuk menampung data nilai yang dimasukkan dari form


                $totPajak = 0;// variabel untuk menentukan jumlah pajak dari bandara asal dan bandara tujuan
				
				if($_POST['asalPenerbangan'] == 'Soekarno-Hatta (CGK)'){
                    $pajak = 50000;
                }else if($_POST['asalPenerbangan'] == 'Husein Sastranegara (BDO)'){
                    $pajak = 30000;
                }else if($_POST['asalPenerbangan'] == 'Abdul Rachman Saleh (MLG)'){
                    $pajak = 40000;
                }else if($_POST['asalPenerbangan'] == 'Juanda (SUB)'){
                    $pajak = 40000;
                }
				
				if($_POST['tujuanPenerbangan'] == 'Ngurah Rai (DPS)'){
                   $totPajak = $pajak + 80000;
                }else if($_POST['tujuanPenerbangan'] == 'Hasanuddin (UPG)'){
                   $totPajak = $pajak + 70000;
                }else if($_POST['tujuanPenerbangan'] == 'Inanwatan (INX)'){
                    $totPajak = $pajak + 90000;
                }else if($_POST['tujuanPenerbangan'] == 'Sultan Iskandarmuda (BTJ)'){
                    $totPajak = $pajak + 70000;
                }

                //Memasukkan data harga ke dalam array $item
                array_push($item,$_POST['hargaTiket']);

                //Memasukkan data penerbangan dari form ke dalam array $databaru
                $dataBaru = array(
                'maskapai' => $_POST['maskapai'],
                'asalPenerbangan' => $_POST['asalPenerbangan'],
                'tujuanPenerbangan' => $_POST['tujuanPenerbangan'],
                'hargaTiket' => $_POST['hargaTiket'],
                'pajak' => $totPajak,
                );

                print_r($dataBaru);

                array_push($dataPenerbangan,$dataBaru); //Menambahkan data baru ke dalam data yang sudah ada dalam berkas

                //Mengkonversi kembali data customer dari array PHP menjadi array Json dan menyimpannya ke dalam berkas
                $dataJson = json_encode($dataPenerbangan, JSON_PRETTY_PRINT);
                file_put_contents($berkas, $dataJson);

            }
        ?>
  <p><br></p>
    <!-- Tabel untuk menampilkan data Penerbangan. -->
    <table class="table table-striped table-dark">
        <h3 class="text-center text-white bg-dark py-2">Daftar Rute Tersedia</h3>
            <thead>
                <tr>
                <!-- Header tabel data Penerbangan. -->
                <th scope="col">Maskapai</th>
                <th scope="col">Asal Penerbangan</th>
                <th scope="col">Tujuan Penerbangan</th>
                <th scope="col">Harga Tiket</th>
                <th scope="col">Pajak</th>
                <th scope="col">Total Harga Tiket</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //	Perulangan untuk menampilkan data Penerbangan.
	                //	Variabel $i adalah index data siswa pada array $dataPenerbangan.
                    for ($i=0; $i < count($dataPenerbangan); $i++){
                    
                        //	Memindahkan data dari dalam array $dataPenerbangan ke variabel baru.
                        //	$maskapai adalah data nama maskapai.
                        //	$asalPenerbangan adalah data asal penerbangan maskapai.
                        //	$tujuanPenerbangan adalah data tujuan penerbangan maskapai.
                        //	$hargaTiket adalah data berisi harga tiket dalam bentuk array berisikan harga tiket masing-masing maskapai.
                        //  $pajak adalah data berisi pajak dari masing masing maskapai.
                        $maskapai = $dataPenerbangan[$i]['maskapai'];
                        $asalPenerbangan = $dataPenerbangan[$i]['asalPenerbangan'];
                        $tujuanPenerbangan = $dataPenerbangan[$i]['tujuanPenerbangan'];
                        $hargaTiket = $dataPenerbangan[$i]['hargaTiket'];
                        $pajak = $dataPenerbangan[$i]['pajak'];


                        //	Baris untuk menampilkan data penerbangan.
                        echo "<tr>
                                <td>".$maskapai."</td><!--Data nama maskapai-->
                                <td>".$asalPenerbangan."</td><!--Data bandara asal penerbangan-->
                                <td>".$tujuanPenerbangan."</td><!--Data bandara tujuan penerbangan-->
                                <td>".$hargaTiket."</td><!--Data harga tiket-->
                                <td>".$pajak."</td><!--Data pajak-->
                                <td>".totalItem($hargaTiket, $pajak)."</td><!--Data harga tiket dan pajak-->
                            </tr>";
                    }
                ?>
            </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>