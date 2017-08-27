<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yii\db\ActiveRecord */
/* @var $saveDB integer */
/* @var $attribute string */
/* @var $url string */

/* 判断是否保存到数据库 */
$saveDB = isset($saveDB)?$saveDB:1;
$data   = $model->{$attribute};
if ($saveDB) {
    $picture = \common\modelsgii\Picture::find()->where(['id'=>$data])->asArray()->one();
    if (!$picture) {
        $picture['id']   = '';
        $picture['path'] = '';
    }
} else {
    $picture['id']   = $data;
    $picture['path'] = $data;
}

?>

<!-- image表图集 -->
<div class="fileinput fileinput-new" data-provides="fileinput">
    <div style="margin-bottom:5px;">
        <span class="btn red btn-outline btn-file">
            <span class="fileinput-new"> 上传图片 </span>
            <?=Html::activeInput('hidden', $model, $attribute, ['value'=>$picture['id']])?>
            <input type="file" name="..." class="file_buttom<?=$saveDB?>">
        </span>
    </div>
    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
        <img class="file_img" src="<?= !empty($picture['path']) ? \common\helpers\Html::src($picture['path']) : \yii\helpers\Url::to('@web/static/images/no.png'); ?>">
    </div>
</div>

<?php
/* 加载页面级别资源 */
\common\widgets\images\FileinputAsset::register($this);
?>

<!-- 定义数据块 -->
<?php $this->beginBlock('image'); ?>

$(function() {
    /* ===================上传单图======================= */
    $(".file_buttom<?=$saveDB?>").on("change", function(){
        var file_ipt = $(this).siblings('input');
        var file_img = $(this).parents('.fileinput').find('.file_img');

        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;
        if (/^image/.test( files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){
                $.ajax({
                    type: 'post',
                    url: '<?=$url?>',
                    data: {imgbase64:this.result,saveDB:<?=$saveDB?>},
                    dataType: 'json',
                    beforeSend: function(){
                        
                    },
                    success: function(json){
                        if(json.boo){//console.log(file_ipt);console.log(file_img);
                            file_img.attr('src','<?=Yii::$app->params['upload']['url']?>'+json.data.url);
                            file_ipt.val(<?=$saveDB?'json.data.id':'json.data.url'?>);
                        } else {
                            alert(json.msg);
                        }
                    },
                    error: function(xhr, type){
                        alert('服务器错误')
                    }
                });
            }
        }
    });
});

<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['image'], \yii\web\View::POS_END); ?>
