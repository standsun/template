<?php
/**
 * 简单的PHP模板渲染类
 * 
 * @author  standsun@126.com
 * @date    2017-11-07
 *
 */
class Template {
    // 编译文件存放地址
    const RUNTIME_PATH = '/tmp/';

    // 模板变量
    private $_vars = array();

    // 渲染模板并返回渲染后的code
    public function render($templateFile) {
        if(!file_exists($templateFile)) {
            throw new \Exception("模板文件不存在");
        }
        $runtimeFile = self::RUNTIME_PATH . 'cache.' . md5($templateFile) . '.' . date('YmdHi') . '.txt';
        if(!file_exists($runtimeFile)) {
            // 获取初始内容转换标签为php标签
            $content = file_get_contents($templateFile);
            $content = $this->replace($content);
            // 保存编译后的文件
            file_put_contents($runtimeFile,$content);
        }

        // 生成模板变量
        extract($this->_vars);

        // 引入模板转换后的文件
        return include $runtimeFile;
    }

    // 模板中的变量赋值
    public function assign($key,$value = null) {
        if(is_array($key)) {
            foreach($key as $k=>$v) {
                $this->_vars[$k] = $v;
            }
        }elseif(is_string($key)) {
            $this->_vars[$key] = $value;
        }
        return $this;
    }

    /*
     * 替换模板中的标签
     */
    private function replace($string) {
        $pattern = array(
            '#\{\$(\w+)\}#',
            '#\{\$(\w+)\.(\w+)\}#',
            '#\{foreach\s+(\w+)\s+(\w+)=>(\w+)\}#',
            '#\{/foreach\}#'
        );

        $replace = array(
            '<?php echo isset($\1)?$\1:""; ?>',
            '<?php echo isset($\1["\2"])?$\1["\2"]:""; ?>',
            '<?php if(!isset($\1)) $\1=array();foreach($\1 as $\2=>$\3): ?>',
            '<?php endforeach; ?>'
        );

        return preg_replace($pattern,$replace,$string);
    }
}
