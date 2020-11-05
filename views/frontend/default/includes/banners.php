<!-- Banner End -->
<?php
if(isset($Main_Banners) && !empty($Main_Banners)){

  if(count($Main_Banners)>1){

?>
<div class="container t-banner">
  <div class="row">

  <script type="text/javascript">
        banner_slider_init = function() {
            var banner_slider_SlideoTransitions = [{$Duration:500,$Delay:30,$Cols:8,$Rows:4,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2049,$Easing:$Jease$.$OutQuad},
              {$Duration:500,$Delay:80,$Cols:8,$Rows:4,$Clip:15,$SlideOut:true,$Easing:$Jease$.$OutQuad},
              {$Duration:1000,x:-0.2,$Delay:40,$Cols:12,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5}},
              {$Duration:2000,y:-1,$Delay:60,$Cols:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:$Jease$.$OutJump,$Round:{$Top:1.5}},
              {$Duration:1200,x:0.2,y:-0.1,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}
            ];

            var banner_slider_options = {
              $AutoPlay: 1,
              $Loop: 0,
                $DragOrientation: 3,
                $SlideDuration: 500,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: banner_slider_SlideoTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              },
              $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$,
                    $ChanceToShow: 2,
                    $AutoCenter: 1,
                    $Steps: 1,
                    $Rows: 1,
                    $SpacingX: 10,
                    $SpacingY: 10,
                    $Orientation: 1
                }
            };


            var banner_slider = new $JssorSlider$("banner_slider", banner_slider_options);

            function ScaleSlider() {
                var refSize = banner_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1140);
                    banner_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);

            var progressElement = document.getElementById("progress-element");

            function ProgressChangeEventHandler(slideIndex, progress, progressBegin, idleBegin, idleEnd, progressEnd) {

                if (progressEnd > 0) {
                    var progressPercent = progress / progressEnd * 100 + "%";
                    progressElement.style.width = progressPercent;
                }
            }

            banner_slider.$On($JssorSlider$.$EVT_PROGRESS_CHANGE, ProgressChangeEventHandler);
        };
    </script>


<div id="banner_slider" style="position:relative;margin:0 auto;top:0px;left:0px;width:1140px;height:500px;overflow:hidden;visibility:hidden;">

        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.SHONiR_SETTINGS['config_loader'];?>" />
        </div>

        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1140px;height:500px;overflow:hidden;">
        <?php
$SHONiR_Y = 0;
foreach ($Main_Banners as $Banner_key => $Banner_value)
{ $SHONiR_Y++;
?>
            <div>
            <?php echo ($Banner_value['link'])?'<a target="_blank" href="'.SHONiR_BASE.'Go/Br/'.$Banner_value['banner_id'].'">':''; ?> <img src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$Banner_value['image'] ?>"  alt="<?php echo $Banner_value['name'] ?>"><?php echo ($Banner_value['link'])?'</a>':''; ?>
            </div>
            <?php }?>

            <div id="progress-element" data-u="progress" style="position: absolute; left: 0; bottom: 8px; width: 0%; height: 3px; background-color: rgba(255,255,255,0.7); z-index: 100;"></div>
        </div>

        <style>
            .jssora082 {display:block;position:absolute;cursor:pointer;}
            .jssora082 .c {fill:#fff;fill-opacity:.5;stroke:#000;stroke-width:160;stroke-miterlimit:10;stroke-opacity:0.3;}
            .jssora082 .a {fill:#000;opacity:.8;}
            .jssora082:hover .c {fill-opacity:.3;}
            .jssora082:hover .a {opacity:1;}
            .jssora082.jssora082dn {opacity:.5;}
            .jssora082.jssora082ds {opacity:.3;pointer-events:none;}
            .jssorb061 {position:absolute;}
            .jssorb061 .i {position:absolute;cursor:pointer;}
            .jssorb061 .i .b {fill:#0bb3a6;stroke:#84e1da;stroke-width:400;stroke-miterlimit:10;stroke-opacity:0.5;}
            .jssorb061 .i:hover .b {fill-opacity:.7;}
            .jssorb061 .iav .b {fill:#fc6b6d;stroke:#d57d7f;stroke-opacity:.7;stroke-width:2000;}
            .jssorb061 .i.idn {opacity:.3;}
        </style>
         <div data-u="navigator" class="jssorb061" style="bottom:16px;right:16px;">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800" />
                </svg>
            </div>
        </div>
     <div data-u="arrowleft" class="jssora082" style="width:30px;height:40px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewBox="2000 0 12000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="c" d="M4800,14080h6400c528,0,960-432,960-960V2880c0-528-432-960-960-960H4800c-528,0-960,432-960,960 v10240C3840,13648,4272,14080,4800,14080z"></path>
                <path class="a" d="M6860.8,8102.7l1693.9,1693.9c28.9,28.9,63.2,43.4,102.7,43.4s73.8-14.5,102.7-43.4l379-379 c28.9-28.9,43.4-63.2,43.4-102.7c0-39.6-14.5-73.8-43.4-102.7L7926.9,8000l1212.2-1212.2c28.9-28.9,43.4-63.2,43.4-102.7 c0-39.6-14.5-73.8-43.4-102.7l-379-379c-28.9-28.9-63.2-43.4-102.7-43.4s-73.8,14.5-102.7,43.4L6860.8,7897.3 c-28.9,28.9-43.4,63.2-43.4,102.7S6831.9,8073.8,6860.8,8102.7L6860.8,8102.7z"></path>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora082" style="width:30px;height:40px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewBox="2000 0 12000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="c" d="M11200,14080H4800c-528,0-960-432-960-960V2880c0-528,432-960,960-960h6400 c528,0,960,432,960,960v10240C12160,13648,11728,14080,11200,14080z"></path>
                <path class="a" d="M9139.2,8102.7L7445.3,9796.6c-28.9,28.9-63.2,43.4-102.7,43.4c-39.6,0-73.8-14.5-102.7-43.4 l-379-379c-28.9-28.9-43.4-63.2-43.4-102.7c0-39.6,14.5-73.8,43.4-102.7L8073.1,8000L6860.8,6787.8 c-28.9-28.9-43.4-63.2-43.4-102.7c0-39.6,14.5-73.8,43.4-102.7l379-379c28.9-28.9,63.2-43.4,102.7-43.4 c39.6,0,73.8,14.5,102.7,43.4l1693.9,1693.9c28.9,28.9,43.4,63.2,43.4,102.7S9168.1,8073.8,9139.2,8102.7L9139.2,8102.7z"></path>
            </svg>
        </div>

    </div>
    <script type="text/javascript">banner_slider_init();</script>

</div>
</div>
<?php }else{
?>


<div class="container t-banner">
  <div class="row">
  <?php echo ($Main_Banners[0]['link'])?'<a target="_blank" href="'.SHONiR_BASE.'Go/Br/'.$Main_Banners[0]['banner_id'].'">':''; ?> <img class="img-fluid" src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$Main_Banners[0]['image'] ?>"  alt="<?php echo $Main_Banners[0]['name'] ?>"><?php echo ($Main_Banners[0]['link'])?'</a>':''; ?>
    </div>
</div>

<?php

}

}?>
   <!-- Banner End -->

