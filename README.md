##开发基础说明
1、gii生成的模型统一放在 common\models下，模型统一继承 common\core\BaseActiveRecord  方便扩展yii核心  
2、所有表单模型都继承 common\core\BaseModel  
3、所有控制器都继承 common\core\Controller  
4、所有 自定义助手函数都放在 common\helpers\ 且方法都未static方法  
5、