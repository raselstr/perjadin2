<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    @page {
      /* size: 22; */
      margin-top: 1.5cm;
      /* margin-left: 2cm;
      margin-right: 2cm; */
      margin-bottom: 1.5cm;
    }

      #header, #footer {
      position: fixed;
      left: 0;
      right: 0;
      color: #aaa;
      font-size: 0.9em;
    }
    #footer {
        bottom: 0;
    }
    .page-number {
      text-align: right;
    }

    .page-number:before {
      content: "hal : " counter(page);
    }

    .page-break {
      page-break-before: auto;
      page-break-after: auto;
      page-break-inside: avoid;
      /* border: 0; */
    }
    .card {
      /* border: 1px solid black; */
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      /* width: 816px;
      height: 1096px; */
      border-radius: 5px;
      padding: 37px;
    }
    

    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    img {
      border-radius: 5px 5px 0 0;
      width: 100%;
      height: 100px;
      padding-bottom: 10px

    }

    .cardttd{
       /* border: 1px solid black; */
      /* box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); */
      /* transition: 0.3s; */
      /* width: 100%; */
      /* height: 1096px; */
      /* border-radius: 5px; */
      padding: 37px;
      /* float: inline-end; */
    }

    .container {
      padding: 2px 20px;

    }
    
    #surat{
      /* border: 1px solid black; */
      font-family: Arial, Helvetica, sans-serif;
      /* width: 100%; */
      /* height: auto; */
      text-align: center;
      font-size: small;
      padding: 0px 10px;
    }
    td {
      /* border: 1px solid black; */
    }
    #judulsurat {
      text-align: center;
      font-weight: bold;
      font-size: large;
      text-decoration: underline;
    }
    #isinomor {
      text-align: center;
      font-size: medium;
      padding-bottom: 10px;
      
    }
    #isisurat {
      text-align: justify;
      vertical-align: top;
      padding-bottom: 5px;
      padding-top: 5px;
      
    }
    #isisuratpej {
      text-align: justify;
      vertical-align: top;
      /* padding-bottom: 0px; */
    }
    #isisuratno {
      text-align: right;
      vertical-align: top;
    }
    #isiberita {
      text-align: justify;
      vertical-align: top;
      padding-bottom: 10px;
    }
    #isipenutup {
      text-align: justify;
      vertical-align: top;
      padding-bottom: 10px;
    }
    #ttd{
      text-align: justify;
      /* padding-top: 20px; */
      padding-bottom: 0px;
    }
    #ttdan {
      text-align: right;
      vertical-align: top;
    }
    #right{
      text-align: justify;
    }
    
    
    
  </style>
</head>
<body>
  <!-- <div class="card"> -->
    <div id="footer">
      <div class="page-number"></div>
    </div>
        
    <div class="container">
      <img src="<?= $imageSrc ?>">
      <table id="surat">
        <tr>
          <td colspan="11" id="judulsurat" >SURAT TUGAS</td>
        </tr>
        <tr>
          <td colspan="11" id='isinomor'>
            Nomor : 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;
          </td>
        </tr>
        <?php 
        $dasar = $kaban[0]->spt_dasar;
        if ($dasar) : ?>
        <tr>
          <td colspan="2" id="isisurat">Dasar</td>
          <td id="isisurat" width="4%">:</td>
          <td colspan="8" id="isisurat"><?= $kaban[0]->spt_dasar ?></td>
        </tr>
        <?php endif ?>
        <tr>
          <td colspan="11" id="isisurat">Yang bertandatangan di bawah ini :</td>
          
          
        </tr>
        <tr>
          <td id="isisuratno"></td>
          <td id="isisuratpej" width="4%"></td> 
          <td id="isisuratpej"></td> 
          <td colspan="2" id="isisuratpej">Nama</td>
          <td width="3%">:</td>
          <td colspan="5" id="isisuratpej">Drs. JOHN HARDI NASUTION, M.Si</td>
        </tr>
        <tr>
          <td id="isisuratno"></td>
          <td id="isisuratpej"></td>
          <td id="isisuratpej"></td>
          <td colspan="2" id="isisuratpej">NIP</td>
          <td >:</td>
          <td colspan="5" id="isisuratpej">19670502 199002 1 002</td>
        </tr>
        <tr>
          <td id="isisuratno"></td>
          <td id="isisuratpej"></td>
          <td id="isisuratpej"></td>
          <td colspan="2" id="isisuratpej">Pangkat/ Golongan</td>
          <td >:</td>
          <td colspan="5" id="isisuratpej">PEMBINA UTAMA MUDA</td>
        </tr>
        <tr>
          <td id="isisuratno"></td>
          <td id="isisuratpej"></td>
          <td id="isisuratpej"></td>
          <td colspan="2" id="isisuratpej">Jabatan</td>
          <td >:</td>
          <td colspan="5" id="isisuratpej">SEKRETARIS DAERAH</td>
        </tr>
        <tr><td></td></tr>
        <tr>
          <td colspan="11" id="isisurat"><strong><center>MEMERINTAHKAN</center></strong></td>
        </tr>
        <tr>
          <td colspan="11" id="isisurat">Kepada :</td>
        </tr>
        <?php 
        
        ?>
        <tr class="page-break">
          <td id="isisuratno"></td>
          <td id="isisuratno"></td>
          <td id="isisuratpej" width="5%"></td>
          <td colspan="2" id="isisuratpej" >Nama</td>
          <td >:</td>
          <td colspan="5" id="isisuratpej" ><?= $kaban[0]->pegawai_nama; ?></td>
        </tr>
        <tr class="page-break">
          <td id="isisuratno"></td>
          <td id="isisuratpej"></td>
          <td id="isisuratpej"></td>
          <td colspan="2" id="isisuratpej">NIP</td>
          <td >:</td>
          <td colspan="5" id="isisuratpej"><?= $kaban[0]->pegawai_nip; ?></td>
        </tr>
        <tr class="page-break">
          <td id="isisuratno"></td>
          <td id="isisuratpej"></td>
          <td id="isisuratpej"></td>
          <td colspan="2" id="isisuratpej">Pangkat/ Golongan</td>
          <td >:</td>
          <td colspan="5" id="isisuratpej"><?= $kaban[0]->pangkat_nama; ?>(<?= $kaban[0]->pangkat_gol; ?>)</td>
        </tr>
        <tr class="page-break">
          <td id="isisuratno"></td>
          <td id="isisuratpej"></td>
          <td id="isisuratpej"></td>
          <td colspan="2" id="isisuratpej">Jabatan</td>
          <td >:</td>
          <td colspan="5" id="isisuratpej"><?= $kaban[0]->pegawai_jabatan; ?></td>
        </tr>
       
        <tr class = "page-break">
          <td colspan="11" id="isisurat">Untuk :</td>
        </tr>
        <tr>
          <td id="isiberita" width="5%">1.</td>
          <td colspan="10" id="isiberita"><?= $kaban[0]->spt_uraian; ?> ke <?= $kaban[0]->spt_tempat; ?>, <?= $kaban[0]->lokasiperjadin_nama; ?> pada tanggal <?= date('d F Y',strtotime($kaban[0]->spt_mulai)); ?> s.d <?= date('d F Y',strtotime($kaban[0]->spt_berakhir)); ?>.</td>
        </tr>
        <tr>
          <td id="isiberita">2.</td>
          <td colspan="10" id="isiberita">Setelah selesai melaksanakan tugas dimaksud agar melaporkan hasilnya kepada Kepala Badan Keuangan dan Aset Daerah Kabupaten Asahan.</td>
        </tr>
        <tr>
          <td colspan="11" id="isipenutup">Demikian Surat Perintah ini diperbuat, untuk dilaksanakan dengan penuh tanggung jawab</td>
        </tr>
      </table>
      <!-- <div class="cardttd"> -->
      <table id="surat" class="page-break">
        <tr><td><br></td></tr>
        <tr>
          <td id="ttd">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </td>
          <td id="ttd" width="25%">Dikeluarkan di</td>
          <td id="ttd" width="2%">:</td>
          <td id="ttd right">Kisaran</td>
        </tr>
        <tr>
          <td id="ttd" ></td>
          <td id="ttd"  >Pada Tanggal</td>
          <td id="ttd" >:</td>
          <td id="ttd"  ><?= (empty($kaban[0]->spt_tgl)) ? "" : date('d F Y',strtotime($kaban[0]->spt_tgl)); ?></td>
        </tr>
        <tr><td><br></td></tr>
        
          <tr>
            <td id="ttdan">An.</td>
            <td colspan="3" id="ttd">BUPATI ASAHAN</td>
          </tr>
          <tr>
          <td id="ttdan" ></td>
            <td colspan="3" id="ttd" >SEKRETARIS DAERAH</td>
          </tr>
        
        <tr><td><br></td></tr>
        <tr><td><br></td></tr>
        <tr>
          <td id="ttd"></td>
          <td colspan="3" id="ttd">Drs. JOHN HARDI NASUTION, M.Si</td>
        </tr>
        <tr>
          <td id="ttd"></td>
          <td colspan="3" id="ttd" >PEMBINA UTAMA MUDA</td>
        </tr>
        <tr>
          <td id="ttd"></td>
          <td colspan="3" id="ttd" >NIP. 19670502 199002 1 002</td>
        </tr>
      </table>
    </div>
  <!-- </div> -->
  <!-- </div> -->
  
</body>
</html>