<?php
//sipa
// Data collections
$tim = [
    "1" => ["pemain" => "Andre", "power" => 80, "lawan" => 75, "menang" => true],
    "2" => ["pemain" => "Berli", "power" => 75, "lawan" => 89, "menang" => false],
    "3" => ["pemain" => "Charlie", "power" => 67, "lawan" => 76, "menang" => false],
    "4" => ["pemain" => "Desmond", "power" => 88, "lawan" => 61, "menang" => true],
    "5" => ["pemain" => "Erina", "power" => 95, "lawan" => 96, "menang" => false],
    "6" => ["pemain" => "Farah", "power" => 75, "lawan" => 80, "menang" => false],
    "7" => ["pemain" => "Gerry", "power" => 89, "lawan" => 75, "menang" => true],
    "8" => ["pemain" => "Hesti", "power" => 76, "lawan" => 67, "menang" => true],
    "9" => ["pemain" => "Indra", "power" => 61, "lawan" => 88, "menang" => false],
    "10" => ["pemain" => "Jordan", "power" => 96, "lawan" => 95, "menang" => true],
];

$members = [
    "MA01" => "Andre",
    "MA02" => "Berli",
    "MA03" => "Charlie",
    "MA04" => "Desmond",
    "MA05" => "Erina",
    "MB01" => "Farah",
    "MB02" => "Gerry",
    "MB03" => "Hesti",
    "MB04" => "Indra",
    "MB05" => "Jordan"
];

// Function to check if the book is available
function check_availability($angka_input, $tim) {
    return isset($tim[$angka_input]) && $tim[$angka_input]['menang'];
}

// Function to validate member
function validate_member($angka_input, $members) {
    return isset($members[$angka_input]);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $angka_input = $_POST['angka_input'] ?? '';
    $member_code = $_POST['member_code'] ?? '';

    $message = '';
    if (!validate_member($member_code, $members)) {
        $message = "selamat";
    } elseif (!check_availability($angka_input, $tim)) {
        $message = "selamat";
    } else {
        $message = "selamat " . $members[$member_code];
        // Set book as not available (borrowed)
        $tim[$angka_input]['menang'] = false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan</title>
</head>
<body>

<h1>Daftar MMA</h1>
<table border="1">
    <tr>
        <th>Tim</th>
        <th>Pemain</th>
        <th>Power</th>
        <th>Lawan</th>
        <th>Penentuan</th>
    </tr>
    <?php foreach ($tim as $code => $book): ?>
    <tr>
        <td><?= $code; ?></td>
        <td><?= $book['pemain']; ?></td>
        <td><?= $book['power']; ?></td>
        <td><?= $book['lawan']; ?></td>
        <td><?= $book['menang'] ? 'Menang' : 'Kalah'; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h1>Tanding MMA</h1>
<form method="POST" action="">
    <label for="member_code">Kode Member:</label>
    <input type="text" name="member_code" required><br><br>

    <label for="book_code">Input Angka:</label>
    <input type="text" name="book_code" required><br><br>

    <input type="submit" value="Hasil">
</form>

<?php if (!empty($message)): ?>
    <p><strong><?= $message; ?></strong></p>
<?php endif; ?>

</body>
</html>
