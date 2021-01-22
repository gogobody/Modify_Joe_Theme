<?php


class Widget_Footer_Recommend_Posts extends Widget_Abstract_Contents
{
    public function execute()
    {
        $this->db->fetchAll($this->db->select()->from('table.contents')
            ->where("table.contents.password IS NULL OR table.contents.password = ''")
            ->where("table.contents.status = ?", "publish")
            ->where("table.contents.type = ?","post")
            ->limit(5)
            ->order("table.contents.views",Typecho_Db::SORT_DESC),
            array($this,'push')
        );
    }

}