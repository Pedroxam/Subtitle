<?php

namespace App\Models;

class Search
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
     * Search constructor.
     * @param $title | media title
     */
    public function __construct( $title )
    {
        $this->title = urlencode($title);
    }

    /**
     * Get subtitle result.
     *
     * @return mixed
     */
    public function result()
    {
        $page = $this->search_page($this->title);

        return $this->match($page);
    }

    /**
     * Subtitle search page.
     *
     * @param $title
     * @return bool|string
     */
    public function search_page($title)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,self::API . '/subtitles/searchbytitle');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"query=$title&l=");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        return $server_output;
    }

    /**
     * Match search section.
     *
     * @param $page | page content
     * @return bool|string
     */
    public function match($page)
    {
        $links = '';
        if(preg_match_all('/<div class="title">(.*?)<\/div>/ms', $page,$match)) {

            foreach($match[0] as $title){
                $links .= $title;
            }
            return str_replace('"/', '"'.url('/') . '/' ,$links);
        }

        return 'هیچ موردی یافت نشد !';
    }
}