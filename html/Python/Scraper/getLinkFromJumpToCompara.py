import bs4 as bs
import urllib.request
import json
import re
from urllib.request import Request, urlopen
import sys


def get_item(sauce, url):
    soup = bs.BeautifulSoup(sauce, 'lxml')
    fullItem = {}
    itemsArr = []
    url = soup.find('div', class_='RedirectBox RoundedBorder GradLite1').find('a').get('href')
    req = Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    webpage = urlopen(req).read()
    soup = bs.BeautifulSoup(webpage, 'lxml')
    text=soup.findAll('script')[1].text
    m = re.search(r"https.*\"", text)
    return m.group(0)[0:-1]


url = sys.argv[1]
sauce = urllib.request.urlopen(url).read()
Obj = {"acc_link":get_item(sauce, url)}
json_string = json.dumps(Obj)
print(json_string)
