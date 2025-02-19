<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Panchiko;
use App\Models\Machine;
use App\Models\MachineChart;
use DB;

class CrawData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:craw-data {panchiko_id} {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            $this->crawData();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
           \Log::error($exception);
        }
      

      
    }

    public function crawData(){
        $panchikoId = $this->argument('panchiko_id');
        $baseUrl = "https://min-repo.com/pachinko/";

        $url = $baseUrl . $panchikoId;
        $type =  $this->argument('type');
        if($type == 'link') {
            $url = $this->argument('panchiko_id');
        }

        // $output = shell_exec("node resources/js/scrape.js " . escapeshellarg($url));

        $output = Http::get($url)->body(); // Fetch HTML from a URL

    
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Suppress warnings for malformed HTML
        $dom->loadHTML($output);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
       
        $article =  $xpath->query("//article");
        
        $name =  $panchikoId;
        if($article->length > 0) {
            $h1 = $xpath->query(".//h1", $article[0]);
            if ($h1->length > 0) {
                $name = $h1[0]->textContent;
            }
        }

        $args = [
            "panchiko_url_id" => $panchikoId,
            "url" => $url
        ];

        $panchiko = Panchiko::updateOrCreate($args, array_merge($args, ["name" => $name]));
         
        // Example: Extract all links
        $tables = $xpath->query('//table');
        
       
        foreach ($tables as $table) {
            $class = $table->getAttribute('class');
            if($class == 'kishu') {
                $this->getAllLinkOnTable($table,  $url, $panchiko);
            }
        }
    }

    public function getAllLinkOnTable($table,  $url, $panchiko) 
    {
        $xpath = new \DOMXPath($table->ownerDocument);
        $links = $xpath->query('.//a', $table); // Lấy tất cả thẻ <a> trong bảng
    
        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            $newLink = $url . $href;
            $text = trim($link->textContent);

            $args = [
                'panchiko_id' => $panchiko->id,
                'name' => $text,
                'title_filter_url' => $newLink
            ];
            $machine = Machine::updateOrCreate($args, $args);

            $this->getDataChart($newLink, $machine);
        }
    }
    public function getDataChart($link, $machine) {
        $output = Http::get($link)->body(); 
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); 
        $dom->loadHTML($output);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $uls = $xpath->query('//ul');
        foreach ($uls as $ul) {
            $class = $ul->getAttribute('class');
            if($class == 'slump_list') {
                $elements = $ul->childNodes;

               
                foreach ($elements as $key => $element) {
                    if($key%2 != 0) {
                        continue;
                    }
                   
                    if ($element->nodeType === XML_ELEMENT_NODE) { 
                        $link = $element->getAttribute('href');
                        $textA = trim($element->textContent);

                        $scriptText = $elements[$key + 1]->textContent;

                        preg_match('/data:\s*\[\s*([\d,\- ]+)\s*\]/', $scriptText, $matches);

                        if (!empty($matches[1])) {
                            $dataArray = array_map('trim', explode(',', $matches[1])); 

                            $args = [
                                'machine_id' => $machine->id,
                                'chart_name' => $textA,
                                'chart_data' => $dataArray,
                                'link' => $link
                            ];
                            MachineChart::updateOrCreate($args, $args);
                           
                        } else {
                            echo ("Không tìm thấy dữ liệu" . "\n" );

                        }
                      
                    }
                }
                
              
            }
            
        }
    }
}
