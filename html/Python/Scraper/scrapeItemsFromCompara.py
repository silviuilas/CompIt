#!/usr/bin/python3
import bs4 as bs
import urllib.request
import json
import sys


fullItemArr = []
def get_category_items(sauce,url):
    soup=bs.BeautifulSoup(sauce,'lxml')
    div_product = soup.find_all('div',class_="hidden-xs ListingBoxPRep")
    for box in div_product:
        img = box.find('img').get("data-src")
        if(img==None):
            img = "https://www.google.com/url?sa=i&url=https%3A%2F%2Fbitsofco.de%2Fhandling-broken-images-with-service-worker%2F&psig=AOvVaw2_fx4L3sS9ZU5egFfPnx7X&ust=1591598460049000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCKjvi7mM7-kCFQAAAAAdAAAAABAD"
        itemObj = {
            "name" : box.find('div',class_="ListingTitleBox").find('a').get("title"),
            "minprice": box.find('div', class_="ListingPriceBox").find('font', class_="PPrice").text.replace("\t", "")[8:-8].replace(",",""),
            "img" : img,
            "link": box.find('div',class_="ListingTitleBox").find('a').get("href")
        }
        fullItemArr.append((itemObj))

def get_all_category_pages(url,index,max_index):
    if(index>=max_index):
        return fullItemArr
    curr_url=url + str(index) + "/"
    sauce = urllib.request.urlopen(curr_url).read()
    get_category_items(sauce,curr_url)
    get_all_category_pages(url,index+10,max_index)

url="https://www.compara.ro/casti-si-microfoane.1291-4521-0/"
sauce = urllib.request.urlopen(url).read()
soup=bs.BeautifulSoup(sauce,'lxml')
get_all_category_pages(url[:-2],0,100)

subcategoryObj = {
    "subcategory_name" : "Casti si microfoane",
    "subcategory_link" : "https://www.compara.ro/casti-si-microfoane.1291-4521-0/",
    "subcategory_items" : fullItemArr
}
finalObj = {
    "category_name" : "Electronice",
    "category_links" : [subcategoryObj]
}
print(json.dumps(finalObj))
