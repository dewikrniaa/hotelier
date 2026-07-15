<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan Hotel</title>

    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 4px 0;
            font-size: 12px;
        }

        .periode {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #f2f2f2;
            border: 1px solid #000;
            padding: 8px;
            font-size: 12px;
        }

        td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 12px;
            text-align: center;
        }

        .total {
            margin-top: 15px;
            text-align: right;
            font-size: 13px;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <h2>Hotelier</h2>
        <p>Laporan Pendapatan</p>
    </div>

    {{-- PERIODE --}}
    <div class="periode">
        Periode: {{ strtoupper($periode) }}
    </div>

    {{-- TABLE --}}
    <table>
        <thead>
            <tr>
                <th width="30%">Periode</th>
                <th width="20%">Jumlah Check-in</th>
                <th width="30%">Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $row)
                <tr>
                    <td>
                        @if(isset($row->periode))
                            {{ $row->periode }}
                        @elseif(isset($row->bulan))
                            {{ date('F', mktime(0,0,0,$row->bulan,1)) }} {{ $row->tahun }}
                        @else
                            {{ $row->tahun }}
                        @endif
                    </td>
                    <td>{{ $row->jumlah_check_in }}</td>
                    <td>Rp {{ number_format($row->total_transaksi, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTAL --}}
    <div class="total">
        Total Pendapatan : Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        Laporan ini dihasilkan oleh Sistem Informasi Hotelier
    </div>

</body>
</html>
