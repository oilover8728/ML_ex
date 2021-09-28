# NLP_Semantic-analysi_3

## 1. Goal: Text Preprocessing
  ### 目的: 
      將資料中每個句子中用BoW (Bag of Words)和TF-IDF擷取出關鍵詞keyworld，再利用這組data用來訓練MultiLabel Classify的模型，並分別觀察準確度。
  
  Data type in csv : title -> tag
  
## 2. Data pre-processing
  先將所有的data切割成train/validation/test  
  
  train : 負責train model  
  validation : 檢驗model，效果不好就繼續調整  
  test : 檢驗最後模型的成效  
  (validation 是檢驗自己，test是跟別的model做比較)  
  
  ### - Task1: Word pre-processing
      1.先將所有句子轉換成英文小寫  
      2.將REPLACE_BY_SPACE_RE中有的字符替換成space  (re.sub)  
      3.將BAD_SYMBOLS_RE中的字符刪除  (re.sub)  
      4.將STOPWORDS砍掉並重新連接單詞  
  ### - Task2: Find 3 most popular tags and 3 most popular words in the train data  
      使用dict把所有tag和title加入dict並計算出現次數，sorted之後取前3項即可
  ### - Task3: Transforming text to a vector
      1.Bag pf words 不考慮單詞的相依性，單純計算每個單詞出現次數並建立一個vector<index : words>  
      2.TF-IDF  (call TfidfVectorizer to implement)  
          TF(Term Frequency) : 評估單詞對於單一文件的重要性，出現次數越多的單詞越能代表該文件  
          IDF(Inverse Document Frequency) : 觀察單詞出現的文件數，出現次數越少的越能代表其重要性  

## 3. MultiLabel classifier
      MultiLabel的核心概念是，每個tag即是一個label，我們可以根據輸入一個句子來觀察他符合哪些條件並給他貼上多個可相符的label"s"
  ### - Task1: change vector to array(list)  
      將我們上面整理好的vector和data轉成array(list)讓vector可以對齊並補0，以便後面使用函數
  ### - Task2: classifier  
      call OneVsRestClassifier來閃生病訓練模型，並得到Evaluation結果
  Ref : [OneVsRestClassifier](https://blog.csdn.net/NockinOnHeavensDoor/article/details/80234510 "link")  
  ### - Evaluation :  
  Bag-of-words  

  Accuracy:  3221  
  Accuracy:  0.10736666666666667  
  F1-score macro:  0.21598392084179607  
  F1-score micro:  0.3135033798056612  
  F1-score weighted:  0.30259958690895067  
  Precision macro:  0.10717847317452701  
  Precision micro:  0.1553448868549377  
  Precision weighted:  0.20747579302881394  

  Tfidf  

  Accuracy:  9895  
  Accuracy:  0.3298333333333333  
  F1-score macro:  0.4547756352322309  
  F1-score micro:  0.6360786856895806  
  F1-score weighted:  0.6117251205468082  
  Precision macro:  0.3009512561329642  
  Precision micro:  0.44480214297739146  
  Precision weighted:  0.4743105060655193  
  
## Word2Vec 
  ### ( mean(word embeddings) --> MLP ， word embeddings --> LSTM )  
  Word2Vec可以讓我們更好的觀察每個word之間的關係，並用別人train好的模型來看看我們的資料predict的結果，詳細敘述有點長我這邊放上連結  
  Ref : [Word2Vec](https://www.kaggle.com/jerrykuo7727/word2vec "link")

  ### Result :  
  
  ### LSTM :  
Epoch 1/10  
34/34 [==============================] - 21s 557ms/step - loss: 7.8344 - accuracy: 0.1279  
Epoch 2/10  
34/34 [==============================] - 20s 580ms/step - loss: 7.5282 - accuracy: 0.1540  
Epoch 3/10  
34/34 [==============================] - 21s 629ms/step - loss: 7.4733 - accuracy: 0.1516  
Epoch 4/10  
34/34 [==============================] - 20s 582ms/step - loss: 7.4633 - accuracy: 0.1487  
Epoch 5/10  
34/34 [==============================] - 20s 585ms/step - loss: 7.4553 - accuracy: 0.1489  
Epoch 6/10  
34/34 [==============================] - 20s 594ms/step - loss: 7.4453 - accuracy: 0.1474  
Epoch 7/10  
34/34 [==============================] - 21s 613ms/step - loss: 7.4394 - accuracy: 0.1438  
Epoch 8/10  
34/34 [==============================] - 21s 621ms/step - loss: 7.4426 - accuracy: 0.1515  
Epoch 9/10  
34/34 [==============================] - 21s 621ms/step - loss: 7.4363 - accuracy: 0.1630  
Epoch 10/10  
34/34 [==============================] - 20s 590ms/step - loss: 7.4361 - accuracy: 0.1714  

  ### MLP : (accuracy越來越低推測是epoch不夠)  
Epoch 1/10  
34/34 [==============================] - 18s 415ms/step - loss: 6.9216 - accuracy: 0.3472  
Epoch 2/10  
34/34 [==============================] - 14s 408ms/step - loss: 7.8631 - accuracy: 0.4828  
Epoch 3/10  
34/34 [==============================] - 14s 419ms/step - loss: 13.7049 - accuracy: 0.4505  
Epoch 4/10  
34/34 [==============================] - 14s 399ms/step - loss: 22.3702 - accuracy: 0.3747  
Epoch 5/10  
34/34 [==============================] - 16s 478ms/step - loss: 32.3762 - accuracy: 0.3085  
Epoch 6/10  
34/34 [==============================] - 15s 439ms/step - loss: 42.4375 - accuracy: 0.2625  
Epoch 7/10  
34/34 [==============================] - 15s 439ms/step - loss: 51.3588 - accuracy: 0.2264  
Epoch 8/10  
34/34 [==============================] - 16s 457ms/step - loss: 58.3298 - accuracy: 0.2030  
Epoch 9/10  
34/34 [==============================] - 17s 492ms/step - loss: 64.0116 - accuracy: 0.1843  
Epoch 10/10  
34/34 [==============================] - 16s 472ms/step - loss: 69.1175 - accuracy: 0.1713  

  
  
      
