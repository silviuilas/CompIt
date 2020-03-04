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
        ronprice = oneItemObj['price'][:-7].strip().replace(" ", "")
        if (int(ronprice) < int(minprice)):
            minprice = int(ronprice)
    temp = soup.find('div', class_="breadcrumb-cat hidden-xs")
    stri=" ".join(temp.getText().split())
    temparr = temp.find_all('a')
    for i in range(1,1000):
        if(stri[-i]is ">"):
            stri=stri[-(i-2):]
            break
    fullItem ['name']     = stri
    fullItem['categori']  = temparr[1].text
    fullItem['minprice']  = str(minprice)
    fullItem ['url']      = url
    if not(soup.find('div',class_="col-lg-3 col-md-3 col-sm-3 col-xs-4 product-image").find_all('a',href="True")):
        fullItem ['imglink']  = soup.find('a',attrs={"class": "product-image-wrapper"}).get("href")
    else:
        fullItem ['imglink']  = 'https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/160/google/80/black-question-mark-ornament_2753.png'
    fullItem ['items']    = itemsArr
    return fullItem

url = sys.argv[1]
sauce = urllib.request.urlopen(url).read()
json_string = json.dumps(get_item(sauce,url))
print(json_string)
