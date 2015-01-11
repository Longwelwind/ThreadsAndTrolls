<!DOCTYPE html>
<html>
<head lang="en">
    <base href="/" />
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="http://fastly.ink.sapo.pt/3.1.2/css/ink.css">
    <script type="text/javascript" src="http://fastly.ink.sapo.pt/3.1.2/js/ink-all.js"></script>
    <title>Threads & Trolls</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="container" class="ink-grid">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

    <div style="height:30px"></div>
    <div class="column-group">
        <div class="all-100">
            <h2 style="margin-bottom: 10px;">Threads & Trolls <small>v1.0</small></h2>
        </div>
    <?php include($templatePart . ".php"); ?>
    </div>

    <script>
        $(".tt").each(function(index) {

            var element = $(this);

            var ttContentId = element.attr("data-tooltip-template");
            var ttContentElement = $(ttContentId);

            ttContentElement.hide();

            var position = element.position();
            position.top += element.height() + 5;
            //position.left += element.width();
            ttContentElement.css(position);

            element.mouseenter(function() {

                ttContentElement.show();

            });

            element.mouseleave(function() {

                ttContentElement.hide();

            });

        })
    </script>
</div>
</body>
</html>