<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cracker extends Model
{
    private $plaintext_alphabet = "abcdefghijklmnopqrstuvwxyz";
    private $decryption_key;

    public function __construct($decryption_key)
    {
        return $this->setDecryptionKey($decryption_key);
    }

    public function setDecryptionKey($decryption_key)
    {
        $this->decryption_key = $decryption_key;
        return $this;
    }

    public function decryptMsg($message)
    {
        $decrypted_chars = [];
        foreach (str_split($message) as $encrypted_char) {
            $decrypted_chars[] = $this->decryptChar($encrypted_char);
        }
        return join("", $decrypted_chars);
    }

    public function decryptChar($char)
    {
        $char_position = strpos($this->decryption_key, $char);
        if ($char_position === false) {
            return $char;
        } else {
            return $this->plaintext_alphabet[$char_position];
        }
    }
}
