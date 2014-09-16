<?php
include_once 'ufpdf.php';

class UFPDF_My extends UFPDF{
    
    function splitOnWords($str, $chunks) {
        $words =  mb_split('\s+', $str);
        $ret = array();
        $i = 0;
        $j = 0;
        foreach($chunks as $to) {
            $ret[$i] = '';
            while($j < count($words) && ($ret[$i] == '' || mb_strlen($ret[$i].' '.$words[$j], 'UTF-8') < $to)) {
                $ret[$i].= ' '.$words[$j];
                $j++;
            }
            $ret[$i] = $this->longify($ret[$i], $to);
            $i++;
        }
        return $ret;
    }

    function longify($str, $to) {
        if ($to > mb_strlen($str, 'UTF-8')) {
            $spaces = str_repeat(' ', ($to - mb_strlen($str, 'UTF-8'))/2 - 1);
            $str = $spaces.$str;
        }
        $str = str_replace('_', ' ', $str);
        $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
        return $str;
    }    

    //++++ Transform ++++
    function StartTransform(){
        //save the current graphic state
        $this->_out('q');
    }

    function ScaleX($s_x, $x='', $y=''){
        $this->Scale($s_x, 100, $x, $y);
    }
    function ScaleY($s_y, $x='', $y=''){
        $this->Scale(100, $s_y, $x, $y);
    }
    function ScaleXY($s, $x='', $y=''){
        $this->Scale($s, $s, $x, $y);
    }
    function Scale($s_x, $s_y, $x='', $y=''){
        if($x === '')
            $x=$this->x;
        if($y === '')
            $y=$this->y;
        if($s_x == 0 || $s_y == 0)
            $this->Error('Please use values unequal to zero for Scaling');
        $y=($this->h-$y)*$this->k;
        $x*=$this->k;
        //calculate elements of transformation matrix
        $s_x/=100;
        $s_y/=100;
        $tm[0]=$s_x;
        $tm[1]=0;
        $tm[2]=0;
        $tm[3]=$s_y;
        $tm[4]=$x*(1-$s_x);
        $tm[5]=$y*(1-$s_y);
        //scale the coordinate system
        $this->Transform($tm);
    }

    function MirrorH($x=''){
        $this->Scale(-100, 100, $x);
    }
    function MirrorV($y=''){
        $this->Scale(100, -100, '', $y);
    }


    function TranslateX($t_x){
        $this->Translate($t_x, 0, $x, $y);
    }
    function TranslateY($t_y){
        $this->Translate(0, $t_y, $x, $y);
    }
    function Translate($t_x, $t_y){
        //calculate elements of transformation matrix
        $tm[0]=1;
        $tm[1]=0;
        $tm[2]=0;
        $tm[3]=1;
        $tm[4]=$t_x;
        $tm[5]=-$t_y;
        //translate the coordinate system
        $this->Transform($tm);
    }

    function Rotate($angle, $x='', $y=''){
        if($x === '')
            $x=$this->x;
        if($y === '')
            $y=$this->y;
        $y=($this->h-$y)*$this->k;
        $x*=$this->k;
        //calculate elements of transformation matrix
        $tm[0]=cos(deg2rad($angle));
        $tm[1]=sin(deg2rad($angle));
        $tm[2]=-$tm[1];
        $tm[3]=$tm[0];
        $tm[4]=$x+$tm[1]*$y-$tm[0]*$x;
        $tm[5]=$y-$tm[0]*$y-$tm[1]*$x;
        //rotate the coordinate system around ($x, $y)
        $this->Transform($tm);
    }

    function SkewX($angle_x, $x='', $y=''){
        $this->Skew($angle_x, 0, $x, $y);
    }
    function SkewY($angle_y, $x='', $y=''){
        $this->Skew(0, $angle_y, $x, $y);
    }
    function Skew($angle_x, $angle_y, $x='', $y=''){
        if($x === '')
            $x=$this->x;
        if($y === '')
            $y=$this->y;
        if($angle_x <= -90 || $angle_x >= 90 || $angle_y <= -90 || $angle_y >= 90)
            $this->Error('Please use values between -90° and 90° for skewing');
        $x*=$this->k;
        $y=($this->h-$y)*$this->k;
        //calculate elements of transformation matrix
        $tm[0]=1;
        $tm[1]=tan(deg2rad($angle_y));
        $tm[2]=tan(deg2rad($angle_x));
        $tm[3]=1;
        $tm[4]=-$tm[2]*$y;
        $tm[5]=-$tm[1]*$x;
        //skew the coordinate system
        $this->Transform($tm);
    }

    function Transform($tm){
        $this->_out(sprintf('%.3f %.3f %.3f %.3f %.3f %.3f cm', $tm[0], $tm[1], $tm[2], $tm[3], $tm[4], $tm[5]));
    }

    function StopTransform(){
        //restore previous graphic state
        $this->_out('Q');
    }
    //---- Transform ----
}
?>