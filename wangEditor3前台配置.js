     <script type="text/javascript">
              $(function () {
                  var E = window.wangEditor;
                  var editor = new E('#content');
                  // 或者 var editor = new E( document.getElementById('editor') )

                  //editor.customConfig.uploadImgShowBase64 = true;   // 使用 base64 保存图片
                  editor.customConfig.linkImgCallback = function (url) {
                      console.log(url) // url 即插入图片的地址
                  };

                  // 自定义菜单配置
                  editor.customConfig.menus = [
                      'head',  // 标题
                      'bold',  // 粗体
                      'italic',  // 斜体
                      'underline',  // 下划线
                      'strikeThrough',  // 删除线
                      'foreColor',  // 文字颜色
                      'backColor',  // 背景颜色
                      'link',  // 插入链接
                      'list',  // 列表
                      'justify',  // 对齐方式
                      'quote',  // 引用
                      'emoticon',  // 表情
                      'image',  // 插入图片
                      'table',  // 表格
                      'video',  // 插入视频
                      'code',  // 插入代码
                      'undo',  // 撤销
                      'redo'  // 重复
                  ];

                  // --> 获取焦点时触发的方法
                  editor.customConfig.onfocus = function () {
                      console.log("onfocus")
                  };

                  // --> 插入链接时触发
                  editor.customConfig.linkCheck = function (text, link) {
                      console.log(text);
                      // 插入的文字
                      console.log(link);
                      // 插入的链接

                      return true // 返回 true 表示校验成功
                      // return '验证失败' // 返回字符串，即校验失败的提示信息
                  };

                  // --> 上传的服务器地址
                  editor.customConfig.uploadImgServer = '/test/uploadHandler.php';

                  editor.customConfig.uploadImgHooks = {
                      before: function (xhr, editor, files) {
                          console.log(files);
                          console.log(xhr);
                          // 图片上传之前触发
                          // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，files 是选择的图片文件

                          // 如果返回的结果是 {prevent: true, msg: 'xxxx'} 则表示用户放弃上传
                          // return {
                          //     prevent: true,
                          //     msg: '放弃上传'
                          // }
                      }

                  };


                  // --> 开启debug 模式
                  editor.customConfig.debug = true;

                  // --> 先配置后创建
                  editor.create();

                  document.getElementById('btn1').addEventListener('click', function () {
                      // 读取 html
                      alert(editor.txt.html())
                  }, false);

                  document.getElementById('btn2').addEventListener('click', function () {
                      // 读取 text
                      alert(editor.txt.text())
                  }, false);

                  editor.txt.html('<p>用 JS 设置的内容</p>');

              });
          </script>
