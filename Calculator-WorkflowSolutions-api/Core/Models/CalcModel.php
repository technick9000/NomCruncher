<?php


namespace Models;


use DBModel;

class CalcModel extends DBModel
{

    const STATUS_ACTIVE = 0;
    const STATUS_EDITED = 1;
    const STATUS_DELETED = 2;


    public string $_id = '';
    public string $parent_id = '';
    public string $equation = '';
    public string $result = '';
    public int $status = self::STATUS_ACTIVE;
    public string $timestamp = '';
    public string $edited_timestamp = '';



    public function tableName(): string
    {
        return 'calc_history';
    }

    public function saveEquation()
    {

        $this->validate();

        $hash_options = [
            'cost' => 12
        ];


        $cdate = date('Y-m-d H:i:s', time());
        $this->_id= password_hash($cdate, PASSWORD_BCRYPT, $hash_options);
        $this->parent_id = '';
        $this->status = self::STATUS_ACTIVE;

        return $this->save();
    }

    public function getEquastions(array $options)
    {

        // here we can implement getting the last saved equations or with the options we can get specific ones, sort themy by date etc

    }

    public function rules(): array
    {

        return array('equation' =>
            array(
                self::RULE_REQUIRED
            ),
            'result' =>
            array(
                self::RULE_REQUIRED
            )
            //self::RULE_MATCH, 'match'=> 'id'
        );

    }

    public function attributes(): array
    {
        return array('_id','parent_id','equation','result','status','timestamp','edited_timestamp');
    }


}