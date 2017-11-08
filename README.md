## 模板渲染类

### 项目描述
用PHP实现了非常基础简单的模板渲染功能，适合个人小项目使用。

* 标签全部都用正则转换，实现的标签，更多标签需要自行扩展(replace method)
    * {$var}   => <?php echo $var; ?> 变量输出
    * {$var.field}  => <?php echo $var['field']; ?> 二级数组输出
    * {foreach data key=>value}  => <?php foreach($data as $key=>$value): ?> foreach循环开始
    * {/foreach} => <?php endforeach; ?> foreach循环结束

* 为了简洁，没有做任何异常捕获和错误处理的操作，需要主程序自行处理。
* 左右边界标签为`{` 和 `}` ，其他标签需要自行修改。

### 使用示例

```
$Template = new Template();
$Template->assign(array(
    'title' =>  '测试标题',
    'list'  =>  array(
        array(
            'title' =>  '文章一',
            'author'=>  '作者一',
        ),
        array(
            'title' =>  '文章二',
            'author'=>  '作者二',
        ),
        array(
            'title' =>  '文章三',
            'author'=>  '作者三',
        ),
    ),
))->render('example.html');


```

终端执行：
```
php test/example.php
```

渲染后的代码：
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>测试标题</title>
    </head>
    <body>
        <div class="list">
            <div class="post">
                <span>作者一</span>
                <span>{$value.title.name}</span>
            </div>

            <div class="post">
                <span>作者二</span>
                <span>{$value.title.name}</span>
            </div>

            <div class="post">
                <span>作者三</span>
                <span>{$value.title.name}</span>
            </div>

        </div>
    </body>
</html>
```
