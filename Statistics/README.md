# Statistics 統計  
### - Target : Finding 3 relationships in dataset  
Data source : https://drive.google.com/drive/u/0/folders/1dUVsUvaWQ-r7KGHKPo9CMqORN0Yz2_jn  
![image](https://drive.google.com/uc?export=view&id=1YgG8ByzngBQsg1_SIvawwe9MbFG5bNTv)

### - Null hypothesis 統計學中虛無假設H0:  
虛無假設即為假設我們取出的A & B兩組之間沒有相對應的關係，例如:我們想要觀察性別和職業的關係，我們就會先假設H0 "性別與職業不相關"  
相對的H1就是當我們有合理的證據可以拒絕虛無假設的關係在。上面的例子中:H1代表 "性別與職業相關"

### - Method 關於不同變項與依變項，拿來檢定H0的方法:
![image](https://drive.google.com/uc?export=view&id=1NsyozH5POuxYcTnP8gL4y95gze-ZzsmW)

### - Implement & result
    將資料進行適當的處理過後，使用python中 from scipy import stats，來計算我們想知道的虛無假設中變項的p-value，用來檢測是否接受我們的H0  
以程式中取年齡與結婚是否有關係檢定
當P-Value < 0.05時我們判斷若在常態分佈內，代表兩者之間有相對應的關係，拒絕虛無假設H0
![image](https://drive.google.com/uc?export=view&id=1RX4yPPbmZ3_1jPMHnX9R8iu_qt_v1xdd)


### - Reference
[Normal Distribution](http://www3.nccu.edu.tw/~soci1005/CH5.pdf "link")
[Null hypothesis](https://yourgene.pixnet.net/blog/post/116944086-%E5%81%87%E8%A8%AD%E6%AA%A2%E5%AE%9A(hypothesis-testing) "link")
