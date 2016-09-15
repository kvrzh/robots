<?php

/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 15.09.2016
 * Time: 13:06
 */
class robots
{
    protected $url;

    function __construct($url)
    {
        if (stripos($url, 'http://') === false && stripos($url, 'https://') === false) {
            $url = 'http://' . $url;
        }
        $this->url = $url . '/robots.txt';

    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function getResult()
    {
        $handle = @fopen($this->url, "r");
        if ($handle) {

            $result['isExists'] = true;
            $result['isHost'] = false;
            $result['countHost'] = 0;
            $result['isSitemap'] = false;
            while (($buffer = fgets($handle, 4096)) !== false) {


                if (stripos($buffer, 'Host')) {
                    $result['isHost'] = true;
                    $result['countHost']++;
                }
                if (stripos($buffer, 'Sitemap')) {
                    $result['isSitemap'] = true;
                }
            }

            fclose($handle);

            $result['size'] = $this->getSize();
            $result['code'] = $this->getCode();
        } else {

            $result['isExists'] = false;
        }

        return $result;
    }

    private function getCode()
    {
        if (@get_headers($this->url)) {
            $headers = get_headers($this->url);

            $code = $headers[0];
            $code = explode(' ', $code);
            $result['code'] = $code[1];


        }
        return $result['code'];

    }

    private function getSize()
    {

        if (@get_headers($this->url)) {
            $headers = get_headers($this->url);

            foreach ($headers as $header) {

                $mass = explode(':', $header);
                if ($mass[0] == 'Content-Length') {
                    $result = $mass[1];
                }

            }
            return $result;

        }

    }
}