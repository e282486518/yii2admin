<?php
/* 判断是否保存到数据库 */
$saveDB = isset($saveDB)?$saveDB:0;
if ($saveDB) {
    $picture = \backend\models\Picture::getPic($data);
} else {
    $picture['id']   = $data;
    $picture['path'] = $data;
}

?>

<!-- image表图集 -->
<div class="form-group">
    <div>
        <label><?=isset($title)?$title:'上传图片'?></label>
        <span class="help-inline">（<?=isset($tishi)?$tishi:''?>）</span>
    </div>
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div style="margin-bottom:5px;">
            <span class="btn red btn-outline btn-file">
                <span class="fileinput-new"> 选择图片 </span>
                <span class="fileinput-exists"> 修改 </span>
                <input type="hidden" name="<?=$field?>" id="file_ipt" value="<?=$picture['id']?>">
                <input type="file" name="..." id="file_but"> 
            </span>
            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 移除 </a>
        </div>
        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
            <img id="file_img" src="<?= !empty($picture['path']) ? \common\helpers\Html::src($picture['path']) : \yii\helpers\Url::to('@web/images/no.png'); ?>">
        </div>
        
    </div>
</div>

<?php
/* 上传框CSS */
$this->registerCssFile('@web/metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');
?>

<!-- 定义数据块 -->
<?php $this->beginBlock('image'); ?>

$(function() {
    /* ===================上传单图======================= */
    $("#file_but").on("change", function(){
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;
        if (/^image/.test( files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){
                $.ajax({
                    type: 'post',
                    url: '<?=\yii\helpers\Url::to(["upload/image"])?>',
                    data: {imgbase64:this.result,saveDB:<?=$saveDB?>},
                    dataType: 'json',
                    beforeSend: function(){
                        
                    },
                    success: function(json){
                        if(json.boo){
                            $('#file_img').attr('src','<?=Yii::$app->params['upload']['url']?>'+json.data.url);
                            $('#file_ipt').val(<?=$saveDB?'json.data.id':'json.data.url'?>);
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
