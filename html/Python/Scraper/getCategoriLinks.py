#!/usr/bin/python3
import bs4 as bs
import urllib.request
import json
import sys
import os


fullItemArr = []
def get_category_links(sauce,url):
    categoryArr = []
    linkArr = []
    sums=0
    soup = bs.BeautifulSoup(sauce,'lxml')
    divArr = soup.find_all('div' ,class_="department-box")
    for div in divArr:
        liArr=div.find_all('li')[0:2]
        for li in liArr:
            tempvar=li.find('a')
            linkObj={}
            linkObj["subcategory_name"] = tempvar.text
            linkObj["subcategory_link"] = tempvar.get("href")
            url1=linkObj["subcategory_link"]
            max_index=25
            sums=sums+max_index
            fullItemArr.clear()
            get_all_category_pages(url1, 0, max_index)
            linkObj["subcategory_items"]=fullItemArr[:]
            linkArr.append(linkObj)
        catObj = {
            "category_name": div.find("h3").text,
            "category_links": linkArr
        }
        categoryArr.append(catObj)
        if(len(categoryArr)>20):
            break
    return categoryArr

def get_category_items(sauce,url):
    soup=bs.BeautifulSoup(sauce,'lxml')
    div_product = soup.find_all('div',class_="product-box-container clearfix")
    for box in div_product:
        img =box.find('div',class_="image-link-container").find('img').get("data-lazy-src")
        if(img == None):
            img = box.find('div',class_="image-link-container").find('img').get("src")
        itemObj = {
            "name" :     box.find('div',class_="name ulined-link").text.replace("\n",""),
            "minprice" : box.find('a',class_="price").text.replace("de la ","").replace(" RON","")[:-3].replace(" ",""),
            "img" :      img,
            "link" : box.find('a',class_="image").get("href")
        }
        fullItemArr.append((itemObj))
    return fullItemArr


def get_all_category_pages(url,index,max_index):
    if(index>=max_index):
        return fullItemArr
    curr_url=url+"?start="+str(index)
    sauce = urllib.request.urlopen(curr_url).read()
    get_category_items(sauce,curr_url)
    get_all_category_pages(url,index+25,max_index)

url="https://www.compari.ro/electronice-c3159/"
sauce = urllib.request.urlopen(url).read()
soup=bs.BeautifulSoup(sauce,'lxml')
fullview=get_category_links(sauce,url)
print(json.dumps(fullview))
with open('itemData.json','w+') as outfile:
    json.dump(fullview,outfile)

