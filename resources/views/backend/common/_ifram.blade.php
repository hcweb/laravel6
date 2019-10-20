<script src="{{asset('backend/assets/libs/DetectElementResize/detect-element-resize.js')}}"></script>
<script>
    var resizeElement = document.body;
    addResizeListener(resizeElement, function () {
        // setTimeout(function () {
        //     parent.setHeight();
        // },1);
        parent.setHeight();
    });
</script>
