<div id="printpage">
    <style type="text/css">
        @media print {
            .bdb {
                border-bottom: 0.5px solid black;
                padding-bottom: 10px
            }

            .txc {
                text-align: center;
            }

            .txr {
                text-align: right;
            }

            .txj {
                text-align: justify;
            }

            .b {
                font-weight: bold;
            }

            .i {
                font-style: italic;
            }

            .u {
                text-decoration: underline;
            }

            .parag {
                text-indent: 30;
            }

            .kode_trx {
                font-size: 14pt;
                font-style: italic;
            }

            .title {
                font-size: 12pt;
            }
        }
    </style>
</div>
<table>
    <tbody>
        <tr>
            <td width="260" class="bdb txc">KEPOLISIAN NEGARA REPUBLIK INDONESIA <br> DAERAH JAWA TENGAH <br>RESOR KARANGANYAR</td>
            <td width="90"></td>
            <td width="180" class="bdb">LAMPIRAN C JUKLAK KAPOLRI <br>No Pol &nbsp;&nbsp;: Juklak/01/I/1983 <br>Tanggal : 04 Januari 1983</td>
        </tr>
    </tbody>
</table>
<br><br>
<table>
    <tbody>
        <tr>
            <td colspan="2" class="txc">
                <img src="/assets/img/polri.png" width="100" /> <br>
                <u>SURAT KETERANGAN TANDA LAPOR KEHILANGAN</u> <br>
                Nomor : 120192019209909019
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" class="txj parag">
                Yang bertanda tangan di bawah ini menerangkan bahwa pada hari ini Senin, tanggal 07 Oktober 2019, sekitar jam 14.40 Wib telah datang ke SPKT Polres Karanganyar, seorang laki-laki / perempuan berkebangsaan Indonesia bernama :
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="160">Nama</td>
            <td>: <?= strtoupper($data->nama_lengkap) ?></td>
        </tr>
        <tr>
            <td>Tempat/ Tanggal Lahir</td>
            <td>: <?= $data->tempat_tgl_lahir ?></td>
        </tr>
        <?php
        $agama = ['', 'Islam', 'Kristen', 'Protestan', 'Hindu', 'Budha', 'Konghucu'];
        $warga = ['', 'WNI', 'WNA'];
        ?>
        <tr>
            <td>Agama</td>
            <td>: <?= $agama[$data->agama] ?></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: <?= $data->pekerjaan ?></td>
        </tr>
        <tr>
            <td>Kewarganegaraan</td>
            <td>: <?= $warga[$data->kewarganegaraan] ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $data->alamat ?></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="530" colspan="2" class="txj parag">
                Melaporkan bahwa telah kehilangan tercecer barang-barang/ surat-surat berharga berupa
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="530" colspan="2" class="txj"><u>Catatan:</u> <br>Surat keterangan ini bukan merupakan pengganti barang/ surat yang hilang namun sebagai syarat pengurusan barang/ surat yang hilang. kebenaran isi laporan ini merupakan tanggung jawab dari Pelapor</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="530" colspan="2" class="txj parag">
                Demikian Surat Keterangan Tanda Lapor Kehilangan ini dibuat untuk dipergunakan seperlunya
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td width="530" colspan="2" class="txr">a.n KEPALA KEPOLISIAN RESOR KARANGANYAR <br>KEPALA SENTRA PELAYANAN KEPOLISIAN</td>
        </tr>
        <tr>
            <td class="txc" width="265">Pelapor <br><br><br><br><br><br><u><?= strtoupper($data->nama_lengkap) ?></u> </td>
            <td class="txc" width="265">KANIT SPKT I <br><br><br><br><br><br><u>SISMANTO. SH</u><br>AIPTU 09090909</td>
        </tr>
    </tbody>
</table>