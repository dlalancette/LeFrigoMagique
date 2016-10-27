<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>BootStrap Example</title>

        <link rel="stylesheet" href="Style/bootstrap.min.css">
        <link rel="stylesheet" href="Style/Style2.css">

        <script type="text/javascript" src="Scripts/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
        <script type="text/javascript" src="Scripts/jquery.select2.js"></script>

        <script>
            $(function(){
              // turn the element to select2 select style
                $('#e1').select2();
            });
        </script>

    </head>
    <body>
        <select multiple id="e1" style="width:300px">
            <option value="AL">Alabama</option>
            <option value="Am">Amalapuram</option>
            <option value="An">Anakapalli</option>
            <option value="Ak">Akkayapalem</option>
            <option value="WY">Wyoming</option>
        </select>

    </body>


</html>