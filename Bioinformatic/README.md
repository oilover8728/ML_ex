# Bioinformatic

### - Target
    基因序列的概率計算以及利用hidden markov chain來預測基因

### - Data Source  
Download chromosome 6 From Human Genome Resources at NCBI, select link GRCh38, Fasta.
https://www.ncbi.nlm.nih.gov/genome/guide/human/
Extract entry NC_000006.12 Homo sapiens chromosome 6, GRCh38.p13 Primary Assembly.
Extract bases [100,000–199,999]

### - Implement
    概率部分就是單純計算出現的機率，hidden markov chain即設定state並利用狀態轉移來達到predict的能力，使用python中hmmlearn來實作  
    詳細可以參考code的部分，並有截入一段hmmlearn的範例
