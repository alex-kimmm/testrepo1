<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TypiCMS\Modules\Failzs\Models\Failz;
use TypiCMS\Modules\Failzs\Models\FailzSetting;
use TypiCMS\Modules\Failzs\Models\FailzTag;

class GetGiphy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'giphy:refresh {search} {limit} {check_running}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return \App\Console\Commands\GetGiphy
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if( $this->argument('check_running') == 'true' && FailzSetting::getValue('running') == '0') return;

        $search = $this->argument('search');
        $limit = $this->argument('limit');

        $url = str_replace("#search", $search, Failz::$giphyApiUrl);
        $url = str_replace("#limit", $limit, $url);

        $tag = FailzSetting::getValue('q');
        $fail_tag = FailzTag::firstOrCreate(['name' => $tag]);

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $url);

        if($res->getStatusCode()) {
            $giphy_data = json_decode($res->getBody());

            $giphys = [];
            $giphys_ids = [];

            foreach($giphy_data->data as $g){
                $gip = new \stdClass();
                $gip->title = $this->create_title($g->slug, $g->id);
                $gip->giphy_id = $g->id;
                $gip->status = true;
                $gip->is_giphy = true;
                $gip->obj_link = $g->images->original->url;
                $gip->obj_link_placeholder = $g->images->original_still->url;
                $giphys[] = $gip;
                $giphys_ids[] = $g->id;
            }

            if( count($giphys) > 0 ) {

                $toUpdate = Failz::whereIn('giphy_id', $giphys_ids)->get()->toArray();

                foreach($toUpdate as $up) {
                    $index = array_search($up['giphy_id'], $giphys_ids);
                    Failz::where('giphy_id', '=', $up['giphy_id'])->update(['obj_link' => $giphys[$index]->obj_link]);
                }

                $toInsert = [];
                foreach($giphys as $gp) {

                    if( !$this->is_in_array($toUpdate, 'giphy_id', $gp->giphy_id) ) {
                        $toInsert[] = (array)$gp;
                        $fail = Failz::create((array)$gp);
                        $fail->tags()->attach($fail_tag);
                    }
                }
            }
        }
    }

    function is_in_array($array, $key, $key_value){
        $within_array = false;
        foreach( $array as $k=>$v ){
            if( is_array($v) ){
                $within_array = $this->is_in_array($v, $key, $key_value);
                if( $within_array ){
                    break;
                }
            } else {
                if( $v == $key_value && $k == $key ){
                    $within_array = true;
                    break;
                }
            }
        }
        return $within_array;
    }

    function create_title($slug, $id) {
        return ucfirst(str_replace($id, "", str_replace("-", " ", $slug)));
    }
}
