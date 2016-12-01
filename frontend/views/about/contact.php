<?php \frontend\assets\ContactAsset::register($this);?>


<div class="c-content-contact-1 c-opt-1">
    <div class="row" data-auto-height=".c-height">
        <div class="col-lg-8 col-md-6 c-desktop"></div>
        <div class="col-lg-4 col-md-6">
            <div class="c-body">
                <div class="c-section">
                    <h3>深圳xxx有限公司</h3>
                </div>
                <div class="c-section">
                    <div class="c-content-label uppercase bg-blue">地址</div>
                    <p>英龙大厦xxx-120，深圳分部<br/>天河大道xxx号，广州分部<br/>人民路xxx号，北京分部</p>
                </div>
                <div class="c-section">
                    <div class="c-content-label uppercase bg-blue">联系方式</div>
                    <p>
                        <strong>电话</strong> 136xxxx1245
                        <br/>
                        <strong>邮箱</strong> phphome@qq.com</p>
                </div>
                <div class="c-section">
                    <div class="c-content-label uppercase bg-blue">社交网站</div>
                    <br/>
                    <ul class="c-content-iconlist-1 ">
                        <li style="padding: 0 5px 5px;">
                            <a href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li style="padding: 0 5px 5px;">
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li style="padding: 0 5px 5px;">
                            <a href="#">
                                <i class="fa fa-youtube-play"></i>
                            </a>
                        </li>
                        <li style="padding: 0 5px 5px;">
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="gmapbg" class="c-content-contact-1-gmap" style="height: 615px;"></div>
</div>
<div class="c-content-feedback-1 c-option-1">
    <div class="row">
        <div class="col-md-6">
            <div class="c-container bg-green">
                <div class="c-content-title-1 c-inverse">
                    <h3 class="uppercase">查看更多信息?</h3>
                    <div class="c-line-left"></div>
                    <p class="c-font-lowercase">另外，为了让组件可以在创建实例时能被正确配置，请遵照以下操作流程。</p>
                    <button class="btn grey-cararra font-dark">查看更多</button>
                </div>
            </div>
            <div class="c-container bg-grey-steel">
                <div class="c-content-title-1">
                    <h3 class="uppercase">有什么能帮助你的?</h3>
                    <div class="c-line-left bg-dark"></div>
                    <form action="#">
                        <div class="input-group input-group-lg c-square">
                            <input type="text" class="form-control c-square" placeholder="" />
                            <span class="input-group-btn">
                                <button class="btn uppercase" type="button">Go!</button>
                            </span>
                        </div>
                    </form>
                    <p>尽管调用 Yii::createObject() 的方法看起来更加复杂， 但这主要因为它更加灵活强大，它是基于依赖注入容器实现的。</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="c-contact">
                <div class="c-content-title-1">
                    <h3 class="uppercase">留言</h3>
                    <div class="c-line-left bg-dark"></div>
                    <p class="c-font-lowercase">我们的服务热线始终是开放的接受任何调查或反馈。请随时给我们留言，我们会尽快回复您。</p>
                </div>
                <form action="#">
                    <div class="form-group">
                        <input type="text" placeholder="姓名" class="form-control input-md"> </div>
                    <div class="form-group">
                        <input type="text" placeholder="邮箱" class="form-control input-md"> </div>
                    <div class="form-group">
                        <input type="text" placeholder="联系电话" class="form-control input-md"> </div>
                    <div class="form-group">
                        <textarea rows="8" name="message" placeholder="你想要说什么？" class="form-control input-md"></textarea>
                    </div>
                    <button type="submit" class="btn grey">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('http://api.map.baidu.com/api?v=2.0&ak=LwBmuc22Mn7sZHWhrqGs2H8dfU1pLIhL', ['depends'=>['backend\assets\CoreAsset']]);?>
<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
    $(function(){
        // 百度地图API功能
        var map = new BMap.Map("gmapbg");
        var point = new BMap.Point(114.029706 ,22.540461);
        map.centerAndZoom(point,12);
        // 创建地址解析器实例
        var myGeo = new BMap.Geocoder();
        // 将地址解析结果显示在地图上,并调整地图视野
        myGeo.getPoint("深圳英龙大厦", function(point){
            if (point) {
                map.centerAndZoom(point, 16);
                map.addOverlay(new BMap.Marker(point));
            }else{
                alert("您选择地址没有解析到结果!");
            }
        }, "深圳市");
    });
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>