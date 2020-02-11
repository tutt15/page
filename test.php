<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
    <script>
      $(function() {
        $("#draggable").draggable();
      });
    </script>
    <div id="draggable" class="ui-widget-content">
      <p>Drag me around</p>
    </div>
</body>
</html>