<?php

// Decryption utility for FAAN encrypted keys
// Based on the old Castoware\Util encryption method

function decrypt($ivHashCiphertext, $password)
{
    $ivHashCiphertext = base64_decode($ivHashCiphertext);
    $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    $hash = substr($ivHashCiphertext, 16, 32);
    $ciphertext = substr($ivHashCiphertext, 48);
    $key = hash('sha256', $password, true);

    if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) {
        return null;
    }

    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
}

// Get the encryption password
$password = trim(file_get_contents("/Users/mikecasto/website-data-repo/faan/faan-encryption-password.txt"));

// Get the encrypted reCAPTCHA keys
$recaptcha = json_decode(file_get_contents("/Users/mikecasto/website-data-repo/faan/faan-recaptcha.json"));

echo "Encryption password: " . $password . "\n";
echo "Encrypted site key: " . $recaptcha->site . "\n";
echo "Encrypted secret key: " . $recaptcha->secret . "\n\n";

// Decrypt the keys
$siteKey = decrypt($recaptcha->site, $password);
$secretKey = decrypt($recaptcha->secret, $password);

echo "=== DECRYPTED RECAPTCHA KEYS ===\n";
echo "RECAPTCHA_SITE_KEY=" . $siteKey . "\n";
echo "RECAPTCHA_SECRET_KEY=" . $secretKey . "\n";
