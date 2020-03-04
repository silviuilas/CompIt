<?php


class CustomTemp
{
    private $file_path;
    private $array;

    public function __construct($cur_path,$cur_array)
    {
        $this->file_path=$cur_path;
        $this->array=$cur_array;
    }
    public function return_modified_file()
    {
        //echo implode(" ", $this->array);
        $template = file_get_contents(_SITE_URL.'/'.$this->file_path);
        foreach ($this->array as $key => $value)
        {
            $template = str_replace('{'.$key.'}',$value,$template);
        }
        return $template;
    }
    public function show_file_modified()
    {
        echo $this->return_modified_file();
    }
    public function update_array_key($key,$value)
    {
        $this->array[$key]=$value;
    }

    public function update_array($upd_array)
    {
        foreach ($upd_array as $key=>$value) {
            $this->array[$key] = $value;
        }
    }
    public function getArray()
    {
        return $this->array;
    }
    public function getFilePath()
    {
        return $this->file_path;
    }



}