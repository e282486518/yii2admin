<?php \frontend\assets\CcsliderAsset::register($this);?>

<div id="slider" style="margin-top: 10px;margin-bottom: 10px;">
    <img src="/static/images/assassins1.jpg" alt="第一张幻灯片" data-transition='{"effect": "cubeUp", "slices": 9, "animSpeed": 1200, "delay": 100, "delayDir": "fromCentre", "easing": "easeInOutBack", "depthOffset": 300, "sliceGap": 30}' />
    <img src="/static/images/assassins2.jpg" alt="第二张幻灯片" data-transition='{"effect": "cubeRight", "slices": 5, "delay": 200}' />
    <img src="/static/images/assassins1.jpg" alt="第三张幻灯片" data-href="https://google.com" data-transition='{"effect": "cubeDown", "slices": 15, "animSpeed": 3000, "delay": 30, "easing": "easeInOutElastic", "depthOffset": 200, "sliceGap": 20}' />
    <img src="/static/images/assassins2.jpg" alt="第四张幻灯片" data-transition='{"effect": "cubeLeft", "slices": 5, "delay": 200, "delayDir": "toCentre"}' />
    <img src="/static/images/assassins1.jpg" alt="第五张幻灯片" data-transition='{"effect": "cubeUp", "slices": 5, "animSpeed": 1300, "delay": 100, "easing": "easeInOutCubic", "depthOffset": 500, "sliceGap": 50}' />
    <img src="/static/images/assassins2.jpg" alt="第六张幻灯片" data-transition='{"effect": "cubeRight", "slices": 5, "delay": 200, "delayDir": "last-first"}' />
</div>

<div class="note note-info">
    <p> 这是一个空的，自定义的页面。 </p>
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>


    <!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
    $(function(){

        $('#slider').ccslider({
            _3dOptions: {
                imageWidth: 1150,
                imageHeight: 400
            }
        });

    });
<?php $this->endBlock() ?>
    <!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>