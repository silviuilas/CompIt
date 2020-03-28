import bs4 as bs
import urllib.request
import json
import sys

def get_item_name(sauce,url):
    soup = bs.BeautifulSoup(sauce,'lxml')
    if(url.find("emag.ro") or url.find("altex.ro") or url.find("mediagalaxy.ro") or url.find("flanco.ro")):
        return soup.find("h1").text
    elif():
        return ""
url = sys.argv[1]
sauce = urllib.request.urlopen(url).read()
json_string = get_item_name(sauce,url)
print(json_string)