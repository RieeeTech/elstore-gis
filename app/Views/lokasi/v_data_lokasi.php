<div class="col-sm-12">
    <?php
    if (session()->getFlashdata('pesan')) {
        echo '<div class="alert-success">';
        echo session()->getFlashdata('pesan');
        echo '</div>';
    }
    ?>

    <table class="table table-bordered" id="datatablesSimple">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lokasi</th>
                <th>Alamat Lokasi</th>
                <th>Coordinate</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;

            foreach ($lokasi as $key => $value) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $value['nama_lokasi'] ?></td>
                <td><?= $value['alamat_lokasi'] ?></td>
                <td><?= $value['latitude'] ?>,<?= $value['longitude'] ?></td>
                <td><img src="<?= base_url('foto/' . $value['foto_lokasi']) ?>" width="200px"></td>
                <td>
                    <a class="btn btn-primary">Ubah</a>
                    <a class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>