# Website-Server_hw7
    點進Django和Laravel檔案可以看到程式使用docker的執行方式
## Server Homework 
用兩種不同架構分別架設相同的電影推薦網站，並與Database和先前的推薦系統互動
![image](https://drive.google.com/uc?export=view&id=1aQ0xxybVyKf8Am5Faz-k1fr7FTNjZZHX)  
**Ref**:  
[Django](https://hackmd.io/@WyIQ2yXVTdW7DY29QgqM8g/BJs2nohcu "link")  
[Laravel](https://hackmd.io/@alvinhuang/Bk1nN9uFO "link")

## Django
使用sqlite作為database  
1.按照reference來架設一個最基礎的server架構  
2.在網路上下載template的模板並依照個人需求更改版面並使其與server能夠互動  
3.將template的素材移動到static資料夾並在html定義要去static讀取  
4.利用views.py來編寫網頁的get/post傳遞參數執行相對應的function，並回傳對應的網頁內容  
5.利用url.py來控制網頁路徑以及需要執行的function  
    
### - new thing I learn:
    1.session可以充當網頁資料的暫存器，讓我們在一個function內將資料寫入，可以在處理網頁呈現的地方再去讀出這些資料並顯示
    2.bulkcreat可以快速的大量寫資料進database，但是整個csv的命名與格式需要跟定義database的model.py名稱一模一樣
    3.利用Form可以將database包成一個class，調用起來比方便
    4.可以利用回傳primary key來使網頁和database的參數傳遞
    
## Laravel
使用sqlite作為database(需要到.env內修改)  
1.一樣有session的概念  
2.不過是要寫php，有些類似功能的function用法不同，(比較類似c++寫法)  
3.邏輯上大同小異，實際看welcome.blade.php和routes/web.php比對應該就能理解  
    
### - new thing I learn:
    1. database(csv)中要用的資料都需要放在public
    2. html網頁存在resource，不過網頁要是php檔，命名需要.blade。(asset/css/js)檔案存在resource/view中
    3. database存在database資料夾下
    4. 要執行的function可以寫在controller(類似django的views.py)下，也可以寫在routes/web.php(類似django的url.py)中，(如果寫在web.php是web.php會去call controller)
    
## Problem :Ｄａｔａｂａｓｅ如果沒有reindex就會一直變大，就算delete也還是會占用空間
### 網頁展示 :
![image](https://github.com/oilover8728/Website-Server_hw7/blob/master/screenshot/home_insert.PNG)
![image](https://github.com/oilover8728/Website-Server_hw7/blob/master/screenshot/home_delete.PNG)
![image](https://github.com/oilover8728/Website-Server_hw7/blob/master/screenshot/database.PNG)
![image](https://github.com/oilover8728/Website-Server_hw7/blob/master/screenshot/database_search.PNG)
    
    
