<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;


/**
 * 最新文章
 *
 * @category typecho
 * @package Widget
 * @copyright Copyright (c) 2008 Typecho team (http://www.typecho.org)
 * @license GNU General Public License 2.0
 * @version $Id$
 */

/**
 * 最新评论组件
 *
 * @category typecho
 * @package Widget
 * @copyright Copyright (c) 2008 Typecho team (http://www.typecho.org)
 * @license GNU General Public License 2.0
 */

/**
 * 执行函数
 *
 * @access public
 * @return void
 */
class Widget_Contents_Post_Recent_User extends Widget_Abstract_Contents
{
    /**
     * 执行函数
     *
     * @access public
     * @return void
     */
    public function execute()
    {
        $this->parameter->setDefault(array('pageSize' => $this->options->postsListSize));
        $uid = $this->parameter->uid;
        $select = $this->select();
        if ($uid) $select->where('table.contents.authorId = ?',$uid);
        $this->db->fetchAll($select
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created < ?', $this->options->time)
            ->where('table.contents.type = ?', 'post')
            ->order('table.contents.created', Typecho_Db::SORT_DESC)
            ->limit($this->parameter->pageSize), array($this, 'push'));
    }
}
