<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use App\Models\Lists;
use App\Models\Download;

class SubtitleController extends Controller
{
    /**
     * Load index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Search subtitle title.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        $search = new Search(request('title'));
        return view('search')->with([
            'result' => $search->result()
        ]);
    }

    /**
     * Subtitle title list.
     *
     * @param $name | media title
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list($name)
    {
        $list = new Lists($name);
        return view('list')->with([
            'result' => $list->result(),
            'name' => urldecode(str_replace('-',' ',$name)),
        ]);
    }

    /**
     * Subtitle download page.
     *
     * @param $name | media title
     * @param $lang | media language
     * @param $id | subtitle id
     * @return @void
     */
    public function download($name, $lang, $id)
    {
        $download   = new Download($name,$lang,$id);
        $result     =  $download->result();
        if(!$result)
            return;

        return $this->force_download($result);
    }

    /**
     * Force download link.
     *
     * @param $link | subtitle link
     * @return @void
     */
    public function force_download($link)
    {
        $host = $_SERVER['HTTP_HOST'];
        $file_name = rand() . '_' . $host . '.zip';
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Length: " . filesize($link));
        @readfile($link);
        exit();
    }
}