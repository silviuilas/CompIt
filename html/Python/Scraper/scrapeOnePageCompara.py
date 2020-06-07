#!/usr/bin/python3
import bs4 as bs
import urllib.request
import json
import sys

def get_item(sauce,url):
    soup = bs.BeautifulSoup(sauce,'lxml')
    fullItem = {}
    itemsArr = []
    minprice=1000000
    content=soup.find('div', {"id": "idPriceGrid"})
    for div in content.find_all('div',class_="hidden-xs ProdBoxPriceMid"):

        oneItemObj = {
            "shopname": div.find('div',class_="col-xs-7 col-sm-7 col-md-2 col-lg-2").find('img').get('alt'),
            "shopimg": div.find('div',class_="col-xs-7 col-sm-7 col-md-2 col-lg-2").find('img').get('data-src'),
            "price": div.find_all('div',class_="col-xs-7 col-sm-7 col-md-3 col-lg-3")[1].find('div').text[:-1],
            "link": div.find('div',class_="col-xs-7 col-sm-7 col-md-2 col-lg-2 pull-right").find('a').get('href')
        }
        itemsArr.append(oneItemObj)
        ronprice=oneItemObj['price'][:-7].strip().replace(",","")
        if(int(ronprice)<int(minprice)):
            minprice=int(ronprice)
    fullItem['name']=soup.find('div',class_="ProdTopBox GradLite2").find('h1').text
    fullItem['categori']=''
    fullItem['minprice']=str(minprice)
    fullItem['url']=url
    fullItem['imglink']=soup.find('div',class_='ProdThumbBox GenericThumbBox').find('img').get('data-src')
    fullItem['items']=itemsArr
    return fullItem

url = sys.argv[1]
sauce = urllib.request.urlopen(url).read()
json_string = json.dumps(get_item(sauce,url))
print(json_string)
