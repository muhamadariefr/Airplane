[![](img/airplane.png) AIRLINES REGISTRATION](#)


### Pendaftaran Rute Penerbangan

 <br>
";
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

<br>

<table>
    <h3>Daftar Rute Tersedia</h3>
        <thead>
            <tr>
            <!-- Header tabel data Penerbangan. -->
            <th>Maskapai</th>
            <th>Asal Penerbangan</th>
            <th>Tujuan Penerbangan</th>
            <th>Harga Tiket</th>
            <th>Pajak</th>
            <th>Total Harga Tiket</th>
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
                            <td>&quot;.$maskapai.&quot;</td><!--Data nama maskapai-->
                            <td>&quot;.$asalPenerbangan.&quot;</td><!--Data bandara asal penerbangan-->
                            <td>&quot;.$tujuanPenerbangan.&quot;</td><!--Data bandara tujuan penerbangan-->
                            <td>&quot;.$hargaTiket.&quot;</td><!--Data harga tiket-->
                            <td>&quot;.$pajak.&quot;</td><!--Data pajak-->
                            <td>&quot;.totalItem($hargaTiket, $pajak).&quot;</td><!--Data harga tiket dan pajak-->
                        &quot;;
                }
            ?&gt;
        </tbody>
</table>
