<table>
    <thead>
        <tr>
            <th >
                Data Yayasan
            </th>
        </tr>
        <tr>
            <th>Nama</th>
            <th>No Akta Pendirian</th>
            <th>Tanggal Pendirian</th>
            <th>No. Pengesahan</th>
            <th>No. SK Bn</th>
            <th>Tanggal SK Bn</th>
            <th>Telepon/HP</th>
            <th>Fax</th>
            <th>Email</th>
            <th>Website</th>
            <th>Alamat</th>
            <th>RT</th>
            <th>RW</th>
            <th>Nama Dusun</th>
            <th>Provinsi</th>
            <th>Kab./Kota</th>
            <th>Kecamatan</th>
            <th>Desa/Kel.</th>
            <th>Kode Pos</th>
            <th>Lintang</th>
            <th>Bujur</th>
            <th>Peta</th>
            <th>Logo</th>
        </tr>
    </thead>
    <tbody >
        <tr>
            <td>{{ $yayasan->nama }}</td>
            <td>{{ $yayasan->no_pendirian_yayasan }}</td>
            <td>{{ $yayasan->tgl_pendirian_yayasan }}</td>
            <td>{{ $yayasan->nomor_pengesahan_pn_ln }}</td>
            <td>{{ $yayasan->nomor_sk_bn }}</td>
            <td>{{ $yayasan->tanggal_sk_bn }}</td>
            <td>{{ $yayasan->no_telp }}</td>
            <td>{{ $yayasan->no_fax }}</td>
            <td>{{ $yayasan->email }}</td>
            <td>{{ $yayasan->website }}</td>
            <td>{{ $yayasan->alamat }}</td>
            <td>{{ $yayasan->rt }}</td>
            <td>{{ $yayasan->rw }}</td>
            <td>{{ $yayasan->nama_dusun }}</td>
            <td>{{ $yayasan->province->name }}</td>
            <td>{{ $yayasan->city->name }}</td>
            <td>{{ $yayasan->district->name }}</td>
            <td>{{ $yayasan->village->name }}</td>
            <td>{{ $yayasan->kode_pos }}</td>
            <td>{{ $yayasan->lintang }}</td>
            <td>{{ $yayasan->bujur }}</td>
            <td>{{ $yayasan->maps }}</td>
            <td>{{ $yayasan->logo_yayasan }}</td>
        </tr>
    </tbody>
</table>
