<style>
    td {
        padding-right: 5px;
        padding-left: 5px;
    }

</style>

<table cellspacing=0 >
    @foreach ($students as $student)
        <tr>
            <td rowspan="7" style="border-top: 1px solid; border-left: 1px solid; border-bottom: 1px solid; padding-top:10px;" >{{ $loop->iteration }}</td>
            @php
                $imageUrl = "/2022/3MI/" . $student->name . ".jpg";
            @endphp
            <td rowspan="7" style="border: 1px solid"> <img src="{{ url($imageUrl) }}" width="90px"></td>
        </tr>
        <tr>
            <td style='border-top: 1px solid;'>NRP</td>
            <td style='border-top: 1px solid;'>:</td>
            <td style='border-top: 1px solid;'>{{ $student->code }}</td>
            <th style="border:1px solid;">IPK</th>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ Str::title($student->name) }}</td>
            <td rowspan="5" style="border-left:1px solid;border-right:1px solid;border-bottom:1px solid; text-align: center;">{{ $student->ipk }}</td>
        </tr>
        <tr>
            <td >Alamat</td>
            <td>:</td>
            <td style='word-wrap: break-word;' width='500px;' >{{ $student->address }}</td>
        </tr>
        <tr>
            <td>TTL</td>
            <td>:</td>
            <td>{{ $student->birth_place . ", " . $student->birth_date }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>{{ $student->email }}</td>
        </tr>
        <tr>
            <td style='border-bottom: 1px solid;'>Telepon </td>
            <td style='border-bottom: 1px solid;'>:</td>
            <td style='border-bottom:1px solid;'>{{ $student->phone }}</td>
        </tr>
        <tr>
            <td colspan="5"  style='border:none; height:20px'> &nbsp;</td>
        </tr>
    @endforeach
</table>
