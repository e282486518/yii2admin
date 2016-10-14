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
                <input type="hidden" name="<?=$field?>" id="file_ipt" value="<?=$data?>">
                <input type="file" name="..." id="file_but"> 
            </span>
            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 移除 </a>
        </div>
        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
            <img id="file_img" src="<?= !empty($data) ? \common\helpers\Html::src($data) : \yii\helpers\Url::to('@web/images/no.png'); ?>">
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
                    data: {imgbase64:this.result},
                    dataType: 'json',
                    beforeSend: function(){
                        
                    },
                    success: function(json){
                        if(json.boo){
                            $('#file_img').attr('src','<?=Yii::$app->params['upload']['url']?>'+json.data);
                            $('#file_ipt').val(json.data);
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
