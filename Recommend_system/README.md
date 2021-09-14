# hw2_Machine_Learning

## 1. Method
  ### - Collaborative Filtering 協同過濾 :  
    找到與目標user相似的其他使用者，在從這些其他user中找出平均評分較前面的幾部電影推薦給目標user。
    
    實作方法: 找到與目標user有相同觀影紀錄的user，將他們對那部電影的評分做cosine similarity找出最相近的10人，
    接下來以這10人當作基準再找目標user沒看過的電影，將其評分做平均後按照順序就是我的推薦名單。
  
## 2. Evaluation
  ###  - LeaveOneOut :  
    每次都提出一筆資料當作"測試資料"，剩下的就當作正常訓練資料，如此重複進行直到每一筆都被當作"測試資料"為止。
    
    但是鑒於資料有10萬多筆，要是每個都照傳統的方法慢慢跑的話會花太多時間，所以我是對每個user取他們最近看的那部電影，作為validation data，
    在training的時候不加入這些資料去看我的推薦系統能不能準確的推薦出那部電影給他。

  ### - Top-n Hit Rate :
    我這邊是取推薦的前10名電影做為推薦，判斷有沒有出現validation的資料，有的話則該user就hit
    
## 3. Result
  Hit: 5 / 671  
  Hit Rate : 0.007451564828614009
  
  按照我上述的LeaveOneOut方法準確度很差，我覺得是因為我的模型是手刻，太簡單，也未考慮到很多其他因素，
  使用者習慣、沒有將同分數的電影將較多觀看次數的電影做為優先推薦所以我自己的方法做出來的TOP10有時全部都是滿分，
  會有被排序擠掉的問題，所以準確度很差，可能還是要嘗試train一下model。

  另外我目前是利用user去找評分習慣相同的其他user，或許可以反過來想，從movie去找受評分相似的其他movie，或許能夠找到他們是相同性質電影的特徵。
  
## 4. Reference
1. [半小時打造簡單實用的電影推薦系統](https://medium.com/qiubingcheng/%E5%8D%8A%E5%B0%8F%E6%99%82%E6%89%93%E9%80%A0%E7%B0%A1%E5%96%AE%E5%AF%A6%E7%94%A8%E7%9A%84%E9%9B%BB%E5%BD%B1%E6%8E%A8%E8%96%A6%E7%B3%BB%E7%B5%B1-%E9%99%84%E5%AE%8C%E6%95%B4python%E7%A8%8B%E5%BC%8F%E7%A2%BC-b372769939af "link")
2. [歐氏距離與餘弦相似度的比較](https://medium.com/qiubingcheng/%E6%AD%90%E6%B0%8F%E8%B7%9D%E9%9B%A2%E8%88%87%E9%A4%98%E5%BC%A6%E7%9B%B8%E4%BC%BC%E5%BA%A6%E7%9A%84%E6%AF%94%E8%BC%83-c78163ad51b "link")
3. [以Python實現推薦系統的協同過濾算法](https://medium.com/qiubingcheng/%E4%BB%A5python%E5%AF%A6%E7%8F%BE%E6%8E%A8%E8%96%A6%E7%B3%BB%E7%B5%B1%E7%9A%84%E5%8D%94%E5%90%8C%E9%81%8E%E6%BF%BE%E7%AE%97%E6%B3%95-d35cc1a1ec8a "link")
4. [協同過濾(Collaborative Filtering)](https://ithelp.ithome.com.tw/articles/10219511 "link")

