<?php


class CustomTemp
{
    private $file_path;
    private $array;
    private $template;

    public function __construct($cur_path,$cur_array)
    {
        $this->file_path=$cur_path;
        $this->array=$cur_array;
    }
    public function make_array_key($array,$path,$nr){
        if($nr>10)
            return $this->template;
        foreach ($array as $key => $value) {
            if(!is_array($value) && $nr==0) {
                $this->template = str_replace('{' . $key . '}', $value, $this->template);
            }
            else if(!is_array($value) && $nr!=0) {
                $this->template = str_replace('{'.$path.'['.$key.']'.'}',$value,$this->template);
                //echo '{'.$path.'['.$key.']'.'}=>'.$value.'<br>';
            }
            else if($nr==0) {
                $this->make_array_key($value,$path.$key,$nr+1);
            }
            else {
                $this->make_array_key($value,$path.'['.$key.']',$nr+1);
            }

        }
        return $this->template;
    }

    public function return_modified_file()
    {
        //echo implode(" ", $this->array);
        $this->template = file_get_contents(_SITE_URL.'/'.$this->file_path);
        $this->make_array_key($this->array,'',0);
        return $this->template;
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