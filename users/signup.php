

<?php
// Menghubungkan ke file connection.php
include_once("../connection.php");

//membaca dan mengambil data input json_
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Validasi keberadaan data POST
if (isset($input['user_name']) && isset($input['user_email']) && isset($input['user_password'])) {
    // Mendapatkan data dari request POST
    $username = $input['user_name'];
    $email = $input['user_email'];
    $password = $input['user_password'];

    // Mengamankan password menggunakan MD5
    $secure_password = md5($password);

    // Menyiapkan query SQL
    $sql_query = "INSERT INTO users (user_name, user_email, user_password) 
    VALUES ('$username', '$email', '$secure_password')";

    // Menjalankan query dan memeriksa hasilnya
    if ($connectNow->query($sql_query) === TRUE) {
        echo json_encode([
            "success" => true,
            "message" => "Data berhasil disimpan",
            "data" =>[
                "user_name" => $username,
                "user_email" => $email
            ]
               
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Error: " . $sql_query . "<br>" . $connectNow->error
        ]);
    }
} else {
    // Jika data POST tidak lengkap
    echo json_encode([
        "success" => false,
        "message" => "Invalid input. Please provide user_name, user_email, and user_password."
    ]);
}

// Menutup koneksi
$connectNow->close();
?>