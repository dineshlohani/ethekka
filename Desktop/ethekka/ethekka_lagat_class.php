<?php
// if it's going to need the database, then it's
// probably smart to require it before we start
require_once('database.php');

class Ethekka_lagat
{
    protected static $table_name = "ethekka_kul_lagat";
    protected static $db_fields = array('id','plan_id','agreement_gaupalika',
        'kul_rakam','anya_nikaya','anya_nikaya_amount','cont','yojana_start_date','yojana_end_date','yojanaa_samjhauta_date','anya_nikaya_per','lagat_miti','agreement_gaupalika_per','contract_total_investment','katti','total_investment');
    public $id;
    public $plan_id ;
    public $agreement_gaupalika;
    public $kul_rakam;
    public $anya_nikaya;
    public $anya_nikaya_amount;
    public $anya_nikaya_per;
    public $agreement_gaupalika_per;
    public $lagat_miti;
    public $contract_total_investment ;
    public $katti ;
    public $cont;
    public $yojana_start_date;
    public $yojana_end_date;
    public $yojanaa_samjhauta_date;
    public $total_investment ;

    public static function find_all()
    {
        global $database;
        return self::find_by_sql("select * from ".self::$table_name);

    }
    public static function setEmptyObjects()
    {
        return new self;
    }

    public function getName($string_id="")
    {

        $topic_selected = self::find_by_id($string_id);
        return $topic_names = $topic_selected->name;
    }
    public static function find_by_status($status=0,$plan_id)
    {
        global $database;
        $result_array=self::find_by_sql("select * from ".self::$table_name. " where status=1 and plan_id=".$plan_id);
        return !empty($result_array)? array_shift($result_array) : false;
    }
    public static function find_by_max($num,$plan_id)
    {
        global $database;
        $result_array=self::find_by_sql("select * from ".self::$table_name. " where payment_evaluation_count='".$num."' and plan_id=$plan_id limit 1");
        return !empty($result_array)? array_shift($result_array) : false;
    }
    public static function find_by_id($id=0)
    {
        global $database;
        $result_array=self::find_by_sql("select * from ".self::$table_name. " where id={$id} limit 1");
        return !empty($result_array)? array_shift($result_array) : false;
    }
    public static function find_by_payment_count($count=1,$plan_id=0)
    {
        global $database;
        $result_array=self::find_by_sql("select * from ".self::$table_name. " where plan_id={$plan_id} and payment_evaluation_count={$count} limit 1");
        return !empty($result_array)? array_shift($result_array) : false;
    }
    public static function find_by_plan_id($id=0)
    {
        global $database;
        $result_array=self::find_by_sql("select * from ".self::$table_name. " where plan_id={$id} limit 1");
        return !empty($result_array)? array_shift($result_array) : false;
    }
    public static function find_by_user_id($user_id=0)
    {
        global $database;
        $result_array=self::find_by_sql("select * from ".self::$table_name. " where user_id={$user_id} limit 1");
        return !empty($result_array)? array_shift($result_array) : false;
    }

    public function getLink($pagination){
        $link=$page_no='';
        $html=$per_page='';
        $total_pages=$pagination->total_pages();
        if($pagination->total_count>$per_page){
            if($pagination->has_previous_page()){//check if it has previous page function used from class
                $prev_link='<a href="'.$link.'?page_no='.$pagination->previous_page().'">prev</a>';
            }
            else{
                $prev_link="";
            }
            //check if it has next page function used from class
            if($pagination->has_next_page()){
                $next_link='<a href="'.$link.'?page_no='.$pagination->next_page().'">next</a>';
            }
            else{
                $next_link="";
            }
            $html .= $prev_link;
            for($i=1;$i<=$total_pages;$i++){
                if($i==$pagination->current_page){
                    $html.="<span style='color:red; background:black; padding-top:1px; padding-right:5px; padding-buttom:1px; padding-left:5px;'>".$pagination->current_page."</span>";
                }
                else{
                    $html.='<span> <a href="'.$link.'?page_no='.$i.'">'.$i.'</span>';


                }
            }
            $html.=$next_link;
        }
        return $html;
    }

    public  function savePostData($post, $clause)
    {
        foreach(self::$db_fields as $db_field)
        {
            if($clause=="create" && $db_field=="id")
            {
                continue;
            }
            if(property_exists($this, $db_field))
            {
                $this->$db_field= $post[$db_field];
            }
        }

        return $this->save();
    }
    public static function find_by_sql($sql="")
    {
        global $database;
        $result_set=$database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set))
        {
            $object_array[]= self::instantiate($row);
        }
        return $object_array;
    }
    public function set_page_query($page_no,$per_page,$link){
        global $pagination;
        $html='';
        $total_count=self::count_all();
        $pagination->set_pagination($page_no, $per_page, $total_count);
        $sql = "select * from ".self::$table_name." limit ".$pagination->per_page. " offset ".$pagination->offset();
        $result = self::find_by_sql($sql);
        $html=self::getLink($pagination);
        $output=array();
        array_push($output, $html);
        array_push($output, $result);
        return $output;
    }
    public static function count_all()
    {
        global $database;
        $sql = "select count(*) from ".self::$table_name;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    public static function getMaxInsallmentByPlanId($plan_id=0)
    {
        global $database;
        $sql = "select max(payment_evaluation_count) from ".self::$table_name." where plan_id={$plan_id}";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    private static function instantiate($record)
    {
        // could check that $record exists and is an array
        // simple, long form approach
        $object= new self;
        /* $object->id			= $record['id'];
         $object->username		= $record['username'];
         $object->password 		= $record['password'];
         $object->first_name 	= $record['first_name'];
         $object->last_name 	= $record['last_name'];*/


        // more dynamic, short-form approach:
        foreach($record as $attribute=>$value)
        {
            if ($object->has_attribute($attribute))
            {
                $object->$attribute=$value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute)
    {
        // get_object_vars returns an associative array with all attributes
        // (incl. private ones!) as the keys and their current values as the value
        $object_vars = get_object_vars($this);
        // we don't care about the value, we just want to know if the key exists
        // will return true or false
        return array_key_exists($attribute, $object_vars);
    }
    protected function attributes()
    {
        // return an array of attribute keys and their values
        $attributes = array();
        foreach(self::$db_fields as $field)
        {
            if(property_exists($this, $field))
            {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }
    protected function sanitized_attributes()
    {
        global $database;
        $clean_attributes = array();
        // sanitize the values before submitting
        // note: does not alter the actual value of each attribute
        foreach($this->attributes() as $key => $value)
        {
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }
    public function save()
    {
        // a new record won't have an id yet
        return isset($this->id) ? $this->update() : $this->create();
    }
    public function create()
    {
        global $database;
        // dont forget sql syntax and good habits
        // insert into table ('key', 'key') values ('value', 'value')
        // single quotes around all values
        // escape all values to prevent sql injection
        $attributes = $this->sanitized_attributes();
        $sql = "insert into ". self::$table_name ."(";
        $sql .= join(",", array_keys($attributes));
        $sql .=") values ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if ($database->query($sql))
        {
            $this->id = $database->insert_id();
            return $this->id;
        }
        else
        {
            return false;
        }
    }

    public function update()
    {
        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value)
        {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "update ".self::$table_name." set ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= "where id=".$database->escape_value($this->id);
        $database->query($sql);
        return ($database->affected_rows() ==1)? true : false;
    }

    public function delete()
    {
        global $database;
        // delete from table where condition limit 1
        $sql = "delete from " .self::$table_name ;
        $sql .= " where id=".$database->escape_value($this->id);
        $sql .= " limit 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

}
$analysis= new Analysisbasedwithdraw();

?>
