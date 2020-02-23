<?php
if(isset($_REQUEST['submit'])){

  $age = $_REQUEST['age'];
  $income = $_REQUEST['income'];
  $using_youtube = $_REQUEST['using_youtube'];
  $channel = $_REQUEST['channel'];
  $ads_noskip = $_REQUEST['ads_noskip'];
  $ads_skip = $_REQUEST['ads_skip'];
  $pay = $_REQUEST['pay'];
  $data = array ('age,income,using_youtube,channel,ads_noskip,ads_skip,pay,class',
                    '1,2,1,2,2,2,1,no',
                    '2,1,3,2,1,3,2,yes',
                    '3,2,2,1,1,1,2,yes',
                    '2,1,3,1,2,3,3,no',
                    '2,2,2,1,1,1,1,no',
                    '1,1,2,1,2,2,2,no',
                    '3,3,3,1,2,3,1,yes',
                     $age.','.$income.','.$using_youtube.','.$channel.','.$ads_noskip.','.$ads_skip.','.$pay.',?');
    $fp = fopen('youtubedss.csv', 'w');
    foreach($data as $line){
        $val = explode(",",$line);
        fputcsv($fp, $val);
    }
    fclose($fp);

    $cmd = 'java -classpath "weka.jar" weka.core.converters.CSVLoader youtubedss.csv > youtube_un.arff';
    exec($cmd,$output);
    $cmd1 = 'java -classpath "weka.jar" weka.filters.unsupervised.attribute.NumericToNominal -i youtube_un.arff -o youtube_sucss.arff';
    exec($cmd1,$output1);
    $cmd2 = 'java -classpath "weka.jar" weka.classifiers.lazy.IBk -l "Younew.model" -T "youtube_sucss.arff" -p 8';
    exec($cmd2,$output2);
    //exec('del youtube_un.arff');
    $show=$output2[sizeof($output2)-2];
    $sub = substr($show,-7);
    $result = $show[28].$show[29].$show[30]; 
    if($result == 'yes'){
        $test = "yes";
        $d = $sub*100;
        $s = 100-$d;
    }
    else {
      $s = $sub*100;
      $d = 100-$s;
      $test = "no";
    }
    
    


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>YOUTUBE PREMIUM | ระบบช่วยสนับสนุนการตัดสินใจในการสมัคร </title>
  <link rel="icon" href="../img/icon_youtube.png">
  <link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- css -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="../css/nivo-lightbox.css" rel="stylesheet" />
  <link href="../css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
  <link href="../css/animations.css" rel="stylesheet" />
  <link href="../css/load.css" rel="stylesheet">
  <link href="../color/default.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="./style.css">
<body>
<!-- partial:index.partial.html -->
<header id="header">

    <div class="container">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an image logo -->
        <h1 class="text-danger"><a href="/" class="scrollto"><span>การตัดสินใจในการสมัครYOUTUBE</span></a></h1>
        <!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li><a href="/">หน้าหลัก</a></li>
          <li><a href="/">เกี่ยวกับงาน</a></li>
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- #header -->
  <br><br><br>
  <div class="container-fluid text-center">
  <div class="row justify-content-center">
    <div class="col-lg-8">
    <div class="card">
  <h5 class="card-header text-left bg-warning">ผลการทำนาย</h5>
  <div class="card-body">
    <h5 class="card-title">จากผลทำนายคือ </h5>
    <h1 class="text-danger"><p class="card-text"><?php 
    if($result == 'yes'){
      echo "ควรสมัคร";
    }else echo "ไม่ควรสมัคร"; 
    ?> YOUTUBE PREMIUM </p></h1>
    <p><?php 
    if($result == 'yes'){
      echo "ความน่าจะเป็นเท่ากับ :".$d.'%<br>'."หากสนใจ YOUTUBE PREMIUM ให้ไปดูได้ที่นี้ <a href=\"https://www.youtube.com/premium\">YOUTUBE PREMIUM</a> ";
    }else echo "ความน่าจะเป็นเท่ากับ :".$s.'%<br>'."แนะนำให้ดู Line TV หรือช่องทางที่สามารถดูฟรีได้โดยไม่ต้องดูโฆษณา";
    
    ?></p>
    <a href="/" class="btn btn-primary">กลับหน้าหลัก</a>
    <br><br>
    <p><i class="fa fa-pie-chart fa-1x" aria-hidden="true"  style="color: #A04E3D;"></i> : ควรสมัคร <i class="fa fa-pie-chart fa-1x" aria-hidden="true"  style="color: #6DBCDB;"></i> : ไม่ควรสมัคร  </p>
  </div>
</div>
    </div>
  </div>
</div>
<div id="doughnutChart" class="chart"></div>
<div class="loader-wrapper">
  <span class="loader"><span class="loader-inner"></span></span>
</div>
</body>
<!-- partial -->
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script><script  src="./script.js"></script>
  <script>
    $(window).on("load",function(){
      $(".loader-wrapper").fadeOut("slow");
    });
  </script>

  <script type="text/javascript">
    $(function(){
  $("#doughnutChart").drawDoughnutChart([
    { title: "ไม่ควรสมัคร",value : <?php echo $s?>,  color: "#6DBCDB" },
    { title: "ควรสมัคร", value:  <?php echo $d ?>,   color: "#A04E3D" },
  
  ]);
});
;(function($, undefined) {
  $.fn.drawDoughnutChart = function(data, options) {
    var $this = this,
      W = $this.width(),
      H = $this.height(),
      centerX = W/2,
      centerY = H/2,
      cos = Math.cos,
      sin = Math.sin,
      PI = Math.PI,
      settings = $.extend({
        segmentShowStroke : true,
        segmentStrokeColor : "#0C1013",
        segmentStrokeWidth : 1,
        baseColor: "rgba(0,0,0,0.5)",
        baseOffset: 4,
        edgeOffset : 10,//offset from edge of $this
        percentageInnerCutout : 75,
        animation : true,
        animationSteps : 90,
        animationEasing : "easeInOutExpo",
        animateRotate : true,
        tipOffsetX: -8,
        tipOffsetY: -45,
        tipClass: "doughnutTip",
        summaryClass: "doughnutSummary",
        summaryTitle: "ผลลัพท์การทำนายของคุณ",
        summaryTitleClass: "doughnutSummaryTitle",
        summaryNumberClass: "doughnutSummaryNumber",
        beforeDraw: function() {  },
        afterDrawed : function() {  },
        onPathEnter : function(e,data) {  },
        onPathLeave : function(e,data) {  }
      }, options),
      animationOptions = {
        linear : function (t) {
          return t;
        },
        easeInOutExpo: function (t) {
          var v = t<.5 ? 8*t*t*t*t : 1-8*(--t)*t*t*t;
          return (v>1) ? 1 : v;
        }
      },
      requestAnimFrame = function() {
        return window.requestAnimationFrame ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame ||
          window.oRequestAnimationFrame ||
          window.msRequestAnimationFrame ||
          function(callback) {
            window.setTimeout(callback, 1000 / 60);
          };
      }();

    settings.beforeDraw.call($this);

    var $svg = $('<svg width="' + W + '" height="' + H + '" viewBox="0 0 ' + W + ' ' + H + '" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"></svg>').appendTo($this),
        $paths = [],
        easingFunction = animationOptions[settings.animationEasing],
        doughnutRadius = Min([H / 2,W / 2]) - settings.edgeOffset,
        cutoutRadius = doughnutRadius * (settings.percentageInnerCutout / 100),
        segmentTotal = 0;

    //Draw base doughnut
    var baseDoughnutRadius = doughnutRadius + settings.baseOffset,
        baseCutoutRadius = cutoutRadius - settings.baseOffset;
    $(document.createElementNS('http://www.w3.org/2000/svg', 'path'))
      .attr({
        "d": getHollowCirclePath(baseDoughnutRadius, baseCutoutRadius),
        "fill": settings.baseColor
      })
      .appendTo($svg);

    //Set up pie segments wrapper
    var $pathGroup = $(document.createElementNS('http://www.w3.org/2000/svg', 'g'));
    $pathGroup.attr({opacity: 0}).appendTo($svg);

    //Set up tooltip
    var $tip = $('<div class="' + settings.tipClass + '" />').appendTo('body').hide(),
        tipW = $tip.width(),
        tipH = $tip.height();

    //Set up center text area
    var summarySize = (cutoutRadius - (doughnutRadius - cutoutRadius)) * 2,
        $summary = $('<div class="' + settings.summaryClass + '" />')
                   .appendTo($this)
                   .css({ 
                     width: summarySize + "px",
                     height: summarySize + "px",
                     "margin-left": -(summarySize / 2) + "px",
                     "margin-top": -(summarySize / 2) + "px"
                   });
    var $summaryTitle = $('<p class="' + settings.summaryTitleClass + '">' + settings.summaryTitle + '</p>').appendTo($summary);
    var $summaryNumber = $('<p class="' + settings.summaryNumberClass + '"></p>').appendTo($summary).css({opacity: 0}).hide();

    for (var i = 0, len = data.length; i < len; i++) {
      segmentTotal += data[i].value;
      $paths[i] = $(document.createElementNS('http://www.w3.org/2000/svg', 'path'))
        .attr({
          "stroke-width": settings.segmentStrokeWidth,
          "stroke": settings.segmentStrokeColor,
          "fill": data[i].color,
          "data-order": i
        })
        .appendTo($pathGroup)
        .on("mouseenter", pathMouseEnter)
        .on("mouseleave", pathMouseLeave)
        .on("mousemove", pathMouseMove);
    }

    //Animation start
    animationLoop(drawPieSegments);

    //Functions
    function getHollowCirclePath(doughnutRadius, cutoutRadius) {
        //Calculate values for the path.
        //We needn't calculate startRadius, segmentAngle and endRadius, because base doughnut doesn't animate.
        var startRadius = -1.570,// -Math.PI/2
            segmentAngle = 6.2831,// 1 * ((99.9999/100) * (PI*2)),
            endRadius = 4.7131,// startRadius + segmentAngle
            startX = centerX + cos(startRadius) * doughnutRadius,
            startY = centerY + sin(startRadius) * doughnutRadius,
            endX2 = centerX + cos(startRadius) * cutoutRadius,
            endY2 = centerY + sin(startRadius) * cutoutRadius,
            endX = centerX + cos(endRadius) * doughnutRadius,
            endY = centerY + sin(endRadius) * doughnutRadius,
            startX2 = centerX + cos(endRadius) * cutoutRadius,
            startY2 = centerY + sin(endRadius) * cutoutRadius;
        var cmd = [
          'M', startX, startY,
          'A', doughnutRadius, doughnutRadius, 0, 1, 1, endX, endY,//Draw outer circle
          'Z',//Close path
          'M', startX2, startY2,//Move pointer
          'A', cutoutRadius, cutoutRadius, 0, 1, 0, endX2, endY2,//Draw inner circle
          'Z'
        ];
        cmd = cmd.join(' ');
        return cmd;
    };
    function pathMouseEnter(e) {
      var order = $(this).data().order;
      $tip.text(data[order].title + ": " + data[order].value)
          .fadeIn(200);
      settings.onPathEnter.apply($(this),[e,data]);
    }
    function pathMouseLeave(e) {
      $tip.hide();
      settings.onPathLeave.apply($(this),[e,data]);
    }
    function pathMouseMove(e) {
      $tip.css({
        top: e.pageY + settings.tipOffsetY,
        left: e.pageX - $tip.width() / 2 + settings.tipOffsetX
      });
    }
    function drawPieSegments (animationDecimal) {
      var startRadius = -PI / 2,//-90 degree
          rotateAnimation = 1;
      if (settings.animation && settings.animateRotate) rotateAnimation = animationDecimal;//count up between0~1

      drawDoughnutText(animationDecimal, segmentTotal);

      $pathGroup.attr("opacity", animationDecimal);

      //If data have only one value, we draw hollow circle(#1).
      if (data.length === 1 && (4.7122 < (rotateAnimation * ((data[0].value / segmentTotal) * (PI * 2)) + startRadius))) {
        $paths[0].attr("d", getHollowCirclePath(doughnutRadius, cutoutRadius));
        return;
      }
      for (var i = 0, len = data.length; i < len; i++) {
        var segmentAngle = rotateAnimation * ((data[i].value / segmentTotal) * (PI * 2)),
            endRadius = startRadius + segmentAngle,
            largeArc = ((endRadius - startRadius) % (PI * 2)) > PI ? 1 : 0,
            startX = centerX + cos(startRadius) * doughnutRadius,
            startY = centerY + sin(startRadius) * doughnutRadius,
            endX2 = centerX + cos(startRadius) * cutoutRadius,
            endY2 = centerY + sin(startRadius) * cutoutRadius,
            endX = centerX + cos(endRadius) * doughnutRadius,
            endY = centerY + sin(endRadius) * doughnutRadius,
            startX2 = centerX + cos(endRadius) * cutoutRadius,
            startY2 = centerY + sin(endRadius) * cutoutRadius;
        var cmd = [
          'M', startX, startY,//Move pointer
          'A', doughnutRadius, doughnutRadius, 0, largeArc, 1, endX, endY,//Draw outer arc path
          'L', startX2, startY2,//Draw line path(this line connects outer and innner arc paths)
          'A', cutoutRadius, cutoutRadius, 0, largeArc, 0, endX2, endY2,//Draw inner arc path
          'Z'//Cloth path
        ];
        $paths[i].attr("d", cmd.join(' '));
        startRadius += segmentAngle;
      }
    }
    function drawDoughnutText(animationDecimal, segmentTotal) {
      $summaryNumber
        .css({opacity: animationDecimal})
        .text((segmentTotal * animationDecimal).toFixed(1));
    }
    function animateFrame(cnt, drawData) {
      var easeAdjustedAnimationPercent =(settings.animation)? CapValue(easingFunction(cnt), null, 0) : 1;
      drawData(easeAdjustedAnimationPercent);
    }
    function animationLoop(drawData) {
      var animFrameAmount = (settings.animation)? 1 / CapValue(settings.animationSteps, Number.MAX_VALUE, 1) : 1,
          cnt =(settings.animation)? 0 : 1;
      requestAnimFrame(function() {
          cnt += animFrameAmount;
          animateFrame(cnt, drawData);
          if (cnt <= 1) {
            requestAnimFrame(arguments.callee);
          } else {
            settings.afterDrawed.call($this);
          }
      });
    }
    function Max(arr) {
      return Math.max.apply(null, arr);
    }
    function Min(arr) {
      return Math.min.apply(null, arr);
    }
    function isNumber(n) {
      return !isNaN(parseFloat(n)) && isFinite(n);
    }
    function CapValue(valueToCap, maxValue, minValue) {
      if (isNumber(maxValue) && valueToCap > maxValue) return maxValue;
      if (isNumber(minValue) && valueToCap < minValue) return minValue;
      return valueToCap;
    }
    return $this;
  };
})(jQuery);
</script>
</body>
</html>
