# 題目敘述:
kaggle competition(Predict Future Sales):
https://www.kaggle.com/c/competitive-data-science-predict-future-sales  
加入上方網址內競賽，並對其中的資料進行分析。  
ps 題目是俄國的一家玩具公司的銷售資料，該競賽為訓練模型使其預測下個月的銷量  

# 題目要求:
以python(numpy,matplotlib,pandas)進行資料分析，並產生兩張分析圖表(分析內容不限)。  

使用jupyter來寫

# 兩張分析圖
## 內容1

## 內容2

# Code : 
 ```python
 #  匯入函式庫，讀取題目給的資料
 import matplotlib.pyplot as plt
 import numpy as np
 import pandas as pd
 item_categories = pd.read_csv('item_categories.csv')
 items = pd.read_csv('items.csv')
 sales_train = pd.read_csv('sales_train.csv')
 sample_submission = pd.read_csv('sample_submission.csv')
 shops = pd.read_csv('shops.csv')
 test = pd.read_csv('test.csv')
 
 item_categories.info    #  類別資訊 :        類別名稱 > 類別id
 items.info              #  物品資訊 :        物品名稱 > 物品id > 物品對應的類別
 sales_train.info        #  銷售資訊_訓練集 :  日期 > 日期區塊 > 店鋪id > 物品id > 物品價格 > 物品每日計數
 sample_submission.info
 shops.info              #  店鋪資訊 :        店鋪名稱 > 店鋪id
 test.info               #  測試集 :          ID > 店鋪id > 物品id
 
 #  確認訓練集中總共有 : 多少物品 > 多少店鋪
 print('unique items in train set:', sales_train['item_id'].nunique())
 print('unique shops in train set:', sales_train['shop_id'].nunique())
 print('')

 #  確認測試集中總共有 : 多少物品 > 多少店鋪
 print('unique items in test set:', test['item_id'].nunique())
 print('unique shops in test set:', test['shop_id'].nunique())
 
 #  繪製商品價格與銷售量的關係
 row = sales_train['item_price']
 col = sales_train['item_cnt_day']
 plt.xlabel('Item price',fontsize=20)
 plt.ylabel('Item cnt day',fontsize=20)
 plt.scatter(row,col)
 plt.show()
 
 #  定義一個apply方法，計算每筆消費獲得的金額，並新增至sales_train中
 def apply_fx(r):
   output = r['item_price'] * r['item_cnt_day']
   return output

 sales_train['money_per_item_cnt'] = sales_train.apply(apply_fx, axis=1)
 
 #  以每家店舖來分類，計算其所得，並繪製長條圖
 grouped_shop = sales_train[['shop_id','money_per_item_cnt']].groupby(['shop_id']).agg({'money_per_item_cnt':'sum'}).reset_index()
 grouped_shop = grouped_shop.rename(columns={'money_per_item_cnt':'total_money'})

 plt.figure(figsize=(18,8))
 row = grouped_shop['shop_id']
 col = grouped_shop['total_money']
 plt.xlabel('Shop ID',fontsize=20)
 plt.ylabel('Revenue per shop',fontsize=20)
 plt.xticks(range(60))
 plt.bar(row,col)
 plt.show()
 
 #  以每個月來分類，計算當月所得，並繪製折線圖 (date_block_num = 0 即 1 月)
 grouped_month = sales_train[['date_block_num','money_per_item_cnt']].groupby(['date_block_num']).agg({'money_per_item_cnt':'sum'}).reset_index()
 grouped_month = grouped_month.rename(columns={'money_per_item_cnt':'total_money'})

 plt.figure(figsize=(18,8))
 row = grouped_month['date_block_num']
 col = grouped_month['total_money']
 plt.xlabel('Month',fontsize=20)
 plt.ylabel('Total revenue',fontsize=20)
 plt.xticks(range(34))
 plt.plot(row,col)
 plt.show()
 ```

![image](https://github.com/oilover8728/hw1_predict_analysis/blob/master/screenshot/9.PNG)
![image](https://github.com/oilover8728/hw1_predict_analysis/blob/master/screenshot/11.PNG)
![image](https://github.com/oilover8728/hw1_predict_analysis/blob/master/screenshot/12.PNG)
