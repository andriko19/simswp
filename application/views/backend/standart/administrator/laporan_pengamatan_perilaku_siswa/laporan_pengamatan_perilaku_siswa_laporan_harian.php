<!DOCTYPE html>
<html> 
<body>

  <div style="margin-right: 500px">
    <div style="width:1083px;">
      <b style="font-size: 20px"> Laporan Harian Pengamatan Prilaku siswa </b> <br>
      <p style="margin-top: 2px; margin-right: 2px; font-style: italic;">Periode : <?=$periode;?> || Dari Tanggal : <?=$tanggal_awal;?> || Sampai Tanggal : <?=$tanggal_akhir;?></p>
      
      <hr>
    </div>

    <table border="1px solid black" style="border-collapse: collapse; width: 100%;">
      <thead>
        <tr style="text-align:center; font-size: 14px">
           <th>No.</th>
           <th>Tanggal</th>
           <th>Jam</th>
           <th style="width: 76px;">Minggu Ke-</th>
           <th style="width: 55px;">Sekolah</th>
           <th>Siswa</th>
           <th>Prilaku</th>
           <th style="width: 73px;">Status</th>
           <th style="width: 90px;">Lokasi</th>
           <th>Pengamat</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1;
        foreach($harians as $harian): ?>
          <tr style="font-size: 12px">
            <td> <?= $no++;?> </td>
            <td> <?= _ent($harian->tanggal);?> </td>
            <td> <?= date("H:i:s", strtotime(_ent($harian->jam)));?> </td>
            <td> <?= _ent($harian->minggu_ke);?> </td>
            <td> <?= _ent($harian->kode_sekolah);?> </td>
            <td> <div style="width:185px;"><?= _ent($harian->nama);?></div> </td>
            <td> <div style="width:290px;"><?= _ent($harian->isi_amatan);?></div> </td>
            <td> <div style="width:73px;"><?= _ent($harian->nama_status_amatan);?></div> </td>
            <td> <div style="width:90px;"><?= _ent($harian->nama_lokasi);?></div> </td>
            <td> <div style="width:155px;"><?= _ent($harian->nama_pengamat);?></div> </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <br><br><br>
    <table style="border-collapse: collapse; width: 100%;">
      <tr>
        <th>
          <div style="width: 300px;">
            <br><br>
            Wali Kelas ()
            <br><br><br><br><br><br>
            <b style="text-decoration: underline;"><?=$wali_kelas;?></b>
          </div>
      </th>
      <th><div style="width: 500px;"></div></th>
      <th>
        <div style="width: 300px;">
          Surabaya, <?=date('d-m-Y')?><br>
          Pusat Pendidikan Budi Pekerti<br><br><br><br><br><br><br>
          <b style="text-decoration: underline;"><?=$ppbp;?></b>
        </div>
      </th>
    </tr>
    </table>
  </div>
</body>
</html>