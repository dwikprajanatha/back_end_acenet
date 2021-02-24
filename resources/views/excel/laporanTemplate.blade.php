<table border="2">
    <thead>
        <tr>
            <th align="center">No.</th>
            <th align="center">No.SPK</th>
            <th align="center">No. Customer</th>
            <th align="center">Customer</th>
            <th align="center">Alamat</th>
            <th align="center">Jenis Layanan</th>
            <th align="center">Tgl. Pekerjaan</th>
            <th align="center">Jenis Pekerjaan</th>
            <th align="center" colspan="4">IKR</th>
        </tr>
    </thead>
    <tbody>

        @foreach($data as $spk)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$spk->no_spk}}</td>
            <td>{{$spk->no_pelanggan}}</td>
            <td>{{$spk->nama}}</td>
            <td>{{$spk->alamat}}</td>
            <td>{{$spk->jenis_layanan}}</td>
            <td>{{$spk->tgl_pekerjaan}}</td>

            @if($spk->jenis_pekerjaan == 1)
            <td>Instalasi Baru</td>
            @elseif($spk->jenis_pekerjaan == 2)
            <td>Maintenance Client</td>
            @elseif($spk->jenis_pekerjaan == 3)
            <td>Maintenance BTS</td>
            @elseif($spk->jenis_pekerjaan == 4)
            <td>Pencabutan Perankat</td>
            @endif

            @php
            $i = 0
            @endphp

            @foreach($spk->ikr as $teknisi)
            <td>{{$teknisi->nama}}</td>
            @php
            $i++
            @endphp
            @endforeach

            @while($i <= 4) <td>
                </td>
                @php
                $i++
                @endphp

                @endwhile

        </tr>
        @endforeach
    </tbody>
</table>