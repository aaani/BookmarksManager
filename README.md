BookmarksManager
================

A service written in PHP that allows client to add and delete bookmarks. (Work under construction)

queryinterface.php is the script that client will communicate with. Currently it accepts following request parameters:
action: what action do you want to do, currently 'add' and 'delete' are supported.
apikey: api key
lat: latitude
lng: longitude
address: user friendly address
type: type of bookmark
