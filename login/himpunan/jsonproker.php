        <?php
            include 'db.php';
            include 'session.php';
            $username = $_SESSION['username'];
            // Buat prepared statement untuk mengambil semua data dari tbBiodata
            $query = $db->prepare("SELECT * FROM proker, user where user.username=proker.oleh and user.keterangan='Himpunan' and user.username='$username'");
            // Jalankan perintah SQL
            $query->execute();
            // Ambil semua data dan masukkan ke variable $data
            $data = $query->fetchAll();
        ?> 

        <?php $no = 0;
            $table = array();
            $table['cols'] = array(
                array('label' => 'Program Kerja', 'type' => 'string'),
                // array('label' => 'Proker', 'type' => 'string'),
                array('label' => 'Persentase', 'type' => 'number')
            );
            foreach ($data as $value) {
            $no++;
        ?>
        <?php
            $id_proker = $value['id_proker'];
            $query = $db->prepare("SELECT SUM(persentase) as total from detail_proker where status='Telah Tercapai' and bukti NOT IN ('Belum Dikirim') and id_proker='$id_proker'");
            $query->execute();
            $data2 = $query->fetchAll();
        ?>
        <?php 
            foreach ($data2 as $value2) { ?> 
            <?php  
            
            $c = $value2['total']; 

            //membuat array
            $temp = array();
            //memasukkan data pertama yaitu nama kelasnya
            $temp[] = array('v' => (string)$value['nama_kegiatan']);
            
            //$temp[] = array('v' => (string)$value['oleh']);
            //memasukkan data kedua yaitu jumlah siswanya
            $temp[] = array('v' => (int)$c);
            //memasukkan data diatas ke dalam array $rows
            $rows[] = array('c' => $temp);

            //memasukkan array $rows dalam variabel $table
            $table['rows'] = $rows;
            //mengeluarkan data dengan json_encode. silahkan di echo kalau ingin menampilkan data nya
            $jsonTable = json_encode($table);

            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Content-type: application/json');
            // menampilkan data hasil query ke bentuk json

            echo $jsonTable;
            
            ?>

        <?php } ?>

        <?php
            $query = $db->prepare("SELECT SUM(persentase) as total from detail_proker where status='Telah Tercapai' and bukti NOT IN ('Belum Dikirim') and id_proker='$id_proker'");
            $query->execute();
            $data2 = $query->fetchAll();
            exit();
        ?>

        <?php 
            foreach ($data2 as $value2) {?> 
            <?php 
            $z = $value2['total'];   
        ?>
            <td>
            <?php if ($value['status_proker']=="Telah Disetujui" && $z<100){ ?>

            <?php }elseif($value['status_proker']=="Telah Disetujui" && $z=="100" && $value['status_lpj']=="Tidak Ada") { ?>

            <?php }elseif($value['status_proker']=="Telah Disetujui" && $z=="100" && $value['status_lpj']=="Menunggu") { ?>

            <?php }elseif($value['status_proker']=="Telah Disetujui" && $z=="100" && $value['status_lpj']=="Telah Ditolak") { ?>

            <?php }elseif($value['status_proker']=="Menunggu" || $z<100 && $value['status_lpj']=="Tidak Ada") { ?>

            <?php }else{ ?>
            <?php      
                } 
                } ?>
        <?php } ?>
                        
        <?php
            $username = $_SESSION['username'];
            $query = $db->prepare("SELECT file_pdf from birokrasi where jenis_birokrasi='Program Kerja'");
            $query->execute();
            $data4 = $query->fetchAll();
        ?>
        <?php foreach ($data4 as $value2) { ?>
        <?php } ?>

<script type="text/javascript">
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa            = split[0].length % 3,
        rupiah          = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
