#------------------------------------------------------------------------------------------------------------------------
#性別的銷售總額分析

import pandas as pd
import matplotlib.pyplot as plt

# 設定 Matplotlib 使用 Taipei Sans TC Beta 字體
plt.rcParams['font.sans-serif'] = ['Taipei Sans TC Beta']  # 設定全局使用 Taipei Sans TC Beta 字體
plt.rcParams['axes.unicode_minus'] = False  # 解決負號顯示問題

# 讀取 CSV 檔案
df = pd.read_csv('customer.csv')

# 檢查資料
print(df.head())

# 根據性別統計銷售總額
gender_sales = df.groupby('gender')['subtotal'].sum()

# 繪製性別銷售總額的柱狀圖
plt.figure(figsize=(10, 5))
gender_sales.plot(kind='bar', color=['#ff9999', '#66b3ff'])
plt.title('根據性別的銷售總額分析')
plt.xlabel('性別')
plt.ylabel('銷售總額')
plt.xticks(rotation=0)
plt.show()
#------------------------------------------------------------------------------------------------------------------------
#每個產品的性別銷售數量分析

import pandas as pd
import matplotlib.pyplot as plt

# 設定 Matplotlib 使用 Taipei Sans TC Beta 字體
plt.rcParams['font.sans-serif'] = ['Taipei Sans TC Beta']  # 設定全局使用 Taipei Sans TC Beta 字體
plt.rcParams['axes.unicode_minus'] = False  # 解決負號顯示問題

# 讀取 CSV 檔案
df = pd.read_csv('customer.csv')

# 檢查資料
print(df.head())

# 根據性別和產品統計銷售數量
product_gender_quantity = df.groupby(['product', 'gender'])['quantity'].sum().unstack()

# 檢查分組結果
print(product_gender_quantity)

# 找出每個性別的最高銷售產品
max_product_male = product_gender_quantity['male'].idxmax()
max_product_female = product_gender_quantity['female'].idxmax()

print(f"男性購買最多的產品是: {max_product_male}")
print(f"女性購買最多的產品是: {max_product_female}")

# 繪製產品銷售數量的柱狀圖
product_gender_quantity.plot(kind='bar', stacked=False, color=['#ff9999', '#66b3ff'])
plt.title('每個產品的性別銷售數量分析')
plt.xlabel('產品')
plt.ylabel('銷售數量')
plt.xticks(rotation=45)
plt.legend(title='性別')
plt.show()

#------------------------------------------------------------------------------------------------------------------------
#年齡段的產品銷售數量分析

import pandas as pd
import matplotlib.pyplot as plt

# 設定 Matplotlib 使用 Taipei Sans TC Beta 字體
plt.rcParams['font.sans-serif'] = ['Taipei Sans TC Beta']  # 設定全局使用 Taipei Sans TC Beta 字體
plt.rcParams['axes.unicode_minus'] = False  # 解決負號顯示問題

# 讀取 CSV 檔案
df = pd.read_csv('customer.csv')

# 檢查資料
print(df.head())

# 添加年齡段分組，例如：0-18、19-30、31-50、50以上
age_bins = [0, 18, 30, 50, 100]  # 年齡範圍
age_labels = ['0-18', '19-30', '31-50', '50以上']
df['age_group'] = pd.cut(df['age'], bins=age_bins, labels=age_labels, right=False)

# 根據年齡段和產品統計銷售數量
product_age_quantity = df.groupby(['product', 'age_group'])['quantity'].sum().unstack()

# 檢查分組結果
print(product_age_quantity)

# 繪製產品銷售數量的柱狀圖
product_age_quantity.plot(kind='bar', stacked=False, color=['#ff9999', '#66b3ff', '#99ff99', '#ffcc99'])
plt.title('根據年齡段的產品銷售數量分析')
plt.xlabel('產品')
plt.ylabel('銷售數量')
plt.xticks(rotation=45)
plt.legend(title='年齡段')
plt.show()

