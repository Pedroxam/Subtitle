<?php

namespace App\Models;

class Lists
{
    /**
     * @var $title | media title
     */
    private $title;

    /**
     * Subscene url
     */
    const API = 'https://subscene.com';

    /**
     * List constructor.
     * @param $title | media title
     */
    public function __construct( $title )
    {
        $this->title = trim($title);
    }

    /**
     * Get subtitle result.
     *
     * @return mixed
     */
    public function result()
    {
        $page = $this->list_page($this->title);

        return $this->match($page);
    }

    /**
     * Subtitle List page.
     *
     * @param $title
     * @return bool|string
     */
    public function list_page($title)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::API . '/subtitles/' . $title);
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
     * Match list section.
     *
     * @param $page | page content
     * @return bool|string
     */
    public function match($page)
    {
        $links = '';
        if(preg_match_all('/<table>(.*?)<\/table>/ms', $page,$match)) {
            foreach($match[0] as $title){
				$links .= str_replace('"/', '"'.url('/') . '/' ,$title);
            }
            return preg_replace('/(.*?)\/u\/(\d++)\">/','',$links);
        }
        return 'هیچ موردی یافت نشد !'; // Nothing Found
    }
}
