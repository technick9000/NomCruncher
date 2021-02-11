<?php


namespace __prerequisites;


class Response
{

    public function setStatusCode(int $code = 404, string $msg='Not Found')
    {

        header("{$_SERVER['SERVER_PROTOCOL']} Err {$code} $msg");
        http_response_code(404);

    }

}