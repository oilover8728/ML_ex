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
  可以看出Tfidf跑出來的結果比較好，但我覺得是因為我設定Bag of words只取5000個單詞的關係  
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
  ### ( word embeddings --> LSTM )  
  分布語意，一個詞的語意是被其他鄰近且一起出現的詞所定義
  Ref : [Word2Vec](https://www.kaggle.com/jerrykuo7727/word2vec "link")

  ### Result :  
  
  ### LSTM :  
雖然跑出來的結果很漂亮，但我覺得是因為tag的數量太少，導致只要大部分的tag都判斷為沒有，準確度就可以很高  
Epoch 1/10  
34/34 [==============================] - 25s 674ms/step - loss: 0.3447 - binary_accuracy: 0.9040  
Epoch 2/10  
34/34 [==============================] - 22s 645ms/step - loss: 0.0869 - binary_accuracy: 0.9806  
Epoch 3/10  
34/34 [==============================] - 22s 638ms/step - loss: 0.0802 - binary_accuracy: 0.9806  
Epoch 4/10  
34/34 [==============================] - 22s 655ms/step - loss: 0.0795 - binary_accuracy: 0.9806  
Epoch 5/10  
34/34 [==============================] - 23s 669ms/step - loss: 0.0791 - binary_accuracy: 0.9806  
Epoch 6/10  
34/34 [==============================] - 23s 668ms/step - loss: 0.0788 - binary_accuracy: 0.9806  
Epoch 7/10  
34/34 [==============================] - 23s 663ms/step - loss: 0.0784 - binary_accuracy: 0.9806  
Epoch 8/10  
34/34 [==============================] - 23s 685ms/step - loss: 0.0780 - binary_accuracy: 0.9806  
Epoch 9/10  
34/34 [==============================] - 23s 685ms/step - loss: 0.0775 - binary_accuracy: 0.9806  
Epoch 10/10  
34/34 [==============================] - 23s 666ms/step - loss: 0.0770 - binary_accuracy: 0.9806   

  
  
      
