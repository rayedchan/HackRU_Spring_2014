<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script language="javascript" type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/xmlToJSON.js"></script>
        <script language="javascript" type="text/javascript" src="js/jquery.xml2json.js"></script>
        <script language="javascript" type="text/javascript" src="js/ObjTree.js"></script>
        <title>Google Maps Rutgers</title>
        <script type="text/javascript">
            function httpGet(theUrl)
            {
                var xmlHttp = null;
                xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", theUrl, false );
                xmlHttp.send( null );
                return xmlHttp.responseText;
            }
            
                 
            $(document).ready(function()
            {
                // Uses API from Rutgers to get bus routes 
                var xmlBusRoutesRequest = httpGet("http://webservices.nextbus.com/service/publicXMLFeed?a=rutgers&command=routeConfig");
                console.log(xmlBusRoutesRequest);

                //var xmlDoc = jQuery.parseXML(xmlBusRoutesRequest);
                //console.log(xmlDoc);

                // -- Function from StackOverFlow --
                // console.log(xmlToJson(xmlDoc));
                // var jsonText = JSON.stringify(xmlToJson(xmlDoc));
                // console.log(jsonText);
                
                // -- XML2JSON + JQuery --
                var json = $.xml2json(xmlBusRoutesRequest); // Parses XML String into JSON object
                console.log(json);
                
                // -- Pure JavaScript ObjTree --
                // var xotree = new XML.ObjTree();
                // var tree = xotree.parseXML(xmlBusRoutesRequest); // source to tree
                // console.log(tree);
                
                
                // console.log(JSON.stringify(json));
                
            });
            
        </script>
    </head>
    <body>
        
    </body>
</html>
