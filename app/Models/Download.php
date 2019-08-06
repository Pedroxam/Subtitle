<?php

namespace App\Models;

class Download
{
    /**
     * @var $title | media title
     */
    private $title;

    /**
     * @var $lang | media language
     */
    private $lang;

    /**
     * @var $id | subtitle id
     */
    private $id;

    /**
     * Subscene url
     */
    const API = 'https://subscene.com';

    /**
     * Download Page constructor.
     * @param $title | media title
     */
    public function __construct( $title, $lang, $id )
    {
        $this->title = trim($title);
        $this->lang  = trim($lang);
        $this->id    = intval($id);
    }

    /**
     * Get subtitle result.
     *
     * @return mixed
     */
    public function result()
    {
        $url = self::API . '/subtitles/' . $this->title . '/' . $this->lang . '/' . $this->id;
        $page = $this->download_page($url);
        return $this->match($page);
    }

    /**
     * Curl
     *
     * @param $url
     * @return val
     */
    public function download_page($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * Match download link.
     *
     * @param $page | page content
     * @return @var
     */
    public function match($page)
    {
        if(preg_match('/<div class="download">(.*?)<\/div>/ms', $page,$match)) {
           preg_match('/href=\"(.*?)\"/',$match[0],$link);
           $input = self::API . strip_tags($link[1]);
           return filter_var($input, FILTER_SANITIZE_URL);
        }
        return false;
    }
}
