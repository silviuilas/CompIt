#!/usr/bin/python3
import bs4 as bs
import urllib.request
import json
import sys
print(sys.argv[0])
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

    fullItem ['name']     = soup.title.text[:-10]
    fullItem ['url']      = url
    fullItem ['minprice'] = str(minprice)
    if(soup.find('div',class_="col-lg-3 col-md-3 col-sm-3 col-xs-4 product-image").find_all('a',href="True")):
        fullItem ['imglink']  = soup.find('a',attrs={"class": "product-image-wrapper"}).get("href")
    else:
        fullItem ['imglink']  = 'https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/160/google/80/black-question-mark-ornament_2753.png'
    fullItem ['items']    = itemsArr
    return fullItem

def get_links(sauce):
    soup = bs.BeautifulSoup(sauce, 'lxml')
    temp= []
    div=soup.find('div', class_="similar-products")
    for a in div.find_all('a'):
        temp.append(a.get("href"))
    return temp


sauce1 ='https://polizor-unghiular.compari.ro/metabo/w-9-115-quick-600371000-p230477017/'
sauce3 ='https://polizor-unghiular.compari.ro/makita/9557nb-p17680647/'
sauce2 ='https://lego.compari.ro/lego/killow-contra-samurai-x-70642-p395310185/'



vizited = {}
fullview= []
def dfs(url,cond):
    print(url)
    sauce = urllib.request.urlopen(url).read()
    if(cond>1):
        return True
    temp_var=get_item(sauce,url)
    #TO DO make it faster by using hash tables
    vizited[temp_var['url']]=1
    fullview.append(temp_var)
    temp_var=get_links(sauce)
    for temp in temp_var:
        if not(temp in vizited):
            dfs(temp,cond+1)


dfs(sauce1,0)

print(fullview)
with open('itemData.json','w') as outfile:
    json.dump(fullview,outfile)