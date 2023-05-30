<?php

// Kunci enkripsi rahasia
define('SECRET_KEY', 'duon-J*tq6g&VyE9');

// Enkripsi saldo
function encrypt_saldo($balance) {
    $cipher = "aes-256-cbc";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $encrypted = openssl_encrypt($balance, $cipher, SECRET_KEY, 0, $iv);
    return base64_encode($iv . $encrypted);
}

// Dekripsi saldo
function decrypt_saldo($encrypted_balance) {
    $cipher = "aes-256-cbc";
    $ivlen = openssl_cipher_iv_length($cipher);
    $ciphertext = base64_decode($encrypted_balance);
    $iv = substr($ciphertext, 0, $ivlen);
    $encrypted = substr($ciphertext, $ivlen);
    $decrypted = openssl_decrypt($encrypted, $cipher, SECRET_KEY, 0, $iv);
    return $decrypted;
}

function generate_private_key($namaDepan) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+{}[];:,.<>?';
    $characters_length = strlen($characters);
    $private_key = '';
    $private_key .= $namaDepan . '-';

    // Buat 10 karakter acak dari array karakter yang diberikan
    for ($i = 0; $i < 10; $i++) {
        $private_key .= $characters[rand(0, $characters_length - 1)];
    }

    return $private_key;
}
