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
    for div in soup.find_all('div',class_='optoffer device-desktop'):
        oneItemObj = {
            "shopname":div.find('div',class_="shopname").text,
            "price"   :div.find('div',class_='row-price').text,
            "link"    :div.find('a').get('href')
        }
        itemsArr.append(oneItemObj)
        ronprice=oneItemObj['price'][:-7]
        if (int(ronprice)< int(minprice)):
            minprice = int(oneItemObj['price'][:-7])
    temparr = soup.find('h1',class_='hidden-xs').find_all('span')
    fullItem ['name']     = temparr[1].text + ' '+ temparr[2].text
    fullItem ['categori'] = soup.find('div',class_="breadcrumb-cat hidden-xs").find_all('a')[1].text
    fullItem ['minprice'] = str(minprice)
    fullItem ['url']      = url

    if(soup.find('div',class_="col-lg-3 col-md-3 col-sm-3 col-xs-4 product-image").find_all('a',href="True")):
        fullItem ['imglink']  = soup.find('a',attrs={"class": "product-image-wrapper"}).get("href")
    else:
        fullItem ['imglink']  = 'https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/160/google/80/black-question-mark-ornament_2753.png'
    fullItem ['items']    = itemsArr
    return fullItem

url = sys.argv[1]
sauce = urllib.request.urlopen(url).read()
json_string = json.dumps(get_item(sauce,url))
print(json_string)
