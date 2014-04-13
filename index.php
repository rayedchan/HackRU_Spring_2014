<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script language="javascript" type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script language="javascript" type="text/javascript" src="js/httpGet.js"></script>
        <script language="javascript" type="text/javascript" src="js/xmlToJSON.js"></script>
        <script language="javascript" type="text/javascript" src="js/jquery.xml2json.js"></script>
        <script language="javascript" type="text/javascript" src="js/ObjTree.js"></script>
        <title>Google Maps Rutgers</title>
        <script type="text/javascript">
            
            $(document).ready(function()
            {
                // Uses API from Rutgers to get bus routes; Gets String representation of XML 
                var xmlBusRoutesRequest = httpGet("http://webservices.nextbus.com/service/publicXMLFeed?a=rutgers&command=routeConfig");
                //console.log(xmlBusRoutesRequest);

                // Converts String to Document Object
                var xmlDoc = jQuery.parseXML(xmlBusRoutesRequest);
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
                // console.log(json['route']);
                // console.log(json['route'][0]['path'][0]['point']);
                
                
                var geometry = {};
                
                // Construct an entire route by connecting all the given paths 
                var route = json['route'][0]['path'];                  
                var coordinates = []; // Add all the coordinates in a given route
                var pointPairCount = 0; // Index counter for all coordinates
                
                for(var j = 0; j < route.length; j++)
                {
                    // Build list of coordinates for a single path
                    var path = route[j]['point'];
                    
                    // Iterate each point within a path
                    for(var i = 0; i < path.length; i++)
                    {
                        var lat = path[i]['lat'];
                        var lon = path[i]['lon'];
                        var point = [Number(lat), Number(lon)];
                        coordinates[pointPairCount++] = point;
                    }
                }
                
                geometry['type'] = "LineString";
                geometry['coordinates'] = coordinates; // Wrap coordinates within geometry object
                
                console.log(coordinates.length);
                console.log(coordinates);
                console.log(JSON.stringify(geometry));
            });
            
        </script>
    </head>
    <body>
        
    </body>
</html>
