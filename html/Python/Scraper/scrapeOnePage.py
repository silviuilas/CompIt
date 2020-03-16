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
        shopimg= div.find('div',class_="col-logo").find('div',class_='img-wrap').find('img').get('src')
        if(shopimg==None):
            shopimg=div.find('div',class_="col-logo").find('div',class_='img-wrap').find('img').get('data-lazy-src')
        oneItemObj = {
            "shopname":div.find('div',class_="shopname").text,
            "shopimg" : shopimg,
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
    if(soup.find('a', attrs={"class": "product-image-wrapper"})):
        fullItem ['imglink']  = soup.find('a',attrs={"class": "product-image-wrapper"}).get("href")
    elif(soup.find_all('span',class_='product-image-wrapper')):
        fullItem ['imglink']  = soup.find('span',class_='product-image-wrapper').find('img').get("src")

    fullItem ['items']    = itemsArr
    return fullItem

url = sys.argv[1]
sauce = urllib.request.urlopen(url).read()
json_string = json.dumps(get_item(sauce,url))
print(json_string)
