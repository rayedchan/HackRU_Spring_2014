<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <style type="text/css">
          html { height: 100% }
          body { height: 100%; margin: 0; padding: 0 }
          #map-canvas { height: 100% }
        </style>
        <script type="text/javascript"
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnDgFGCzZLZwBCl4r45NKW8ylutfW93rM&sensor=false">
        </script>
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
                
                var pathLine = {};
                var features = [];
 
                // Construct an entire route by connecting all the given paths 
                var route = json['route'][0]['path'];                  
                
                // Iterate each path in a given route
                for(var j = 0; j < route.length; j++)
                {    
                    var path = route[j]['point']; // Single path in a given route
                    var featureInst = {}; // Wrap type and geometry
                    var geometry = {}; // Wrap type and coordinates
                    var coordinates = []; // Add all coordinates in a given path
                    
                    // Iterate each point within a path
                    for(var i = 0; i < path.length; i++)
                    {
                        var lat = path[i]['lat'];
                        var lon = path[i]['lon'];
                        var point = [Number(lon), Number(lat)]; // GeoJson Google Parser: Lon , Lat
                        coordinates[i] = point;
                    }
                                    
                    geometry['type'] = "LineString";
                    geometry['coordinates'] = coordinates; // Wrap coordinates within geometry object
                
                    // Create properties for feature instance
                    var properties = {};
                    properties['color'] = "red";
                
                    featureInst['type'] = "Feature";
                    featureInst['properties'] = properties;
                    featureInst['geometry'] = geometry;
                    
                    features.push(featureInst); // Add item to end of array
                }
                
                pathLine['type'] = "FeatureCollection";
                pathLine['features'] = features;

                //console.log(coordinates.length);
                console.log(pathLine);
                console.log(JSON.stringify(pathLine));
                
                // Google Map
                function initialize() 
                {
                    var mapOptions = {
                      center: new google.maps.LatLng(40.49957, -74.44824),
                      zoom: 18
                    };
                    var map = new google.maps.Map(document.getElementById("map-canvas"),
                        mapOptions);
                        
                    // Fixed line color                     
                    /*var featureStyle = {
                        strokeColor: 'red',
                        strokeWeight: 1
                    }
                    map.data.setStyle(featureStyle);*/
                
                
                     map.data.setStyle(function(feature) 
                     {
                        return {
                          strokeColor: feature.getProperty('color'),
                          strokeWeight: 1
                        };
                     });


                    //Load a GeoJSON from the same server as our demo.
                    map.data.loadGeoJson('json/samplePath.json');
                }

		google.maps.event.addDomListener(window, 'load', initialize);   
            });
            
        </script>
    </head>
    <body>
         <div id="map-canvas"/>
    </body>
</html>
