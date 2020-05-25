import bs4 as bs
import urllib.request
import json
import sys

url = sys.argv[1]
sauce = urllib.request.urlopen(url)
Obj = {"acc_link":sauce.geturl()}
json_string = json.dumps(Obj)
print(json_string)