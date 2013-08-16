BookmarksManager
================

A service written in PHP that allows client to bookmark geographical locations. Each bookmark is identified by latitude and longitude. Refer bookmark.php to see the structure of bookmark class.  
A sample implementation for AddBookmark, DeleteBookmark and ListBookmark action is provided in action.php file. you can add your custom action code in extendActions.php by extending the Action abstract class (action.php).  

queryinterface.php is the script that client will communicate with. Currently it accepts following request parameters:  
1. action: what action do you want to do, currently 'AddBookmark', 'DeleteBookmark' and 'ListBookmark' actions are supported. Refer action.php file to see what parameters these actions expect.  
2. apikey: API key, You can use 'super11key' for your testing. You can add as many API keys as you want  by adding more keys to table Bookmark.user   
3. lat: latitude  
4. lng: longitude  
5. address: user friendly address  
6. type: type of bookmark like 'home', 'office' (freetext)  

Setup:  
Import bookmarks.sql to mySQL  


To do:  
1. Support users per API key, currently only one user supported!  
2. Make error handling flexible.  
3. Make database handling flexible. (support multiple databases)