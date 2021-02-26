<?php


class ModifyJoePlugin_Action extends Typecho_Widget implements Widget_Interface_Do
{
    private $db;
    private $res;
    private $options;
    const POSTS_PER_PAGE = 10;
    /**
     * @throws Typecho_Db_Exception
     * @var mixed|null
     */
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->db = Typecho_Db::get();
        $this->res = new Typecho_Response();
        $this->options = Helper::options();
//        var_dump($this->request->getRequestUrl());
        if (method_exists($this, $this->request->type)) {
            call_user_func(array(
                $this,
                $this->request->type
            ));
        } else {
            $this->defaults();
        }
    }
    public function action()
    {
        $this->on($this->request);
    }

    /**
     * 获取配置
     * @param $key
     * @return false|mixed|null
     * @throws Typecho_Plugin_Exception
     */
    public static function option_value($key)
    {
        $options = Helper::options()->plugin('ModifyJoePlugin');
        if (isset($options->$key) && !empty($options->$key)) {
            return trim($options->$key);
        }

        return false;
    }
    //组合返回值
    public function make_response($code, $msg, $data = null)
    {
        $response = [
            'code' => $code,
            'msg' => $msg,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }
        $this->response->throwJson($response);
        return $response;
    }
    //组合返回值 成功
    public function make_success($data = null)
    {
        return $this->make_response(1, '操作成功！', $data);
    }

    //组合返回值 失败
    public function make_error($msg = '', $code = 0)
    {
        return $this->make_response($code, $msg);
    }

    private function defaults()
    {
        $this->make_error("no params supported!");
    }


}