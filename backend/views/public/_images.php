<!-- image表图集 -->
<?php
/* 图集处理 */
$albums = array();
if (!empty($data)) {
    $albums = explode(',', $data);
}
?>
<style>
.fileupload-item {width: 100px; height: 100px;position: relative;margin-right:5px;}
.fileupload-del {position: absolute;bottom:5px;left:40%;display:none;}
.fileupload-text {color: #f00;}
</style>
<div class="form-group">
    <div>
        <label><?=isset($title)?$title:'商品图集'?></label>
        <span class="help-inline"><?=isset($tishi)?'（'.$tishi.'）':''?></span>
    </div>

    <div class="fileinput fileinput-new" >
        <div style="margin-bottom:10px;">
            <span class="btn red btn-outline btn-file">
                <span class="fileupload-new">上传图片</span>
                <input type="file" id="uploadImages" class="default" />
            </span>
        </div>
        <div class="fileupload-list">
            <?php if($albums && is_array($albums)): ?>
            <?php foreach($albums as $g): ?>
                <div class="fileupload-item thumbnail">
                    <img src="<?=\common\helpers\Html::src($g)?>" />
                    <span class="fileupload-del">删除</span>
                    <input type="hidden" name="<?=$field?>[]" value="<?=$g?>" />
                </div>
            <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>

</div>

<?php
/* 上传框CSS */
$this->registerCssFile('@web/metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');
?>

<!-- 定义数据块 -->
<?php $this->beginBlock('images'); ?>

$(function() {
    /* ======================图集js========================= */
    $('.fileupload-item').bind('mouseover mouseout',function(e){
        if (event.type == 'mouseover') {
            $(this).find('span').css('display','block');
        } else {
            $(this).find('span').css('display','none');
        }
    });
    $('.fileupload-del').bind('click',function(e){
        $(this).parent().remove();
    });
    $("#uploadImages").on("change", function(){
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
                        $('.fileupload-text').html('上传中...');
                    },
                    success: function(json){
                        if(json.boo){
                            var html  = '';
                                html += '<div class="fileupload-item thumbnail">';
                                html += '    <img src="<?=Yii::$app->params['upload']['url']?>'+ json.data +'" />';
                                html += '    <span class="fileupload-del">删除</span>';
                                html += '    <input type="hidden" name="<?=$field?>[]" value="'+json.data+'" />';
                                html += '</div>';
                            $('.fileupload-list').append(html);
                            $('.fileupload-text').html('上传成功');
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
<?php $this->registerJs($this->blocks['images'], \yii\web\View::POS_END); ?>