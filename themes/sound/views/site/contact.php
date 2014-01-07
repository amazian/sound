<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<style>
    .map {
        background: url("<?php echo Yii::app()->theme->baseUrl; ?>/img/map.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
        float: right;
        height: 255px;
        margin: 3px 6px 0 0;
        padding: 11px 0 0 12px;
        position: relative;
        width: 454px;
    }

    .map .map_icon {
        left: 15px;
        position: absolute;
        top: -2px;
    }
</style>

<div class="span12">
    <div class="page-header">
        <h1>Contact 聯絡我們</h1>
    </div>

    <div class="row">
        <div class="span6">
            <legend>佑昇音響有限公司</legend>
            <p>台北市八德路一段五之二號一樓</p>
            <p>TEL:(02)23939677</p>
            <p>FAX:(02)23939667</p>
            <p>請留下您的問題內容與資料</p>
            <p>我們盡快為您解答</p>
            <br />
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/image8.jpg" />
        </div>
        <div class="span6">
            <div class="map">
                <img class="map_icon" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icon8.png">
                <iframe width="443" scrolling="no" height="225" frameborder="0" src="http://maps.google.com.tw/maps?hl=zh-TW&amp;q=%E5%8F%B0%E5%8C%97%E5%B8%82%E5%85%AB%E5%BE%B7%E8%B7%AF%E4%B8%80%E6%AE%B5%E4%BA%94%E4%B9%8B%E4%BA%8C%E8%99%9F%E4%B8%80%E6%A8%93&amp;ie=UTF8&amp;hq=&amp;hnear=100%E5%8F%B0%E5%8C%97%E5%B8%82%E4%B8%AD%E6%AD%A3%E5%8D%80%E5%85%AB%E5%BE%B7%E8%B7%AF%E4%B8%80%E6%AE%B55-2%E8%99%9F&amp;t=m&amp;z=14&amp;brcurrent=3,0x3442a99bd1adbcc7:0xc5ab69bb7491162a,0,0x3442ac6b61dbbd9d:0xc0c243da98cba64b&amp;ll=25.043945,121.530516&amp;output=embed" marginwidth="0" marginheight="0"></iframe>
                <br><small><a style="margin-top:-3px; line-height:18px;" href="http://maps.google.com.tw/maps?hl=zh-TW&amp;q=%E5%8F%B0%E5%8C%97%E5%B8%82%E5%85%AB%E5%BE%B7%E8%B7%AF%E4%B8%80%E6%AE%B5%E4%BA%94%E4%B9%8B%E4%BA%8C%E8%99%9F%E4%B8%80%E6%A8%93&amp;ie=UTF8&amp;hq=&amp;hnear=100%E5%8F%B0%E5%8C%97%E5%B8%82%E4%B8%AD%E6%AD%A3%E5%8D%80%E5%85%AB%E5%BE%B7%E8%B7%AF%E4%B8%80%E6%AE%B55-2%E8%99%9F&amp;t=m&amp;z=14&amp;brcurrent=3,0x3442a99bd1adbcc7:0xc5ab69bb7491162a,0,0x3442ac6b61dbbd9d:0xc0c243da98cba64b&amp;ll=25.043945,121.530516&amp;source=embed">檢視較大的地圖</a></small>
            </div>
        </div>
    </div>

</div>