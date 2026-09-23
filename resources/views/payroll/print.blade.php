<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 8px 0;
        }

        .label {
            font-weight: bold;
            width: 150px;
        }

        .total {
            border-top: 2px solid #000;
            font-weight: bold;
            font-size: 16px;
            margin-top: 15px;
            padding-top: 10px;
        }

        .footer {
            margin-top: 80px;
            width: 100%;
        }

        .footer td {
            width: 50%;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>SLIP GAJI KARYAWAN</h2>
        <p>Periode : {{ \Carbon\Carbon::parse($payroll->pay_date)->format('F Y') }}</p>
    </div>

    <table>
        <tr>
            <td class="label">Nama Karyawan</td>
            <td>: {{ $payroll->employee->fullname }}</td>
        </tr>

        <tr>
            <td class="label">Tanggal Bayar</td>
            <td>: {{ \Carbon\Carbon::parse($payroll->pay_date)->format('d F Y') }}</td>
        </tr>
    </table>

    <br>

    <table>
        <tr>
            <td class="label">Gaji Pokok</td>
            <td>Rp {{ number_format($payroll->salary, 0, ',', '.') }}</td>
        </tr>

        <tr>
            <td class="label">Bonus</td>
            <td>Rp {{ number_format($payroll->bonuses, 0, ',', '.') }}</td>
        </tr>

        <tr>
            <td class="label">Potongan</td>
            <td>Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="total">
        <table>
            <tr>
                <td class="label">Gaji Bersih</td>
                <td>Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <table class="footer">
        <tr>
            <td>
                Karyawan<br><br><br><br><br>
                ( {{ $payroll->employee->fullname }} )
            </td>
            <td>
                Finance<br><br><br><br><br>
                ( .................... )
            </td>
        </tr>
    </table>
</body>

</html>
