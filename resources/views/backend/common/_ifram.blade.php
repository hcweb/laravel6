<script src="{{asset('backend/plugins/DetectElementResize/detect-element-resize.js')}}"></script>
<script>
    var resizeElement = document.body;
    addResizeListener(resizeElement, function () {
        // setTimeout(function () {
        //     parent.setHeight();
        // },1);
        parent.setHeight();
    });
</script>
