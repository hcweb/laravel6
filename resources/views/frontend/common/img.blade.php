<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('system_config.site_title')}}</title>
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <style>
        body {background: #333;}
        #pageContent {width: 100%;	height: 100vh;overflow: hidden;position:relative;}
        #imgContainer {width: 100%;	height: 100vh;}
        #positionButtonDiv {background: rgb(58, 56, 63);background: rgba(58, 56, 63, 0.8);border: solid 1px #100000;color: #fff;padding: 8px;text-align: left;position: absolute;right:35px;top:35px;}
        #positionButtonDiv .positionButtonSpan img {float: right;border: 0;}
        .positionMapClass area {cursor: pointer;}
        .zoomButton {border: 0;	cursor: pointer;}
    </style>
</head>
<body>
<div id="pageContent">
    <div id="imgContainer">
        <img id="imageFullScreen" src="{{$path}}"/>
    </div>
    <div id="positionButtonDiv">
        <p>
            <span>
                <img id="zoomInButton" class="zoomButton" src="{{asset('frontend/zoom/images/zoomIn.png')}}" title="zoom in" alt="zoom in" />
                <img id="zoomOutButton" class="zoomButton" src="{{asset('frontend/zoom/images/zoomOut.png')}}" title="zoom out" alt="zoom out" />
            </span>
        </p>
        <p>
        <span class="positionButtonSpan">
			<map name="positionMap" class="positionMapClass">
				<area id="topPositionMap" shape="rect" coords="20,0,40,20" title="move up" alt="move up"/>
                <area id="leftPositionMap" shape="rect" coords="0,20,20,40" title="move left" alt="move left"/>
				<area id="rightPositionMap" shape="rect" coords="40,20,60,40" title="move right" alt="move right"/>
				<area id="bottomPositionMap" shape="rect" coords="20,40,40,60" title="move bottom" alt="move bottom"/>
			</map>
			<img src="{{asset('frontend/zoom/images/position.png')}}" usemap="#positionMap" />
         </span>
        </p>
    </div>
</div>
<script type="text/javascript" src="{{asset('frontend/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/zoom/js/e-smart-zoom-jquery.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#imageFullScreen').smartZoom({'containerClass':'zoomableContainer'});
        $('#topPositionMap,#leftPositionMap,#rightPositionMap,#bottomPositionMap').bind("click", moveButtonClickHandler);
        $('#zoomInButton,#zoomOutButton').bind("click", zoomButtonClickHandler);

        function zoomButtonClickHandler(e){
            var scaleToAdd = 0.8;
            if(e.target.id == 'zoomOutButton')
                scaleToAdd = -scaleToAdd;
            $('#imageFullScreen').smartZoom('zoom', scaleToAdd);
        }
        function moveButtonClickHandler(e){
            var pixelsToMoveOnX = 0;
            var pixelsToMoveOnY = 0;

            switch(e.target.id){
                case "leftPositionMap":
                    pixelsToMoveOnX = 50;
                    break;
                case "rightPositionMap":
                    pixelsToMoveOnX = -50;
                    break;
                case "topPositionMap":
                    pixelsToMoveOnY = 50;
                    break;
                case "bottomPositionMap":
                    pixelsToMoveOnY = -50;
                    break;
            }
            $('#imageFullScreen').smartZoom('pan', pixelsToMoveOnX, pixelsToMoveOnY);
        }
    });
</script>
</body>
</html>
