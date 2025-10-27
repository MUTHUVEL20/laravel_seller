<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Items List PDF</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; font-size: 12px; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Items List</h2>
    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Unit Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->itemname }}</td>
                <td>{{ $item->itemgroup1 }}</td>
                <td>{{ $item->itemgroup2 }}</td>
                <td>{{ $item->unitname }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
