HackRU_Spring_2014
==================
This github project was developed during the 'HackRU Spring 2014' event at Rutgers University by Ray Chan and Daniel Stroh.

In this prof of concept is implemented a web application that provides an interactive map of the campus of Rutgers University.
The map makes extensive use of the Google Maps API. The underlying map data is customized and on top are placed bus routes. Data about the bus routes is retrieved through the Netbus public API. Calls to that API return data in XML format. This XML data is converted within the web application into GeoJSON format. This data can be imported into Google Maps API and rendered as bus routes. The web application is developed using PHP and Javascript, as of now no database is needed in the backend.

This web application holds a lot of possibilities for further development.
* The current bus routes will be updated to provide information on current bus position tracking. 
* It is planned to offer update on parking lot status, i.e. closure, event parking and so on.
* The map abilities will be extended to offer:
  * search functionalities, i.e. it will be possible to search events and locations; and 
  * social interaction, i.e. People can rate dining hall food and share their latest HackRU experiences.
* Transfer the map to mobile devices.
* Guarantee modularity in such an amount that the web application can be used for other  underlying data, i.e. other university maps or other scenarios like a map for a mall or an amusement park.

Note: The first implementation approach using Java has been halted (dev branch) and the POF development has been continued in the master branch.
