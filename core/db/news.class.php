<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/25
 * Time: 19:41
 */
class core_db_News extends core_db_DbBase {

    private $table = "vb_news";

    /**
     * core_db_news constructor.
     */
    public function __construct()
    {
        parent::__construct($this->table);
    }

    public function addNews($data) {
        try{
            if(empty($data)) {
                throw new Exception("缺少必要参数");
            }
            $this->useConfig("common","main");
            $rs = $this->insert($this->table,$data);
            if($rs === false) {
                throw new Exception("添加记录失败");
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function queryNews($param, $page, $limit){
        try{
            $this->useConfig("common","query");
            $this->setPage((int)$page);
            $this->setLimit((int)$limit);
            return $this->select($this->table,$param,'*');
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateOneNews($condition, $item){
        try{
            if(empty($condition) || empty($item)) {
                throw new Exception("缺少必要参数");
            }
            $this->useConfig("common","main");
            $id = $condition['id'];
            $itemRes = $this->getOne(array("id"=>$id));
            if(empty($itemRes)) {
                throw new Exception("记录不存在");
            }
            $rs = $this->update($this->table, $condition, $item);
            if($rs === false) {
                throw new Exception("更新失败");
            }
        } catch (Exception $e) {
            return false;
        }
    }

}