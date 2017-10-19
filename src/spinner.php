<?php

namespace kdaviesnz\spinner;


class Spinner implements ISpinner
{

    private $text;

    /**
     * Spinner constructor.
     */
    public function __construct(string $text, string $wordAIEmail, string $wordAIPassword)
    {
        $this->text =  $this->spin($text, $wordAIEmail, $wordAIPassword);
    }

    public function __toString()
    {
        return $this->text;
    }

    private function spin(string $text, string $email, string $pass ):string
    {

        // Ref. https://wordai.com/api.php
        $quality = 'Readable';

        $text = urlencode( $text );

        $ch = curl_init( 'http://wordai.com/users/turing-api.php' );

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

        curl_setopt ( $ch, CURLOPT_POST, 1 );

        curl_setopt (
            $ch,
            CURLOPT_POSTFIELDS,
            "s=$text&quality=$quality&email=$email&pass=$pass&output=json&sentence=on&returnspin=true"
        );

        $result = curl_exec($ch);

        curl_close ($ch);

        return $result;

    }

}


